<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta name="csrf-token" content="{{ csrf_token() }}" />
    <title>Trang chủ</title>

    @include('layouts.partials.styles')

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

</head>

<body>
    @include('message')

    @include('layouts.partials.header')

    @yield('content')

    <div class="footer p-4 text-center">
        <p>Footer</p>
    </div>



    @include('layouts.partials.scripts')


</body>

</html>
