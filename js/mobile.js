
$(document).ready(function(){
    $(".iconoMenuDesplegable").click(function(){
        if($(".MenuLateral").is(":visible"))
        {
            $(".MenuLateral").slideUp("slow");
            $(".iconoMenuDesplegable").removeClass("efecto");
        }else{
            $(".MenuLateral").slideDown("slow");
            $(".iconoMenuDesplegable").addClass("efecto");
        }
    });
});
