@extends('dashboard/app')

@section('title')
| {{$event->name}} - Check In
@endsection

@section('content')
<div class="page-content-wrapper">
    <div class="page-content">
            @include('dashboard/partials/_messages')
        {{-- <div class="page-bar">
            <ul class="page-breadcrumb">
                <li>
                    <a href="index-2.html">Event</a>
                    <i class="fa fa-circle"></i>
                </li>
                <li>
                    <a href="index-2.html">Checkin</a>
                </li>
            </ul>
        </div> --}}
        <h1 class="page-title" style="color:steelblue"><strong>Checkin {{$event->name}}</strong></h1>
        <div style="text-align:center">
            <a data-toggle="modal" href="#scan" onClick="jbScanner.resumeScanning()" class="btn btn-lg green"><i
                    class="icon-camera"></i> Scan QR Code</a>
        </div>
        <br>

        <div class="portlet box green">
            <div class="portlet-title">
            <div class="caption">
                    <i class="fa fa-globe"></i>Attendee</div>
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
                            <th> Ticket </th>
                            <th> Checkin On </th>
                        </tr>
                    </thead>
                    <tbody>
                        @php $i=1 @endphp
                        @foreach($event->tickets as $ticket)
                        @foreach ($ticket->users()->wherePivot('checkin',1)->get() as $user)
                        <tr>
                            <td>{{ $i++ }}</td>
                            <td>{{$user->name}}</td>
                            <td>{{$user->email}}</td>
                            <td>{{$user->phone}}</td>
                            <td>{{$ticket->name}}</td>
                            <td>{{DateTime::createFromFormat('Y-m-d H:i:s', $user->pivot->updated_at)->format('H:i:s')}}
                            </td>
                        </tr>
                        @endforeach
                        @endforeach
                    </tbody>
                </table>

                <!-- responsive -->
                <div id="scan" class="modal fade" tabindex="-1" data-width="760">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
                        <h4 class="modal-title"><b>Scan QR Code</b></h4>
                    </div>
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-md-12" style="text-align: center">
                                {!! Form::open(['route' =>
                                ['dashboard.event.checkin.post','event'=>Hashids::connection(\App\Event::class)->encode($event->id)],'method'=>
                                'POST','style'=>'display:none','id'=>'scanForm']) !!}
                                {!! Form::hidden('ticketuser', null,['id'=>'hiddenid']) !!}
                                {!! Form::close() !!}
                                <div id="scanner"></div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" data-dismiss="modal" class="btn btn-outline dark">Close</button>
                    </div>
                </div>
                <!--End Modal-->

            </div>
        </div>
    </div>
</div>
@endsection

@section('style')
<link href="{{asset('assets/global/plugins/bootstrap-modal/css/bootstrap-modal-bs3patch.css')}}" rel="stylesheet"
    type="text/css" />
<link href="{{asset('assets/global/plugins/bootstrap-modal/css/bootstrap-modal.css')}}" rel="stylesheet"
    type="text/css" />
<link href="{{asset('assets/global/plugins/bootstrap-sweetalert/sweetalert.css')}}" rel="stylesheet" type="text/css" />
<link href="{{asset('assets/global/plugins/datatables/datatables.min.css')}}" rel="stylesheet" type="text/css" />
<link href="{{asset('assets/global/plugins/datatables/plugins/bootstrap/datatables.bootstrap.css')}}" rel="stylesheet"
    type="text/css" />
<link rel="stylesheet" href="{{asset('sweetalert2/sweetalert2.min.css')}}">
<style>
.qrPreviewVideo {
    max-width:100%;
    max-height:100%;
}</style>
@endsection

@section('script')
<!-- BEGIN PAGE LEVEL PLUGINS -->
<script src="{{asset('assets/global/plugins/bootstrap-modal/js/bootstrap-modalmanager.js')}}" type="text/javascript">
</script>
<script src="{{asset('assets/global/plugins/bootstrap-modal/js/bootstrap-modal.js')}}" type="text/javascript"></script>
<!-- END PAGE LEVEL PLUGINS -->
<script src="{{asset('assets/pages/scripts/ui-extended-modals.min.js')}}" type="text/javascript"></script>
<!-- BEGIN PAGE LEVEL SCRIPTS -->
<script src="{{asset('assets/pages/scripts/ui-extended-modals.min.js')}}" type="text/javascript"></script>
{{-- <script src="{{asset('assets/global/plugins/bootstrap-sweetalert/sweetalert.min.js')}}" type="text/javascript">
</script> --}}
{{-- <script src="{{asset('assets/pages/scripts/ui-sweetalert.min.js')}}" type="text/javascript"></script> --}}
<script src="{{asset('assets/global/scripts/datatable.js')}}" type="text/javascript"></script>
<script src="{{asset('assets/global/plugins/datatables/datatables.min.js')}}" type="text/javascript"></script>
<script src="{{asset('assets/global/plugins/datatables/plugins/bootstrap/datatables.bootstrap.js')}}" type="text/javascript">
</script>
<script src="{{asset('assets/pages/scripts/table-datatables-buttons.min.js')}}" type="text/javascript"></script>
<script src="{{asset('sweetalert2/sweetalert2.all.min.js')}}" type="text/javascript"></script>
<!-- END PAGE LEVEL SCRIPTS -->
<script type="text/javascript" src="{{asset('js/qrscanner/jsqrscanner.nocache.js')}}"></script>
<script type="text/javascript">
    function onQRCodeScanned(scannedText) {
        $('#scan .close').click();

        Swal.fire({
            title: 'Checkin',
            text: scannedText,
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Checkin!'
        }).then((result) => {
            if (result.value) {
                $('#hiddenid').val(scannedText);
                $('#scanForm').submit()
            }
        });

        ;
        console.log('scanned');
        jbScanner.stopScanning();
    }



    function provideVideo() {
        var n = navigator;

        if (n.mediaDevices && n.mediaDevices.getUserMedia) {
            return n.mediaDevices.getUserMedia({
                video: {
                    facingMode: "environment"
                },
                audio: false
            });
        }

        return Promise.reject('Your browser does not support getUserMedia');
    }

    //funtion returning a promise with a video stream
    function provideVideoQQ() {
        return navigator.mediaDevices.enumerateDevices()
            .then(function (devices) {
                var exCameras = [];
                devices.forEach(function (device) {
                    if (device.kind === 'videoinput') {
                        exCameras.push(device.deviceId)
                    }
                });

                return Promise.resolve(exCameras);
            }).then(function (ids) {
                if (ids.length === 0) {
                    return Promise.reject('Could not find a webcam');
                }

                return navigator.mediaDevices.getUserMedia({
                    video: {
                        'optional': [{
                            'sourceId': ids.length === 1 ? ids[0] : ids[
                                1] //this way QQ browser opens the rear camera
                        }]
                    }
                });
            });
    }

    //this function will be called when JsQRScanner is ready to use
    var jbScanner;

    function JsQRScannerReady() {
        //create a new scanner passing to it a callback function that will be invoked when
        //the scanner succesfully scan a QR code
        jbScanner = new JsQRScanner(onQRCodeScanned, provideVideo);
        //reduce the size of analyzed images to increase performance on mobile devices
        jbScanner.setSnapImageMaxSize(300);
        var scannerParentElement = document.getElementById("scanner");
        if (scannerParentElement) {
            //append the jbScanner to an existing DOM element
            jbScanner.appendTo(scannerParentElement);
        }
    }

</script>
@endsection
