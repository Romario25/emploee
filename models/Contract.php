<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "contract".
 *
 * @property integer $id
 * @property integer $employee_id
 * @property string $first_name
 * @property string $last_name
 * @property string $date_open
 * @property string $date_close
 * @property string $close_reason
 */
class Contract extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'contract';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['employee_id', 'first_name', 'last_name', 'date_open'], 'required'],
            [['employee_id'], 'integer'],
            [['date_open', 'date_close'], 'safe'],
            [['close_reason'], 'string'],
            [['first_name', 'last_name'], 'string', 'max' => 255],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'employee_id' => 'Employee ID',
            'first_name' => 'First Name',
            'last_name' => 'Last Name',
            'date_open' => 'Date Open',
            'date_close' => 'Date Close',
            'close_reason' => 'Close Reason',
        ];
    }
    
    public static function create($employeeId, $firstName, $lastName, $date){
        $contract = new self();
        $contract->first_name = $firstName;
        $contract->employee_id = $employeeId;
        $contract->last_name = $lastName;
        $contract->date_open = $date;
        
        return $contract;
    }
}
