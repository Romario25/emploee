<?php
/**
 * Created by PhpStorm.
 * User: ataman
 * Date: 09.08.16
 * Time: 13:07
 */

namespace app\forms;


use app\models\Interview;
use yii\base\Model;

class EmployeeCreateForm extends Model
{
    public $firstName;
    public $lastName;
    public $address;
    public $email;
    public $orderDate;
    public $contractDate;
    public $recruitDate;

    private $interview;

    public function __construct(Interview $interview, array $config = [])
    {
        $this->interview = $interview;
        parent::__construct($config);
    }

    public function init()
    {
        $this->lastName = $this->interview->last_name;
        $this->firstName = $this->interview->first_name;
        $this->email = $this->interview->email;
        
        parent::init(); // TODO: Change the autogenerated stub
    }

    public function rules()
    {
        return [
            [['firstName', 'lastName', 'address'], 'required'],
            [['firstName', 'lastName', 'address', 'email'], 'string', 'max' => 255],
            [['contractDate', 'orderDate', 'recruitDate'], 'required', ],
            [['contractDate', 'orderDate', 'recruitDate'], 'date', 'format' => 'php:Y-m-d']
        ];
    }

    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'firstName' => 'First Name',
            'lastName' => 'Last Name',
            'address' => 'Address',
            'email' => 'Email',
        ];
    }
}