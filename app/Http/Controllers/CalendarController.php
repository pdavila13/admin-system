<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use Illuminate\Http\Request;

class CalendarController extends Controller
{
    /**
     * Display a listing of the resource.
     */
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
        $colors = ['#FF0000', '#00FF00', '#0000FF', '#FFFF00']; // Diferentes colores
        for ($i = 0; $i < 52; $i++) {
            foreach (range(0, 3) as $person) {
                $startEvent = $startDate->copy()->next(Carbon::FRIDAY)->addWeeks($i)->setTime(18, 0);
                $endEvent = $startEvent->copy()->addWeek()->setTime(8, 0);

                $events[] = [
                    'title' => 'Evento persona ' . ($person + 1),
                    'start' => $startEvent->toIso8601String(),
                    'end' => $endEvent->toIso8601String(),
                    'color' => $colors[$person]
                ];
            }
        }

        // Generar festivos laborales
        $laborHolidays = [];
        for ($i = 0; $i < 9; $i++) {
            $randomDate = Carbon::createFromDate(now()->year)->addWeeks(rand(0, 51))->setWeekDay(rand(1, 5)); // Días laborales
            $laborHolidays[] = [
                'title' => 'Festivo Laboral',
                'start' => $randomDate->toIso8601String(),
                'color' => '#FF5733' // Color para festivos laborales
            ];
        }

        // Generar festivos especiales
        $specialHolidays = [];
        for ($i = 0; $i < 6; $i++) {
            $randomDate = Carbon::createFromDate(now()->year)->addWeeks(rand(0, 51)); // Puede caer en cualquier día
            $specialHolidays[] = [
                'title' => 'Festivo Especial',
                'start' => $randomDate->toIso8601String(),
                'color' => '#33FF57' // Color para festivos especiales
            ];
        }

        // Unir todos los eventos
        $events = array_merge($events, $laborHolidays, $specialHolidays);

        return view('admin.calendar.index', compact('calendarDays', 'events'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
