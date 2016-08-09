<?php
/**
 * Created by PhpStorm.
 * User: ataman
 * Date: 09.08.16
 * Time: 13:50
 */

namespace app\repositories;


use app\models\Order;

class OrderRepository
{
    public function find($id){
        $Order = Order::findOne($id);
        if($Order == null){
            throw new \InvalidArgumentException();
        }

        return $Order;
    }

    public function add(Order $Order){
        if(!$Order->isNewRecord){
            throw new \InvalidArgumentException();
        }
        $Order->insert(false);
    }

    public function save(Order $Order){
        if($Order->isNewRecord){
            throw new \InvalidArgumentException();
        }
        $Order->update(false);
    }
}