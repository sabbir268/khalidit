<?php

namespace App\Http\Controllers;

use App\Bill;
use Illuminate\Http\Request;

class BillController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $bills = Bill::orderBy('id', 'DESC')->paginate(20);
        return view('bill.index', \compact('bills'));
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
            'user_id' => 'required',
            'report_url' => 'required',
            'extra_addition' => 'nullable',
            'extra_addition_comment' => 'nullable',
            'deduction' => 'nullable',
            'deduction_comment' => 'nullable',
            'total' => 'required',
            'total_lead' => 'required',
            'month' => 'nullable',
        ]);

        if (Bill::create($data)) {
            toastr()->success('Bill generated successfully!');
        } else {
            toastr()->error('Something went wrong!');
        }

        return redirect()->back();
    }


    public function filter($month)
    {
        $bills = Bill::where('month', $month)->orderBy('id', 'DESC')->paginate(20);
        return view('bill.index', \compact('bills', 'month'));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Bill  $bill
     * @return \Illuminate\Http\Response
     */
    public function show(Bill $bill)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Bill  $bill
     * @return \Illuminate\Http\Response
     */
    public function edit(Bill $bill)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Bill  $bill
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Bill $bill)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Bill  $bill
     * @return \Illuminate\Http\Response
     */
    public function destroy(Bill $bill)
    {
        //
    }
}
