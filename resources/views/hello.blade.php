<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Hello World!</title>
    <h1>Hello</h1>
    <ul>
        @foreach ($tasks as $task)
        <li>{{$task}}</li>
        @endforeach
    </ul>
</head>
<body>

</body>
</html>