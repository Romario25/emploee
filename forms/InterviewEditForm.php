<?php
/**
 * Created by PhpStorm.
 * User: ataman
 * Date: 08.08.16
 * Time: 11:22
 */

namespace app\forms;


use app\models\Interview;
use yii\base\Model;

class InterviewEditForm extends Model
{
    public $date;
    public $lastName;
    public $firstName;
    public $email;

    private $interview;

    public function __construct(Interview $interview, array $config = [])
    {
        $this->interview = $interview;
        parent::__construct($config);
    }

    public function init()
    {
        $this->date = $this->interview->date;
        $this->lastName = $this->interview->last_name;
        $this->firstName =  $this->interview->first_name;
        $this->email = $this->interview->email;
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