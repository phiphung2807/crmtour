<?php

namespace backend\controllers;

use backend\models\Place;
use common\models\LoginForm;
use Yii;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\web\Response;

/**
 * Site controller
 */
class SiteController extends Controller
{
    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::class,
                'rules' => [
                    [
                        'actions' => ['login', 'error'],
                        'allow' => true,
                    ],
                    [
                        'actions' => ['logout', 'index', 'test'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::class,
                'actions' => [
                    'logout' => ['post'],
                ],
            ],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function actions()
    {
        return [
            'error' => [
                'class' => \yii\web\ErrorAction::class,
            ],
        ];
    }

    /**
     * Displays homepage.
     *
     * @return string
     */
    public function actionIndex()
    {
        return $this->render('index');
    }

    /**
     * Login action.
     *
     * @return string|Response
     */
    public function actionLogin()
    {
        if (!Yii::$app->user->isGuest) {
            return $this->goHome();
        }

        $this->layout = 'blank';

        $model = new LoginForm();
        if ($model->load(Yii::$app->request->post()) && $model->login()) {
            return $this->goBack();
        }

        $model->password = '';

        return $this->render('login', [
            'model' => $model,
        ]);
    }

    /**
     * Logout action.
     *
     * @return Response
     */
    public function actionLogout()
    {
        Yii::$app->user->logout();

        return $this->goHome();
    }

    public function actionTest() {
        $countries = array(
            "BF" => array("country" => "Burkina Faso", "continent" => "Africa"),
            "BI" => array("country" => "Burundi", "continent" => "Africa"),
            "CM" => array("country" => "Cameroon", "continent" => "Africa"),
            "CV" => array("country" => "Cape Verde", "continent" => "Africa"),
            "CF" => array("country" => "Central African Republic", "continent" => "Africa"),
            "TD" => array("country" => "Chad", "continent" => "Africa"),
            "KM" => array("country" => "Comoros", "continent" => "Africa"),
            "CG" => array("country" => "Congo", "continent" => "Africa"),
            "CD" => array("country" => "The Democratic Republic of The Congo", "continent" => "Africa"),
            "CI" => array("country" => "Cote D'ivoire", "continent" => "Africa"),
            "DJ" => array("country" => "Djibouti", "continent" => "Africa"),
            "EG" => array("country" => "Egypt", "continent" => "Africa"),
            "GQ" => array("country" => "Equatorial Guinea", "continent" => "Africa"),
            "ER" => array("country" => "Eritrea", "continent" => "Africa"),
            "ET" => array("country" => "Ethiopia", "continent" => "Africa"),
            "GA" => array("country" => "Gabon", "continent" => "Africa"),
            "GM" => array("country" => "Gambia", "continent" => "Africa"),
            "GH" => array("country" => "Ghana", "continent" => "Africa"),
            "GN" => array("country" => "Guinea", "continent" => "Africa"),
            "GW" => array("country" => "Guinea-bissau", "continent" => "Africa"),
            "KE" => array("country" => "Kenya", "continent" => "Africa"),
            "LS" => array("country" => "Lesotho", "continent" => "Africa"),
            "LR" => array("country" => "Liberia", "continent" => "Africa"),
            "LY" => array("country" => "Libya", "continent" => "Africa"),
            "MG" => array("country" => "Madagascar", "continent" => "Africa"),
            "MW" => array("country" => "Malawi", "continent" => "Africa"),
            "ML" => array("country" => "Mali", "continent" => "Africa"),
            "MR" => array("country" => "Mauritania", "continent" => "Africa"),
            "MU" => array("country" => "Mauritius", "continent" => "Africa"),
            "YT" => array("country" => "Mayotte", "continent" => "Africa"),
            "MA" => array("country" => "Morocco", "continent" => "Africa"),
            "MZ" => array("country" => "Mozambique", "continent" => "Africa"),
            "NA" => array("country" => "Namibia", "continent" => "Africa"),
            "NE" => array("country" => "Niger", "continent" => "Africa"),
            "NG" => array("country" => "Nigeria", "continent" => "Africa"),
            "RE" => array("country" => "Reunion", "continent" => "Africa"),
            "RW" => array("country" => "Rwanda", "continent" => "Africa"),
            "SH" => array("country" => "Saint Helena", "continent" => "Africa"),
            "ST" => array("country" => "Sao Tome and Principe", "continent" => "Africa"),
            "SN" => array("country" => "Senegal", "continent" => "Africa"),
            "SC" => array("country" => "Seychelles", "continent" => "Africa"),
            "SL" => array("country" => "Sierra Leone", "continent" => "Africa"),
            "SO" => array("country" => "Somalia", "continent" => "Africa"),
            "ZA" => array("country" => "South Africa", "continent" => "Africa"),
            "SD" => array("country" => "Sudan", "continent" => "Africa"),
            "SZ" => array("country" => "Swaziland", "continent" => "Africa"),
            "TZ" => array("country" => "Tanzania, United Republic of", "continent" => "Africa"),
            "TG" => array("country" => "Togo", "continent" => "Africa"),
            "TN" => array("country" => "Tunisia", "continent" => "Africa"),
            "UG" => array("country" => "Uganda", "continent" => "Africa"),
            "EH" => array("country" => "Western Sahara", "continent" => "Africa"),
            "ZM" => array("country" => "Zambia", "continent" => "Africa"),
            "ZW" => array("country" => "Zimbabwe", "continent" => "Africa")    );

        $items = [];
        foreach ($countries as $code => $country) {
            $items[] = [$country['country'], $code, 2, 1];
        }

        $sql = Yii::$app->db->createCommand()->batchInsert(
            Place::tableName(), ['name', 'code', 'place_type', 'parent_id'], $items
        );

        echo $sql->execute();
    }
}
