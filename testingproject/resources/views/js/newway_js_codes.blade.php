<script>

    $('body').on('keypress', '.stake_input', function(e) {
        let charCode = (e.which) ? e.which : event.keyCode
        console.log('this.value.....',this.value);
        console.log('String.fromCharCode(event.keyCode).....',String.fromCharCode(event.keyCode));
        if (isNaN(this.value + String.fromCharCode(event.keyCode)))
            return false;
    });


    $('.rt_stake_input').on('input', function() {
        $(this).val($(this).val().replace(/[^0-9]/gi, ''));
    });


    function ajax_call(type,url,data,callingFunction,errorFunction=null){

        if(type.toLowerCase() == 'post')
        {
            data['_token'] = "{{csrf_token()}}";
        }

        $.ajax({
            type: type,
            url: `{{url('/')}}/${url}`,
            data: data,
            beforeSend:()=>{
                // acc_hide();
            },
            success:(res)=>{
                console.log(res);
                callingFunction(res);
            }, error: function(err) {
                errorFunction();
            }
        });
    }

    function submit_form(form_class,additional_data,type,url,callingFunction,errorFunction=null) {

        var user_data = new FormData(document.querySelector(form_class));
        user_data = JSON.stringify(Object.fromEntries(user_data));
        user_data = JSON.parse(user_data);
        if(additional_data != null) user_data.form_fields = additional_data;

        ajax_call(type,url,user_data,callingFunction);

    }

    function checkisInViewport(that) {
        var elementTop = $(that).offset().top;
        var elementBottom = elementTop + $(this).outerHeight();
        var viewportTop = $(window).scrollTop();
        var viewportBottom = viewportTop + $(window).height();
        return elementBottom > viewportTop && elementTop < viewportBottom;
    }


    function forcedecimal(ele) {
        var val = $(ele).val();
        var splitVal = val.split('.');
        if (splitVal.length == 2 && splitVal[1].length > 3) {
            $(ele).val(splitVal[0] + '.' + splitVal[1].substr(0, 3));
        }
    }


    function multiplydecimals(a, b) {
        var commonMultiplier = 1000000;

        a *= commonMultiplier;
        b *= commonMultiplier;

        return (a * b) / (commonMultiplier * commonMultiplier);
    };


    function getdecimal_length(number) {
        if((number).toString().split('.')[1]){
            return (number).toString().split('.')[1].length;
        } else {
            return 0;
        }
    }


    function addingdecimals(a, b) {
        a_mul_digits = getdecimal_length(a);
        b_mul_digits = getdecimal_length(b);

        var greater_digit = 0;
        if(a_mul_digits > b_mul_digits){
            greater_digit = a_mul_digits;
        } else {
            greater_digit = b_mul_digits;
        }

        a *= Math.pow(10,greater_digit);
        b *= Math.pow(10,greater_digit);


        return (a + b)/Math.pow(10,greater_digit);
    }


    function add_form_fields(parent_class) {
        $(`<input type='text' class="form-control my-1" placeholder="enter field name" />`).appendTo(`.${parent_class}`);
    }


    function calculateRemainingDays(row, sub_date) {
        var cur_date = new Date();
        if (sub_date >= cur_date) {
            $(row).find('.cls_trmt_count_down').show();
            $(row).find('.cls_trmt_count_down_end').hide();
            var rem = Math.abs(sub_date - cur_date) / 1000;
            var days = Math.floor(rem / 86400);
            rem -= days * 86400;
            var hours = Math.floor(rem / 3600) % 24;
            rem -= hours * 3600;
            var minutes = Math.floor(rem / 60) % 60;
            rem -= minutes * 60;
            var seconds = Math.floor(rem % 60);
            $(row).find('.cls_trmt_days').text((days < 10) ? '0' + days : days);
            $(row).find('.cls_trmt_hours').text((hours < 10) ? '0' + hours : hours);
            $(row).find('.cls_trmt_mins').text((minutes < 10) ? '0' + minutes : minutes);
            $(row).find('.cls_trmt_secs').text((seconds < 10) ? '0' + seconds : seconds);
        } else {
            $(row).find('.cls_trmt_count_down_end').show();
            $(row).find('.cls_trmt_count_down').hide();
        }

    }

    // spread operator
    function print(...ar){
        console.log(ar[0]);
        console.log(ar[1]);
        console.log(ar[2]);
    }

    function convertNulltoempty(params) {
        Object.keys(params).map(function (key, index) {
                    if (params[key] == null) {
                        params[key] = "--";
                    }
                });
    }

    function getCurrentUrl() {
        return $(location).attr('href');
    }

// js some pointa

// $.each( array, function( index, value ) )

// $(selector).each(function(index, element))

//The forEach() method calls a function for each element in an array.
// array.forEach(function(currentValue, index), thisValue)

// map() creates a new array from calling a function for every array element.
// array.map(function(currentValue, index, arr), thisValue)

// The filter() method creates a new array filled with elements that pass a test provided by a function.
// array.filter(function(currentValue, index, arr), thisValue)



function validation(type = null) {

    if (type != null) {
        if (type == 'user_name') {
            var userName = $('#userName').val();
            $('.user_name_error').find('span').text('');
            var userNameLengh = userName.length;
            $('#userName').parent().parent().addClass('input-group--focused');
            if (userNameLengh == 0) {
                $('.user_name_error').show();
                $('.user_name_error').find('span').text('*  Username required');
    } else if (userNameLengh < 3) {
                $('.user_name_error').show();
                $('.user_name_error').find('span').text('* Username must be minimum of 3 characters');
            } else if (userNameLengh > 30) {
                $('.user_name_error').show();
                $('.user_name_error').find('span').text('* Username must be less than 30 characters');
            } else {
                $('.user_name_error').hide();
            }
        }

        if (type == 'email') {
            var email = $('#email').val();
            var emailLength = email.length;
            if (emailLength == 0) {
                $('.email_error').show();
                $('.email_error').find('span').text('* Required');
            } else {
                // if (!validateEmail(email)) {
                //     $('.email_error').show();
                //     $('.email_error').find('span').text('* Invalid Email');
                // } else {
                    $('.email_error').hide();
                // }
            }
        }


        if (type == 'password') {
            var password = $('#password').val();
            var passwordLength = password.length;
            if (passwordLength == 0) {
                $('.password_error').show();
                $('.password_error').find('span').text('* Required');
            } else if (passwordLength < 5) {
                $('.password_error').show();
                $('.password_error').find('span').text('* Must be minimum of 5 characters');
            } else if (passwordLength > 60) {
                $('.password_error').show();
                $('.password_error').find('span').text('* Must be less than 60 characters');
            } else {
                    $('.password_error').hide();
            }
        }

        // if (type == 'confirm_password') {
        //     var confirmPassword = $('#confirmPassword').val();
        //     var confirmPasswordLength = confirmPassword.length;
        //     if (confirmPasswordLength == 0) {
        //         $('.confirm_password_error').show();
        //         $('.confirm_password_error').find('span').text('* Required');
        //     } else {
        //         var password = $("#password").val();
        //         var confirmPassword = $("#confirmPassword").val();
        //         if (password != confirmPassword) {
        //             $('.confirm_password_error').show();
        //             $('.confirm_password_error').find('span').text('* Password mismatch');
        //         } else {
        //             $('.confirm_password_error').hide();
        //         }
        //     }
        // }

        // if (type == 'full_name') {
        //     var fullName = $('#fullName').val();
        //     var fullNameLength = fullName.length;
        //     if (fullNameLength == 0) {
        //         $('.full_name_error').show();
        //         $('.full_name_error').find('span').text('* Required');
        //     } else {
        //         $('.full_name_error').hide();
        //     }
        // }

        if (type == 'mobile_number') {
            var mobileNumber = $('#mobileNumber').val();
            var mobileNumberLength = mobileNumber.length;
            if (mobileNumberLength == 0) {
                $('.mobile_number_error').show();
                $('.mobile_number_error').find('span').text('* Required');
            }
            else if (mobileNumberLength!=10) {
            $('.mobile_number_error').show();
            $('.mobile_number_error').find('span').text('Mobile number should be 10 digits');
            }else {
                $('.mobile_number_error').hide();
            }
        }

    } else {

        var userName = $('#userName').val();
        var userNameLengh = userName.length;
        if (userNameLengh == 0) {
            $('.user_name_error').show();
            $('.user_name_error').find('span').text('* Required');
    } else if (userNameLengh < 3) {
                $('.user_name_error').show();
                $('.user_name_error').find('span').text('* Username must be minimum of 3 characters');
            } else if (userNameLengh > 30) {
                $('.user_name_error').show();
                $('.user_name_error').find('span').text('* Username must be less than 30 characters');
            } else {
            $('.user_name_error').hide();
        }




        var first_pass = $('#password').val();

        // var password = $('#password').val();

        var passwordLength = first_pass.length;
        if (passwordLength == 0) {
            $('.password_error').show();
            $('.password_error').find('span').text('* Required');
        } else if (passwordLength < 5) {
            $('.password_error').show();
            $('.password_error').find('span').text('* Must be minimum of 5 characters');
        } else if (passwordLength > 60) {
            $('.password_error').show();
            $('.password_error').find('span').text('* Must be less than 60 characters');
        } else if(!first_pass.match(lowerCaseLetters)&&!first_pass.match(upperCaseLetters)) {
            notify('Password must contain a letter','danger')
            return false;
        }  else   if(!first_pass.match(numbers)) {      // Validate numbers
            notify('Password must contain a digit','danger')
            return false;
        }    else   if($('#userName').val()==first_pass) {
            notify('Password cannot be same as username','danger')
            return false;
        }      else if($('#mobileNumber').val()==first_pass) {
            notify('Password cannot be same as mobile number','danger')
            return false;
        }   else if($('#email').val().toLowerCase().indexOf(first_pass)>=0) {
            notify('Password cannot be same as email','danger')
            return false;
        } else {
            $('.password_error').hide();
        }




        var lowerCaseLetters = /[a-z]/g;
        var upperCaseLetters = /[A-Z]/g;
        var numbers = /[0-9]/g;








        var email = $('#email').val();
        var emailLength = email.length;
        if (emailLength == 0) {
            $('.email_error').show();
            $('.email_error').find('span').text('* Required');
        } else {
            // if (!validateEmail(email)) {
            //     $('.email_error').show();
            //     $('.email_error').find('span').text('* Invalid Email');
            // } else {
                $('.email_error').hide();
            // }
        }




        var mobileNumber = $('#mobileNumber').val();
        var mobileNumberLength = mobileNumber.length;
        if (mobileNumberLength == 0) {
            $('.mobile_number_error').show();
            $('.mobile_number_error').find('span').text('* Required');
        } else {
            $('.mobile_number_error').hide();
        }

        // var first_pass = $('#password').val();

        // var lowerCaseLetters = /[a-z]/g;
        // var upperCaseLetters = /[A-Z]/g;
        // if(!first_pass.match(lowerCaseLetters)&&!first_pass.match(upperCaseLetters)) {
        // notify('Password must contain a letter','danger')
        // return false;
        // }
    // Validate numbers
    //   var numbers = /[0-9]/g;
    //   if(!first_pass.match(numbers)) {
    //     notify('Password must contain a digit','danger')
    //     return false;
    //   }
    //   if($('#userName').val()==first_pass) {
    //     notify('Password cannot be same as username','danger')
    //     return false;
    //   }
    //   if($('#mobileNumber').val()==first_pass) {
    //     notify('Password cannot be same as mobile number','danger')
    //     return false;
    //   }

    //   if($('#email').val().toLowerCase().indexOf(first_pass)>=0) {
    //     notify('Password cannot be same as email','danger')
    //     return false;
    //   }

        var userNameValidationStatus = $('.user_name_error').is(":hidden");
        var emailValidationStatus = $('.email_error').is(":hidden");
        var passwordValidationStatus = $('.password_error').is(":hidden");
        // var cPasswordValidationStatus = $('.confirm_password_error').is(":hidden");
        // var fullNameValidationStatus = $('.full_name_error').is(":hidden");
        var mobValidationStatus = $('.mobile_number_error').is(":hidden");

        if (userNameValidationStatus && emailValidationStatus && passwordValidationStatus && mobValidationStatus) {
            return true;
        } else {
            return false;
        }
    }


    function onScrollLoad(object) {

        if(checkisInViewport($(`${object} .historyMainDiv`).last()) && loadingInProgressHistoryPage == false){
            loadingInProgressHistoryPage = true;

            getbetdetails('POST',"{{route('kfsb.bethistorydata')}}",dt,appenddata);

        }
    }



}

</script>
