@extends('layouts.app')

{{-- Customize layout sections --}}

@section('subtitle', __('Calendar'))
@section('content_header')
    {{-- <a href="{{ url('#') }}" class="btn btn-sm btn-primary float-right"><i class="fas fa-plus"></i></a> --}}
    <h1 class="text-muted">{{ __('Calendar') }}</h1>
@stop

{{-- Content body: main page content --}}
@section('content_body')
    <div class="row">
        <div class="col-md-3">
            <div class="sticky-top mb-3">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title">{{ __('Events') }}</h4>
                    </div>
                    <div class="card-body">
                        <div id="external-events">
                            @foreach ($events->unique('ProfessionalID') as $user)
                                <div class="external-event" data-user-id="{{ $user->ProfessionalID }}" style="background-color: {{ $colors[$user->ProfessionalID] ?? '#17a2b8' }}; color: #FFFFFF;">
                                     {{ explode(' ', $user->Nom)[0] . ' ' . $user->PrimerCognom . ' ' . $user->SegonCognom }}
                                </div>
                            @endforeach
                        </div>
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
        .fc-daygrid-day.fc-day-sat .fc-daygrid-day-number,
        .holiday .fc-daygrid-day-number {
            color: red;
            font-weight: bold;
        }
    </style>
@endsection

{{-- Enable Plugin --}}
@section('plugins.jQueryUI', true)
@section('plugins.FullCalendar', true)
@section('plugins.TempusDominusBs4', true)

{{-- Push extra scripts --}}
@section('js')
    <script src="https://cdn.jsdelivr.net/npm/fullcalendar@6.1.15/index.global.min.js"></script>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Eventos desde la base de datos (Laravel)
            var groupedEvents = @json($groupedEvents);
            var holidays = @json($holidays);
    
            // Inicializar FullCalendar
            var Calendar = FullCalendar.Calendar;
    
            var containerEl = document.getElementById('external-events');
            var calendarEl = document.getElementById('calendar');
    
            // Inicializar el calendario
            var calendar = new Calendar(calendarEl, {
                headerToolbar: {
                    left: 'prev,next',
                    center: 'title',
                    right: 'dayGridMonth,multiMonthYearGrid,dayGridYear',
                },
                locale: "{{ app()->getLocale() }}",
                initialView: 'dayGridMonth',
                views: {
                    dayGridMonth: {
                        buttonText: "{{ __('Month') }}",
                    },
                    multiMonthYearGrid: {
                        type: "multiMonthYear",
                        buttonText: "{{ __('Grid') }}",
                        multiMonthMaxColumns: 2
                    },
                    dayGridYear: {
                        buttonText: "{{ __('Continuous') }}"
                    }
                },
                firstDay: 1,
                events: groupedEvents,
                dayCellClassNames: function(arg) {
                    var classes = [];

                    // Verificar si la fecha es fin de semana
                    if (arg.date.getDay() === 0 || arg.date.getDay() === 6) {
                        classes.push('weekend');
                    }

                    // Comparar fechas y marcar días festivos
                    holidays.forEach(function(holiday) {
                        var calendarDate = arg.date.toLocaleDateString('en-CA'); // Convertir a formato YYYY-MM-DD
                        if (calendarDate === holiday.start) { // 'start' contiene la fecha del festivo
                            classes.push('holiday'); // Agregar clase 'holiday' si coincide
                        }
                    });

                    return classes;
                },
                eventClick: function(info) {
                    alert('Guardia: ' + info.event.title);
                }
            });
    
            calendar.render();
        });
    </script>    
@endsection
