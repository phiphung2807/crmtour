<?php

namespace backend\models;

use Yii;
use backend\models\ActiveRecordAutoBehaviors;

/**
 * This is the model class for table "hotel".
 *
 * @property int $id
 * @property string $name
 * @property int $rank
 * @property string $long_desc
 * @property int $state_id
 * @property int|null $city_id
 * @property string $short_desc
 * @property string|null $note
 * @property float $price
 * @property float|null $price_discount
 * @property int|null $created_at
 * @property int|null $created_user
 * @property int|null $updated_at
 * @property int|null $updated_user
 * @property int $status
 */
class Hotel extends ActiveRecordAutoBehaviors
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'hotel';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['name', 'long_desc', 'state_id', 'short_desc', 'price', 'status'], 'required'],
            [['long_desc', 'note'], 'string'],
            [['state_id', 'city_id', 'status'], 'integer'],
            [['price', 'price_discount'], 'number'],
            [['name', 'short_desc'], 'string', 'max' => 255],
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
            'rank' => 'Hạng',
            'long_desc' => 'Mô tả',
            'state_id' => 'Tỉnh/vùng',
            'city_id' => 'Thành phố',
            'short_desc' => 'Mô tả ngắn',
            'note' => 'Ghi chú',
            'price' => 'Giá',
            'price_discount' => 'Giá giảm',
            'created_at' => 'Tạo lúc',
            'created_user' => 'Tạo bởi',
            'updated_at' => 'Sửa lúc',
            'updated_user' => 'Sửa bởi',
            'status' => 'Trạng thái',
        ];
    }
}
