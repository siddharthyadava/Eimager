
$(document).ready(function () {
    $('#career_submit').click(function (e) {
        e.preventDefault();
        $('.error-message').remove(); // Remove previous error messages
        $.ajax({
            url: "/career/submit",
            type: "POST",
            data: {
                career_name: $('#career_name').val(),
                career_email: $('#career_email').val(),
                career_contact_number: $('#career_contact_number').val(),
                career_current_designation: $('#career_current_designation').val(),
                career_applied_post: $('#career_applied_post').val(),
                career_total_experience: $('#career_total_experience').val(),
                career_current_ctc: $('#career_current_ctc').val(),
                career_expected_ctc: $('#career_expected_ctc').val(),
                career_notice_period: $('#career_notice_period').val(),
            },
            headers: {
                "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
            },
            success: function (response) {
                Swal.fire({
                    title: "Success!",
                    text: response.success,
                    icon: "success",
                    timer: 2000, // Auto close after 2 seconds
                    showConfirmButton: false
                });
                $('#career_form')[0].reset(); 
                setTimeout(function () {
                    $('#careerModal').hide(); 
                }, 3000);
            },
            error: function (xhr) {
                if (xhr.status === 422) {
                    let errors = xhr.responseJSON.errors;
                    // $.each(errors, function (key, value) {
                    //     let field = $('input[placeholder="' + key.replace('career_', '').replace('_', ' ') + '"]');
                    //     if (field.length) {
                    //         field.after('<span class="error-message" style="color: red; font-size: 14px;">' + value[0] + '</span>');
                    //     }
                    // });
                    $.each(errors, function (key, value) {
                        let field = $('#' + key);
                        if (field.length) {
                            field.after('<span class="error-message" style="color: red; font-size: 14px;">' + value[0] + '</span>');
                        }
                    });
                } else {
                    Swal.fire({
                        title: "Error!",
                        text: "Something went wrong. Please try again.",
                        icon: "error"
                    });
                }
            }
        });
    });
});
