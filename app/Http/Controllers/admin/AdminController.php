<?php

namespace App\Http\Controllers\admin;

use App\Admin;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use File;
use Yajra\Datatables\Datatables as Datatables;

use Illuminate\Support\Facades\Hash;

class AdminController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
     public function getBasicData()
    {
        
        $admins = Admin::select(['name','email','created_at'])->get();
        $xx= Datatables::of($admins)->make();
        
        return $xx;
        
    }

    public function index()
    {
        $title='Admin';
         $admins = Admin::limit(10)->get();
        
        return view('admin.admins.index',compact('title','admins'))->with('i', (request()->input('page', 1) - 1) * 5);
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $title='Admin';
         return view('admin.admins.create',compact('title'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request,Admin $admin)
    {
          request()->validate([
            'name' => 'required',
            'email' => 'required|string|email|max:255|unique:admins,email,' . $admin->id . ',_id',
            'password' => 'required',
        ]);
          /*
        if(Hash::check('admin',bcrypt($request->password))) {
                echo 'yes';
            } else {
                echo 'no';
            }
        die();
       */
        Admin::create(array_merge( $request->all(), ['password' => bcrypt($request->password) ]));


        return redirect()->route('admins.index')
                        ->with('success','Admin created successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Admin  $admin
     * @return \Illuminate\Http\Response
     */
    public function show(Admin $admin)
    {
        $title='Admin';
        return view('admin.admins.show',compact('admin','title'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Admin  $admin
     * @return \Illuminate\Http\Response
     */
    public function edit(Admin $admin)
    {
         $title='Admin';
        return view('admin.admins.edit',compact('admin','title'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Admin  $admin
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Admin $admin)
    {
         request()->validate([
            'name' => 'required',
            'email' => 'required|string|email|max:255|unique:admins,email,' . $admin->id . ',_id',
        ]);
        if($request->password){
            $admin->update(array_merge( $request->all(), ['password' => bcrypt($request->password) ]));
            
        }else{
            $admin->update($request->all());
            
        }
        return redirect()->route('admins.index')
                        ->with('success','Admin updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Admin  $admin
     * @return \Illuminate\Http\Response
     */
    public function destroy(Admin $admin)
    {
        $admin->delete();
        return redirect()->route('admins.index')
                        ->with('success','Admin deleted successfully');
    }
}
