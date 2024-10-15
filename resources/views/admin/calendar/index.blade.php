@extends('layouts.app')

{{-- Customize layout sections --}}

@section('subtitle', 'Calendar')
@section('content_header')
    <a href="{{ url('#') }}" class="btn btn-sm btn-primary float-right"><i class="fas fa-plus"></i></a>
    <h1 class="text-muted">{{ __('Calendar') }}</h1>
@stop

{{-- Content body: main page content --}}

@section('content_body')
    <div class="row">
        <div class="col-md-3">
            <div class="sticky-top mb-3">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title">Events</h4>
                    </div>
                    <div class="card-body">
                        <div id="external-events">
                            @foreach ($users as $user)
                                <div class="external-event" data-user-id="{{ $user->id }}"  style="background-color: {{ $user->backgroundColor }}; color: #FFFFFF;">
                                     {{ $user->name }} {{--<span class="badge badge-light"> {{ $eventCounts[$event->id]->total ?? 0 }} </span> --}}
                                </div>
                            @endforeach

                            <div class="checkbox">
                                <label for="drop-remove" style="display: none">
                                    <input type="checkbox" id="drop-remove">
                                    Eliminar després d'arrossegar
                                </label>
                            </div>
                        </div>
                    </div>
                </div>

                {{-- <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">Create Event</h3>
                    </div>
                    <div class="card-body">
                        <div class="btn-group" style="width: 100%; margin-bottom: 10px;">
                            <ul class="fc-color-picker" id="color-chooser">
                                <li><a class="text-primary" href="#"><i class="fas fa-square"></i></a></li>
                                <li><a class="text-warning" href="#"><i class="fas fa-square"></i></a></li>
                                <li><a class="text-success" href="#"><i class="fas fa-square"></i></a></li>
                                <li><a class="text-danger" href="#"><i class="fas fa-square"></i></a></li>
                                <li><a class="text-muted" href="#"><i class="fas fa-square"></i></a></li>
                            </ul>
                        </div>

                        <div class="input-group">
                            <select id="user-select" class="form-control">
                                <option value="">{{ __('Select technical') }}</option>
                                @foreach($users as $user)
                                    <option value="{{ $user->id }}" data-user-id="{{ $user->id }}">{{ $user->name }}</option>
                                @endforeach
                            </select>
                        
                            <div class="input-group-append">
                                <button id="add-new-event" type="button" class="btn btn-primary">Add</button>
                            </div>
                        </div>
                    </div>
                </div> --}}

                <div class="card collapsed-card bg-light mb-3">
                    <div class="card-header">
                        <h4 class="card-title">Días Festivos Laborales</h4>
                        <div class="card-tools">
                            <button type="button" class="btn btn-tool" data-card-widget="collapse"><i
                                    class="fas fa-plus"></i></button>
                        </div>
                    </div>
                    <div class="card-body">
                        <ul class="list-group">
                            @foreach ($laborHolidays as $holiday)
                                <li class="list-group-item" style="color: {{ $holiday['color'] }};">
                                    {{ \Carbon\Carbon::parse($holiday['start'])->format('l, j \d\e F \d\e Y') }}
                                </li>
                            @endforeach
                        </ul>
                    </div>
                </div>

                {{-- <div class="card collapsed-card bg-light mb-3">
                    <div class="card-header">
                        <h4 class="card-title">Días Festivos Especiales</h4>
                        <div class="card-tools">
                            <button type="button" class="btn btn-tool" data-card-widget="collapse"><i
                                    class="fas fa-plus"></i></button>
                        </div>
                    </div>
                    <div class="card-body">
                        <ul class="list-group">
                            @foreach ($specialHolidays as $holiday)
                                <li class="list-group-item" style="color: {{ $holiday['color'] }};">
                                    {{ \Carbon\Carbon::parse($holiday['start'])->format('l, j \d\e F \d\e Y') }}
                                </li>
                            @endforeach
                        </ul>
                    </div>
                </div> --}}
            </div>
        </div>
        <div class="col-md-9">
            <div class="card card-primary">
                <div class="card-body p-0">
                    <div id="calendar"></div>
                </div>
            </div>
        </div>
    </div>
@stop

@section('css')
    <style>
        .fc-daygrid-day.fc-day-sun .fc-daygrid-day-number,
        .fc-daygrid-day.fc-day-sat .fc-daygrid-day-number,
        .holiday .fc-daygrid-day-number {
            color: red;
            font-weight: bold;
        }
    </style>
@endsection

{{-- Enable Plugin --}}
@section('plugins.jQueryUI', true)
@section('plugins.TempusDominusBs4', true)

{{-- Push extra scripts --}}
@section('js')
    <script src="https://cdn.jsdelivr.net/npm/fullcalendar@6.1.15/index.global.min.js"></script>
    <script>
        $(function() {
            function ini_events(ele) {
                ele.each(function () {
                    var eventObject = {
                        title: $.trim($(this).text()),
                        userId: $(this).data('user-id'),
                        backgroundColor: $(this).css('background-color'),
                        borderColor: $(this).css('background-color'),
                        textColor: '#fff'
                    };

                    // Verificar si el userId está presente
                    if (!eventObject.userId) {
                        console.error('Error: no se encontró el userId para este evento.');
                    }
    
                    $(this).data('event', eventObject);
                });
            }
    
            // Inicializar los eventos externos
            ini_events($('#external-events div.external-event'));
    
            // Eventos desde la base de datos (Laravel)
            var events = @json($events);
            var holidays = @json($holidays);
    
            // Inicializar FullCalendar
            var Calendar = FullCalendar.Calendar;
            var Draggable = FullCalendar.Draggable;
    
            var containerEl = document.getElementById('external-events');
            var checkbox = document.getElementById('drop-remove');
            var calendarEl = document.getElementById('calendar');
    
            // Habilitar el arrastre de eventos externos
            new Draggable(containerEl, {
                itemSelector: '.external-event',
                eventData: function(eventEl) {
                    return {
                        title: eventEl.innerText,
                        userId: $(eventEl).data('user-id'),
                        backgroundColor: window.getComputedStyle(eventEl, null).getPropertyValue('background-color'),
                        borderColor: window.getComputedStyle(eventEl, null).getPropertyValue('background-color'),
                        textColor: '#fff'
                    };
                }
            });
    
            // Inicializar el calendario
            var calendar = new Calendar(calendarEl, {
                locale: 'ca',
                initialView: 'dayGridMonth',
                headerToolbar: {
                    left: 'prev,next today',
                    center: 'title',
                    right: 'dayGridMonth,multiMonthYearGrid,dayGridYear',
                },
                views: {
                    dayGridMonth: {
                        buttonText: "Month", 
                    },
                    multiMonthYearGrid: {
                        type: "multiMonthYear",
                        buttonText: "Grid",
                        multiMonthMaxColumns: 2
                    },
                    dayGridYear: {
                        buttonText: "Continuous"
                    }
                },
                firstDay: 1,
                editable: true,
                droppable: true, // Habilitar eventos externos
                eventResizableFromStart: true,
                eventDurationEditable: true,
                events: events.map(event => ({
                    id: event.id,
                    title: event.title,
                    start: event.start,
                    end: event.end,
                    backgroundColor: event.backgroundColor,
                    borderColor: event.borderColor,
                    textColor: event.textColor,
                    allDay: true
                })),
                eventClick: function(info) {
                    alert('Guardia: ' + info.event.title);
                },
                drop: function(info) {
                    var originalEventObject = $(info.draggedEl).data('event');
    
                    // Verificar si el userId está presente
                    if (!originalEventObject.userId) {
                        console.error('Error: no se encontró el userId para este evento.');
                        return;
                    }
    
                    // Crear una copia del evento original
                    var copiedEventObject = $.extend({}, originalEventObject);
    
                    // Añadir el evento al calendario
                    calendar.addEvent({
                        id: copiedEventObject.id || null,
                        title: copiedEventObject.title,
                        start: copiedEventObject.start,
                        backgroundColor: copiedEventObject.backgroundColor,
                        borderColor: copiedEventObject.borderColor,
                        textColor: copiedEventObject.textColor || '#fff'
                    });
    
                    // Eliminar el evento si la opción "drop-remove" está marcada
                    if ($('#drop-remove').is(':checked')) {
                        $(info.draggedEl).remove();
                    }

                    function formatDate(date) {
                        var d = new Date(date);
                        var year = d.getFullYear();
                        var month = ('0' + (d.getMonth() + 1)).slice(-2);
                        var day = ('0' + d.getDate()).slice(-2);
                        var hours = ('0' + d.getHours()).slice(-2);
                        var minutes = ('0' + d.getMinutes()).slice(-2);
                        var seconds = ('0' + d.getSeconds()).slice(-2);

                        return year + '-' + month + '-' + day + ' ' + hours + ':' + minutes + ':' + seconds;
                    }

    
                    // Guardar el evento en la base de datos (AJAX)
                    $.ajax({
                        url: '/admin/calendar',
                        method: 'POST',
                        data: {
                            user_id: originalEventObject.userId,
                            title: originalEventObject.title,
                            start: formatDate(info.date),
                            backgroundColor: originalEventObject.backgroundColor,
                            borderColor: originalEventObject.borderColor,
                            textColor: originalEventObject.textColor,
                            _token: '{{ csrf_token() }}'
                        },
                        success: function(response) {
                            alert('Evento guardado con éxito.');
                            location.reload();
                        },
                        error: function(xhr, status, error) {
                            alert('Error al guardar el evento: ' + error);
                        }
                    });
                },
                eventDrop: function(info) {
                    // Confirmar si desea guardar los cambios
                    if (confirm("¿Guardar los cambios en la fecha del evento?")) {
                        // Formatear las fechas
                        function formatDate(date) {
                            var d = new Date(date);
                            var year = d.getFullYear();
                            var month = ('0' + (d.getMonth() + 1)).slice(-2);
                            var day = ('0' + d.getDate()).slice(-2);
                            var hours = ('0' + d.getHours()).slice(-2);
                            var minutes = ('0' + d.getMinutes()).slice(-2);
                            var seconds = ('0' + d.getSeconds()).slice(-2);

                            return year + '-' + month + '-' + day + ' ' + hours + ':' + minutes + ':' + seconds;
                        }

                        // Datos del evento que ha sido movido
                        var event = info.event;

                        // Enviar los cambios al servidor mediante AJAX
                        $.ajax({
                            url: '/admin/calendar/' + event.id, // Ruta para actualizar el evento (recurso)
                            method: 'PATCH', // Método PATCH para actualizar
                            data: {
                                start: formatDate(event.start),  // Nueva fecha de inicio
                                end: event.end ? formatDate(event.end) : null,  // Nueva fecha de fin (opcional)
                                _token: '{{ csrf_token() }}'
                            },
                            success: function(response) {
                                alert('Evento actualizado con éxito.');
                                location.reload();
                            },
                            error: function(xhr, status, error) {
                                alert('Error al actualizar el evento: ' + error);
                                // Revertir el cambio si hubo un error
                                info.revert();
                            }
                        });
                    } else {
                        // Si no se confirma, revertir el cambio visualmente
                        info.revert();
                    }
                },
                eventResize: function(info) {
                    // var originalEventObject = $(info.draggedEl).data('event');
    
                    // // Crear una copia del evento original
                    // var copiedEventObject = $.extend({}, originalEventObject);
    
                    function formatDate(date) {
                        var d = new Date(date);
                        var year = d.getFullYear();
                        var month = ('0' + (d.getMonth() + 1)).slice(-2);
                        var day = ('0' + d.getDate()).slice(-2);
                        var hours = ('0' + d.getHours()).slice(-2);
                        var minutes = ('0' + d.getMinutes()).slice(-2);
                        var seconds = ('0' + d.getSeconds()).slice(-2);

                        return year + '-' + month + '-' + day + ' ' + hours + ':' + minutes + ':' + seconds;
                    }

                    var copiedEventObject = info.event;
    
                    // Guardar el evento en la base de datos (AJAX)
                    $.ajax({
                        url: '/admin/calendar/' + copiedEventObject.id,
                        method: 'PATCH',
                        data: {
                            // user_id: originalEventObject.userId,
                            start: formatDate(info.event.start),
                            end: formatDate(info.event.end),
                            // title: copiedEventObject.title,
                            // backgroundColor: copiedEventObject.backgroundColor,
                            // borderColor: copiedEventObject.borderColor,
                            // textColor: copiedEventObject.textColor,
                            _token: '{{ csrf_token() }}'
                        },
                        success: function(response) {
                            alert('Evento actualizado con éxito.');
                            location.reload();
                        },
                        error: function(xhr, status, error) {
                            alert('Error al actualizar el evento: ' + error);
                            console.log(originalEventObject.userId);
                        }
                    });
                },
                dayCellClassNames: function(arg) {
                    var classes = [];

                    // Fines de semana (sábados y domingos)
                    if (arg.date.getDay() === 0 || arg.date.getDay() === 6) {
                        classes.push('weekend');
                    }

                    // Días festivos
                    holidays.forEach(function(holiday) {
                        var calendarDate = arg.date.toLocaleDateString('en-CA'); // Formato YYYY-MM-DD
                        if (calendarDate === holiday.date) {
                            classes.push('holiday'); // Añadir clase 'holiday' si es festivo
                        }
                    });

                    return classes;
                },
                eventDidMount: function(info) {
                    info.el.style.backgroundColor = info.event.extendedProps.color;
                    info.el.style.borderColor = info.event.extendedProps.color;

                    // Eliminar el evento de clic derecho
                    info.el.addEventListener('contextmenu', function(e) {
                        e.preventDefault();
                        if (confirm('¿Estás seguro de que deseas eliminar este evento?')) {
                            fetch('/admin/calendar/' + info.event.id, {
                                    method: 'DELETE',
                                    headers: {
                                        'X-CSRF-TOKEN': '{{ csrf_token() }}',
                                        'Content-Type': 'application/json'
                                    },
                                })
                                .then(response => {
                                    if (response.ok) {
                                        info.event.remove();
                                        alert('Evento eliminado con éxito.');
                                    } else {
                                        alert('Error al eliminar el evento.');
                                    }
                                });
                        }
                    });
                }
            });
    
            calendar.render();

            // /* ADDING EVENTS */
            // var currColor = '#3c8dbc'; //Red by default

            // // Color chooser button
            // $('#color-chooser > li > a').click(function (e) {
            //     e.preventDefault();
            //     // Save color
            //     currColor = $(this).css('color');
            //     // Add color effect to button
            //     $('#add-new-event').css({
            //         'background-color': currColor,
            //         'border-color'    : currColor
            //     });
            // });

            // $('#add-new-event').click(function (e) {
            //     e.preventDefault();
            //     // Get value and make sure it is not null
            //     var userId = $('#user-select').val();
            //     var userName = $('#user-select option:selected').text(); // Para obtener el nombre

            //     if (!userId) {
            //         alert('Por favor selecciona un usuario.');
            //         return;
            //     }

            //     // Create events
            //     var event = $('<div />');
            //     event.css({
            //         'background-color': currColor,
            //         'border-color'    : currColor,
            //         'color'           : '#fff'
            //     }).addClass('external-holiday-event');
            //     event.text(userName); // Usar el nombre del usuario seleccionado
            //     $('#external-holiday-events').prepend(event);

            //     // Add draggable funtionality
            //     ini_events(event);

            //     // Limpiar el selector
            //     $('#user-select').val('');
            // });
        });
    </script>    
@endsection
