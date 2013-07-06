<?php

namespace app\controllers;

use Yii;
use app\models\RegisterForm;
use app\models\User;
use yii\web\Controller;
use app\models\LoginForm;
use app\models\ContactForm;

class SiteController extends Controller
{
    public function actions()
    {
        return array(
            'captcha' => array(
                'class' => 'yii\web\CaptchaAction',
            ),
        );
    }

    public function actionIndex() {
        echo $this->render('index');
    }

    public function actionLogin() {
        Yii::$app->session->setFlash('success', 'User has been created!');
        $model = new LoginForm();
        if ($model->load($_POST) && $model->login()) {
            Yii::$app->response->redirect(array('site/index'));
        } else {
            return $this->render('login', array(
                'model' => $model,
            ));
        }
    }

    public function actionLogout() {
        Yii::$app->getUser()->logout();
        Yii::$app->getResponse()->redirect(array('site/index'));
    }

    public function actionRegister() {
        $model = new RegisterForm();
        if ($model->load($_POST)) {
            if ($model->register()) {
                return Yii::$app->response->redirect(array('site/login'));
            }
        }
        return $this->render('register', array('model' => $model));
    }

    public function actionContact() {
        $model = new ContactForm;
        if ($model->load($_POST) && $model->contact(Yii::$app->params['adminEmail'])) {
            Yii::$app->session->setFlash('contactFormSubmitted');
            Yii::$app->response->refresh();
        } else {
            echo $this->render('contact', array(
                'model' => $model,
            ));
        }
    }

    public function actionAbout() {
        echo $this->render('about');
    }

    public function actionError() {
        echo "Shit happend!";
    }
}
