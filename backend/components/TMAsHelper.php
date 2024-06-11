<?php

namespace backend\components;

use mdm\admin\components\Helper;
use yii\bootstrap5\Html;

class TMAsHelper extends Helper
{
    public static function a($text, $url = null, $options = [])
    {
        if ($url !== null) {
            $route = $url;
            if (is_array($url)) {
                $route = $url[0];
            }

            if (!self::checkRoute($route)) { return null; }
        }

        return Html::a($text, $url, $options);
    }
}