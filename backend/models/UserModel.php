<?php

namespace backend\models;

use framework\models\Model;

class UserModel extends Model {

    /**
     * @param iteger $uid The target user id.
     * @return array|null Returns an array containing the user data or NULL if no user is found
     */
    public function getUserData($uid) {
        if (!is_numeric($uid)) {
            return null;
        }
        $uid = intval($uid);

        $result = $this->getRow('SELECT `email`, `name`, `birth_date` FROM `users` WHERE `id` = :id', [
            ':id' => $uid
        ]);

        if (!empty($result) && !empty($result['name'])) {
            $result['name'] = $this->getClearedAndReversedName($result['name']);
        }

        return empty($result) ? null : $result;
    }

    /**
     * @param string $name
     * @return string
     */
    private function getClearedAndReversedName($name) {
        if (empty($name) || !is_string($name)) {
            return '';
        }
        $name = implode(
            ' ',
            array_map(
                function($v) { return trim($v); },
                array_reverse(explode(',', $name))
            )
        );

        return $name;
    }

}
