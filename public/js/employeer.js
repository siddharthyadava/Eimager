$(document).ready(function () {

    // employee profile image upload
       
    $("#uploadProfileImagehr").on("submit", function (e) {
        e.preventDefault();
        let formData = new FormData();
        formData.append("profile_image", $("#profileimage")[0].files[0]); // Get image file
        formData.append("hr_unique_id", $("#hr_unique_id").val()); // Get unique_id from hidden input
        $.ajax({
            url: "/upload-profile-image-hr",
            type: "POST",
            data: formData,
            processData: false,
            contentType: false,
            headers: {
                "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
            },
            beforeSend: function () {
                $("#uploadBtnhr").prop("disabled", true).text("Uploading...");
            },
            success: function (response) {
                if (response.success) {
                    toastr.success("Profile image updated successfully!", "Success", {
                        timeOut: 2000,
                        positionClass: "toast-top-center",
                        progressBar: true,
                        closeButton: true
                    });

                    // Update profile image preview
                    $("#profile_preview").attr("src", response.image_url);
                } else {
                    toastr.error("Failed to update profile image. Try again.", "Error", {
                        timeOut: 3000,
                        positionClass: "toast-top-center",
                        progressBar: true,
                        closeButton: true
                    });
                }
            },
            error: function () {
                toastr.error("Something went wrong. Please try again!", "Error", {
                    timeOut: 3000,
                    positionClass: "toast-top-center",
                    progressBar: true,
                    closeButton: true
                });
            },
            complete: function () {
                $("#uploadBtnhr").prop("disabled", false).text("Upload");
            }
        });
    });
    
    // employee profile image upload
    $('#employee_search_btn').click(function () {
        var e_id = $('#eimager_id_seach_input').val();
        var a_number = $('#aadhar_number_search_input').val();
        var p_number = $('#pan_number_search_input').val();
        var p_email = $('#email_search_input').val();

        console.log(e_id, !e_id);
        console.log(a_number, !a_number);
        console.log(p_number, !p_number);
        console.log(p_email, !p_email);

        if (!e_id && !a_number && !p_number && !p_email) {
            $("#infoModalMsgBox").text("Please provide either EImager Id or Aadhar Number or PAN number or email Id");
            $('#informationModal').fadeIn();
            return;
        }

        let formData = {
            eimagerId: e_id,
            aadharNumber: a_number,
            panNumber: p_number,
            email: p_email,
        };

        $.ajax({
            url: "/hr/employeeprofilesearch",
            type: "POST",
            data: formData,
            success: function (response) {
                if (response.success) {
                    let profileData = response.data;
                    console.log(profileData);
                    $("#eimager_id_hidden").text(profileData.unique_id);
                    $("#user_first_name").text(profileData.first_name);
                    $("#user_type").text('Employee');
                    $("#user_mobile_number").text(profileData.phone_number);
                    $("#user_dob").text(profileData.dob);
                    $("#user_email").text(profileData.email);
                    $("#user_aadhar_number").text(profileData.aadhar_number);
                    $("#user_pan_number").text(profileData.pan_number);
                    $("#user_facebook").text(profileData.facebook);
                    $("#user_linkedin").text(profileData.linkedin);
                    $("#user_twitter").text(profileData.twitter);
                    $("#profile_preview").attr("src", profileData.profile_image);
                    $("#user_profile_experience_section").addClass("show");
                    $('#user_profile_experience_section').removeClass("hide");

                    if (!profileData.facebook) {
                        $('#fb_li').removeClass("show");
                        $("#fb_li").addClass("hide");
                    }
                    if (!profileData.linkedin) {
                        $('#linkedin_li').removeClass("show");
                        $("#linkedin_li").addClass("hide");
                    }
                    if (!profileData.twitter) {
                        $('#twitter_li').removeClass("show");
                        $("#twitter_li").addClass("hide");
                    }
                    // loadExperienceByEimagerId();
                    // loadComplaint();
                } else {
                    $("#infoModalMsgBox").text(response.message);
                    $('#informationModal').fadeIn();
                    return;
                }
            },
            error: function (xhr) {
                alert("Error: " + xhr.responseText);
            }
        });
    });
//     $("#submitOtp").on("click", function (e) {
//     e.preventDefault();

//     let otp = $("#otpInput").val().trim();
//     let hrEimagerId = $("#eimagerid").text().trim();
//     let employeeEImagerId = $("#eimager_id_hidden").val().trim();

//     if (!otp) {
//         toastr.error("Please enter OTP", "Error");
//         return;
//     }

//     $.ajax({
//         url: "/hr/verify-otp",
//         type: "POST",
//         data: {
//             otp: otp,
//             eimagerId: hrEimagerId,
//             employeeEImagerId: employeeEImagerId,
//         },
//         headers: {
//             "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
//         },
//         success: function (response) {
//             if (response.success) {
//                 toastr.success("OTP verified, full profile unlocked!", "Success");
//                 // TODO: show sensitive info (dob, email, etc.)
//             } else {
//                 toastr.error(response.message || "Invalid OTP", "Error");
//             }
//         },
//         error: function (xhr) {
//             console.error(xhr.responseText);
//             toastr.error("An error occurred. Please try again.", "Error");
//         }
//     });
// });


    $("#send_otp").on("click", function (e) {
        let $btn = $(this); // Store button reference
        $btn.prop("disabled", true).text("Please wait..."); // Disable and change text
        let formData = {
            eimagerId: $('#eimagerid').text(),
            employeeEmail: $('#user_email').text(),
            employeeEImagerId: $('#eimager_id_hidden').text().trim(),
        };

        // console.log('-----> ', formData);
        $.ajax({
            url: "/hr/profileotprequest",
            type: "POST",
            data: formData,
            headers: {
                "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
            },
            success: function (response) {
                if (response.success) {
                    // alert("Otp Sent successfuly"); 
                    toastr.success("Otp Sent successfuly", "Success", {
                        timeOut: 1500,  // Disappears after 1.5 seconds
                        progressBar: true, // Show progress bar
                        closeButton: true, // Show close button
                        positionClass: "toast-top-right" // Center position
                    });
                    // $('.verify-otp').show(); 
                    $('#otpForm').show();
                }
                else {
                    toastr.error("OTP not send. Please try again.", "Error", {
                        timeOut: 3000,  // Disappears after 3 seconds
                        progressBar: true,
                        closeButton: true,
                        positionClass: "toast-top-right"
                    });
                }

            },
            error: function (xhr) {
                toastr.error("An error occurred. Please try again.", "Error", {
                    timeOut: 3000,
                    progressBar: true,
                    closeButton: true,
                    positionClass: "toast-top-right"
                });
            },
            complete: function () {
                $btn.prop("disabled", false).text("Send OTP to See Profile"); // Re-enable button and reset text
            }
        });
    });

    // experience
    function loadExperienceByEimagerId() {
        console.log(' loadExperienceByEimagerId.....');
        let employee_eimager_id = $('#eimager_id_hidden').text().trim();
        let eimager_id = $('#eimagerid').text().trim();
        if (employee_eimager_id.trim() === '') {
            employee_eimager_id = document.getElementsByName("eimager_id")[0].value;
        }

        if (employee_eimager_id) {
            $.ajax({
                url: "/hr/experienceByEimagerId", // Laravel login route
                type: "GET",
                data: {
                    eimager_id: eimager_id,
                    employee_eimager_id: employee_eimager_id,
                },
                headers: {
                    "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
                },
                success: function (response) {

                    if (response.success) {
                        $("#user_exp_list_comp").empty();
                        let allexp = response.data;
                        $.each(allexp, function (i, item) {
                            console.log(item.is_approval_visible, );
                            var approval_status_class = 'color-orange';
                            var review_button_class = '';
                            var review_button_display_class = 'hide';
                            var already_approved_or_reject_class = '';
                            if (item.approval_status == null) {
                                item.approval_status = 'Not Initiated'
                            } else if (item.approval_status.toLowerCase() == 'pending') {
                                item.approval_status = 'Pending';
                                approval_status_class = 'color-yellow';
                            } else if (item.approval_status.toLowerCase() == 'approved') {
                                item.approval_status = 'Approved';
                                review_button_class = 'hide-and-remove-element';
                                approval_status_class = 'color-green';
                                already_approved_or_reject_class = 'hide';
                            } else if (item.approval_status.toLowerCase() == 'rejected') {
                                item.approval_status = 'Rejected';
                                approval_status_class = 'color-red';
                                already_approved_or_reject_class = 'hide';
                            }
                            if (item.status_note == null) { item.status_note = 'N/A' }
                            if (item.is_approval_visible) {
                                review_button_display_class = 'show-inline'
                            }

                            let exp_item = `
                                        <div class="card-component" id="expid-`+ item.exp_id + `">
                                            
                                        <div class="card-component2">
                                            <div style="width: 50%; float:left">
                                            <span class="font-15 text-secondary me-2 font-weight-600">Company Name:</span> <span >`+ item.company_name + `</span>
                                            </div>

                                            <div style="width: 50%; float:right">
                                            <span class="font-15 text-secondary me-2 font-weight-600">Designation:</span> <span >`+ item.designation + `</span>
                                            </div>
                                        </div>
                                        <div class="card-component2">
                                            <div style="width: 50%; float:left">
                                            <span class="font-15 text-secondary me-2 font-weight-600">DOJ:</span> <span >`+ item.start_date + `</span>
                                            </div>

                                            <div style="width: 50%; float:right">
                                            <span class="font-15 text-secondary me-2 font-weight-600">LWD:</span> <span>`+ item.end_date + `</span>
                                            </div>
                                        </div>
                                        <div class="card-component2">
                                            <div style="width: 100%; float:left">
                                            <span class="font-15 text-secondary me-2 font-weight-600">Projects:</span> <span id='user_mobile_number'>`+ item.projects + `</span>
                                            </div>
                                        </div>
                                        <div class="card-component2">
                                            <div style="width: 50%; float:left">
                                            <span class="font-15 text-secondary me-2 font-weight-600">CTC (P/A):</span> <span id='user_mobile_number'>`+ item.ctc + `</span>
                                            </div>

                                            <div style="width: 50%; float:right">
                                            <span class="font-15 text-secondary me-2 font-weight-600">In hand (P/A - Approx):</span> <span id='user_mobile_number'>`+ item.in_hand + `</span>
                                            </div>
                                        </div>
                                        <div class="card-component2">
                                            <div style="width: 100%; float:left">
                                            <span class="font-15 text-secondary me-2 font-weight-600">Roles & Responsibilites:</span> <span id='user_mobile_number'>`+ item.roles_responsibility + `</span>
                                            </div>
                                        </div>
                                        <div class="card-component2">
                                            <div style="width: 50%; float:left">
                                            <span class="font-15 text-secondary me-2 font-weight-600">Approval Status:</span> 
                                            <span class="`+ approval_status_class + `">` + item.approval_status + `</span>
                                            </div>

                                            <div style="width: 50%; float:right">
                                            <span class="font-15 text-secondary me-2 font-weight-600">Approval Feedback:</span> <span class='tag'>`+ item.status_note + `</span>
                                            </div>
                                        </div>
                                        <div class="card-component2 `+ review_button_class + ` ` + review_button_display_class + `">
                                            <div style="width: 50%; float:left ">
                                            <button class="`+ already_approved_or_reject_class + ` btn btn-success open-approval-modal send_approval_rejection_otp1" 
                                                data-exp-id="`+ item.exp_id + `" data-status="approved">
                                                Approve
                                            </button>
                                            <button class="`+ already_approved_or_reject_class + ` btn btn-danger open-approval-modal send_approval_rejection_otp1" 
                                                data-exp-id="`+ item.exp_id + `" data-status="rejected">
                                                Reject
                                            </button>
                                            <button class="btn btn-primary open-last-working-day-modal send_approval_rejection_otp1" 
                                                data-exp-id="`+ item.exp_id + `" data-status="Update Experience">
                                                Update Experience
                                            </button>
                                            </div>
                                            <div style="width: 50%; float:right ">
                                            </div>

                                        </div>

                                        </div>
                                    `;


                            $("#user_exp_list_comp").append(exp_item);
                        });
                    }
                },
                error: function (xhr) {
                    let errors = xhr.responseJSON ? xhr.responseJSON.errors : null;
                    if (errors) {
                        if (errors.unique_id) {
                            $("#unique_id").siblings(".error").text(errors.unique_id[0]);
                        }
                        if (errors.password) {
                            $("#password").siblings(".error").text(errors.password[0]);
                        }
                        if (!errors.password && !errors.unique_id) {
                            // alert("Please enter valid IE Id and password");
                        }
                    } else {
                        // alert("Invalid credentials. Please try again.");
                    }
                },
            });
        }
    }


    $(document).on('click', '#openApprovalModalBtn', function () {
        expId = $(this).parent().parent().parent().attr('id');
        window.expId = expId;
        $('#approvalRejectionModal').modal('show');
        console.log('-----------------------',);
    });

    // qualification 
    function loadQualification() {
        let eimager_id = '';
        eimager_id = $('#eimager_id_hidden').text().trim();
        if (eimager_id.trim() === '') {
            eimager_id = document.getElementsByName("eimager_id")[0].value;
        }
        if (eimager_id) {
            $.ajax({
                url: "/qualification/allQualification", // Laravel login route
                type: "GET",
                data: {
                    eimagerId: eimager_id,
                },
                headers: {
                    "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
                },
                success: function (response) {

                    if (response.success) {
                        console.log('loadQualification-------------------->>>>>>>>>>>>>. ', response.success);
                        $("#user_qualification_list_comp").empty();
                        let allexp = response.data;
                        console.log(allexp);
                        console.log("1234");
                        $.each(allexp, function (i, item) {


                            let qualification_item = `
                                        <div class="card-component" id="expid-`+ item.qualification_id + `">
                                            
                                        <div class="card-component2">
                                            <div style="width: 50%; float:left">
                                            <span class="font-15 text-secondary me-2 font-weight-600">School:</span> <span >`+ item.school + `</span>
                                            </div>

                                            <div style="width: 50%; float:right">
                                            <span class="font-15 text-secondary me-2 font-weight-600">Degree:</span> <span >`+ item.degree + `</span>
                                            </div>
                                        </div>
                                        <div class="card-component2">
                                            <div style="width: 50%; float:left">
                                            <span class="font-15 text-secondary me-2 font-weight-600">DOJ:</span> <span >`+ item.start_date + `</span>
                                            </div>

                                            <div style="width: 50%; float:right">
                                            <span class="font-15 text-secondary me-2 font-weight-600">LWD:</span> <span>`+ item.end_date + `</span>
                                            </div>
                                        </div>
                                        <div class="card-component2">
                                            <div style="width: 50%; float:left">
                                            <span class="font-15 text-secondary me-2 font-weight-600">Study:</span> <span id='user_mobile_number'>`+ item.study + `</span>
                                            </div>

                                            <div style="width: 50%; float:right">
                                            <span class="font-15 text-secondary me-2 font-weight-600">Grade:</span> <span id='user_mobile_number'>`+ item.grade + `</span>
                                            </div>
                                        </div>
                                        <div class="card-component2">
                                            <div style="width: 100%; float:left">
                                            <span class="font-15 text-secondary me-2 font-weight-600">Description:</span> <span id='user_mobile_number'>`+ item.description + `</span>
                                            </div>
                                        </div>
                                        

                                        </div>
                                    `;



                            $("#user_qualification_list_comp").append(qualification_item);
                        });
                    }
                },
                error: function (xhr) {
                    console.log('-------------------->>>>>>>>>>>>>Qualification...... ', xhr);
                    let errors = xhr.responseJSON ? xhr.responseJSON.errors : null;
                    if (errors) {
                        if (errors.unique_id) {
                            $("#unique_id").siblings(".error").text(errors.unique_id[0]);
                        }
                        if (errors.password) {
                            $("#password").siblings(".error").text(errors.password[0]);
                        }
                        if (!errors.password && !errors.unique_id) {
                            // alert("Please enter valid IE Id and password");
                        }
                    } else {
                        // alert("Invalid credentials. Please try again.");
                    }
                },
            });
        }
    }
    // qualification

    let currentStep = 1;
    console.log(currentStep);
    console.log("Before any button hit");
    const totalSteps = $(".formContainer").length;
    console.log(totalSteps);
    function showStep(step) {
        $(".formContainer").addClass("hide");
        $(`.formContainer[data-step="${step}"]`).removeClass("hide");
        $(".step").removeClass("active");
        $(`.step[data-step="${step}"]`).addClass("active");
        $(".vertical-progress-bar-fill").css("height", ((step - 1) / (totalSteps - 1)) * 100 + "%");
        $(".prev").toggleClass("hideBtn", step === 1);
        $(".next").text(step === totalSteps ? "Submit" : "Next Step").attr("data-step", step);
    }
    function validateStep(step) {
        let isValid = true;
        $(`.formContainer[data-step="${step}"] input`).each(function () {
            if ($(this).val().trim() === "" &&  !($(this).data('ignore'))) {
                $(this).siblings(".error").remove();
                $(this).after("<span class='error' style='color: red; font-size: 12px;'>This field is required</span>");
                isValid = false;
            } else {
                $(this).siblings(".error").remove();
            }
        });
        return isValid;
    }

    $("#hr_aadhar").on("input", function() {
        inputVal = $(this).val();
        if(inputVal.length>14) {
            inputVal = inputVal.substring(0,14);
        }
        value = formatCardNumber(inputVal);
        $("#hr_aadhar").val(value);
    });

    $("#hr_phone").on("input", function() {
        inputVal = $(this).val();
        if(inputVal.length>10) {
            inputVal = inputVal.substring(0,10);
        }
        $("#hr_phone").val(inputVal);
    });

    function updateSummary() {
        $("#s_hr_name").text($("#hr_name").val() || "N/A");
        $("#s_hr_email").text($("#hr_email").val() || "N/A");
        $("#s_hr_phone").text($("#hr_phone").val() || "N/A");
        $("#s_company_name").text($("#company_name").val() || "N/A");
        $("#s_reporting_manager_mail").text($("#reporting_manager_mail").val() || "N/A");
        $("#s_hr_aadhar").text($("#hr_addhar_hidden").val() || "N/A");
        $("#s_hr_pan").text($("#hr_pan_hidden").val() || "N/A");
        $("#s_hr_dob").text($("#hr_dob_hidden").val() || "N/A");
        $("#s_hr_unique_id").text($("#hr_unique_hidden").val()); // Show Unique ID in summary

        if (currentStep === 4) {
            $(".next").hide();
        }
    }


    $("#closeOtpModal").on("click", function () {
        // $("#otpModal").hide();
        $("#otpModal").hide();
        $(".formContainer").hide();
        $(".formContainer[data-step='1']").removeClass("hide").show();
    });
    $(".next").on("click", function () {
        // currentStep++;
        let $this = $(this); // Store reference to the button
        console.log($this);

        // Disable button and show loading text
        $this.prop("disabled", true).text("Loading...");

        if (!validateStep(currentStep)) {
            $this.prop("disabled", false).text("Next"); // Re-enable button if validation fails
            return;
        }
        // if (!validateStep(currentStep)) return;
        console.log('---', currentStep);
        if (currentStep < totalSteps) {
            if (currentStep === 1) {
                // Validate password confirmation
                const password = $("#hr_password").val();
                const confirmPassword = $("#hr_password_confirmation").val();
                
                if (password !== confirmPassword) {
                    $("#hr_password_confirmation").after('<p class="error-message" style="color: red;">Password and confirm password do not match.</p>');
                    $this.prop("disabled", false).text("Next");
                    return;
                }
                // Submit Step 1 data via AJAX
                let formData = {
                    company_name: $("#company_name").val(),
                    hr_name: $("#hr_name").val(),
                    hr_email: $("#hr_email").val(),
                    hr_phone: $("#hr_phone").val(),
                    hr_password: $("#hr_password").val(),
                    hr_password_confirmation: $("#hr_password_confirmation").val(),
                    _token: $('meta[name="csrf-token"]').attr('content') // CSRF Token
                };
                $.ajax({
                    url: "/hr/register-step1",
                    type: "POST",
                    data: formData,
                    dataType: "json",
                    success: function (response) {
                        // currentStep++;
                        if (response.success) {
                            console.log(response);
                            $("#otpModal").show();
                            $("#otpCode").text(response.otp);
                            // Store HR ID for next steps
                            $("#hr_email_hidden").val(response.hr_email);
                            $("#hr_unique_hidden").val(response.hr_unique_id);
                        }
                    },
                    error: function (xhr) {
                        if (xhr.status === 422) {
                            let errors = xhr.responseJSON.errors;
                            $(".error-message").remove(); // Remove previous error messages

                            $.each(errors, function (key, messages) {
                                console.log('error ::- ', key);
                                if(key === 'hr_email') {
                                    checkPartiallyCreatedAccount($("#hr_email").val())
                                }
                                $("#" + key)
                                    .after('<p class="error-message" style="color: red;">' + messages[0] + "</p>");
                            });
                        }
                    },
                    complete: function () {
                        // Re-enable button and reset text after AJAX completes
                        $this.prop("disabled", false).text("Next");
                        // showStep(currentStep);
                        console.log('---', currentStep);

                    }
                });
                return; // Stop execution to wait for OTP input
            }
            // step 2 
            if (currentStep === 2) {
                updateSummary();
                 let formData = {
                    hr_email: $("#hr_email_hidden").val(),
                    hr_aadhar: $("#hr_aadhar").val().replace(/\s/g, ""),
                    hr_pan: $("#hr_pan").val(),
                    hr_dob: $("#hr_dob").val(),
                    // hr_unique_id: $("#hr_unique_id").val(),
                    _token: $('meta[name="csrf-token"]').attr("content"),
                };
                // updateSummary();
                $.ajax({
                    url: "/hr/register-step2",
                    type: "POST",
                    data: formData,
                    dataType: "json",
                    success: function (response) {
                        if (response.success) {
                            console.log(response);
                            console.log(response.data.hr_aadhar);
                            toastr.success("Hr 2 nd step Registration Successful", "Success", {
                                timeOut: 3000,
                                progressBar: true,
                                closeButton: true,
                                positionClass: "toast-top-right"
                            });
                            $("#hr_addhar_hidden").val(response.data.hr_aadhar);
                            $("#hr_pan_hidden").val(response.data.hr_pan);
                            $("#hr_dob_hidden").val(response.data.hr_dob);
                            currentStep++;
                            showStep(currentStep);
                            updateSummary();
                            $("#hr_aadhar, #hr_pan, #hr_dob").val("");

                        }
                    },
                    error: function (xhr) {
                        if (xhr.status === 422) {
                            let errors = xhr.responseJSON.errors;
                            $(".error-message").remove(); // Remove previous error messages

                            $.each(errors, function (key, messages) {
                                $("#" + key)
                                    .after('<p class="error-message" style="color: red;">' + messages[0] + "</p>");
                            });
                        }
                    },
                    complete: function () {
                        // Re-enable button and reset text after AJAX completes
                        $this.prop("disabled", false).text("Next");
                        // showStep(currentStep);
                        console.log('---', currentStep);

                    }
                });
                return; // Stop execution to wait for OTP input
            }
            // currentStep++;
            if (currentStep === 3) {
                updateSummary();
                let formData = {
                    hr_email: $("#hr_email_hidden").val(),
                    reporting_manager_mail: $("#reporting_manager_mail").val(),
                    reporting_manager_name: $("#reporting_manager_name").val(),
                    reporting_manager_contact: $("#reporting_manager_contact").val(),
                    company_website: $("#company_website").val(),
                    // hr_unique_id: $("#hr_unique_id").val(),
                    _token: $('meta[name="csrf-token"]').attr("content"),
                };
                $.ajax({
                    url: "/hr/register-step3",
                    type: "POST",
                    data: formData,
                    dataType: "json",
                    success: function (response) {
                        if (response.success) {
                            toastr.success("Hr 3rd step Registration Successful", "Success", {
                                timeOut: 3000,
                                progressBar: true,
                                closeButton: true,
                                positionClass: "toast-top-right"
                            });
                            $("#reporting_manager_mail, #reporting_manager_name, #reporting_manager_contact , #company_website").val("");
                            currentStep++;
                            showStep(currentStep);
                        }
                        setTimeout(() => {
                            // ✅ Reset the form fields after success
                            $("#unique_id").val("");
                            $("#password").val("");
                
                            // Redirect user to the dashboard
                            window.location.href = response.redirect;
                        }, 1000);
                    },
                    error: function (xhr) {
                        if (xhr.status === 422) {
                            let errors = xhr.responseJSON.errors;
                            $(".error-message").remove(); // Remove previous error messages

                            $.each(errors, function (key, messages) {
                                $("#" + key)
                                    .after('<p class="error-message" style="color: red;">' + messages[0] + "</p>");
                            });
                        }
                    },
                    complete: function () {
                        // Re-enable button and reset text after AJAX completes
                        $this.prop("disabled", false).text("Next");
                        // showStep(currentStep);
                        console.log('---', currentStep);

                    }
                });

                return; // Stop execution to wait for OTP input
            }
            // currentStep++;
            if (currentStep === 3 || currentStep === 4) {
                // Remove disabled class for steps 3 and 4
                $this.prop("disabled", false).text("Next");
            }
            if (currentStep === 4) {
                updateSummary();
            }
            showStep(currentStep);
        } else {
            // alert("Form submitted successfully!");
            submitFormData();
        }
    });
    
    function checkPartiallyCreatedAccount(hremail) {
        let formData = {
            hr_email: hremail,
        };

        $.ajax({
            url: "/hr/checkpartialregistration",
            type: "POST",
            data: formData,
            headers: {
                "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
            },
            success: function (response) {
                if (response.success) {
                   if(response.data) {
                       console.log('Your profile partially created!!');
                        $("#infoModalMsgBox").text('Your account could not be created successfully. Please try registering again.');
                        $('#yesNoModal').fadeIn();
                   } else {
                       
                       console.log('Your profile not partially created!!');
                   }
                }
                else {
                   
                }

            },
            error: function (xhr) {
                toastr.error("An error occurred. Please try again.", "Error", {
                    timeOut: 3000,
                    progressBar: true,
                    closeButton: true,
                    positionClass: "toast-top-right"
                });
            },
            complete: function () {
                // $btn.prop("disabled", false).text($btn_text); // Re-enable button and reset text
            }
        });
    };
    
    
    $('#modalNoBtn').click(function() {
        $('#yesNoModal').fadeOut();
    });

    $('#modalYesBtn').click(function() {
        $('#yesNoModal').fadeOut();
        
        let formData = {
            hr_email: $("#hr_email").val(),
        };

        $.ajax({
            url: "/hr/deletepartiallycreatedaccount",
            type: "POST",
            data: formData,
            headers: {
                "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
            },
            success: function (response) {
                if (response.success) {
                    setTimeout(function () {
                        window.location.href = '/hr-registration';
                    }, 500); // Matches the toast display time
                }
                else {
                   
                }

            },
            error: function (xhr) {
                toastr.error("An error occurred. Please try again.", "Error", {
                    timeOut: 3000,
                    progressBar: true,
                    closeButton: true,
                    positionClass: "toast-top-right"
                });
            },
            complete: function () {
                // $btn.prop("disabled", false).text($btn_text); // Re-enable button and reset text
            }
        });
    });

    // verify register otp
    // OTP Verification Button inside Modal
    $("#verifyOtp").on("click", function () {
        let $this = $(this); // Store reference to the button
        let otp = $("#otpInput").val();
        let hrEmail = $("#hr_email_hidden").val();

        if (otp === "") {
            $("#otpError").text("Please enter OTP.");
            return;
        }
        console.log('------------hr_email-----', hrEmail);
        console.log('------------otp', otp);
        $this.prop("disabled", true).text("Verifying...");
        $.ajax({
            url: "/verifyregister-otp",
            type: "POST",
            data: {
                hr_email: hrEmail,
                otp: otp,
                _token: $('meta[name="csrf-token"]').attr("content")
            },
            success: function (response) {
                if (response.success) {
                    toastr.success(response.message, "Success");
                    $("#otpModal").hide(); // Hide OTP modal
                    currentStep++; // Move to next step
                    showStep(currentStep);
                } else {
                    $("#otpError").text(response.message); // Show error message in modal
                    toastr.error(response.message, "Error", {
                        timeOut: 3000,
                        progressBar: true,
                        closeButton: true,
                        positionClass: "toast-top-right",
                    });
                }
            },
            error: function (xhr) {
                let errorMsg =
                    xhr.responseJSON && xhr.responseJSON.message
                        ? xhr.responseJSON.message
                        : "OTP verification failed.";
                $("#otpError").text(errorMsg);
                toastr.error(errorMsg, "Error", {
                    timeOut: 3000,
                    progressBar: true,
                    closeButton: true,
                    positionClass: "toast-top-right",
                });
            },
            // success: function (response) {
            //     if (response.success) {
            //         // alert(response.message); 
            //         toastr.success(response.message, "Success");
            //         $("#otpModal").hide(); // Hide OTP modal
            //         currentStep++; // Move to next step
            //         showStep(currentStep);
            //     } else {
            //         $("#otpError").text(response.message); // Show error message in modal
            //     }
            // },
            // error: function (xhr) {
            //     $("#otpError").text(xhr.responseJSON.message);
            // },
            complete: function () {
                // Re-enable button after request completes
                $this.prop("disabled", false).text("Verify OTP");
            }

        });
    });
    // verify register otp
    $(".prev").on("click", function () {
        if (currentStep > 1) {
            currentStep--;
            showStep(currentStep);
        }
    });
    // add new function
    // add new function

    function submitFormData() {
        // let generatedhrID = generateUniqueID();
        // let formData = {
        //     hr_email: $("#hr_email_hidden").val(),
        //     company_name: $("#company_name").val(),
        //     reporting_manager_mail: $("#reporting_manager_mail").val(),
        //     reporting_manager_name: $("#reporting_manager_name").val(),
        //     reporting_manager_contact: $("#reporting_manager_contact").val(),
        //     company_website: $("#company_website").val(),
        //     hr_aadhar: $("#hr_aadhar").val(),
        //     hr_pan: $("#hr_pan").val(),
        //     hr_dob: $("#hr_dob").val(),
            
        //     _token: $('meta[name="csrf-token"]').attr("content"),
        // };
        let formData = {
            hr_email: $("#hr_email_hidden").val(),
        };
        console.log('--------------submitFormData', formData);
        $.ajax({
            url: "/hr/store",
            type: "POST",
            headers: {
                "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
            },
            data: formData,
            success: function (response) {
                if (response.success) {
                    toastr.success("Hr Registration Successful", "Success", {
                        timeOut: 3000,
                        progressBar: true,
                        closeButton: true,
                        positionClass: "toast-top-right"
                    });
                    
                    setTimeout(function () {
                        window.location.href = response.redirect;
                    }, 500); // Matches the toast display time

                } else {
                    toastr.error("Error: " + response.message, "Error", {
                        timeOut: 5000,
                        progressBar: true
                    });
                }
            },
            error: function (xhr) {
                // console.log('------------->>' + xhr.responseJSON);
                // console.log('------------->>' + xhr.responseJSON.error);
                // alert("Something went wrong! Please check your input.");
                if (xhr.status === 422) {
                    let errors = xhr.responseJSON.errors;
                    $(".error-message").remove(); // Remove previous error messages

                    $.each(errors, function (key, messages) {
                        $("#" + key)
                            .after('<p class="error-message" style="color: red;">' + messages[0] + "</p>");
                    });

                    toastr.error("Please fix the errors in the form.", "Validation Error", {
                        timeOut: 5000,
                        progressBar: true
                    });
                } else {
                    alert("Something went wrong! Please check your input.");
                }
            }
        });

    }
    $(document).on("input", "input", function () {
        $(this).next(".error-message").remove();
    });
    // Hr Login part
    $("#hr-login-submit").on("click", function (e) {

        e.preventDefault(); // Prevent default anchor behavior
        console.log("Login clicked");
        $(".error").text(""); // Clear previous errors

        let hruniqueId = $("#hr_unique_id").val().trim();
        let hrpassword = $("#hr_password").val().trim();

        if (hruniqueId === "" || hrpassword === "") {
            if (hruniqueId === "") {
                $("#hr_unique_id").siblings(".error").text("User ID is required.");
            }
            if (hrpassword === "") {
                $("#hr_password").siblings(".error").text("Password is required.");
            }
            return;
        }

        $.ajax({
            url: "/hr-post-login", // Laravel login route
            type: "POST",
            data: {
                hr_unique_id: hruniqueId,
                hr_password: hrpassword,
            },
            headers: {
                "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
            },
            success: function (response) {
                if (response.success) {
                    // Show Toastr success message
                    toastr.success("HR Login Successful!", "Success", {
                        closeButton: true,
                        progressBar: true,
                        positionClass: "toast-top-right",
                        timeOut: 2000 // 2 seconds before redirect
                    });

                    // ✅ Reset the form fields after success
                    $("#hr_unique_id").val("");
                    $("#hr_password").val("");

                    // Redirect after a short delay
                    setTimeout(function () {
                        window.location.href = response.redirect;
                    }, 2000); // Matches the toast display time
                }
                else {
                    console.log('false----------------');
                    // Show Toastr error message
                    toastr.error(response.message, "Error", {
                        closeButton: true,
                        progressBar: true,
                        positionClass: "toast-top-right",
                        timeOut: 3000 // 3 seconds
                    });
                }
            },
            error: function (xhr) {

                let errors = xhr.responseJSON ? xhr.responseJSON.errors : null;

                console.log('----------------', xhr.responseJSON);
                console.log('----------------', xhr.responseJSON.errors);
                if (errors) {
                    if (errors.hr_unique_id) {
                        $("#hr_unique_id").siblings(".error").text(errors.hr_unique_id[0]);
                    }
                    if (errors.hr_password) {
                        $("#hr_password").siblings(".error").text(errors.hr_password[0]);
                    }
                    if (!errors.hr_password && !errors.hr_unique_id) {
                        alert("Please enter valid IE Id and password");
                    }
                } else if(xhr.responseJSON.message) {
                    // Show Toastr error message for invalid login
                    toastr.error(xhr.responseJSON.message, "Login Failed", {
                        closeButton: true,
                        progressBar: true,
                        positionClass: "toast-top-right",
                        timeOut: 3000 // 3 seconds
                    });
                } else {
                    // Show Toastr error message for invalid login
                    toastr.error("Invalid credentials. Please try again.", "Login Failed", {
                        closeButton: true,
                        progressBar: true,
                        positionClass: "toast-top-right",
                        timeOut: 3000 // 3 seconds
                    });
                }
            },
        });
    });
    // Hr Login part 
    $("#hr-logout-btn").on("click", function (e) {
        e.preventDefault();

        $.ajax({
            url: "/hrlogout",
            type: "POST",
            headers: {
                "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
            },
            success: function (response) {
                if (response.success) {
                    // Show Toastr success message
                    toastr.success(response.message, "Success", {
                        closeButton: true,
                        progressBar: true,
                        positionClass: "toast-top-right",
                        timeOut: 2000 // 2 seconds before redirect
                    });

                    // Redirect after a short delay
                    setTimeout(function () {
                        window.location.href = response.redirect;
                    }, 2000); // Matches the toast display time
                }
            },
            error: function () {
                // alert("Something went wrong. Please try again.");
                toastr.error("Something went wrong. Please try again.", "Error", {
                    closeButton: true,
                    progressBar: true,
                    positionClass: "toast-top-right",
                    timeOut: 3000 // 3 seconds
                });
            }
        });
    });

    // let table = $('#approvalRequestsTable').DataTable({
    //     "processing": true,
    //     "serverSide": false,
    //     "paging": true,
    //     "searching": true,
    //     "ordering": true,
    //     "info": true,
    //     "destroy": true,
    //     "ajax": {
    //         url: "/hr/approval-requests",
    //         type: "GET",
    //         dataSrc: function (data) {
    //             // Handle null values before displaying
    //             return data.map(row => ({
    //                 ...row,
    //                 ctc: row.ctc ?? "N/A",
    //                 in_hand: row.in_hand ?? "N/A"
    //             }));
    //         }
    //     },
    //     "columns": [
    //         {
    //             "data": null,
    //             "render": function (data, type, row) {
    //                 if (row.approval_status === 'pending') {
    //                     return `
    //                     <button class="btn btn-success open-approval-modal send_approval_rejection_otp1" 
    //                         data-id="${row.approval_id}" data-status="approved">
    //                         Approve
    //                     </button>
    //                     <button class="btn btn-danger open-approval-modal send_approval_rejection_otp1" 
    //                         data-id="${row.approval_id}" data-status="rejected">
    //                         Reject
    //                     </button>
    //                 `;
    //                 }
    //                 return row.approval_status; // Show status if not pending
    //             }
    //         },
    //         { "data": "eimager_id" },
    //         { "data": "first_name" },
    //         { "data": "aadhar_number" },
    //         { "data": "pan_number" },
    //         { "data": "company_name" },
    //         { "data": "designation" },
    //         { "data": "projects" },
    //         { "data": "start_date" },
    //         { "data": "end_date" },
    //         { "data": "roles_responsibility" },
    //         { "data": "ctc" },
    //         { "data": "in_hand" },
    //         // { "data": "created_at" },
    //         // { "data": "updated_at" },
    //         { "data": "approval_status" },
    //         { "data": "status_note" },

    //     ]
    // });

    // // Refresh DataTable when clicking "View Requests"
    // $('#viewRequestsBtn').on('click', function () {
    //     table.ajax.reload();
    // });
    let table = $('#approvalRequestsTable').DataTable({
    processing: true,
    serverSide: false,
    paging: true,
    searching: true,
    ordering: true,
    info: true,
    destroy: true,
    ajax: {
        url: '/hr/approval-requests',   // must match your route
        type: 'GET',
        dataSrc: function (json) {
            console.log('approval-requests response:', json);
            if (!json) return [];
            // if controller returns { data: [...] } this will work:
            if (Array.isArray(json.data)) {
                return json.data.map(r => Object.assign(r, {
                    ctc: r.ctc ?? 'N/A',
                    in_hand: r.in_hand ?? 'N/A'
                }));
            }
            // fallback if your server returns raw array (unlikely after controller change)
            if (Array.isArray(json)) {
                return json.map(r => Object.assign(r, {
                    ctc: r.ctc ?? 'N/A',
                    in_hand: r.in_hand ?? 'N/A'
                }));
            }
            // show helpful message
            console.warn('Unexpected response format for approval-requests', json);
            return [];
        },
        error: function (xhr, status, err) {
            console.error('DataTables AJAX error', status, err, xhr.responseText);
            let message = 'Failed to load approval requests';
            if (xhr.status === 401 || xhr.status === 419) {
                message += ': authentication error (please login again).';
            } else if (xhr.status === 500) {
                message += ': server error (check laravel.log).';
            } else {
                message += ': HTTP ' + xhr.status;
            }
            alert(message);
        }
    },
    columns: [
        {
            data: null,
            render: function (data, type, row) {
                if (row.approval_status === 'pending') {
                    return `<button class="btn btn-success send_approval_rejection_otp1" data-id="${row.approval_id}" data-status="approved">Approve</button>
                            <button class="btn btn-danger send_approval_rejection_otp1" data-id="${row.approval_id}" data-status="rejected">Reject</button>`;
                }
                return row.approval_status ?? '';
            }
        },
        { data: 'eimager_id' },
        { data: 'first_name' },
        { data: 'aadhar_number' },
        { data: 'pan_number' },
        { data: 'company_name' },
        { data: 'designation' },
        { data: 'projects' },
        { data: 'start_date' },
        { data: 'end_date' },
        { data: 'roles_responsibility' },
        { data: 'ctc' },
        { data: 'in_hand' },
        { data: 'approval_status' },
        { data: 'status_note' }
    ]
});

    
    // test end
    // approval request button clicked


    function experienceApprovalRejectionOtp(approvalId, approvalStatus, statusNote, btn) {
        

        let btn_text = btn.text();
        btn.prop("disabled", true).text("Please wait...");

        let formData = {
            eimagerId: $('#eimagerid').text(),
        };

        $.ajax({
            url: "/hr/approvalrejectionotprequest",
            type: "POST",
            data: formData,
            headers: {
                "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
            },
            success: function (response) {
                if (response.success) {
                    // alert("Otp Sent successfuly"); 
                    toastr.success("Otp Sent successfuly", "Success", {
                        timeOut: 1500,  // Disappears after 1.5 seconds
                        progressBar: true, // Show progress bar
                        closeButton: true, // Show close button
                        positionClass: "toast-top-right" // Center position
                    });
                    btn.prop("disabled", false).text(btn_text);
                    // $('#approvalModal').modal('hide');
                    // $("#otpModal").show();

                    showOtpSection()
                }
                else {
                    toastr.error("OTP not send. Please try again.", "Error", {
                        timeOut: 3000,  // Disappears after 3 seconds
                        progressBar: true,
                        closeButton: true,
                        positionClass: "toast-top-right"
                    });


                }

            },
            error: function (xhr) {
                toastr.error("An error occurred. Please try again.", "Error", {
                    timeOut: 3000,
                    progressBar: true,
                    closeButton: true,
                    positionClass: "toast-top-right"
                });
            },
            complete: function () {
                // $btn.prop("disabled", false).text($btn_text); // Re-enable button and reset text
            }
        });
    };

    $("#verifySubmitlwd").on("click", function (e) {
       
        let lwdOtp = $('#lwdOtp').val();

        console.log(lwdOtp);


        $.ajax({
            url: "/hr/lastworkingdayotpverification",
            type: "POST",
            data: {
                otp: lwdOtp
            },
            headers: {
                "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
            },
            success: function (response) {
                if (response.success) {
                    // alert("Otp Sent successfuly"); 
                    toastr.success("Otp has been verified. Updating Approval/Reject Status", "Success", {
                        timeOut: 1500,  // Disappears after 1.5 seconds
                        progressBar: true, // Show progress bar
                        closeButton: true, // Show close button
                        positionClass: "toast-top-right" // Center position
                    });

                    updateLastWorkingDay();

                }
                else {
                    toastr.error("Please provide correct OTP", "Error", {
                        timeOut: 3000,  // Disappears after 3 seconds
                        progressBar: true,
                        closeButton: true,
                        positionClass: "toast-top-right"
                    });


                }
            },
            error: function (xhr) {
                alert("Error validating otp");
            }
        });
    });

    function showOtpSection() {
        $('#approvalRejectionOTPSection').removeClass("hide");
        $("#approvalRejectionOTPSection").addClass("show");
    }

    function hideOtpSection() {
        $('#approvalRejectionOTPSection').removeClass("show");
        $("#approvalRejectionOTPSection").addClass("hide");
    }

    
    function showLWDOtpSection() {
        $('#lwdOTPSection').removeClass("hide");
        $("#lwdOTPSection").addClass("show");
    }

    $("#verifySubmitApproval").on("click", function (e) {
        let approvalId = $('#approvalId').val(); // This should be the ID column from the database
        let approvalStatus = $('#approvalStatus').val();
        let statusNote = $('#statusNote').val();
        let approvalRejectionOtp = $('#approvalRejectionOtp').val();

        console.log(approvalId, approvalStatus, statusNote, approvalRejectionOtp);


        $.ajax({
            url: "/hr/approvalrejectionotpverification",
            type: "POST",
            data: {
                otp: approvalRejectionOtp
            },
            headers: {
                "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
            },
            success: function (response) {
                if (response.success) {
                    // alert("Otp Sent successfuly"); 
                    toastr.success("Otp has been verified. Updating Approval/Reject Status", "Success", {
                        timeOut: 1500,  // Disappears after 1.5 seconds
                        progressBar: true, // Show progress bar
                        closeButton: true, // Show close button
                        positionClass: "toast-top-right" // Center position
                    });

                    updateApprovalStatus();

                }
                else {
                    toastr.error("Please provide correct OTP", "Error", {
                        timeOut: 3000,  // Disappears after 3 seconds
                        progressBar: true,
                        closeButton: true,
                        positionClass: "toast-top-right"
                    });


                }
            },
            error: function (xhr) {
                alert("Error validating otp");
            }
        });
    });

    // handle update last working day
    function updateLastWorkingDay() {

        let expId =  $('#lwdexpId').val();
        let lwd= changeDateFormat($("#end-date-field").val());

        
        form_data = {
            expId: expId,
            lwd: lwd,  
        }

        $.ajax({
            url: '/hr/updateLastWorkingDay',
            type: "POST",
            data: form_data,
            headers: {
                "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
            },
            success: function (response) {
                $('#updateExperienceEnddateModal').modal('hide'); 

                toastr.success("Experience Last Working day updated successfully", "Success", {
                    timeOut: 1500,  // Disappears after 1.5 seconds
                    progressBar: true, // Show progress bar
                    closeButton: true, // Show close button
                    positionClass: "toast-top-right" // Center position
                });
                loadExperienceByEimagerId();

                $("#infoModalMsgBox").text("Updated Last working day");
                $('#informationModal').fadeIn();
            },
            error: function (xhr) {
                alert("Error updating status");
            }
        });
    };

    // handle reject and aprove status
    function updateApprovalStatus() {
        // $('.send_approval_rejection_otp').on('click', function () {
        let approvalId = $('#approvalId').val(); // This should be the ID column from the database
        let approvalStatus = $('#approvalStatus').val();
        let statusNote = $('#statusNote').val();
        let eimagerId = $('#eimagerid').val();

        let expId = $('#expId').val();

        let be_url = '';
        let be_data = {};
        if (approvalId) {
            be_url = "/hr/update-approval-status";
            be_data = {
                eimagerId: eimagerId,
                id: approvalId,  // Updated to match database column
                approval_status: approvalStatus,
                status_note: statusNote
            }
        }
        if (expId) {
            be_url = "/hr/approvalAndStatusByEmployer";
            be_data = {
                eimagerId: eimagerId,
                experience_id: expId,  // Updated to match database column
                approval_status: approvalStatus,
                status_note: statusNote,
            }
        }

        $.ajax({
            url: be_url,
            type: "POST",
            data: be_data,
            headers: {
                "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
            },
            success: function (response) {
                $('#approvalModal').modal('hide'); // Hide modal on success
                $('#approvalRejectionModal').modal('hide'); // Hide Employee Profile Search Modal on success
                $('#viewRequestsBtn').click(); // Refresh the table

                toastr.success("Approval/Rejection Status updated successfully", "Success", {
                    timeOut: 1500,  // Disappears after 1.5 seconds
                    progressBar: true, // Show progress bar
                    closeButton: true, // Show close button
                    positionClass: "toast-top-right" // Center position
                });
                if (expId) {
                    loadExperienceByEimagerId();
                }

                resetApprovalRejectionModalInput();
            },
            error: function (xhr) {
                alert("Error updating status");
            }
        });
    };

    // Modal Open
    // $(document).on('click', '.open-approval-modal', function () {
    //     let approvalId = $(this).data('id');
    //     let approvalStatus = $(this).data('status');

    //     $('#approvalId').val(approvalId);
    //     $('#approvalStatus').val(approvalStatus);

    //     //Modal for Employer approve/reject in Dashboard
    //     if (approvalId) {
    //         $('#approvalModal').modal('show');
    //     }

    //     //Modal for  approve/reject in Employer's :: Employee Profile
    //     let expId = $(this).data('exp-id');
    //     $('#expId').val(expId);
    //     if (expId) {
    //         $('#approvalRejectionModal').modal('show');
    //     }

    //     console.log('------------------', $('#approvalId').val(), $('#approvalStatus').val(),
    //         $('#expId').val());

    // });
    
    $(document).on('click', '.send_approval_rejection_otp1', function () {
    // pick id and status from button attributes
    var approvalId = $(this).data('id');      // might be undefined for employer-row; check your data
    var approvalStatus = $(this).data('status');
    var expId = $(this).data('exp-id');       // optional, if button has exp-id

    // prefer setting approvalId first (backend expects this if coming from approval request)
    $('#approvalId').val(approvalId || '');
    $('#approvalStatus').val(approvalStatus || '');
    $('#expId').val(expId || '');

    // show the right modal depending on which id is present
    if (approvalId) {
        $('#approvalModal').modal('show'); // modal for dashboard approve/reject
    } else if (expId) {
        $('#approvalRejectionModal').modal('show'); // employee profile approve/reject
    } else {
        // fallback: just show the main approval modal
        $('#approvalModal').modal('show');
    }

    console.log('Button clicked: approvalId=', approvalId, 'status=', approvalStatus, 'expId=', expId);
});


    $("#submitApproval").click(function (e) {
        let approvalId = $('#approvalId').val(); // This should be the ID column from the database
        let approvalStatus = $('#approvalStatus').val();
        let statusNote = $('#statusNote').val();
        let btn = $(this); // Store button reference


        experienceApprovalRejectionOtp(approvalId, approvalStatus, statusNote, btn);
    });

    // handle reject and aprove status
    // $(document).on('click', '.send_approval_rejection_otp', function () {
    // // $('.send_approval_rejection_otp').on('click', function () {
    //     let approvalId = $('#approvalId').val(); // This should be the ID column from the database
    //     let approvalStatus = $('#approvalStatus').val();
    //     let statusNote = $('#statusNote').val();

    //     let btn = $(this); // Store button reference

    //     // experienceApprovalRejectionOtp(approvalId, approvalStatus, statusNote, btn);

    //     // $.ajax({
    //     //     url: "/hr/update-approval-status",
    //     //     type: "POST",
    //     //     data: {
    //     //         // _token: "{{ csrf_token() }}",
    //     //         id: approvalId,  // Updated to match database column
    //     //         approval_status: approvalStatus,
    //     //         status_note: statusNote
    //     //     },
    //     //     headers: {
    //     //         "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
    //     //     },
    //     //     success: function (response) {
    //     //         $('#approvalModal').modal('hide'); // Hide modal on success
    //     //         alert(response.message);
    //     //         $('#viewRequestsBtn').click(); // Refresh the table
    //     //     },
    //     //     error: function (xhr) {
    //     //         alert("Error updating status");
    //     //     }
    //     // });
    // });


    $("#submitOtp").click(function (e) {
        e.preventDefault;
        var otpValue = $("#otpInput").val();

        if (otpValue === '') {
            alert("Please enter OTP");
            return;
        }

        $.ajax({
            url: "/verify-otp",  // Change this to your Laravel route
            type: "POST",
            data: {
                otp: otpValue,
                // Include CSRF token for security
            },
            headers: {
                "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
            },
            success: function (response) {
                if (response.success) {
                    // alert("OTP Verified Successfully!");
                    toastr.success("OTP Verified Successfully!", "Success", {
                        timeOut: 1500,  // Disappears after 1.5 seconds
                        progressBar: true, // Show progress bar
                        closeButton: true, // Show close button
                        positionClass: "toast-top-right" // Custom center position
                    });
                    $("#otpForm").hide();
                    $("#send_otp").hide();
                    $("#print-profile-btn").show();
                    $(".profile-title").html("EImager Report");
                    loadExperienceByEimagerId();
                    loadQualification();
                    loadComplaint();
                } else {
                    // alert("Invalid OTP. Please try again.");
                    toastr.error("Invalid OTP. Please try again.", "Error", {
                        timeOut: 3000,  // Disappears after 3 seconds
                        progressBar: true,
                        closeButton: true,
                        positionClass: "toast-top-right"
                    });
                }
            },
            error: function () {
                alert("An error occurred. Please try again.");
            }
        });
    });

    $(document).on('click', '.open-last-working-day-modal', function () {
        let expId = $(this).data('exp-id');
        $('#lwdexpId').val(expId);
        if (expId) {
            $('#updateExperienceEnddateModal').modal('show');
        }

        console.log('------------------>>', $('#approvalId').val(), $('#approvalStatus').val(),
        $('#lwdexpId').val());

    });

    
    $("#submitLwdOTP").click(function (e) {
        let btn = $(this); 
        let btn_text = btn.text();
        
        btn.prop("disabled", true).text("Please wait...");

        // let end_date= changeDateFormat($("#end-date-field").val());
        // let lwdexpId = $('#lwdexpId').val();
        // let formData = {
        //     eimagerId: $('#eimagerid').text(),
        //     end_date: end_date,
        //     experience_id:lwdexpId,
        // };
        // console.log(lwdexpId, '---', formData);

        let formData = {
            eimagerId: $('#eimagerid').text(),
        };

        $.ajax({
            url: "/hr/lastworkingdayotprequest",
            type: "POST",
            data: formData,
            headers: {
                "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
            },
            success: function (response) {
                if (response.success) {
                    // alert("Otp Sent successfuly"); 
                    toastr.success("Otp Sent successfuly", "Success", {
                        timeOut: 1500,  // Disappears after 1.5 seconds
                        progressBar: true, // Show progress bar
                        closeButton: true, // Show close button
                        positionClass: "toast-top-right" // Center position
                    });
                    btn.prop("disabled", false).text(btn_text);
                    // $('#approvalModal').modal('hide');
                    // $("#otpModal").show();

                    showLWDOtpSection();
                }
                else {
                    toastr.error("OTP not send. Please try again.", "Error", {
                        timeOut: 3000,  // Disappears after 3 seconds
                        progressBar: true,
                        closeButton: true,
                        positionClass: "toast-top-right"
                    });


                }

            },
            error: function (xhr) {
                toastr.error("An error occurred. Please try again.", "Error", {
                    timeOut: 3000,
                    progressBar: true,
                    closeButton: true,
                    positionClass: "toast-top-right"
                });
            },
            complete: function () {
                // $btn.prop("disabled", false).text($btn_text); // Re-enable button and reset text
            }
        });
    });


    $('#password_view_img_1').on('click', function () {
        togglePasswordVisibility();

    });
    $('#password_view_img_2').on('click', function () {
        togglePasswordVisibility();
    });

    function togglePasswordVisibility() {
        x = $("#login-form-password");
        x = $("#hr_password");
        console.log('...........', x.get(0).type);
        if (x.get(0).type === "password") {
            x.get(0).type = "text";

            $("#password_view_img_1").addClass("hide");
            $("#password_view_img_1").removeClass("show");

            $("#password_view_img_2").addClass("show");
            $("#password_view_img_2").removeClass("hide");
        } else {
            x.get(0).type = "password";


            $("#password_view_img_2").addClass("hide");
            $("#password_view_img_2").removeClass("show");

            $("#password_view_img_1").addClass("show");
            $("#password_view_img_1").removeClass("hide");
        }
    }



    // hr add from hr admin
    $('#addhrstore').on('click', function (e) {
        e.preventDefault();

        // Clear all previous errors
        $('span.error-text').text('');

        $.ajax({
            url: "/addstore",
            method: 'POST',
            data: $('#hrForm').serialize(), // Corrected
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            success: function (response) {

                toastr.success("HR added successfully! Unique ID: " + response.hr_unique_id, "Success", {
                    timeOut: 1500,
                    progressBar: true,
                    closeButton: true,
                    positionClass: "toast-top-right"
                });
                $('#hrForm')[0].reset();
                setTimeout(function () {
                    $('#hrModal').hide();
                }, 2000);


                // alert('HR added! Unique ID: ' + response.hr_unique_id);
                // $('#hrForm')[0].reset();

            },
            error: function (xhr) {
                if (xhr.status === 422) {
                    let errors = xhr.responseJSON.errors;
                    $.each(errors, function (field, message) {
                        $('.' + field + '_error').text(message[0]);
                    });
                } else {
                    alert('Something went wrong.');
                }
            }
        });
    });



    
    $('#add-new-complaint-btn').click(function() {
        console.log('show.... complaint.....');
        $('#add-complaint-form-container').removeClass("hide");
        $('#add-complaint-form-container').addClass("show");
    });

    $('#add-complaint-btn-close').click(function() {
        $('#add-complaint-form-container').removeClass("show");
        $('#add-complaint-form-container').addClass("hide");
    });

    function resetComplaintErrorFields() {
        $('.complaint-details-error').text(''); 
        $('.complaint-name-error').text(''); 
    }

    function resetApprovalRejectionModalInput() {
        $('#statusNote').text(''); 
        $('#approvalRejectionOtp').text(''); 
    }

    
    
    function resetAddComplaintFields() {
        $('.complaint-details-filed').text(''); 
        $('.complaint-name-filed').text(''); 
    }

    $("#save-complaint").click(function () {
        resetComplaintErrorFields();
        
        let formData = {
            employee_eimager_id: $('#eimager_id_hidden').text(),
            name: $("#complaint-name-filed").val(),
            description: $("#complaint-details-field").val(),
            raised_by: $('#eimagerid').text(),
            
        };

        $.ajax({
            url: "/hr/addcomplaint",
            type: "POST",
            data: formData,
            success: function (response) {
                
                if (response.success) {

                    $('#complaintAddedInfoModal').fadeIn();
                    
                    resetAddComplaintFields();

                    
                    loadComplaint();
                }
            },
            error: function (xhr) {
                if( xhr.status === 419 ) {
                    
                    alert(xhr.status);
                }
                if( xhr.status === 422 ) {

                    var response = $.parseJSON(xhr.responseText);
                    console.log(response);
                    

                    if(xhr.responseJSON.errors.name && xhr.responseJSON.errors.name != 'undefined') {
                        $('.complaint-name-error').text(xhr.responseJSON.errors.name["0"]); 
                    } 
                    if(xhr.responseJSON.errors.description && xhr.responseJSON.errors.description != 'undefined') {
                        $('.complaint-details-error').text(xhr.responseJSON.errors.description["0"]); 
                    } 
                    
                }
            }
        });

    });

    
    $('#addMoreComplaintBtn').click(function() {
        $('#complaintAddedInfoModal').fadeOut();
        $('html, body').animate({
            scrollTop: $("#add-complaint-box-container").offset().top
        }, 1000);
    });
     

    
    function loadComplaint() {
                       
        let employee_eimager_id= $('#eimager_id_hidden').text().trim();

        if (employee_eimager_id  ) {
            $.ajax({
                url: "/hr/allComplaint", // Laravel login route
                type: "GET",
                data: {
                    employee_eimager_id: employee_eimager_id,
                },
                headers: {
                    "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
                },
                success: function (response) {

                    if (response.success) {
                        console.log('loadComplaint-------------------->>>>>>>>>>>>>. ', response.success);
                        $("#user_complaint_list_comp").empty();
                        let allComplaint=response.data;
                        $.each(allComplaint, function(i, item) {

                            
                            let qualification_item = `
                                        <div class="card-component" id="expid-`+item.qualification_id+`">
                                            
                                        <div class="card-component2">
                                            <div style="width: 50%; float:left">
                                            <span class="font-15 text-secondary me-2 font-weight-600 ">Complain Reported for:</span> <span class="error-text">`+item.name + `</span>
                                            </div>
                                        </div>
                                        
                                        <div class="card-component2">
                                            <div style="width: 100%; float:left">
                                            <span class="font-15 text-secondary me-2 font-weight-600">Description:</span> <span id='user_mobile_number'>`+item.description + `</span>
                                            </div>
                                        </div>
                                        
                                        <div class="card-component2">
                                            <div style="width: 100%; float:left">
                                            <span class="font-15 text-secondary me-2 font-weight-600">Raised By:</span> <span id='user_mobile_number'>`+item.raised_by + `</span>
                                            </div>
                                        </div>

                                        </div>
                                    `;
                                    
                    
                            
                            $("#user_complaint_list_comp").append(qualification_item);
                        });
                    }
                },
                error: function (xhr) {
                    console.log('-------------------->>>>>>>>>>>>>Complaint...... ', xhr);
                    let errors = xhr.responseJSON ? xhr.responseJSON.errors : null;
                    if (errors) {
                        if (errors.unique_id) {
                            $("#unique_id").siblings(".error").text(errors.unique_id[0]);
                        }
                        if (errors.password) {
                            $("#password").siblings(".error").text(errors.password[0]);
                        }
                        if (!errors.password && !errors.unique_id) {
                            // alert("Please enter valid IE Id and password");
                        }
                    } else {
                        // alert("Invalid credentials. Please try again.");
                    }
                },
            });    
        }
    }

    
    function changeDateFormat(dt) {
        newDate ='';
        if(dt != '' && dt != undefined) {
            var dateAr = dt.split('-');
            newDate = dateAr[2] + '-' + dateAr[1] + '-' + dateAr[0];
        }
        return newDate
    }

    function formatCardNumber(inputVal) {
        var value = inputVal.replace(/\D/g, '');
        var formattedValue = "";
        for (var i = 0; i < value.length; i++) {
        if (i % 4 == 0 && i > 0) {
            formattedValue += " ";
        }
        formattedValue += value[i];
        }
        return formattedValue;
    }

    $('#previous_eimager_checkbox').click(function() {
        $("#error-previous_eimager_id").text('');
        if ($(this).is(':checked')) {
            $("#previous_eimager_id").prop("disabled",false);
        } else {
            $("#previous_eimager_id").prop("disabled",true);
        }
    });

    $('#searchEimagerBtn').click(function() {
        $("#error-previous_eimager_id").text('');
        let employee_eimager_id= $('#previous_eimager_id').val().trim();

        if (employee_eimager_id  ) {
            $.ajax({
                url: "/hr/usersearch", // Laravel login route
                type: "GET",
                data: {
                    employee_eimager_id: employee_eimager_id,
                },
                headers: {
                    "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
                },
                success: function (response) {
                    if (response.success) {
                        // $("#hr_name").text(response.data['first_name']);
                        $("#hr_name").val(response.data['first_name']);  
                        $("#hr_email").val(response.data['email']);
                        $("#hr_phone").val(response.data['phone_number']);
                        $("#hr_aadhar").val(response.data['aadhar_number']);
                        $("#hr_pan").val(response.data['pan_number']);
                        $("#hr_dob").val(response.data['dob']);
                    } else {
                        $("#error-previous_eimager_id").text('EImager Id Not found');
                    }
                },
                error: function (xhr) {
                    let errors = xhr.responseJSON ? xhr.responseJSON.errors : null;
                    console.log('---------------------', errors);
                    if (errors) {
                        if (errors.unique_id) {
                            $("#unique_id").siblings(".error").text(errors.unique_id[0]);
                        }
                        if (errors.password) {
                            $("#password").siblings(".error").text(errors.password[0]);
                        }
                        if (!errors.password && !errors.unique_id) {
                            // alert("Please enter valid IE Id and password");
                        }
                    } else {
                        // alert("Invalid credentials. Please try again.");
                    }
                },
            });    
        }
    });

    $("#send-mail-submit").on("click", function (e) {

        e.preventDefault(); // Prevent default anchor behavior
        console.log(" clicked");

        let email_to = $("#email_to").val().trim();
        let mail_content = $("#mail_content").val().trim();

        $.ajax({
            url: "/testmail", 
            type: "POST",
            data: {
                email_to: email_to,
                mail_content: mail_content,
            },
            headers: {
                "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
            },
            success: function (response) {
                if (response.success) {
                    // Show Toastr success message
                    toastr.success("Mail Sent Successfully", "Success", {
                        closeButton: true,
                        progressBar: true,
                        positionClass: "toast-top-right",
                        timeOut: 2000 // 2 seconds before redirect
                    });

                    
                }
                else {
                    // Show Toastr error message
                    toastr.error(response.message, "Error", {
                        closeButton: true,
                        progressBar: true,
                        positionClass: "toast-top-right",
                        timeOut: 3000 // 3 seconds
                    });
                }
            },
            error: function (xhr) {

                let errors = xhr.responseJSON ? xhr.responseJSON.errors : null;
                if (errors) {
                    
                } else {
                   
                }
            },
        });
    });


    $("#hr-deactivate-btn").on("click", function (e) {
        let $btn = $(this); // Store button reference
        $btn.prop("disabled", true).text("Please wait..."); // Disable and change text
        let formData = {
            eimagerId: $('#eimagerid').text(),
        };

        console.log('------------', formData);

        // console.log('-----> ', formData);
        $.ajax({
            url: "/hr/profiledeactivateotprequest",
            type: "POST",
            data: formData,
            headers: {
                "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
            },
            success: function (response) {
                if (response.success) {
                    // alert("Otp Sent successfuly"); 
                    toastr.success("Otp Sent successfuly", "Success", {
                        timeOut: 1500,  // Disappears after 1.5 seconds
                        progressBar: true, // Show progress bar
                        closeButton: true, // Show close button
                        positionClass: "toast-top-right" // Center position
                    });
                    // $('.verify-otp').show(); 
                    $('#otpModal').modal('show');
                }
                else {
                    toastr.error("OTP not send. Please try again.", "Error", {
                        timeOut: 3000,  // Disappears after 3 seconds
                        progressBar: true,
                        closeButton: true,
                        positionClass: "toast-top-right"
                    });
                }

            },
            error: function (xhr) {
                toastr.error("An error occurred. Please try again.", "Error", {
                    timeOut: 3000,
                    progressBar: true,
                    closeButton: true,
                    positionClass: "toast-top-right"
                });
            },
            complete: function () {
                $btn.prop("disabled", false).text("Send OTP to See Profile"); // Re-enable button and reset text
            }
        });
    });


    $("#verifyProfileDeactivateOtp").on("click", function (e) {
       
        let otp = $('#deactivateOtp').val();

        console.log(otp);


        $.ajax({
            url: "/hr/profiledeactivateverification",
            type: "POST",
            data: {
                otp: otp
            },
            headers: {
                "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
            },
            success: function (response) {
                if (response.success) {
                    // alert("Otp Sent successfuly"); 
                    toastr.success("Otp has been verified. Updating Approval/Reject Status", "Success", {
                        timeOut: 1500,  // Disappears after 1.5 seconds
                        progressBar: true, // Show progress bar
                        closeButton: true, // Show close button
                        positionClass: "toast-top-right" // Center position
                    });

                    deactivateProfile();

                }
                else {
                    toastr.error("Please provide correct OTP", "Error", {
                        timeOut: 3000,  // Disappears after 3 seconds
                        progressBar: true,
                        closeButton: true,
                        positionClass: "toast-top-right"
                    });


                }
            },
            error: function (xhr) {
                alert("Error validating otp");
            }
        });
    });

    
    // handle update last working day
    function deactivateProfile() {

        let formData = {
            eimagerId: $('#eimagerid').text(),
        };

        $.ajax({
            url: '/hr/deactivateHrProfile',
            type: "POST",
            data: formData,
            headers: {
                "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
            },
            success: function (response) {
                $('#updateExperienceEnddateModal').modal('hide'); 

                toastr.success("Experience Last Working day updated successfully", "Success", {
                    timeOut: 1500,  // Disappears after 1.5 seconds
                    progressBar: true, // Show progress bar
                    closeButton: true, // Show close button
                    positionClass: "toast-top-right" // Center position
                });
                
                $('#otpModal').modal('hide');

                $("#hr-logout-btn").click();
            },
            error: function (xhr) {
                alert("Error updating status");
            }
        });
    };
});