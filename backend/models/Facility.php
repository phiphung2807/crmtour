<?php

namespace backend\models;

use yii\db\ActiveRecord;

/**
 * This is the model class for table "facility".
 *
 * @property int $id
 * @property string $name
 * @property string $icon
 */
class Facility extends ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'facility';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['name', 'icon'], 'required'],
            [['name'], 'string', 'max' => 255],
            [['icon'], 'string', 'max' => 50],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'Tên',
            'icon' => 'Icon CSS class',
        ];
    }
}
