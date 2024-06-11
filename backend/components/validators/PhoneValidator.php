<?php
/**
 * Created by PhpStorm.
 * User: minh
 * Date: 8/21/16
 * Time: 10:29 PM
 */

namespace backend\components\validators;

use yii\validators\Validator;

class PhoneValidator extends Validator {
    public function validateAttribute($model, $attribute)
    {
        $pattern = '/^0[0-9 ]{9,}+$/';

        if (!preg_match($pattern, $model->$attribute))
            $this->addError($model, $attribute, 'Số điện thoại chỉ chứa các chữ số, bắt đầu bằng số 0 và ko ít hơn 10 chữ số.');
    }
} 