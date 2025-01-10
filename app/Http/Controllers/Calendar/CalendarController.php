<?php

namespace App\Http\Controllers\Calendar;

use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;

class CalendarController extends Controller
{
    public function __construct() {
        $this->middleware('can:admin.calendar.index')->only('index');
    }

    public function index() {
        // Obtener eventos de la base de datos
        $events = DB::connection('girh')->table('GT_CalendariProfessional as calprof')
            ->leftJoin('GNR_Professionals as prof', 'prof.ProfessionalID', '=', 'calprof.ProfessionalId')
            ->select(
                'prof.ProfessionalID',
                'prof.NIF',
                'prof.PrimerCognom',
                'prof.SegonCognom',
                'prof.Nom',
                'calprof.DataInici as start',
                'calprof.DataFi as end'
            )
            ->where('calprof.NecessitatId', 5562)
            ->whereNull('calprof.DataDelete')
            ->whereNull('calprof.IdIncidencia')
            ->orderBy('calprof.DataInici')
            ->get();

        // Colores por usuario
        $colors = [
            '2382' => '#6f42c1',
            '5947' => '#fd7e14',
            '8860' => '#28a745',
            '14931' => '#17a2b8',
        ];

        // Agrupar eventos por usuario y rango de fechas
        $groupedEvents = [];

        foreach ($events->groupBy('ProfessionalID') as $id => $userEvents) {
            $mergedRanges = [];
            foreach ($userEvents as $event) {
                $start = Carbon::parse($event->start);
                $end = Carbon::parse($event->end);

                // Si el rango actual puede unirse al último, extiende el rango
                if (!empty($mergedRanges) && $start->lessThanOrEqualTo(Carbon::parse(end($mergedRanges)['end'])->addDay())) {
                    $mergedRanges[count($mergedRanges) - 1]['end'] = max($end->format('Y-m-d'), end($mergedRanges)['end']);
                } else {
                    // Agregar un nuevo rango si no es continuo
                    $mergedRanges[] = [
                        'title' => explode(' ', $event->Nom)[0] . ' ' . $event->PrimerCognom . ' ' . $event->SegonCognom,
                        'start' => $start->format('Y-m-d'),
                        'end' => $end->format('Y-m-d'),
                        'color' => $colors[$id] ?? '#17a2b8',
                        'allDay' => true,
                    ];
                }
            }

            // Agregar eventos agrupados por usuario
            $groupedEvents = array_merge($groupedEvents, $mergedRanges);
        }

        // Obtener días festivos
        $holidays = DB::connection('girh')->table('GT_Festius')
            ->select('idFestius', 'Data', 'Descripcio', 'idCalendari')
            ->whereIn('idCalendari', [1, 5, 6])
            ->get()
            ->map(function ($holiday) {
                return [
                    'title' => $holiday->Descripcio,
                    'start' => Carbon::parse($holiday->Data)->format('Y-m-d'),
                ];
            });

        // Retornar la vista con los eventos agrupados
        return view('admin.calendar.index', compact('events', 'groupedEvents', 'colors', 'holidays'));
    }
}