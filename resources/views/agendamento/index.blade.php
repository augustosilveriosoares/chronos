@extends('layouts.app', [
'parentSection' => '',
'elementName' => 'calendar'
])

@section('content')
@component('layouts.headers.auth')
@component('layouts.headers.breadcrumbs')
@slot('title')
{{ now()->format('F Y') }}
@endslot

<li class="breadcrumb-item"><a href="{{ route('dashboard', 'calendar') }}">{{ __('Dashboard') }}</a></li>
<li class="breadcrumb-item active" aria-current="page">{{ __('Calendar') }}</li>

@slot('calendar')
<div class="col-lg-6 mt-3 mt-lg-0 text-lg-right">
    <a href="#" class="fullcalendar-btn-prev btn btn-sm btn-neutral">
        <i class="fas fa-angle-left"></i>
    </a>
    <a href="#" class="fullcalendar-btn-next btn btn-sm btn-neutral">
        <i class="fas fa-angle-right"></i>
    </a>
    <a href="#" class="btn btn-sm btn-neutral" data-calendar-view="month">Mês</a>
    <a href="#" class="btn btn-sm btn-neutral" data-calendar-view="basicWeek">Semana</a>
    <a href="#" class="btn btn-sm btn-neutral" data-calendar-view="basicDay">Dia</a>
    <a href="#" class="btn btn-sm btn-neutral" data-calendar-view="listMonth">Lista</a>
</div>
@endslot
@endcomponent
@endcomponent

<div class="container-fluid mt--6">
    <div class="row">
        <div class="col-lg-2">
            <div class="row">
                <div class="col">
                    <!-- Members list group card -->
                    <div class="card">
                        <!-- Card header -->
                        <div class="card-header">
                            <!-- Title -->
                            <h6 class="h3 mb-0">Advogados</h6>
                        </div>
                        <!-- Card body -->
                        <div class="card-body">
                            <!-- List group -->
                            <ul class="list-group list-group-flush list my--3">
                            
                                @foreach($advogados as $adv)
                               
                                <li class="list-group-item px-0">
                                    <div class="row align-items-center">
                                        <div class="col ml--2">
                                            <div class="custom-control custom-radio mb-3">
                                                <input name="radio_adv" class="custom-control-input radio_adv" 
                                                id="customRadio{{$adv->id}}" type="radio" value="{{$adv->id}}">
                                                <label class="custom-control-label" for="customRadio{{$adv->id}}">{{$adv->name}}</label>
                                            </div>
                                        </div>
                                    </div>
                                </li>
                                @endforeach
                            
                            </ul>
                        </div>
                    </div>
                </div>


            </div>

        </div>
        <div class="col ">
            <!-- Fullcalendar -->
            <div class="card card-calendar">
                <!-- Card header -->
                <div class="card-header">
                    <!-- Title -->
                    <h6 class="fullcalendar-title h2 mb-0"></h6>
                </div>
                <!-- Card body -->
                <div class="card-body p-0">
                    <div class="calendar" data-toggle="calendar" id="calendar"></div>
                </div>
            </div>

        </div>
        <div class="col-lg-1">

        </div>
    </div>
    <!-- Footer -->
    @include('layouts.footers.auth')
</div>
@endsection

@push('css')
<link rel="stylesheet" href="{{ asset('argon') }}/vendor/fullcalendar/dist/fullcalendar.min.css">
<link rel="stylesheet" href="{{ asset('argon') }}/vendor/sweetalert2/dist/sweetalert2.min.css">
@endpush

@push('js')
<script src="{{ asset('argon') }}/vendor/moment/min/moment.min.js"></script>
<script src="{{ asset('argon') }}/vendor/fullcalendar/dist/fullcalendar.min.js"></script>
<script src="{{ asset('argon') }}/vendor/sweetalert2/dist/sweetalert2.min.js"></script>
<script type="text/javascript">
    //
    // Fullcalendar
    //
    var options = {
                header: {
                    left: 'prev,next today',
                    center: ' title ',
                    right: ' dayGridMonth,timeGridWeek,timeGridDay '
                },
                buttonIcons: {
                    prev: 'calendar--prev',
                    next: 'calendar--next'
                },

                theme: false,
                selectable: true,
                selectHelper: true,
                editable: true,


                events: {
                    url: "{{route('fullcalendar.index')}}"
                },

                // dayClick: function(date) {
                //     $this.fullCalendar('changeView', 'basicDay');
                // },

                // viewRender: function(view) {
                //     var calendarDate = $this.fullCalendar('getDate');
                //     var calendarMonth = calendarDate.month();
                //     $('.fullcalendar-title').html(view.title);
                // },

                // Edit calendar event action

                eventClick: function(event, element) {

                    //console.log(event);

                    let url = "{{ route('showByCalendarEvent',' atendimento_id => :p') }}";
                    url = url.replace(':p', event.atendimento_id);
                    document.location.href = url;

                }
            };
    'use strict';

    var Fullcalendar = (function() {

        // Variables

        var $calendar = $('[data-toggle="calendar"]');

        //
        // Methods
        //

        // Init
        function init($this,options) {

            // Full calendar options
            // For more options read the official docs: https://fullcalendar.io/docs

            

            // Initalize the calendar plugin
            $this.fullCalendar(options);




            //Calendar views switch
            $('body').on('click', '[data-calendar-view]', function(e) {
                e.preventDefault();

                $('[data-calendar-view]').removeClass('active');
                $(this).addClass('active');

                var calendarView = $(this).attr('data-calendar-view');
                $this.fullCalendar('changeView', calendarView);
            });


            //Calendar Next
            $('body').on('click', '.fullcalendar-btn-next', function(e) {
                e.preventDefault();
                $this.fullCalendar('next');
            });


            //Calendar Prev
            $('body').on('click', '.fullcalendar-btn-prev', function(e) {
                e.preventDefault();
                $this.fullCalendar('prev');
            });

        }


        // Init
        if ($calendar.length) {
            init($calendar,options);
        }



    })();


    $('input[type=radio][name=radio_adv]').change(function() {
        id = this.value;
        let url = "{{ route('fullcalendar.show',':p') }}";
        url = url.replace(':p', id);
        events = {url: url};
        console.log(url);
        console.log(id);
        $('#calendar').fullCalendar('removeEvents');
        $('#calendar').fullCalendar('addEventSource', events);         
        $('#calendar').fullCalendar('rerenderEvents');
    });


</script>
@endpush