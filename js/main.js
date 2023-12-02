function main() {

    (function () {
        'use strict';

        $('a.page-scroll').click(function () {
            if (location.pathname.replace(/^\//, '') == this.pathname.replace(/^\//, '') && location.hostname == this.hostname) {
                var target = $(this.hash);
                target = target.length ? target : $('[name=' + this.hash.slice(1) + ']');
                if (target.length) {
                    $('html,body').animate({
                        scrollTop: target.offset().top - 50
                    }, 900);
                    return false;
                }
            }
        });


        $('body').scrollspy({
            target: '.navbar-default',
            offset: 80
        });

        // Hide nav on click
        $(".navbar-nav li a").click(function (event) {
            // check if window is small enough so dropdown is created
            var toggle = $(".navbar-toggle").is(":visible");
            if (toggle) {
                $(".navbar-collapse").collapse('hide');
            }
        });
    }());
}
main();
jQuery(document).ready(function () {
    $("#chkDepth").change(function () {
        $('#depthFrom').attr("disabled", !$(this).is(":checked"));
        $('#depthTo').attr("disabled", !$(this).is(":checked"));
    });
    $("#chkNominalDepth").change(function () {
        $('#nominalDepthFrom').attr("disabled", !$(this).is(":checked"));
        $('#nominalDepthTo').attr("disabled", !$(this).is(":checked"));
    });

    $("#chkWidth").change(function () {
        $('#widthFrom').attr("disabled", !$(this).is(":checked"));
        $('#widthTo').attr("disabled", !$(this).is(":checked"));
    });

    $("#chkWeight").change(function () {
        $('#weightFrom').attr("disabled", !$(this).is(":checked"));
        $('#weightTo').attr("disabled", !$(this).is(":checked"));
    });

    $("#chkArea").change(function () {
        $('#areaFrom').attr("disabled", !$(this).is(":checked"));
        $('#areaTo').attr("disabled", !$(this).is(":checked"));
    });

    $("#chkIx").change(function () {
        $('#ixFrom').attr("disabled", !$(this).is(":checked"));
        $('#ixTo').attr("disabled", !$(this).is(":checked"));
    });

    $("#chkIy").change(function () {
        $('#iyFrom').attr("disabled", !$(this).is(":checked"));
        $('#iyTo').attr("disabled", !$(this).is(":checked"));
    });

    $("#chkZx").change(function () {
        $('#zxxaxisFrom').attr("disabled", !$(this).is(":checked"));
        $('#zxxaxisTo').attr("disabled", !$(this).is(":checked"));
    });

    $("#chkZy").change(function () {
        $('#zyyaxisFrom').attr("disabled", !$(this).is(":checked"));
        $('#zyyaxisTo').attr("disabled", !$(this).is(":checked"));
    });
    $("#printButton").click(function () {
        window.print();
    });
    $("#printButtonF").click(function () {
        $("#printMessage").removeClass('hidden');
    });
});

function clearAll()
{
    $('[name="search"]').trigger("reset");    
    $('[name="login"]').trigger("reset");
    $('[name="register"]').trigger("reset");
    $('[name="contact"]').trigger("reset");
    $('[name="forgotPassword"]').trigger("reset");
    $('[name="registrationVerification"]').trigger("reset");
}
