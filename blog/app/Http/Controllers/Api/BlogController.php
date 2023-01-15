<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use App\Models\BlogModel;
use Illuminate\Support\Str;

class BlogController extends Controller
{

    
    public function fromValidation($all_request)
    {
        $rules=[
            'title' => 'required',
            'description' =>'required',
       ];

       $validator=validator::make($all_request,$rules);

       return  $validator;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return response()->json([
            'success'=>true,
            'message'=>'Blogs found',
            'data'=> BlogModel::all(),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
       
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validator=$this->fromValidation($request->all()); 
       
        if($validator->fails())
        {
             return response()->json($validator->getMessageBag()->all());  
        }
 
        $data=$request->all();
        $data['slug']=Str::slug($request->title);
        BlogModel::create($data);
 
        return response()->json([
             'success'=>true,
             'message'=>'Blog created',
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $blog=BlogModel::find($id);
        if(is_null($blog))
        {
            return response()->json([
                'error'=>true,
                'message'=>'Blog not found',
            ]);
        }
        else
        {
            return response()->json([
                'success'=>true,
                'message'=>'Blog found',
                'data'=> $blog,
            ]);
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
        $blog=BlogModel::find($id);
 
        if(is_null($blog))
        {
            return response()->json([
                'error'=>true,
                'message'=>'Blog not found',
            ]);
        }
        else
        {
            $validator=$this->fromValidation($request->all());
            if($validator->fails())
            {
                 return response()->json($validator->getMessageBag()->all());  
            }
            $data=$request->all();
            $data['slug']=Str::slug($request->title);
            $blog->update($data);

            return response()->json([
                'success'=>true,
                'message'=>'Blog Updated',
                'data'=> $blog,
            ]);
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
        $blog=BlogModel::find($id);
        if(is_null($blog))
        {
            return response()->json([
                'error'=>true,
                'message'=>'Blog not found',
            ]);
        }
        $blog->delete();
        return response()->json([
            'success'=>true,
            'message'=>'Blog Delete',
        ]);
    }
}
