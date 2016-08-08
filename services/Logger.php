<?php
/**
 * Created by PhpStorm.
 * User: ataman
 * Date: 08.08.16
 * Time: 15:39
 */

namespace app\services;


use app\models\Log;

class Logger
{
    public function log($message){
        $log = new Log();
        $log->message = $message;
        $log->save(false);
    }
}