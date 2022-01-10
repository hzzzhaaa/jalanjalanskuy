@extends('dashboard/app')

@section('title')
| Create Event
@endsection

@section('content')
<div class="page-content-wrapper">
    <!-- BEGIN CONTENT BODY -->
    <div class="page-content">
        @include('dashboard/partials/_messages')
        <!-- BEGIN PAGE HEADER-->
        <!--  BEGIN PAGE BAR -->
        <div class="page-bar">
            <ul class="page-breadcrumb">
                <li>
                    <a href="index-2.html">Home</a>
                    <i class="fa fa-circle"></i>
                </li>
                <li>
                    <a href="#">Create Event</a>
                </li>
            </ul>
        </div>
        <!--  END PAGE BAR -->
        <!-- END PAGE HEADER-->
        <div class="row">
            <div class="col-md-12 col-xl-10">
                <!-- BEGIN VALIDATION STATES-->
                <div class="portlet light portlet-fit portlet-form bordered">
                    <div class="portlet-title">
                        <div class="caption">
                            {{-- <i class="icon-settings font-dark"></i> --}}
                            <span class="caption-subject font-dark sbold uppercase">Create New Event</span>
                        </div>
                        {{-- <div class="actions">
                                    <div class="btn-group btn-group-devided" data-toggle="buttons">
                                        <label class="btn btn-transparent dark btn-outline btn-circle btn-sm active">
                                            <input type="radio" name="options" class="toggle" id="option1">Edit</label>
                                        <label class="btn btn-transparent dark btn-outline btn-circle btn-sm">
                                            <input type="radio" name="options" class="toggle" id="option2">Preview</label>
                                    </div>
                            </div> --}}
                    </div>
                    <div class="portlet-body">
                        <!-- BEGIN FORM-->
                        <form action="{{route('dashboard.event.store')}}" method="POST" id="form_sample_3" enctype="multipart/form-data"
                            data-parsley-validate="" class="form-horizontal">
                            {{csrf_field()}}
                            <div class="form-body">
                                <div class="form-group">
                                    <label class="control-label col-md-2">Event Title
                                        <span class="required"> * </span>
                                    </label>
                                    <div class="col-md-7">
                                        <input type="text" name="name" required="" class="form-control" /> </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-md-2 control-label">Location
                                        <span class="required"> * </span>
                                    </label>
                                    <div class="col-md-7">
                                        <input type="text" name="location" required="" class="form-control">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="control-label col-md-2">Date
                                        <span class="required"> * </span>
                                    </label>
                                    <div class="col-md-3">
                                        <div class="input-group date date-picker" data-date-format="dd-mm-yyyy"
                                            data-date-start-date="+0d">
                                            <input type="text" name="date" class="form-control" required="">
                                            <span class="input-group-btn">
                                                <button class="btn default" type="button">
                                                    <i class="fa fa-calendar"></i>
                                                </button>
                                            </span>
                                        </div>
                                    </div>

                                </div>
                                <div class="form-group">
                                    <label class="col-md-2 control-label">Start
                                        <span class="required"> * </span>
                                    </label>
                                    <div class="col-md-3">
                                        <div class="input-group">
                                            <input type="text" required="" name="timeStart"
                                                class="form-control timepicker timepicker-24">
                                            <span class="input-group-btn">
                                                <button class="btn default" type="button">
                                                    <i class="fa fa-clock-o"></i>
                                                </button>
                                            </span>
                                        </div>
                                    </div>
                                    {{-- <label class="control-label col-md-2">End</label>
                                        <div class="col-md-3">
                                            <div class="input-group date date-picker" data-date-format="dd-mm-yyyy">
                                                <input type="text" class="form-control"  name="datepicker">
                                                <span class="input-group-btn">
                                                    <button class="btn default" type="button">
                                                        <i class="fa fa-calendar"></i>
                                                    </button>
                                                </span>
                                            </div>
                                        </div> --}}
                                    <label class="col-md-1 control-label">End
                                    </label>
                                    <div class="col-md-3">
                                        <div class="input-group">
                                            <input type="text" value="" name="timeEnd" class="form-control timepicker timepicker-24">
                                            <span class="input-group-btn">
                                                <button class="btn default" type="button">
                                                    <i class="fa fa-clock-o"></i>
                                                </button>
                                            </span>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-md-2 control-label">Event Image
                                        <span class="required"> * </span>
                                    </label>
                                    <div class="col-md-4">
                                        <div class="fileinput fileinput-new" data-provides="fileinput">
                                            <div class="input-group input-large">
                                                <div class="form-control uneditable-input input-fixed input-medium"
                                                    data-trigger="fileinput">
                                                    <i class="fa fa-file fileinput-exists"></i>&nbsp;
                                                    <span class="fileinput-filename"> </span>
                                                </div>
                                                <span class="input-group-addon btn default btn-file">
                                                    <span class="fileinput-new"> Select file </span>
                                                    <span class="fileinput-exists"> Change </span>
                                                    <input type="file" required name="image"> </span>
                                                <a href="javascript:;"
                                                    class="input-group-addon btn red fileinput-exists"
                                                    data-dismiss="fileinput"> Remove </a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="control-label col-md-2">Event Description
                                        <span class="required"> * </span>
                                    </label>
                                    <div class="col-md-9">
                                        <textarea name="description" data-provide="markdown" rows="10" required
                                            data-error-container="#editor_error"></textarea>
                                        <div id="editor_error"> </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-md-2 control-label">Payment Method</label>
                                    <div class="col-md-9">
                                        <div class="mt-repeater">
                                            <div data-repeater-list="payment">
                                                <div data-repeater-item class="row">
                                                    <div class="col-md-2">
                                                        <label class="control-label">Bank</label>
                                                        <input type="text" class="form-control" name="bank" /> </div>
                                                    <div class="col-md-3">
                                                        <label class="control-label">Account Name</label>
                                                        <input type="text" class="form-control" name="bankAccountName"/> </div>
                                                     <div class="col-md-4">
                                                        <label class="control-label">Number</label>
                                                        <input type="text" class="form-control" name="bankAccountNumber"/> </div>
                                                    <div class="col-md-1">
                                                        <label class="control-label">&nbsp;</label>
                                                        <a href="javascript:;" class="btn btn-danger" data-repeater-delete><i class="fa fa-close"></i>
                                                        </a>
                                                    </div>
                                                </div>
                                            </div>
                                            <hr>
                                            <a href="javascript:;" data-repeater-create class="btn btn-info mt-repeater-add">
                                                <i class="fa fa-plus"></i> Add More</a>
                                            <br>
                                            <br> </div>
                                    </div>
                                </div>
                                {{-- <div class="form-group">
                                            <label class="control-label col-md-2">Event Type
                                                <span class="required"> * </span>
                                            </label>
                                            <div class="col-md-4">
                                                <select class="form-control select2me" name="options2">
                                                    <option value="">Select the type of the event</option>
                                                    <option value="Option 1">Appearance or Signing</option>
                                                    <option value="Option 2">Attraction</option>
                                                    <option value="Option 3">Camp, Trip, or Retreat</option>
                                                    <option value="Option 4">Class, Training, or Workshop</option>
                                                    <option value="Option 5">Concert or Performance</option>
                                                    <option value="Option 6">Conference</option>
                                                    <option value="Option 7">Convention</option>
                                                    <option value="Option 8">Dinner or Gala</option>
                                                    <option value="Option 9">Festival or Fair</option>
                                                    <option value="Option 10">Game or Competition</option>
                                                    <option value="Option 11">Meeting or Networking Event</option>
                                                    <option value="Option 12">Party or Social Gathering</option>
                                                    <option value="Option 13">Race or Endurance Event</option>
                                                    <option value="Option 14">Seminar or Talk</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="control-label col-md-2">Event Topic
                                                <span class="required"> * </span>
                                            </label>
                                            <div class="col-md-4">
                                                <select class="form-control select2me" name="options2">
                                                    <option value="">Select...</option>
                                                    <option value="Option 1">Business</option>
                                                    <option value="Option 2">Technology</option>
                                                    <option value="Option 3">Family</option>
                                                    <option value="Option 4">Music</option>
                                                </select>
                                            </div>
                                        </div> --}}
                            </div>
                            <div class="form-actions">
                                <div class="row" style="text-align:center;">
                                    <div class="col-md-offset-1 col-md-9">
                                        <button type="submit" class="btn green">Submit</button>
                                    </div>
                                </div>
                            </div>
                        </form>
                        <!-- END FORM-->
                    </div>
                    <!-- END VALIDATION STATES-->
                </div>
            </div>
        </div>
    </div>
</div>
<!-- END CONTENT BODY -->
</div>
@endsection



@section('style')
<link href="{{asset('assets/global/plugins/select2/css/select2.min.css')}}" rel="stylesheet" type="text/css" />
<link href="{{asset('assets/global/plugins/select2/css/select2-bootstrap.min.css')}}" rel="stylesheet"
    type="text/css" />
<link href="{{asset('assets/global/plugins/bootstrap-datepicker/css/bootstrap-datepicker3.min.css')}}" rel="stylesheet"
    type="text/css" />
<link href="{{asset('assets/global/plugins/bootstrap-datepicker/css/bootstrap-datepicker3.min.css')}}" rel="stylesheet"
    type="text/css" />
<link href="{{asset('assets/global/plugins/bootstrap-wysihtml5/bootstrap-wysihtml5.css')}}" rel="stylesheet"
    type="text/css" />
<link href="{{asset('assets/global/plugins/bootstrap-markdown/css/bootstrap-markdown.min.css')}}" rel="stylesheet"
    type="text/css" />
<link href="{{asset('assets/global/plugins/bootstrap-fileinput/bootstrap-fileinput.css')}}" rel="stylesheet"
    type="text/css" />
<link href="{{asset('assets/pages/css/profile.min.css')}}" rel="stylesheet" type="text/css" />
<link href="{{asset('assets/global/plugins/bootstrap-timepicker/css/bootstrap-timepicker.min.css')}}" rel="stylesheet"
    type="text/css" />
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
<!-- BEGIN THEME GLOBAL STYLES -->
<link href="{{asset('assets/global/css/components.min.css')}}" rel="stylesheet" id="style_components" type="text/css" />
<link href="{{asset('assets/global/css/plugins.min.css')}}" rel="stylesheet" type="text/css" />
<!-- END THEME GLOBAL STYLES -->
<!-- BEGIN THEME LAYOUT STYLES -->
<link href="{{asset('assets/layouts/layout/css/layout.min.css')}}" rel="stylesheet" type="text/css" />
<link href="{{asset('assets/layouts/layout/css/themes/darkblue.min.css')}}" rel="stylesheet" type="text/css"
    id="style_color" />
<link href="{{asset('assets/layouts/layout/css/custom.min.css')}}" rel="stylesheet" type="text/css" />
<link href="{{asset('assets/global/plugins/bootstrap-fileinput/bootstrap-fileinput.css')}}" rel="stylesheet"
    type="text/css" />
@endsection

@section('script')
<!-- BEGIN PAGE LEVEL PLUGINS -->
<script src="{{asset('assets/global/plugins/select2/js/select2.full.min.js')}}" type="text/javascript"></script>
<script src="{{asset('assets/global/plugins/jquery-validation/js/jquery.validate.min.js')}}" type="text/javascript">
</script>
<script src="{{asset('assets/global/plugins/jquery-validation/js/additional-methods.min.js')}}" type="text/javascript">
</script>
<script src="{{asset('assets/global/plugins/bootstrap-datepicker/js/bootstrap-datepicker.min.js')}}"
    type="text/javascript"></script>
<script src="{{asset('assets/global/plugins/bootstrap-wysihtml5/wysihtml5-0.3.0.js')}}" type="text/javascript"></script>
<script src="{{asset('assets/global/plugins/bootstrap-wysihtml5/bootstrap-wysihtml5.js')}}" type="text/javascript">
</script>
<script src="{{asset('assets/global/plugins/ckeditor/ckeditor.js')}}" type="text/javascript"></script>
<script src="{{asset('assets/global/plugins/bootstrap-markdown/lib/markdown.js')}}" type="text/javascript"></script>
<script src="{{asset('assets/global/plugins/bootstrap-markdown/js/bootstrap-markdown.js')}}" type="text/javascript">
</script>
<script src="{{asset('assets/global/plugins/bootstrap-timepicker/js/bootstrap-timepicker.min.js')}}"
    type="text/javascript"></script>
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
<script src="{{asset('assets/pages/scripts/components-date-time-pickers.min.js')}}" type="text/javascript"></script>
<script src="{{asset('assets/global/plugins/bootstrap-fileinput/bootstrap-fileinput.js')}}" type="text/javascript">
</script>
<script src="{{asset('assets/global/plugins/jquery-repeater/jquery.repeater.js')}}" type="text/javascript"></script>
<script src="{{asset('assets/global/plugins/bootstrap-datepicker/js/bootstrap-datepicker.min.js')}}" type="text/javascript"></script>
<script src="{{asset('assets/pages/scripts/form-repeater.min.js')}}" type="text/javascript"></script>
<script src="{{asset('assets/pages/scripts/components-date-time-pickers.min.js')}}" type="text/javascript"></script>
@endsection
