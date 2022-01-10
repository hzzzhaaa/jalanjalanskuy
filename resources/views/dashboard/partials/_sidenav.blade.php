<div class="page-sidebar navbar-collapse collapse">
    <!-- BEGIN SIDEBAR MENU -->
    <!-- DOC: Apply "page-sidebar-menu-light" class right after "page-sidebar-menu" to enable light sidebar menu style(without borders) -->
    <!-- DOC: Apply "page-sidebar-menu-hover-submenu" class right after "page-sidebar-menu" to enable hoverable(hover vs accordion) sub menu mode -->
    <!-- DOC: Apply "page-sidebar-menu-closed" class right after "page-sidebar-menu" to collapse("page-sidebar-closed" class must be applied to the body element) the sidebar sub menu mode -->
    <!-- DOC: Set data-auto-scroll="false" to disable the sidebar from auto scrolling/focusing -->
    <!-- DOC: Set data-keep-expand="true" to keep the submenues expanded -->
    <!-- DOC: Set data-auto-speed="200" to adjust the sub menu slide up/down speed -->
    <ul class="page-sidebar-menu  page-header-fixed " data-keep-expanded="false" data-auto-scroll="true"
        data-slide-speed="200" style="padding-top: 20px">

        <li class="nav-item start {{ request()->routeIs('dashboard') ? 'active' : ''}} ">
            <a href={{route('dashboard')}} class="nav-link ">
                <i class="icon-bar-chart"></i>
                <span class="title">Dashboard</span>
            </a>

        </li>
        {{-- SECTION SIDENAV ORGANIZER --}}
        @if (Auth::user()->isOrganizer())
        <li class="heading">
            <h3 class="uppercase" style="color:snow"><b>{{Auth::user()->organizer->name}}</b></h3>
        </li>
        <li class="nav-item {{ request()->routeIs('dashboard.organizer*') ? 'active' : ''}} ">
                <a href={{route('dashboard.organizer')}} class="nav-link nav-toggle">
                    <i class="fa fa-institution"></i>
                <span class="title"> Organizer Profile</span>
                </a>
            </li>
        <li class="nav-item {{ request()->routeIs('dashboard.member.index') ? 'active' : ''}} ">
            <a href={{route('dashboard.member.index')}} class="nav-link nav-toggle">
                <i class="fa fa-group"></i>
                <span class="title">Members</span>
            </a>
        </li>
        <li class="nav-item  {{request()->routeIs('dashboard.event*') ? 'open active' : ''}}">
            <a href="javascript:;" class="nav-link nav-toggle">
                <i class="fa fa-tasks"></i>
                <span class="title ">Events</span>
                <span class="arrow {{request()->routeIs('dashboard.event*') ? 'open' : ''}}"></span>
            </a>

            <ul class="sub-menu" {{request()->routeIs('dashboard.event*') ? 'style=display:block;' : ''}}>
                {{-- TODO: pisahin event yang udah finished sama belom --}}
                {{-- @foreach(Auth::user()->organizer->events->where('finished',0) as $event) --}}
                @foreach(Auth::user()->organizer->events as $each)
                <li class="nav-item {{ (request()->is('dashboard/event/' . Hashids::connection(\App\Event::class)->encode($each->id) . '*')) ? 'active' : '' }} ">
                    @if($each->approved != 1)
                    <a href="javascript:;" onclick="event.preventDefault();alert('Event not yet approved');" class="nav-link ">
                        <span class="title">{{$each->name}}</span>
                    </a>
                    @else
                    <a href="{{route('dashboard.event.show',['event' => Hashids::connection(\App\Event::class)->encode($each->id)])}}" class="nav-link ">
                        <span class="title">{{$each->name}}</span>
                    </a>
                    @endif
                </li>
                @endforeach


                <li class="nav-item {{ (request()->is('dashboard/event/create')) ? 'active' : '' }} ">
                    <a href="{{route('dashboard.event.create')}}" class="nav-link ">
                        <i class="fa fa-plus"></i><span class="title">New Event</span>
                    </a>
                </li>

                @if(Auth::user()->organizer->events->where('finished',1)->count() >0)
                <li class="nav-item">
                    <a href="javascript:;" class="nav-link nav-toggle">
                        Finished Event
                        <span class="arrow"></span>
                    </a>
                    <ul class="sub-menu">
                        {{-- TODO: bikin foreach --}}
                        @foreach(Auth::user()->organizer->events->where('finished', 1) as $ea)
                        <li class="nav-item" {{ (request()->is('dashboard/event/' . Hashids::connection(\App\Event::class)->encode($each->id) . '*')) ? 'active' : '' }}>
                            <a href="{{route('dashboard.event.show',['event'=> Hashids::connection(\App\Event::class)->encode($ea->id)])}}" target="_blank" class="nav-link">
                                {{$ea->name}}
                            </a>
                        </li>
                        @endforeach
                    </ul>
                </li>
                @endif


            </ul>
        </li>
        {{-- <li class="nav-item  ">
            <a href="javascript:;" class="nav-link nav-toggle">
                <i class="icon-settings"></i>
                <span class="title">Settings</span>
                {{-- <span class="arrow"></span> --}}
            </a>
            {{-- <ul class="sub-menu">

                <li class="nav-item  ">
                    <a href="form_fileupload.html" class="nav-link ">
                        <span class="title">Multiple File Upload</span>
                    </a>
                </li>
                <li class="nav-item  ">
                    <a href="form_dropzone.html" class="nav-link ">
                        <span class="title">Dropzone File Upload</span>
                    </a>
                </li>
            </ul> --}}
        </li>

        @if(request()->routeIs('dashboard.event*') && !request()->routeIs('dashboard.event.create'))

        <li class="heading">
            <h3 class="uppercase">{{$event->name}}</h3>
        </li>
        <li class="nav-item  {{ request()->routeIs('dashboard.event.ticket*') ? 'active' : '' }}">
            <a href="{{route('dashboard.event.ticket.index', ['event' => Hashids::connection(\App\Event::class)->encode($event->id)])}}" class="nav-link nav-toggle">
                <i class="fa fa-ticket"></i>
                <span class="title">Ticket</span>
            </a>
        </li>



        <li class="nav-item {{ request()->routeIs('dashboard.event.attendee*') ? 'active' : '' }} ">
            <a href="{{route('dashboard.event.attendee.index', ['event' => Hashids::connection(\App\Event::class)->encode($event->id)])}}" class="nav-link nav-toggle">
                <i class="icon-user"></i>
                <span class="title">Attendee</span>
            </a>
        </li>

        <li class="nav-item {{ request()->routeIs('dashboard.event.checkin*') ? 'active' : '' }} ">
            <a href="{{route('dashboard.event.checkin.index', ['event' => Hashids::connection(\App\Event::class)->encode($event->id)])}}" class="nav-link nav-toggle">
                <i class="icon-check"></i>
                <span class="title">Checkin</span>
            </a>
        </li>

        <li class="nav-item {{ request()->routeIs('dashboard.event.feedback*') ? 'active' : '' }} ">

            <a href="{{route('dashboard.event.feedback.index', ['event' => Hashids::connection(\App\Event::class)->encode($event->id)])}}" class="nav-link nav-toggle">
                <i class="fa fa-thumbs-o-up"></i>
                <span class="title">Feedback</span>
            </a>
        </li>

        <li class="nav-item  {{ request()->routeIs('dashboard.event.division*') ? 'active' : '' }}">
            <a href="javascript:;" class="nav-link nav-toggle">
                <i class="fa fa-group"></i>
                <span class="title">Division</span>
                <span class="arrow"></span>
            </a>
            <ul class="sub-menu">
                @foreach($event->divisions as $each)
                <li class="nav-item {{ (request()->is('dashboard/event/' . Hashids::connection(\App\Event::class)->encode($event->id) . '/div/*')) ? 'active' : '' }}" >
                    <a href="{{route('dashboard.event.division.show', ['event' => Hashids::connection(\App\Event::class)->encode($event->id),
                    'division' => Hashids::connection(\App\Division::class)->encode($each->id)])}}" class="nav-link ">
                        <span class="title">{{$each->name}}</span>
                    </a>
                </li>
                @endforeach

                <li class="nav-item {{ (request()->is('dashboard/event/' . Hashids::connection(\App\Event::class)->encode($event->id) . '/creatediv')) ? 'active' : '' }} ">
                        <a href="{{route('dashboard.event.division.create', ['event' => Hashids::connection(\App\Event::class)->encode($event->id)])}}" class="nav-link ">
                            <i class="fa fa-plus"></i><span class="title">New Division</span>
                        </a>
                </li>
            </ul>

        </li>
        @endif
        @endif
        {{-- !SECTION  --}}
        {{-- SECTION SIDENAV ADMIN --}}
        @if (Auth::user()->isAdmin())
        <li class="heading">
            <h3 class="uppercase">ADMIN</h3>
        </li>
        <li class="nav-item {{ request()->routeIs('dashboard.user*') ? 'active' : '' }} ">
            <a href="{{route('dashboard.user.index')}}" class="nav-link nav-toggle">
                <i class="icon-diamond"></i>
                <span class="title">USERS</span>
            </a>
        </li>
        <li class="nav-item  {{ request()->routeIs('dashboard.admin.event*') ? 'active' : '' }}">
            <a href="{{route('dashboard.admin.event.index')}}" class="nav-link nav-toggle">
                <i class="icon-puzzle"></i>
                <span class="title">Events</span>
            </a>
        </li>
        <li class="nav-item {{ request()->routeIs('dashboard.organizer*') ? 'active' : '' }} ">
            <a href="{{route('dashboard.organizer.index')}}" class="nav-link nav-toggle">
                <i class="icon-settings"></i>
                <span class="title">Organizers</span>

            </a>

        </li>
        @endif
        {{-- !SECTION  --}}




    </ul>
    <!-- END SIDEBAR MENU -->
    <!-- END SIDEBAR MENU -->
</div>
