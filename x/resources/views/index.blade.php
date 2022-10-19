<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title')</title> 
    
    <style> 

    </style>
</head>
<body>
<a href="{{url('/')}}">Home</a> | <a href="{{url('server1')}}">Server 1</a> | <a href="{{url('server2')}}">Server 2</a> | 
    <a href="{{url('server3')}}">Server 3</a> | <a href="{{url('pimpinan')}}">Pimpinan</a>
    <br><hr><br>
    @yield('content')
</body>
</html>