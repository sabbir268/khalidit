<?php

namespace App\Http\Controllers;

use App\LeadTracker;
use App\Sheet;
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
            'sheet_worker_id' => 'required',
        ]);
        $data['earn'] = 0; //this is for mutate in model

        $leadTracker = LeadTracker::create($data);
        if ($leadTracker) {
            $sheet = Sheet::find($leadTracker->sheetWorker->sheet_id);
            if (totalLeadBySheet($leadTracker->sheetWorker->sheet_id) > $sheet->target) {
                $sheet->status = 1;
                $sheet->save();
            }
            return ['status' => 'success', 'message' => 'Leads count added successfully!'];
        } else {
            return ['status' => 'error', 'message' => 'Something went wrong!'];
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
