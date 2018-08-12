<?php

namespace App\Http\Controllers\admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use Illuminate\Http\Response;
//use Session;
use App\Admin;

use Illuminate\Support\Facades\Hash;

class LoginController extends Controller
{
     public function index(){
     	return view('admin.login');
    }
    public function login(Request $request){
      
      //$request->session()->forget('admin');
      //$request->session()->flush();
      
      $admin = Admin::select(['name','email','password'])->where('email',$request->email)->first();

      if(isset($admin->email)){
      	if(Hash::check($request->password,$admin->password)) {

          session(['admin' => ['username'=>$admin->name,'email'=>$admin->email] ]);
          if(isset($request->remember_me)){
            return redirect()->route('dashboard')
                                    ->with('success','Loggen successfully.')->withCookie(cookie()->forever('remember_me', 'ok'));
          }else{
            return redirect()->route('dashboard')
                                    ->with('success','Loggen successfully.');
          }
                
            } else {
                return redirect()->route('adminlogin')
                        ->with('failed','Loggen unsuccessfully.');
            }
        }else{
			return redirect()->route('adminlogin')
                        ->with('failed','Loggen unsuccessfully.');
        }
        
        
       
    }

    public function logout(Request $request){
      $request->session()->forget('admin');
      $cookie = \Cookie::forget('remember_me');

      return redirect()->route('adminlogin')
                        ->with('failed','Loggen unsuccessfully.')->withCookie($cookie);;
    }

     public function setCookie(Request $request){
      
      $response = new Response('Hello World');
      $response->withCookie(cookie()->forever('name', 'virat'));

      return $response;
   }

}
