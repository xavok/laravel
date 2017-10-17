@extends('public.layouts.master')

@section('content')

    <header>

        <div id="carousel-example-generic" class="carousel slide" data-ride="carousel" data-interval="8000">
            <!-- Indicators -->
            <ol class="carousel-indicators">
                <li data-target="#carousel-example-generic" data-slide-to="0" class="active"></li>
                <li data-target="#carousel-example-generic" data-slide-to="1"></li>
                <li data-target="#carousel-example-generic" data-slide-to="2"></li>
                <li data-target="#carousel-example-generic" data-slide-to="3"></li>
                <li data-target="#carousel-example-generic" data-slide-to="4"></li>
                <li data-target="#carousel-example-generic" data-slide-to="5"></li>
                <li data-target="#carousel-example-generic" data-slide-to="6"></li>
                <li data-target="#carousel-example-generic" data-slide-to="7"></li>
                <li data-target="#carousel-example-generic" data-slide-to="8"></li>
                <li data-target="#carousel-example-generic" data-slide-to="9"></li>
            </ol>

            <!-- Wrapper for slides -->
            <div class="carousel-inner">
                <div class="item active">
                    <div class="slide">
                        <h2 class="text">Impossible they say...</h2>
                    </div>
                </div>
                <div class="item">
                    <div class="slide">
                        <h2 class="text">Real time hiring - <span id="red">impossible!</span></h2>
                    </div>
                </div>
                <div class="item">
                    <div class="slide">
                        <h2 class="text">No need to post job openings - <span id="red"> impossible!</span></h2>
                    </div>
                </div>
                <div class="item">
                    <div class="slide">
                        <h2 class="text">No need for expensive recruiting agencies - <span id="red">impossible!</span></h2>
                    </div>
                </div>
                <div class="item">
                    <div class="slide">
                        <h2 class="text">No need for interviews - <span id="red">impossible</span></h2>
                    </div>
                </div>
                <div class="item">
                    <div class="slide">
                        <h2 class="text">Finding the right person for the right job the first time - <span id="red">impossible!</span></h2>
                    </div>
                </div>
                <div class="item">
                    <div class="slide">
                        <h2 class="text">A lifetime talent management framework that’s easy to use - <span id="red">impossible</span></h2>
                    </div>
                </div>
                <div class="item">
                    <div class="slide">
                        <h2 class="text">Talent management via SaaS, on demand, without subscriptions - <span id="red">impossible</span></h2>
                    </div>
                </div>
                <div class="item">
                    <div class="slide">
                        <h2 class="text">Quansis Systems is making it possible by ditching legacy hiring practices.</h2>
                    </div>
                </div>
                <div class="item">
                    <div class="slide">
                        <h2 class="text"><span id="red">Quansis Systems </span>next-gen talent solution makes hiring fast, easy and effective
                            for both candidate and hiring company.</h2>
                    </div>
                </div>
            </div>

            <!-- Controls -->
            <a class="left carousel-control" href="#carousel-example-generic" role="button" data-slide="prev">
                <span class="glyphicon glyphicon-chevron-left"></span>
            </a>
            <a class="right carousel-control" href="#carousel-example-generic" role="button" data-slide="next">
                <span class="glyphicon glyphicon-chevron-right"></span>
            </a>
        </div> <!-- Carousel -->

    </header>

    <!-- Revolution Header -->
    <div class="jumbotron">
        <div id="revolution">
            <div class="container-fluid">
                <div class="row">
                    <h2 class ="revolutionH">A Hiring Revolution is Here</h2>
                    <img src="{{ URL::asset('img/Revolution.png') }}" class="imgC" alt="job seeker pic">
                    <br><br>
                    <div class="col-lg-4">
                        <div class="well well-lg">

                            <h2>The Revolution</h2>
                            <hr>
                            <p>Quansis Systems developed a new paradigm for total talent management, i.e. hiring...</p>
                            <br>
                            <div class="col-sm-3"></div>
                            <div class="col-sm-8">
                                <a href="#readMoreRevolution" data-toggle ="modal" data-target ="#readMoreRevolution" class="btn btn-danger">Read More</a>
                            </div>
                            <div class="col-sm-3"></div>
                            <br>

                        </div>
                    </div>
                    <div class="col-lg-4">
                        <div class="well well-lg">
                            <h2>Data Driven</h2>
                            <hr>
                            <p>We are a data analytics company that uses our proprietary engine and predictive architecture...</p>
                            <br>
                            <div class="col-sm-3"></div>
                            <div class="col-sm-8">
                                <a href="#readMoreData" data-toggle ="modal" data-target ="#readMoreData" class="btn btn-danger">Read More</a>
                            </div>
                            <div class="col-sm-3"></div>
                            <br>
                        </div>
                    </div>
                    <div class="col-lg-4">
                        <div class="well well-lg">
                            <h2>Industry First</h2>
                            <hr>
                            <p>Quansis Systems positions itself as an intermediary between companies and candidates...</p>
                            <br>
                            <div class="col-sm-3"></div>
                            <div class="col-sm-8">
                                <a href="#readMoreFirst" data-toggle ="modal" data-target ="#readMoreFirst" class="btn btn-danger">Read More</a>
                            </div>
                            <div class="col-sm-3"></div>
                            <br>

                        </div>
                    </div>
                </div>
                <div class="row">
                    <h3><a href="#Top" class="glyphicon glyphicon-arrow-up"></a></h3>
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
                    <h4 class="modal-title">THE HIRING REVOLUTION</h4>
                </div>
                <div class="modal-body">
                    <p>
                        Quansis Systems developed a new paradigm for total talent management, i.e. hiring, on-boarding, retention, performance
                        management, and internal mobility. It is the industry’s first truly data-driven, fully integrated and complete solution
                        that forever ends hiring the wrong candidate, accepting the wrong position and a broken hiring process that is archaic,
                        arduous and insufficient for our great need for speed and efficiency.
                    </p>
                </div>
                <div class="modal-footer">
                    <a href="#" data-dismiss="modal" class="aboutbtn">Close</a>
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
                    <p>
                        We are a data analytics company that uses our proprietary engine and predictive architecture to measure, define and
                        select the best candidates for any position.
                    </p>
                    <p>
                        Quansis Systems created a comprehensive HR ecosystem that addresses the lifecycle of each employee:  Lifetime
                        Talent Management&#0153.
                    </p>
                    <p>
                        We also offer Lifetime Career Guidance&#0153 for job seekers who actively use and stay enrolled on our system via our
                        proprietary Q Portal&#0153, which is the individually tailored one-stop site for job seekers’ needs.
                    </p>
                </div>
                <div class="modal-footer">
                    <a href="#" data-dismiss="modal" class="aboutbtn">Close</a>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal Alert Read More Industry First -->
    <div class="modal fade" id="readMoreFirst">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                    <h4 class="modal-title">INDUSTRY’S FIRST TRUE DOUBLE BLIND EVALUATION</h4>
                </div>
                <div class="modal-body">
                    <p>
                        Quansis Systems positions itself as an intermediary between companies and candidates, conducting double-blind
                        evaluations. Through this framework, we eliminate both intentional and unintentional bias. Our anonymized double-blind
                        analysis is neutral to race, age, gender, ethnicity, religion and country of origin. Equal Opportunity compliance is
                        simplified through prevention.
                    </p>
                    <p>
                        Moreover, we facilitate the ability to evaluate outside candidates on par with current employees, comparing
                        apples-to-apples. The bias towards inside promotion is also a very common blind spot, particularly since promotion
                        is almost universally regarded as a rewards system.
                    </p>
                </div>
                <div class="modal-footer">
                    <a href="#" data-dismiss="modal" class="aboutbtn">Close</a>
                </div>
            </div>
        </div>
    </div>

    <!-- Job Seekers Header-->
    <div class="jumbotron-special">
        <div id="seekers">
            <div class="container-fluid">
                <div class="row">
                    <h2 class ="seekersH">Job Seekers</h2>
                    <br>
                    <img src="{{ URL::asset('img/jobSeeker.png') }}" class="imgC" alt="job seeker pic">
                </div>
                <div class="row">
                    <div class="col-sm-4">
                        <div class="well well-lg">
                            <h2>Simple</h2>
                            <hr>
                            <p>You are ready for a new opportunity. With Quansis Systems, you no longer need a resume...</p>
                            <br>
                            <div class="col-sm-3"></div>
                            <div class="col-sm-8">
                                <a href="#readMoreEasy" data-toggle ="modal" data-target ="#readMoreEasy" class="btn btn-danger">Read More</a>
                            </div>
                            <div class="col-sm-3"></div>
                            <br>

                        </div>
                    </div>
                    <div class="col-sm-4">
                        <div class="well well-lg">
                            <h2>Blackhole Killer</h2>
                            <hr>
                            <p>No more Black Hole. Candidates currently connect with companies by keyword-driven resumes that are...</p>
                            <br>
                            <div class="col-sm-3"></div>
                            <div class="col-sm-8">
                                <a href="#readMoreBlackholes" data-toggle ="modal" data-target ="#readMoreBlackholes" class="btn btn-danger">Read More</a>
                            </div>
                            <div class="col-sm-3"></div>
                            <br>

                        </div>
                    </div>
                    <div class="col-sm-4">
                        <div class="well well-lg">
                            <h2>Get Hired</h2>
                            <hr>
                            <p>Quansis Systems eliminates subjectivity and bias that is driving hiring decisions by removing non...</p>
                            <br>
                            <div class="col-sm-3"></div>
                            <div class="col-sm-8">
                                <a href="#readMoreHired" data-toggle ="modal" data-target ="#readMoreHired" class="btn btn-danger">Read More</a>
                            </div>
                            <div class="col-sm-3"></div>
                            <br>

                        </div>
                    </div>
                </div>
                <div class="row">
                    <h3><a href="#Top" class="glyphicon glyphicon-arrow-up"></a></h3>
                </div>
                <br><br><br>
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
                    <p>
                        You are ready for a new opportunity. With Quansis Systems, you no longer need a resume or cover letter nor need to
                        fret over time-consuming job applications and hiring bias. Simply plan to spend up to two hours “one time”in order
                        to create an occupational profile.
                    </p>
                    <p>
                        You’ll be empowered with our proprietary Q-Portal&#0153, which contains the tools and information necessary for job
                        searching, and both industry data and competitive career intelligence through Lifetime Career Guidance&#0153. We provide
                        comprehensive and useful data on each company and position before you chose to apply. In addition,you are matched
                        anonymously and can view data on others applying for the same position to learn how you rank and what you can do to
                        improve.
                    </p>
                    <p>
                        For both applicants and incumbents, it makes available up-to-date assessment of his or her relative position and
                        prospects. Additionally, the Q-Portal&#0153 provides a forum for targeted social media, facilitating networking
                        opportunities and industry-related activities.
                    </p>
                </div>
                <div class="modal-footer">
                    <a href="#" data-dismiss="modal" class="aboutbtn">Close</a>
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
                    <h4 class="modal-title">The Black Hole Killer</h4>
                </div>
                <div class="modal-body">
                    <p>No more Black Hole. Candidates currently connect with companies by keyword-driven resumes that are subjective, impersonal and fail to capture the “whole person.” The process offers no feedback, wastes valuable time and leaves candidates with a poor impression of the employer.</p>
                    <p>Quansis replaces the Black Hole by nixing resumes, engages two-way communication and provides real-time feedback. For the first time ever, the job seeker will now know exactly where she stands and what she needs to do.</p>
                </div>
                <div class="modal-footer">
                    <a href="#" data-dismiss="modal" class="aboutbtn">Close</a>
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
                    <p>
                        Quansis Systems eliminates subjectivity and bias that is driving hiring decisions by removing non-relevant information
                        related to a candidate’s age, race, gender, religion or ethnicity.
                    </p>
                </div>
                <div class="modal-footer">
                    <a href="#" data-dismiss="modal" class="aboutbtn">Close</a>
                </div>
            </div>
        </div>
    </div>

    <!-- Hiring Companies Header-->
    <div class="jumbotron">
        <div id="companies">
            <h2 class ="companiesH">Hiring Companies</h2>
            <img src="{{ URL::asset('img/hiringCompany.png') }}" class="imgC" alt="Hiring pic">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-sm-4">
                        <div class="well well-lg">
                            <h2>We Make it Easy</h2>
                            <hr>
                            <p>Quansis guides HR and hiring managers past the resume and cover letter chaos by delivering high...</p>
                            <br>
                            <div class="col-sm-3"></div>
                            <div class="col-sm-8">
                                <a href="#readMoreEasyHiring" data-toggle ="modal" data-target ="#readMoreEasyHiring" class="btn btn-danger">Read More</a>
                            </div>
                            <div class="col-sm-3"></div>
                            <br>


                        </div>
                    </div>
                    <div class="col-sm-4">
                        <div class="well well-lg">
                            <h2>Playing Chess</h2>
                            <hr>
                            <p>Performance and potential are two different things, which we work to reconcile both before and...</p>
                            <br>

                            <div class="col-sm-3"></div>
                            <div class="col-sm-8">
                                <a href="#readMoreChess" data-toggle ="modal" data-target ="#readMoreChess" class="btn btn-danger">Read More</a>
                            </div>
                            <div class="col-sm-3"></div>
                            <br>

                        </div>
                    </div>
                    <div class="col-sm-4">
                        <div class="well well-lg">
                            <h2>Validation</h2>
                            <hr>
                            <p>Quansis Systems provides continuous validation once each candidate is hired and onboarded... </p>
                            <br>

                            <div class="col-sm-3"></div>
                            <div class="col-sm-8">
                                <a href="#readMoreValidation" data-toggle ="modal" data-target ="#readMoreValidation" class="btn btn-danger">Read More</a>
                            </div>
                            <div class="col-sm-3"></div>
                            <br>

                        </div>
                    </div>
                </div>
                <div class="row">
                    <h3><a href="#Top" class="glyphicon glyphicon-arrow-up"></a></h3>
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
                    <p>Quansis guides HR and hiring managers past the resume and cover letter chaos by delivering high-qualified, perfect
                        fit candidates real-time.  We align your goals with those of prospective job seekers so that you can assess skills
                        and culture fit without any bias, removing risk of a discrimination charges. </p>
                    <p>
                        Our solution eliminates mismatching candidates with openings, ends delays in the hiring process  and reduces costs to fill positions. Additionally, through Lifecycle Talent ManagementTM, we improve employee engagement and satisfaction organically and reduce turnover
                    </p>
                    <p>
                        Hiring companies no longer risk compliance issues because candidates are hired before consideration of age, race, sex religion or ethnicity.
                    </p>
                </div>
                <div class="modal-footer">
                    <a href="#" data-dismiss="modal" class="aboutbtn">Close</a>
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
                    <p>Performance and potential are two different things, which we work to reconcile both before and after the hiring decision is made.  Quansis Systems incorporates more than history and looks forward by generating, collecting, and interpreting data to predict performance and to find hidden talents.</p>
                    <p>We liken this to playing chess.  Each piece has its value and capability.  A knight and a bishop are technically equal in rank, but each has distinct abilities and each has a different mission. Which candidate should be brought on as a knight, and which as a bishop? Who is a rook and who’s a pawn?</p>
                </div>
                <div class="modal-footer">
                    <a href="#" data-dismiss="modal" class="aboutbtn">Close</a>
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
                    <p>Quansis Systems provides continuous validation once each candidate is hired and onboarded.  Our system relies not only on continuous evaluation by managers, but also on continuous testing and correlation of on the job values against pre-employment candidate values.  Each individual, over time, is judged on whether he or she matches or exceeds original variables.  We can tell if an employee was under matched or overmatched for his or her position.  Should a pawn already on the board be a rook, or vice versa?  Should a bishop be a more nimble knight or should a knight be a more powerful bishop?</p>
                </div>
                <div class="modal-footer">
                    <a href="#" data-dismiss="modal" class="aboutbtn">Close</a>
                </div>
            </div>
        </div>
    </div>


    <!-- Opportunities Header -->
    <div class="jumbotron-special">
        <div id="opportunities">
            <div class="container-fluid">
                <div class="row">
                    <h2 class ="opportunitiesH">Opportunities</h2>
                    <img src="{{ URL::asset('img/oppic.png') }}" class="imgC" alt="opportunity pic">
                    <br><br>
                    <div class="col-lg-12">
                        <h2>Current Positions Available</h2>
                        <hr>
                        <p>We're looking for a few great team members. If you are driven, motivated, fit our unique corporate culture, and you believe in our mission 100%, then we want to buy you a coffee and get to know you. Joining our team is a once-in-a lifetime opportunity, and we treat our selection process as such. We're not just an ordinary startup that's going to end up in the dust bin of history - we are going to change history, and you can play a key role in the transformation of an entire industry.</p>
                        <h2><a href="#searchOpp" data-toggle ="modal" data-target ="#searchOpp" class="btn btn-danger">Search</a></h2>
                        <br><br>

                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="jumbotron">
        <div class="container-fluid">
            <div class="row">
                <h2>Our Culture In Three Simple Rules</h2>
                <br>
                <div class="col-lg-4">
                    <h4>Rule 1</h4>
                    <hr>
                    <h6>Do what's best for yourself.</h6>
                </div>
                <div class="col-lg-4">
                    <h4>Rule 2</h4>
                    <hr>
                    <h6>Do what's best for your team.</h6>
                </div>
                <div class="col-lg-4">
                    <h4>Rule 3</h4>
                    <hr>
                    <h6>Do what's best for the company.</h6>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <h3><a href="#Top" class="glyphicon glyphicon-arrow-up"></a></h3>
    </div>

    <!-- Modal Alert Opportunities Search Button -->
    <div class="modal fade" id="searchOpp">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                    <h4 class="modal-title">Current Opportunities</h4>
                </div>
                <div class="modal-body">
                    <button type="button" class="btn btn-info" data-toggle="collapse" data-target="#graphic">Graphic Designer (Sacramento)</button>
                    <div id="graphic" class="collapse">
                        <br>
                        <ul>
                            <li>You love creating visual ways of communicating. In fact, you'd rather create a visual then write a paragraph any day.</li>
                            <li>If you have experience in media content creation and management, that a huge plus in our book.</li>
                            <li>You have a unique ability to translate words into visuals that get the point across.</li>
                            <li>We don't care if you are young or more experienced (older), just as long as you love what you do and you love our mission.</li>
                            <li>If interested contact us at: <strong>opportunities@quansisystems.com</strong></li>
                        </ul>
                    </div>
                    <br><br>
                    <button type="button" class="btn btn-info" data-toggle="collapse" data-target="#data">Data Warehouse Guru (Sacramento)</button>
                    <div id="data" class="collapse">
                        <br>
                        <ul>
                            <li>We're looking for the right person who knows data warehousing inside and out.</li>
                            <li>You are the type that love huge challenges.</li>
                            <li>You are the type that loves building something that's never been done before.</li>
                            <li>You are the ultimate team player, you put the team ahead of yourself at all times.</li>
                            <li>You are confident in your abilities but you use that to help the company and your teammates to be successful.</li>
                            <li>We don't care about your age, color, nor creed, just as long as you're a great fit in our unique corporate culture and that you are deeply about our mission.</li>
                            <li>If interested contact us at: <strong>opportunities@quansisystems.com</strong></li>
                        </ul>
                    </div>
                    <br><br>
                    <button type="button" class="btn btn-info" data-toggle="collapse" data-target="#bi">Business Intelligence Architect (Sacramento)</button>
                    <div id="bi" class="collapse">
                        <br>
                        <ul>
                            <li>You eat, sleep, and dream about analytics.</li>
                            <li>You understand BI inside and out.</li>
                            <li>You have a unique ability to translate product requirements into architectural design. </li>
                            <li>You want to create the most awesome BI framework ever.</li>
                            <li>We don't care if you are tall, short, fat, skinny, young, older, black, blue, white, green, or red. All we care about is if you are ultimate team player,  you are a great fit, and that you care deeply about our mission.</li>
                            <li>If interested contact us at: <strong>opportunities@quansisystems.com</strong></li>
                        </ul>
                    </div>
                </div>
                <div class="modal-footer">
                    <a href="#" data-dismiss="modal" class="aboutbtn">Close</a>
                </div>
            </div>
        </div>
    </div>

    <br><br><br>
@endsection