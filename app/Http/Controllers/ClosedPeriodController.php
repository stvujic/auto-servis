<?php

namespace App\Http\Controllers;

use App\Models\ClosedPeriod;
use App\Models\Workshop;
use Illuminate\Http\Request;

class ClosedPeriodController extends Controller
{
    private function ensureOwnerOf(Workshop $workshop)
    {
        abort_unless(auth()->check() && auth()->user()->role === 'owner' && $workshop-> owner_id === auth()->id(), 403);
    }
    /**
     * Display a listing of the resource.
     */
    public function index(Workshop $workshop)
    {
        $this->ensureOwnerOf($workshop);
        $periods = $workshop->closedPeriods()->orderBy('starts_at')->get();
        return view('owner.closed_periods.index', compact('periods', 'workshop'));
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
            'starts_at' => ['required','date','before:ends_at'],
            'ends_at'   => ['required','date','after:starts_at'],
            'reason'    => ['nullable','string','max:255'],
        ]);

        $workshop->closedPeriods()->create($data);
        return back()->with('success', 'Workshop closed period added');
    }

    /**
     * Display the specified resource.
     */
    public function show(ClosedPeriod $closedPeriod)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(ClosedPeriod $closedPeriod)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, ClosedPeriod $closedPeriod)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(ClosedPeriod $closedPeriod)
    {
        $workshop = $closedPeriod->workshop;
        $this->ensureOwnerOf($workshop);

        $closedPeriod->delete();
        return back()->with('success', 'Workshop closed period deleted');
    }
}
