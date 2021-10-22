<!DOCTYPE html>
<html>
<head>
    <title>New feedback from user {{$feedback->user->name}}</title>
</head>
<body>

<h1>Title: </h1>{{$feedback->title}}
<p>Feedback text</p>{{$feedback->message}}

</body>
</html>
