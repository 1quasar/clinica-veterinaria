
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ config('app.name', 'Laravel') }}</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body>

    <nav class="navbar navbar-dark bg-dark">
        <div class="container">
            <span class="navbar-brand">
                {{ config('app.name', 'Laravel') }}
            </span>
        </div>
    </nav>

    <div class="container-fluid">
       <div class="row">
            <div class="col-md-3">
                @include('layouts.sidebar')
            </div>

            <div class="col-md-9 mt-4">
                 @yield('content')
            </div>
       </div>
    </div>
    
</body>
</html>