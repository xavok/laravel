<!-- Navbar -->
<script>
    var profile_id = <?php if (!empty($profile_id)) {
        echo $profile_id;
    } else {
        echo 0;
    } ?>;
</script>

<nav class="navbar">
    <div class="container-fluid-nav">
        <div>
            @if($errors->any())
                <div class="alert alert-danger" role="alert">
                    {{$errors->first()}}
                </div>
            @endif
            <ul class="nav navbar-nav">
                <li id="logo"><a href="{{URL::route('guest::home')}}"><img src="{{ URL::asset('img/newLogoImg.jpg') }}"
                                                                           alt="log pic"></a>
                </li>
                <?php if (Request::is('onboarding/*'))
                { ?>
                <li><a href="{{URL::route('guest::onboarding::about-you')}}">Personal Info</a></li>
                <li><a href="{{URL::route('guest::onboarding::industry')}}">Industry</a></li>
                <li><a href="{{URL::route('guest::onboarding::occupation')}}">Occupation</a></li>
                <li><a href="{{URL::route('guest::onboarding::education')}}">Education</a></li>
                <li><a href="{{URL::route('guest::onboarding::qualification')}}">Qualifications</a></li>
                <li><a href="{{URL::route('guest::onboarding::cultural')}}">Culture</a></li>
                <?php } else { ?>
                <li><a href="{{URL::route('guest::home')}}#revolution">Hiring Revolution</a></li>
                <li><a href="{{URL::route('guest::home')}}#seekers">Job Seekers</a></li>
                <li><a href="{{URL::route('guest::home')}}#companies">Hiring Companies</a></li>
                <li><a href="{{URL::route('guest::home')}}#about">About Us</a></li>
                <li><a href="{{URL::route('guest::home')}}#contact">Contact Us</a></li>
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
    @if(Route::getCurrentRoute()->uri() == '/')
        <img src="{{ URL::asset('img/newHeaderImg.jpg') }}" class="main_image" alt="background"/>
    @endif
</nav>


<!-- Modal Alerts Login -->
<div class="modal fade" id="modalLogin">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                <h4 class="modal-title">Log-in</h4>
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
                        <input class="form-control" id="password" name="password" placeholder="Password" type="password"
                               required>
                    </div>
                    <p class="text-right"><a href="#">Forgot password?</a></p>
                </div>
                <div class="modal-footer">
                    <a href="#" data-dismiss="modal" class="btn">Close</a>
                    <input type="submit" class="btn btn-primary" value="Log-in">
                </div>
            </form>
        </div>
    </div>
</div>