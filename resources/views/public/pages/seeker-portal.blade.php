@extends('public.layouts.master')

@section('content')
    <div class="container-fluid">
        <div class="row1">
            <div class="col-sm-12">
                <div class="panel panel-primary">
                    <div class="panel-heading">
                        <div class="panel-title1">

                            <h2>{{$user->first_name}}'s Portal </h2>


                            <h2><span class="glyphicon glyphicon-home"></span></h2>

                            <h2><span class="glyphicon glyphicon-alert"></span></h2>

                            <h2><span class="glyphicon glyphicon-stats"></span></h2>

                            <h2><span class="glyphicon glyphicon-envelope"></span></h2>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <br>

    <div class="container-fluid">
        <div class="row1">
            <div class="col-sm-9">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h2 class="panel-title">Alerts</h2>
                    </div>
                    <div class="panel-body">
                        <table class="table" id="seeker_alerts">
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
                                <td>
                                    <div>You have new mail</div>
                                </td>
                                <td>10-23-15 at 8:25am</td>
                            </tr>
                            <tr>
                                <td>
                                    <div class="checkbox"><label><input type="checkbox"></label></div>
                                </td>
                                <td>You have been ranked 1 of 75</td>
                                <td>10-23-15 at 7:55am</td>
                            </tr>
                            <tr>
                                <td>
                                    <div class="checkbox"><label><input type="checkbox"></label></div>
                                </td>
                                <td>You have new mail</td>
                                <td>10-21-15 at 5:13pm</td>
                            </tr>
                            <tr>
                                <td>
                                    <div class="checkbox"><label><input type="checkbox"></label></div>
                                </td>
                                <td>You have been ranked 10 of 50</td>
                                <td>10-21-15 at 4:25pm</td>
                            </tr>
                            </tbody>
                        </table>
                        <br>
                        <a href="#" class="btn btn-default" role="button">Delete</a>
                    </div>
                </div>
            </div>
            <div class="col-sm-3">
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
            <div class="col-sm-3">
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
            <div class="col-sm-3">
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
            <div class="col-sm-3">
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
            <div class="col-sm-3">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h2 class="panel-title">My Career</h2>
                    </div>
                    <div class="panel-body">
                        <h4>Recommended Actions</h4>
                        <h5>-</h5>
                        <h5>-</h5>
                        <hr>
                        <h4>Future Trends</h4>
                        <h5>-</h5>
                        <h5>-</h5>
                        <hr>
                        <h4>myCareerManager</h4>
                        <h5>-</h5>
                        <h5>-</h5>
                    </div>
                </div>
            </div>
        </div>

        <div class="row3">
            <div class="col-sm-9">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h2 class="panel-title">Actions</h2>
                    </div>
                    <div class="panel-body3">
                        <table class="table">
                            <thead>
                            <th>Select</th>
                            <th>Items</th>
                            <th>Description</th>
                            <th>Date</th>
                            </thead>
                            <tbody>
                            <tr>
                                <td>
                                    <div class="checkbox"><label><input type="checkbox"></label></div>
                                </td>
                                <td><a href="#modalJobDescription" data-toggle="modal"
                                       data-target="#modalJobDescription">ABC Inc.</a></td>
                                <td>ABC Inc. wants to setup first contract with you.</td>
                                <td>10-23-15 at 10:15am</td>
                            </tr>
                            <tr>
                                <td>
                                    <div class="checkbox"><label><input type="checkbox"></label></div>
                                </td>
                                <td>
                                    <div>XYZ Corp</div>
                                </td>
                                <td>
                                    <div>XYZ Corp. wants to setup a meeting.</div>
                                </td>
                                <td>09-03-15 at 9:25am</td>
                            </tr>
                            </tbody>
                        </table>
                        <br>
                        <a href="#" class="btn btn-default" role="button">Delete</a>
                    </div>
                </div>
            </div>
            <div class="col-sm-3">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h2 class="panel-title">Advertisements</h2>
                    </div>
                    <div class="panel-body3">
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

