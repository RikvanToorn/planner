<!doctype html>
<html lang="en">
@include('layouts.partials.head')
<body>
@include('layouts.partials.header')
<div id="app" class="wrap" role="document">
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="container-fluid">
                    @yield('content')
                </div>
            </div>
        </div>
    </div>
</div>
@include('layouts.partials.footer')

</body>
</html>