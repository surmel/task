$(document).ready(function(){
    if ($(".errors").length) {
        setTimeout(function(){
            $(".errors").fadeOut('slow');
        },4000);
    }
    $('#people').DataTable();
});