<?php
namespace app\controllers;
use Yii;
use yii\web\Controller;
use yii\web\Response;
use app\models\Patient;

class AjaxController extends Controller
{

    public function actionGetPatient($id)
    {
        Yii::$app->response->format = Response::FORMAT_JSON;

        $patient = Patient::find()
            ->where(['id' => (int) $id])
            ->with('appointments')
            ->asArray()
            ->one();

        if ($patient === null) {
            return [
                'success' => false,
                'message' => 'Patient not found',
            ];
        }

        return [
            'success' => true,
            'data' => $patient,
        ];
    }
}