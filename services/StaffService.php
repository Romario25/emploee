<?php
namespace app\services;
use app\models\Contract;
use app\models\Employee;
use app\models\Interview;
use app\models\Order;
use app\models\Recruit;
use app\repositories\ContractRepository;
use app\repositories\EmployeeRepository;
use app\repositories\InterviewRepositoryInterface;
use app\repositories\OrderRepository;
use app\repositories\RecruitRepository;
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
    
    private $employeeRepository;
    
    private $orderRepository;
    
    private $contractRepository;
    
    private $recruitRepository;

    private $transactionManager;
    
    public function __construct(
        InterviewRepositoryInterface $interviewRepository,
        EmployeeRepository $employeeRepository,
        OrderRepository $orderRepository,
        ContractRepository $contractRepository,
        RecruitRepository $recruitRepository,
        TransactionManager $transactionManager,
        LoggerInterface $logger,
        NotifierInterface $notifier)
    {
        $this->interviewRepository = $interviewRepository;
        $this->logger = $logger;
        $this->notifier = $notifier;
        $this->employeeRepository = $employeeRepository;
        $this->orderRepository = $orderRepository;
        $this->contractRepository = $contractRepository;
        $this->recruitRepository = $recruitRepository;
        $this->transactionManager = $transactionManager;
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
        $this->interviewRepository->add($interview);

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
    
    public function createEmployee($interviewId, Employee $employee, $contractDate, $orderDate, $recruitDate){
        $interview = $this->interviewRepository->find($interviewId);
        
        // Оборачиваем все в транзакцию


        $transaction = $this->transactionManager->begin();
        try{
            // Сохраняем сотрудника
            $this->employeeRepository->add($employee);

            // создаем приказ
            $order = Order::create($orderDate);
            $this->orderRepository->add($order);

            // Создаем контракт (договор трудоустройства)
            $contract = Contract::create($employee->id, $employee->first_name, $employee->last_name, $contractDate);
            $this->contractRepository->add($contract);

            // Создаем приказ на работу
            $recruit = Recruit::create($employee->id, $order->id, $recruitDate);
            $this->recruitRepository->add($recruit);
            $transaction->commit();
        } catch (\HttpQueryStringException $e){
            $transaction->rollback();
        }

        
    }

}