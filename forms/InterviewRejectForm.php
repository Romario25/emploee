<?php
/**
 * Created by PhpStorm.
 * User: ataman
 * Date: 08.08.16
 * Time: 14:19
 */

namespace app\forms;


use yii\base\Model;

class InterviewRejectForm extends Model
{
    /**
     * Причина отклонения
     * 
     * @var string $reason 
     */
    public $reason;
    
    public function rules()
    {
        return [
            ['reason', 'required'],
            ['reason', 'string']
        ];

    }
    
    public function attributeLabels()
    {
        return [
            'reason' => 'Причина отклонения'
        ];
    }

}