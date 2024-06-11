<?php

namespace backend\models;

use yii\db\ActiveRecord;

/**
 * This is the model class for table "region".
 *
 * @property int $id
 * @property string $name
 * @property string|null $translations
 * @property string|null $created_at
 * @property string $updated_at
 * @property int $flag
 * @property string|null $wikiDataId Rapid API GeoDB Cities
 *
 * @property Country[] $countries
 * @property Subregion[] $subregions
 */
class Region extends ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'region';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['name'], 'required'],
            [['translations'], 'string'],
            [['created_at', 'updated_at'], 'safe'],
            [['flag'], 'integer'],
            [['name'], 'string', 'max' => 100],
            [['wikiDataId'], 'string', 'max' => 255],
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
            'translations' => 'Translations',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
            'flag' => 'Flag',
            'wikiDataId' => 'Wiki Data ID',
        ];
    }

    /**
     * Gets query for [[Countries]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getCountries()
    {
        return $this->hasMany(Country::class, ['region_id' => 'id']);
    }

    /**
     * Gets query for [[Subregions]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getSubregions()
    {
        return $this->hasMany(Subregion::class, ['region_id' => 'id']);
    }
}
