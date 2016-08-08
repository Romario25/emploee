<?php
/**
 * Created by PhpStorm.
 * User: ataman
 * Date: 08.08.16
 * Time: 16:49
 */
namespace app\services;

interface NotifierInterface
{
    public function notice($view, $email, $subject, $message);
}