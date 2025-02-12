<!DOCTYPE html>
<html>
<head>
<title>App de Tareas</title>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">



<!-- Estilos Boostrap -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-BmbxuPwQa2lc/FVzBcNJ7UAyJxM6wuqIj61tLrc4wSX0szH/Ev+nYRRuWlolflfl" crossorigin="anonymous">

<!-- Estilos personalizados -->
<link rel="stylesheet" type="text/css" href="{{ asset('css/custom.css') }}">

<script src="https://unpkg.com/ionicons@5.4.0/dist/ionicons.js"></script>

</head>
<body>
@include('layouts.nav')


@yield('content')


<!-- Javascript Bootstrap -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/js/bootstrap.bundle.min.js" integrity="sha384-b5kHyXgcpbZJO/tY9Ul7kGkf1S0CWuKcCD38l8YkeH8z8QjE0GmW1gYU5S9FOnJ0" crossorigin="anonymous"></script>
</body>
</html>