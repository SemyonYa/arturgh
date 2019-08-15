<?php

namespace app\controllers;

use app\models\Au;
use app\models\SignupForm;
use app\models\User;
use Yii;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\web\Response;
use yii\filters\VerbFilter;
use app\models\LoginForm;

class SiteController extends Controller
{
    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'logout' => ['post'],
                ],
            ],
        ];
    }

    public function beforeAction($action)
    {
        if ($action->id === 'logout') {
            $this->enableCsrfValidation = false;
        }
        return parent::beforeAction($action);
    }

    public function actions()
    {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
        ];
    }

    public function actionIndex()
    {
        Au::isManager();
        return $this->render('index');
    }

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
        return $this->render('login', compact('model'));
    }

    public function actionSignup()
    {
        Au::isAdmin();
        $model = new SignupForm();
        if ($model->load(Yii::$app->request->post())) {
            if ($user = $model->signup()) {
//                if (Yii::$app->getUser()->login($user)) {
                return $this->goHome();
//                }
            }
        }

        return $this->render('signup', compact('model'));
    }

    public function actionLogout()
    {
        $this->enableCsrfValidation = false;
        Yii::$app->user->logout();
        return $this->goHome();
    }

    public function actionUserList() {
        Au::isAdmin();
        $users = User::find()->all();
        return $this->render('user-list', compact('users'));
    }
}
