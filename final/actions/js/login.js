$(document).ready(function(d){
    $('#login').submit(function(e){
        e.preventDefault();
        var d = {
            un : $('.uname').val(),
            pass : $('.upass').val()
        }
        console.log(d);
        $.ajax({
            url  : 'actions/php/login.php',
            type    : 'POST',
            dataType: 'json',
            data    : d,
            success : function(res){
                if (res.total > 0){
                    $(document).ready(function(){  
                        if (res.user.user_type == 3){
                            console.log(res.user);
                            if (res.user.haveSurvey == null){
                                window.location.href = "survey_student.php";   
                            }else{
                                window.location.href = "my-classes.php";
                            }
                        }else if(res.user.user_type == 2){
                            window.location.href = "attendance.php";
                        }else{
                            window.location.href = "dashboard.php";
                        }
                    })
                }else{
                    swal("User not found", "please enter the valid users!", "warning");
                }
            }, error  : function(e){console.log(e);}
        });
    });

    
    $('#UpdateUser').submit(function(e){
        e.preventDefault();
        var d = {
            uid: $(".uid").val(),
            type: $(".type").val(),
            idno : $(".idno").val(),
            name: $(".name").val(),
            number: $(".number").val(),
            year: $(".type").val() == 1 ? "" : $(".year").val(),
            course: $(".type").val() == 1 ? "" : $(".course").val(),
            uname: $(".uname").val(),
            pass: $(".pass").val(),
            cpass: $(".cpass").val(),
        }
        $.ajax({
            url  : 'actions/php/updateUser.php',
            type    : 'POST',
            dataType: 'json',
            data    : d,
            success : function(res){
                console.log(res);
                if (res.isSuccess){
                    swal("Success", (d.type == 1 ? "Admin" : d.type == 2 ? "Teacher" : "Student") + " successfully Updated", "success");
                }else{
                    swal("Oops!", res.errorMessage,"warning");
                }
            }, error  : function(e){console.log(e);}
        });
        
    })

    
    $('#createuser').submit(function(e){
        e.preventDefault();
        var d = {
            type: $(".type").val(),
            idno : $(".idno").val(),
            name: $(".name").val(),
            number: $(".number").val(),
            year: $(".type").val() == 3 ? $(".year").val() : "",
            course: $(".type").val() == 3 ? $(".course").val() : "",
            uname: $(".uname").val(),
            pass: $(".pass").val(),
            cpass: $(".cpass").val(),
        }
        if (d.pass !== d.cpass){
            swal("Password mismatch","please confirm the password!","warning");
        }else if (d.number.length != 11 || d.number.substr(0,2) != "09"){
            swal("Oops!","Contact number must be eleven digits and start with 09","warning");
        }else{
            $.ajax({
                url  : 'actions/php/createUser.php',
                type    : 'POST',
                dataType: 'json',
                data    : d,
                success : function(res){
                    console.log(res);
                    if (res.isSuccess){
                        $(".type").val(""),
                        $(".idno").val(""),
                        $(".name").val(""),
                        $(".number").val(""),
                        $(".year").val(""),
                        $(".course").val(""),
                        $(".uname").val(""),
                        $(".pass").val(""),
                        $(".cpass").val(""),
                        swal("Success", (d.type == 1 ? "Admin" : d.type == 2 ? "Teacher" : "Student") + " successfully Created", "success");
                    }else{
                        swal("Oops!", res.errorMessage,"warning");
                    }
                }, error  : function(e){console.log(e);}
            });
        }
        
    })
    $("#survey").hide();
    $("#gotoSurvey").submit(function(e){
        e.preventDefault();
        if ($(".visitornumber").val().length != 11 || $(".visitornumber").val().substr(0,2) != "09"){
            swal("Oops!","Contact number must be eleven digits and start with 09","warning");
        }else{
            $(".mainpageAction").hide();
            $("#survey").show();
        }
    })
    $(".submitAll").click(function(){
        $(":submit").attr("disabled", true);
        var d = {
            survey:[],
            name: $(".name").val(),
            address: $(".address").val(),
            number: $(".number").val()
        }
        $('input', $('.surveycon')).each(function () {
            if ($(this)[0].checked){
                d.survey.push({id:$(this).attr('data-id')});
            }
        });
        if (d.survey.length >= 3){
            var numbertoSend = "";
            $("#contactnumber div").each(function(){
                numbertoSend += numbertoSend == "" ? $(this).attr("data-value") : "," + $(this).attr("data-value")
            })
            $.ajax({
                url  : 'actions/php/submitSurveyVisitor.php',
                type    : 'POST',
                dataType: 'json',
                data    : d,
                success : function(res){
                    $(":submit").attr("disabled", false);
                    console.log(res);
                    if (res.isSuccess){
                        var datasend = {
                            number: numbertoSend,
                            message : "Hi, there was a probable suspect of covid19 who want to enter in the facility, please advise the nurse to check that person!",
                        }
                        $.ajax({
                            url  : 'actions/php/sendSMS.php',
                            type    : 'POST',
                            dataType: 'text',
                            data    : datasend,
                            success : function(res){
                                window.location.href = "visitor_invalid.php";
                                $(":submit").attr("disabled", false);
                            }, error  : function(e){
                                console.log(e);
                                $(":submit").attr("disabled", false);
                            }
                        });
                    }else{
                        swal("Oops!", res.errorMessage,"warning");
                    }
                }, error  : function(e){ $(":submit").attr("disabled", false); console.log(e);}
            });
            
        }else{
            $.ajax({
                url  : 'actions/php/submitSurveyVisitor.php',
                type    : 'POST',
                dataType: 'json',
                data    : d,
                success : function(res){
                    $(":submit").attr("disabled", false);
                    console.log(res);
                    if (res.isSuccess){
                        window.location.href = "visitor_success.php";
                    }else{
                        swal("Oops!", res.errorMessage,"warning");
                    }
                }, error  : function(e){ $(":submit").attr("disabled", false); console.log(e);}
            });
        }
    })

    $(".submitStudentSurvey").click(function(){
        $(":submit").attr("disabled", true);
        var d = {
            survey:[],
        }
        $('input', $('.surveycon')).each(function () {
            if ($(this)[0].checked){
                d.survey.push({id:$(this).attr('data-id')});
            }
        });
        if (d.survey.length >= 3){
            var numbertoSend = "";
            $("#contactnumber div").each(function(){
                numbertoSend += numbertoSend == "" ? $(this).attr("data-value") : "," + $(this).attr("data-value")
            })

            $.ajax({
                url  : 'actions/php/submitSurveyVisitor_student.php',
                type    : 'POST',
                dataType: 'json',
                data    : d,
                success : function(res){
                    $(":submit").attr("disabled", false);
                    var datasend = {
                        number : $(".number").val(),
                        message : "Hi good day!, this is from CSTC College and would to inform you that " + $(".student").val()  + " has already entered in our school!",
                    }
                    $.ajax({
                        url  : 'actions/php/sendSMS.php',
                        type    : 'POST',
                        dataType: 'text',
                        data    : datasend,
                        success : function(res){
                            var data = {
                                number: numbertoSend,
                                message : "Hi, there was a student probable suspect of covid19 who want to enter in the facility, please advise the nurse to check that person!",
                            }
                            $.ajax({
                                url  : 'actions/php/sendSMS.php',
                                type    : 'POST',
                                dataType: 'text',
                                data    : data,
                                success : function(res){
                                    $(":submit").attr("disabled", false);
                                    window.location.href = "visitor_invalid.php";
                                }, error  : function(e){console.log(e); $(":submit").attr("disabled", false);}
                            });
                        }, error  : function(e){console.log(e); $(":submit").attr("disabled", false);}
                    });
                }, error  : function(e){console.log(e); $(":submit").attr("disabled", false);}
            });
        }else{
            $.ajax({
                url  : 'actions/php/submitSurveyVisitor_student.php',
                type    : 'POST',
                dataType: 'json',
                data    : d,
                success : function(res){
                    $(":submit").attr("disabled", false);
                    var d = {
                        number : $(".number").val(),
                        message : "Hi good day!, this is from CSTC College and would to inform you that " + $(".student").val()  + " has already entered in our school!",
                    }
                    $.ajax({
                        url  : 'actions/php/sendSMS.php',
                        type    : 'POST',
                        dataType: 'text',
                        data    : d,
                        success : function(res){
                            window.location.href = "student_success.php";
                            $(":submit").attr("disabled", false);
                        }, error  : function(e){console.log(e); $(":submit").attr("disabled", false);}
                    });
                }, error  : function(e){console.log(e); $(":submit").attr("disabled", false);}
            });
        }
    })

    $("#saveSetting").submit(function(e){
        e.preventDefault();
        if (($(".admin").val().length != 11 || $(".admin").val().substr(0,2) != "09")
            || ($(".nurse").val().length != 11 || $(".nurse").val().substr(0,2) != "09")
            || ($(".guard").val().length != 11 || $(".guard").val().substr(0,2) != "09")){
            swal("Oops!","Contact number must be eleven digits and start with 09","warning");
        }else{
            var d ={
                admin: $(".admin").val(),
                nurse: $(".nurse").val(),
                guard: $(".guard").val()
            }
            $.ajax({
                url  : 'actions/php/updateSetting.php',
                type    : 'POST',
                dataType: 'json',
                data    : d,
                success : function(res){
                    window.location.reload();
                    $(":submit").attr("disabled", false);
                }, error  : function(e){console.log(e); $(":submit").attr("disabled", false);}
            });
        }
    })

    $("#show_hide_password a").on('click', function (event) {
        event.preventDefault();
        if ($('#show_hide_password input').attr("type") == "text") {
            $('#show_hide_password input').attr('type', 'password');
            $('#show_hide_password i').addClass("fa-eye-slash");
            $('#show_hide_password i').removeClass("fa-eye");
        } else if ($('#show_hide_password input').attr("type") == "password") {
            $('#show_hide_password input').attr('type', 'text');
            $('#show_hide_password i').removeClass("fa-eye-slash");
            $('#show_hide_password i').addClass("fa-eye");
        }
    });
})

    
