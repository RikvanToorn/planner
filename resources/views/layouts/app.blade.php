<!doctype html>
<html lang="en">
@include('web.partials.head')
<body class="@yield('body_class')">
@include('web.partials.header')
<div id="app" class="wrap" role="document">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-2 bg-dark pt-3 sidebar">
                @include('web.partials.sidebar')
            </div>
            <div class="col-10">
                <div class="p-2 p-md-5">
                    @yield('content')
                </div>
            </div>
        </div>
    </div>
</div>
@include('web.partials.footer')
</body>
<script async src="{{mix('js/app.js')}}"></script>
</html>