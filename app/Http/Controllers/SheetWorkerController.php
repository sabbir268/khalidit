<?php

namespace App\Http\Controllers;

use App\LeadTracker;
use App\Sheet;
use App\SheetWorker;
use App\User;
use Illuminate\Http\Request;
use Carbon\Carbon;


class SheetWorkerController extends Controller
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
            'sheet_id' => 'required',
            'user_id'  => 'required',
            'rate'     => 'required|numeric',
        ]);

        if (SheetWorker::where('sheet_id', $request->sheet_id)->where('user_id', $request->user_id)->count() != 0) {
            return ['status' => 'error', 'message' => 'Worker already added in this sheet'];
        }

        $sheetWorker = SheetWorker::create($data);
        if ($sheetWorker) {
            return ['status' => 'success', 'message' => 'Worker added successfully!'];
        } else {
            return ['status' => 'error', 'message' => 'Something went wrong'];
        }
    }

    public function getWorkers($sheet_id)
    {
        return $workers = SheetWorker::where('sheet_id', $sheet_id)->get();
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\SheetWorker  $sheetWorker
     * @return \Illuminate\Http\Response
     */
    public function show(SheetWorker $sheetWorker)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\SheetWorker  $sheetWorker
     * @return \Illuminate\Http\Response
     */
    public function edit(SheetWorker $sheetWorker)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\SheetWorker  $sheetWorker
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, SheetWorker $sheetWorker)
    {
        $data = $request->validate([
            'rate'     => 'required|numeric',
        ]);

        $sheetWorker = SheetWorker::create($data);
        if ($sheetWorker) {
            return 'Rate updated';
        } else {
            return 'Something went wrong';
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\SheetWorker  $sheetWorker
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    { }

    public function removeWorkers($id)
    {
        $sheetWorker = SheetWorker::find($id);
        if ($sheetWorker->delete()) {
            return 'success';
        } else {
            return 'error';
        }
    }

    public function report()
    {
        $month = month(date('m'));
        $userIds = SheetWorker::whereBetween('created_at', $month)->pluck('user_id')->toArray();
        $workers = User::whereIn('id', $userIds)->paginate(20);
        return view('sheet.reports', compact('workers', 'month'));
    }

    public function reportByMonth($month)
    {
        if (!strrchr($month, ",")) {
            $month = Carbon::parse($month)->month;
            $month = month($month);
        } else {
            $month = explode(",", $month);
        }
        $userIds = SheetWorker::whereBetween('created_at', $month)->pluck('user_id')->toArray();
        $workers = User::whereIn('id', $userIds)->paginate(20);
        return view('sheet.reports', compact('workers', 'month'));
    }

    // public function reportByDate($dates)
    // {
    //     if (strlen($dates) <= 2) {
    //         $dates = month($dates);
    //     } else {
    //         return $dates = explode(",", $dates);
    //     }

    //     $sheetWorkersIds = LeadTracker::whereBetween('date', $dates)->pluck('sheet_worker_id')->toArray();
    //     $userIds = SheetWorker::whereIn('id', $sheetWorkersIds)->pluck('user_id')->toArray();
    //     $workers = User::whereIn('id', $userIds)->paginate(20);
    //     return view('sheet.reports', compact('workers', 'month'));
    // }


    public function reportDetailsUser($user_id, $dates)
    {
        if (strlen($dates) <= 2) {
            $dates = month($dates);
        } else {
            $dates = explode(",", $dates);
        }
        $sheetWorkersIds = LeadTracker::whereBetween('date', $dates)->pluck('sheet_worker_id')->toArray();
        $sheet_ids = SheetWorker::where('user_id', $user_id)->pluck('sheet_id')->toArray();
        $sheets = Sheet::whereIn('id', $sheet_ids)->get();
        $user = User::find($user_id);
        return view('sheet.details', compact('sheets', 'user'));
    }
}
