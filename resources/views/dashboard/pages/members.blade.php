@extends('dashboard/app')

@section('content')
@php
$user = Auth::user()
@endphp
<div class="page-content-wrapper">
    <!-- BEGIN CONTENT BODY -->
    <div class="page-content">
            @include('dashboard/partials/_messages')
        <!-- BEGIN PAGE HEADER-->
        <!--  BEGIN PAGE BAR -->

        <!--  END PAGE BAR -->
        <!-- BEGIN PAGE TITLE-->
        <h1 class="page-title"> {{$user->organizer->name}} Members
            {{-- <small>blank page layout</small> --}}
        </h1>
        <!-- END PAGE TITLE-->
        <!-- END PAGE HEADER-->

        <div class="row">
            <div class="col-md-12">
                <!-- BEGIN EXAMPLE TABLE PORTLET-->
                <div class="portlet light bordered">

                    <div class="portlet-body">
                        <div class="table-toolbar">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="btn-group">
                                        <a id="sample_editable_1_new" href="#responsive" data-toggle="modal"
                                            class="btn sbold green"> Invite New Member
                                            <i class="fa fa-plus"></i>
                                        </a>
                                    </div>
                                </div>

                            </div>
                        </div>
                        <table class="table table-striped table-bordered table-hover table-checkable order-column"
                            id="memberTable">
                            <thead>
                                <tr>
                                    <th> No </th>
                                    <th> Name </th>
                                    <th> Email </th>
                                    <th> Status </th>
                                    @if(Auth::user()->isOrganizerAdmin())
                                    <th> Actions </th>
                                    @endif
                                </tr>
                            </thead>
                            <tbody>
                                @php
                                $i = 1;
                                @endphp
                                {{-- TODO: Member Table--}}
                                @foreach ($members as $member)
                                <tr class="odd gradeX">
                                    <td>{{$i}}</td>
                                    <td> {{$member->name}} </td>
                                    <td>
                                        <a> {{$member->email}} </a>
                                    </td>
                                    <td>

                                        @if($member->isOrganizerAdmin())
                                        <span class="label label-sm label-success">
                                            Admin
                                        </span>
                                        @elseif($member->isMemberOf($user->organizer_id))
                                        <span class="label label-sm label-primary">
                                            Member
                                        </span>
                                        @elseif($member->isInvitedBy($user->organizer_id))
                                        <span class="label label-sm label-danger">
                                            Inviting
                                        </span>
                                        @endif

                                    </td>
                                    @if(Auth::user()->isOrganizerAdmin())
                                    <td>
                                        <div class="btn-toolbar">
                                            <button class="btn btn-xs green dropdown-toggle" type="button"
                                                data-toggle="dropdown" aria-expanded="false"> Actions
                                                <i class="fa fa-angle-down"></i>
                                            </button>
                                            {{-- TODO: tambahin alert confirm --}}
                                            <ul class="dropdown-menu pull-left" role="menu" style="position: relative!important">
                                                @if($member->isOrganizerAdmin())
                                                <li>
                                                    {!! Form::open(['route'=> ['revoke.admin','user'=> Hashids::connection(\App\User::class)->encode($member->id)], 'style'=>'display:none','method'=>'POST','id'=>'revoke'.$member->id]) !!}
                                                    {!! Form::close() !!}
                                                    <a onclick="event.preventDefault();
                                                    document.getElementById('revoke' + {{$member->id}}).submit();">
                                                        <i class="icon-docs"></i> Revoke Admin </a>
                                                </li>
                                                @elseif($member->isMemberOf($user->organizer->id))
                                                <li>
                                                    {!! Form::open(['route'=> ['set.admin','user'=> Hashids::connection(\App\User::class)->encode($member->id)], 'style'=>'display:none','method'=>'POST','id'=>'set'.$member->id]) !!}
                                                    {!! Form::close() !!}
                                                    <a onclick="event.preventDefault();
                                                    document.getElementById('set' + {{$member->id}}).submit();">
                                                        <i class="icon-star"></i> Set as Admin </a>
                                                </li>
                                                @endif
                                                <li>
                                                        {!! Form::open(['route'=> ['kick','user'=> Hashids::connection(\App\User::class)->encode($member->id)], 'style'=>'display:none','method'=>'POST','id'=>'kick'.$member->id]) !!}
                                                        {!! Form::close() !!}
                                                <a onclick="event.preventDefault();
                                                document.getElementById('kick' + {{$member->id}}).submit();">
                                                        <i class="icon-close"></i> Kick </a>
                                                </li>
                                                {{-- <li class="divider"> </li>
                                                <li>
                                                    <a href="javascript:;">
                                                        <i class="icon-flag"></i> Comments
                                                        <span class="badge badge-success">4</span>
                                                    </a>
                                                </li> --}}
                                            </ul>
                                        </div>
                                    </td>
                                    @endif
                                </tr>
                                @php
                                $i++;
                                @endphp
                                @endforeach


                            </tbody>
                        </table>
                    </div>
                </div>
                <!-- END EXAMPLE TABLE PORTLET-->

            </div>


        </div>
        <div id="responsive" class="modal fade" tabindex="-1" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
                        <h4 class="modal-title">Invite to {{Auth::user()->organizer->name}}</h4>
                    </div>
                    {!! Form::open(['route' => 'members.invite', 'data-parsley-validate'=> '']) !!}
                    <div class="modal-body">
                        <div class="scroller" style="height:100%" data-always-visible="1" data-rail-visible1="1">
                            <div class="row">
                                <div class="col-md-12">
                                    <p>
                                        {!! Form::label('email', 'Email Address') !!}
                                        {!! Form::email('email', null, ['class' => 'form-control', 'required' => '',
                                        'type'=>'email']) !!}
                                    </p>
                                </div>

                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" data-dismiss="modal" class="btn dark btn-outline">Close</button>
                        {!! Form::submit('Invite', ['class'=> 'btn green']) !!}
                        {!! Form::close() !!}
                    </div>
                </div>
            </div>
        </div>
        {{-- <div class="modal fade" id="basic" tabindex="-1" role="basic" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
                        <h4 class="modal-title">Invite to Organizer</h4>
                    </div>
                    <div class="modal-body">
                            {!! Form::open(['route' => 'members.invite', 'data-parsley-validate'=> '']) !!}

                            {!! Form::label('email', 'Email Address') !!}

                            {!! Form::email('email', null, ['class' => 'form-control', 'required' => '', 'type'=>'email']) !!}

                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn dark btn-outline" data-dismiss="modal">Close</button>
                        {{ Form::submit('Invite', array('class' => 'btn green'))}}
        {!! Form::close() !!}

    </div>
</div>
<!-- /.modal-content -->
</div>
<!-- /.modal-dialog --> --}}
</div>

</div>
</div>
</div>
{{-- <div class="note note-Member">
                <p> A black page template with a minimal dependency assets to use as a base for any custom page you create </p>
            </div> --}}
</div>
<!-- END CONTENT BODY -->
</div>
@endsection


@section('style')
<link href="{{asset('assets/global/plugins/datatables/datatables.min.css')}}" rel="stylesheet" type="text/css" />
<link href="{{asset('assets/global/plugins/datatables/plugins/bootstrap/datatables.bootstrap.css')}}" rel="stylesheet"
    type="text/css" />
<link rel="stylesheet" href="{{asset('css/parsley.css')}}">
@endsection


@section('script')
<script src="{{asset('assets/global/plugins/jquery-ui/jquery-ui.min.js')}}" type="text/javascript"></script>
<script src="{{asset('assets/pages/scripts/ui-modals.min.js')}}" type="text/javascript"></script>
<script src="{{asset('assets/pages/scripts/table-datatables-managed.min.js')}}" type="text/javascript"></script>
<script src="{{asset('assets/global/scripts/datatable.js')}}" type="text/javascript"></script>
<script src="{{asset('assets/global/plugins/datatables/datatables.min.js')}}" type="text/javascript"></script>
<script src="{{asset('assets/global/plugins/datatables/plugins/bootstrap/datatables.bootstrap.js')}}"
    type="text/javascript"></script>
<script src="{{asset('js/parsley.js')}}"></script>

<script>
    $(document).ready(function () {

        $('#memberTable').DataTable();
    })

</script>
@endsection
