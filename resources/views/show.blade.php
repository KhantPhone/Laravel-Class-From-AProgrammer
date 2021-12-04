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
        <div class="card mt-4 ">
            <div class="card-header text-center">
                Contents
            </div>           
            <div class="card-body border-bottom">
                <h5 class="card-title">{{$post->name}}</h5>                
                <p class="card-text">{{$post->description}}</p>               
                <div>
                    <a href="/posts">
                        <button class="btn btn-danger mt-2">Back</button>
                    </a>
                </div>
            </div>                   
        </div>
    </div>
    @endsection
    
</body>
</html>