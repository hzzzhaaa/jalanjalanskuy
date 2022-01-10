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
                    <a href="index-2.html">Attendee</a>
                </li>
            </ul>
        </div>
        <!--  END PAGE BAR -->
        <h1 class="page-title" style="color:steelblue"><strong>Attendee On {{$event->name}}</strong></h1>
        <!-- END PAGE TITLE-->
        <!-- BEGIN EXAMPLE TABLE PORTLET-->
        <div class="portlet box green">
            <div class="portlet-title">
                <div class="caption">
                    <i class="fa fa-globe"></i>Registered Attendee</div>
                <div class="tools"> </div>
            </div>
            <div class="portlet-body">
                <table class="table table-striped table-bordered table-hover" id="sample_2">
                    <thead>
                        <tr>
                            <th> No </th>
                            <th> Nama </th>
                            <th> Email </th>
                            <th> Phone Number </th>
                            <th> Ticket  </th>
                            <th> Booked On </th>
                            <th> Receipt </th>
                            <th> Status </th>
                            <th> Action </th>
                        </tr>
                    </thead>
                    <tbody>
                        @php $i=1 @endphp
                        @foreach($event->tickets as $ticket)
                        @foreach($ticket->users as $user)
                        <tr>
                            <td>{{ $i++ }}</td>
                            <td>{{$user->name}}</td>
                            <td>{{$user->email}}</td>
                            <td>{{$user->phone}}</td>
                            <td>{{$ticket->name}}</td>
                            <td>{{DateTime::createFromFormat('Y-m-d H:i:s', $user->pivot->created_at)->format('d-m-Y H:i:s')}}
                            </td>
                            {{-- TODO: bikin show modal yang nunjukin bukti bayar--}}
                            @if($user->pivot->receipt!= null)
                            <td><a class="label label-medium label-info" data-toggle="modal"
                                    href="{{'#receipt' . $user->pivot->id}}">Transfer Receipt</a></td>
                            @else
                            <td>Waiting for receipt</td>
                            @endif

                            @if($user->getTicketStatus() ==4)
                            <td><span class="label label-medium label-success"> Checked In </span></td>
                            @elseif($user->getTicketStatus() == 3)
                            <td><span class="label label-medium label-success"> Approved </span></td>
                            @elseif($user->getTicketStatus() ==2)
                            <td><span class="label label-medium label-warning"> Waiting for Approval </span></td>
                            @elseif($user->getTicketStatus() == 1)
                            <td><span class="label label-medium label-danger">Waiting for Payment</span></td>
                            @endif
                            <td style="text-align: left">
                                    @if($user->getTicketStatus() != 4)
                                <div class="btn-toolbar">
                                    <button class="btn btn-xs green dropdown-toggle" type="button"
                                        data-toggle="dropdown" aria-expanded="false"> Actions
                                        <i class="fa fa-angle-down"></i>
                                    </button>
                                    {{-- TODO: tambahin alert confirm --}}
                                    <ul class="dropdown-menu pull-left" style="position:relative!important" role="menu">

                                        @if($user->getTicketStatus() < 3) <li>
                                            {!! Form::open(['route'=> ['user.ticket.approve',
                                            'event'=>Hashids::connection(\App\Event::class)->encode($event->id),
                                            'ticket'=>Hashids::connection('ticketuser')->encode($user->pivot->id)],
                                            'style'=>'display:none','method'=>'POST','id'=>'approve'.$user->pivot->id])
                                            !!}
                                            {!! Form::close() !!}
                                            <a
                                                onclick="event.preventDefault();
                                                    document.getElementById('approve' + {{$user->pivot->id}}).submit();">
                                                <i class="icon-docs"></i> Approve Payment </a>
                                            </li>

                                            <li>
                                                {!! Form::open(['route'=> ['user.ticket.decline',
                                                'event'=>Hashids::connection(\App\Event::class)->encode($event->id),
                                                'ticket'=>Hashids::connection('ticketuser')->encode($user->pivot->id)],
                                                'style'=>'display:none','method'=>'POST','id'=>'decline'.$user->pivot->id])
                                                !!}
                                                {!! Form::close() !!}
                                                <a
                                                    onclick="event.preventDefault();
                                                    document.getElementById('decline' + {{$user->pivot->id}}).submit();">
                                                    <i class="icon-docs"></i> Decline Payment </a>
                                            </li>
                                            @endif
                                            @if($user->getTicketStatus() ==3)
                                            <li>
                                                {!! Form::open(['route' =>
                                                ['dashboard.event.checkin.post','event'=>Hashids::connection(\App\Event::class)->encode($event->id)],'method'=>
                                                'POST','style'=>'display:none','id'=>'checkin'.$user->pivot->id]) !!}
                                                {!! Form::hidden('ticketuser', Hashids::connection('ticketuser')->encode($user->pivot->id),['id'=>'hiddenid']) !!}
                                                {!! Form::close() !!}
                                                <a
                                                    onclick="event.preventDefault();
                                                        document.getElementById('checkin' + {{$user->pivot->id}}).submit();">
                                                    <i class="icon-docs"></i> Check In </a>
                                                </li>
                                                @endif
                                            <li>
                                                {!! Form::open(['route'=> ['user.ticket.remove',
                                                'event'=>Hashids::connection(\App\Event::class)->encode($event->id),
                                                'ticket'=>Hashids::connection('ticketuser')->encode($user->pivot->id)],
                                                'style'=>'display:none','method'=>'POST','id'=>'remove'.$user->pivot->id])
                                                !!}
                                                {!! Form::close() !!}
                                                <a
                                                    onclick="event.preventDefault();
                                                    document.getElementById('remove' + {{$user->pivot->id}}).submit();">
                                                    <i class="icon-docs"></i> Remove </a>
                                            </li>
                                        </ul>
                                    </div>
                                    @endif
                            </td>
                        </tr>
                        <div id="{{'receipt' . $user->pivot->id}}" class="modal fade" tabindex="-1" data-width="760">
                            <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
                                <h4 class="modal-title"><b>See Receipt</b></h4>
                            </div>
                            <div class="modal-body">
                                <div class="row">
                                    <div class="col-md-12" style="text-align: center">
                                        <img src="{{asset('storage/upload/' . $user->pivot->receipt)}}" alt="" width="50%">
                                    </div>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" data-dismiss="modal" class="btn btn-outline dark">Close</button>
                            </div>
                        </div>
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
<link href="{{asset('assets/global/plugins/bootstrap-modal/css/bootstrap-modal-bs3patch.css')}}" rel="stylesheet"
    type="text/css" />
<link href="{{asset('assets/global/plugins/bootstrap-modal/css/bootstrap-modal.css')}}" rel="stylesheet"
    type="text/css" />
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
<script src="{{asset('assets/global/plugins/bootstrap-modal/js/bootstrap-modalmanager.js')}}" type="text/javascript">
</script>
<script src="{{asset('assets/global/plugins/bootstrap-modal/js/bootstrap-modal.js')}}" type="text/javascript"></script>
<!-- END PAGE LEVEL PLUGINS -->
<script src="{{asset('assets/pages/scripts/ui-extended-modals.min.js')}}" type="text/javascript"></script>
<!-- BEGIN PAGE LEVEL SCRIPTS -->
<script src="{{asset('assets/pages/scripts/ui-extended-modals.min.js')}}" type="text/javascript"></script>
<script src="{{asset('assets/global/plugins/bootstrap-sweetalert/sweetalert.min.js')}}" type="text/javascript"></script>
<script src="{{asset('assets/pages/scripts/ui-sweetalert.min.js')}}" type="text/javascript"></script>
<!-- END PAGE LEVEL SCRIPTS -->
@endsection
