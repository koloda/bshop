<?php

namespace app\models;

use Yii;

class AActiveRecord extends \yii\db\ActiveRecord implements \dixonstarter\togglecolumn\ToggleActionInterface
{
    use \dixonstarter\togglecolumn\ToggleActionTrait;

    public function getToggleItems()
    {
        return [
            'on'    => ['value' => 1, 'label' => Yii::t('bshop', 'Active')],
            'off'   => ['value' => 0, 'label' => Yii::t('bshop', 'Disabled')]
        ];
    }
}
