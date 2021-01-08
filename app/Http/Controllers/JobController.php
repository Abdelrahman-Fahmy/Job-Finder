<?php

namespace App\Http\Controllers;
use Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\View;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Job;
use App\Category;
use App\Http\Requests\JobStoreRequest;

class JobController extends Controller
{
    //
    public function __construct()
    {
        $this->middleware('auth');
        View::share('page');
    }


    public function index(Request $request)
    {
        # code...
        View::share('page','search jobs');

        $categories=Category::all();
         
         
        if($request->has('keywords') ||  $request->has('location')) {
            
                if(($request->has('keywords') && !empty($request['keywords'])) || ($request->has('location') && !empty($request['location']))){
                    $jobs=Job::where('title', 'like', '%'.$request['keywords'].'%')
                    ->where('location', 'like', '%'.$request['location'].'%');                  
                }
                
                if(empty($request['location']) && empty($request['keywords'])){
                    $jobs=Job::select();
                }
                $jobs=$jobs->paginate(15);
            }
            else{
                $jobs=Job::paginate(15);
            }
        
            return view('front.jobs.index')->with([
            'jobs'=>$jobs,
            'categories'=>$categories,
            ]);
    }

    public function show($id)
    {          
        $user=Auth::id();
        $applied=DB::table('job_user')->where('user_id','=',$user)->where('job_id',"=",$id)->first();
        
         if($applied==null){
            $applied = new DB();
            $applied->applied=0;
            $applied->liked=0;
        }
        
        $job = Job::findOrFail($id);
        return view('front.jobs.single')->with([
            'job'=> $job,
            'applied'=> $applied,
            ]);
    }

    public function catfilter($id)
    {      
        View::share('page','search jobs');

        $categories=Category::all();
        $jobs = Job::where('category_id','=',$id)->paginate(15);
        return view('front.jobs.index')->with(
            ['jobs' => $jobs,
            'categories' => $categories,
            ]);
    }

    public function apply(Request $request)
    {
        return JobController::userAction('applied',$request);
    }

    public function like(Request $request)
    {
        return JobController::userAction('liked',$request);
    }


    public function create()
    {   $categories=Category::all();
        # code...
        return view('front.jobs.create')->with('categories',$categories);
    }
    public function store(JobStoreRequest $request)
    {
        # code...
        

        $job = new Job();
        $job['title']=$request['title'];
        $job['company_name']=$request['company_name'];
        $job['job_type']=$request['job_type'];
        $job['location']=$request['location'];
        $job['job_details']=$request['job_details'];
        $job['salary']=$request['salary'];
        if( !empty($request['category_id'])){
        $job['category_id']=$request['category_id'];
    }
        $job->save();
        
        Auth::user()->jobs()->attach($job->id,['posted'=>1]);
        return redirect('/');

    }

    public function applylist()
    {
        return JobController::jobsList('applylist','applied');
    }

    public function likedlist()
    {
        return JobController::jobsList('myfavourites','liked');
    }

    public function postedlist()
    {  
        return JobController::jobsList('myjobs','posted');
    }

    public function appliers($id)
    {
        # code...
        $users=DB::table('job_user')->select('user_id')->where('applied','=',1)->where('job_id',"=",$id)->get();
        $appliers=array();
        $i=0;
        foreach($users as $user){
            
            $row=DB::table('users')->select('name','email','address','image','phone','cv')->where('id','=',$user->user_id)->first();
            array_push($appliers,$row);
        
            if($row->image != null){
            $appliers[$i]->image=base64_encode(Storage::get($row->image));
        
            $i++;
        }
        }
        
       return view('front.jobs.appliers')->with('appliers',$appliers);
        
    }


    public function jobsList($type,$field){
        View::share('page',$type);
        $categories=Category::all();
        $jobs=Auth::user()->jobs()->where($field,'=',1)->paginate(15);
        return view('front.jobs.index')->with([
            'jobs'=>$jobs,
            'categories'=>$categories,
            ]);
    }

    public function userAction($action,$request){
        $user=Auth::id();
        $exists=DB::table('job_user')->where('user_id','=',$user)->where('job_id',"=",$request['job_id'])->first();
        
        if($exists === null){
            
            Auth::user()->jobs()->attach($request['job_id'],[$action=>1]);
        }
        else{
            $save=DB::table('job_user')->where('user_id','=',$user)->where('job_id',"=",$request['job_id']);
             $save->update([$action=> 1]);     
        }
    }

}
