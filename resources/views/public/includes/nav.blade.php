
<?php
//$user_id = $user['user_id'];
//$user['name_first'] = '';
$url = $_SERVER['REQUEST_URI'];
?>
<!-- Navbar -->
<nav class="navbar">
    <div class="container-fluid-nav">
        <div>
            <?php if($url == "/seekerPreferences.php") { ?>
            <ul class="nav navbar-nav">
                <li id="logo"><a href ="index.php"><img src="{{ URL::asset('img/newLogoImg.jpg') }}" alt="log pic"></a></li>
                <li><a data-toggle="collapse" data-parent="#accordion" href="#collapseOne">Personal Info</a></li>
                <li><a data-toggle="collapse" data-parent="#accordion" href="#collapseTwo">Occupation</a></li>
                <li><a data-toggle="collapse" data-parent="#accordion" href="#collapseThree">Industry</a></li>
                <li><a data-toggle="collapse" data-parent="#accordion" href="#collapseFour">Education</a></li>
                <li><a data-toggle="collapse" data-parent="#accordion" href="#collapseFive">Cultural</a></li>
                <li><a data-toggle="collapse" data-parent="#accordion" href="#collapseSix">Skills</a></li>

            </ul>
            <?php } else { ?>
            <ul class="nav navbar-nav">
                <li id="logo"><a href ="index.php"><img src="{{ URL::asset('img/newLogoImg.jpg') }}" alt="log pic"></a></li>
                <li><a href="#revolution">Hiring Revolution</a></li>
                <?php
                if(empty($user_id)) { ?>
                <li><a href="#seekers">Job Seekers</a></li>
                <li><a href="#companies">Hiring Companies</a></li>
                <?php } else { ?>
                <li><a href="/../seekerPortal.php">Job Seekers</a></li>
                <li><a href="/../commandCenter.php">Hiring Companies</a></li>
                <?php } ?>

                <li><a href="#about">About Us</a></li>
                <li><a href="#contact">Contact Us</a></li>
            </ul>
            <?php } ?>
            <ul class="nav navbar-nav navbar-right">
                <?php if($url == "/seekerPortal.php") { ?>
                <li><a href="./seekerPreferences.php"><span class="glyphicon glyphicon-log-in"></span> Preferences</a></li>
                <?php } ?>
                <?php if(empty($user_id)) { ?>
                <li><a href="#modalSignup" data-toggle ="modal" data-target ="#modalSignup"><span class="glyphicon glyphicon-user"></span> Sign Up</a></li>
                <li><a href="#modalLogin" data-toggle ="modal" data-target ="#modalLogin"><span class="glyphicon glyphicon-log-in"></span> Login</a></li>
                <?php } else { ?>
                <li><a href="./seekerPortal.php">My Q-portal</a></li>
                <li><a href="./logout.php"><span class="glyphicon glyphicon-log-in"></span> Logout</a></li>
                <?php } ?>
            </ul>
        </div>
    </div>
    <?php
    if ($_SERVER['PHP_SELF'] == '/index.php') {
    ?>
    <img src="{{ URL::asset('img/newHeaderImg.jpg') }}"  class="main_image" alt="background"/>
    <?php
    }
    ?>
</nav>

<!-- Modal Alerts Sign up -->
<div class="modal fade" id="modalSignup">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                <h4 class="modal-title">Sign Up</h4>
            </div>
            <form action="adduser.php" method="post" id="signup_form">
                <div class="modal-body">
                    <div class="form-group">
                        <label for="exampleInputFirstName">First Name</label>
                        <input class="form-control" id="name_first" name="name_first"  placeholder="Enter First Name" type="input" >
                    </div>
                    <div class="form-group">
                        <label for="exampleInputLasrName">Last Name</label>
                        <input class="form-control" id="name_last" name="name_last" placeholder="Enter Last Name" type="input" >
                    </div>
                    <div class="form-group">
                        <label for="exampleInputEmail1">Email address</label>
                        <input class="form-control" id="email" name="email"  placeholder="Enter email" type="email" >
                    </div>
                    <div class="form-group">
                        <label for="exampleInputPassword1">Create Password</label>
                        <input class="form-control" id="password" name="password" placeholder="Password" type="password">
                    </div>
                    <div class="form-group">
                        <label for="exampleInputPassword2">Re-Enter Password</label>
                        <input class="form-control" id="confirm_password"  name="confirm_password" placeholder="Password" type="password">
                    </div>
                </div>
                <div class="modal-footer">
                    <a href="#" data-dismiss="modal" class="btn">Close</a>
                    <input type="submit" class="btn btn-primary">
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Modal Alerts Login -->
<div class="modal fade" id="modalLogin">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                <h4 class="modal-title">Log-in</h4>
            </div>
            <form action="/login" method="post" id="login_form">
                <div class="modal-body">

                    <div class="form-group">
                        <label for="exampleInputEmail1">Email address</label>
                        <input class="form-control" id="email"  name="u" placeholder="Enter email" type="email" required>
                    </div>
                    <div class="form-group">
                        <label for="exampleInputPassword1">Password</label>
                        <input class="form-control" id="password" name="p" placeholder="Password" type="password" required>
                    </div>
                    <p class="text-right"><a href="#">Forgot password?</a></p>
                </div>
                <div class="modal-footer">
                    <a href="#" data-dismiss="modal" class="btn">Close</a>
                    <input type="submit" class="btn btn-primary" value="Log-in" >
                </div>
            </form>
        </div>
    </div>
</div>