<!-- Navbar -->
<script>
    var profile_id = <?php if (!empty($profile_id)) {
        echo $profile_id;
    } else {
        echo 0;
    } ?>;
</script>

<!-- Navbar -->

<nav class="navbar navbar-default">
    <div class="container-fluid">
        <div class="row" id="topNav">
            <div class="col-sm-4">
                <div class="navbar-header">
                    <a class="navbar-brand" href="{{URL::route('guest::home')}}"><a href ="{{URL::route('guest::home')}}"><img src="{{ URL::asset('img/newLogoImg4.jpg') }}" id="logo" alt="logo pic"></a></a>
                </div>
            </div>

            <div class="col-sm-8">
                <ul class="nav navbar-nav">
                    <?php if (Request::is('onboarding/*'))
                    { ?>
                    <li><a href="{{URL::route('guest::onboarding::about-you')}}">Personal Info</a></li>
                    <li><a href="{{URL::route('guest::onboarding::industry')}}">Industry</a></li>
                    <li><a href="{{URL::route('guest::onboarding::occupation')}}">Occupation</a></li>
                    <li><a href="{{URL::route('guest::onboarding::education')}}">Education</a></li>
                    <li><a href="{{URL::route('guest::onboarding::qualification')}}">Qualifications</a></li>
                    <li><a href="{{URL::route('guest::onboarding::cultural')}}">Culture</a></li>
                    <?php } else { ?>
                    <li class="<?php if(Request::is('/')) echo 'active'?>"><a href="{{URL::route('guest::home')}}">Home</a></li>
                    <li><a href="{{URL::route('guest::home')}}#revolution">Hiring Revolution</a></li>
                    <li><a href="{{URL::route('guest::home')}}#seekers">Job Seekers</a></li>
                    <li><a href="{{URL::route('guest::home')}}#companies">Hiring Companies</a></li>
                    <li class="<?php if(Request::is('about')) echo 'active'?>"> <a href="{{URL::route('guest::about')}}">About Us</a></li>
                    <li class="dropdown">
                        <a class="dropdown-toggle" data-toggle="dropdown" href="#">Contact</a>
                        <ul class="dropdown-menu">
                            <li><a href="mailto:connect@quansissystems.com">Support</a></li>
                            <li><a href="mailto:legal@quansissystems.com">Legal</a></li>
                            <li><a href="mailto:webmaster@quansissystems.com">Technical</a></li>
                        </ul>
                    </li>
                    <li><a href="{{URL::route('guest::home')}}#opportunities">Opportunities</a></li>
                    <?php } ?>
                </ul>
                <ul class="nav navbar-nav navbar-right">
                    @if(Auth::user())
                        <li><a href="/onboarding/about-you"><span class="glyphicon glyphicon-log-in"></span>
                                Preferences</a></li>
                        @if(Auth::user()->type == 'company')
                            <li><a href="{{URL::route('guest::command-center')}}">Command Center</a></li>
                        @else
                            <li><a href="{{URL::route('guest::profile')}}">Profile</a></li>
                        @endif
                        <li><a href="/logout"><span class="glyphicon glyphicon-log-in"></span> Logout</a></li>
                    @else
                        <li><a href="/register"><span
                                        class="glyphicon glyphicon-user"></span> Sign Up</a></li>
                        <li><a href="#modalLogin" data-toggle="modal" data-target="#modalLogin"><span
                                        class="glyphicon glyphicon-log-in"></span> Login</a></li>
                    @endif
                </ul>
            </div>
        </div>

        <div class="row" id="bottomNav">
            <div class="col-sm-4">
                <ul class="nav navbar-nav" id="navButtons">
                    <li><a href="https://www.facebook.com/QuansisSystems/"><img id="navPic"
                                                                                src="{{ URL::asset('img/facebook.png') }}"></a>
                    </li>
                    <li><a href="https://www.linkedin.com/company-beta/6649581/"><img id="navPic"
                                                                                      src="{{ URL::asset('img/linkedin.png') }}"></a>
                    </li>
                    <li><a href="https://angel.co/quansis-systems"><img id="navPic"
                                                                        src="{{ URL::asset('img/angel.png') }}"></a>
                    </li>
                    <li><a href="https://twitter.com/QuansisSystems"><img id="navPic"
                                                                          src="{{ URL::asset('img/twitter.png') }}"></a>
                    </li>
                    <li class="dropdown">
                        <a class="dropdown-toggle" data-toggle="dropdown" href="#"><img id="navPic"
                                                                                        src="{{ URL::asset('img/email.png') }}"></a>
                        <ul class="dropdown-menu">
                            <li><a href="mailto:connect@quansissystems.com">Support</a></li>
                            <li><a href="mailto:legal@quansissystems.com">Legal</a></li>
                            <li><a href="mailto:webmaster@quansissystems.com">Technical</a></li>
                        </ul>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</nav>


@include('public.includes.messages')
<!-- Modal Alerts Login -->
<div class="modal fade" id="modalLogin">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                <h4 class="modal-title">Login</h4>
            </div>
            <div class="alert alert-danger login-danger hidden" role="alert">
            </div>
            <form action="/login" method="post" id="login_form">
                {{ csrf_field() }}
                <div class="modal-body">

                    <div class="form-group">
                        <label for="exampleInputEmail1">Email address</label>
                        <input class="form-control" id="email" name="email" placeholder="Enter email" type="email"
                               required>
                    </div>
                    <div class="form-group">
                        <label for="exampleInputPassword1">Password</label>
                        <input class="form-control" id="password" name="password" placeholder="Password"
                               type="password"
                               required>
                    </div>
                    <p class="text-right"><a href="#">Forgot password?</a></p>
                </div>
                <div class="modal-footer">
                    <a href="#" data-dismiss="modal" class="btn">Close</a>
                    <input type="submit" class="btn btn-primary" value="Login">
                </div>
            </form>
        </div>
    </div>
</div>