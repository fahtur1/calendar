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

    public function showEditSchedule($id = '')
    {
        $event = Event::find($id);

        $tanggalMulai = strtotime($event->start);
        $tanggalSelesai = strtotime($event->end);

        $data = [
            'id' => $event->id_event,
            'title' => $event->title,
            'tanggal' => date('d-m-Y', $tanggalMulai),
            'start' => date('H:i', $tanggalMulai),
            'end' => date('H:i', $tanggalSelesai),
            'isChecked' => (date('H', $tanggalMulai) == '00') ? true : false
        ];

        return view('page.edit_schedule')
            ->with('title', 'Edit Schedule')
            ->with('event', $data);
    }

    public function deleteSchedule($id = '')
    {
        $event = Event::find($id);

        if ($event->delete()) {
            return redirect()->route('calendar')
                ->with('message', 'Berhasil menghapus Event')
                ->with('status', 'success');
        }
        return redirect()->route('calendar')
            ->with('message', 'Gagal menghapus Event')
            ->with('status', 'danger');
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

    public function postEditSchedule(Request $request, $id)
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


        $event = Event::find($id);

        $status = $event->update([
            'title' => $titleEvent,
            'start' => $dateStart,
            'end' => $dateEnd
        ]);

        if ($status) {
            return redirect()->route('calendar')
                ->with('message', 'Berhasil mengedit Event')
                ->with('status', 'success');
        }

        return redirect()->route('calendar')
            ->with('message', 'Gagal mengedit Event')
            ->with('status', 'danger');
    }
}
