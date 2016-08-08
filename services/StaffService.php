<?php
namespace app\services;
use app\models\Interview;
use app\models\Log;
use app\repositories\InterviewRepository;
use Yii;

/**
 * Created by PhpStorm.
 * User: ataman
 * Date: 08.08.16
 * Time: 11:28
 */
class StaffService
{
    
    private $interviewRepository;
    
    private $logger;

    private $notifier;
    
    public function __construct(InterviewRepository $interviewRepository, Logger $logger, Notifier $notifier){
        $this->interviewRepository = $interviewRepository;
        $this->logger = $logger;
        $this->notifier = $notifier;
    }
    
    /**
     * Приглашение на интервью
     *
     * @param $lastName
     * @param $firstName
     * @param $email
     * @param $date
     * 
     * @return Interview
     */
    public function joinToInterview($lastName, $firstName, $email, $date){
        $interview = Interview::create($lastName, $firstName, $email, $date);
        $this->interviewRepository->save($interview);

        if($interview->email){
            $this->notifier->notice('interview/join', $interview->email, "You are joined to interview!", $this);
            $this->logger->log($interview->last_name.' '.$interview->first_name.' is joined to interview!');
        }

        return $interview;
    }

    public function editInterview($id, $lastName, $firstName, $email, $date){
        $interview = $this->interviewRepository->find($id);
        $interview->editData($firstName, $lastName, $email, $date);

        $this->interviewRepository->save($interview);

        $this->logger->log($interview->id.' is interview updated!');

        return $interview;
    }
    
    public function rejectInterview($id, $reason){
        $interview = $this->interviewRepository->find($id);
        $interview->reject($reason);
        $this->interviewRepository->save($interview);

        $this->notifier->notice('interview/reject', $interview->email, "You are reject to interview!", $this);
        $this->logger->log($interview->id.' is reject an interview!');

    }

}