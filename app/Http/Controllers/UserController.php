<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $workers = User::whereHas("roles", function ($q) {
            $q->where("id", 2);
        })->where('status', 1)->paginate(20);
        return view('user.index', compact('workers'));
    }

    public function new()
    {
        $workers = User::whereHas("roles", function ($q) {
            $q->where("id", 2);
        })->where('status', 0)->paginate(20);
        return view('user.new', compact('workers'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('user.create');
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
            'name'  =>  'required|string',
            'email' =>  'required|email',
            'code'  =>  'required',
        ]);
        $data['password'] = $request->has('password') ? bcrypt($request->password) : bcrypt(123789);
        $data['status'] = 1;

        $user = User::create($data);

        if ($user) {

            if ($request->has('type') && $request->type == 'admin') {
                $user->assignRole(1);
            } else {
                $user->assignRole(2);
            }
            toastr()->success('User created');
            return redirect()->back();
        } else {
            toastr()->error('Something went wrong');
            return redirect()->back();
        }
    }

    public function varifyEmail($encryptId, $email)
    {
        $user = User::where('email', $email)->first();
        if ($user) {
            if ($user->email_verified_at) {
                toastr()->info('Your email is already verified!');
                return view('home');
            }
            if (md5($user->id) == $encryptId) {
                $user->email_verified_at = date('Y-m-d h:m:s');
                if ($user->save()) {
                    toastr()->success('Your email is verified successfully!');
                    return view('home');
                }
            } else {
                toastr()->error('Email is verification failed!');
                return view('home');
            }
        } else {
            toastr()->error('Email is verification failed!');
            return view('home');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function sheetRunnig($user_id)
    {
        $user = User::find($user_id);
        return view('user.workingsheet', compact('user'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function statusChange(Request $request)
    {
        $user = User::find($request->user_id);
        if (($user->code == '' || $user->code == null) && $request->has('code')) {
            $user->code = $request->code;
        }
        $user->status = $request->status;

        if ($user->save()) {
            return "success";
        } else {
            return "error";
        }
    }
}
