$(document).ready(function () {
    $('#form-change-password').click(function (e) {
        let formChangePassword = $(this).closest('form');
        let data = formChangePassword.serialize();
        let url = formChangePassword.attr('action');
        $.ajax({
            url: url,
            type: "POST",
            data: data,
            dataType: 'JSON',
            success: function (result) {
                if (!result.status) {
                    formChangePassword.find('.alert').remove();
                    let errorsRequired = '<div class="alert" style="color: red ; height: 1px">' + result.message + '</div>';
                    let errorsOldPassword = '<div class="alert" style="color: red ; height: 1px">' + result.message['old_password'] + '</div>';
                    let errorsConfirmNewPassword = '<div class="alert"  style="color: red ; height: 1px">' + result.message['confirm_new_password'] + '</div>';
                    if (result.message['old_password']) {
                        formChangePassword.find('div.old-password').append(errorsOldPassword);
                    }
                    if (result.message['confirm_new_password']) {
                        formChangePassword.find('div.confirm-new-password').append(errorsConfirmNewPassword);
                    }
                    if (!result.required) {
                        formChangePassword.find('div.confirm-new-password').append(errorsRequired);
                    }
                    return;
                }
                if (result.status) {
                    swal({
                      title: "Đổi mật khẩu thành công!",
                      text: "Bạn cần đăng nhập lại!",
                      icon: "success",
                    })
                    .then((willDelete) => {
                      if (willDelete) {
                        location.href = result.data;
                      } else {
                        location.href = result.data;
                      }
                    });
                }
            }
        });
    })
});

function showModal(target) {
    let formChangePassword = $('#form-change-password').closest('form');
    formChangePassword.find('input[type = password]').val('');
    formChangePassword.find('.alert').remove();
    $(target).modal('show');
}
// hide messenge
$("div.alert").delay(3000).slideUp();