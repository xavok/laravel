$(window).load(function () {

    $(".chosen-select").chosen();
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
                minlength: 5
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


    if ($("#industry_form").length > 0) {
        $("#bar").css("width", "20%");
        $("#bar").html("20%");
        $("#bar").addClass("progress-bar-danger");

    }
    if ($("#occupation_form").length > 0) {
        $("#bar").css("width", "40%");
        $("#bar").html("40%");
    }

    if ($("#education_form").length > 0) {
        $("#bar").removeClass("progress-bar-danger");
        $("#bar").addClass("progress-bar-warning");
        $("#bar").css("width", "60%");
        $("#bar").html("60%");
    }


    if ($("#cultural_form").length > 0) {
        $("#bar").css("width", "90%");
        $("#bar").html("90%");
    }


    if ($("#qualifications_form").length > 0) {
        $("#bar").css("width", "80%");
        $("#bar").html("80%");
        $("#bar").removeClass("progress-bar-warning");
        $("#bar").addClass("progress-bar-success");
    }

    $("#addEducation").click(function () {
        var educationNumber = $('.school').length;
        if (educationNumber < 3) {
            var education = $(".get_education_inputs").html();
            $("#place_to_add_more_education").append(education);
            $('[name="id[]"]').last().val(0);
        } else {
            $(".panel-body").prepend("<div class='alert alert-danger'>You can't select more than 3 schools at the moment</div>");
        }
    });
    $("#addOccupation").click(function () {
        var occupationNumber = $('.occupation').length;
        if (occupationNumber < 3) {
            var occupation = $(".get_occupation_inputs").html();
            $("#place_to_add_more_occupation").append(occupation);
            $('[name="id[]"]').last().val(0);
        } else {
            $(".panel-body").prepend("<div class='alert alert-danger'>You can't select more than 3 industries at the moment</div>");
        }
    });
    $("#addIndustry").click(function () {
        var industriesNum = $('.industries').length;
        if (industriesNum < 3) {
            var industry = $(".get_industry_inputs").first().html();
            $("#place_to_add_more_industry").append(industry);
            $('[name="id[]"]').last().val(0);
        } else {
            $(".panel-body").prepend("<div class='alert alert-danger'>You can't select more than 3 industries at the moment</div>");
        }
    });
    $("#addQualification").click(function () {
        var qualification = $(".get_qualifications").first().html();
        $(".add_qualifications").append(qualification);
        $('[name="id[]"]').last().val(0);

    });

    $(document).ready()
    {
        if (window.location.href.indexOf("commandCenter") > -1) {
            var i = 0;
            for (i = 0; i < user_matches; i++) {
                $("#candidate_" + i).on("click", function () {
                    $("#candidate_id").html("Candidate " + $(this).html() + " to Job IT2438");
                });
            }
        } else if (window.location.href.indexOf("occupation") > -1) {
            occupationPage();
        } else if (window.location.href.indexOf("cultural") > -1) {
            culturalPage();
        }

    }

    function culturalPage() {
        $(".culture").change(function (e) {
            var id = $(this).attr("name");
            id = id.split('_')[0];
            var value1 = $(".culture[name=" + id + "_1_id]").val();
            var value2 = $(".culture[name=" + id + "_2_id]").val();
            var value3 = $(".culture[name=" + id + "_3_id]").val();
            if (value1 == value2
                || value2 == value3
                || value1 == value3) {
                $(".panel-body").prepend("<div class='alert alert-danger'>Please make sure you don't select same values twice for " + id + "</div>");
            } else {
                $(".panel-body .alert").remove();
            }
        });
        $.ajax({
            type: 'Get',
            url: '/cultural-choices/' + profile_id,
            success: function (res) {
                for (var key in res) {
                    if($(".culture[name=" + key + "]")) {
                        $(".culture[name=" + key + "]").val(res[key]);
                    }
                }
            }
        });

    }

    function occupationPage() {
        $("#occupation_form").on('change', '.occupation', function () {
            $this = $(this);
            console.log('ds');
            var id = $(this).val();
            $.ajax({
                type: 'Get',
                url: '/occupation-types/' + id,
                success: function (res) {
                    $type = $this.parent('.input-group').next().next().find('.type');
                    $type.find('option').remove();
                    for (var i = 0; i < res.length; i++) {
                        $type.append('<option value="' + res[i].id + '">' + res[i].occupation_subtype_name + '</option>');
                        $type.prop("disabled", false); // Element(s) are now enabled.
                    }
                }
            });
        });
    }
});