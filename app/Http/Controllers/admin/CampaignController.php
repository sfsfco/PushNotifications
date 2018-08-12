<?php


namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;

use App\Campaign;
use App\Subscriber;
use Illuminate\Http\Request;

use Intervention\Image\ImageManagerStatic as Image;

use File;
use Yajra\Datatables\Datatables as Datatables;

use Session;

class CampaignController extends Controller
{

   
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
     public function getcount(Request $request){
        parse_str($request->data, $searcharray);
        $targets = ['country','device','brand','model','os','osversion','browser','browserversion','language','connection'];
        
        $subscribers = new Subscriber();

        $qb = $subscribers->newQuery();
        $qb->where('_id','!=','1' );
        foreach($targets as $target){
            if(isset($searcharray[$target][0])){
                $qb->whereIn($target, $searcharray[$target]);      
            }    
        }
           

        $results = $qb->count();
        echo $results;
        
    }
    public function index()
    {
        $title = 'Campaign';
        $campaigns = Campaign::limit(10)->get();
        /*
        $cammps =Campaign::all();
        foreach ($cammps as $ca) {
            File::delete(public_path()."/images/".$ca->icon);
            File::delete(public_path()."/images/300_".$ca->icon);
            File::delete(public_path()."/images/".$ca->image);
            File::delete(public_path()."/images/300_".$ca->image);
            
            $ca->delete();
        }
        die();
        */
        return view('admin.campaigns.index',compact('title','campaigns'))->with('i', (request()->input('page', 1) - 1) * 5);
        
    }

    


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $title = 'Campaign';
// echo Subscriber::where('country', 'Egypt')->where('osversion', 'Android 4.0')->count();
        $country = Subscriber::groupBy('country')->get();
        $model = Subscriber::groupBy('model')->get();
        $osversion = Subscriber::groupBy('osversion')->get();
        $browser = Subscriber::groupBy('browser')->get();
        $browserversion = Subscriber::groupBy('browserversion')->get();
        $language = Subscriber::groupBy('language')->get();
        $connection = Subscriber::groupBy('connection')->get();
        $os = Subscriber::groupBy('os')->get();
        $device = Subscriber::groupBy('device')->get();
        $brand = Subscriber::groupBy('brand')->get();
        $count = Subscriber::count();

        return view('admin.campaigns.create',compact('title','country','model','os','osversion','browser','browserversion','language','connection','device','brand','count'));
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
   
    public function getBasicData()
    {
        
        $campaigns = Campaign::select(['name','image','icon','active','message','created_at'])->get();
        $xx= Datatables::of($campaigns)->make();
        
        return $xx;
        
    }
    public function store(Request $request,Campaign $campaign)
    {   

        request()->validate([
            'name' => 'required|string|max:255|unique:campaigns,name,' . $campaign->id . ',_id',
            'message' => 'required',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);
        
        /***/
        $image = $request->file('image');
        $input['imagename'] = time().'img.'.$image->getClientOriginalExtension();
        $image_resize = Image::make($image->getRealPath());              
        $image_resize->resize(300, 300);
        $image_resize->save(public_path('images/' .'300_'.$input['imagename']));
        $destinationPath = public_path('/images');
        $image->move($destinationPath, $input['imagename']);
        /****/
        /***/
        $icon = $request->file('icon');
        $input['iconname'] = time().'icon.'.$icon->getClientOriginalExtension();
        $icon_resize = Image::make($icon->getRealPath());              
        $icon_resize->resize(300, 300);
        $icon_resize->save(public_path('images/' .'300_'.$input['iconname']));
        $destinationPath = public_path('/images');
        $icon->move($destinationPath, $input['iconname']);
        /****/
        
        
       // for($i=0;$i<500;$i++){
            $country =(isset($request->country))?implode(",", $request->country):'';
            $model =(isset($request->model))?implode(",", $request->model):'';
            $os =(isset($request->os))?implode(",", $request->os):'';
            $osversion =(isset($request->osversion))?implode(",", $request->osversion):'';
            $browser =(isset($request->browser))?implode(",", $request->browser):'';
            $browserversion =(isset($request->browserversion))?implode(",", $request->browserversion):'';
            $language =(isset($request->language))?implode(",", $request->language):'';
            $device =(isset($request->device))?implode(",", $request->device):'';
            $brand =(isset($request->brand))?implode(",", $request->brand):'';
            $connection =(isset($request->connection))?implode(",", $request->connection):'';
            Campaign::create(array_merge( $request->all(), 
                [//'name' =>$request->name.'-'.$i ,
                'image' => $input['imagename'] ,
                'icon' => $input['iconname'] ,
                'country' => $country ,
                'model' => $model ,
                'os' => $os ,
                'os_version' => $osversion ,
                'browser' => $browser ,
                'browser_version' => $browserversion ,
                'language' => $language ,
                'device' => $device ,
                'brand' => $brand ,
                'connection' => $connection ,
                ]) );
        //}
        


        return redirect()->route('campaigns.index')
                        ->with('success','Campaign created successfully.');
    }


    /**
     * Display the specified resource.
     *
     * @param  \App\Campaign  $campaign
     * @return \Illuminate\Http\Response
     */
    public function show(Campaign $campaign)
    {
        $title = 'Campaign';
        return view('admin.campaigns.show',compact('campaign','title'));
    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Campaign  $campaign
     * @return \Illuminate\Http\Response
     */
    public function edit(Campaign $campaign)
    {
        $title = 'Campaign';
        $country = Subscriber::groupBy('country')->get();
        $model = Subscriber::groupBy('model')->get();
        $osversion = Subscriber::groupBy('osversion')->get();
        $browser = Subscriber::groupBy('browser')->get();
        $browserversion = Subscriber::groupBy('browserversion')->get();
        $language = Subscriber::groupBy('language')->get();
        $connection = Subscriber::groupBy('connection')->get();
        $os = Subscriber::groupBy('os')->get();
        $device = Subscriber::groupBy('device')->get();
        $brand = Subscriber::groupBy('brand')->get();
        $count = Subscriber::count();

        return view('admin.campaigns.edit',compact('title','campaign','country','model','os','osversion','browser','browserversion','language','connection','device','brand','count'));
    }


    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Campaign  $campaign
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Campaign $campaign)
    {
         request()->validate([
            'name' => 'required|string|max:255|unique:campaigns,name,' . $campaign->id . ',_id',
            'message' => 'required',
            'image' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'icon' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);
        if($request->file('image')){
            $image = $request->file('image');
            $input['imagename'] = time().'img.'.$image->getClientOriginalExtension();
            $image_resize = Image::make($image->getRealPath());              
            $image_resize->resize(300, 300);
            $image_resize->save(public_path('images/' .'300_'.$input['imagename']));
            $destinationPath = public_path('/images');
            $image->move($destinationPath, $input['imagename']);
            File::delete(public_path()."/images/".$request->old_image);
            File::delete(public_path()."/images/300_".$request->old_image);

        }else{$input['imagename']=$request->old_image;}
        if($request->file('icon')){
            $icon = $request->file('icon');
            $input['iconname'] = time().'icon.'.$icon->getClientOriginalExtension();
            $icon_resize = Image::make($icon->getRealPath());              
            $icon_resize->resize(300, 300);
            $icon_resize->save(public_path('images/' .'300_'.$input['iconname']));
            $destinationPath = public_path('/images');
            $icon->move($destinationPath, $input['iconname']);
        }else{$input['iconname']=$request->old_icon;}

        $country =(isset($request->country))?implode(",", $request->country):'';
        $model =(isset($request->model))?implode(",", $request->model):'';
        $os =(isset($request->os))?implode(",", $request->os):'';
        $osversion =(isset($request->osversion))?implode(",", $request->osversion):'';
        $browser =(isset($request->browser))?implode(",", $request->browser):'';
        $browserversion =(isset($request->browserversion))?implode(",", $request->browserversion):'';
        $language =(isset($request->language))?implode(",", $request->language):'';
        $device =(isset($request->device))?implode(",", $request->device):'';
        $brand =(isset($request->brand))?implode(",", $request->brand):'';
        $connection =(isset($request->connection))?implode(",", $request->connection):'';
        $campaign->update(array_merge( $request->all(), 
            [//'name' =>$request->name.'-'.$i ,
            'image' => $input['imagename'] ,
            'icon' => $input['iconname'] ,
            'country' => $country ,
            'model' => $model ,
            'os' => $os ,
            'os_version' => $osversion ,
            'browser' => $browser ,
            'browser_version' => $browserversion ,
            'language' => $language ,
            'device' => $device ,
            'brand' => $brand ,
            'connection' => $connection ,
            ]) );

        

        


        return redirect()->route('campaigns.index')
                        ->with('success','Campaign updated successfully');
    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Campaign  $campaign
     * @return \Illuminate\Http\Response
     */
    public function destroy(Campaign $campaign)
    {
        
        File::delete(public_path()."/images/".$campaign->image);
        File::delete(public_path()."/images/300_".$campaign->image);
        
        $campaign->delete();


        return redirect()->route('campaigns.index')
                        ->with('success','Campaign deleted successfully');
    }
}
