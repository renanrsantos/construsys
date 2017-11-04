$(document).ready(function() {


    var $content, $modal, $apnData, $modalCon;

    $content = $(".min");


    //To fire modal
    $("body").trigger('click','.mdlFire',function(e) {

        e.preventDefault();

        var $id = $(this).attr("data-target");

        $($id).modal({
            backdrop: false,
            keyboard: false
        });

    });


    $("body").on("click",'.modalMinimize', function() {
        
        $modalCon = $(this).closest(".mymodal").attr("id");

        $apnData = $(this).closest(".mymodal");

        $modal = "#" + $modalCon;

        $(".modal-backdrop").addClass("display-none");
        
        $($modal).toggleClass("min");

        if ($($modal).hasClass("min")) {

            $(".minmaxCon").append($apnData);

            $(this).find("span").html("&nbsp;&boxbox;&nbsp;");

        } else {

            $(".container").append($apnData);

            $(this).find("span").html("&nbsp;&minus;&nbsp;");

        };

    });

    $("body").trigger("click","button[data-dismiss='modal']",function() {

        $(this).closest(".mymodal").removeClass("min");

        $(".container").removeClass($apnData);

        $(this).next('.modalMinimize').find("span").html("&nbsp;&minus;&nbsp;");

    });

});