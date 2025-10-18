<?php

namespace App\Http\Controllers;

use App\Models\WorkingHour;
use App\Models\Workshop;
use Illuminate\Http\Request;

class WorkingHourController extends Controller
{
    private function ensureOwnerOf(Workshop $workshop)
    {
        abort_unless(auth()->check() && auth()->user()->role === 'owner' && $workshop->owner_id === auth()->id(), 403);
    }

    /**
     * Display a listing of the resource.
     */
    public function index(Workshop $workshop)
    {
        $this->ensureOwnerOf($workshop);
        $hours = $workshop->workingHours()->orderBy('day_of_week')->get();
        return view('owner.working_hours.index', compact('workshop', 'hours'));
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
    public function store(Request $request, Workshop $workshop)
    {
        $this->ensureOwnerOf($workshop);

        $data = $request->validate([
            'day_of_week' => ['required','integer','between:0,6'],
            'open_at'     => ['required','date_format:H:i'],
            'close_at'    => ['required','date_format:H:i','after:open_at'],
            'break_start' => ['nullable','date_format:H:i'],
            'break_end'   => ['nullable','date_format:H:i','after:break_start'],
        ]);

        abort_if(
            WorkingHour::where('workshop_id',$workshop->id)
                ->where('day_of_week',$data['day_of_week'])
                ->exists(),422, 'Working hours already exists for this day'
        );

        $workshop->workingHours()->create($data);

        return back()->with('success', 'Working hours has been created');
    }

    /**
     * Display the specified resource.
     */
    public function show(WorkingHour $workingHour)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(WorkingHour $workingHour)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, WorkingHour $workingHour)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(WorkingHour $workingHour)
    {
        $workshop = $workingHour->workshop;
        $this->ensureOwnerOf($workshop);

        $workingHour->delete();
        return back()->with('success', 'Working hours has been deleted');
    }
}
