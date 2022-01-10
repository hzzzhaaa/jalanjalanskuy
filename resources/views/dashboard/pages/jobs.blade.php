@extends('dashboard/app')

@section('title')
| {{$division->name}}
@endsection

@section('content')
<div class="page-content-wrapper">
    <!-- BEGIN CONTENT BODY -->
    <div class="page-content">
        <!-- BEGIN PAGE HEADER-->
        <!--  BEGIN PAGE BAR -->
        <div class="page-bar">
            <ul class="page-breadcrumb">
                <li>
                    <i class="fa fa-circle"></i>
                    <a href="#">Dashboard</a>
                </li>
                <li>
                    <i class="fa fa-circle"></i>
                    <a href="#">Event</a>
                </li>
                <li>
                    <i class="fa fa-circle"></i>
                    <a href="#">{{$event->name}}</a>
                </li>
                <li>
                    <i class="fa fa-circle"></i>
                    <a href="#">Division</a>
                </li>
                <li>
                    <i class="fa fa-circle"></i>
                    <a href="#">{{$division->name}}</a>
                </li>
            </ul>
        </div>
        <br>
        <!--  END PAGE BAR -->
        {{-- <!-- BEGIN PAGE TITLE-->
        <h1 class="page-title" style="color:steelblue"> <b>Hello, {{Auth::user()->name}}!</b></h1>
        <!-- END PAGE TITLE--> --}}
        <!-- END PAGE HEADER-->
        <div style="text-align:center">
            <a class="btn-lg btn green" href="#new" data-toggle="modal"><i class="fa fa-plus"></i> <strong>Add
                    New</strong></a>
        </div>
        {{-- Modal Entry --}}
        <div id="new" class="modal fade" role="dialog" aria-labelledby="myModalLabel10" aria-hidden="true">
            <form
                action="{{route('dashboard.event.division.jobs.store', ['event'=>Hashids::connection(\App\Event::class)->encode($event->id),'division' => Hashids::connection(\App\Division::class)->encode($division->id)])}}"
                method="POST" id="form_sample_3" enctype="multipart/form-data" data-parsley-validate=""
                class="form-horizontal">
                {{csrf_field()}}
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
                            <h4 class="modal-title"><strong>Make new tasks for this division</strong></h4>
                        </div>
                        <div class="modal-body">

                            <div class="form-group">
                                <label class="control-label col-md-2">Date</label>
                                <div class="col-md-8">
                                    <div class="input-group input-medium date date-picker" data-date-format="dd-mm-yyyy"
                                        data-date-viewmode="years">
                                        <input type="text" class="form-control" name='date' readonly>
                                        <span class="input-group-btn">
                                            <button class="btn default" type="button">
                                                <i class="fa fa-calendar"></i>
                                            </button>
                                        </span>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="control-label col-md-2">Tasks</label>
                                <div class="col-md-10">
                                    <div class="mt-repeater">
                                        <div data-repeater-list="tasks">
                                            <div data-repeater-item class="row">
                                                <div class="col-md-9">
                                                    <label class="control-label"> </label>
                                                    <input type="text" class="form-control" name="task" />
                                                </div>
                                                <div class="col-md-1">
                                                    <label class="control-label"> </label>
                                                    <a href="javascript:;" data-repeater-delete class="btn btn-danger">
                                                        <i class="fa fa-close"></i>
                                                    </a>
                                                </div>
                                            </div>
                                        </div>
                                        <hr>
                                        <a href="javascript:;" data-repeater-create
                                            class="btn btn-info mt-repeater-add">
                                            <i class="fa fa-plus"></i> Add task</a>
                                        <br>
                                        <br>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button class="btn default" data-dismiss="modal" aria-hidden="true">Close</button>
                            <button type="submit" class="btn green">Submit</button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
        {{-- End Modal --}}
        <br>

        <div class="row">
            @foreach ($division->deadlines->sortBy('date') as $each)
            <div class="col-md-4">
                <!-- BEGIN SAMPLE FORM PORTLET-->
                <div class="portlet light bordered">
                    <div class="portlet-title">
                        @if ($each)
                        <div class="caption font-red-sunglo">
                            <i class="fa fa-hourglass-end font-red-sunglo"></i>
                            <span class="caption-subject bold">
                                {{DateTime::createFromFormat('Y-m-d', $each->date)->format('d-m-Y')}}</span>
                        </div>
                        <div class="actions">
                            <div class="btn-group">
                                <a class="btn btn-md grey" href="{{'#edit' . $each->id}}" data-toggle="modal">
                                    <i class="fa fa-gear font-lg"></i>
                                </a>
                            </div>
                        </div>
                    </div>
                    <div class="portlet-body form">
                        <form action="{{route('dashboard.event.division.jobs.update', ['event'=>Hashids::connection(\App\Event::class)->encode($event->id),'division'=>Hashids::connection(\App\Division::class)->encode($division->id), 'deadline' => $each->id])}}"
                            method="POST" id="form_sample_3" enctype="multipart/form-data" data-parsley-validate=""
                            class="form-horizontal">
                            @csrf
                            <div class="form-group form-md-checkboxes">
                                <label>{{$division->name}}</label>
                                <div class="md-checkbox-list">
                                    @foreach ($each->jobs as $item)
                                    <div class="md-checkbox">
                                    <input type="checkbox" id="check_{{$item->id}}" name="check_{{$item->id}}"  value="1" {{$item->status == 1 ? 'checked' : ''}} class="md-check">
                                        <label for="check_{{$item->id}}">
                                            <span></span>
                                            <span class="check"></span>
                                            <span class="box"></span>{{$item->name}}</label>
                                    </div>
                                    @endforeach
                                </div>
                            </div>
                            <div>
                                <p style="color:gray">added by Aldi Rahmansyah</p>
                            </div>
                            <div class="form-actions noborder center">
                                <button type="submit" class="btn blue">Submit</button>
                                <button type="button" class="btn default">Cancel</button>
                            </div>
                        </form>
                    </div>
                </div>
                <!-- END SAMPLE FORM PORTLET-->
            </div>

            <div id="{{'edit' . $each->id}}" class="modal fade" role="dialog" aria-labelledby="myModalLabel10"
                aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
                            <h4 class="modal-title">
                                <strong>{{DateTime::createFromFormat('Y-m-d', $each->date)->format('d-m-Y')}}</strong>
                            </h4>
                        </div>
                        <div class="modal-body">
                            <form action="#" class="form-horizontal" role="form">
                                <div class="form-group">
                                    <label class="control-label col-md-2">Date</label>
                                    <div class="col-md-8">
                                        <div class="input-group input-medium date date-picker"
                                            data-date="{{DateTime::createFromFormat('Y-m-d', $each->date)->format('d-m-Y')}}"
                                            data-date-format="dd-mm-yyyy" data-date-viewmode="years">
                                            <input type="text" class="form-control"
                                                value="{{DateTime::createFromFormat('Y-m-d', $each->date)->format('d-m-Y')}}"
                                                readonly>
                                            <span class="input-group-btn">
                                                <button class="btn default" type="button">
                                                    <i class="fa fa-calendar"></i>
                                                </button>
                                            </span>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="control-label col-md-2">Tasks</label>
                                    <div class="col-md-10">
                                        <div class="mt-repeater">
                                            <div data-repeater-list="group-b">
                                                @foreach($each->jobs as $item)
                                                {{-- TODO: update pake id ini --}}
                                                <input name="job_id" type="hidden" value="{{$item->id}}">
                                                <div data-repeater-item class="row">
                                                    <div class="col-md-9">
                                                        <label class="control-label"> </label>
                                                        <input type="text" value="{{$item->name}}"
                                                            class="form-control" /> </div>
                                                    <div class="col-md-1">
                                                        <label class="control-label"> </label>
                                                        <a href="javascript:;" data-repeater-delete
                                                            class="btn btn-danger">
                                                            <i class="fa fa-close"></i>
                                                        </a>
                                                    </div>
                                                </div>
                                                @endforeach
                                            </div>
                                            <hr>
                                            <a href="javascript:;" data-repeater-create
                                                class="btn btn-info mt-repeater-add">
                                                <i class="fa fa-plus"></i> Add task</a>
                                            <br>
                                            <br>
                                        </div>
                                    </div>
                                </div>
                        </div>
                        <div class="modal-footer">
                            <button class="btn default" data-dismiss="modal" aria-hidden="true">Close</button>
                            {{-- TODO: submit edit --}}
                            <button class="btn green">Submit</button>
                        </div>
                    </div>
                    </form>
                </div>
            </div>
            @endforeach
        </div>
    </div>
    <!-- END CONTENT BODY -->

</div>
</div>
@endsection

@section('style')
<!-- BEGIN PAGE LEVEL PLUGINS -->
<link href="{{asset('assets/global/plugins/bootstrap-daterangepicker/daterangepicker.min.css')}}" rel="stylesheet"
    type="text/css" />
<link href="{{asset('assets/global/plugins/bootstrap-datepicker/css/bootstrap-datepicker3.min.css')}}" rel="stylesheet"
    type="text/css" />
<link href="{{asset('assets/global/plugins/bootstrap-timepicker/css/bootstrap-timepicker.min.css')}}" rel="stylesheet"
    type="text/css" />
<link href="{{asset('assets/global/plugins/bootstrap-datetimepicker/css/bootstrap-datetimepicker.min.css')}}"
    rel="stylesheet" type="text/css" />
<link href="{{asset('assets/global/plugins/clockface/css/clockface.css')}}" rel="stylesheet" type="text/css" />
<!-- END PAGE LEVEL PLUGINS -->
@endsection

@section('script')
<!-- BEGIN PAGE LEVEL PLUGINS -->
<script src="{{asset('assets/global/plugins/moment.min.js')}}" type="text/javascript"></script>
<script src="{{asset('assets/global/plugins/bootstrap-daterangepicker/daterangepicker.min.js')}}"
    type="text/javascript"></script>
<script src="{{asset('assets/global/plugins/bootstrap-datepicker/js/bootstrap-datepicker.min.js')}}"
    type="text/javascript"></script>
<script src="{{asset('assets/global/plugins/bootstrap-timepicker/js/bootstrap-timepicker.min.js')}}"
    type="text/javascript"></script>
<script src="{{asset('assets/global/plugins/bootstrap-datetimepicker/js/bootstrap-datetimepicker.min.js')}}"
    type="text/javascript"></script>
<script src="{{asset('assets/global/plugins/clockface/js/clockface.js')}}" type="text/javascript"></script>
<script src="{{asset('assets/global/plugins/jquery-repeater/jquery.repeater.js')}}" type="text/javascript"></script>
<script src="{{asset('assets/global/plugins/bootstrap-datepicker/js/bootstrap-datepicker.min.js')}}"
    type="text/javascript"></script>
<!-- END PAGE LEVEL PLUGINS -->
<!-- BEGIN PAGE LEVEL SCRIPTS -->
<script src="{{asset('assets/pages/scripts/components-date-time-pickers.min.js')}}" type="text/javascript"></script>
<script src="{{asset('assets/pages/scripts/form-repeater.min.js')}}" type="text/javascript"></script>
<!-- END PAGE LEVEL SCRIPTS -->
@endsection
