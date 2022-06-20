@extends('layouts.app', [
'parentSection' => '',
'elementName' => 'agenda'
])

@section('content')
    @component('layouts.headers.auth')
        @component('layouts.headers.breadcrumbs')

            @slot('title')
                {{ now()->format('F Y') }}
            @endslot




        @endcomponent
    @endcomponent


    <div class="container-fluid mt--6">
        <div class="row ">

            <div class="col">
                <p>
                    <button class="btn btn-secondary" type="button" data-toggle="collapse" data-target="#collapseExample" aria-expanded="false" aria-controls="collapseExample">
                        Filtros
                    </button>
                </p>
                <div class="collapse" id="collapseExample">
                    <div class="card card-body">
                        <form id="frmFiltro">

                            <div class="row">

                                @foreach($advogados as $adv)


                                    <div class="col-lg col-sm-6">
                                        <div class="custom-control custom-checkbox">
                                            <input type="checkbox" name="customCheck" class="custom-control-input" id="customCheck{{$adv->name}}" value="{{$adv->id}}" {{ in_array($adv->id,session('adv_ids') ?? []) == '1' ? 'checked' : '' }}>
                                            <label class="custom-control-label" for="customCheck{{$adv->name}}">{{$adv->name}}</label>
                                        </div>
                                    </div>


                                @endforeach
                            </div>
                        </form>




                    </div>
                </div>
            </div>
        </div>
        <div class="row">

            <div class="col ">
                <!-- Fullcalendar -->
                <div class="card card-calendar ">
                    <!-- Card header -->

                    <!-- Card body -->
                    <div class="card-body p-4" id="blur">
                        <div name="calendar" class="calendar" data-toggle="calendar" id="calendar"></div>
                    </div>
                </div>

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
                        <form class="new-event--form"  id="eventadd" method="post">
                            <div class="form-group">
                                <label class="form-control-label">Lembrete</label>
                                {{--                            <input name="title" type="text" class="form-control form-control-alternative new-event--title" placeholder="{{ __('Defina um lembrete') }}" value="{{ old('nome', $event->title??'') }}" required autofocus>--}}
                                <input name="title" type="text" class="form-control form-control-alternative new-event--title" placeholder="{{ __('Defina um lembrete') }}"  required autofocus>
                            </div>
                            <div class="form-group mb-0">
                                <input type="hidden" name="user_id" id="input-id" class="form-control"  value="{{auth()->user()->id ??''}}"  >

                                <div class="custom-control custom-checkbox">
                                    <input type="checkbox" class="custom-control-input" id="customCheck1" name="allDay">
                                    <label class="custom-control-label" for="customCheck1">Dia inteiro?</label>
                                </div>


                            </div>

                            <div class="form-group mt-3">
                                <label class="form-control-label">Data</label>
                                <input type="datetime-local"  class="form-control " name="startEvent" id="startEvent"  >
                            </div>
                            <div class="form-group mt-3">
                                <label class="form-control-label">Agenda</label>
                                <h6 class="text-muted text-sm">{{auth()->user()->name ??''}}</h6>
                            </div>
                            <input type="hidden" class="new-event--start" />
                            <input type="hidden" class="new-event--end" />
                        </form>
                    </div>
                    <!-- Modal footer -->
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-primary" id="btnAddEvent">Salvar</button>
                        <button type="button" class="btn btn-link ml-auto" data-dismiss="modal">Fechar</button>
                    </div>
                </div>
            </div>
        </div>
        <!-- Modal - Edit event -->                <!--* Modal body *-->
        <!--* Modal footer *-->
        <!--* Modal init *-->
        <div class="modal fade" id="edit-event" tabindex="-1" role="dialog" aria-labelledby="edit-event-label" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered modal-secondary" role="document">
                <div class="modal-content">
                    <!-- Modal body -->
                    <div class="modal-body">

                        <form class="edit-event--form" id="eventupdate">
                            <div class="form-group">
                                <label class="form-control-label">Lembrete</label>
                                <input name="titleEdit" id="titleEdit" type="text" class="form-control form-control-alternative"   required autofocus>
                            </div>
                            <div class="form-group mb-0">
                                <input type="hidden" name="user_id" id="input-id" class="form-control"  value="{{auth()->user()->id ??''}}"  >

                                <div class="custom-control custom-checkbox">
                                    <input type="checkbox" class="custom-control-input"  id="allDayEdit" name="allDayEdit">
                                    <label class="custom-control-label" for="allDayEdit">Dia inteiro?</label>
                                </div>


                            </div>

                            <div class="form-group mt-3">
                                <label class="form-control-label">Data</label>
                                <input type="datetime-local"  class="form-control " id="startEventEdit" name="startEventEdit"  >
                            </div>
                            <div class="form-group mt-3">
                                <label class="form-control-label">Agenda</label>
                                <h6 class="text-muted text-sm">{{auth()->user()->name ??''}}</h6>
                            </div>

                            <input type="hidden" id="eventIdEdit" name="eventIdEdit">
                        </form>
                    </div>
                    <!-- Modal footer -->
                    <div class="modal-footer">
                        <button class="btn btn-primary" id="btnUpdateEvent" >Salvar</button>
                        <button class="btn btn-danger"  id="btnDeleteEvent" >Excluir</button>
                        <button class="btn btn-link ml-auto" data-dismiss="modal">Fechar</button>
                    </div>
                </div>
            </div>
        </div>

        <!-- Footer -->

    </div>
@endsection

@push('css')
    <link rel="stylesheet" href="{{ asset('argon') }}/vendor/fullcalendar5/main.css">
    <link rel="stylesheet" href="{{ asset('argon') }}/vendor/sweetalert2/dist/sweetalert2.min.css">
    <style>
        .calendar .fc-toolbar {
            height: 50px !important;

        }
        .desfoque {
            -webkit-filter: blur(3px);
            -moz-filter: blur(3px);
            -o-filter: blur(3px);
            -ms-filter: blur(3px);
            filter: blur(3px);
        }
        @media (max-width: 767.98px) {
            .fc .fc-toolbar.fc-header-toolbar {
                display: block;
                text-align: center;
                padding-bottom: 110px;
            }

            .fc-header-toolbar .fc-toolbar-chunk {
                display: block;
            }
            .fc .fc-toolbar-title {

                padding-bottom: 10px;
                padding-top: 10px;
            }
            .fc .fc-button-group{
                width: 100%;
            }

        }
    </style>

@endpush

@push('js')
    <script src="{{ asset('argon') }}/vendor/fullcalendar5/main.js"></script>
    <script src="{{ asset('argon') }}/vendor/fullcalendar5/locales-all.js"></script>
    <script src="{{ asset('argon') }}/vendor/sweetalert2/dist/sweetalert2.min.js"></script>
    <script src="{{ asset('argon') }}/vendor/moment/min/moment.min.js"></script>




    <script type="text/javascript">




        document.addEventListener('DOMContentLoaded', function() {

            var calendarEl = document.getElementById('calendar');
            var $ids = [];
            
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });


            $('#frmFiltro input[type=checkbox]').change(function() {

                setNewUrlCalendar();
            });




            function getChecklistItems() {

                var result = $("#frmFiltro input:checkbox[name=customCheck]:checked").get();
                console.log(result);
                var $data = $.map(result, function(element) {
                    console.log("element",$(element).val())
                    console.log("checado?",element.checked);
                    if(element.checked){
                        return $(element).val();
                    }

                });
                return $data;
            }
            var calendar = new FullCalendar.Calendar(calendarEl, {

                loading: function (bool) {


                    if (bool) {

                        var element = document.getElementById('blur');
                        console.log(element + '- Caaregando');
                        element.classList.add("desfoque");

                    }
                    else {
                        var element = document.getElementById('blur');
                        console.log(element + '- foiu');
                        element.classList.remove("desfoque");
                    }
                },

                locale:'pt-br',
                height: 'auto',
                selectable :true,


                headerToolbar: {
                    left: 'prev,next,today',
                    center: 'title',
                    right: 'dayGridMonth,dayGridWeek,dayGridDay,listMonth',
                },

                // events: eventos,
                //events: "{{route('fullcalendar.events')}}",
                //events: '{!! $events !!}',
                events: getUrlCalendar(),


                initialView: 'dayGridMonth',


                eventClick: function(info) {

                    if( info.event.extendedProps.atendimento_id == null){
                         $('#edit-event').modal('show');
                        // document.getElementById('startEventEdit').value = info.event.date;
                        let data = moment(info.event.start).format('YYYY-MM-DD') +'T' +moment(info.event.start).format('HH')+':'+moment(info.event.start).format('mm');
                        document.getElementById('startEventEdit').value = data;
                        document.getElementById('titleEdit').value = info.event.title;
                        document.getElementById('eventIdEdit').value = info.event.id;
                        $('#allDayEdit').prop('checked', info.event.allDay);

                         console.log(info.event.id);



                    }else{

                        let url = "{{ route('showByCalendarEvent',' atendimento_id => :p') }}";
                        url = url.replace(':p', info.event.extendedProps.atendimento_id);
                        document.location.href = url;

                    }


                },

                dateClick: function(event){


                    let currentDate = new Date();
                    let time = (currentDate.getHours()<10?'0':'') +currentDate.getHours()+ ":" + (currentDate.getMinutes()<10?'0':'') + currentDate.getMinutes();
                    var isoDate = event.dateStr + 'T'+time;

                    console.log(isoDate);
                    $('#new-event').modal('show');
                    document.getElementById('startEvent').value = isoDate;

                },

                select: function(event){

                    // var isoDate = moment(event).toISOString();
                    // $('#new-event').modal('show');
                    // $('.new-event--title').val('');
                    // $('.new-event--start').val(isoDate);
                    // $('.new-event--end').val(isoDate);
                }



            });

            calendar.render();

            function getUrlCalendar(){
                $ids = getChecklistItems();
                let url = "{{ route('fullcalendar.events',':p') }}";
                url = url.replace(':p', $ids);
                console.log(url);
                return url;
            }

            function setNewUrlCalendar(){

                $ids = getChecklistItems();


                let url = "{{ route('fullcalendar.show',':p') }}";
                url = url.replace(':p', $ids);
                var events = {url: url};
                console.log(url);

                var eventSources = calendar.getEventSources();
                eventSources[0].remove();
                calendar.addEventSource(events);
                calendar.refetchEvents();
            }

            $("button#btnAddEvent").click(function(){
                $.ajax({
                    type: "PUT",
                    url: "{{route('event.add')}}",
                    data: $('form#eventadd').serialize(),
                    success: function(xhr, status, sucess){
                       calendar.refetchEvents();
                        $('#new-event').modal('hide');


                    },
                    error: function(xhr, status, error){
                        alert("Parece que deu erro! Chame o Augusto");
                    }
                });
            });

            $("button#btnUpdateEvent").click(function(){
                $.ajax({
                    type: "POST",
                    url: "{{route('event.update')}}",
                    data: $('form#eventupdate').serialize(),
                    success: function(xhr, status, sucess){
                        calendar.refetchEvents();
                        $('#edit-event').modal('hide');
                    },
                    error: function(xhr, status, error){
                        alert("Parece que deu erro! Chame o Augusto");
                    }
                });
            });
            $("button#btnDeleteEvent").click(function(){
                let id =  document.getElementById('eventIdEdit').value;
                var APP_URL = {!! json_encode(url('/')) !!};
                console.log(APP_URL);
                $.ajax({
                    type: "DELETE",
                    url: APP_URL+ "/event/destroy/" + id ,
                    data: $('form#eventupdate').serialize(),
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    success: function(xhr, status, sucess){
                        calendar.refetchEvents();
                        $('#edit-event').modal('hide');
                    },
                    error: function(xhr, status, error){
                        alert(xhr.responseText);
                    }
                });
            });
        });



    </script>


@endpush


