<?php

namespace App\Http\Controllers;
use App\Events\PostCreatedEvent;
use App\Models\Post;
use App\Models\User;
use App\Mail\PostStored;
use App\Models\Category;
use App\Mail\PostCreated;
use App\Mail\PostDeleted;
use App\Mail\PostUpdated;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Route;
use App\Http\Requests\StorePostRequest;
use Illuminate\Support\Facades\Notification;
use App\Notifications\PostCreatedNotification;

class HomeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
      
        //$user = User::find(auth()->id());
        //$user->notify(new PostCreatedNotification());
        //Notification::send(User::find(auth()->id()), new PostCreatedNotification());//Using Facades
        //echo "noti sent"; exit();
        // Mail::raw('Hello World',function($msg){
        //     $msg->to('khantphone333@gmail.com')->subject('Ap Index Function');
        // });to send raw message
        //$data = Post::all();
        //similar to SELECT * FROM posts WHERE user_id = 1
        $data = Post::where('user_id',auth()->id())->orderBy('id','desc')->get();
        // $request->session()->flash('status','Task Was Successful');
        //dd(config('mail.from.address'));//accessing mail address from config
        //dd(config('aprogrammer.info.first'));
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
        $post = Post::create($validated + ['user_id'=>Auth::user()->id]);
        event(new PostCreatedEvent($post));

      
        // $post = new Post();
        // $post->name = $request->name;
        // $post->description = $request->description;
        // $post->save();      

        // Post::create([
        //     'name' => $request->name,
        //     'description' => $request->description,
        //     'category_id' => $request->category,
        // ]);

        //Mail::to('khantphone333@gmail.com')->send(new PostCreated());
        

        return redirect('/posts')->with('createdstatus',config('aprogrammer.message.created'));
     
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

        //Mail::to('khantphone333@gmail.com')->send(new PostUpdated($post));

        return redirect('/posts')->with('updatedstatus',config('aprogrammer.message.updated'));

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

       

        return redirect('/posts')->with('deletedstatus',config('aprogrammer.message.deleted'));
    }
}
