<?php

namespace app\modules\user\services;

use DomainException;
use Yii;

class RoleManager
{
    private $manager;

    public function __construct()
    {
        $this->manager = Yii::$app->authManager;
    }

    public function assign($userId, $name): void
    {
        if (!$role = $this->manager->getRole($name)) {
            throw new DomainException('Role "' . $name . '" does not exist.');
        }

        $this->manager->revokeAll($userId);
        $this->manager->assign($role, $userId);
    }
}