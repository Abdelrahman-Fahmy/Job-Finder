<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\View;
use App\Category;



class CategoryController extends Controller
{
    //
    public function __construct()
    {
        $this->middleware('auth');
        View::share('page');
    }

    public function index(Request $request)
    {
        $categories=Category::select();
        if($request->has('orderBy')){
              $sortOrder='asc';
              if($request->has('sortOrder')){
                  $sortOrder=$request['sortOrder'];

              }  
              else{
                  $sortOrder='asc';
              }
            $categories=$categories->orderBy($request['orderBy'],$sortOrder);

        }

        if($request->has('keywords')){

            $categories=$categories->where('name','like','%'.$request['keywords'].'%');
        }
        $categories=$categories->paginate(15);
        
        return view('admin.categories.index')->with('categories',$categories);    
    }

    public function create()
    {
        # code...
       
        return view('admin.categories.create');    
    }


    public function store(Request $request)
    {   
        $this->validate($request,[
            'name' => 'required|alpha'
        ]);

        $category = new Category();
        $category['name']=$request['name'];
        $category->save();
        Session::flash('alert-success','category added successfully!');
        return redirect('/admin/categories');
    }

    public function edit($id)
    {
        # code...
       $category=Category::findOrFail($id);
        return view('admin.categories.edit')->with('category',$category);    
    }


    public function update($id,Request $request)
    {   
        $this->validate($request,[
            'name' => 'required|alpha'
        ]);

        $category=Category::findOrFail($id);
        $category['name']=$request['name'];
        $category->save();
        Session::flash('alert-info','category edited successfully!');
        return redirect('/admin/categories');
    }


    public function destroy($id)
    {   
        
        $category=Category::findOrFail($id);
        
        $category->destroy($id);
        Session::flash('alert-danger','category removed successfully!');
        return redirect('/admin/categories');
    }

}
