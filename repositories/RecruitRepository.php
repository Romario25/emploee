<?php
/**
 * Created by PhpStorm.
 * User: ataman
 * Date: 09.08.16
 * Time: 13:50
 */

namespace app\repositories;


use app\models\Recruit;

class RecruitRepository
{
    public function find($id){
        $Recruit = Recruit::findOne($id);
        if($Recruit == null){
            throw new \InvalidArgumentException();
        }

        return $Recruit;
    }

    public function add(Recruit $Recruit){
        if(!$Recruit->isNewRecord){
            throw new \InvalidArgumentException();
        }
        $Recruit->insert(false);
    }

    public function save(Recruit $Recruit){
        if($Recruit->isNewRecord){
            throw new \InvalidArgumentException();
        }
        $Recruit->update(false);
    }
}