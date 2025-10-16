<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreWorkshopRequest;
use App\Http\Requests\UpdateWorkshopRequest;
use App\Models\Workshop;
use Illuminate\Http\Request;

class WorkshopController extends Controller
{
    private function ensureOwner()
    {
        abort_unless(auth()->check() && auth()->user()-> role === 'owner', 403);
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $workshops = Workshop::where('is_verified', true)
            ->withCount('reviews')
            ->paginate(10);

        return view('workshops.index', compact('workshops'));
    }

    public function ownerIndex()
    {
        $this->ensureOwner();
        $workshops = Workshop::where('owner_id', auth()->id())->paginate(10);
        return view('owner.workshops.index', compact('workshops'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $this->ensureOwner();
        return view('owner.workshops.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreWorkshopRequest $request)
    {
        $this->ensureOwner();

        $data = $request->validated(); // nema owner_id u formi
        // kreira preko relacije, Eloquent sam dodaje owner_id
        $request->user()->workshops()->create($data);

        return redirect()->route('owner.workshops.index')->with('success','Workshop created successfully');
    }


    /**
     * Display the specified resource.
     */
    public function show(Workshop $workshop)
    {
        $workshop->load([
            'services.serviceType',
            'workingHours',
            'reviews' => function($query) {
            $query->latest()->limit(10);
            },
        ]);
        return view('workshops.show', compact('workshop'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Workshop $workshop)
    {
        $this->ensureOwner();
        abort_unless($workshop->owner_id === auth()->id(), 403);
        return view('owner.workshops.edit', compact('workshop'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateWorkshopRequest $request, Workshop $workshop)
    {
        $this->ensureOwner();
        abort_unless($workshop->owner_id === auth()->id(), 403);

        $workshop->update($request->validated());

        return redirect()->route('owner.workshops.index')->with('success', 'Workshop updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Workshop $workshop)
    {
        $this->ensureOwner();
        abort_unless($workshop->owner_id === auth()->id(), 403);

        $workshop->delete();
        return redirect()->route('owner.workshops.index')->with('success', 'Workshop deleted successfully');
    }
}
