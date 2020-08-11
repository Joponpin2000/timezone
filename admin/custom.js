/******************************************
    Version: 1.0
/****************************************** */
function validate(form) {
    if (form.firstname.value == "") {
        alert("Please provide firstname!");
        form.firstname.focus();
        return false;
    }

    if (form.lastname.value == "") {
        alert("Please provide lastname!");
        form.lastname.focus();
        return false;
    }

    if (form.email.value == "") {
        alert("Please provide your email!");
        form.email.focus();
        return false;
    }

    validateEmail(form);


    if (form.username.value == "") {
        alert("Please provide username!");
        form.username.focus();
        return false;
    }


    if (form.password.value == "") {
        alert("Please provide password!");
        form.password.focus();
        return false;
    }

    if (form.rpassword.value != form.password.value) {
        alert("Please Repeat password!");
        form.rpassword.focus();
        return false;
    }

}


function validateLogin(form) {
    if (form.username.value == "") {
        alert("Enter registered username!");
        form.username.focus();
        return false;
    }

    if (form.password.value == "") {
        alert("Please provide password!");
        form.password.focus();
        return false;
    }


}

function validateEmail(form) {
    var emailID = form.emailnum.value;
    atpos = emailID.indexOf("@");
    dotpos = emailID.lastIndexOf(".");

    if (atpos < 1 || (dotpos - atpos < 2)) {
        alert("Please enter correct email ID!");
        form.emailnum.focus();
        return false;
    }
    return (true);
}


function validateOrderNumber(form) {
    if (form.ordernum.value == "") {
        alert("Please enter Order Number!");
        form.ordernum.focus();
        return false;
    }
}

function validateSettings(form) {
    if (form.newpassword.value == "") {
        alert("Please enter New Password!");
        form.newpassword.focus();
        return false;
    }

    if (form.newpassword.value != form.conpassword.value) {
        alert("Please repeat Password!");
        form.conpassword.focus();
        return false;
    }

}

function validateProfile(form) {
    if (form.firstname.value == "") {
        alert("Please provide firstname!");
        form.firstname.focus();
        return false;
    }

    if (form.lastname.value == "") {
        alert("Please provide lastname!");
        form.lastname.focus();
        return false;
    }

    if (form.username.value == "") {
        alert("Please provide username!");
        form.username.focus();
        return false;
    }
}


(function ($) {
    "use strict";

    //search product function
    $(document).ready(function () {

        $("#food-search").keypress(function () {
            load_data();

            function load_data(query) {
                $.ajax({
                    url: "fetchfood.php",
                    method: "post",
                    data: {
                        query: query
                    },
                    success: function (data) {
                        $('#result').html(data);
                    }
                });
            }

            $('#food-search').keyup(function () {
                var search = $(this).val();
                if (search != '') {
                    load_data(search);
                } else {
                    $('#result').html(data);
                }
            });
        });
    });

    /* ==============================================
    Fixed menu
    =============================================== */

    $(window).on('scroll', function () {
        if ($(window).scrollTop() > 50) {
            //$('.top-navbar').addClass('fixed-menu');
        } else {
            //$('.top-navbar').removeClass('fixed-menu');
        }
    });




/* ==============================================
Back top
=============================================== */


jQuery(window).scroll(function() {
    if (jQuery(this).scrollTop() > 1) {
        jQuery('.dmtop').css({
            bottom: "10px"
        })
    } else {
        jQuery('.dmtop').css({
            bottom: "-100px"
        })
    }
})


jQuery(".dmtop").click(function () {
    jQuery("body, html").animate({
        scrollTop: 0
    }, 600);
});

})(jQuery);

$(document).ready(function () {
    $('#sidebarCollapse').on('click', function () {
        $('#sidebar').toggleClass('active');
        $('.collapse.in').toggleClass('in');
        $('a[aria-expanded=true]').attr('aria-expanded', 'false');
    });
});