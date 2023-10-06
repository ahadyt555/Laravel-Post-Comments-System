<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>User Posts Management</title>
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <style>
        .post-container {
            display: flex; 
        }

        .post {
            flex: 1;
            padding: 20px; 
            border: 1px solid #ccc; 
        }
        .img-con{
            width: 300px;
            height: 400px; 
            object-fit: cover; 
        }
    </style>
</head>
<body>
@php
   $user = auth()->user()->id;
@endphp
<div class="container">
    <h2>Posts</h2>
    <div class="row">
        @foreach ($messages as $data)
            <div class="col-md-6">
                <div class="card mb-6">
                    <div class="card-body">
                        <h5 class="card-title">Post Title:</h5>
                        <p class="card-title">{{ $data->title }}</p>
                        <h5 class="card-title">Body:</h5>
                        <p class="card-text" style="max-height: 2em; overflow: hidden; text-overflow: ellipsis;">
                            {{ $data->message }}
                        </p>
                        <h5>Image:</h5>
                        <div class="img-con">
                        <img src="{{ asset($data->file_path)}}" alt="Image" class="img-fluid">
                        </div>
                        @if($data->user_id === $user)
                        <a href="{{ route('manageposts.edit', ['id' => $data->id]) }}" class="btn btn-sm btn-info">Edit Post</a>
                        <br>                        
                        @csrf
                         @method("GET")
                        <a href="{{ route('manageposts.destroy', ['id' => $data->id]) }}" class="btn btn-sm btn-info position-absolute" style="bottom: 10px; right: 10px;">Delete Post</a>
                        @endif

                <div class="row mt-4">
                    <div class="col-md-6">
                    <form class="contact-form" method="POST" action="{{ route('comments.store', ['post_id' => $data->id]) }}" enctype="multipart/form-data">
                            @csrf
                            @method("POST")
                <div class="form-group">
                    <label for="your_comment">Add A Comment:</label>
                    <input name="body" id="your_comment" class="form-control" rows="3"></input>
                </div>
                <button type="submit" class="btn btn-sm btn-primary">Publish Comment</button>
                <a href="{{ route('comments.show', ['post_id' => $data->id]) }}" class=class="btn btn-sm btn-primary">All Comments</a>

            </form>

            </div>
            </div>
            </div>
        </div>
    </div>
    @endforeach
</div>
</body>
</html>