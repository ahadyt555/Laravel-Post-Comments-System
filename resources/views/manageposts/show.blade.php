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
                        <h6 class="card-title">{{ $data->title }}</h6>
                        <h5 class="card-title">Body:</h5>
                        <p class="card-text" style="max-lines: 1;">{{ $data->message }}</p>
                        <h5>Image:</h5>
                            <img src="{{ asset($data->file_path)}}" alt="Image" class="img-fluid">
                        @if($data->user_id === $user)
                        <a href="{{ route('manageposts.edit', ['id' => $data->id]) }}" class="btn btn-sm btn-info position-absolute" style="bottom: 10px; right: 10px;">Edit Post</a>
                        @endif
                        @csrf
                    @method("GET")
                        <a href="{{ route('manageposts.destroy', ['id' => $data->id]) }}" class="btn btn-sm btn-info position-absolute" style="bottom: 10px; right: 10px;">Delete Post</a>

                    </div>
                </div>
            </div>
        @endforeach
    </div>
</div>

</body>
</html>