<?php

namespace App\Http\Controllers;

use App\SheetWorker;
use Illuminate\Http\Request;

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
}
