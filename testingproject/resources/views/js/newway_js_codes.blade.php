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


// js some pointa

// $.each( array, function( index, value ) )

// $(selector).each(function(index, element))

//The forEach() method calls a function for each element in an array.
// array.forEach(function(currentValue, index), thisValue)

// map() creates a new array from calling a function for every array element.
// array.map(function(currentValue, index, arr), thisValue)

// The filter() method creates a new array filled with elements that pass a test provided by a function.
// array.filter(function(currentValue, index, arr), thisValue)

</script>
