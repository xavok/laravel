@extends('public.layouts.master')

@section('content')
    <div id="seeker_preference">
        <div class="container-fluid">
            <div class="progress">
                <div id="bar" class="progress-bar progress-bar-success"
                     role="progressbar" aria-valuenow="60" aria-valuemin="0"
                     aria-valuemax="100" style="width: 0%;">
                    0%
                </div>
            </div>

            <div class="panel panel-default">
                <div class="panel-body">
                    <form method="post" action="#" id="personal_info_form">
                        {{ csrf_field() }}
                        <input type="hidden" name="id" id="id"/>
                        <h1>Personal Info</h1>

                        <label for="exampleInputEmail1">Email</label>
                        <div class="input-group">
                            <span class="input-group-addon"><span class="glyphicon glyphicon-envelope "
                                                                  aria-hidden="true"></span></span>
                            <input type="email" id="email" class="form-control" name="email"
                                   placeholder="johndoe@gmail.com" aria-describedby="basic-addon1"
                                   value="{{$user->email}}" disabled>
                        </div>

                        <label for="exampleInputEmail1">Username</label>
                        <div class="input-group">
                            <span class="input-group-addon"><span class="glyphicon glyphicon-user"
                                                                  aria-hidden="true"></span></span>
                            <input type="text" class="form-control" id="username" name="username" placeholder="xavok"
                                   value="{{$user->username}}"
                                   aria-describedby="basic-addon1" disabled>
                        </div>

                        <label for="exampleInputEmail1">First Name</label>
                        <div class="input-group">
                            <span class="input-group-addon"><span class="glyphicon glyphicon-user"
                                                                  aria-hidden="true"></span></span>
                            <input type="text" class="form-control" id="fName" name="first_name" placeholder="John"
                                   value="{{$user->first_name}}"
                                   aria-describedby="basic-addon1" required>
                        </div>

                        <label for="exampleInputEmail1">Last Name</label>
                        <div class="input-group">
                            <span class="input-group-addon"><span class="glyphicon glyphicon-user"
                                                                  aria-hidden="true"></span></span>
                            <input type="text" class="form-control" id="lName" name="last_name" placeholder="Doe"
                                   value="{{$user->last_name}}"
                                   aria-describedby="basic-addon1" required>
                        </div>


                        <label for="exampleInputEmail1">Country</label>
                        <div class="input-group">
                            <span class="input-group-addon"><span class="glyphicon glyphicon-map-marker "
                                                                  aria-hidden="true"></span></span>
                            <select class="chosen-select form-control" name="country" id="city">
                                @foreach($countries as $country)
                                    <option value="{{$country->id}}" @if($country->id == 840) selected @endif>{{$country->full_name}}</option>
                                @endforeach
                            </select>
                        </div>

                        <label for="zip">Zip</label>
                        <div class="input-group">
                            <span class="input-group-addon"><span class="glyphicon  glyphicon-map-marker "
                                                                  aria-hidden="true"></span></span>
                            <input type="text" class="form-control" name="zip_code" placeholder="9518"
                                   aria-describedby="basic-addon1" id="zip" required>
                        </div>

                        <label for="exampleInputEmail1">Phone</label>
                        <div class="input-group">
                            <span class="input-group-addon"><span class="glyphicon glyphicon-phone "
                                                                  aria-hidden="true"></span></span>
                            <input type="phone" class="form-control" name="phone_primary" placeholder="555-555-5555"
                                   aria-describedby="basic-addon1" id="phone">
                        </div>

                        <div class=" input-group" style="width: 100%;">
                            <input type="submit" value="Next" name="PIsubmit" class="btn btn-default buttonNext"
                                   id="submit_personal_info">
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection