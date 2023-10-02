<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Posts</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <style>
        .fixed-navbar {
    position: fixed;
    top: 0;
    right: 0;
    width: 300px; 
    height: 100%; 
    background-color: #333;
    color: #fff;
    padding: 20px; 
    overflow-y: auto;
}
.adjust{
    width: 65%;
    padding-right: 20%;
}
.image{
    width: 50%;
}
    </style>
</head>
<body>
    <div class="container , adjust">
        <h2>User Comments</h2>
        
            <div class="card">
            <div class="card-header">
                <h5>Title:</h5>
            </div>
            <div class="card-body">
                <p>{{ $post->title }}</p>
            </div>
            <div class="card-header">
                <h5>Message:</h5>
            </div>
            <div class="card-body">
                <p class="form-control" id="message" name="message">{{ \Illuminate\Support\Str::limit ($post->message, 30) }}</p>
            </div>
            <div class="card-header">
                <h5>Current Image:</h5>
            </div>
            <div class="card-body , image" >
                <img src="{{ asset($post->file_path) }}" alt="Current Image" class="img-fluid">
            </div>
    </div>
   
    <div class="fixed-navbar">
        <h3>User Name :</h3>
    <h4>{{ $post->user->name }} </h4>
    @foreach ($comments as $comment)
            <h6>Comment :</h6>
       <p>{{ $comment->body }}</p>

 @endforeach
    </div>
   

</body>
</html>
