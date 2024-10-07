<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Calendar;
use Illuminate\Http\Request;

class CalendarController extends Controller
{

    public function index()
    {
        $startDate = Carbon::createFromDate(now()->year, 1, 1);
        $endDate = Carbon::createFromDate(now()->year + 1, 1, 9);

        $calendarDays = [];
        $currentDate = $startDate->copy();

        while ($currentDate <= $endDate) {
            $calendarDays[] = $currentDate->copy();
            $currentDate->addDay();
        }

        $events = [];
        $colors = ['#f56954', '#563d7c', '#28a745', '#17a2b8'];
        $people = ['Persona 1', 'Persona 2', 'Persona 3', 'Persona 4'];

        // Inicializar el contador de eventos por persona
        $eventCounts = array_fill(0, count($people), 0);

        // Generar eventos semanales, cada persona una semana diferente
        for ($i = 0; $i < 52; $i++) {
            $person = $i % 4; // Para alternar entre las 4 people
            $startEvent = $startDate->copy()->addWeeks($i)->next(Carbon::FRIDAY)->setTime(18, 0);
            $endEvent = $startEvent->copy()->addWeek()->setTime(8, 0);

            $events[] = [
                'title' => $people[$person],
                'start' => $startEvent->toIso8601String(),
                'end' => $endEvent->toIso8601String(),
                'backgroundColor' => $colors[$person],
                'borderColor' => $colors[$person],
                'textColor' => '#FFFFFF'
            ];

            // Incrementar el contador para esa persona
            $eventCounts[$person]++;
        }

        // Generar festivos laborales (9 aleatorios)
        $laborHolidays = [];
        for ($i = 0; $i < 9; $i++) {
            $randomDate = Carbon::createFromDate(now()->year)->addWeeks(rand(0, 51))->setWeekday(rand(1, 5)); // Días laborales
            $personIndex = ($randomDate->ISOWeek() - 1) % count($people); // Asignar color según la semana
            $laborHolidays[] = [
                'title' => 'Festivo Laboral',
                'start' => $randomDate->toIso8601String(),
                'color' => $colors[$personIndex] // Color para festivos laborales
            ];
        }

        // Generar festivos especiales (6 aleatorios)
        $specialHolidays = [];
        for ($i = 0; $i < 6; $i++) {
            $randomDate = Carbon::createFromDate(now()->year)->addWeeks(rand(0, 51)); // Puede caer en cualquier día
            $personIndex = ($randomDate->ISOWeek() - 1) % count($people); // Asignar color según la semana
            $specialHolidays[] = [
                'title' => 'Festivo Especial',
                'start' => $randomDate->toIso8601String(),
                'color' => $colors[$personIndex] // Color para festivos especiales
            ];
        }

        return view('admin.calendar.index', compact('events', 'eventCounts', 'people', 'colors', 'laborHolidays', 'specialHolidays'));
    }

    public function store(Request $request)
    {
        $calendar = Calendar::create([
            'year' => now()->year,
            'events' => json_encode($request->events)
        ]);

        return response()->json(['message' => 'Calendario guardado correctamente']);
    }

    public function destroy($id)
    {
        // Encuentra el evento por ID y elimínalo
        $event = Calendar::findOrFail($id);
        $event->delete();

        return response()->json(['success' => true]);
    }
}
