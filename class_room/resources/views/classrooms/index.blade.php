<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>
    <h1>My Classrooms </h1>
    <p> welcome {{$name.' '. $title}} </p>
    <a href="{{route('classrooms.create')}}">Create New Classroom</a>
</body>

</html>