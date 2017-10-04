<?php

namespace backend\controllers;

use backend\models\UserModel;
use framework\components\BaseController;

class Accounts extends BaseController {

    /**
     * @var backend\models\UserModel
     */
    private $model;

    public function __construct() {
        $this->model = new UserModel();
    }

    /**
     * {@inheritdoc}
     */
    public function indexAction() {
        $userId = isset($_GET['uid']) ? $_GET['uid'] : null;
        $userData = $this->getUser($userId);

        return $this->renderView('accounts', [
            'user' => $userData
        ]);
    }

    /**
     * @param integer $uid
     * @return array|null
     */
    private function getUser($uid) {
        $result = $this->model->getUserData($uid);

        return $result;
    }

}
