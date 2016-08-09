<?php
/**
 * Created by PhpStorm.
 * User: ataman
 * Date: 09.08.16
 * Time: 13:50
 */

namespace app\repositories;


use app\models\Contract;

class ContractRepository
{
    public function find($id){
        $Contract = Contract::findOne($id);
        if($Contract == null){
            throw new \InvalidArgumentException();
        }

        return $Contract;
    }

    public function add(Contract $Contract){
        if(!$Contract->isNewRecord){
            throw new \InvalidArgumentException();
        }
        $Contract->insert(false);
    }

    public function save(Contract $Contract){
        if($Contract->isNewRecord){
            throw new \InvalidArgumentException();
        }
        $Contract->update(false);
    }
}