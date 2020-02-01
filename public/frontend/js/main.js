/* script del logo del navbar */
$(document).ready(function() {
    $(window).scroll(function() {
        if ($(document).scrollTop() > 50) {
            $("nav").addClass("shrink");
        } else {
            $("nav").removeClass("shrink");
        }
    });
});

$(document).ready(function() {
    $(window).scroll(function() {
        if ($(document).scrollTop() > 50) {
            $("#logo").attr("src", "frontend/images/Logo_stick.png");
        } else {
            $("#logo").attr("src", "frontend/images/Logo_main.png");
        }
    });
});

$(document).ready(function() {
    var $menuPricing = $("#lista");
    $menuPricing.mixItUp({
        selectors: {
            target: "li"
        }
    });
});

/*[ Daterangepicker ]
    ===========================================================*/
$(".my-calendar").daterangepicker({
    singleDatePicker: true,
    showDropdowns: true,
    locale: {
        format: "DD/MM/YYYY"
    }
});

var myCalendar = $(".my-calendar");
var isClick = 0;

$(window).on("click", function() {
    isClick = 0;
});

$(myCalendar).on("apply.daterangepicker", function() {
    isClick = 0;
});

$(".btn-calendar").on("click", function(e) {
    e.stopPropagation();

    if (isClick == 1) isClick = 0;
    else if (isClick == 0) isClick = 1;

    if (isClick == 1) {
        myCalendar.focus();
    }
});

$(myCalendar).on("click", function(e) {
    e.stopPropagation();
    isClick = 1;
});

$(".daterangepicker").on("click", function(e) {
    e.stopPropagation();
});
