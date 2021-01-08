<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Mail;
use Auth;
use App\Mail\ContactMail;
use App\Job;
use App\User;
use App\Category;
use Image;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth',['except'=>['show']]);
        View::share('page');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return view('home');
    }

    public function show()
    {   View::share('page','home');
        $categories=Category::all();
        $jobs=Job::orderBy('created_at','desc')->take(5)->get();
        
        return view('front.home.index')->with([
            'categories'=>$categories,
            'jobs'=>$jobs
        ]);
    }

    public function edit()
    {   View::share('page','profile');
        # code...
        $id=Auth::id();
        $user=User::find($id,['id','name','email','image','address','phone','cv']);
        $image_url='';
        if($user['image'] != ''){
        $image_url=base64_encode(Storage::get($user['image']));
        
    }
     
        return view("front.profile.edit")->with([
            'user'=>$user,
            'image_url'=>$image_url
        ]);
    }

    public function update($id,Request $request)
    {
        # code...
        View::share('page','profile');
        $user=User::findOrFail($id);

        if( !empty($request['name'])){
            $this->validate($request,[
                'name' => 'alpha|max:255'
            ]);
        $user['name']=$request['name'];
    }


    if( !empty($request['email'])){
        $this->validate($request,[
        'email' => 'email|unique:users'
        ]);
        $user['email']=$request['email'];
    }


    if( !empty($request['address'])){
        $user['address']=$request['address'];
    }

    
    if( !empty($request['phone'])){
        $this->validate($request,[
            'phone' => 'regex:/^([0-9\s\-\+\(\)]*)$/|min:11',
            ]);
        $user['phone']=$request['phone'];
    }

    if( !empty($request['image'])){
       
        $this->validate($request,[
            'image' => ' image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            ]);

        $image_name=$request['image']->store('');
        Image::make(storage_path('app/'.$image_name))->crop(250,250)->save();
        $user['image']=$image_name;
    }

    if( !empty($request['cv'])){
        $this->validate($request,[
            'cv' => 'mimes:pdf,zip,rar,doc|max:2048',
            ]);
         
        $cv_name=$request['cv']->store('',['disk'=>'public_path']);
        
        $user['cv']=$cv_name;
    }


    if( !empty($request['password'])){
        $this->validate($request,[
            'password' => 'string|min:8',
            ]);
        $user['password']= Hash::make($request['password']);
    }

         $user->save();


         foreach(['name','email','phone','image','password','address','cv'] as $i){
             
            if($request[$i]===null){
               
            }
            else{
               
                Session::flash('alert-success','profile edited successfully!');
            }
         }
        return redirect('/profile/edit');
    }


    public function admin()
    {
            return view('admin.layouts.main');
    }

    public function downloadcv($file)
    {   
        return Storage::disk('public_path')->download($file);
           
    }

    public function contact()
    {   
        View::share('page','contact');
        return view('front.contact.index');
    }

    public function send(Request $request)
    {
        
        $this->validate($request,[
            'name' => 'required|string',
            'email' => 'required|email',
            'message' => 'required|string'
        ]);
        View::share('page','contact');
        $obj = new ContactMail($request->all());
        $admin=User::select('email')->where('user_type','=',2)->first();
        Mail::to($admin['email'])->send($obj);
        Session::flash('alert-success','your message has been sent successfully !');
        return redirect('/contact');
        
    }
}
