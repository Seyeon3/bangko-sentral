$(document).ready(function () {
  $('#formLogin').submit(function (event) {
    event.preventDefault();
    var ready = true;
    var inputEmailUsername = $(this).find('#inputEmailUsername');
    var inputPassword = $(this).find('#inputPassword');
    var message = '';

    // Validate email
    if (inputEmailUsername.val().trim() === "") {
      message += '<li>Email or Username cannot be empty.</li>';
      inputEmailUsername.addClass("is-invalid");
      ready = false;
    } else {
      inputEmailUsername.removeClass("is-invalid");
    }

    // Validate password
    if (inputPassword.val().trim() === "") {
      message += '<li>Password cannot be empty.</li>';
      inputPassword.addClass("is-invalid");
      ready = false;
    } else {
      inputPassword.removeClass("is-invalid");
    }

    if (!ready) {
      formAlert({
        container: '#alertPlaceholder',
        type: 'danger',
        message: message,
      });
    } else {
      spinButton('#buttonLogin', true);
      var formData = $('#formLogin').serialize();
      $.ajax({
        type: 'POST',
        url: 'login/login_form_submit',
        data: formData,
        dataType: 'json',
        success: function (response) {
          switch (response.message) {
            case 'email username invalid':
              formAlert({
                container: '#alertPlaceholder',
                type: 'danger',
                message: '<li>Your email or username is invalid.</li>'
              });
              $('#inputEmailUsername').addClass("is-invalid");
              break;
            case 'password invalid':
              formAlert({
                container: '#alertPlaceholder',
                type: 'danger',
                message: '<li>Your password is invalid.</li>'
              });
              $('#inputPassword').addClass("is-invalid");
              break;
            case 'suspended':
              formAlert({
                container: '#alertPlaceholder',
                type: 'danger',
                message: '<li>Your account has been suspended.</li>'
              });
              $('#inputEmailUsername').addClass("is-invalid");
              break;
            case 'banned':
              formAlert({
                container: '#alertPlaceholder',
                type: 'danger',
                message: '<li>Your account has been banned.</li>'
              });
              $('#inputEmailUsername').addClass("is-invalid");
              break;
            case 'success':
              $('#formLogin #inputEmail').val('');
              $('#formLogin #inputPassword').val('');
              setSession('floating_alert', 'login success')
              window.location.href = 'dashboard';
              break;
          }
          spinButton('#buttonLogin', false); // Turn off the spinner after success response
        },
        error: function (error) {
          console.log('Error: ' + error);
          spinButton('#buttonLogin', false); // Turn off the spinner after error response
        }
      });
    }
  });
});
