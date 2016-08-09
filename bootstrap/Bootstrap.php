<?php
namespace app\bootstrap;

use app\repositories\InterviewRepository;
use app\repositories\InterviewRepositoryInterface;
use app\services\Logger;
use app\services\LoggerInterface;
use app\services\Notifier;
use app\services\NotifierInterface;
use Yii;
use yii\base\BootstrapInterface;


/**
 * Created by PhpStorm.
 * User: ataman
 * Date: 08.08.16
 * Time: 21:07
 */
class Bootstrap implements BootstrapInterface
{

    /**
     * Bootstrap method to be called during application bootstrap stage.
     * @param \yii\base\Application $app the application currently running
     */
    public function bootstrap($app)
    {
        $container = Yii::$container;
        $container->setSingleton(NotifierInterface::class, Notifier::class);
        $container->setSingleton(LoggerInterface::class, Logger::class);
        $container->setSingleton(InterviewRepositoryInterface::class, InterviewRepository::class);
    }
}