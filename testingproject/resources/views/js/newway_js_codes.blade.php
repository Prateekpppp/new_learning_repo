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
        // var viewportBottom = viewportTop + $(window).height();
        var viewportBottom = viewportTop + window.innerHeight;
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


function validateNumberLatest(that) {

    var decimalIndex = $(that).val().indexOf('.');

    if(that.value.length < 1){
    parent.alert('{{__("Invalid amount")}}','Message','error')
    $(that).val('').blur()
    return true;
    }

    if (/^0+/.test(that.value)) {
    parent.alert('{{__("Invalid amount")}}','Message','error')
    $(that).val('').focus()
    return true;
    }

    var deci = $(that).val().length - decimalIndex;

    if(that.value>1000000){
    parent.alert('{{__("Maximum allowed amount is ₹10,00,000.00")}}','Message','error')
    $(that).val('').blur()

    return true;
    }
    if((decimalIndex>0&& decimalIndex > that.maxLength)) {
    that.value = that.value.slice(0, (that.maxLength+deci));
    }
    else if(decimalIndex<0&&that.value.length > that.maxLength) {
    that.value = that.value.slice(0, (that.maxLength));
    }

    if (decimalIndex !== -1 && $(that).val().length - decimalIndex > 3) {
    $(that).val($(that).val().slice(0, decimalIndex + 3));
    }


    if($(that).val() < 1 ){
    parent.alert('{{__("Invalid amount")}}','Message','error')
    $(that).val('').blur()
    }
}


if(checkisInViewport($('.sb_check_scroll'))){
    $('html, body').scrollTop($(".loader").offset().top);
}


$.fn.isOnScreen = function() {
        var win = $(window);
        var viewport = {
              top: win.scrollTop(),
              left: win.scrollLeft()
        };
        viewport.right = viewport.left + win.width();
        viewport.bottom = viewport.top + win.height();
        var bounds = this.offset();
    if(bounds){
        bounds.right = bounds.left + this.outerWidth();
        bounds.bottom = bounds.top + this.outerHeight();
        return (!(viewport.right < bounds.left || viewport.left > bounds.right || viewport.bottom < bounds.top || viewport.top > bounds.bottom));
    }

};


$.fn.isInViewport = function() {
  var elementTop = $(this).offset().top;
  var elementBottom = elementTop + $(this).outerHeight();
  var viewportTop = $(window).scrollTop();
  var viewportBottom = viewportTop + $(window).height();
  return elementBottom > viewportTop && elementTop < viewportBottom;
};

let searchGameTimeoutId;
    function debounce(func, delay) {
        return function(...args) {
            clearTimeout(searchGameTimeoutId);
            searchGameTimeoutId = setTimeout(() => func.apply(this, args), delay);
        };
    }


</script>


<script>


    function appendOnclick(blogs,data) {
        // blogs = blogs.blogs;
        appendData(blogs,data);

    }

    var finance_insight_arr = @json($finance_category_names);

    function appendData(blogs,data) {

        response = blogs.blogs;
        blogs = blogs.blogs.data;

        if(response.current_page == response.last_page) $(`.loadmoreDiv[data-category="${data.category}"]`).parent().find('.wf_load_more').hide();

        if((finance_insight_arr).includes(data.category)){
            cat_name = 'finance_insight';
        } else{
            cat_name = data.category;
            cat_name = cat_name.toLowerCase();
            cat_name = cat_name.replace(/\s+/g,"_");
        }
        htmlFunction = 'category_'+cat_name;
        var html = '';

        $.each( blogs, function( index, blog ){
            if (htmlFunction == 'category_whitepaper' && response.current_page == 1 && index == 0) {
                $(`.whitepaper_fst_loadmoreDiv`).html(category_whitepaper_first_card(blog));
            } else {
                html+= eval(`${htmlFunction}(blog)`);
            }
        });

        if(response.current_page != 1){

            $(`.loadmoreDiv[data-category="${data.category}"]`).append(html);
        } else{

            $(`.loadmoreDiv[data-category="${data.category}"]`).html(html);
        }

    }

    function category_featuring(blog) {

        return `
            <div class="swiper-slide card card1">
                <div class="gradient_border">
                    <div class="head_title">
                        <div class="top">
                            <span class="title">${blog.title}</span>
                            <p class="para date">${blog.publish_at}</p>
                        </div>
                        <a class="nav_link_icon" href="{{url('blogs')}}/${blog.slug}">
                            <img src="/assets/images/blogs/icons/green_arrow_up_right.svg"
                            alt="link">
                        </a>
                    </div>
                </div>
                <div class="img_container">
                    <div class="loading-placeholder"><div class="skeleton-placeholder"></div></div>
                    <img src="${blog.image}" alt="image">
                </div>
            </div>
        `;
    }
    function category_recent_blogs(blog) {

        return `
            <div class="feature_card">
                <div class="user_img">
                    <div class="loading-placeholder"><div class="skeleton-placeholder"></div></div>
                    <img class="feature_user" src="${blog.image}"
                        alt="user">
                </div>
                <div class="feature_inner_text">
                    <a href="{{url('blogs')}}/${blog.slug}">
                        <h2 class="blog-title">${blog.title}</h2>
                    </a>
                    <h5>${blog.publish_at}</h5>
                    <div class="feature_para">
                        <p>${blog.short_description}</p>
                        <a href="{{url('blogs')}}/${blog.slug}">
                            <img class="feature_arrow"
                                src="{{ asset('/assets/images/blogs/icons/feature_arrow.svg') }}"
                                alt="link">
                        </a>
                    </div>
                </div>
            </div>
        `;
    }


    function category_finance_insight(blog) {

        return `
            <div class="fi_card">
                <div class="col img_container">
                    <div class="loading-placeholder"><div class="skeleton-placeholder"></div></div>
                    <img src="${blog.image}" alt="fiImage">
                </div>
                <div class="col text_container">
                    <div class="text_div">
                        <a href="{{url('blogs')}}/${blog.slug}" class="title blog-title click-blog-link">${blog.title}</a>
                        <div class="text_bottom_container">
                            <p class="fi_para">${blog.short_description}</p>

                        </div>
                    </div>
                    <a class="col nav_link_con" href="{{url('blogs')}}/${blog.slug}">
                        <img src="/assets/images/blogs/icons/green_arrow_up_right.svg"alt="link">
                    </a>
                </div>
            </div>
        `;
    }

    function category_whitepaper_first_card(blog) {

        return `
            <div class="card_img_sec">
                <div class="loading-placeholder">
                    <div class="skeleton-placeholder"></div>
                </div>
                <img src="${blog.image}" alt="trade">
            </div>
            <div class="white_paper_fst_txt_card">
                <div class="card_txt_sec">
                    <a href="{{url('blogs')}}/${blog.slug}">
                        <h3 class="blog-title">${blog.title}</h3>
                    </a>
                    <p>${blog.short_description}</p>
                </div>
                <div class="icons_sec">
                    <a href="{{url('blogs')}}/${blog.slug}" class="link_icon">
                        <img src="{{ asset('/assets/images/blogs/icons/green_upArrow.svg') }}"
                            alt="link">
                    </a>
                </div>
            </div>
        `;
    }

    function category_whitepaper(blog) {

        return `
            <div class="white_paper_card">
                <div class="card_img_sec">
                    <div class="loading-placeholder">
                        <div class="skeleton-placeholder"></div>
                    </div>
                    <img src="${blog.image}" alt="cfo">
                </div>
                <div class="card_txt_sec">
                    <a href="{{url('blogs')}}/${blog.slug}">
                        <h3 id="wordCount" class="blog-title">${blog.title}</h3>
                    </a>
                    <p>${blog.short_description}</p>
                    <div class="icons_sec">
                        <a href="{{url('blogs')}}/${blog.slug}" class="link_icon">
                            <img src="{{ asset('/assets/images/blogs/icons/green_upArrow.svg') }}"
                                alt="link">
                        </a>
                    </div>
                </div>
            </div>
        `;
    }


    var data = {};

    $(document).ready(function(){


        data.data_order = 'desc';

        // data.page = 1;

        let cat_data;

        var categories = @json($categoriesArr);

        $.each(categories,function(i,v){

            cat_name = (v.name).toLowerCase();
            cat_name = cat_name.replace(/\s+/g,"_");

            data[`${cat_name}`] = cat_data = {};

            cat_data.data_order = 'desc';
            cat_data.category = v.name;
            cat_data.page = 1;
            cat_data.limit = 3;

            if(cat_data.category != '{{$categoriesArr[0]->name}}' && cat_data.category != '{{$categoriesArr[1]->name}}') {
                cat_data.limit = 3;
            }

            if(cat_data.category == '{{$categoriesArr[1]->name}}') {
                cat_data.limit = 4;
            }

            ajax_call('post',`getCategoryBlogs/${v.id}`,cat_data,appendData)
        })



        $('.wf_load_more').on('click',function () {

            var url = `getCategoryBlogs/`+$(this).data('cat_id');

            cat_name = ($(this).data('category')).toLowerCase();
            cat_name = cat_name.replace(/\s+/g,"_");

            cat_data = data[`${cat_name}`];

            cat_data.category = $(this).data('category');
            cat_data.category_id = $(this).data('cat_id');


            cat_data.page += 1;

            if(cat_data.category != '{{$categoriesArr[1]->name}}') {
                cat_data.limit = 3;
            }

            if(cat_data.category == '{{$categoriesArr[1]->name}}') {
                cat_data.limit = 4;
            }


            ajax_call('post',url,cat_data,appendOnclick)
        });

        $('.whitepaper_sort li').on('click',function () {


            cat_name = ($(this).data('category')).toLowerCase();
            cat_name = cat_name.replace(/\s+/g,"_");

            cat_data = data[`${cat_name}`];

            cat_data.category = $(this).data('category');
            cat_data.category_id = $(this).data('cat_id');


            cat_data.page = 1;
            cat_data.wp_data_order = $(this).data('value');


            cat_data.data_order = $(this).data('value');

            ajax_call('post',`getCategoryBlogs/`+$(this).data('cat_id'),cat_data,appendData);
            $(`.loadmoreDiv[data-category="${cat_data.category}"]`).parent().find('.wf_load_more').show();
        })


    });


</script>
