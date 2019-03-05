<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01//EN" "http://www.w3.org/TR/html4/strict.dtd">
<html lang="@parent">
<head>
    <meta http-equiv="Content-Type" content="text/html;charset=UTF-8">
    <title>BirdBoard</title>
</head>
<body>
<h1>BirdBoard</h1>

@forelse($projects as $project)
    <li><a href="{{$project->path()}}">{{$project->title}}</a></li>
    @empty
    <li>No projects there bro</li>
@endforelse
</body>
</html>
