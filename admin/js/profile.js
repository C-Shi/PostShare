$(document).ready(function(){
  $('#change_password').on('click', function(){
    $(this).addClass('hidden');
    $("#clear_password").removeClass('hidden');
    $(this).after('<br/>')
    $("#password_reset").removeClass('hidden');
  })

  $('#clear_password').on('click', function(){
    $("input[type='password']").val('');
    $("#password_reset").addClass('hidden');
    $(this).addClass("hidden");
    $("br").remove();
    $("#change_password").removeClass("hidden");
  })
})