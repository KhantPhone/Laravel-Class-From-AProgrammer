<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    
    <title>Document</title>
</head>
<body>
  
    @extends('layout')
    
    @section('content')
    <div class="container">       
        <div class="mt-4">
            <a href="/posts/create">
                <button class="btn btn-success mr-1">Create New Post</button>
            </a>
            <a href="/logout">
                <button class="btn btn-danger">LogOut</button>
            </a>
            <h4 class="text-right">Name : <i class="text-warning">{{Auth::user()->name}}</i> </h4>         
        </div>
        @if (session('createdstatus'))
            <div class="alert alert-success alert-dismissible fade-in">
                <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                <strong>Success! </strong>{{ session('createdstatus') }}
            </div>
        @endif        
        @if (session('updatedstatus'))
            <div class="alert alert-warning alert-dismissible fade-in">
                <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                <strong>Success! </strong>{{ session('updatedstatus') }}
            </div>
        @endif          
        @if (session('deletedstatus'))
            <div class="alert alert-danger alert-dismissible fade-in">
                <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                <strong>Success! </strong>{{ session('deletedstatus') }}
            </div>
        @endif  
        <div class="card mt-4">
            <div class="card-header text-center">
                Contents
            </div>          
            @foreach($data as $post)
            <div class="card-body border-bottom">
                <h5 class="card-title">{{$post->name}}</h5>                
                <p class="card-text">{{$post->description}}</p>
                <form action="/posts/{{$post->id}}" method="post">
                    <a href="/posts/{{$post->id}}" class="btn btn-warning text-white">View</a>                
                    <a href="/posts/{{$post->id}}/edit" class="btn btn-info text-white">Edit</a>               
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger">
                        Delete 
                    </button>    
                </form>

            </div>        
            @endforeach          
        </div>
    </div>
    @endsection
    
</body>
</html>