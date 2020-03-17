<?php

namespace app\modules\user\controllers;

use app\modules\admin\components\BalletController;
use app\modules\user\forms\PasswordForm;
use app\modules\user\forms\CreateForm;
use app\modules\user\models\UserSearch;
use app\modules\user\repositories\UserRepository;
use app\modules\user\services\UserService;
use Yii;
use yii\base\Module;
use yii\filters\VerbFilter;

/**
 * @property UserService $service
 */
class BackendController extends BalletController
{
    private $service;
    private $users;

    public function __construct(string $id, Module $module, UserService $service, UserRepository $users, array $config = [])
    {
        $this->service = $service;
        $this->users = $users;
        parent::__construct($id, $module, $config);
    }

    public function behaviors()
    {
        $behaviors = parent::behaviors();
        $behaviors[] = [
            'class' => VerbFilter::class,
            'actions' => [
                'block'  => ['POST'],
                'unblock'  => ['POST'],
            ],
        ];
        return $behaviors;
    }

    public function actionIndex()
    {
        $searchModel = new UserSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->get());

        return $this->render('index', compact('dataProvider', 'searchModel'));
    }

    public function actionCreate()
    {
        $createForm = new CreateForm();

        if ($createForm->load(Yii::$app->request->post()) && $createForm->validate()) {
            $user = $this->service->create($createForm);
            return $this->redirect(['update', 'id' => $user->id]);
        }

        return $this->render('create', compact('createForm'));
    }

    public function actionUpdate($id)
    {
        $user = $this->users->findById($id);
        $profile = $user->profile;

        if ($profile->load(Yii::$app->request->post()) && $profile->save()) {
            return $this->refresh();
        }

        return $this->render('_main', compact('user', 'profile'));
    }

    public function actionPasswordChange($id)
    {
        $user = $this->users->findById($id);
        $passwordForm = new PasswordForm($user);

        if ($passwordForm->load(Yii::$app->request->post()) && $passwordForm->change()) {
            return $this->refresh();
        }

        return $this->render('_password_change', compact('user', 'passwordForm'));
    }

    public function actionUnconfirm($id)
    {
        if ($id == Yii::$app->user->id) {
            Yii::$app->session->setFlash('danger', 'Вы не можете отменить подтверждение собственный email');
        } else {
            $this->users->findById($id)->unconfirm();
        }

        return $this->redirect(Yii::$app->request->referrer);
    }

    public function actionConfirm($id)
    {
        if ($id == Yii::$app->user->id) {
            Yii::$app->session->setFlash('danger', 'Вы не можете подтвердить собственный email');
        } else {
            $this->users->findById($id)->confirm();
        }

        return $this->redirect(Yii::$app->request->referrer);
    }

    public function actionBlock($id)
    {
        if ($id == Yii::$app->user->id) {
            Yii::$app->session->setFlash('danger', 'Вы не можете заблокировать собственный аккаунт');
        } else {
             $this->users->findById($id)->block();
        }

        return $this->redirect(Yii::$app->request->referrer);
    }

    public function actionUnblock($id)
    {
        if ($id == Yii::$app->user->id) {
            Yii::$app->session->setFlash('danger', 'Вы не можете разблокировать собственный аккаунт');
        } else {
             $this->users->findById($id)->unblock();
        }

        return $this->redirect(Yii::$app->request->referrer);
    }

    public function actionDelete($id)
    {
        if ($id == Yii::$app->user->id) {
            Yii::$app->getSession()->setFlash('danger', 'Вы не можете удалить собственный аккаунт');
        } else {
             $this->users->findById($id)->delete();
        }

        return $this->redirect(['index']);
    }
}
