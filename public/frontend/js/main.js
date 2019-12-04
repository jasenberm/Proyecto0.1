/* script del logo del navbar */
$(document).ready(function(){
    $(window).scroll(function(){
        if ($(document).scrollTop() > 50) {
            $("nav").addClass("shrink");
        } else {
            $("nav").removeClass("shrink");
        }
    });
});

$(document).ready(function() {
    $(window).scroll(function () {
       if ($(document).scrollTop() > 50) {
           $("#logo").attr("src", "frontend/images/Logo_stick.png")
       } else {
        $("#logo").attr("src", "frontend/images/Logo_main.png")
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

