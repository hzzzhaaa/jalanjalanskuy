@extends('dashboard/app')

@section('title')
| {{$event->name}} - Attendee
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
                    <a href="index-2.html">Event</a>
                    <i class="fa fa-circle"></i>
                </li>
                <li>
                    <a href="index-2.html">Feedback</a>
                </li>
            </ul>
        </div>
        <!--  END PAGE BAR -->
        <h1 class="page-title" style="color:steelblue"><strong>Feedback On {{$event->name}}</strong></h1>
        <!-- END PAGE TITLE-->
        <!-- BEGIN EXAMPLE TABLE PORTLET-->
        <div class="portlet box green">
            <div class="portlet-title">
                <div class="caption">
                    <i class="fa fa-globe"></i>Attendee Feedback</div>
                <div class="tools"> </div>
            </div>
            <div class="portlet-body">
                <table class="table table-striped table-bordered table-hover" id="datatable">
                    <thead>
                        <tr>
                            <th> No </th>
                            <th> Nama </th>
                            <th> Feedback </th>
                            <th> Rating </th>
                        </tr>
                    </thead>
                    <tbody>
                        @php $i=1 @endphp
                        @foreach($event->tickets as $ticket)
                        @foreach($ticket->users()->wherePivot('feedback','!=',null)->get() as $user)
                        <tr>
                            <td>{{ $i++ }}</td>
                            <td>{{$user->name}}</td>
                            <td>{{$user->pivot->feedback}}</td>
                            <td>@for ($x=0;$x<$user->pivot->rating;$x++)
                                    *
                            @endfor</td>
                        </tr>
                        @endforeach
                        @endforeach
                    </tbody>
                </table>
                <!-- responsive -->

                    <!--End Modal-->
            </div>
        </div>
        <!-- END EXAMPLE TABLE PORTLET-->
    </div>
    <!-- END CONTENT BODY -->
</div>
@endsection

@section('style')
<link href="{{asset('assets/global/plugins/bootstrap-modal/css/bootstrap-modal-bs3patch.css')}}" rel="stylesheet" type="text/css" />
<link href="{{asset('assets/global/plugins/bootstrap-modal/css/bootstrap-modal.css')}}" rel="stylesheet" type="text/css" />
<link href="{{asset('assets/global/plugins/bootstrap-sweetalert/sweetalert.css')}}" rel="stylesheet" type="text/css" />
@endsection

@section('script')
<!-- BEGIN PAGE LEVEL PLUGINS -->
<script src="{{asset('assets/global/scripts/datatable.js')}}" type="text/javascript"></script>
<script src="{{asset('assets/global/plugins/datatables/datatables.min.js')}}" type="text/javascript"></script>
<script src="{{asset('assets/global/plugins/datatables/plugins/bootstrap/datatables.bootstrap.js')}}"
    type="text/javascript"></script>
<script src="{{asset('assets/global/plugins/bootstrap-datepicker/js/bootstrap-datepicker.min.js')}}"
    type="text/javascript"></script>
<!-- END PAGE LEVEL PLUGINS -->
<script src="{{asset('assets/pages/scripts/table-datatables-buttons.min.js')}}" type="text/javascript"></script>
<!-- BEGIN PAGE LEVEL PLUGINS -->
<script src="{{asset('assets/global/plugins/bootstrap-modal/js/bootstrap-modalmanager.js')}}" type="text/javascript"></script>
<script src="{{asset('assets/global/plugins/bootstrap-modal/js/bootstrap-modal.js')}}" type="text/javascript"></script>
<!-- END PAGE LEVEL PLUGINS -->
<script src="{{asset('assets/pages/scripts/ui-extended-modals.min.js')}}" type="text/javascript"></script>
<!-- BEGIN PAGE LEVEL SCRIPTS -->
<script src="{{asset('assets/pages/scripts/ui-extended-modals.min.js')}}" type="text/javascript"></script>
<script src="{{asset('assets/global/plugins/bootstrap-sweetalert/sweetalert.min.js')}}" type="text/javascript"></script>
<script src="{{asset('assets/pages/scripts/ui-sweetalert.min.js')}}" type="text/javascript"></script>
<!-- END PAGE LEVEL SCRIPTS -->

<script>
$(document).ready(function() {
    var datatable = $('#datatable').dataTable({
        // dom: 'frtip',
        autoWidth:false,
        columnDefs: [
            {"width":"5%", "targets":0},
            {"width":"20%", "targets":1},
            {"width":"100%", "targets":2}
        ]
    });

    datatable.columns.adjust().draw();
});</script>
@endsection
