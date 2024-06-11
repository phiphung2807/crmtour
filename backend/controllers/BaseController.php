<?php

namespace backend\controllers;

use common\models\User;
use yii\web\Controller;

class BaseController extends Controller {
    //this is the name of the hidden field holding the token and the name of the session variable
    const PreventReSubmitFieldName = '__crmtx_pr__';

    /**
     * Stores a token in the user's session and generates html for it.  This function is generally called from a view, to inject the token in a form.
     * @return string The html for a hidden field with the token.
     */
    public function getPreventReSubmitToken($html = true) {
        $preventReSubmitToken = md5('nqm'.microtime());
        $_SESSION[self::PreventReSubmitFieldName] = $preventReSubmitToken;
        if ($html) {
            return '<input type="hidden" name="' . self::PreventReSubmitFieldName . '" value="' . $preventReSubmitToken . '">';
        } else {
            return $preventReSubmitToken;
        }
    }

    /**
     * Consumes the token (clears it).
     * @return boolean Returns true if the token in the POST matches the token in the session.
     */
    public function consumePreventReSubmitToken() {
        $retVal = isset($_POST[self::PreventReSubmitFieldName]) && isset($_SESSION[self::PreventReSubmitFieldName]) && $_POST[self::PreventReSubmitFieldName] == $_SESSION[self::PreventReSubmitFieldName];

        //clear the session variable
        //echo $_POST[self::PreventReSubmitFieldName]. '<br />';
        //echo $_SESSION[self::PreventReSubmitFieldName];
        $_SESSION[self::PreventReSubmitFieldName] = null;

        //did we get the token we expected
        return $retVal;
    }
}
