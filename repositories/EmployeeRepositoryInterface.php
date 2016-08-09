<?php
/**
 * Created by PhpStorm.
 * User: ataman
 * Date: 09.08.16
 * Time: 13:40
 */
namespace app\repositories;

use app\models\Employee;

interface EmployeeRepositoryInterface
{
    public function find($id);

    public function add(Employee $employee);

    public function save(Employee $employee);
}