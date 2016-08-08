<?php
/**
 * Created by PhpStorm.
 * User: ataman
 * Date: 08.08.16
 * Time: 11:22
 */

namespace app\forms;


use yii\base\Model;

class InterviewJoinForm extends Model
{
    public $date;
    public $lastName;
    public $firstName;
    public $email;

    public function init()
    {
        $this->date = date("Y-m-d");
    }

    public function rules(){
        return [
            [['date', 'lastName', 'firstName'], 'required'],
            ['date', 'date', 'format'=>'php:Y-m-d'],
            ['email', 'email'],
            [['lastName', 'firstName', 'email'], 'string', 'max' => 255]
        ];
    }

    public function attributeLabels()
    {
        return [
            'date' => 'Date',
            'firstName' => 'First Name',
            'lastName' => 'Last Name',
            'email' => 'Email'
        ];
    }
}