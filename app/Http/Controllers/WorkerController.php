<?php

namespace App\Http\Controllers;

use App\User;
use App\Worker;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class WorkerController extends Controller
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
            'name' => 'required|string',
            'phone' => 'required|unique:workers',
            'gd_phone' => 'required',
            'email' => 'email|unique:workers',
            'fb_link' => 'required',
            'pr_address' => 'required|string',
            'cr_address' => 'required|string',
            'study' => 'required',
            'ssc_batch' => 'required|numeric',
            'roll' => 'required|numeric',
            'registration' => 'required|numeric',
            'board' => 'required|string',
            'online_experience' => 'required',
            'dob' => 'required',
            'misc' => 'required|string',
            'doc' => 'nullable|mimes:pdf',
            'photo' => 'required|mimes:jpeg,png,jpg',
            'password' => 'required|confirmed'
        ]);
        $data['password'] = bcrypt($request->password);
        if ($request->hasFile('doc')) {
            $data['doc'] = $request->file('doc')->store('/documents', 'public');
        }
        if ($request->hasFile('photo')) {
            $data['photo'] = $request->file('photo')->store('/documents', 'public');
        }

        if ($user = User::create($data)) {
            $user->assignRole(2);
            $data['user_id'] = $user->id;
            Worker::create($data);
            $credentials = $request->only('email', 'password');
            if (Auth::attempt($credentials)) {
                return redirect()->route('home');
            } else {
                return 'Something went wrong';
            }
        } else {
            toastr()->error('Something went wrong');
            return redirect()->back();
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Worker  $worker
     * @return \Illuminate\Http\Response
     */
    public function show(Worker $worker)
    {
        return view('user.view', compact('worker'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Worker  $worker
     * @return \Illuminate\Http\Response
     */
    public function edit(Worker $worker)
    {
        return view('user.edit', compact('worker'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Worker  $worker
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Worker $worker)
    {

        $data = $request->validate([
            'name' => 'required|string',
            'phone' => 'required|unique:workers,phone,' . $worker->id,
            'gd_phone' => 'required',
            'email' => 'email|unique:workers,email,' . $worker->id,
            'fb_link' => 'required',
            'pr_address' => 'required|string',
            'cr_address' => 'required|string',
            'study' => 'required',
            'ssc_batch' => 'required|numeric',
            'roll' => 'required|numeric',
            'registration' => 'required|numeric',
            'board' => 'required|string',
            'online_experience' => 'required',
            'dob' => 'required',
            'misc' => 'required|string',
        ]);
        $data['password'] = bcrypt($request->password);
        if ($request->hasFile('doc')) {
            $data['doc'] = $request->file('doc')->store('/documents', 'public');
        }
        if ($request->hasFile('photo')) {
            $data['photo'] = $request->file('photo')->store('/documents', 'public');
        }
        if ($data['name'] != $worker->user->name) {
            $worker->user->update(['name' => $data['name']]);
        }
        if ($data['email'] != $worker->user->email) {
            $worker->user->update(['email' => $data['email']]);
        }

        if ($worker->update($data)) {
            toastr()->success('Info updated successfully!');
            return redirect('/user');
        } else {
            toastr()->error('Something went wrong!');
            return redirect()->back();
        }



        // if ($user = User::create($data)) {
        //     $user->assignRole(2);
        //     $data['user_id'] = $user->id;
        //     Worker::create($data);
        //     $credentials = $request->only('email', 'password');
        //     if (Auth::attempt($credentials)) {
        //         return redirect()->route('home');
        //     } else {
        //         return 'Something went wrong';
        //     }
        // } else {
        //     toastr()->error('Something went wrong');
        //     return redirect()->back();
        // }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Worker  $worker
     * @return \Illuminate\Http\Response
     */
    public function destroy(Worker $worker)
    {
        $user = User::find($worker->user_id);
        if ($user->delete()) {
            if ($worker->delete()) {
                toastr()->success('Worker deleted successfully!');
                return redirect()->back();
            } else {
                toastr()->error('Something went wrong');
                return redirect()->back();
            }
        } else {
            toastr()->error('Something went wrong');
            return redirect()->back();
        }
    }
}
