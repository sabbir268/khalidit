<?php

namespace App\Http\Controllers;

use App\LeadTracker;
use Illuminate\Http\Request;

class LeadTrackerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            'lead_count' => 'required|numeric',
            'date'       => 'required',
        ]);

        $leadTracker = LeadTracker::create($data);
        if ($leadTracker) {
            return 'Todays total lead count added successfully!';
        } else {
            return 'Something went wrong';
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\LeadTracker  $leadTracker
     * @return \Illuminate\Http\Response
     */
    public function show(LeadTracker $leadTracker)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\LeadTracker  $leadTracker
     * @return \Illuminate\Http\Response
     */
    public function edit(LeadTracker $leadTracker)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\LeadTracker  $leadTracker
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, LeadTracker $leadTracker)
    {
        $data = $request->validate([
            'lead_count' => 'required|numeric',
            'date'       => 'required',
        ]);

        $leadTracker = $leadTracker->update($data);
        if ($leadTracker) {
            return 'Lead count entry updated successfully!';
        } else {
            return 'Something went wrong';
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\LeadTracker  $leadTracker
     * @return \Illuminate\Http\Response
     */
    public function destroy(LeadTracker $leadTracker)
    {
        $leadTracker->delete();
    }
}
