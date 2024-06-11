<?php

namespace backend\models;

use yii\db\ActiveRecord;

/**
 * BaseActiveRecord is the base class for all classes in MVP Projects.
 */
class BaseActiveRecord extends ActiveRecord {
    const STATUS_ACTIVE = 1;
    const STATUS_INACTIVE = 0;

    public static $statusList = [
        self::STATUS_INACTIVE => 'Vô hiệu',
        self::STATUS_ACTIVE => 'Hoạt động',
    ];

    public function getStatusLabel() {
        return isset($this->status) ? self::$statusList[$this->status] : null;
    }
}