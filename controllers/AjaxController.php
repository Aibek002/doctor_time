<?php
namespace app\controllers;
use app\models\Appointments;
use app\models\Patients;
use Yii;
use yii\web\Controller;
use yii\web\Response;
use app\models\Patient;

class AjaxController extends Controller
{
    public function actionFilter($patient = null, $doctor = null, $specialization = null, $page = 1)
    {
        \Yii::$app->response->format = Response::FORMAT_JSON;

        $query = Appointments::find()->alias('a')
            ->leftJoin('patients p', 'p.id = a.patient_id')
            ->select(['a.*', 'p.first_name', 'p.last_name']);

        if (!empty($patient)) {
            $query->andWhere(['a.patient_id' => (int) $patient]);
        }
        if (!empty($doctor)) {
            $query->andWhere(['a.doctor_name' =>  $doctor]);
        }
        if (!empty($specialization)) {
            $query->andWhere(['like', 'a.specialization', $specialization]);
        }

        $query->orderBy(['a.date_time' => SORT_DESC]);

        $pageSize = 5;
        $offset = ($page - 1) * $pageSize;
        $models = $query->offset($offset)->limit($pageSize)->asArray()->all();

        return [
            'success' => true,
            'data' => $models,
        ];
    }
}