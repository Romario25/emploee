<?php
/**
 * Created by PhpStorm.
 * User: ataman
 * Date: 09.08.16
 * Time: 13:36
 */

namespace app\repositories;


use app\models\Employee;
use app\models\Interview;

class EmployeeRepository implements EmployeeRepositoryInterface
{

    public function find($id){
        $employee = Employee::findOne($id);
        if($employee == null){
            throw new \InvalidArgumentException();
        }

        return $employee;
    }

    public function add(Employee $employee){
        if(!$employee->isNewRecord){
            throw new \InvalidArgumentException();
        }
        $employee->insert(false);
    }

    public function save(Employee $employee){
        if($employee->isNewRecord){
            throw new \InvalidArgumentException();
        }
        $employee->update(false);
    }
}