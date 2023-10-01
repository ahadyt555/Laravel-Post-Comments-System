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
</head>
<body>
    <div class="container">
        <h2>Edit User Posts</h2>
        <form action="{{ route('manageposts.update', ['id' => $post->id]) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            <div class="form-group">
                <label for="title">Title:</label>
                <input type="text" class="form-control" id="title" name="title" value="{{ $post->title }}">
            </div>

            <div class="form-group">
                <label for="message">Message:</label>
                <textarea class="form-control" id="message" name="message">{{ \Illuminate\Support\Str::limit ($post->message, 30) }}</textarea>
            </div>

            <div class="form-group">
                <label for="current_image">Current Image:</label>
                <img src="{{ asset($post->file_path) }}" alt="Current Image" class="img-fluid">
            </div>

            <div class="form-group">
                <label for="new_image">New Image:</label>
                <input type="file" class="form-control-file" id="new_image" name="new_file_path">
                <!-- You can add validation error message here if needed -->
            </div>

            <button type="submit" class="btn btn-primary">Save Changes</button>
        </form>
    </div>
</body>
</html>
