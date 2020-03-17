<?php

namespace app\modules\user\commands;

use app\modules\user\forms\CreateForm;
use app\modules\user\models\User;
use app\modules\user\services\UserService;
use yii\base\Module;
use yii\console\Controller;
use yii\helpers\Console;

/**
 * @property UserService $service
 */
class ManageController extends Controller
{
    private $service;

    public function __construct(string $id, Module $module, UserService $service, array $config = [])
    {
        $this->service = $service;
        parent::__construct($id, $module, $config);
    }

    public function actionCreate($email, $password = null)
    {
        $createForm = new CreateForm();
        $createForm->email = $email;
        $createForm->password = $password;

        if ($createForm->validate()) {
            $this->service->create($createForm);
            $this->stdout('User has been created' . PHP_EOL, Console::FG_GREEN);
        } else {
            $this->stdout('Please fix following errors:' . PHP_EOL, Console::FG_RED);
            foreach ($createForm->errors as $errors) {
                foreach ($errors as $error) {
                    $this->stdout(' - ' . $error . PHP_EOL, Console::FG_RED);
                }
            }
        }
    }

    public function actionConfirm($email)
    {
        $user = User::findOne(['email' => $email]);

        if ($user === null) {
            $this->stdout('User is not found' . PHP_EOL, Console::FG_RED);
        } else {
            if (!$user->isConfirmed()) {
                $user->confirm();
                $this->stdout('User has been confirmed' . PHP_EOL, Console::FG_GREEN);
            } else {
                $this->stdout('Error occurred while confirming user' . PHP_EOL, Console::FG_RED);
            }
        }
    }

    public function actionDelete($email)
    {
        if ($this->confirm('Are you sure? Deleted user can not be restored')) {
            $user = User::findOne(['email' => $email]);
            if ($user === null) {
                $this->stdout('User is not found' . PHP_EOL, Console::FG_RED);
            } else {
                if ($user->delete()) {
                    $this->stdout('User has been deleted' . PHP_EOL, Console::FG_GREEN);
                } else {
                    $this->stdout('Error occurred while deleting user' . PHP_EOL, Console::FG_RED);
                }
            }
        }
    }

    public function actionPassword($email, $password)
    {
        $user = User::findOne(['email' => $email]);

        if ($user === null) {
            $this->stdout('User is not found' . PHP_EOL, Console::FG_RED);
        } else {
            if ($user->resetPassword($password)) {
                $this->stdout('Password has been changed' . PHP_EOL, Console::FG_GREEN);
            } else {
                $this->stdout('Error occurred while changing password' . PHP_EOL, Console::FG_RED);
            }
        }
    }
}
