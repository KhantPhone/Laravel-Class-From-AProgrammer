<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Requests\StorePostRequest;


class HomeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //$data = Post::all();
        //similar to SELECT * FROM posts WHERE user_id = 1
        $data = Post::where('user_id',auth()->id())->orderBy('id','desc')->get();
        return view('home',compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = Category::all();       
        return view('create',compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StorePostRequest $request)
    {
        // Retrieve the validated input data...
      
       
        $validated = $request->validated();       
        Post::create($validated);

        // $post = new Post();
        // $post->name = $request->name;
        // $post->description = $request->description;
        // $post->save();      

        // Post::create([
        //     'name' => $request->name,
        //     'description' => $request->description,
        //     'category_id' => $request->category,
        // ]);

        return redirect('/posts');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Post $post)
    {
        // //$post = Post::findorFail($id);BTS
        // if($post->user_id != auth()->id()){
        //     abort(403);
        // }
        $this->authorize('view',$post);
        return view('show',compact('post'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Post $post)
    {
        // if($post->user_id != auth()->id()){
        //     abort(403);
        // }
        $this->authorize('view',$post);
        //$post = Post::findorFail($id);
        $categories = Category::all();        
        return view('edit',compact('post','categories'));    
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(StorePostRequest $request, Post $post)
    {
        //$post = Post::findorFail($id);
        // $post->name = $request->name;
        // $post->description = $request->description;
        // $post->save();

        // $post->update([
        //     'name' => $request->name,
        //     'description' => $request->description,
        //     'category_id' => $request->category_id,
        // ]);

        $validated = $request->validated();       
        $post->update($validated);
        return redirect('/posts');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Post $post)
    {
        $post->delete();
        return redirect('/posts');
    }
}
