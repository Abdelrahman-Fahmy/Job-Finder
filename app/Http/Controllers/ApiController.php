<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Category;
use App\Job;
use App\Http\Resources\JobResource;
use Illuminate\Support\Facades\Validator;

class ApiController extends Controller
{
    //
    public function job($id)
    {
        # code...
        
        $job=Job::findOrFail($id);
        
        return new JobResource($job);
    }

    public function jobs(Request $request)
    {
        # code...
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
        return  JobResource::collection($jobs);
    }

    public function jobstore(Request $request)
    {   

        $validator=Validator::make($request->all(),[
            'title' => 'required|string|max:255',
            'company_name' => 'required|max:255',
            'job_type' => 'required',
            'location' => 'required',
            'job_details' => 'required',
            'salary' => 'required|regex:/^([0-9\s\-\+\(\)]*)$/'
        ]);
        if($validator->fails()){
            return $validator->errors();
        }
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
        return response()->json(['message'=>'success']);
    }


}
