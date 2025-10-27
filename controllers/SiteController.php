<?php

namespace app\controllers;

use app\models\Appointments;
use app\models\MedicalCare;
use app\models\Patients;
use app\models\Users;
use Yii;
use yii\data\ActiveDataProvider;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\web\Response;
use yii\filters\VerbFilter;
use app\models\LoginForm;
use app\models\ContactForm;

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
                'only' => ['logout'],
                'rules' => [
                    [
                        'actions' => ['logout'],
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
    public function beforeSave($insert)
    {
        if (parent::beforeSave($insert)) {
            if ($this->isNewRecord) {
                $this->auth_key = Yii::$app->security->generateRandomString();
            }
            return true;
        }
        return false;
    }

    /**
     * {@inheritdoc}
     */
    public function actions()
    {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
            'captcha' => [
                'class' => 'yii\captcha\CaptchaAction',
                'fixedVerifyCode' => YII_ENV_TEST ? 'testme' : null,
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
        $care = MedicalCare::find()->all();
        return $this->render('index', [
            'care' => $care,
        ]);
    }

    /**
     * Login action.
     *
     * @return Response|string
     */
    // public function actionLogin()
    // {
    //     if (!Yii::$app->user->isGuest) {
    //         return $this->goHome();
    //     }

    //     $model = new LoginForm();
    //     if ($model->load(Yii::$app->request->post()) && $model->login()) {
    //         return $this->goBack();
    //     }

    //     $model->password = '';
    //     return $this->render('login', [
    //         'model' => $model,
    //     ]);
    // }

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

    /**
     * Displays contact page.
     *
     * @return Response|string
     */
    public function actionSignup()
    {
        if (!Yii::$app->user->isGuest) {
            return $this->goHome();
        }
        if (Yii::$app->request->isPost) {
            $data = Yii::$app->request->post();
            // print_r($data);die;
            $user = new \app\models\Users();
            $user->fullname = $data['fullname'];
            $user->password_hash = Yii::$app->security->generatePasswordHash($data['password_hash']);
            $user->gender = $data['gender'];
            $user->phone = $data['phone'];
            $user->birthday = $data['birthday'];
            $user->email = $data['email'];
            $user->auth_key = Yii::$app->security->generateRandomString();
            if ($user->save()) {
                $user = \app\models\Users::findOne($user->id);
                Yii::$app->user->login($user, 3600 * 24 * 30);
                return $this->goHome();
            }
        }
        return $this->render('signup');
    }
    public function actionLogin()
    {
        $model = new Users();

        if (Yii::$app->request->isPost && $model->load(Yii::$app->request->post())) {
            $user = Users::findByUsername($model->email);

            if ($user && $user->validatePassword($model->password)) {
                if (Yii::$app->user->login($user, 3600 * 24 * 30)) {
                    return $this->goHome();
                } else {
                    Yii::$app->session->setFlash('error', 'Ошибка при входе. Пожалуйста, попробуйте снова.');
                }

            } else {
                Yii::$app->session->setFlash('error', 'Неверный email или пароль');
            }
        }

        return $this->render('login', [
            'model' => $model,
        ]);
    }

    public function actionCreatePatient($id = null)
    {
        $model = Patients::findOne($id) ?? new Patients();

        if (Yii::$app->request->isPost && $model->load(Yii::$app->request->post())) {
            if ($model->save()) {
                return $this->redirect(['patients']);
            } else {
                Yii::$app->session->setFlash('error', 'Ошибка при создании пациента. Пожалуйста, попробуйте снова.');
            }
        }
        return $this->render('create-patient', [
            'model' => $model,
        ]);
    }

    public function actionPatients()
    {
        $provider = new ActiveDataProvider([
            'query' => \app\models\Patients::find(),
            'pagination' => [
                'pageSize' => 3,
            ],
        ]);

        return $this->render('patients', [
            'provider' => $provider,
        ]);
    }
    public function actionDeletePatients($id)
    {
        $patient = Patients::findOne($id);
        if ($patient) {
            $patient->delete();
        }
        return $this->redirect(['patients']);
    }

    public function actionCreateAppointments()
    {
        $model = new Appointments();
        if (Yii::$app->request->isPost && $model->load(Yii::$app->request->post())) {
            if (!empty($model->date_time)) {
                $model->date_time = str_replace('T', ' ', $model->date_time);

            }
            $patient_records = Appointments::find()->where(['patient_id' => $model->patient_id])->all();
            foreach ($patient_records as $record) {
                $record_time = strtotime($record->date_time);
                $new_time = strtotime($model->date_time);
                if (abs($record_time - $new_time) < 900) { // 900 секунд = 15 минут
                    Yii::$app->session->setFlash('error', 'У пациента уже есть запись в это время. Пожалуйста, выберите другое время.');
                    return $this->render('create-appointments', [
                        'model' => $model,
                    ]);
                }
            }
            if (!empty($patient_records)) {
                if ($model->save()) {
                    return $this->redirect(['appointments']);
                } else {
                    Yii::$app->session->setFlash('error', 'Ошибка при создании записи. Пожалуйста, попробуйте снова.');
                }
            }
        }
        return $this->render('create-appointments', [
            'model' => $model,
        ]);

    }
    public function actionAppointments()
    {
        $query = Appointments::find()
            ->where(['doctor_name' => Yii::$app->user->identity->fullname]) // ← условие WHERE
            ->orderBy(['date_time' => SORT_DESC]);
        $provider = new ActiveDataProvider([
            'query' => $query,
            'pagination' => [
                'pageSize' => 5,
            ],

            'sort' => [
                'defaultOrder' => ['date_time' => SORT_DESC], // сортировка по дате (от новых к старым)
                'attributes' => [
                    'date_time',
                    'doctor_name',
                    'specialization',
                ],
            ],
        ]);

        return $this->render('appointments', [
            'provider' => $provider,
        ]);
    }
    public function actionMedicalCare($medical_care_id)
    {
        $care = MedicalCare::findOne($medical_care_id);

        if (!$care) {
            throw new \yii\web\NotFoundHttpException('Medical care not found.');
        }
        return $this->render('medical-care', [
            'care' => $care,
        ]);
    }

}
