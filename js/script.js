(function($){
  $(function(){

    $('.button-collapse').sideNav();
    $('.parallax').parallax();
    $('select').material_select();
    $(document).on("click",".login-button",function(){
      var form = $(this).closest("form");
      form.submit();
   });

  }); // end of document ready
})(jQuery); // end of jQuery name space
