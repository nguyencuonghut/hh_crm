<?php
namespace App\Http\Controllers;

use DB;
use Carbon;
use App\Http\Requests;
use App\Repositories\Task\TaskRepositoryContract;
use App\Repositories\Lead\LeadRepositoryContract;
use App\Repositories\User\UserRepositoryContract;
use App\Repositories\Client\ClientRepositoryContract;
use App\Repositories\Setting\SettingRepositoryContract;

class PagesController extends Controller
{

    protected $users;
    protected $clients;
    protected $settings;
    protected $tasks;
    protected $leads;

    public function __construct(
        UserRepositoryContract $users,
        ClientRepositoryContract $clients,
        SettingRepositoryContract $settings,
        TaskRepositoryContract $tasks,
        LeadRepositoryContract $leads
    ) {
        $this->users = $users;
        $this->clients = $clients;
        $this->settings = $settings;
        $this->tasks = $tasks;
        $this->leads = $leads;
    }

    /**
     * Dashobard view
     * @return mixed
     */
    public function dashboard()
    {

      /**
         * Other Statistics
         *
         */
        $companyname = $this->settings->getCompanyName();
        $users = $this->users->getAllUsers();
        $totalClients = $this->clients->getAllClientsCount();
        $totalTimeSpent = $this->tasks->totalTimeSpent();

     /**
      * Statistics for all-time tasks.
      *
      */
        $alltasks = $this->tasks->tasks();
        $allCompletedTasks = $this->tasks->allCompletedTasks();
        $totalPercentageTasks = $this->tasks->percantageCompleted();

     /**
      * Statistics for today tasks.
      *
      */
        $completedTasksToday =  $this->tasks->completedTasksToday();
        $createdTasksToday = $this->tasks->createdTasksToday();

     /**
      * Statistics for tasks this month.
      *
      */
         $taskCompletedThisMonth = $this->tasks->completedTasksThisMonth();
    

     /**
      * Statistics for tasks each month(For Charts).
      *
      */
        $createdTasksMonthly = $this->tasks->createdTasksMothly();
        $completedTasksMonthly = $this->tasks->completedTasksMothly();

     /**
      * Statistics for all-time Leads.
      *
      */
     
        $allleads = $this->leads->leads();
        $allCompletedLeads = $this->leads->allCompletedLeads();
        $totalPercentageLeads = $this->leads->percantageCompleted();
     /**
      * Statistics for today leads.
      *
      */
        $completedLeadsToday = $this->leads->completedLeadsToday();
        $createdLeadsToday = $this->leads->completedLeadsToday();

     /**
      * Statistics for leads this month.
      *
      */
        $leadCompletedThisMonth = $this->leads->completedLeadsThisMonth();

     /**
      * Statistics for leads each month(For Charts).
      *
      */
        $completedLeadsMonthly = $this->leads->createdLeadsMonthly();
        $createdLeadsMonthly = $this->leads->completedLeadsMonthly();

        /**
         * Statistics for all-time client type (Agent).
         *
         */
        $allagents = $this->clients->getAllAgentsCount();//cuongnv Tổng số đại lý

        /**
         * Statistics for all-time client type (Farm).
         *
         */
        $allfarms = $this->clients->getAllFarmsCount();//cuongnv Tổng số trại chăn nuôi

        /**
         * Statistics for all-time client group (Key client).
         *
         */
        $allkeyclients = $this->clients->getAllKeyClientsCount();//cuongnv Tổng số trại key

        /**
         * Statistics for all-time client group (Candidate client).
         *
         */
        $allcandidateclients = $this->clients->getAllCandidateClientsCount();//cuongnv Tổng số đại lý/trại tiềm năng

        /**
         * Statistics for all-time pig number
         *
         */
        $allpigs = $this->clients->getAllPigsCount();//cuongnv Tổng số lợn

        /**
         * Statistics for all-time broiler chicken number
         *
         */
        $allbroilerchickens = $this->clients->getAllBroilerChickensCount();//cuongnv Tổng số gà thịt

        /**
         * Statistics for all-time broiler duck number
         *
         */
        $allbroilerducks = $this->clients->getAllBroilerDucksCount();//cuongnv Tổng số vịt thịt

        /**
         * Statistics for all-time quail number
         *
         */
        $allquails = $this->clients->getAllQuailsCount();//cuongnv Tổng số cút

        /**
         * Statistics for all-time aqua number
         *
         */
        $allaquas = $this->clients->getAllAquasCount();//cuongnv Tổng số thủy sản

        /**
         * Statistics for all-time layer chicken number
         *
         */
        $alllayerchickens = $this->clients->getAllLayerChickensCount();//cuongnv Tổng số gà đẻ

        /**
         * Statistics for all-time layer duck number
         *
         */
        $alllayerducks = $this->clients->getAllLayerDucksCount();//cuongnv Tổng số vịt đẻ

        /**
         * Statistics for all-time cow number
         *
         */
        $allcows = $this->clients->getAllCowsCount();//cuongnv Tổng số bò

        return view('pages.dashboard', compact(
            'completedTasksToday',
            'completedLeadsToday',
            'createdTasksToday',
            'createdLeadsToday',
            'createdTasksMonthly',
            'completedTasksMonthly',
            'completedLeadsMonthly',
            'createdLeadsMonthly',
            'taskCompletedThisMonth',
            'leadCompletedThisMonth',
            'totalTimeSpent',
            'totalClients',
            'users',
            'companyname',
            'alltasks',
            'allCompletedTasks',
            'totalPercentageTasks',
            'allleads',
            'allCompletedLeads',
            'totalPercentageLeads',
            'allagents',
            'allfarms',
            'allkeyclients',
            'allcandidateclients',
            'allpigs',
            'allbroilerchickens',
            'allbroilerducks',
            'allquails',
            'allaquas',
            'alllayerchickens',
            'alllayerducks',
            'allcows'
        ));
    }
}
