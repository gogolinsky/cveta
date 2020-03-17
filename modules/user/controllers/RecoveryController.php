<?php

namespace app\modules\user\controllers;

use app\modules\user\forms\ForgetForm;
use app\modules\user\forms\RecoveryForm;
use app\modules\user\models\Token;
use Yii;
use yii\web\Controller;
use yii\filters\AccessControl;

/**
 * @property \app\modules\user\Module $module
 */
class RecoveryController extends Controller
{
    public $layout = '@app/modules/user/views/layouts/main';

    public function behaviors()
    {
        return [
            [
                'class' => AccessControl::class,
                'rules' => [
                    ['allow' => true, 'actions' => ['request', 'reset'], 'roles' => ['?']],
                ],
            ],
        ];
    }

    public function actionRequest()
    {
        $forgetForm = new ForgetForm();

        if ($forgetForm->load(Yii::$app->request->post()) && $forgetForm->validate() && $forgetForm->sendRecoveryMessage()) {
            return $this->render('request/success');
        }

        return $this->render('request/index', compact('forgetForm'));
    }

    public function actionReset($id, $code)
    {
        /** @var Token $token */
        $token = Token::findOne(['user_id' => $id, 'code' => $code, 'type' => Token::TYPE_RECOVERY]);

        if ($token === null || $token->isExpired() || $token->user === null) {
            return $this->render('reset/error');
        }

        $recoveryForm = new RecoveryForm();

        if ($recoveryForm->load(Yii::$app->request->post()) && $recoveryForm->resetPassword($token)) {
            return $this->render('reset/success');
        }

        return $this->render('reset/index', compact('recoveryForm'));
    }
}
