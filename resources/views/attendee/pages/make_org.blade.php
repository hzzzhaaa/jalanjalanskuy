@extends('attendee/partials/app')

@section('title')
| Create Organization
@endsection

@section('style')
<link href="{{asset('assets/global/plugins/bootstrap-markdown/css/bootstrap-markdown.min.css')}}" rel="stylesheet" type="text/css" />
@endsection

@section('content')
<div class="page-wrapper-row full-height">
    <div class="page-wrapper-middle">
        <!-- BEGIN CONTAINER -->
        <div class="page-container">
            <!-- BEGIN CONTENT -->
            <div class="page-content-wrapper">
                <!-- BEGIN CONTENT BODY -->
                <!-- BEGIN PAGE HEAD-->
                <div class="page-head">
                    <div class="container">
                        <!-- BEGIN PAGE TITLE -->
                        <div class="page-title">
                            <h1>Organization
                            </h1>
                        </div>
                        <!-- END PAGE TITLE -->
                    </div>
                </div>
                <!-- END PAGE HEAD-->
                <!-- BEGIN PAGE CONTENT BODY -->
                <div class="page-content">
                    <div class="container">
                        <!-- BEGIN PAGE BREADCRUMBS -->
                        <ul class="page-breadcrumb breadcrumb">
                            <li>
                                <a href="index-2.html">Home</a>
                                <i class="fa fa-circle"></i>
                            </li>
                            <li>
                                <a href="#">Organization Dashboard</a>
                                <i class="fa fa-circle"></i>
                            </li>
                            <li>
                                <span>Create Organization</span>
                            </li>
                        </ul>
                <!-- END PAGE BREADCRUMBS -->
                        <div class="col-md-12">
                            <!-- BEGIN EXTRAS PORTLET-->
                            <div class="portlet light form-fit ">
                                <div class="portlet-title">
                                    <div class="caption">
                                        <i class="icon-settings font-dark"></i>
                                        <span class="caption-subject font-dark sbold uppercase">Create New Organization</span>
                                    </div>
                                </div>
                                <div class="portlet-body form">
                                    <!-- BEGIN FORM-->
                                    <form method="POST" action="{{route('organizer.store')}}" enctype="multipart/form-data" class="form-horizontal form-bordered">
                                        @csrf
                                        <div class="form-body">
                                            <div class="form-group">
                                                <label class="control-label col-md-2">Name</label>
                                                <div class="col-md-10">
                                                    <textarea class="wysihtml5 form-control" rows="1" type="text" name="name" id="name"></textarea>
                                                </div>
                                            </div>
                                            <div class="form-group last">
                                                <label class="control-label col-md-2">Description</label>
                                                <div class="col-md-10">
                                                    <textarea name="description" id="description" data-provide="markdown" rows="10"></textarea>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label class="control-label col-md-2">Image</label>
                                                <div class="col-md-10">
                                                    <input type="file" name="picture" id="picture">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-actions">
                                            <div class="row">
                                                <div class="col-md-offset-2 col-md-10">
                                                    <button type="submit" class="btn green">
                                                        <i class="fa fa-check"></i> Submit</button>
                                                </div>
                                            </div>
                                        </div>
                                    </form>
                                    <!-- END FORM-->
                                </div>
                            </div>
                            <!-- END EXTRAS PORTLET-->
                        </div>
                    </div>
                </div>
                <!-- END PAGE CONTENT INNER -->
            </div>
        </div>
        <!-- END PAGE CONTENT BODY -->
        <!-- END CONTENT BODY -->
    </div>
</div>

@endsection

@section('script')
<script src="{{asset('assets/global/plugins/bootstrap-markdown/lib/markdown.js')}}" type="text/javascript"></script>
<script src="{{asset('assets/global/plugins/bootstrap-markdown/js/bootstrap-markdown.js')}}" type="text/javascript"></script>
<script src="{{asset('assets/pages/scripts/components-editors.min.js')}}" type="text/javascript"></script>
@endsection
