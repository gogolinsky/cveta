<?php

namespace app\modules\user\controllers;

use app\modules\user\forms\ResendForm;
use app\modules\user\repositories\UserRepository;
use app\modules\user\services\UserService;
use DomainException;
use app\modules\user\forms\RegistrationForm;
use Yii;
use yii\base\Module;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\web\NotFoundHttpException;

/**
 * @property \app\modules\user\Module $module
 * @property UserService $service
 * @property UserRepository $users
 */
class RegistrationController extends Controller
{
    public $layout = '@app/modules/user/views/layouts/main';

    private $service;
    private $users;

    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::class,
                'rules' => [
                    ['allow' => true, 'actions' => ['index', 'confirm', 'resend'], 'roles' => ['?']],
                ],
            ],
        ];
    }

    public function __construct(string $id, Module $module, UserService $service, UserRepository $users, array $config = [])
    {
        parent::__construct($id, $module, $config);
        $this->service = $service;
        $this->users = $users;
    }

    public function actionIndex()
    {
        if (!$this->module->enableRegistration) {
            throw new NotFoundHttpException();
        }

        $registrationForm = new RegistrationForm();

        if ($registrationForm->load(Yii::$app->request->post()) && $registrationForm->validate()) {
            try {
                $this->service->register($registrationForm);
                return $this->render('success');
            } catch (DomainException $e) {
                Yii::$app->errorHandler->logException($e);
                return $this->render('error');
            }
        }

        return $this->render('index', compact('registrationForm'));
    }

    public function actionConfirm($token)
    {
        try {
            $user = $this->users->findByToken($token);
            $this->service->confirm($user);
            Yii::$app->user->login($user);
            Yii::$app->session->setFlash('success', 'Ваш email успешно подтвержден');
        } catch (DomainException $e) {
            Yii::$app->errorHandler->logException($e);
            Yii::$app->session->setFlash('error', $e->getMessage());
        }

        return $this->goHome();
    }

    public function actionResend()
    {
        $resendForm = new ResendForm();

        if ($resendForm->load(Yii::$app->request->post()) && $resendForm->validate()) {
            try {
                $this->service->resend($resendForm);
                return $this->render('success');
            } catch (DomainException $e) {
                Yii::$app->errorHandler->logException($e);
                return $this->render('error');
            }
        }

        return $this->render('resend', compact('resendForm'));
    }
}
