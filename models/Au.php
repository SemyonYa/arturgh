<?php

namespace app\models;
use yii\web\ForbiddenHttpException;

/**
 * @var $user User
 */


class Au
{
    public static function isAdmin() {
        if (\Yii::$app->user->identity) {
            $user_id = \Yii::$app->user->identity->getId();
            if ($user = User::findOne($user_id)) {
                if ($user->role === 1 && $user->status === 10) {
                    return true;
                }
            }
        } else {
            return \Yii::$app->getResponse()->redirect('/login');
        }
        throw new ForbiddenHttpException('Not ADMIN');
    }

    public static function isManager() {
        if (\Yii::$app->user->identity) {
            $user_id = \Yii::$app->user->identity->getId();
            if ($user = User::findOne($user_id)) {
                if ($user->status === 10) {
                    return true;
                }
            }
        } else {
            return \Yii::$app->getResponse()->redirect('/login');
        }
        throw new ForbiddenHttpException('Not FARMER');
    }

}