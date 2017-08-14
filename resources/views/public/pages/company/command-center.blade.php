@extends('public.layouts.master')

@section('content')
    <div class="commandCenter">
    <div class="container-fluid">
        <div class="row1">
            <div class="col-sm-12">
                <div class="panel panel-primary">
                    <div class="panel-heading">
                        <div class="panel-title1">
                            <h2>ABC Inc. Command Center</h2>
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
                        <table class="table">
                            <thead>
                            <th>Select</th>
                            <th>Job Id</th>
                            <th>Job Title</th>
                            <th>Date</th>
                            </thead>
                            <tbody>
                            <tr>
                                <td><div class="checkbox"><label><input type="checkbox"></label></div></td>
                                <td><a href="#modalJob" data-toggle ="modal" data-target ="#modalJob">IT2348</a></td>
                                <td><a href="#modalRanking" data-toggle ="modal" data-target ="#modalRanking">Senior Software Developer</a></td>
                                <td>10-21-15 at 09:15am</td>
                            </tr>
                            <tr>
                                <td><div class="checkbox"><label><input type="checkbox"></label></div></td>
                                <td>32312199</td>
                                <td><div>Lead Web Developer</div></td>
                                <td>10-23-15 at 8:25am</td>
                            </tr>
                            <tr>
                                <td><div class="checkbox"><label><input type="checkbox"></label></div></td>
                                <td>22548566</td>
                                <td>SEO Speacialist</td>
                                <td>10-23-15 at 7:55am</td>
                            </tr>
                            <tr>
                                <td><div class="checkbox"><label><input type="checkbox"></label></div></td>
                                <td>39398485</td>
                                <td>Jr. Software Engineer</td>
                                <td>10-21-15 at 5:13pm</td>
                            </tr>
                            <tr>
                                <td><div class="checkbox"><label><input type="checkbox"></label></div></td>
                                <td>00202993</td>
                                <td>Integration Engineer</td>
                                <td>10-21-15 at 4:25pm</td>
                            </tr>
                            </tbody>
                        </table>
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
                        <h2 class="panel-title">myForum</h2>
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
                        <h2 class="panel-title">myNetwork</h2>
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
                        <h2 class="panel-title">myNews</h2>
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
                                <td><div class="checkbox"><label><input type="checkbox"></label></div></td>
                                <td>Candidate 3859305087 has accepted the contract</td>
                                <td>10-23-15 at 10:15am</td>
                            </tr>
                            <tr>
                                <td><div class="checkbox"><label><input type="checkbox"></label></div></td>
                                <td><div>Candidate 3859305087 has replied to your message</div></td>
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
@endsection
