@extends('public.layouts.master')

@section('content')



    <div id="aboutJumbo">
        <div class="container-fluid">
            <h1>About Us</h1>
        </div>
    </div>

    <!-- About Us Section-->
    <div class="jumbotron-special">
        <div id="aboutContent">
            <div class="container-fluid-contact">
                <div class="row">
                    <div class="col-sm-12">
                        <div class="well well-lg">
                            <p>
                                Quansis Systems of Sacramento, California, is building the next wave of talent management technology by creating a new
                                paradigm that will make the hiring process “real-time,” affordable and more effective by connecting the right
                                candidate with the right position -- the first time.
                            </p>
                            <p>
                                We all understand that engaging the best people for critical roles is paramount to business success, but so is timing
                                and cost. This new paradigm is fast, easy to use and efficient and, here is the kicker, we do not use subjective
                                resumes, job descriptions, or a laborious application process. The right candidates will no longer be sidelined by
                                Applicant Tracking Systems (ATS) or forgotten in the “Black Hole,” an unfortunate side effect of that technology.
                            </p>
                            <p>
                                Quansis Systems is on track to bring businesses the first version of this revolutionary new approach of hiring
                                and managing talent by next spring. But you can be a part of this wave of positive change now, whether
                                you’re a HR professional, recruiter, investor, business leader or job seeker, by joining our revolution at
                                www.QuansisSystems.com. We’re looking forward to changing how talent and business needs come together to close
                                skill gaps, shortfalls created by the ATS industry and imperfect hiring processes that plague many businesses today.
                            </p>
                            <p>Rick Rasmussen</p>
                            <p>CEO of Quansis Systems</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div id="aboutContent">
        <div class="container-fluid-contact">
            <div class="row">
                <div class="col-sm-4">


                    <div class="panel panel-default">
                        <div class="panel-heading">Vision</div>
                        <div class="panel-body">
                            <p>Quansis Systems will be the leader of real-time talent acquisition and management.</p>
                        </div>
                    </div>


                </div>
                <div class="col-sm-8">
                    <div class="panel panel-default">
                        <div class="panel-heading">Mission</div>
                        <div class="panel-body">
                            <p>
                                Quansis Systems defines and creates  real-time talent management by
                                connecting organizations with right candidates through a people-focused
                                data framework that delivers superior, unbiased hiring processes and
                                engagement. The motivation to lead the world's dynamic employee
                                lifecycle drives continuous innovation from our people, who champion
                                excellence for self, team and company.
                            </p>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div></div>

    <br>

    <div id="aboutJumbo">
        <div class="container-fluid">
            <h1>The Team</h1>
        </div>
    </div>

    <div class="jumbotron-special">
        <div id="aboutContent">
            <div class="container-fluid-contact">
                <div class="row">
                    <div class="col-sm-3">
                        <div class="panel panel-default"<a href="#rickRasmussen" data-toggle ="modal" data-target ="#rickRasmussen"></a>
                        <div class="panel-heading" id="panelHeading">
                            <div class="row">
                                <div class="col-sm-3"></div>
                                <div class="col-sm-6">
                                    <img src = "{{ URL::asset('img/rickrasmussen.jpg') }}" class="imgB" alt = "Rick R Pic">
                                </div>

                                <div class="col-sm-3"></div>
                            </div>
                        </div>
                        <div class="panel-body">
                            <h6><strong>CEO</strong></h6>
                            <h6><strong>Rick Rasmussen</strong></h6>
                        </div>
                    </div>
                </div>

                <div class="col-sm-3">
                    <div class="panel panel-default" href="#rickMiller" data-toggle ="modal" data-target ="#rickMiller">
                    <div class="panel-heading" id="panelHeading">
                        <div class="row">
                            <div class="col-sm-3"></div>
                            <div class="col-sm-6">
                                <img src = "{{ URL::asset('img/rickmiller.jpg') }}" class="imgB" alt = "Rick R Pic">
                            </div>

                            <div class="col-sm-3"></div>
                        </div>
                    </div>
                    <div class="panel-body">
                        <h6><strong>Process Engineer</strong></h6>
                        <h6><strong>Rick Miller</strong></h6>
                    </div>
                </div>
            </div>

            <div class="col-sm-3">
                <div class="panel panel-default" href="#nate" data-toggle ="modal" data-target ="#nate">
                <div class="panel-heading" id="panelHeading">
                    <div class="row">
                        <div class="col-sm-3"></div>
                        <div class="col-sm-6">
                            <img src = "{{ URL::asset('img/nate.jpg') }}" class="imgB" alt = "Rick R Pic">
                        </div>

                        <div class="col-sm-3"></div>
                    </div>
                </div>
                <div class="panel-body">
                    <h6><strong>CMO</strong></h6>
                    <h6><strong>Nate Bemiller</strong></h6>
                </div>
            </div>
        </div>

        <div class="col-sm-3">
            <div class="panel panel-default" href="#jeff" data-toggle ="modal" data-target ="#jeff">
            <div class="panel-heading" id="panelHeading">
                <div class="row">
                    <div class="col-sm-3"></div>
                    <div class="col-sm-6">
                        <img src = "{{ URL::asset('img/jeffmiller.jpg') }}" class="imgB" alt = "Rick R Pic">
                    </div>

                    <div class="col-sm-3"></div>
                </div>
            </div>
            <div class="panel-body">
                <h6><strong>Communications</strong></h6>
                <h6><strong>Jeff Miller</strong></h6>
            </div>
        </div>
    </div>
    </div>


    <div class="row">
        <div class="col-sm-3">
            <div class="panel panel-default" href="#lauren" data-toggle ="modal" data-target ="#lauren">
            <div class="panel-heading" id="panelHeading">
                <div class="row">
                    <div class="col-sm-3"></div>
                    <div class="col-sm-6">
                        <img src = "{{ URL::asset('img/lauren.jpg') }}" class="imgB" alt = "Rick R Pic">
                    </div>

                    <div class="col-sm-3"></div>
                </div>
            </div>
            <div class="panel-body">
                <h6><strong>CDO</strong></h6>
                <h6><strong>Lauren Wichman</strong></h6>
            </div>
        </div>
    </div>

    <div class="col-sm-3">
        <div class="panel panel-default" href="#dan" data-toggle ="modal" data-target ="#dan">
        <div class="panel-heading" id="panelHeading">
            <div class="row">
                <div class="col-sm-3"></div>
                <div class="col-sm-6">
                    <img src = "{{ URL::asset('img/dan.jpg') }}" class="imgB" alt = "Rick R Pic">
                </div>

                <div class="col-sm-3"></div>
            </div>
        </div>
        <div class="panel-body">
            <h6><strong>Web Developer</strong></h6>
            <h6><strong>Dan Abresch</strong></h6>
        </div>
    </div>
    </div>

    <div class="col-sm-3">
        <div class="panel panel-default" href="#peter" data-toggle ="modal" data-target ="#peter">
        <div class="panel-heading" id="panelHeading">
            <div class="row">
                <div class="col-sm-3"></div>
                <div class="col-sm-6">
                    <img src = "{{ URL::asset('img/peter.jpg') }}" class="imgB" alt = "Rick R Pic">
                </div>

                <div class="col-sm-3"></div>
            </div>
        </div>
        <div class="panel-body">
            <h6><strong>Database Guru</strong></h6>
            <h6><strong>Peter Hanely</strong></h6>
        </div>
    </div>
    </div>

    <div class="col-sm-3">
        <div class="panel panel-default" href="#max" data-toggle ="modal" data-target ="#max">
        <div class="panel-heading" id="panelHeading">
            <div class="row">
                <div class="col-sm-3"></div>
                <div class="col-sm-6">
                    <img src = "{{ URL::asset('img/max.jpg') }}" class="imgB" alt = "Rick R Pic">
                </div>

                <div class="col-sm-3"></div>
            </div>
        </div>
        <div class="panel-body">
            <h6><strong>Web Developer</strong></h6>
            <h6><strong>Max Nasyrov</strong></h6>
        </div>
    </div>
    </div>
    </div>
    </div></div></div>


    <div id="aboutJumbo">
        <div class="container-fluid">
            <h1>Account Executives</h1>
        </div>
    </div>


    <div class="jumbotron-special">
        <div id="aboutContent">
            <div class="container-fluid-contact">
                <div class="row">
                    <div class="col-sm-3">
                        <h6><strong>Joel Shatz</strong></h6>
                    </div>
                    <div class="col-sm-3">
                        <h6><strong>Pedro Silva</strong></h6>
                    </div>
                    <div class="col-sm-3">
                        <h6><strong>Mike Rogers</strong></h6>
                    </div>
                    <div class="col-sm-3">
                        <h6><strong></strong></h6>
                    </div>
                </div>
                <br>
            </div>
        </div>
    </div>


    <div id="aboutJumbo">
        <div class="container-fluid">
            <h1>Board Members</h1>
        </div>
    </div>



    <div class="jumbotron-special">
        <div id="aboutContent">
            <div class="container-fluid-contact">
                <div class="row">
                    <div class="col-sm-3">
                        <h6><strong>Tim Keefe</strong></h6>
                    </div>
                    <div class="col-sm-3">
                        <h6><strong>Jane Li</strong></h6>
                    </div>
                    <div class="col-sm-3">
                        <h6><strong>Paul Walters</strong></h6>
                    </div>
                    <div class="col-sm-3">
                        <h6><strong>Joe Witte</strong></h6>
                    </div>
                </div>
                <br>
            </div>
        </div>
    </div>



    <!-- Modal Alert Rick Rasmussen -->
    <div class="modal fade" id="rickRasmussen">
        <div class="modal-dialog">
            <div class="modal-content">

                <div class="modal-header">
                    <div class="row">
                        <div class="col-sm-4">
                        </div>
                        <div class="col-sm-4">
                            <img src = "{{ URL::asset('img/rickrasmussen.jpg') }}" class="imgB" alt = "Rick R Pic">
                        </div>
                        <div class="col-sm-4">
                        </div>
                    </div>
                    <h4 class="modal-title">Rick Rasmussen</h4>
                    <h3>The Explorer</h3>
                </div>

                <div class="modal-body">
                    <p>
                        With a drive to solve complex business problems, Rick’s unbeatable, disruptive vision is borne from a voracious curiosity
                        to learn new ways of exploring “what if?” As a leader, who’s long term vision for Quansis Systems includes solving identity
                        theft next, his only use for the status quo is to fill out the rearview mirror. Rick enjoys talking with people from all
                        industries to gain insight on helping them cure painful processes that prevent growth, which led to developing our
                        proprietary Total Talent Management solution.
                    </p>
                    <p>
                        When he isn’t laying the groundwork for our next step and mentoring the
                        team, you’ll find him exploring wilderness parks with backpack in hand,
                        cycling with buddies and giving the ski lift a run for its money.
                    </p>
                </div>
                <div class="modal-footer">
                    <a href="#" data-dismiss="modal" class="aboutbtn">Close</a>
                    <a href="https://www.linkedin.com/in/rick-rasmussen/"><img id = "navPic" src ="{{ URL::asset('img/linkedin.png') }}"></a>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal Alert Rick Miller -->
    <div class="modal fade" id="rickMiller">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">

                    <div class="row">
                        <div class="col-sm-4">
                        </div>
                        <div class="col-sm-4">
                            <img src = "{{ URL::asset('img/rickmiller.jpg') }}" class="imgB" alt = "Rick R Pic">
                        </div>
                        <div class="col-sm-4">
                        </div>
                    </div>

                    <h4 class="modal-title">Rick Miller</h4>
                    <h3>The Govenator</h3>
                </div>
                <div class="modal-body">
                    <p>
                        Change is second nature for Rick, who takes disruption in stride,
                        quickly grasps an issue and the potential fallout as to efficiently
                        master new ways of operating a business.  As govenator at Quansis
                        Systems, he continually monitors operational procedures, creates and
                        tweaks guidance, builds new toolkits and enforces best practices,
                        ensuring our corporate goals remain on track.
                    </p>
                    <p>
                        But process and procedural leadership are only the working side of his
                        multi-talented persona. Rick is an avid gardener, a proud owner of a
                        Harley and, although he won’t admit it, is a chef de cuisine and master
                        host that rivals anything from The French Laundry. Just don’t tell them
                        he is here or they could try stealing him away!
                    </p>
                </div>
                <div class="modal-footer">
                    <a href="#" data-dismiss="modal" class="aboutbtn">Close</a>
                    <a href="https://www.linkedin.com/in/rick-miller-94434aa/"><img id = "navPic" src ="{{ URL::asset('img/linkedin.png') }}"></a>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal Alert Nate -->
    <div class="modal fade" id="nate">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">

                    <div class="row">
                        <div class="col-sm-4">
                        </div>
                        <div class="col-sm-4">
                            <img src = "{{ URL::asset('img/nate.jpg') }}" class="imgB" alt = "Rick R Pic">
                        </div>
                        <div class="col-sm-4">
                        </div>
                    </div>

                    <h4 class="modal-title">Nate BeMiller</h4>
                    <h3>The Brain</h3>
                </div>
                <div class="modal-body">
                    <p>
                        If we think about what triggers consumer action, Nate is the expert who
                        readily taps both sides of his brain: creative thinking and data
                        analysis.  His marketing playbook for Quansis Systems takes shape from
                        cultural sociology; identifying “want” and formulating desired responses
                        that satisfy pressing needs. His curiosity for “how things work” and
                        evolve will serve the brand well as our clients face greater disruption.
                    </p>
                    <p>
                        Nate was a competitive springboard diver for several years, but now
                        keeps surefooted as an exceptional table-tennis player. He is happily
                        addicted to watching tennis, is a die-hard nature show enthusiast and,
                        when it pours, he stays indoors to watch vintage films.
                    </p>
                </div>
                <div class="modal-footer">
                    <a href="#" data-dismiss="modal" class="aboutbtn">Close</a>
                    <a href="https://www.linkedin.com/in/nate-bemiller-6849311/"><img id = "navPic" src ="{{ URL::asset('img/linkedin.png') }}"></a>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal Alert Jeff Miller -->
    <div class="modal fade" id="jeff">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <div class="row">
                        <div class="col-sm-4">
                        </div>
                        <div class="col-sm-4">
                            <img src = "{{ URL::asset('img/jeffmiller.jpg') }}" class="imgB" alt = "Rick R Pic">
                        </div>
                        <div class="col-sm-4">
                        </div>
                    </div>

                    <h4 class="modal-title">Jeff Miller</h4>
                    <h3>The Storyteller</h3>
                </div>
                <div class="modal-body">
                    <p>
                        Everyone has a story and Jeff brings it to life, whether it describes
                        and solves a business pain point or empowering employees to succeed with
                        information and job tools. His nemesis is the business notion, “We’ve
                        always done it this way!” but his cure is to find ways to flip it around
                        and close out with, “WOW! What an innovative approach to end this
                        age-old problem.” To accomplish the turnaround, he captures the data to
                        see the bigger picture, which usually isn’t always pretty or easy to hear.
                    </p>
                    <p>
                        After hours, Jeff loves the outdoors, rain or shine, and is as
                        comfortable battling weeds in his perennial gardens and working up to
                        blue squares on the slopes, to finding solitude in the most unlikely of
                        places in Paris or Berlin, whether day or night.
                    </p>
                </div>
                <div class="modal-footer">
                    <a href="#" data-dismiss="modal" class="aboutbtn">Close</a>
                    <a href="https://www.linkedin.com/in/jeffmillermba/"><img id = "navPic" src ="{{ URL::asset('img/linkedin.png') }}"></a>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal Alert Lauren Wichman -->
    <div class="modal fade" id="lauren">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <div class="row">
                        <div class="col-sm-4">
                        </div>
                        <div class="col-sm-4">
                            <img src = "{{ URL::asset('img/lauren.jpg') }}" class="imgB" alt = "Rick R Pic">
                        </div>
                        <div class="col-sm-4">
                        </div>
                    </div>

                    <h4 class="modal-title">Lauren Wichman</h4>
                    <h3>The Visionary</h3>
                </div>
                <div class="modal-body">
                    <p>
                        Lauren is a curator of talented teams and leads them to consensus on
                        solving highly complex business problems. Her strategic approach to
                        changing the status quo and moving organizations forward has served her
                        well in decision making, governance, ethics and the speed for which to
                        deliver in highly competitive markets.

                    </p>
                    <p>
                        A visionary, she draws ideas, concepts, personal strength and solace
                        from living and learning “what makes things be” – in space, IoT and AI,
                        photography, agriculture and energy; and, through conversations with
                        seemingly unlikely sources: The curious minds of children. Outside of
                        work, Lauren enjoys traveling and experiencing luxurious hotels,
                        particularly those on the water’s edge.
                    </p>
                </div>
                <div class="modal-footer">
                    <a href="#" data-dismiss="modal" class="aboutbtn">Close</a>
                    <a href="https://www.linkedin.com/in/laurenwichman/"><img id = "navPic" src ="{{ URL::asset('img/linkedin.png') }}"></a>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal Alert Dan Abresch -->
    <div class="modal fade" id="dan">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <div class="row">
                        <div class="col-sm-4">
                        </div>
                        <div class="col-sm-4">
                            <img src = "{{ URL::asset('img/dan.jpg') }}" class="imgB" alt = "Rick R Pic">
                        </div>
                        <div class="col-sm-4">
                        </div>
                    </div>

                    <h4 class="modal-title">Dan Abresch</h4>
                    <h3>The Quarterback</h3>
                </div>
                <div class="modal-body">
                    <p>
                        Dan is meticulous when it comes to tackling and solving complex business
                        problems. At Quansis, he leads website development and considers his
                        “best friends” to be HTML, CSS, bootstrap and JQuery. After hours, he is
                        pursuing a master’s degree in software engineering and enjoys watching
                        sports. While not quite ready to share his golf handicap publicly, on
                        the football field he throws a mean spiral (watch out, Aaron Rodgers!).
                    </p>
                    <p>
                        Dan, his wife and children have traveled all over the world – and they have a difficult time picking a single favorite spot,
                        so they chose three: Italy, New Zealand and Kauai, for the unique
                        beauty and culture of each destination has provided great outdoor
                        adventures and family memories to treasure forever.
                    </p>
                </div>
                <div class="modal-footer">
                    <a href="#" data-dismiss="modal" class="aboutbtn">Close</a>
                    <a href="https://www.linkedin.com/in/dan-a-747b30a/"><img id = "navPic" src ="{{ URL::asset('img/linkedin.png') }}"></a>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal Alert Peter Hanely -->
    <div class="modal fade" id="peter">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <div class="row">
                        <div class="col-sm-4">
                        </div>
                        <div class="col-sm-4">
                            <img src = "{{ URL::asset('img/peter.jpg') }}" class="imgB" alt = "Rick R Pic">
                        </div>
                        <div class="col-sm-4">
                        </div>
                    </div>

                    <h4 class="modal-title">Peter Hanely</h4>
                    <h3>Mr. Possible</h3>
                </div>
                <div class="modal-body">
                    <p>
                        Peter's foresight guides his belief that anything is possible as a
                        software engineer, database designer and systems administrator. Even if
                        he doesn't know immediately how to bring concepts to life, he’ll figure
                        out quickly enough.   In his spare time, he is cultivating knowledge in
                        3D modelling and dabbles in gaming technology. When the weather turns
                        hot, which happens during summer months in Sacramento, he takes shelter
                        in the comfort of the airconditioned apartment. The most memorable
                        vacation spot has been the Grand Canyon, with its stunning vistas and
                        rock formations dating back 1 billion years.  Tech can't compete.
                    </p>
                </div>
                <div class="modal-footer">
                    <a href="#" data-dismiss="modal" class="aboutbtn">Close</a>
                    <a href="https://www.linkedin.com/in/peter-hanely-46755283/"><img id = "navPic" src ="{{ URL::asset('img/linkedin.png') }}"></a>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal Alert Max Nasyrov -->
    <div class="modal fade" id="max">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <div class="row">
                        <div class="col-sm-4">
                        </div>
                        <div class="col-sm-4">
                            <img src = "{{ URL::asset('img/max.jpg') }}" class="imgB" alt = "Rick R Pic">
                        </div>
                        <div class="col-sm-4">
                        </div>
                    </div>

                    <h4 class="modal-title">Max Nasyrov</h4>
                    <h3>Always Learning</h3>
                </div>
                <div class="modal-body">
                    <p>
                        Max is a whiz with web development, PHP and AWS, and his favorite
                        language is JavaScript. He enjoys digging deeper into tech issues to
                        identify a new solution or size it up as a candidate for automation,
                        since that is the wave of the future.  Max dedicates a lot of time
                        advancing programming skills with coursework and, in his free time,
                        keeping up with current political and economic news.
                    </p>
                    <p>
                        After hours, Max enjoys Frisbee and volleyball with friends and he is
                        training in Krav Maga. His favorite place to visit is Kyrgyzstan, but he
                        counts California’s Yosemite as a close second-place for the park’s
                        hiking options and wintertime festivals.
                    </p>
                </div>
                <div class="modal-footer">
                    <a href="#" data-dismiss="modal" class="aboutbtn">Close</a>
                    <a href="https://www.linkedin.com/in/islam-nasyrov-27a500a6/"><img id = "navPic" src ="{{ URL::asset('img/linkedin.png') }}"></a>
                </div>
            </div>
        </div>
    </div>

@endsection