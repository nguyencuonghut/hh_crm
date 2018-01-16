<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\User;
use App\Models\Client;

class GetMonthlyClients extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'GetMonthlyClients:getmonthlyclients';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Get the number of Clients (Agents and Farms) for each month';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $users = User::all();
        $month =  date('M');
        $num_month = date("m", strtotime($month)); //Convert current month to number
        foreach($users as $user)
        {
            $id = $user->id;
            $user = User::findorFail($id);
            //Calculate the number of opened Agents for each user
            $opened_agents = $this->_getClientMonthly($id, 1, 3);

            //Calculate thez number of candidate Agents for each user
            $candidate_agents = $this->_getClientMonthly($id, 1, 1);

            //Calculate the number of opened Farms for each user
            $opened_farms = $this->_getClientMonthly($id, 2, 3)
            + $this->_getClientMonthly($id, 2, 2);

            //Calculate the number of candidate Farms for each user
            $candidate_farms = $this->_getClientMonthly($id, 2, 1);

            //Store the values to database
            switch ($num_month) {
                case '1':
                    $user->opened_agents_1      = $opened_agents;
                    $user->candidate_agents_1   = $candidate_agents;

                    $user->opened_farms_1       = $opened_farms;
                    $user->candidate_farms_1    = $candidate_farms;
                    break;
                case '2':
                    $user->opened_agents_2      = $opened_agents;
                    $user->candidate_agents_2   = $candidate_agents;

                    $user->opened_farms_2       = $opened_farms;
                    $user->candidate_farms_2    = $candidate_farms;
                    break;
                case '3':
                    $user->opened_agents_3      = $opened_agents;
                    $user->candidate_agents_3   = $candidate_agents;

                    $user->opened_farms_3       = $opened_farms;
                    $user->candidate_farms_3    = $candidate_farms;
                    break;
                case '4':
                    $user->opened_agents_4      = $opened_agents;
                    $user->candidate_agents_4   = $candidate_agents;

                    $user->opened_farms_4       = $opened_farms;
                    $user->candidate_farms_4    = $candidate_farms;
                    break;
                case '5':
                    $user->opened_agents_5      = $opened_agents;
                    $user->candidate_agents_5   = $candidate_agents;

                    $user->opened_farms_5       = $opened_farms;
                    $user->candidate_farms_5    = $candidate_farms;
                    break;
                case '6':
                    $user->opened_agents_6      = $opened_agents;
                    $user->candidate_agents_6   = $candidate_agents;

                    $user->opened_farms_6       = $opened_farms;
                    $user->candidate_farms_6    = $candidate_farms;
                    break;
                case '7':
                    $user->opened_agents_7      = $opened_agents;
                    $user->candidate_agents_7   = $candidate_agents;

                    $user->opened_farms_7       = $opened_farms;
                    $user->candidate_farms_7    = $candidate_farms;
                    break;
                case '8':
                    $user->opened_agents_8      = $opened_agents;
                    $user->candidate_agents_8   = $candidate_agents;

                    $user->opened_farms_8       = $opened_farms;
                    $user->candidate_farms_8    = $candidate_farms;
                    break;
                case '9':
                    $user->opened_agents_9      = $opened_agents;
                    $user->candidate_agents_9   = $candidate_agents;

                    $user->opened_farms_9       = $opened_farms;
                    $user->candidate_farms_9    = $candidate_farms;
                    break;
                case '10':
                    $user->opened_agents_10     = $opened_agents;
                    $user->candidate_agents_10  = $candidate_agents;

                    $user->opened_farms_10      = $opened_farms;
                    $user->candidate_farms_10   = $candidate_farms;
                    break;
                case '11':
                    $user->opened_agents_11     = $opened_agents;
                    $user->candidate_agents_11  = $candidate_agents;

                    $user->opened_farms_11      = $opened_farms;
                    $user->candidate_farms_11   = $candidate_farms;
                    break;
                case '12':
                    $user->opened_agents_12     = $opened_agents;
                    $user->candidate_agents_12  = $candidate_agents;

                    $user->opened_farms_12      = $opened_farms;
                    $user->candidate_farms_12   = $candidate_farms;
                    break;
                default:
                    break;
            }

            $user->save();
        }
    }

    private function _getClientMonthly($id, $client_type_id, $group_id)
    {
        $client_1 = Client::where('group_id', $group_id)
            ->where('client_type_id', $client_type_id)
            ->where('user_id', $id)
            ->count();
        $client_2 = Client::where('group_id', $group_id)
            ->where('client_type_id', $client_type_id)
            ->where('gs_id', $id)
            ->count();
        $client_3 = Client::where('group_id', $group_id)
            ->where('client_type_id', $client_type_id)
            ->where('tv_id', $id)
            ->count();
        $client_4 = Client::where('group_id', $group_id)
            ->where('client_type_id', $client_type_id)
            ->where('gd_vung_id', $id)
            ->count();
        $client_5 = Client::where('group_id', $group_id)
            ->where('client_type_id', $client_type_id)
            ->where('pgd_id', $id)
            ->count();
        $client_6 = Client::where('group_id', $group_id)
            ->where('client_type_id', $client_type_id)
            ->where('gd_id', $id)
            ->count();
        return $client_1 + $client_2 + $client_3 + $client_4 + $client_5 + $client_6;
    }
}
