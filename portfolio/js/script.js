$(document).ready(function(){
    checkOrientation();

    $(window).on("resize", function() {
        checkOrientation();
    });

    $('.navHamburg').click(()=>{
        toggleNav();
    })

    // functions

    function checkOrientation(){
        if ($( document ). width() < 768) {
            $('.navDiv').addClass('hidediv')
            $('.navHamburg').removeClass('hidediv')
        } else {
            $('.navHamburg').addClass('hidediv')
            $('.navDiv').removeClass('hidediv')
        }
    }

    function toggleNav(){
        $('.navDiv').toggleClass('hidediv')
    }

});