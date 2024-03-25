<!DOCTYPE html>
<html lang="en">

@include('layouts.head')

<body class="hold-transition sidebar-mini">
    <!-- Site wrapper -->
    <div class="wrapper">
        <input type="hidden" id="id">
        @include('layouts.navbar')
        @include('layouts.sidebar')
        @yield('content')
        @include('layouts.footer')
        @include('layouts.scripts')
    </div>
</body>

</html>
