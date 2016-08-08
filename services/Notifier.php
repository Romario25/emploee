<?php
/**
 * Created by PhpStorm.
 * User: ataman
 * Date: 08.08.16
 * Time: 15:41
 */

namespace app\services;


use Yii;

class Notifier
{
    public function notice($view, $email, $subject, $message){
        Yii::$app->mailer->compose($view, ['model' => $message])
            ->setFrom(Yii::$app->params['adminEmail'])
            ->setTo($email)
            ->setSubject($subject)->send();
    }
}