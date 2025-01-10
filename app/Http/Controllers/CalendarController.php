<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\User;
use App\Models\Holiday;
use App\Models\Calendar;
use Illuminate\Http\Request;
use App\Models\CalendarEvent;
use Illuminate\Support\Facades\DB;

class CalendarController extends Controller
{
    public function __construct() {
        //
    }

    public function index()
    {
        $events = CalendarEvent::all();
        $users = User::role('admin')->whereNot('id', '=', 2)->whereNot('id', '=', 5)->get();
        $holidays = Holiday::all();
        $colors = ['#f56954', '#f39c12', '#00c0ef', '#0073b7', '#00a65a'];

        foreach ($holidays as $holiday) {
            $holidays[] = [
                'title' => $holiday->description,
                'start' => $holiday->date,
                'color' => ($holiday->type == 'special') ? 'red' : 'blue', // Rojo para especiales, azul para laborales
                'allDay' => true
            ];
        }

        // Contar los eventos por usuario
        $eventCounts = CalendarEvent::select('user_id', DB::raw('count(*) as total'))
        ->groupBy('user_id')
        ->get()
        ->keyBy('user_id');

        // Retornar la vista del calendario y pasarle los eventos
        return view('admin.calendar.index', compact('events', 'users', 'holidays', 'eventCounts', 'colors'));
    }

    public function store(Request $request)
    {
        // Validar los datos del evento
        $validated = $request->validate([
            'user_id' => 'required|exists:users,id',
            'title' => 'required|string',
            'start' => 'required|string',
            // 'end' => 'required|string',
            'backgroundColor' => 'required|string',
            'borderColor' => 'required|string',
            'textColor' => 'required|string'
        ]);

        // Crear un nuevo evento en la base de datos
        CalendarEvent::create([
            'user_id' => $validated['user_id'],
            'title' => $validated['title'],
            'start' => $validated['start'],
            // 'end' => $validated['end'],
            'backgroundColor' => $validated['backgroundColor'],
            'borderColor' => $validated['borderColor'], 
            'textColor' => $validated['textColor']
        ]);

        // Retornar una respuesta de éxito
        return response()->json(['message' => 'Evento guardado con éxito']);
    }

    public function update(Request $request, $id)
    {
        // Validar los datos recibidos
        $request->validate([
            // 'user_id' => 'required|exists:users,id',
            // 'title' => 'required|string',
            'start' => 'required|string',
            'end' => 'required|string'
        ]);

        // Buscar el evento por su ID
        $event = CalendarEvent::find($id);

        if (!$event) {
            return response()->json(['error' => 'Evento no encontrado.'], 404);
        }

        try {
            // Actualizar el evento con las nuevas fechas
            // $event->user_id = $request->input('user_id');
            // $event->title = $request->input('title');
            // $event->start = $request->input('start');
            // $event->end = $request->input('end');
            $event->start = Carbon::parse($request->start)->format('Y-m-d H:i:s');
            $event->end = $request->end ? Carbon::parse($request->end)->format('Y-m-d H:i:s') : null;
            $event->save();

            // Retornar una respuesta exitosa
            return response()->json(['message' => 'Evento actualizado con éxito.'], 200);
        } catch (\Exception $e) {
            // Manejar errores si no se puede actualizar el evento
            return response()->json(['error' => 'Error al actualizar el evento.'], 500);
        }
    }

    public function destroy($id)
    {
        $event = CalendarEvent::find($id);

        if (!$event) {
            return response()->json(['error' => 'Evento no encontrado.'], 404);
        }

        try {
            $event->delete();

            // Retornar una respuesta exitosa
            return response()->json(['message' => 'Evento eliminado con éxito.'], 200);
        } catch (\Exception $e) {
            // Manejar errores en caso de que no se pueda eliminar el evento
            return response()->json(['error' => 'Error al eliminar el evento.'], 500);
        }
    }

    // public function index()
    // {
    //     $users = User::role('admin')->get();


    //     $startDate = Carbon::createFromDate(now()->year, 1, 1);
    //     $endDate = Carbon::createFromDate(now()->year + 1, 1, 9);

    //     $calendarDays = [];
    //     $currentDate = $startDate->copy();

    //     while ($currentDate <= $endDate) {
    //         $calendarDays[] = $currentDate->copy();
    //         $currentDate->addDay();
    //     }

    //     $events = [];
    //     $colors = ['#f56954', '#563d7c', '#28a745', '#17a2b8'];
    //     $people = ['Persona 1', 'Persona 2', 'Persona 3', 'Persona 4'];

    //     // Inicializar el contador de eventos por persona
    //     $eventCounts = array_fill(0, count($people), 0);

    //     // Generar eventos semanales, cada persona una semana diferente
    //     for ($i = 0; $i < 52; $i++) {
    //         $person = $i % 4; // Para alternar entre las 4 people
    //         $startEvent = $startDate->copy()->addWeeks($i)->next(Carbon::FRIDAY)->setTime(18, 0);
    //         $endEvent = $startEvent->copy()->addWeek()->setTime(8, 0);

    //         $events[] = [
    //             'title' => $people[$person],
    //             'start' => $startEvent->toIso8601String(),
    //             'end' => $endEvent->toIso8601String(),
    //             'backgroundColor' => $colors[$person],
    //             'borderColor' => $colors[$person],
    //             'textColor' => '#FFFFFF'
    //         ];

    //         // Incrementar el contador para esa persona
    //         $eventCounts[$person]++;
    //     }

    //     // Generar festivos laborales (9 aleatorios)
    //     $laborHolidays = [];
    //     for ($i = 0; $i < 9; $i++) {
    //         $randomDate = Carbon::createFromDate(now()->year)->addWeeks(rand(0, 51))->setWeekday(rand(1, 5)); // Días laborales
    //         $personIndex = ($randomDate->ISOWeek() - 1) % count($people); // Asignar color según la semana
    //         $laborHolidays[] = [
    //             'title' => 'Festivo Laboral',
    //             'start' => $randomDate->toIso8601String(),
    //             'color' => $colors[$personIndex] // Color para festivos laborales
    //         ];
    //     }

    //     // Generar festivos especiales (6 aleatorios)
    //     $specialHolidays = [];
    //     for ($i = 0; $i < 6; $i++) {
    //         $randomDate = Carbon::createFromDate(now()->year)->addWeeks(rand(0, 51)); // Puede caer en cualquier día
    //         $personIndex = ($randomDate->ISOWeek() - 1) % count($people); // Asignar color según la semana
    //         $specialHolidays[] = [
    //             'title' => 'Festivo Especial',
    //             'start' => $randomDate->toIso8601String(),
    //             'color' => $colors[$personIndex] // Color para festivos especiales
    //         ];
    //     }

    //     return view('admin.calendar.index', compact('events', 'eventCounts', 'people', 'colors', 'laborHolidays', 'specialHolidays', 'users'));
    // }

    // public function store(Request $request)
    // {
    //     $calendar = Calendar::create([
    //         'year' => now()->year,
    //         'events' => json_encode($request->events)
    //     ]);

    //     return response()->json(['message' => 'Calendario guardado correctamente']);
    // }

    // public function destroy($id)
    // {
    //     // Encuentra el evento por ID y elimínalo
    //     $event = Calendar::findOrFail($id);
    //     $event->delete();

    //     return response()->json(['success' => true]);
    // }
}
