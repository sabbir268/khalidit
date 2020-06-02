<?php

namespace App\Http\Controllers;

use App\Sheet;
use App\User;
use Illuminate\Http\Request;

class SheetController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if ($request->has('name')) {
            $sheets = Sheet::where('name', 'like', '%' . $request->name . '%')->where('status', 0)->orderBy('id', 'DESC')->paginate(20);
        } else {
            $sheets = Sheet::where('status', 0)->orderBy('id', 'DESC')->paginate(20);
        }
        $workers = User::where('status', 1)->whereHas("roles", function ($q) {
            $q->where("id", 2);
        })->get();
        return view('sheet.index', compact('sheets', 'workers'));
    }

    public function completed(Request $request)
    {
        if ($request->has('name')) {
            $sheets = Sheet::where('name', 'like', '%' . $request->name . '%')->where('status', 1)->orderBy('id', 'DESC')->paginate(20);
        } else {
            $sheets = Sheet::where('status', 1)->orderBy('id', 'DESC')->paginate(20);
        }
        $workers = User::where('status', 1)->whereHas("roles", function ($q) {
            $q->where("id", 2);
        })->get();
        return view('sheet.done', compact('sheets', 'workers'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('sheet.create');
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
            'name' => 'required|string',
            'link' => 'required|string',
            'rate' => 'required|numeric',
            'target' => 'required|numeric',
        ]);

        $sheet = Sheet::create($data);
        if ($sheet) {
            toastr()->success('Sheet added successfully!');
            return redirect()->back();
        } else {
            toastr()->error('Something went wrong');
            return redirect()->back();
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Sheet  $sheet
     * @return \Illuminate\Http\Response
     */
    public function show(Sheet $sheet)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Sheet  $sheet
     * @return \Illuminate\Http\Response
     */
    public function edit(Sheet $sheet)
    {
        return view('sheet.edit', compact('sheet'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Sheet  $sheet
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Sheet $sheet)
    {
        $data = $request->validate([
            'name' => 'required|string',
            'link' => 'required|string',
            'rate' => 'required|numeric',
            'target' => 'required|numeric',
        ]);

        $sheet = $sheet->update($data);
        if ($sheet) {
            toastr()->success('Sheet update successfully!');
            return \redirect()->back();
        } else {
            toastr()->error('Something went wrong');
            return \redirect()->back();
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Sheet  $sheet
     * @return \Illuminate\Http\Response
     */
    public function destroy(Sheet $sheet)
    {
        if ($sheet->delete()) {
            toastr()->success('Sheet deleted successfully!');
            return \redirect()->back();
        } else {
            toastr()->error('Something went wrong');
            return \redirect()->back();
        }
    }

    public function markDone($id)
    {
        $sheet = Sheet::find($id);
        $sheet->status = 1;
        if ($sheet->save()) {
            toastr()->success('Sheet mark as done successfully!');
            return \redirect()->back();
        } else {
            toastr()->error('Something went wrong');
            return \redirect()->back();
        }
    }
    public function markUnDone($id)
    {
        $sheet = Sheet::find($id);
        $sheet->status = 0;
        if ($sheet->save()) {
            toastr()->success('Sheet mark as done undo successfully!');
            return \redirect()->back();
        } else {
            toastr()->error('Something went wrong');
            return \redirect()->back();
        }
    }
}
