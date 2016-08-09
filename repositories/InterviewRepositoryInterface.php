<?php
/**
 * Created by PhpStorm.
 * User: ataman
 * Date: 08.08.16
 * Time: 21:03
 */
namespace app\repositories;
use app\models\Interview;


/**
 * Created by PhpStorm.
 * User: ataman
 * Date: 08.08.16
 * Time: 14:52
 */
interface InterviewRepositoryInterface
{
    public function find($id);

    public function add(Interview $interview);

    public function save(Interview $interview);
}