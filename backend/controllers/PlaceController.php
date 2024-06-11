<?php

namespace backend\controllers;

use Yii;
use backend\models\CountrySearch;
use backend\models\RegionSearch;
use backend\models\Subregion;
use backend\models\SubregionSearch;
use backend\models\State;
use backend\models\StateSearch;
use backend\models\CitySearch;

/**
 * PlaceController implements the CRUD actions for Place model.
 */
class PlaceController extends BaseController
{
    /**
     * Lists all Region models.
     *
     * @return string
     */
    public function actionRegion()
    {
        $searchModel = new RegionSearch();
        $dataProvider = $searchModel->search($this->request->queryParams);

        return $this->render('region', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Lists all Subregion models.
     *
     * @return string
     */
    public function actionSubregion()
    {
        $searchModel = new SubregionSearch();
        $dataProvider = $searchModel->search($this->request->queryParams);

        return $this->render('subregion', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Lists all Country models.
     *
     * @return string
     */
    public function actionCountry()
    {
        $searchModel = new CountrySearch();
        $dataProvider = $searchModel->search($this->request->queryParams);

        return $this->render('country', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Finds all subregions by region, returns the list in Json format.
     * @return array|string[]
     */
    public function actionSubregionByRegion() {
        Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;

        if (isset($_POST['depdrop_parents'])) {
            $parents = $_POST['depdrop_parents'];
            if ($parents != null) {
                $subregions = Subregion::find()->where(['region_id' => $parents[0]])->all();
                $out = [];
                foreach ($subregions as $item) {
                    $out[] = ['id' => $item->id, 'name' => $item->name];
                }

                return ['output' => $out, 'selected' => null];
            }
        }

        return ['output' => '', 'selected' => ''];
    }

    /**
     * Lists all State models.
     *
     * @return string
     */
    public function actionState()
    {
        $searchModel = new StateSearch();
        $dataProvider = $searchModel->search($this->request->queryParams);

        return $this->render('state', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Lists all City models.
     *
     * @return string
     */
    public function actionCity()
    {
        $searchModel = new CitySearch();
        $dataProvider = $searchModel->search($this->request->queryParams);

        return $this->render('city', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Finds all states by country, returns the list in Json format.
     * @return array|string[]
     */
    public function actionStateByCountry() {
        Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;

        if (isset($_POST['depdrop_parents'])) {
            $parents = $_POST['depdrop_parents'];
            if ($parents != null) {
                $states = State::find()->where(['country_id' => $parents[0]])->all();
                $out = [];
                foreach ($states as $item) {
                    $out[] = ['id' => $item->id, 'name' => $item->name];
                }

                return ['output' => $out, 'selected' => null];
            }
        }

        return ['output' => '', 'selected' => ''];
    }
}
