<?php

namespace App\Http\Controllers\Master;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Model\Master\Worker;
use App\user;
use Yajra\DataTables\DataTables;
use Illuminate\Http\JsonResponse;
// use Yajra\Datatables\Facades\Datatables;
// use Yajra\Datatables\Facades\Datatables;
// use Datatables;
// use Yajra\Datatables\Datatables;




class WorkerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('Worker.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('Worker.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = new Worker();
        $data->name = $request->name;
        $data->code = $request->code;
        $data->price = $request->price;
        $data->user_modified = $request->user()->id;
        $data->status = $request->status;

        if($data->save()){
            return redirect()->route('worker.index');
        }else{
            return redirect()->back();
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $data = worker::with(['user_modify'])->where('id',$id)->get();
        if($data->count() > 0){
            return view('worker.view',compact('data'));
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $data = worker::where('id',$id)->get();
        if($data->count() > 0){
            return view('worker.update',compact('data'));
        }
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
        $data = Worker::find($id);
        $data->name = $request->name;
        $data->code = $request->code;
        $data->price = $request->price;
        $data->user_modified = $request->user()->id;
        $data->status = $request->status;

        if($data->save()){
            return redirect()->route('worker.index');
        }else{
            return redirect()->back();
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $data = worker::find($id);
        $data->status = 1;
        // $data->user_modified=Auth::user()->id;
        if($data->save()){
            return new JsonResponse(["status"=>true]); 
        }else{
            return new JsonResponse(["status"=>false]); 
        }
    }
    
    public function datatable(){
        $data = worker::all();
        // return Datatables::of(worker::query())->make(true);
        // return Datatables::of(DB::table('workers'))->make(true);

        return Datatables::of($data)
        ->addColumn('action',function($data){
            $url_edit = url('master/worker/'.$data->id.'/edit');
            $url = url('master/worker/'.$data->id);
            $view = "<a class='btn btn-action btn-primary' href='".$url."' title='View'><i class='nav-icon fas fa-eye'></i></a>";
            $edit = "<a class='btn btn-action btn-warning' href='".$url_edit."' title='Edit'><i class='nav-icon fas fa-edit'></i></a>";
            $delete = "<button data-url='".$url."'onclick='deleteData(this)' class='btn btn-action btn-danger' title='Delete'><i class='nav-icon fas fa-trash-alt'></button>";

            return $view."".$edit."".$delete;
        })
        ->editColumn('name', function($data){
            return str_ireplace("\r\n",',',$data->name);
        })
        ->editColumn('code', function($data){
            return str_ireplace("\r\n",',',$data->code);
        })
        ->rawColumns(['action'])
        ->editColumn('id','ID:{{$id}}')
        ->make(true);

        return view('Worker.index');
    }
}
