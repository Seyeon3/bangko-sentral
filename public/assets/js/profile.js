$(document).ready(function () {

  $('#btnUploadProfilePicture').on('click', function () {
    modalUploadProfilePicture();
    $('#formUploadProfilePicture').submit(function (event) {
      event.preventDefault();
      var ready = true;
      var inputImage = $('#inputImage');
      var message = '';
      var imageFile = inputImage[0].files[0];
      var validFileTypes = ["image/jpeg", "image/png"];
      var maxSize = 5 * 1024 * 1024; // 5MB

      // Validate if file is empty
      if (!imageFile) {
        message += '<li>Please select an image.</li>';
        inputImage.addClass("is-invalid");
        ready = false;
      } else {
        // Validate file type
        if ($.inArray(imageFile.type, validFileTypes) == -1) {
          message += '<li>Invalid file type. Only JPG and PNG files are allowed</li>';
          inputImage.addClass("is-invalid");
          ready = false;
        } else if (imageFile.size > maxSize) { //validate file size
          message += '<li>File size exceeds 5MB limit.</li>';
          inputImage.addClass("is-invalid");
          ready = false;
        } else {
          inputImage.removeClass("is-invalid");
        }
      }

      // Display error messages if any
      if (!ready) {
        formAlert({
          container: '#alertPlaceholderUploadProfilePicture',
          type: 'danger',
          message: message
        });
      } else {
        spinButton('#btnUploadProfilePictureSave', true);
        var formData = new FormData();
        formData.append('image', imageFile);

        $.ajax({
          type: 'POST',
          url: 'myaccount/upload_profile_picture',
          data: formData,
          processData: false,
          contentType: false,
          dataType: 'json',
          success: function (response) {
            if (response.message === "success") {
              setSession('floating_alert', 'Image upload was successful');
              window.location.reload();
            } else {
              floatingAlert({
                type: 'danger',
                message: 'Failed to upload new image.'
              });
            }
            spinButton('#btnUploadProfilePictureSave', false); // Turn off the spinner after success response
          },
          error: function (error) {
            console.log('Error: ' + error);
            spinButton('#btnUploadProfilePictureSave', false); // Turn off the spinner after success response
          }
        });
      }
    });

  });


  $('#btnEditAccountDetails').on('click', function () {

    modalEditAccountDetails();

    //get_departments then get_account_details
    $.ajax({
      url: 'myaccount/get_departments',
      type: 'POST',
      dataType: 'json',
      success: function (departments) {
        let selectDepartment = $('#selectDepartment');
        // get_account_details
        $.ajax({
          url: 'myaccount/get_account_details',
          type: 'POST',
          dataType: 'json',
          success: function (data) {
            //data from database
            let department_id = data.department_id;
            let full_name = data.full_name;
            let email = data.email;

            // Handle inputFullName field
            // the selectDepartment is at the top
            let inputFullName = $('#inputFullName');
            let inputEmail = $('#inputEmail');


            // Clear any existing options
            selectDepartment.empty();

            // Populate the select element with departments and pre-select the retrieved department_id
            $.each(departments, function (index, department) {
              let selected = department.department_id === department_id ? 'selected' : '';
              selectDepartment.append('<option value="' + department.department_id + '" ' + selected + '>' + department.name + '</option>');
            });

            inputFullName.val(full_name || '');
            inputEmail.val(email || '');

            // form submitted / btn Edit Clicked
            $('#formEditAccountDetails').submit(function (event) {
              event.preventDefault();
              var ready = true;
              var selectDepartment = $(this).find('#selectDepartment');
              var inputFullName = $(this).find('#inputFullName');
              var inputEmail = $(this).find('#inputEmail');
              var message = '';

              // Validate Department
              if (!selectDepartment.val()) {
                message += '<li>Department must be selected.</li>';
                selectDepartment.addClass("is-invalid");
                ready = false;
              } else {
                selectDepartment.removeClass("is-invalid");
              }

              // Validate Full Name
              if (inputFullName.val().trim() === "") {
                message += '<li>Full Name cannot be empty.</li>';
                inputFullName.addClass("is-invalid");
                ready = false;
              } else {
                inputFullName.removeClass("is-invalid");
              }

              // Validate Email
              if (inputEmail.val().trim() === "") {
                message += '<li>Email cannot be empty.</li>';
                inputEmail.addClass("is-invalid");
                ready = false;
              } else {
                inputEmail.removeClass("is-invalid");
              }

              // Display error messages if any
              if (!ready) {
                formAlert({
                  container: '#alertPlaceholderEditAccountDetails',
                  type: 'danger',
                  message: message
                })
              } else {
                spinButton('#btnEditAccountDetailsSave', true);
                var formData = $('#formEditAccountDetails').serialize();
                $.ajax({
                  type: 'POST',
                  url: 'myaccount/edit_my_account_details',
                  data: formData,
                  dataType: 'json',
                  success: function (response) {
                    console.log(response);
                    if (response.message === "success") {
                      setSession('floating_alert', 'Account Details Update was successful');
                      window.location.reload();
                    } else {
                      floatingAlert({
                        type: 'danger',
                        message: 'Failed to upload new image.'
                      });
                    }
                    spinButton('#btnUploadProfilePictureSave', false); // Turn off the spinner after success response
                  },
                  error: function (error) {
                    console.log('Error: ' + error);
                    spinButton('#btnUploadProfilePictureSave', false); // Turn off the spinner after success response
                  }
                });
              }
            });

          },
          error: function (error) {
            console.error('Error fetching account details: ', error);
          }
        });
      },
      error: function (error) {
        console.error('Error fetching departments: ', error);
      }
    });
  });

  $('#btnEditUsername').on('click', function () {
    modalEditUsername();

    //get_my_username
    $.ajax({
      url: 'myaccount/get_my_username',
      type: 'POST',
      dataType: 'json',
      success: function (data) {
        let inputUsername = $('#inputUsername');
        inputUsername.val(data.username);

        // form submitted / btn edit/change Clicked
        $('#formEditUsername').submit(function (event) {

          event.preventDefault();

          var ready = true;
          var inputUsername = $(this).find('#inputUsername');
          var message = '';

          // Get the current username from a hidden input or data attribute
          var currentUsername = data.username; // Assuming a hidden input with id `currentUsername`
          var newUsername = inputUsername.val().trim();

          // Validate username
          if (newUsername === "") {
            message += '<li>Username cannot be empty.</li>';
            inputUsername.addClass("is-invalid");
            ready = false;
          } else if (newUsername === currentUsername) {
            message += '<li>Username has not changed.</li>';
            inputUsername.addClass("is-invalid");
            ready = false;
          } else {
            inputUsername.removeClass("is-invalid");
          }

          // Display error messages if any
          if (!ready) {
            formAlert({
              container: '#alertPlaceholderEditUsername',
              type: 'danger',
              message: message
            });
          } else {
            spinButton('#btnEditUsernameSave', true);
            var formData = $('#formEditUsername').serialize();

            //edit_my_username
            $.ajax({
              type: 'POST',
              url: 'myaccount/edit_my_username',
              data: formData,
              dataType: 'json',
              success: function (response) {
                if (response.message === "success") {
                  setSession('floating_alert', 'Username was successfully changed');
                  window.location.reload();
                } else if (response.message === "failed username already used") {
                  formAlert({
                    container: '#alertPlaceholderEditUsername',
                    type: 'danger',
                    message: 'Username is already used.'
                  });
                  $('#inputUsername').addClass("is-invalid");
                } else {
                  floatingAlert({
                    type: 'danger',
                    message: 'Failed to change username.'
                  });
                }
                spinButton('#btnEditUsernameSave', false); // Turn off the spinner after success or error response
              },
              error: function (error) {
                console.log('Error: ' + error);
                spinButton('#btnEditUsernameSave', false); // Turn off the spinner after error response
              }
            });
          }
        });

      },
      error: function (error) {
        console.error('Error fetching account details: ', error);
      }
    });





  });

  $('#btnChangePassword').on('click', function () {
    modalChangePassword();

    $('#formChangePassword').submit(function (event) {
      event.preventDefault();
      var ready = true;
      var inputCurrentPassword = $(this).find('#inputCurrentPassword');
      var inputNewPassword = $(this).find('#inputNewPassword');
      var inputConfirmPassword = $(this).find('#inputConfirmPassword');
      var message = '';

      // Validate current password
      if (inputCurrentPassword.val().trim() === "") {
        message += '<li>Current password cannot be empty.</li>';
        inputCurrentPassword.addClass("is-invalid");
        ready = false;
      } else {
        inputCurrentPassword.removeClass("is-invalid");
      }
      // Validate new password
      if (inputNewPassword.val().trim() === "") {
        message += '<li>New Password cannot be empty.</li>';
        inputNewPassword.addClass("is-invalid");
        ready = false;
      } else if (inputNewPassword.val().trim().length < 8 || inputNewPassword.val().trim().length > 20) {
        message += '<li>New password must be between 8 and 20 characters long.</li>';
        inputNewPassword.addClass("is-invalid");
        ready = false;
      } else {
        inputNewPassword.removeClass("is-invalid");
      }
      // Validate confirm password
      if (inputConfirmPassword.val().trim() === "") {
        message += '<li>Confirm password cannot be empty.</li>';
        inputConfirmPassword.addClass("is-invalid");
        ready = false;
      } else {
        inputConfirmPassword.removeClass("is-invalid");
        if (inputNewPassword.val().trim() !== inputConfirmPassword.val().trim()) {
          message += '<li>Confirm password do not match.</li>';
          inputConfirmPassword.addClass("is-invalid");
          ready = false;
        } else {
          inputConfirmPassword.removeClass("is-invalid");
        }
      }

      // Display error messages if any
      if (!ready) {
        formAlert({
          container: '#alertPlaceholderChangePassword',
          type: 'danger',
          message: message
        })
      } else {
        spinButton('#btnChangePasswordSave', true);
        var formData = $('#formChangePassword').serialize();
        $.ajax({
          type: 'POST',
          url: 'myaccount/change_my_password',
          data: formData,
          dataType: 'json',
          success: function (response) {
            console.log(response);
            switch (response.message) {
              case 'password not match':
                  formAlert({
                    container: '#alertPlaceholderChangePassword',
                    type: 'danger',
                    message: 'The current password you entered is incorrect.'
                  });
                  $('#inputCurrentPassword').addClass("is-invalid");
                break;
              case 'failed':
                formAlert({
                  container: '#alertPlaceholderChangePassword',
                  type: 'danger',
                  message: '<li>Failed.</li>'
                })
                break;
              case 'success':
                setSession('floating_alert', 'Password was successfully changed')
                window.location.reload();
                break;
            }
            spinButton('#btnChangePasswordSave', false);
          },
          error: function (error) {
            console.log('Error: ' + error);
            spinButton('#btnChangePasswordSave', false);
          }
        });
      }
    });





  });

});