@extends('admin.layouts.master')

@section('content')

    <h1>Job Seekers</h1>

    @include('admin.includes.messages')

    <div class="text-right">
        <a class="btn btn-primary" href="{{ route('admin::seeker::create') }}">Add Seeker</a>
    </div>

    <br>

    <div class="table">
        <table class="table tablesorter table-responsive table-striped table-linker">
            <thead>
            <tr>
                <th>ID</th>
                <th>First Name</th>
                <th>Last Name</th>
                <th>Should be Matched</th>
                <th>Last Matched</th>
            </tr>
            </thead>
            <tbody>
            @foreach($list as $item)
                <tr data-href="{{ route('admin::seeker::edit', $item->id) }}">
                    <td>{{ $item->id }}</td>
                    <td>{{ $item->first_name }}</td>
                    <td>{{ $item->last_name }}</td>
                    <td>{{ $item->should_be_matched }}</td>
                    <td>{{ $item->last_matched }}</td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>

@endsection

@section('body_close')
    @parent

    @include('admin.includes.tablelinker')
    @include('admin.includes.tablesorter-js')
@endsection