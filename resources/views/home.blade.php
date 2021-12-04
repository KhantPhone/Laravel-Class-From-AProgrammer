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
        <div>
            <a href="/posts/create">
                <button class="btn btn-success d-block mx-auto mt-4">Create New Post</button>
            </a>
        </div>
        <div class="card mt-4 ">
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