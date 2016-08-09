<?php
namespace app\repositories;
use app\models\Interview;

/**
 * Created by PhpStorm.
 * User: ataman
 * Date: 08.08.16
 * Time: 14:52
 */
class InterviewRepository implements InterviewRepositoryInterface
{
    public function find($id){
        $interview = Interview::findOne($id);
        if($interview == null){
            throw new \InvalidArgumentException();
        }

        return $interview;
    }

    public function add(Interview $interview){
        if(!$interview->isNewRecord){
            throw new \InvalidArgumentException();
        }
        $interview->insert(false);
    }

    public function save(Interview $interview){
        if($interview->isNewRecord){
            throw new \InvalidArgumentException();
        }
        $interview->update(false);
    }
}