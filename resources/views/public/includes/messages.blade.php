@if (Session::has('alert-success'))
    <div class="margin-bottom-12">
        <div class="alert alert-success">
            {{ Session::get('alert-success') }}
        </div>
    </div>
@endif

@if (Session::has('alert-danger'))
    <div class="margin-bottom-12">
        <div class="alert alert-danger">
            {{ Session::get('alert-danger') }}
        </div>
    </div>
@endif

@if (Session::has('alert-warning'))
    <div class="margin-bottom-12">
        <div class="alert alert-warning">
            {{ Session::get('alert-warning') }}
        </div>
    </div>
@endif

@if (Session::has('alert-info'))
    <div class="margin-bottom-12">
        <div class="alert alert-info">
            {{ Session::get('alert-info') }}
        </div>
    </div>
@endif

@if (count($errors) > 0)
    <div class="margin-bottom-12">
        <div class="alert alert-danger">
            @foreach ($errors->all() as $error)
                {{ $error }}<br>
            @endforeach
        </div>
    </div>
@endif