$(window).load(function () {
    $(".chosen-select").chosen()
    $("#login_form").validate();

    $("#signup_form").validate({
        rules: {
            first_name: "required",
            last_name: "required",
            email: {
                //checkExists: true,
                required: true
            },
            password: {
                required: true,
                minlength: 5
            },
            confirm_password: {
                required: true,
                minlength: 5,
                // equalTo  : "#password"
            }
        },
        messages: {
            first_name: "Please enter your First Name",
            last_name: "Please enter your Last Name",
            password: {
                required: "Please provide a password",
                minlength: "Your password must  at least 5 characters long"
            },
            confirm_password: {
                required: "Please provide a password",
                minlength: "Your password must be at least 5 characters long",
                // equalTo  : "Please enter the same password as above"
            }
        }

    });


    $("#cultural").hide();
    $('#Education').hide();
    $("#Skills").hide();
    $("#work_experience").hide();
    $("#buttonPrevious").hide();
    $("#buttonSubmit").hide();
    $(".steps").click(function () {
        $("li").removeClass("selected");
        $(this).addClass("selected");
        var activeDiv = $(this).html();
        //console.log(activeDiv);
        choose(activeDiv);
    });


    $(".buttonNext").click(function () {
        $(".selected").next(".steps").addClass("selected");
        $(".selected").prev(".steps").removeClass("selected");
        var activeDiv = $(".selected").html();
        choose(activeDiv);
    });

    function selectDiv(activeDiv) {
        $(".txt-form").not("#" + activeDiv).hide();
        $("#" + activeDiv).show();
    }

    function choose(activeDiv) {


        if (activeDiv == "Work Experience" || activeDiv == "Education") {
            $(".buttonNext").show();
            $(".buttonPrevious").show();
            $(".buttonSubmit").hide();
        }
        else {
            $(".buttonNext").show();
            $(".buttonPrevious").hide();
        }
        if (activeDiv == "Personal Info") {
            selectDiv("personal_info");
        }
        else if (activeDiv == "Work Experience") {
            selectDiv("work_experience");
        }
        else if (activeDiv == "Cultural &amp; Behavioral") {
            selectDiv("cultural");
        }
        else {
            selectDiv(activeDiv);
        }
    }

    var education = 1;
    var industry = 1;
    var skills = 1;
    var occupation = 1;

    // if ($("#seeker_preference").length > 0) {
    //   $.ajax({
    //     url    : homeUrl + "/get_occupation_id.php",
    //     type   : "POST",
    //     cache  : false,
    //     success: function (results) {
    //       var posts = JSON.parse(results);
    //       //console.log(posts);
    //       var industry = posts.industry_id.fetch[0];
    //       var occupation = posts.occupation_id.fetch[0];
    //       var education = posts.education_id.fetch[0];
    //       var occupation_subtype = posts.occupation_subtype_id.fetch[0];
    //       var industry_id = industry['seeker_industry_experience_id'];
    //       var occupation_id = occupation['seeker_occupation_experience_id'];
    //       var education_id = education['seeker_profile_education_id'];
    //       var occupation_subtype_id = occupation_subtype['occupation_subtype_id'];
    //       var seeker_preference_id = posts.seeker_preferences.fetch[0]['seeker_preference_id'];
    //       education['school'] = education['school'].replace(/\+/g, " ");
    //       $("#seeker_occupation_experience_id").val(occupation_id);
    //       $("#seeker_preference_id").val(seeker_preference_id);
    //       $("#seeker_industry_experience_id").val(industry_id);
    //       $("#seeker_profile_education_id").val(education_id);
    //       $("#occupation_years").val(occupation['years']);
    //       $("#occupation").val(occupation['occupation_subtype_id']);
    //       $("#occupation_subtype_id").val(occupation_subtype_id);
    //       $("#industry_years").val(industry['years']);
    //       $("#industry_id").val(industry['industry_id']);
    //       $("#school").val(education['school']);
    //       $("#graduation").val(education['graduation']);
    //       $("#education_level_id").val(education['education_level_id']);
    //       $("#study_field_id").val(education['study_field_id']);
    //       //$("#collapseTwo").accordion({active:0});
    //       //$(".selected").prev(".steps").removeClass("selected");
    //       //var activeDiv = $(".selected").html();
    //       //choose(activeDiv);
    //     },
    //     error  : function () {
    //       alert('Cannot retrieve data.');
    //     }
    //   });
    // }

    if ($("#occupation_form").length > 0) {

        $("#bar").css("width", "20%");
        $("#bar").html("20%");
        $("#bar").addClass("progress-bar-danger");
    }

    if ($("#cultural_form").length > 0) {

        //
        $("#bar").removeClass("progress-bar-danger");
        $("#bar").addClass("progress-bar-warning");
        $("#bar").css("width", "60%");
        $("#bar").html("60%");
    }

    if ($("#industry_form").length > 0) {

        $("#bar").css("width", "30%");
        $("#bar").html("30%");

    }

    if ($("#education_form").length > 0) {

        $("#bar").css("width", "40%");
        $("#bar").html("40%");

    }


    if ($("#skills_form").length > 0) {


        $("#bar").css("width", "80%");
        $("#bar").html("80%");
        $("#bar").removeClass("progress-bar-warning");
        $("#bar").addClass("progress-bar-success");

    }

    $("#addEducation").click(function () {

        var hello = $("#get_education_inputs").html();

        var re = hello.match(/name="(.*?)"/g);
        $.each(re, function (i, l) {
            var length = l.length - 1;
            var output = [l.slice(0, length), education, l.slice(length)].join('');
            hello = hello.replace(re[i], output);
        });
        //console.log(hello);

        var n = $("#place_to_add_more_education").append(hello);
        education++;

    });
    $("#addOccupation").click(function () {

        var hello = $("#get_occupation_inputs").html();

        var re = hello.match(/name="(.*?)"/g);
        $.each(re, function (i, l) {
            var length = l.length - 1;
            var output = [l.slice(0, length), occupation, l.slice(length)].join('');
            hello = hello.replace(re[i], output);
        });
        console.log(hello);


        var n = $("#place_to_add_more_occupation").append(hello);
        occupation++;

    });
    $("#addIndustry").click(function () {
        $industriesNum = $('.industries').length;
        if ($industriesNum < 3) {
            var industry = $("#get_industry_inputs").html();
            var n = $("#place_to_add_more_industry").append(industry);
            $('[name="id[]"]').last().val(0);
        } else {
            $(".panel-body").prepend("<div class='alert alert-danger'>You can't select more than 3 industries at the moment</div>");
        }
    });
    $("#addSkills").click(function () {
        var hello = $("#get_skills_inputs").html();
        var re = hello.match(/name="(.*?)"/g);
        $.each(re, function (i, l) {
            var length = l.length - 1;
            var output = [l.slice(0, length), skills, l.slice(length)].join('');
            hello = hello.replace(re[i], output);
        });
        var n = $("#add_skills_inputs").append(hello);
        skills++;
        console.log(skills);

    });
    $(function () {

    });
    function choises(id, text, value) {
        for (i = 1; i < 4; ++i) {
            //option = '<option name="' +id + '_' + i + '_id" value="' + value + '">' + text + '</option>';
            //console.log(option);
            $("#" + id + i).append($('<option>', {
                value: value,
                text: text
            }));
        }

    }

    $(document).ready()
    {
        if (window.location.href.indexOf("commandCenter") > -1) {
            var i = 0;
            for (i = 0; i < user_matches; i++) {
                $("#candidate_" + i).on("click", function () {
                    $("#candidate_id").html("Candidate " + $(this).html() + " to Job IT2438");
                });
            }
        }


        $(".culture").change(function () {
            var id = $(this).attr("id");
            id = id.substring(0, id.length - 1);
            console.log($("#workplace1").val());

            var value1 = $("#" + id + '1').val();
            var value2 = $("#" + id + '2').val();
            var value3 = $("#" + id + '3').val();
            if (value1 == value2
                || value2 == value3
                || value1 == value3) {
                //alert("You have to select different choices");
                //return false;
            }
        });
        choises("workplace", "Open all space open, all sharing", 10);
        choises("workplace", "Shared and open tables", 9);
        choises("workplace", "Open tables", 8);
        choises("workplace", "Shared desks", 7);
        choises("workplace", "Shared cubicles", 6);
        choises("workplace", "Open cubicles", 5);
        choises("workplace", "Closed cubicles", 4);
        choises("workplace", "Private cubicles", 3);
        choises("workplace", "Walled office", 2);
        choises("workplace", "Private office", 1);
        choises("work_environment", "A single very large and high open space, industrial like, no private spaces at all", 10);
        choises("work_environment", "Mostly large open space", 9);
        choises("work_environment", "Mix of large and smaller open spaces", 8);
        choises("work_environment", "Large open spaces of various sizes", 7);
        choises("work_environment", "Mostly open spaces with few private", 6);
        choises("work_environment", "Mix of open and closed", 5);
        choises("work_environment", "Some partitions", 4);
        choises("work_environment", "Divided spaces", 3);
        choises("work_environment", "Walled spaces", 2);
        choises("work_environment", "Divided and permanent walled private space", 1);
        choises("atmosphere", "Wall street stock trader noise level ok", 10);
        choises("atmosphere", "Lots of activity and often loul level ok", 9);
        choises("atmosphere", "Very busy and talkative level ok", 8);
        choises("atmosphere", "Lots of conversations, some loud ok", 7);
        choises("atmosphere", "Above noise level ok", 6);
        choises("atmosphere", "Normal office level ok", 5);
        choises("atmosphere", "less than normal ok", 4);
        choises("atmosphere", "Conversational noise level ok", 3);
        choises("atmosphere", "Very quiet conversations, library like quiet ok", 2);
        choises("atmosphere", "Court room like quiet ok", 1);
        choises("interaction", "Very friendly casual environment, little to no formality", 10);
        choises("interaction", "Little formality, very casual", 9);
        choises("interaction", "Mostly casual and friendly", 8);
        choises("interaction", "Very friendly", 7);
        choises("interaction", "More friendly than professional", 6);
        choises("interaction", "Friendly but professional 50/50", 5);
        choises("interaction", "Less friendly, more professional", 4);
        choises("interaction", "Some friendly interaction, but formal", 3);
        choises("interaction", "Little friendly interactions, mostly formal", 2);
        choises("interaction", "No friendly interacton, strickly professional, and formal", 1);
        choises("microculture", "I prefer to be very goods friends with my manager and co-workers, in and out of work", 10);
        choises("microculture", "I prefer to be friends with my manager and co-workers and we often plan to socialize after work", 9);
        choises("microculture", "I’m friends with my co-workers and manager and we sometimes socialize after work", 8);
        choises("microculture", "I’m sometimes run into my co-workers after work and I’m friendly with them ", 7);
        choises("microculture", "I somewhat know all of my co-workers and I’m somewhat friendly with all of them in the workplace", 6);
        choises("microculture", "I prefer a mix of friendliness and professionalism", 5);
        choises("microculture", "I prefer more professionalism, I will usually decline a after work social event but will attend company sponsored events ", 4);
        choises("microculture", "I will only attend company events if forced to", 3);
        choises("microculture", "When I done with work I prefer not to see my co-workers", 2);
        choises("microculture", "I prefer to keep my work relationships strictly professional with no contact with my co-workers outside of work", 1);
        //choises("charity", "Willing to donate time to company charitable events", 3);
        //choises("charity", "Willing to Mentor students in local community schools", 2);
        //choises("charity", "Willing to participate in charitable giving with company match", 1);
    }

    function check_culture(object, name) {

        if (object[name + '_1_id'] == object[name + '_2_id']
            || object[name + '_2_id'] == object[name + '_3_id']
            || object[name + '_1_id'] == object[name + '_3_id']) {
            alert("You have to select different choices");
            return false;

        } else {
            return true;
        }

    }
});