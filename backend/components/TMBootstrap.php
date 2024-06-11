<?php

namespace backend\components;

use Yii;
use yii\base\BootstrapInterface;

/*
 * The base class that you use to retrieve the settings from the database
 */
class TMBootstrap implements BootstrapInterface
{
    private $_db;
    private $_cache;

    public function __construct() {
        $this->_db = Yii::$app->db;
        $this->_cache = Yii::$app->cache;
    }

    /**
     * Bootstrap method to be called during application bootstrap stage.
     * Loads all the settings into the Yii::$app->params array
     * @param Application $app the application currently running
     */
    public function bootstrap($app)
    {
        // try retrieving $data from cache
        $data = $this->_cache->get('setting');

        if ($data === false) {
            // $data is not found in cache, calculate it from scratch
            $data = $this->_getSettingsFromDb();

            // store $data in cache so that it can be retrieved next time
            $this->_cache->set('setting', $data);
        }

        foreach ($data as $key => $val) {
            Yii::$app->params['setting'][$key] = $this->_is_serialized($val) ? unserialize($val) : $val;
        }
    }

    private function _getSettingsFromDb() {
        // Get settings from database
        $data = $this->_db->createCommand("SELECT setting_name, setting_value FROM setting WHERE status = 1")->queryAll();

        $params = [];
        // Now let's load the settings into the params array
        foreach ($data as $key => $val) {
            $params[$val['setting_name']] = $val['setting_value'];
        }

        return $params;
    }

    /**
     * Checks value to find if it was serialized.
     * (FROM WORDPRESS)
     *
     * @param $data
     * @param bool $strict
     * @return bool
     */
    private function _is_serialized( $data, $strict = true ) {
        // If it isn't a string, it isn't serialized.
        if ( ! is_string( $data ) ) {
            return false;
        }
        $data = trim( $data );
        if ( 'N;' === $data ) {
            return true;
        }
        if ( strlen( $data ) < 4 ) {
            return false;
        }
        if ( ':' !== $data[1] ) {
            return false;
        }
        if ( $strict ) {
            $lastc = substr( $data, -1 );
            if ( ';' !== $lastc && '}' !== $lastc ) {
                return false;
            }
        } else {
            $semicolon = strpos( $data, ';' );
            $brace     = strpos( $data, '}' );
            // Either ; or } must exist.
            if ( false === $semicolon && false === $brace ) {
                return false;
            }
            // But neither must be in the first X characters.
            if ( false !== $semicolon && $semicolon < 3 ) {
                return false;
            }
            if ( false !== $brace && $brace < 4 ) {
                return false;
            }
        }
        $token = $data[0];
        switch ( $token ) {
            case 's':
                if ( $strict ) {
                    if ( '"' !== substr( $data, -2, 1 ) ) {
                        return false;
                    }
                } elseif ( false === strpos( $data, '"' ) ) {
                    return false;
                }
            // Or else fall through.
            case 'a':
            case 'O':
            case 'E':
                return (bool) preg_match( "/^{$token}:[0-9]+:/s", $data );
            case 'b':
            case 'i':
            case 'd':
                $end = $strict ? '$' : '';
                return (bool) preg_match( "/^{$token}:[0-9.E+-]+;$end/", $data );
        }
        return false;
    }
}