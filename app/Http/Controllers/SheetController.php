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
    public function index()
    {
        $sheets = Sheet::paginate(20);
        $workers = User::where('status', 1)->whereHas("roles", function ($q) {
            $q->where("id", 2);
        })->get();
        return view('sheet.index', \compact('sheets', 'workers'));
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
            return \redirect()->back();
        } else {
            toastr()->error('Something went wrong');
            return \redirect()->back();
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
        //
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
            return 'Sheet updated';
        } else {
            return 'Something went wrong';
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Sheet  $sheet
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    { }
}
