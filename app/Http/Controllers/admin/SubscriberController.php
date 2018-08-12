<?php

namespace App\Http\Controllers\admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Subscriber;

class SubscriberController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
   
    public function index()
    {
        echo Subscriber::where('country', 'Egypt')->where('osversion', 'Android 4.0')->count();
       
        $countries=['Canada','Egypt','United states','Australia','Germany','Mexico','Italy','Belgium'];

        $model=['10 Viking II','10 Viking Pro','10DTB12','11 Galileo Pro','9015B POP 7','A95X Pro','Android 4.4 Tablet'];

        $osversion=['Android 4.0','Android 4.1','Android 4.3','Android 5.0','Android 6.0','Android 7.0','Android 8.1'];

        $browser=['Chrome','Firefox','Firefox Mobile','Opera','QQbrowser','Vivaldi','Mobile Samsung Browser'];

        $browserversion=['Avast Secure Browser 66','Avast Secure Browser 58','Chrome 52','Chrome 54','Chrome 61','Chrome 63','Chrome 65'];

        $language=['ar','bs','cs','da','de','en','es'];

        $connection=['BROADBAND','CABLE','DIALUP','MOBILE','SATELLITE','WIRELESS','XDSL'];

        $os=['Android','Chrome OS','Fire OS','Linux','MacOS','OS X','Windows'];

        $device=['DESKTOP','FX-Marketing','MOBILE','SMART_TV','TABLET'];

        $brand=['Acer','Alcatel','Amazon','Amlogic','AneWish','Asus','BlackBerry'];
        /*
        for($x=0;$x<100000;$x++){

            $subscriber = new Subscriber;
            $subscriber->endp = 'xxxxxxxxxx-'.$x;
            $subscriber->publicKey = 'xxxxxxxxxx-'.$x;
            $subscriber->authToken = 'xxxxxxxxxx-'.$x;
            $subscriber->contentEncoding = 'aes128gcm';
            $subscriber->ip = '192.168.1.1';
            $subscriber->country = $countries[rand(0,count($countries)-1)];
            $subscriber->model = $model[rand(0,count($model)-1)];
            $subscriber->osversion = $osversion[rand(0,count($osversion)-1)];
            $subscriber->browser = $browser[rand(0,count($browser)-1)];
            $subscriber->browserversion = $browserversion[rand(0,count($browserversion)-1)];
            $subscriber->language = $language[rand(0,count($language)-1)];
            $subscriber->connection = $connection[rand(0,count($connection)-1)];
            $subscriber->os = $os[rand(0,count($os)-1)];
            $subscriber->device = $os[rand(0,count($device)-1)];
            $subscriber->brand = $brand[rand(0,count($brand)-1)];
         
           
            $subscriber->save();
           
        }
        */
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
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
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
}
