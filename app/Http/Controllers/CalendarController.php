<?php

namespace App\Http\Controllers;

use App\Models\Event;
use Illuminate\Http\Request;

class CalendarController extends Controller
{
    public function show()
    {
        return view('page.calendar')
            ->with('title', 'Calendar');
    }

    public function getAllCalendar(Request $request)
    {

        $date = Event::whereDate('start', '>=', $request->start)
            ->whereDate('end', '<=', $request->end)
            ->get();

        return response()->json($date);
    }

    public function showAddSchedule()
    {
        return view('page.add_schedule')
            ->with('title', 'Add Schedule');
    }

    public function postAddSchedule(Request $request)
    {
        $request->validate([
            'event' => ['required'],
            'tanggal' => ['required']
        ]);

        $checkbox = $request->post('oneday');
        $titleEvent = $request->post('event');
        $baseDate = $request->post('tanggal') . ' ';

        $dateStart = '';
        $dateEnd = '';

        if ($checkbox == 'on') {
            $dateStart = date_create($baseDate . '00:00');
            $dateEnd = date_create($baseDate . '23:59');
        } else {
            $dateStart = date_create($baseDate . $request->post('jam_start'));
            $dateEnd = date_create($baseDate . $request->post('jam_end'));
        }

        $status = Event::create([
            'id_event' => uniqid('evnt-'),
            'title' => $titleEvent,
            'start' => $dateStart,
            'end' => $dateEnd
        ]);

        if ($status) {
            return redirect()->route('calendar')
                ->with('message', 'Berhasil menambahkan Event')
                ->with('status', 'success');
        } else {
            return redirect()->route('calendar')
                ->with('message', 'Gagal menambahkan Event')
                ->with('status', 'danger');
        }
    }
}
