<?php

namespace app\models;

use Yii;
use yii\helpers\ArrayHelper;

/**
 * This is the model class for table "employee".
 *
 * @property integer $id
 * @property string $first_name
 * @property string $last_name
 * @property string $address
 * @property string $email
 * @property integer $status
 *
 * @property Assignment[] $assignments
 * @property Bonus[] $bonuses
 * @property Dismiss[] $dismisses
 * @property Interview[] $interviews
 * @property Recruit[] $recruits
 * @property Vacation[] $vacations
 */
class Employee extends \yii\db\ActiveRecord
{

    const STATUS_PROBATION = 1;
    const STATUS_WORK = 2;
    const STATUS_VACATION = 3;
    const STATUS_DISMISS = 4;
    const SCENARIO_CREATE = 'create';

    public $order_date;
    public $contract_date;
    public $recruit_date;



    public static function getStatusList()
    {
        return [
            self::STATUS_PROBATION => 'Probation',
            self::STATUS_WORK => 'Work',
            self::STATUS_VACATION => 'Vacation',
            self::STATUS_DISMISS => 'Dismiss'
        ];
    }

    public function getStatusName()
    {
        return ArrayHelper::getValue(self::getStatusList(), $this->status);
    }

    public function getFullName()
    {
        return $this->last_name . ' ' . $this->first_name;
    }

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'employee';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['first_name', 'last_name', 'address', 'status'], 'required'],
            [['status'], 'integer'],
            [['first_name', 'last_name', 'address', 'email'], 'string', 'max' => 255],
            [['contract_date', 'order_date', 'recruit_date'], 'required', 'on' => self::SCENARIO_CREATE ],
            [['contract_date', 'order_date', 'recruit_date'], 'date', 'format' => 'php:Y-m-d', 'on' => self::SCENARIO_CREATE ]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'first_name' => 'First Name',
            'last_name' => 'Last Name',
            'address' => 'Address',
            'email' => 'Email',
            'status' => 'Status',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAssignments()
    {
        return $this->hasMany(Assignment::className(), ['employee_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getBonuses()
    {
        return $this->hasMany(Bonus::className(), ['employee_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getDismisses()
    {
        return $this->hasMany(Dismiss::className(), ['employee_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getInterviews()
    {
        return $this->hasMany(Interview::className(), ['employee_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getRecruits()
    {
        return $this->hasMany(Recruit::className(), ['employee_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getVacations()
    {
        return $this->hasMany(Vacation::className(), ['employee_id' => 'id']);
    }

    public function afterSave($insert, $changedAttributes)
    {
        if (in_array('status', array_keys($changedAttributes)) && $this->status != $changedAttributes['status']) {
            if ($this->status == self::STATUS_PROBATION) {
                if ($this->email) {
                    Yii::$app->mailer->compose('employee/probation', ['model' => $this])
                        ->setFrom($this->email)
                        ->setSubject("You are probation!")->send();
                    $log = new Log();
                    $log->message = $this->last_name . ' ' . $this->first_name . ' is probation!';
                    $log->save(false);
                }

            } else if ($this->status == self::STATUS_WORK) {
                if ($this->email) {
                    Yii::$app->mailer->compose('employee/work', ['model' => $this])
                        ->setFrom($this->email)
                        ->setSubject("You are recruit!")->send();
                    $log = new Log();
                    $log->message = $this->last_name . ' ' . $this->first_name . ' is recruit!';
                    $log->save(false);
                }

            } else if ($this->status == self::STATUS_DISMISS) {
                if ($this->email) {
                    Yii::$app->mailer->compose('employee/dismiss', ['model' => $this])
                        ->setFrom($this->email)
                        ->setSubject("You are dismiss!")->send();
                    $log = new Log();
                    $log->message = $this->last_name . ' ' . $this->first_name . ' is dismiss!';
                    $log->save(false);
                }
            }
        }
        parent::afterSave($insert, $changedAttributes); // TODO: Change the autogenerated stub
    }
}