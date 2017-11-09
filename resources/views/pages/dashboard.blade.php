@extends('layouts.master')

@section('content')
@push('scripts')
    <script>
        $(document).ready(function () {
            $('[data-toggle="tooltip"]').tooltip(); //Tooltip on icons top

            $('.popoverOption').each(function () {
                var $this = $(this);
                $this.popover({
                    trigger: 'hover',
                    placement: 'left',
                    container: $this,
                    html: true,

                });
            });
        });
    </script>
@endpush
    <div class="div">
        <div class="col-md-6 col-sm-6 col-xs-12">
            <h4>{{ __('Khách hàng') }}</h4>
            <bar1 :statistics="{{$typeStatistics}}"></bar1>
        </div>

        <div class="col-md-6 col-sm-6 col-xs-12">
            <h4>{{ __('Vật nuôi') }}</h4>
            <bar :statistics="{{$animalStatistics}}"></bar>
        </div>

        <!-- Small boxes (Stat box) -->
        <div class="row">
            <div class="col-md-6 col-sm-6 col-xs-12">
                <!-- small box -->
                <div class="small-box bg-aqua">
                    <div class="inner">
                        <h3>
                            @foreach($taskCompletedThisMonth as $thisMonth)
                                {{$thisMonth->total}}
                            @endforeach
                        </h3>

                        <p>{{ __('Nhiệm vụ hoàn thành tháng') }} {{ date("m", strtotime('m')) }}</p>
                    </div>
                    <div class="icon">
                        <i class="ion ion-ios-book-outline"></i>
                    </div>
                    <a href="{{route('tasks.index')}}" class="small-box-footer">{{ __('Tất cả nhiệm vụ') }} <i
                                class="fa fa-arrow-circle-right"></i></a>
                </div>
            </div>
            <!-- ./col -->
            <div class="col-md-6 col-sm-6 col-xs-12">
                <!-- small box -->
                <div class="small-box bg-green">
                    <div class="inner">
                        <h3>
                            @foreach($leadCompletedThisMonth as $thisMonth)
                                {{$thisMonth->total}}
                            @endforeach
                        </h3>

                        <p>{{ __('Chỉ đạo hoàn thành tháng') }} {{ date("m", strtotime('m')) }}</p>
                    </div>
                    <div class="icon">
                        <i class="ion ion-stats-bars"></i>
                    </div>
                    <a href="{{route('leads.index')}}" class="small-box-footer">{{ __('Tất cả chỉ đạo') }} <i
                                class="fa fa-arrow-circle-right"></i></a>
                </div>
            </div>
            <!-- ./col -->
        </div>
        <!-- /.row -->

        <?php $createdTaskEachMonths = array(); $taskCreated = array();?>
        @foreach($createdTasksMonthly as $task)
            <?php $createdTaskEachMonths[] = date('F', strTotime($task->created_at)) ?>
            <?php $taskCreated[] = $task->month;?>
        @endforeach

        <?php $completedTaskEachMonths = array(); $taskCompleted = array();?>

        @foreach($completedTasksMonthly as $tasks)
            <?php $completedTaskEachMonths[] = date('F', strTotime($tasks->updated_at)) ?>
            <?php $taskCompleted[] = $tasks->month;?>
        @endforeach

        <?php $completedLeadEachMonths = array(); $leadsCompleted = array();?>
        @foreach($completedLeadsMonthly as $leads)
            <?php $completedLeadEachMonths[] = date('F', strTotime($leads->updated_at)) ?>
            <?php $leadsCompleted[] = $leads->month;?>
        @endforeach

        <?php $createdLeadEachMonths = array(); $leadCreated = array();?>
        @foreach($createdLeadsMonthly as $lead)
            <?php $createdLeadEachMonths[] = date('F', strTotime($lead->created_at)) ?>
            <?php $leadCreated[] = $lead->month;?>
        @endforeach
        <div class="row">

            @include('partials.dashboardone')


        </div>
@endsection
