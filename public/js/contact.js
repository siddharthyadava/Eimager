$(document).ready(function () { 
    $('.contact-submit').click(function(e) {
        e.preventDefault();
        $('.error-message').remove(); // Remove previous error messages
        $.ajax({
            url: "/contact/submit",
            type: "POST",
            data: {
                ca_name: $('#ca_name').val(),
                ca_email: $('#ca_email').val(),
                ca_number: $('#ca_number').val(),
                ca_address: $('#ca_address').val(),
                ca_type: $('#ca_type').val(),
                ca_message: $('#ca_message').val(),
                // _token: "{{ csrf_token() }}"
            },
            headers: {
                "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
            },
            success: function(response) {
                // alert(response.success);
                Swal.fire({
                    title: "Success!",
                    text: response.success,
                    icon: "success",
                    timer: 2000, // Auto close after 2 seconds
                    showConfirmButton: false
                });
                $('form')[0].reset(); // Reset the form after submission
            },
            error: function(xhr) {
                // alert('Error! Please check your inputs.');
                if (xhr.status === 422) {
                    let errors = xhr.responseJSON.errors;
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