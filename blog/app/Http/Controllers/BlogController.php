<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\BlogModel;
use App\Models\BlogComment;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;

class BlogController extends Controller
{
    public function index()
    {
       $blogs=BlogModel::all();  
       return view('blog.index',compact('blogs'));
    } 

    public function create()
    {
      
       return view('blog.create');
    }

    protected function blogInfoNewValidateUpdate($request){
        $request->validate([
            'title' => 'required',
            'description' =>'required',
        ]);
    }
    public function save(Request $request)
    {
       $this->blogInfoNewValidateUpdate($request);

       $data=$request->all();
       $data['slug']=Str::slug($request->title);
       BlogModel::create($data);

       return redirect()->route('blog.index')->with('success', 'Successfully Blog Created!');

    } 

    public function edit($id)
    {
      $blog_edit=BlogModel::find($id);

      return view('blog.edit',compact('blog_edit'));
    } 

    public function update(Request $request)
    {
      $this->blogInfoNewValidateUpdate($request);

      $blog_update=BlogModel::find($request->blog_id);
      $blog_update->title=$request->title;
      $blog_update->slug=Str::slug($request->title);
      $blog_update->description=$request->description;
      $blog_update->save();

      return redirect()->route('blog.index')->with('success', 'Successfully Blog Update!');

    } 

    public function view($id){

        $blog_view=BlogModel::find($id);
        return view('blog.view',compact('blog_view'));
    }

    public function delete($id)
    {
        $blog=BlogModel::find($id);
        $blog->delete();

        return redirect()->route('blog.index')->with('error', 'Successfully Blog Deleted!');
    }


    public function comment(Request $request){
        $request->validate([
            'comment' => 'required',
        ]);
        $data=$request->all();
        $data['user_id']=Auth::user()->id;
        BlogComment::create($data);
        return redirect()->route('blog.index')->with('success', 'Successfully Blog Comment Done!');
    }

    public function logout()
    {
        Auth::logout();
        return redirect('/login');
    }
}
