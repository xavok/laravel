@extends('public.layouts.master')

@section('content')
    <!-- Modal Alerts Sign up -->
        <div class="modal-dialog">

            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                    <h4 class="modal-title">Company Sign Up</h4>
                </div>
                <div>
                    <h4 class="modal-title center">Want to sign up as job seeker?
                    <a href="{{route('guest::register')}}">click here</a></h4>
                </div>
                <form action="#" method="post" id="signup_form">
                    {{ csrf_field() }}
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="exampleInputFirstName">Name</label>
                            <input class="form-control" id="name" name="name" placeholder="Enter Company Name">
                        </div>
                        <div class="form-group">
                            <label for="exampleInputEmail1">Email address</label>
                            <input class="form-control" id="email" name="email" placeholder="Enter email" type="email">
                        </div>
                        <div class="form-group">
                            <label for="exampleInputPassword1">Create Password</label>
                            <input class="form-control" id="password" name="password" placeholder="Password"
                                   type="password">
                        </div>
                        <div class="form-group">
                            <label for="exampleInputPassword2">Re-Enter Password</label>
                            <input class="form-control" id="confirm_password" name="confirm_password" placeholder="Password"
                                   type="password">
                        </div>
                    </div>
                    <div class="modal-footer">
                        <a href="#" data-dismiss="modal" class="btn">Close</a>
                        <input type="submit" class="btn btn-primary">
                    </div>
                </form>
            </div>
        </div>
@endsection

