<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create a New Post</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Create a New Post</div>

                <div class="card-body">
                    @auth
                    <form class="contact-form" method="POST" action="/posts" enctype="multipart/form-data">
                        @csrf
                        
                        <div class="form-group">
                            <label for="post_title">Title:</label>
                            <input type="text" name="title" id="post_title" class="form-control">
                        </div>

                        <div class="form-group">
                            <label for="your_comment">Body:</label>
                            <textarea name="message" id="your_comment" class="form-control" rows="5"></textarea>
                        </div>

                        <div class="form-group">
                            <label for="post_image">Image:</label>
                            <input type="file" name="file_path" id="post_image" class="form-control" accept="image/*">
                        </div>

                        <button type="submit" class="btn btn-primary">Submit</button>
                    </form>
                    @else
                    <p>Please <a href="{{ route('login') }}">login</a> to create a new post.</p>
                    @endauth
                </div>
            </div>
        </div>
    </div>
</div>
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.3/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
