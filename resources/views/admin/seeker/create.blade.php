@extends('admin.layouts.master')

@section('content')

    <h1>Add Job Seeker</h1>

    @include('admin.includes.messages')

    <form method="post" action="{{ route('admin::seeker::store') }}">

        @include('admin.seeker.forms.create')

        <button type="submit" class="btn btn-primary">Create</button>
        <a class="btn btn-default" href="{{ route('admin::seeker::list') }}">Return to Library</a>

        {{ csrf_field() }}

    </form>

@endsection

@section('body_close')
    @parent
    <script>
        $('.select2').select2();
    </script>
@endsection