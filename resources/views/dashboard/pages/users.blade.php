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
        <h1 class="page-title"> Users
            {{-- <small>blank page layout</small> --}}
        </h1>
        <!-- END PAGE TITLE-->
        <!-- END PAGE HEADER-->

        <div class="row">
            <div class="col-md-12">
                <!-- BEGIN EXAMPLE TABLE PORTLET-->
                <div class="portlet light bordered">

                    <div class="portlet-body">
                        {{-- <div class="table-toolbar">
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
                        </div> --}}
                        <table class="table table-striped table-bordered table-hover table-checkable order-column"
                            id="memberTable">
                            <thead>
                                <tr>
                                    <th> No </th>
                                    <th> Name </th>
                                    <th> Email </th>
                                    <th> Phone </th>
                                    <th> Organizer </th>
                                    <th> Actions </th>

                                </tr>
                            </thead>
                            <tbody>
                                @php
                                $i = 1;
                                @endphp
                                {{-- TODO: Member Table--}}
                                @foreach ($users as $user)
                                <tr class="odd gradeX">
                                    <td>{{$i}}</td>
                                    <td> {{$user->name}} </td>
                                    <td>
                                        <a> {{$user->email}} </a>
                                    </td>
                                    <td>
                                        <a> {{$user->phone}} </a>
                                    </td>
                                    @if($user->organizer != null)
                                    <td>
                                        <a> {{$user->organizer->name}} </a>
                                    </td>
                                    @else
                                    <td></td>
                                    @endif
                                    <td>
                                        <div class="btn-group">
                                            <button class="btn btn-xs green dropdown-toggle" type="button"
                                                data-toggle="dropdown" aria-expanded="false"> Actions
                                                <i class="fa fa-angle-down"></i>
                                            </button>
                                            <ul class="dropdown-menu pull-left" role="menu">
                                                <li>
                                                    {!! Form::open(['route'=> ['delete.user','user'=>
                                                    Hashids::connection(\App\User::class)->encode($user->id)],
                                                    'style'=>'display:none','method'=>'POST','id'=>'delete'.$user->id])
                                                    !!}
                                                    {!! Form::close() !!}
                                                    <a
                                                        onclick="event.preventDefault();
                                                            document.getElementById('delete' + {{$user->id}}).submit();">
                                                        <i class="icon-docs"></i> Delete User </a>
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
