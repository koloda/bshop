<?php
use pistol88\cart\widgets\BuyButton;


/* @var $this yii\web\View */
/* @var $searchModel app\models\BrandSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('bshop', 'New products');
?>
sd fjkdfghkjdfhgkjdfgdhgkjdfh
<ul>
<?php foreach ($products as $p): ?>

    <li><?=$p->title?>
    <?= BuyButton::widget([
        'model' => $p,
        'text' => 'Заказать',
        'htmlTag' => 'a',
        'cssClass' => 'custom_class'
    ]) ?>
    </li>

<?php endforeach; ?>
</ul>

