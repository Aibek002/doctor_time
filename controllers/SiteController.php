<?php

namespace app\controllers;

use app\models\MedicalCare;
use Yii;
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
    public function actionLogin()
    {
        if (!Yii::$app->user->isGuest) {
            return $this->goHome();
        }

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
                // Перезагружаем пользователя, чтобы точно был ID
                $user = \app\models\Users::findOne($user->id);

                Yii::$app->user->login($user, 3600 * 24 * 30); // запомним на 30 дней
                return $this->goHome();
            }
        }
        return $this->render('signup');
    }

}
