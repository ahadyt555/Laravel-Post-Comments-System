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
    <style>
        .card-img {
            height: 200px; 
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
            <div class="col-md-4 mb-3">
                <div class="card">
                    <img src="{{ asset($data->file_path) }}" alt="Image" class="card-img">
                    <div class="card-body">
                        <label class="card-label" for="title"><strong>Post Title:</strong></label>
                        <p class="card-title" id="title">{{ $data->title }}</p>
                        <h5 class="card-title">Body:</h5>
                        <p class="card-text" style="max-height: 3em; overflow: hidden; text-overflow: ellipsis;">
                            {{ \Illuminate\Support\Str::limit($data->message, 60) }}
                        </p>
                        <a href="{{ route('manageposts.show', ['id' => $data->id]) }}"
                           class="btn btn-primary">View More</a>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
</div>
</body>
</html>
