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

            <li class="breadcrumb-item"><a href="{{ route('page.index', 'calendar') }}">{{ __('Dashboard') }}</a></li>
            <li class="breadcrumb-item active" aria-current="page">{{ __('Calendar') }}</li>

            @slot('calendar')
                <div class="col-lg-6 mt-3 mt-lg-0 text-lg-right">
                    <a href="#" class="fullcalendar-btn-prev btn btn-sm btn-neutral">
                        <i class="fas fa-angle-left"></i>
                    </a>
                    <a href="#" class="fullcalendar-btn-next btn btn-sm btn-neutral">
                        <i class="fas fa-angle-right"></i>
                    </a>
                    <a href="#" class="btn btn-sm btn-neutral" data-calendar-view="month">Month</a>
                    <a href="#" class="btn btn-sm btn-neutral" data-calendar-view="basicWeek">Week</a>
                    <a href="#" class="btn btn-sm btn-neutral" data-calendar-view="basicDay">Day</a>
                </div>
            @endslot
        @endcomponent
    @endcomponent

    <div class="container-fluid mt--6">
        <div class="row">
            <div class="col">
                <!-- Fullcalendar -->
                <div class="card card-calendar">
                    <!-- Card header -->
                    <div class="card-header">
                        <!-- Title -->
                        <h5 class="h3 mb-0">Calendar</h5>
                    </div>
                    <!-- Card body -->
                    <div class="card-body p-0">
                        <div class="calendar" data-toggle="calendar" id="calendar"></div>
                    </div>
                </div>
                <!-- Modal - Add new event -->
                <!--* Modal header *-->
                <!--* Modal body *-->
                <!--* Modal footer *-->
                <!--* Modal init *-->
                <div class="modal fade" id="new-event" tabindex="-1" role="dialog" aria-labelledby="new-event-label" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered modal-secondary" role="document">
                        <div class="modal-content">
                            <!-- Modal body -->
                            <div class="modal-body">
                                <form class="new-event--form">
                                    <div class="form-group">
                                        <label class="form-control-label">Event title</label>
                                        <input type="text" class="form-control form-control-alternative new-event--title" placeholder="Event Title">
                                    </div>
                                    <div class="form-group mb-0">
                                        <label class="form-control-label d-block mb-3">Status color</label>
                                        <div class="btn-group btn-group-toggle btn-group-colors event-tag" data-toggle="buttons">
                                            <label class="btn bg-info active"><input type="radio" name="event-tag" value="bg-info" autocomplete="off" checked></label>
                                            <label class="btn bg-warning"><input type="radio" name="event-tag" value="bg-warning" autocomplete="off"></label>
                                            <label class="btn bg-danger"><input type="radio" name="event-tag" value="bg-danger" autocomplete="off"></label>
                                            <label class="btn bg-success"><input type="radio" name="event-tag" value="bg-success" autocomplete="off"></label>
                                            <label class="btn bg-default"><input type="radio" name="event-tag" value="bg-default" autocomplete="off"></label>
                                            <label class="btn bg-primary"><input type="radio" name="event-tag" value="bg-primary" autocomplete="off"></label>
                                        </div>
                                    </div>
                                    <input type="hidden" class="new-event--start" />
                                    <input type="hidden" class="new-event--end" />
                                </form>
                            </div>
                            <!-- Modal footer -->
                            <div class="modal-footer">
                                <button type="submit" class="btn btn-primary new-event--add">Add event</button>
                                <button type="button" class="btn btn-link ml-auto" data-dismiss="modal">Close</button>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Modal - Edit event -->
                <!--* Modal body *-->
                <!--* Modal footer *-->
                <!--* Modal init *-->
                <div class="modal fade" id="edit-event" tabindex="-1" role="dialog" aria-labelledby="edit-event-label" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered modal-secondary" role="document">
                        <div class="modal-content">
                            <!-- Modal body -->
                            <div class="modal-body">
                                <form class="edit-event--form">
                                    <div class="form-group">
                                        <label class="form-control-label">Event title</label>
                                        <input type="text" class="form-control form-control-alternative edit-event--title" placeholder="Event Title">
                                    </div>
                                    <div class="form-group">
                                        <label class="form-control-label d-block mb-3">Status color</label>
                                        <div class="btn-group btn-group-toggle btn-group-colors event-tag mb-0" data-toggle="buttons">
                                            <label class="btn bg-info active"><input type="radio" name="event-tag" value="bg-info" autocomplete="off" checked></label>
                                            <label class="btn bg-warning"><input type="radio" name="event-tag" value="bg-warning" autocomplete="off"></label>
                                            <label class="btn bg-danger"><input type="radio" name="event-tag" value="bg-danger" autocomplete="off"></label>
                                            <label class="btn bg-success"><input type="radio" name="event-tag" value="bg-success" autocomplete="off"></label>
                                            <label class="btn bg-default"><input type="radio" name="event-tag" value="bg-default" autocomplete="off"></label>
                                            <label class="btn bg-primary"><input type="radio" name="event-tag" value="bg-primary" autocomplete="off"></label>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="form-control-label">Description</label>
                                        <textarea class="form-control form-control-alternative edit-event--description textarea-autosize" placeholder="Event Desctiption"></textarea>
                                        <i class="form-group--bar"></i>
                                    </div>
                                    <input type="hidden" class="edit-event--id">
                                </form>
                            </div>
                            <!-- Modal footer -->
                            <div class="modal-footer">
                                <button class="btn btn-primary" data-calendar="update">Update</button>
                                <button class="btn btn-danger" data-calendar="delete">Delete</button>
                                <button class="btn btn-link ml-auto" data-dismiss="modal">Close</button>
                            </div>
                        </div>
                    </div>
                </div>
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

        'use strict';

        var Fullcalendar = (function() {

            // Variables

            var $calendar = $('[data-toggle="calendar"]');

            //
            // Methods
            //

            // Init
            function init($this) {

                // Calendar events

                var events = [

                        {
                            id: 1,
                            title: 'Call with Dave',
                            start: '2022-03-18',
                            allDay: true,
                            className: 'bg-red',
                            description: 'Nullam id dolor id nibh ultricies vehicula ut id elit. Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus.'
                        },



                    ],


                    // Full calendar options
                    // For more options read the official docs: https://fullcalendar.io/docs

                    options = {
                        header: {
                            right: '',
                            center: '',
                            left: ''
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

                        dayClick: function(date) {
                            var isoDate = moment(date).toISOString();
                            $('#new-event').modal('show');
                            $('.new-event--title').val('');
                            $('.new-event--start').val(isoDate);
                            $('.new-event--end').val(isoDate);
                        },

                        viewRender: function(view) {
                            var calendarDate = $this.fullCalendar('getDate');
                            var calendarMonth = calendarDate.month();

                            //Set data attribute for header. This is used to switch header images using css
                            // $this.find('.fc-toolbar').attr('data-calendar-month', calendarMonth);

                            //Set title in page header
                            $('.fullcalendar-title').html(view.title);
                        },

                        // Edit calendar event action

                        eventClick: function(event, element) {
                            $('#edit-event input[value=' + event.className + ']').prop('checked', true);
                            $('#edit-event').modal('show');
                            $('.edit-event--id').val(event.id);
                            $('.edit-event--title').val(event.title);
                            $('.edit-event--description').val(event.description);
                        }
                    };

                // Initalize the calendar plugin
                $this.fullCalendar(options);


                //
                // Calendar actions
                //


                //Add new Event

                $('body').on('click', '.new-event--add', function() {
                    var eventTitle = $('.new-event--title').val();

                    // Generate ID
                    var GenRandom = {
                        Stored: [],
                        Job: function() {
                            var newId = Date.now().toString().substr(6); // or use any method that you want to achieve this string

                            if (!this.Check(newId)) {
                                this.Stored.push(newId);
                                return newId;
                            }
                            return this.Job();
                        },
                        Check: function(id) {
                            for (var i = 0; i < this.Stored.length; i++) {
                                if (this.Stored[i] == id) return true;
                            }
                            return false;
                        }
                    };

                    if (eventTitle != '') {
                        $this.fullCalendar('renderEvent', {
                            id: GenRandom.Job(),
                            title: eventTitle,
                            start: $('.new-event--start').val(),
                            end: $('.new-event--end').val(),
                            allDay: true,
                            className: $('.event-tag input:checked').val()
                        }, true);

                        $('.new-event--form')[0].reset();
                        $('.new-event--title').closest('.form-group').removeClass('has-danger');
                        $('#new-event').modal('hide');
                    } else {
                        $('.new-event--title').closest('.form-group').addClass('has-danger');
                        $('.new-event--title').focus();
                    }
                });


                //Update/Delete an Event
                $('body').on('click', '[data-calendar]', function() {
                    var calendarAction = $(this).data('calendar');
                    var currentId = $('.edit-event--id').val();
                    var currentTitle = $('.edit-event--title').val();
                    var currentDesc = $('.edit-event--description').val();
                    var currentClass = $('#edit-event .event-tag input:checked').val();
                    var currentEvent = $this.fullCalendar('clientEvents', currentId);

                    //Update
                    if (calendarAction === 'update') {
                        if (currentTitle != '') {
                            currentEvent[0].title = currentTitle;
                            currentEvent[0].description = currentDesc;
                            currentEvent[0].className = [currentClass];

                            console.log(currentClass);
                            $this.fullCalendar('updateEvent', currentEvent[0]);
                            $('#edit-event').modal('hide');
                        } else {
                            $('.edit-event--title').closest('.form-group').addClass('has-error');
                            $('.edit-event--title').focus();
                        }
                    }

                    //Delete
                    if (calendarAction === 'delete') {
                        $('#edit-event').modal('hide');

                        // Show confirm dialog
                        setTimeout(function() {
                            swal({
                                title: 'Are you sure?',
                                text: "You won't be able to revert this!",
                                type: 'warning',
                                showCancelButton: true,
                                buttonsStyling: false,
                                confirmButtonClass: 'btn btn-danger',
                                confirmButtonText: 'Yes, delete it!',
                                cancelButtonClass: 'btn btn-secondary'
                            }).then((result) => {
                                if (result.value) {
                                    // Delete event
                                    $this.fullCalendar('removeEvents', currentId);

                                    // Show confirmation
                                    swal({
                                        title: 'Deleted!',
                                        text: 'The event has been deleted.',
                                        type: 'success',
                                        buttonsStyling: false,
                                        confirmButtonClass: 'btn btn-primary'
                                    });
                                }
                            })
                        }, 200);
                    }
                });


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


            //
            // Events
            //

            // Init
            if ($calendar.length) {
                init($calendar);
            }

        })();


    </script>
@endpush
