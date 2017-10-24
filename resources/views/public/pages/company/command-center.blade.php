@extends('public.layouts.master')

@section('content')
    <div class="commandCenter">
        <div class="container-fluid">
            <div class="row1">
                <div class="col-sm-12">
                    <div class="panel panel-primary">
                        <div class="panel-heading">
                            <div class="panel-title1">
                                <h2>{{$company->name}} Command Center</h2>
                                <h2><span class="glyphicon glyphicon-home"></span></h2>
                                <h2><span class="glyphicon glyphicon-alert"></span></h2>
                                <h2><span class="glyphicon glyphicon-stats"></span></h2>
                                <h2><span class="glyphicon glyphicon-envelope"></span></h2>
                                <h2><span class="glyphicon glyphicon-globe"></span></h2>
                                <h2><span class="glyphicon glyphicon-plus"></span></h2>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <br>

        <div class="container-fluid">
            <div class="row1">
                <div class="col-sm-8">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <h2 class="panel-title">Posted Jobs</h2>
                        </div>
                        <div class="panel-body">
                            @if($jobs->count())
                                <table class="table">
                                    <thead>
                                    <th>Select</th>
                                    <th>Job Id</th>
                                    <th>Job Title</th>
                                    <th>Last Date Updated</th>
                                    </thead>
                                    <tbody>
                                    @foreach($jobs as $job)
                                        <tr>
                                            <td>
                                                <div class="checkbox"><label><input type="checkbox"></label></div>
                                            </td>
                                            <td><a href="#modalJob" data-toggle="modal"
                                                   data-target="#modalJob">{{$job->id}}</a></td>
                                            <td><a href="#modalRanking{{$job->id}}" data-toggle="modal"
                                                   data-target="#modalRanking{{$job->id}}">{{$job->name}}</a></td>
                                            <td>{{ \Carbon\Carbon::parse($job->updated_at)->toDateTimeString()}}</td>
                                        </tr>
                                    @endforeach
                                    </tbody>
                                </table>
                                @else
                                <h1>You don't have a job posting. Please create one.</h1>
                            @endif
                            <br>
                            <a href="{{route('guest::create::about-job')}}" class="btn btn-success" role="button">Create New Job</a>
                            <a href="#" class="btn btn-default" role="button">Delete</a>
                        </div>
                    </div>
                </div>
                <div class="col-sm-4">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <h2 class="panel-title">My Knowledge</h2>
                        </div>
                        <div class="panel-body">
                            <br><br>
                            <img src="{{URL::asset('img/report.png')}}">
                        </div>
                    </div>
                </div>
            </div>

            <div class="row2">
                <div class="col-sm-4">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <h2 class="panel-title">My Forum</h2>
                        </div>
                        <div class="panel-body">
                            <h4>You have 5 new notifications</h4>
                            <hr>
                            <h4>New Topics</h4>
                            <hr>
                            <h4>Someone has posted a response</h4>
                        </div>
                    </div>
                </div>
                <div class="col-sm-4">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <h2 class="panel-title">My Network</h2>
                        </div>
                        <div class="panel-body">
                            <h4>You have 2 new requests</h4>
                            <hr>
                            <h4>You have 4 updates</h4>
                        </div>
                    </div>
                </div>
                <div class="col-sm-4">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <h2 class="panel-title">My News</h2>
                        </div>
                        <div class="panel-body">
                            <h4>Todays Top Stories</h4>
                            <h5>-</h5>
                            <h5>-</h5>
                            <hr>
                            <h4>Hot Trends</h4>
                            <h5>-</h5>
                            <h5>-</h5>
                            <hr>
                            <h4>myNews Feed</h4>
                            <h5>-</h5>
                            <h5>-</h5>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row3">
                <div class="col-sm-12">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <h2 class="panel-title">Actions</h2>
                        </div>
                        <div class="panel-body3">
                            <table class="table">
                                <thead>
                                <th>Select</th>
                                <th>Items</th>
                                <th>Date</th>
                                </thead>
                                <tbody>
                                <tr>
                                    <td>
                                        <div class="checkbox"><label><input type="checkbox"></label></div>
                                    </td>
                                    <td>Candidate 3859305087 has accepted the contract</td>
                                    <td>10-23-15 at 10:15am</td>
                                </tr>
                                <tr>
                                    <td>
                                        <div class="checkbox"><label><input type="checkbox"></label></div>
                                    </td>
                                    <td>
                                        <div>Candidate 3859305087 has replied to your message</div>
                                    </td>
                                    <td>10-22-15 at 9:25am</td>
                                </tr>
                                </tbody>
                            </table>
                            <br>
                            <a href="#" class="btn btn-default" role="button">Delete</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @if($jobs)
        @foreach($jobs as $job)
            @include('public.includes.modalJob')
            @include('public.includes.modaRanking')
        @endforeach
    @endif
@endsection
