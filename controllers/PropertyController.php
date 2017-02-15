<?php

namespace app\controllers;

use app\models\Property;
use app\models\PropertySearch;
use app\models\PropertyValue;
use Yii;
use yii\base\Model;
use yii\filters\VerbFilter;
use yii\helpers\ArrayHelper;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\web\Response;
use yii\widgets\ActiveForm;

/**
 * PropertyController implements the CRUD actions for Property model.
 */
class PropertyController extends Controller
{
    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['POST'],
                ],
            ],
        ];
    }

    /**
     * Lists all Property models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new PropertySearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Property model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new Property model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Property();
        $valueModels = [new PropertyValue];

        if ($model->load(Yii::$app->request->post())) {
            //now load many values
            $valueModels = PropertyValue::createNNewObjects(count(Yii::$app->request->post('PropertyValue')));
            Model::loadMultiple($valueModels, Yii::$app->request->post(), 'PropertyValue');
            foreach ($valueModels as $index => $v) {
                $v->position = $index;
                $v->property_id = $model->id;
            }

            // ajax validation
            if (Yii::$app->request->isAjax) {
                Yii::$app->response->format = Response::FORMAT_JSON;
                return ArrayHelper::merge(
                    ActiveForm::validateMultiple($valueModels),
                    ActiveForm::validate($model)
                );
            }

            //because models returns boolean, not array with errors
            $valid = $model->validate();

            if ($valid) {
                $transaction = Yii::$app->db->beginTransaction();
                try {
                    $fail = (int)!$model->save(false);
                    foreach ($valueModels as $vp) {
                        $vp->property_id = $model->id;
                        if ($vp->validate()) {
                            $fail += (int)!$vp->save(false);
                        } else {
                            $fail++;
                        }
                    }

                    if (!$fail) {
                        $transaction->commit();
                        return $this->redirect(['index']);
                    } else {
                        $transaction->rollBack();
                    }
                } catch (Exception $ex) {
                    $transaction->rollBack();
                }
            }
        }

        return $this->render('create', [
            'model'         => $model,
            'valueModels'   => $valueModels
        ]);
    }

    /**
     * Updates an existing Property model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);
        $valueModels = $model->propertyValues;
        if (empty($valueModels)) {
            $valueModels = [new PropertyValue];
        }

        if ($model->load(Yii::$app->request->post())) {
            $oldIds = ArrayHelper::map($valueModels, 'id', 'id');

            $valueModels = [];
            foreach (Yii::$app->request->post('PropertyValue') as $index => $p) {
                $loadedModel = new PropertyValue();
                if ($p['id']) {
                    $loadedModel = PropertyValue::findOne((int)$p['id']);
                }
                
                $loadedModel->value = $p['value'];
                $loadedModel->position = $index;
                $loadedModel->property_id = $model->id;

                $valueModels[] = $loadedModel;
            }

            $deletedIds = array_diff($oldIds, ArrayHelper::map($valueModels, 'id', 'id'));

            // ajax validation
            if (Yii::$app->request->isAjax) {
                Yii::$app->response->format = Response::FORMAT_JSON;
                return ArrayHelper::merge(
                    ActiveForm::validateMultiple($valueModels),
                    ActiveForm::validate($model)
                );
            }

            if ($model->validate()) {
                $transaction = Yii::$app->db->beginTransaction();

                try {
                    //save all models
                    $model->save(false);

                    foreach ($valueModels as $v) {
                        if ($v->validate()) {
                            $v->save(false);
                        } else {
                            $transaction->rollBack();
                        }
                    }

                    if($transaction->isActive && count($deletedIds) && !PropertyValue::deleteAll(['id' => $deletedIds])) {
                        $transaction->rollBack();
                    }

                    if ($transaction->isActive) {
                        $transaction->commit();
                        return $this->redirect(['index']);
                    }
                } catch (Exception $e) {
                    $transaction->rollBack();
                }
            }
        }

        return $this->render('update', [
            'model'         => $model,
            'valueModels'   => $valueModels
        ]);
    }

    /**
     * Deletes an existing Property model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the Property model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Property the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Property::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
