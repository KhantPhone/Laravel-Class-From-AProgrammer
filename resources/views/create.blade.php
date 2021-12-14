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
                New Posts
            </div>
            <div class="card-body">
            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
                <form action="/posts" method="post">
                    @csrf
                    <div class="form-group mb-3">
                        <label for="name">Name</label>
                        <input type="text" class="form-control" name="name" placeholder="Enter Name" value= "{{ old ('name') }}">                        
                    </div>                
                    <div class="form-group mb-3">
                        <label for="Description">Description</label>
                        <textarea  class="form-control" name="description" placeholder="Enter Description">
                        {{ old ('description') }}
                        </textarea>
                    </div>
                    <div class="mb-4">                          
                        <label for="category">Category</label>
                        <select name="category_id" id="" class="form-control">
                        @foreach($categories as $cat)
                            <option value="{{ old ('category_id',$cat->id) }}">{{$cat->name}}</option>
                            @endforeach
                        </select>
                    </div>                    
                        <button type="submit" class="btn btn-primary ">Submit</button>
                        <a href="/posts" class="btn btn-danger">Back                       
                        </a>                               
                </form>
            </div>
        </div>
    </div>
    @endsection
    
</body>
</html>