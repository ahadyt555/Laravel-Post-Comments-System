<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Posts</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">
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
.line{
    word-wrap: break-word;
}
.bot{
    border-bottom: 2px solid;
    margin: 10px;
    padding: 10px;
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
            <div class="card-body , line">
                <p class="form-control" id="message , editable-paragraph" name="message">{{ \Illuminate\Support\Str::limit ($post->message, 30) }}</p>
            </div>
            <div class="card-header">
                <h5>Current Image:</h5>
            </div>
            <div class="card-body , image" >
                <img src="{{ asset($post->file_path) }}" alt="Current Image" class="img-fluid">
            </div>
    </div>
   
    <div class="fixed-navbar">
    @foreach ($comments as $comment)
    <div class="line">
        <p><strong>{{ $comment->user->name }}</strong></p>
        <div class="bot" data-comment-id="{{ $comment->id }}">
        <p data-editable>{{ $comment->body }}</p>
        <div class="btn-group"class="form-control" role="group" aria-label="Basic example">
        @php
            $user = auth()->user();
            $isCommentAuthor = $comment->user->id === $user->id;
            $isPostAuthor = $post->user_id === $user->id;
        @endphp

@if ($isCommentAuthor)
    <button class="btn btn-sm btn-info btn-secondary , edit-comment">Edit</button>
    <form method="POST" action="{{ route('comments.update', ['id' => $comment->id]) }}">
        @csrf
        @method('PUT')
        <button class="btn btn-sm btn-info btn-secondary  edit-comment form-control">Update</button>
    </form>
    <form method="POST" action="{{ route('comments.destroy', ['id' => $comment->id]) }}">
        @csrf
        @method('DELETE')
        <button type="submit" class="btn btn-sm btn-info btn-secondary" class="delete-btn">Delete</button>
    </form>
@elseif ($isPostAuthor)
    <form method="POST" action="{{ route('comments.destroy', ['id' => $comment->id]) }}">
        @csrf
        @method('DELETE')
        <button type="submit" class="btn btn-sm btn-info btn-secondary">Delete</button>
    </form>
@endif

    </div>
    </div>
    </div>
    
@endforeach

    </div>
    
    <script>
$(document).ready(function() {
    $(".edit-comment").click(function() {
        var botElement = $(this).closest(".bot");
        var paragraph = botElement.find("p[data-editable]");
        var originalText = paragraph.text();
        var inputField = $("<input>")
            .attr("type", "text")
            .addClass("form-control")
            .val(originalText);
        paragraph.replaceWith(inputField);
        inputField.focus();

        inputField.blur(function() {
            var editedText = $(this).val();
            var newParagraph = $("<p>")
                .attr("data-editable", "")
                .text(editedText);
            $(this).replaceWith(newParagraph);

            var commentId = botElement.data("comment-id");

            $.ajax({
                type: "PUT",
                url: "/comments/update/" + commentId, 
                data: {
                    _token: $('meta[name="csrf-token"]').attr('content'),
                    body: editedText
                },
                success: function(response) {
                    console.log("Comment updated successfully.");
                },
                error: function(error) {
                    console.log("Error updating comment: " + error);
                }
            });
        });
    });
});
</script>



</body>
</html>
