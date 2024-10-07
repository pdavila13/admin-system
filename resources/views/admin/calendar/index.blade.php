@extends('layouts.app')

{{-- Customize layout sections --}}

@section('subtitle', 'Calendar')
@section('content_header')
    <a href="{{ url('#') }}" class="btn btn-sm btn-primary float-right"><i class="fas fa-plus"></i></a>
    <h1 class="text-muted">{{ __('Guard calendar') }}</h1>
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
                            {{-- @foreach ($people as $index => $persona)
                                <div class="external-event" 
                                     style="background-color: {{ $colors[$index] }}; color: #FFFFFF;">
                                     {{ $persona }}: {{ $eventCounts[$index] }}
                                </div>
                            @endforeach --}}
                            <div class="checkbox disabled">
                                <label for="drop-remove">
                                    <input type="checkbox" id="drop-remove">
                                    Eliminar després d'arrossegar
                                </label>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="card">
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
                            <input id="new-event" type="text" class="form-control" placeholder="Event Title">
                            <div class="input-group-append">
                                <button id="add-new-event" type="button" class="btn btn-primary">Add</button>
                            </div>
                        </div>
                    </div>
                </div>

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

                <div class="card collapsed-card bg-light mb-3">
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
                </div>
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
        .fc-daygrid-day.fc-day-sat .fc-daygrid-day-number {
            color: red;
            font-weight: bold;
        }
    </style>
@endsection

{{-- Enable Plugin --}}
{{-- @section('plugins.FullCalendar', true) --}}

{{-- Push extra scripts --}}
@section('js')
    <script src="https://cdn.jsdelivr.net/npm/fullcalendar@6.1.15/index.global.min.js"></script>
    <script>
        $(function() {
            // Función para inicializar los eventos externos
            function ini_events(ele) {
                ele.each(function() {
                    var eventObject = {
                        title: $.trim($(this)
                        .text()) // Usa el texto del elemento como título del evento
                    };

                    // Almacenar el objeto del evento en el DOM
                    $(this).data('eventObject', eventObject);

                    // Hacer que los eventos sean arrastrables usando jQuery UI
                    $(this).draggable({
                        zIndex: 1070,
                        revert: true, // Hará que el evento vuelva a su posición original
                        revertDuration: 0 // Sin retraso en el retorno
                    });
                });
            }

            // Llamar la función para inicializar los eventos externos
            ini_events($('#external-events div.external-event'));

            // Pasar los eventos desde Laravel a FullCalendar
            var events = @json($events);

            // Inicializar el calendario con FullCalendar
            var Calendar = FullCalendar.Calendar;
            var Draggable = FullCalendar.Draggable;

            var containerEl = document.getElementById('external-events');
            var checkbox = document.getElementById('drop-remove');
            var calendarEl = document.getElementById('calendar');

            var eventContainer = document.getElementById('external-events');

            var people = [{
                    name: "Persona 1",
                    color: "#f56954"
                },
                {
                    name: "Persona 2",
                    color: "#563d7c"
                },
                {
                    name: "Persona 3",
                    color: "#28a745"
                },
                {
                    name: "Persona 4",
                    color: "#17a2b8"
                }
            ];

            // Agregar los nombres de las people y sus colores dinámicamente al contenedor
            people.forEach(function(person) {
                var personElement = document.createElement('div');
                personElement.classList.add('external-event');
                personElement.style.backgroundColor = person.color; // Color de la persona
                personElement.style.color = '#fff'; // Color del texto
                personElement.innerText = person.name + ": 52"; // Nombre de la persona

                // Agregar la persona al contenedor
                eventContainer.appendChild(personElement);
            });

            // Inicializar los eventos externos para arrastrar
            new Draggable(containerEl, {
                itemSelector: '.external-event',
                eventData: function(eventEl) {
                    return {
                        title: eventEl.innerText,
                        backgroundColor: window.getComputedStyle(eventEl, null).getPropertyValue(
                            'background-color'),
                        borderColor: window.getComputedStyle(eventEl, null).getPropertyValue(
                            'background-color'),
                        textColor: window.getComputedStyle(eventEl, null).getPropertyValue('color')
                    };
                }
            });

            // Inicializar FullCalendar con los eventos
            var calendar = new Calendar(calendarEl, {
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
                firstDay: 1, // Comienza la semana en lunes
                themeSystem: 'bootstrap',
                dayCellClassNames: function(arg) {
                    var classes = [];
                    if (arg.date.getDay() === 0 || arg.date.getDay() === 6) {
                        classes.push('weekend'); // Sábados y domingos
                    }
                    return classes;
                },
                events: events, // Cargar los eventos desde el backend
                editable: true, // Habilitar edición de eventos (arrastrar, redimensionar)
                droppable: true, // Permitir arrastrar y soltar eventos
                drop: function(info) {
                    // is the "remove after drop" checkbox checked?
                    if (checkbox.checked) {
                        // if so, remove the element from the "Draggable Events" list
                        info.draggedEl.parentNode.removeChild(info.draggedEl);
                    }
                },

                // Evento para redimensionar (alargar o acortar) eventos
                eventResize: function(info) {
                    if (confirm("¿Guardar los cambios en la duración del evento?")) {
                        var event = info.event;
                        // Aquí puedes hacer la solicitud AJAX para actualizar el evento en la base de datos
                        fetch('/admin/calendar/' + event.id, {
                                method: 'PATCH',
                                headers: {
                                    'X-CSRF-TOKEN': '{{ csrf_token() }}',
                                    'Content-Type': 'application/json'
                                },
                                body: JSON.stringify({
                                    start: event.start.toISOString(),
                                    end: event.end ? event.end.toISOString() : null
                                })
                            })
                            .then(response => {
                                if (!response.ok) {
                                    alert('Error al actualizar el evento.');
                                    info.revert(); // Si falla, revertir el cambio visualmente
                                }
                            });
                    } else {
                        info.revert(); // Revertir los cambios si no se confirma
                    }
                },

                eventClick: function(info) {
                    alert('Evento: ' + info.event.title);
                },

                dateClick: function(info) {
                    alert('Fecha: ' + info.dateStr);
                },

                drop: function(info) {
                    if (checkbox.checked) {
                        info.draggedEl.parentNode.removeChild(info.draggedEl);
                    }
                },

                eventDidMount: function(info) {
                    info.el.style.backgroundColor = info.event.extendedProps.color;
                    info.el.style.borderColor = info.event.extendedProps.color;

                    // Añadir el evento de clic derecho
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

            // Añadir nuevos eventos dinámicamente
            var currColor = '#3c8dbc'; // Color predeterminado

            // Selector de color
            $('#color-chooser > li > a').click(function(e) {
                e.preventDefault();
                currColor = $(this).css('color');
                $('#add-new-event').css({
                    'background-color': currColor,
                    'border-color': currColor
                });
            });

            // Añadir un nuevo evento
            $('#add-new-event').click(function(e) {
                e.preventDefault();
                var val = $('#new-event').val();
                if (val.length === 0) {
                    return;
                }

                var event = $('<div />');
                event.css({
                    'background-color': currColor,
                    'border-color': currColor,
                    'color': '#fff'
                }).addClass('external-event');
                event.text(val);
                $('#external-events').prepend(event);

                ini_events(event);
                $('#new-event').val('');
            });
        });
    </script>
@endsection
