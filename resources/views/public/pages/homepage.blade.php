@extends('public.layouts.master')

@section('content')

    <!-- Revolution Header -->
    <div class="jumbotron">
        <div id="revolution">
            <div class="container-fluid">
                <div class="row">
                    <h1 class ="revolutionH">A Revolution is Here</h1>
                    <br><br>
                    <img src="{{ URL::asset('img/revPic.png') }}" alt="job seeker pic">
                    <br><br>
                    <div class="col-sm-4">
                        <div class="well well-lg">
                            <h2>The Revolution</h2>
                            <hr>
                            <p>Aren’t you tired of hiring the wrong candidate? Or accepting the wrong position? Why does this happen so frequently? The hiring process...</p>
                            <br>
                            <a href="#readMoreRevolution" data-toggle ="modal" data-target ="#readMoreRevolution" class="btn btn-danger center-block center-block">Read More</a>
                        </div>
                    </div>
                    <div class="col-sm-4">
                        <div class="well well-lg">
                            <h2>Data Driven</h2>
                            <hr>
                            <p>We are a data/analytics company that uses our proprietary engine and predictive architecture to measure, define, and select the best...</p>
                            <br>
                            <a href="#readMoreData" data-toggle ="modal" data-target ="#readMoreData" class="btn btn-danger center-block">Read More</a>
                        </div>
                    </div>
                    <div class="col-sm-4">
                        <div class="well well-lg">
                            <h2>Industry First</h2>
                            <hr>
                            <p>Quansis positions itself as an intermediary between companies and candidates, conducting double blind evaluations.  In this manner the Quansis...</p>
                            <br>
                            <a href="#readMoreFirst" data-toggle ="modal" data-target ="#readMoreFirst" class="btn btn-danger center-block">Read More</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal Alert Read More Revolution -->
    <div class="modal fade" id="readMoreRevolution">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                    <h4 class="modal-title">THE REVOLUTION</h4>
                </div>
                <div class="modal-body">
                    <p>Aren’t you tired of hiring the wrong candidate? Or accepting the wrong position?  Why does this happen so frequently?  The hiring process is stuck in the 1940s.  It’s archaic, arduous, and insufficient, but Quansis makes it modern, easy, and effective.</p>
                    <p>Quansis is developing a new paradigm for total talent management, i.e. hiring and staffing, employee retention, and internal mobility.  It is the industry’s first truly data-driven, fully integrated, and complete solution for sourcing, matching, on-boarding, and retention.</p>
                </div>
                <div class="modal-footer">
                    <a href="#" data-dismiss="modal" class="btn">Close</a>
                </div>
            </div>
        </div>
    </div>


    <!-- Modal Alert Read More Date Driven -->
    <div class="modal fade" id="readMoreData">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                    <h4 class="modal-title">DATA DRIVEN SOLUTIONS</h4>
                </div>
                <div class="modal-body">
                    <p>We are a data/analytics company that uses our proprietary engine and predictive architecture to measure, define, and select the best candidates for any given position.</p>
                    <p>Quansis creates a comprehensive HR ecosystem to address the complete lifecycle of each person working at a company, Lifetime Talent ManagementTM. We also offer Lifetime Career GuidanceTM   for job seekers who actively use and stay enrolled on our system via our proprietary Q PortalTM, which is the individually tailored one-stop site for all of the job seekers needs.</p>
                </div>
                <div class="modal-footer">
                    <a href="#" data-dismiss="modal" class="btn">Close</a>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal Alert Read More Date Driven -->
    <div class="modal fade" id="readMoreFirst">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                    <h4 class="modal-title">INDUSTRY’S FIRST TRUE DOUBLE BLIND EVALUATION</h4>
                </div>
                <div class="modal-body">
                    <p>Quansis positions itself as an intermediary between companies and candidates, conducting double blind evaluations.  In this manner the Quansis system helps to eliminate both intentional and unintentional bias.  Our anonymized double blind analysis is entirely neutral in terms of race, gender, ethnicity, religion, and country of origin.  Compliance is simplified through prevention.</p>
                    <p>Moreover, Quansis facilitates the ability to evaluate outside candidates on par with inside employees.  The bias towards inside promotion is indeed a very common blind spot, particularly since   promotion is almost universally regarded as a rewards system.  Quansys evaluates outside and inside candidates equally, on an apples-to-apples basis.</p>
                </div>
                <div class="modal-footer">
                    <a href="#" data-dismiss="modal" class="btn">Close</a>
                </div>
            </div>
        </div>
    </div>


    <!-- Job Seekers Header-->
    <div class="jumbotron-special">
        <div id="seekers">
            <div class="container-fluid">
                <div class="row">
                    <h1 class ="seekersH">Job Seekers</h1>
                    <br>
                    <img src="{{ URL::asset('img/jobPic.png') }}" alt="job seeker pic">
                </div>
                <div class="row">
                    <div class="col-sm-4">
                        <div class="well well-lg">
                            <h2>We Make it Easy</h2>
                            <hr>
                            <p>No more wasting hundreds of hours writing resumes, covers letters and filling out duplicate applications.  The Quansis System...</p>
                            <br>
                            <a href="#readMoreEasy" data-toggle ="modal" data-target ="#readMoreEasy" class="btn btn-danger center-block">Read More</a>
                        </div>
                    </div>
                    <div class="col-sm-4">
                        <div class="well well-lg">
                            <h2>The Blackhole Killer</h2>
                            <hr>
                            <p>No more the Black Holes.  Applications no longer disappear over the HR event horizon without any useful response...</p>
                            <br>
                            <a href="#readMoreBlackholes" data-toggle ="modal" data-target ="#readMoreBlackholes" class="btn btn-danger center-block">Read More</a>
                        </div>
                    </div>
                    <div class="col-sm-4">
                        <div class="well well-lg">
                            <h2>Get Hired</h2>
                            <hr>
                            <p>Eliminates subjectivity and bias driving hiring decisions – The Quansis System forestalls, all potential consideration...</p>
                            <br>
                            <a href="#readMoreHired" data-toggle ="modal" data-target ="#readMoreHired" class="btn btn-danger center-block">Read More</a>
                        </div>
                    </div>
                    <?php if(empty($user_id)) { ?>

                    <div class="col-sm-12">

                        <h4><a href="#modalSignup" data-toggle ="modal" data-target ="#modalSignup" class ="btn btn-danger btn-block"><span class="glyphicon glyphicon-user"></span> Sign Up</a><h4>
                    </div>
                    <?php } ?>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal Alert Read More Easy -->
    <div class="modal fade" id="readMoreEasy">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                    <h4 class="modal-title">We Make it Easy for the Job Seeker</h4>
                </div>
                <div class="modal-body">
                    <p>No more wasting hundreds of hours writing resumes, covers letters and filling out duplicate applications.  The Quansis System only asks for one to two hours in order to create an occupational profile.</p>
                    <p>Once completed, the job seeker never has to search for another job, write another resume, create another cover letter, or fill out another application.</p>
                    <p>Our proprietary Q-PortalTM contains all the tools and information necessary for job searching, and both industry data and competitive career intelligence through Lifetime Career GuidanceTM. It provides comprehensive and usable data on each company and position before a candidate applies, in addition to anonymized data on others applying for that same position.  For both applicants and incumbents, it makes available up-to-date assessment of his or her relative position and prospects.  Additionally, the Q-PortalTM provides a forum for targeted social media, facilitating networking opportunities and industry-related activities.</p>
                </div>
                <div class="modal-footer">
                    <a href="#" data-dismiss="modal" class="btn">Close</a>
                </div>
            </div>
        </div>
    </div>


    <!-- Modal Alert Read More Blackholes -->
    <div class="modal fade" id="readMoreBlackholes">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                    <h4 class="modal-title">The Blackhole Killer</h4>
                </div>
                <div class="modal-body">
                    <p>No more the Black Holes.  Applications no longer disappear over the HR event horizon without any useful response.</p>
                    <p>The Quansis Solution provides real-time and full feedback.  For the first time ever, the job seekers will now know exactly where they stand and what they need to do.</p>
                </div>
                <div class="modal-footer">
                    <a href="#" data-dismiss="modal" class="btn">Close</a>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal Alert Read More Get Hired -->
    <div class="modal fade" id="readMoreHired">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                    <h4 class="modal-title">Be Hired for your Real Talents</h4>
                </div>
                <div class="modal-body">
                    <p>Eliminates subjectivity and bias driving hiring decisions – The Quansis System forestalls, all potential consideration of candidate age, race, sex, gender, religion, or ethnicity.</p>
                </div>
                <div class="modal-footer">
                    <a href="#" data-dismiss="modal" class="btn">Close</a>
                </div>
            </div>
        </div>
    </div>

    <!-- Hiring Companies Header-->
    <div class="jumbotron">
        <div id="companies">
            <h1 class ="companiesH">Hiring Companies</h1>
            <img src="{{ URL::asset('img/hiringPic.png') }}" alt="Hiring pic">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-sm-4">
                        <div class="well well-lg">
                            <h2>We Make it Easy</h2>
                            <hr>
                            <p>Eliminates the résumé trap.  Résumés and cover letters are targeted sales pitches, constituting self-reporting by candidates...</p>
                            <br>
                            <a href="#readMoreEasyHiring" data-toggle ="modal" data-target ="#readMoreEasyHiring" class="btn btn-danger center-block">Read More</a>
                        </div>
                    </div>
                    <div class="col-sm-4">
                        <div class="well well-lg">
                            <h2>The Chessboard</h2>
                            <hr>
                            <p>Performance and potential are two different things, which we work to reconcile both before and after the hiring decision...</p>
                            <br>
                            <a href="#readMoreChess" data-toggle ="modal" data-target ="#readMoreChess" class="btn btn-danger center-block">Read More</a>
                        </div>
                    </div>
                    <div class="col-sm-4">
                        <div class="well well-lg">
                            <h2>Validation</h2>
                            <hr>
                            <p>Quansis provides continuous validation once each candidate is hired and onboarded.  Our system relies not only on... </p>
                            <br>
                            <a href="#readMoreValidation" data-toggle ="modal" data-target ="#readMoreValidation" class="btn btn-danger center-block">Read More</a>
                        </div>
                    </div>
                    <?php if(empty($user_id)) { ?>

                    <div class="col-sm-12">

                        <h4><a href="#modalSignup" data-toggle ="modal" data-target ="#modalSignup" class ="btn btn-danger btn-block"><span class="glyphicon glyphicon-user"></span> Sign Up</a><h4>
                    </div>
                    <?php } ?>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal Alert Read More Easy For the Hiring Company -->
    <div class="modal fade" id="readMoreEasyHiring">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                    <h4 class="modal-title">We Make it Easy for the Hiring Company</h4>
                </div>
                <div class="modal-body">
                    <p>Eliminates the résumé trap.  Résumés and cover letters are targeted sales pitches, constituting self-reporting by candidates.  They are frequently inaccurate, and neither assess skills nor cultural fit.<p>
                    <p>No more delays and high costs to fill positions.</p>
                    <p>No more mismatching of candidates to openings.</p>
                    <p>Reduced employee disengagement and turnover through Lifecycle Talent ManagementTM.</p>
                    <p>Reduced compliance risk by eliminating all potential consideration of candidate age, race, sex, gender, religion, or ethnicity. None of this identifying information is seen by hiring companies until the job seekers choose to reveal themselves, after a position is offered.</p>
                </div>
                <div class="modal-footer">
                    <a href="#" data-dismiss="modal" class="btn">Close</a>
                </div>
            </div>
        </div>
    </div>


    <!-- Modal Alert Read More HR Chessboard -->
    <div class="modal fade" id="readMoreChess">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                    <h4 class="modal-title">The HR Chessboard</h4>
                </div>
                <div class="modal-body">
                    <p>Performance and potential are two different things, which we work to reconcile both before and after the hiring decision is made.  Quansis incorporates more than history and looks forward by generating, collecting, and interpreting data to predict performance and to find hidden talents.</p>
                    <p>We liken this to playing chess.  Each piece has its value and capability.  A knight and a bishop are technically equal in rank, but each has distinct abilities and each has a different mission. Which candidate should be brought on as a knight, and which as a bishop? Who is a rook and who’s a pawn?</p>
                </div>
                <div class="modal-footer">
                    <a href="#" data-dismiss="modal" class="btn">Close</a>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal Alert Read More Continuous Validation -->
    <div class="modal fade" id="readMoreValidation">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                    <h4 class="modal-title">Continuous Validation</h4>
                </div>
                <div class="modal-body">
                    <p>Quansis provides continuous validation once each candidate is hired and onboarded.  Our system relies not only on continuous evaluation by managers, but also on continuous testing and correlation of on the job values against pre-employment candidate values.  Each individual, over time, is judged on whether he or she matches or exceeds original variables.  We can tell if an employee was under matched or overmatched for his or her position.  Should a pawn already on the board be a rook, or vice versa?  Should a bishop be a more nimble knight or should a knight be a more powerful bishop?</p>
                </div>
                <div class="modal-footer">
                    <a href="#" data-dismiss="modal" class="btn">Close</a>
                </div>
            </div>
        </div>
    </div>

    <!-- About Us Section-->
    <div class="jumbotron-special">
        <div id="about">
            <h1 class ="aboutH">About Us</h1>
            <img src="{{ URL::asset('img/aboutPic.png') }}" alt="about pic">
            <div class="container-fluid-contact">
                <div class = "row">
                    <div class ="col-sm-4">
                        <div id="about" class="well">
                            <h2>Developers</h2>
                            <hr>
                            <h1><a href="#developers" data-toggle ="modal" data-target ="#developers"><span class="glyphicon glyphicon-wrench"></span></a></h1>
                        </div>
                    </div>
                    <div class ="col-sm-4">
                        <div id="about" class="well">
                            <h2>Leadership</h2>
                            <hr>
                            <h1><a href="#executives" data-toggle ="modal" data-target ="#executives"><span class="glyphicon glyphicon-briefcase"></span></a></h1>
                        </div>
                    </div>
                    <div class ="col-sm-4">
                        <div id="about" class="well">
                            <h2>Board</h2>
                            <hr>
                            <h1><a href="#board" data-toggle ="modal" data-target ="#board"><span class="glyphicon glyphicon-blackboard"></span></a></h1>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <!-- Modal Alert Developers -->
    <div class="modal fade" id="developers">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                    <h4 class="modal-title">Development Team</h4>
                </div>
                <div class="modal-body">
                    <table class="table">
                        <tbody>
                        <tr>
                            <td><span class="glyphicon glyphicon-user"></span></td>
                            <td>Rick Rasmussen</td>
                            <td>CEO</td>
                        </tr>
                        <tr>
                            <td><span class="glyphicon glyphicon-user"></span></td>
                            <td>David Effross</td>
                            <td>Business Development</td>
                        </tr>
                        <tr>
                            <td><span class="glyphicon glyphicon-user"></span></td>
                            <td>Peter Hanley</td>
                            <td>Database Developer</td>
                        </tr>
                        <tr>
                            <td><span class="glyphicon glyphicon-user"></span></td>
                            <td>Dan Abresch</td>
                            <td>Front End Developer</td>
                        </tr>
                        <tr>
                            <td><span class="glyphicon glyphicon-user"></span></td>
                            <td>Max Nasyrov</td>
                            <td>Web Developer</td>
                        </tr>
                        <tr>
                            <td><span class="glyphicon glyphicon-user"></span></td>
                            <td>Rus Nasyrov</td>
                            <td>Software Developer</td>
                        </tr>
                        <tr>
                            <td><span class="glyphicon glyphicon-user"></span></td>
                            <td>Yasir Maricar</td>
                            <td>UI Developer</td>
                        </tr>
                        </tbody>
                    </table>
                </div>
                <div class="modal-footer">
                    <a href="#" data-dismiss="modal" class="btn">Close</a>
                </div>
            </div>
        </div>
    </div>


    <!-- Modal Alert Executives -->
    <div class="modal fade" id="executives">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                    <h4 class="modal-title">Leadership Team</h4>
                </div>
                <div class="modal-body">
                    <table class="table">
                        <tbody>
                        <tr>
                            <td><span class="glyphicon glyphicon-user"></span></td>
                            <td>Lauren Wichman</td>
                            <td>CDO</td>
                        </tr>
                        <tr>
                            <td><span class="glyphicon glyphicon-user"></span></td>
                            <td>Kellie Klein</td>
                            <td>CFO</td>
                        </tr>
                        <tr>
                            <td><span class="glyphicon glyphicon-user"></span></td>
                            <td>Paul Colnett</td>
                            <td>CIO</td>
                        </tr>
                        <tr>
                            <td><span class="glyphicon glyphicon-user"></span></td>
                            <td>Hennie Cloete</td>
                            <td>System Architect</td>
                        </tr>
                        <tr>
                            <td><span class="glyphicon glyphicon-user"></span></td>
                            <td>Mike Rogers</td>
                            <td>Account Executive</td>
                        </tr>
                        <tr>
                            <td><span class="glyphicon glyphicon-user"></span></td>
                            <td>Pedro Silva</td>
                            <td>Account Executive</td>
                        </tr>
                        <tr>
                            <td><span class="glyphicon glyphicon-user"></span></td>
                            <td>Joel Shatz</td>
                            <td>Account Executive</td>
                        </tr>
                        </tbody>
                    </table>
                </div>
                <div class="modal-footer">
                    <a href="#" data-dismiss="modal" class="btn">Close</a>
                </div>
            </div>
        </div>
    </div>


    <!-- Modal Alert The Board -->
    <div class="modal fade" id="board">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                    <h4 class="modal-title">The Board</h4>
                </div>
                <div class="modal-body">
                    <table class="table">
                        <tbody>
                        <tr>
                            <td><span class="glyphicon glyphicon-user"></span></td>
                            <td>Rosario Feghali Phd.</td>
                            <td>Technology/BI</td>
                        </tr>
                        <tr>
                            <td><span class="glyphicon glyphicon-user"></span></td>
                            <td>Joel Witte</td>
                            <td>Marketing</td>
                        </tr>
                        <tr>
                            <td><span class="glyphicon glyphicon-user"></span></td>
                            <td>Jane Li</td>
                            <td>Operations</td>
                        </tr>
                        <tr>
                            <td><span class="glyphicon glyphicon-user"></span></td>
                            <td>Paul Walters</td>
                            <td>Advertising</td>
                        </tr>
                        <tr>
                            <td><span class="glyphicon glyphicon-user"></span></td>
                            <td>Lauren Wichman</td>
                            <td>Staffing/HR</td>
                        </tr>
                        </tbody>
                    </table>
                </div>
                <div class="modal-footer">
                    <a href="#" data-dismiss="modal" class="btn">Close</a>
                </div>
            </div>
        </div>
    </div>

    <!-- Contact Us Section-->
    <div class="jumbotron">
        <div id="contact">
            <div class="container-fluid-contact">
                <div class="row">
                    <h1 class ="contactH">Contact Us</h1>
                    <img src="{{ URL::asset('img/contactPic.png') }}" alt="Contact pic">
                    <hr>
                    <br>
                    <div class="col-sm-2">
                    </div>
                    <div class="col-sm-8">
                        <div class="form-group">
                            <label for="exampleInputEmail1">Name</label>
                            <input class="form-control" id="exampleInputEmail1" placeholder="Enter email" type="email">
                        </div>
                        <div class="form-group">
                            <label for="exampleInputEmail1">Email address</label>
                            <input class="form-control" id="exampleInputEmail1" placeholder="Enter email" type="email">
                        </div>
                        <div class="form-group">
                            <label for="exampleInputEmail1">Message</label>
                            <textarea class="form-control" id="comment" rows ="5"></textarea>
                        </div>
                        <button type="button" class="btn btn-success">Submit</button>
                    </div>
                    <div class="col-sm-2">
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection