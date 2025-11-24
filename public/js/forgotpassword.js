$(document).ready(function () {
    $('#forgot-password-form').on('submit', function (e) {
        e.preventDefault();
        var email = $('#forgot_email').val();
        $.ajax({
            url: "/forgot-password/send-otp",
            method: 'POST',
            data: {
                email: email
            },
            headers: {
                "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
            },
            success: function (res) {
                // alert(res.message);
                toastr.success(res.message, "Success", {
                    closeButton: true,
                    progressBar: true,
                    positionClass: "toast-top-right",
                    timeOut: 2000
                });
                $('#forgotPasswordModal').fadeOut();
                $('#verifyOtpModal').css('display', 'flex');
                $('#verifyOtpModal').fadeIn();
                $('#otp_email').val(email); // Fill hidden email field
                // Redirect to OTP verification page if needed
            },
            error: function (xhr) {
                if (xhr.status === 422 || xhr.status === 404) {
                    alert(xhr.responseJSON.message);
                } else {
                    alert('An error occurred.');
                }
            }
        });
    });

    $('#verify-otp-form').on('submit', function (e) {
        e.preventDefault();

        let email = $('#otp_email').val();
        let otp = $('#otp').val();

        $.ajax({
            url: "/forgot-password/verify-otp",
            method: 'POST',
            data: {
                email: email,
                otp: otp
            },
            headers: {
                "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
            },
            success: function (res) {
                // alert(res.message);
                toastr.success(res.message, "Success", {
                    closeButton: true,
                    progressBar: true,
                    positionClass: "toast-top-right",
                    timeOut: 2000
                });
                $('#verifyOtpModal').fadeOut();
                // Optionally redirect to password reset form
            },
            error: function (xhr) {
                alert(xhr.responseJSON.message || 'Verification failed.');
            }
        });
    });


    $(document).on('submit', '#reset-password-form', function (e) {
        e.preventDefault();

        let form = $(this);
        // let url = "{{ route('reset.password.submit') }}";
        let formData = form.serialize();

        $.ajax({
            url: "/reset-password",
            type: 'POST',
            data: formData,
            headers: {
                "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
            },
            success: function (response) {
                $('#reset-password-message').text('Password has been reset successfully! Redirecting to login...');
                setTimeout(function () {
                    window.location.href = "{{ route('hr-login-page') }}"; 
                }, 2000);
            },
            error: function (xhr) {
                let msg = 'Something went wrong.';
                if (xhr.responseJSON && xhr.responseJSON.message) {
                    msg = xhr.responseJSON.message;
                }
                $('#reset-password-message').css('color', 'red').text(msg);
            }
        });
    });

    // user reset password
    $('#forgot-password-form-user').on('submit', function (e) {
        e.preventDefault();
        console.log("otp send clicked");
        var email = $('#forgot_email').val();
        $.ajax({
            url: "/forgot-password/send-otp",
            method: 'POST',
            data: {
                email: email
            },
            headers: {
                "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
            },
            success: function (res) {
                // alert(res.message);
                toastr.success(res.message, "Success", {
                    closeButton: true,
                    progressBar: true,
                    positionClass: "toast-top-right",
                    timeOut: 2000
                });
                $('#forgotPasswordModalUser').fadeOut();
                $('#verifyOtpModalUser').css('display', 'flex');
                $('#verifyOtpModalUser').fadeIn();
                $('#otp_email').val(email); // Fill hidden email field
                // Redirect to OTP verification page if needed
            },
            error: function (xhr) {
                if (xhr.status === 422 || xhr.status === 404) {
                    alert(xhr.responseJSON.message);
                } else {
                    alert('An error occurred.');
                }
            }
        });
    });

    $('#verify-otp-form-user').on('submit', function (e) {
        e.preventDefault();

        let email = $('#otp_email').val();
        let otp = $('#otp').val();

        $.ajax({
            url: "/forgot-password/verify-otp",
            method: 'POST',
            data: {
                email: email,
                otp: otp
            },
            headers: {
                "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
            },
            success: function (res) {
                // alert(res.message);
                toastr.success(res.message, "Success", {
                    closeButton: true,
                    progressBar: true,
                    positionClass: "toast-top-right",
                    timeOut: 2000
                });
                $('#verifyOtpModalUser').fadeOut();
                // Optionally redirect to password reset form
            },
            error: function (xhr) {
                alert(xhr.responseJSON.message || 'Verification failed.');
            }
        });
    });

    $(document).on('submit', '#reset-password-form-user', function (e) {
        e.preventDefault();

        let form = $(this);
        // let url = "{{ route('reset.password.submit') }}";
        let formData = form.serialize();

        $.ajax({
            url: "/reset-password",
            type: 'POST',
            data: formData,
            headers: {
                "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
            },
            success: function (response) {
                $('#reset-password-message-user').text('Password has been reset successfully! Redirecting to login...');
                setTimeout(function () {
                    window.location.href = "{{ route('hr-login-page') }}"; 
                }, 2000);
            },
            error: function (xhr) {
                let msg = 'Something went wrong.';
                if (xhr.responseJSON && xhr.responseJSON.message) {
                    msg = xhr.responseJSON.message;
                }
                $('#reset-password-message-user').css('color', 'red').text(msg);
            }
        });
    });


    // user reset password
});