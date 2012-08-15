
$(document).ready(function() {

    $("#navigation").menu();
    $("#navigation li").each(function (i) {
        $(this).click(function( event ) {
            $(location).attr("href",$(this).find("a").attr( "href" ));
        });
    });
});

