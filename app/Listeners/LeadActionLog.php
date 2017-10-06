<?php

namespace App\Listeners;

use App\Events\LeadAction;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use App\Models\Activity;
use Lang;
use App\Models\Lead;

class LeadActionLog
{
    /**
     * Action the event listener.
     *
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  LeadAction  $event
     * @return void
     */
    public function handle(LeadAction $event)
    {
        switch ($event->getAction()) {
            case 'created':
                $text = __(':title được tạo bởi :creator và giao cho :assignee', [
                    'title' => $event->getLead()->title,
                    'creator' => $event->getLead()->creator->name,
                    'assignee' => $event->getLead()->user->name
                ]);
                break;
            case 'updated_status':
                $text = __('Chỉ đạo được hoàn thành bởi :username', [
                    'username' => Auth()->user()->name,
                ]);
                break;
            case 'updated_deadline':
                $text = __(':username đã sửa deadline cho chỉ đạo này', [
                    'username' => Auth()->user()->name,
                ]);
                break;
            case 'updated_assign':
                $text = __(':username giao cho :assignee', [
                    'username' => Auth()->user()->name,
                    'assignee' => $event->getLead()->user->name
                ]);
                break;
            default:
                break;
        }

        $activityinput = array_merge(
            [
                'text' => $text,
                'user_id' => Auth()->id(),
                'source_type' => Lead::class,
                'source_id' =>  $event->getLead()->id,
                'action' => $event->getAction()
            ]
        );
        
        Activity::create($activityinput);
    }
}
