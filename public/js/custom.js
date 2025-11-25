$(document).ready(function(){
    // user profile image upload
    $("#uploadProfileImage").on("submit", function (e) {
        e.preventDefault();
        let formData = new FormData();
        formData.append("profile_image", $("#profileimage")[0].files[0]); // Get image file
        formData.append("unique_id", $("#unique_id").val()); // Get unique_id from hidden input
        $.ajax({
            url: "/upload-profile-image",
            type: "POST",
            data: formData,
            processData: false,
            contentType: false,
            headers: {
                "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
            },
            beforeSend: function () {
                $("#uploadBtn").prop("disabled", true).text("Uploading...");
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
                $("#uploadBtn").prop("disabled", false).text("Upload");
            }
        });
    });
    // user profile image upload
    $(".social-link-save").click(function (e) {
        e.preventDefault(); 
       
        let formData = {
            unique_id: $("#eimager-login-id").val(),
            facebook: $("#facebook").val(),
            linkedin: $("#linkedin").val(),
            twitter: $("#twitter").val(),
         };
      
        $.ajax({
            url: "/save-social-links",
            type: "POST",
            data: formData,
            headers: {
                "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
            },
            success: function (response) {
                if (response.success) {
                    
                    toastr.success("Social links saved successfully!", "Success", {
                        timeOut: 1500,  // Disappears after 1.5 seconds
                        progressBar: true, // Show progress bar
                        closeButton: true, // Show close button
                        positionClass: "toast-top-right" // Position of the toast
                    });
                    
                     setTimeout(() => location.reload(), 2000); // Reload after 1.5 seconds
                } else {
                    toastr.error("Something went wrong, please try again!", "Error", {
                        timeOut: 3000,  // Disappears after 3 seconds
                        progressBar: true,
                        closeButton: true,
                        positionClass: "toast-top-right"
                    });
                }
            },
            error: function (xhr) {
                alert("Error: " + xhr.responseText);
            }
        });
    });
    
    

    $('#openModalBtnProfileUpdateRequest').click(function() {

        $('#updateProfileModal').css("display","flex");
        
    });


    // user profile upload
    $("#uploadProfileUpdateRequestBtn").click(function (e) {
        e.preventDefault(); 

        profileDataV = profileDataValiation();
        if(!profileDataV) {
            return;
        }
        profileImageV = fileUploadValiation();
        if(!profileImageV) {
            return;
        }
       
        let formData = {
            eimager_id: $("#eimager-login-id").val(),
            // old_name: $("#request_current_name").text(),
            new_name: $("#new_name_request").val(),
            // old_aadhar: $("#request_current_aadhar").text(),
            new_aadhar: $("#new_aadhar_request").val(),
            // old_pan: $("#request_current_pan").text(),
            new_pan: $("#new_pan_request").val(),
         };
      
        $.ajax({
            url: "/profile-update-request",
            type: "POST",
            data: formData,
            headers: {
                "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
            },
            success: function (response) {
                if (response.success) {
                    uploadProfileRequestEvidenceImage(response.data.id);

                    toastr.success("Profile update request raised successfully!", "Success", {
                        timeOut: 1500,  // Disappears after 1.5 seconds
                        progressBar: true, // Show progress bar
                        closeButton: true, // Show close button
                        positionClass: "toast-top-right" // Position of the toast
                    });
                    
                    $('#updateProfileModal').css("display","none");
                    
                } else {
                    toastr.error("Something went wrong, please try again!", "Error", {
                        timeOut: 3000,  // Disappears after 3 seconds
                        progressBar: true,
                        closeButton: true,
                        positionClass: "toast-top-right"
                    });
                }
            },
            error: function (xhr) {
                alert("Error: " + xhr.responseText);
            }
        });
    });

    function profileDataValiation() {
        new_name= $("#new_name_request").val();
        new_aadhar= $("#new_aadhar_request").val();
        new_pan= $("#new_pan_request").val();
        if(!new_name && !new_aadhar && !new_pan) {
            $('#error-message').text('At least one field must be updated.');
            return false;
        }
        return true;
    }

    function fileUploadValiation() {
        $('#error-message').text('');
       var fileInput = $('#evidenceimage')[0];
        if (fileInput.files.length === 0) {
            $('#error-message').text('Please select an image.');
            return false;
        }

        var file = fileInput.files[0];
        var fileType = file.type;
        var validTypes = ['image/jpeg', 'image/png', 'image/jpg', 'image/gif'];
        var maxSize = 2 * 1024 * 1024; // 2MB

        if (!validTypes.includes(fileType)) {
            $('#error-message').text('Only JPEG, PNG, JPG, and GIF formats are allowed.');
            return false;
        }

        if (file.size > maxSize) {
            $('#error-message').text('Image must be less than 2MB.');
            return false;
        }

        return true;
    }

    function uploadProfileRequestEvidenceImage(id) {
            let formData = new FormData();
            formData.append("evidence_image", $("#evidenceimage")[0].files[0]); // Get image file
            formData.append("id", id); 
            $.ajax({
                url: "/upload-evidence-image",
                type: "POST",
                data: formData,
                processData: false,
                contentType: false,
                headers: {
                    "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
                },
                beforeSend: function () {
                },
                success: function (response) {
                    // if (response.success) {
                    //     toastr.success("Profile image updated successfully!", "Success", {
                    //         timeOut: 2000,
                    //         positionClass: "toast-top-center",
                    //         progressBar: true,
                    //         closeButton: true
                    //     });

                    //     // Update profile image preview
                    //     // $("#profile_preview").attr("src", response.image_url);
                    // } else {
                    //     toastr.error("Failed to update profile image. Try again.", "Error", {
                    //         timeOut: 3000,
                    //         positionClass: "toast-top-center",
                    //         progressBar: true,
                    //         closeButton: true
                    //     });
                    // }
                },
                error: function () {
                    // toastr.error("Something went wrong. Please try again!", "Error", {
                    //     timeOut: 3000,
                    //     positionClass: "toast-top-center",
                    //     progressBar: true,
                    //     closeButton: true
                    // });
                },
                complete: function () {
                    // $("#uploadBtn").prop("disabled", false).text("Upload");
                }
            });
    }
    

    
    $(".close-modal").click(function (e) {
        $('#updateProfileModal').css("display","none");
    });
   
});
// *************
$(document).ready(function () {
    let currentStep = 1;
    const totalSteps = $(".formContainer").length;
 
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
            if ($(this).val().trim() === "") {
                $(this).siblings(".error").text("This field is required");
                isValid = false;
            } else {
                $(this).siblings(".error").text("");
            }
        });

        if (step === 1) {
            const password = $("#password").val();
            const confirmPassword = $("#confirm-password").val();

            if (password !== confirmPassword) {
                $("#confirm-password").siblings(".error").text("Passwords do not match");
                isValid = false;
            }
        }

        return isValid;
    }

    $("#aadhar_number").on("input", function() {
        inputVal = $(this).val();
        if(inputVal.length>14) {
            inputVal = inputVal.substring(0,14);
        }
        value = formatCardNumber(inputVal);
        $("#aadhar_number").val(value);
    });

    $("#number").on("input", function() {
        inputVal = $(this).val();
        if(inputVal.length>10) {
            inputVal = inputVal.substring(0,10);
        }
        $("#number").val(inputVal);
    });

    function updateSummary() {
        $("#s_name").text(" " + $("#first_name").val());
        $("#s_email").text(" " + $("#email").val());
        $("#s_number").text(" " + $("#phone_number").val());
        // $("#s_password").text("Password: " + $("#password").val()); 
        $("#s_aadhar").text(" " + $("#aadhar_number").val());
        $("#s_pan").text(" " + $("#pan_number").val());
        $("#s_dob").text(" " + $("#dob").val());
        $("#s_eimager_id").text(" " + $("#unique_id").val());
       
    }

    
    function generateUniqueID() {
        let dob = $("#dob").val().slice(0,4);
        let pan_number = $("#pan_number").val().slice(4);
        let aadhar_number = $("#aadhar_number").val().slice(-4);
        // console.log("D.O.B" + dob);
        // console.log("P.A.N" + pan);
        // console.log("A.D.R" + aadhar);
        let firstName = $("#user_name_hidden").val().split(" ")[0]?.charAt(0) || "";
        let lastName = $("#user_name_hidden").val().split(" ")[1]?.charAt(0) || "";
        if(lastName==="") {
            lastName = $("#user_name_hidden").val().split(" ")[0]?.charAt(1) || "";
        }

        let uniqueID = ('EI' + firstName + lastName + "-" + pan_number + "-" + aadhar_number +"-" + dob).toUpperCase();
        $("#generatedID").text(uniqueID);
        $("#unique_id").val(uniqueID);

        $(".next").text("Confirm");
    }

    $(".next").on("click", function () {
        console.log("Next Button clicked");
        console.log(currentStep);
        console.log(totalSteps);
        let $this = $(this); // Store reference to the button
        // console.log($this);

        // Disable button and show loading text
        // $this.prop("disabled", true).text("Loading...");
        // if (!validateStep(currentStep)) {
        //     $this.prop("disabled", false).text("Next");
        //     return;
        // }

        if (currentStep < totalSteps) {
            console.log("In");
            //  currentStep++;
            if(currentStep === 1){
                console.log("First - step");
                console.log(currentStep);
                submitFormData();
            }
            // if(currentStep === 2){
            //     console.log(currentStep);
            //     console.log("second - step");
            // }
            if (currentStep === 2) {
                updateSummary();
                console.log(currentStep);
                console.log("second - step");
                // generateUniqueID();
                let formData = {
                    first_name: $("#user_name_hidden").val(),
                    email: $("#user_email_hidden").val(),
                    aadhar_number: $("#aadhar_number").val().replace(/\s/g, ""),
                    pan_number: $("#pan_number").val(),
                    dob: $("#dob").val(),
                    // unique_id: $("#unique_id").val(),
                    // hr_unique_id: $("#hr_unique_id").val(),
                    _token: $('meta[name="csrf-token"]').attr("content"),
                };
                // updateSummary();
                $.ajax({
                    url: '/user/registertwo',
                    type: "POST",
                    data: formData,
                    dataType: "json",
                    success: function (response) {
                        if (response.success) {
                            console.log(response);
                            console.log(response.data.unique_id);
                            toastr.success("Hr 2 nd step Registration Successful", "Success", {
                                timeOut: 3000,
                                progressBar: true,
                                closeButton: true,
                                positionClass: "toast-top-right"
                            });
                            $("#user_email_hidden").val(response.data.unique_id);
                            // $("#hr_addhar_hidden").val(response.data.aadhar_number);
                            // $("#hr_pan_hidden").val(response.data.hr_pan);
                            // $("#hr_dob_hidden").val(response.data.hr_dob);
                            currentStep++;
                            updateSummary();
                            showStep(currentStep);
                           
                            setTimeout(() => {
                                // ✅ Reset the form fields after success
                                // $("#unique_id").val("");
                                // $("#password").val("");
                    
                                // Redirect user to the dashboard
                            window.location.href = response.redirect;
                            }, 200
                        );
                            loadExperience();
                            // $("#aadhar_number, #pan_number, #hr_dob").val("");

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
                    // complete: function () {
                    //     $(".next").hide();
                    //     // Re-enable button and reset text after AJAX completes
                    //     $this.prop("disabled", false).text("Next");
                    //     // showStep(currentStep);
                    //     console.log('---', currentStep);

                    // }
                    complete: function () {
                        // Don’t hide the button here
                        $this
                            .prop("disabled", false)
                            .text(
                                currentStep === totalSteps
                                    ? "Submit"
                                    : "Next Step"
                            );
                    },
                    
                });
                 
            }
            if (currentStep === 3) {
                // generateUniqueID();
                updateSummary();
                // submitFormData();
                $(".next").text("Generate ID"); 
                $(".next").hide();
            }
            if (currentStep === 4) {
                
                $(".next").text("Submit"); // Change button text in Step 4
            }
            if (currentStep === 5) {
               
                $(".next").hide(); // Hide button after Step 5
            }

            showStep(currentStep);
        } else {
            if (currentStep === 5) {
              
                window.location.href = 'http://localhost:8000/login';
            }
        }
    });

    // login form submit

    // login form submit 
    $(".prev").on("click", function () {
        if (currentStep > 1) {
            currentStep--;
            showStep(currentStep);
        }
    });

    $("#login-submit").on("click", function (e) {

        e.preventDefault(); // Prevent default anchor behavior
        console.log("Login clicked");
        $(".error").text(""); // Clear previous errors

        let uniqueId = $("#unique_id").val().trim();
        let password = $("#password").val().trim();

        if (uniqueId === "" || password === "") {
            if (uniqueId === "") {
                $("#unique_id").siblings(".error").text("User ID is required.");
            }
            if (password === "") {
                $("#password").siblings(".error").text("Password is required.");
            }
            return;
        }

        $.ajax({
            url: "/post-login", // Laravel login route
            type: "POST",
            data: {
                unique_id: uniqueId,
                password: password,
            },
            headers: {
                "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
            },
            success: function (response) {
                if (response.success) {
                    
                    toastr.success("Login Successful: " , "Success", {
                        timeOut: 1500,  // 3 seconds before it disappears
                        progressBar: true, // Show progress bar
                        closeButton: true, // Show close button
                        positionClass: "toast-top-right" // Position of the toast
                    });
                    setTimeout(() => {
                        // ✅ Reset the form fields after success
                        $("#unique_id").val("");
                        $("#password").val("");
            
                        // Redirect user to the dashboard
                        window.location.href = response.redirect;
                    }, 1500);
            
                    loadExperience();
                } else {
                    toastr.error("Error: " + response.message, "Error", {
                        timeOut: 5000,
                        progressBar: true
                    });
                }
            },
            error: function (xhr) {
                console.log('------------->>' + xhr.responseJSON);
                console.log('------------->>' + xhr.responseJSON.error);
                let errors = xhr.responseJSON ? xhr.responseJSON.errors : null;
                if (errors) {
                    if (errors.unique_id) {
                        $("#unique_id").siblings(".error").text(errors.unique_id[0]);
                    }
                    if (errors.password) {
                        $("#password").siblings(".error").text(errors.password[0]);
                    }
                    if (!errors.password && !errors.unique_id) {
                        alert("Please enter valid IE Id and password");
                    }
                } else {
                    // ❌ Show alert message for invalid login
                    alert("Invalid credentials. Please try again.");
                }
            },
        });
    });

    

    $("#logout-btn").on("click", function (e) {
        e.preventDefault();

        $.ajax({
            url: "/logout",
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
                // Show Toastr error message
                toastr.error("Something went wrong. Please try again.", "Error", {
                    closeButton: true,
                    progressBar: true,
                    positionClass: "toast-top-right",
                    timeOut: 3000 // 3 seconds
                });
            }
        });
    });

    showStep(currentStep);
    $.ajaxSetup({
        headers: {
            "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content")
        }
    });

    function submitFormData() {
        // Clear previous error messages
        $('.error-message').remove();
        
        // Validate password confirmation
        const password = $("#password").val();
        const confirmPassword = $("#confirm-password").val();
        
        if (password !== confirmPassword) {
            $("#confirm-password").after('<p class="error-message" style="color: red;">Password and confirm password do not match.</p>');
            return;
        }
        console.log('================ ', $("#aadhar_number").val().replace(/\s/g, ""));
        let formData = {
            first_name: $("#first_name").val(),
            email: $("#email").val(),
            phone_number: $("#phone_number").val(),
            password: $("#password").val(),
            password_confirmation: $("#confirm-password").val(),
            // aadhar_number: $("#aadhar").val().replace(/\s/g, ""),
            // pan_number: $("#pan").val(),
            // dob: $("#dob").val(),
            // $("#dob").val()
            // unique_id: $("#unique_id").val(),
            _token: $('meta[name="csrf-token"]').attr('content') // CSRF Token
        };

        $.ajax({
            url: "/register/store",
            type: "POST",
            data: formData,
            success: function (response) {
                if (response.success) {
                    console.log(response);
                    console.log(response.data.email);
                    toastr.success("User Registration First step Successful", "Success",{
                        heading: "Success",
                        icon: "success",
                        position: "top-right",
                        stack: false,
                        hideAfter: 2000, // Auto close after 2 seconds
                    });

                    $("#user_email_hidden").val(response.data.email);
                    $("#user_name_hidden").val(response.data.first_name);
                    // new section add
                    setTimeout(() => {
                        // ✅ Reset the form fields after success
                        // $("#unique_id").val("");
                        // $("#password").val("");
            
                        // Redirect user to the dashboard
                        // window.location.href = response.redirect;
                    }, 200);
                    currentStep++;
                    showStep(currentStep);
                    updateSummary();
            
                    // loadExperience();
                    // new section add
                    // $(".next").text("Login");
                    // $(".next").show();
                }
            },
            error: function (xhr) {
                // console.log(xhr);
                if (xhr.status === 422) {
                    let errors = xhr.responseJSON.errors;
                    $(".error-message").remove(); // Remove previous error messages

                    $.each(errors, function (key, messages) {
                        $("#" + key)
                            .after('<p class="error-message" style="color: red;">' + messages[0] + "</p>");
                    });
                }
                
                // toastr.error("Error: " + xhr.responseText, "Error", {
                //     positionClass: "toast-top-right",
                //     icon: "error",
                //     timeOut: 3000,
                //     closeButton: true,
                //     progressBar: true
                // });
            },
            complete: function () {
                // Re-enable button and reset text after AJAX completes
                // $this.prop("disabled", false).text("Next");
                // showStep(currentStep);
                console.log('---', currentStep);

            }
        });
    }
// -------------------------Experiece Logic----------------------

    $("#add-form").click(function () {
        formCount++;
        let newForm = $("#form-1").clone().prop("id", "form-" + formCount);
        newForm.find("input").val(""); // Clear input fields
        newForm.find(".phone-container").html(`
            <div class="input-group mb-2 phone-group">
                <input type="text" class="form-control project" placeholder="Enter project">
                <button class="btn btn-success add-project" type="button">+</button>
            </div>
        `);

        $("#add-experience-form-container").append(newForm);
    });

      // Delete Last Form
      $("#delete-form").click(function () {
        // if (formCount > 1) {
        //     $("#form-container .form-group:last").remove();
        //     formCount--;
        // }
    });

    // Add Project Field
    $(document).on("click", ".add-project", function () {
        let projectName = $("#project-field").val();// $('#txt_name').val();
        
        let projectDiv = `
            <div class="input-group mb-2 project-group">
                 <input type="text" readonly="readonly" class="form-control project" 
                 placeholder="Enter phone" value='`+projectName+`'/>
                 <button class="btn btn-danger remove-project" type="button">-</button>

            </div>
        `;
        $(".added-project-container").append(projectDiv);
        $("#project-field").val("");
    });

    // Remove project Field
    $(document).on("click", ".remove-project", function () {
        $(this).closest(".project-group").remove();
    });

    $('#still_working').click(function() {
        if ($(this).is(':checked')) {
            $(".end-date").prop('disabled', true);
            $('.end-date').val('');
        } else {
            $(".end-date").prop('disabled', false);
        }
    });

    function resetErrorFields() {
        $('.companyname-error').text(''); 
        $('.designation-error').text(''); 
        $('.projects-error').text(''); 
        $('.ctc-error').text('');
        $('.in-hand-error').text('');
        $('.roles-responsibility-error').text('');
    }

    function resetQualificationErrorFields() {
        $('.qualification-school-error').text(''); 
        $('.qualification-degree-error').text(''); 
        $('.qualification-study-error').text(''); 
        $('.qualification-grade-error').text('');
        $('.qualification-description-error').text('');
    }

    
    function resetAddExperienceFields() {
        $('#company-name-filed').val(''); 
        $('#designation-field').val(''); 
        $('#project-field').val(''); 
        $('#added-project-container').empty();
        $('#start-date-field').val('');
        $('#end-date-field').val('');
        $('#ctc-field').val("");
        $('#in-hand-field').val("");
        $('#role-res-field').val(''); 
    }
    
    function resetAddQualificationFields() {
        $('#qualification-school-filed').val(''); 
        $('#qualification-degree-field').val(''); 
        $('#qualification-study-field').val(''); 
        $('#qualification-start-date-field').val('');
        $('#qualification-end-date-field').val('');
        $('#qualification-grade-field').val("");
        $('#qualification-description-field').val(''); 
    }


    $("#save-experience").click(function () {
        // let allData = [];
        resetErrorFields();
        
        console.log('Save experience.........................');
        
        let projectNames = [];
        $(".form-group").each(function () {
            $(this).find(".project").each(function () {
                let project = $(this).val();
                if (project.trim() !== "") {
                    projectNames.push(project);
                }
            }); 
        });

            const still_working = ($('#still_working').is(':checked') ? 'Yes' : 'No');
            
            let formData = {
                eimager_id: $('#eimagerid').text(),
                company_name: $("#company-name-filed").val(),
                designation: $("#designation-field").val(),
                projects: projectNames.join(", "), // Store as comma-separated string
                start_date: changeDateFormat( $("#start-date-field").val()),
                end_date: (still_working==='Yes'?null:changeDateFormat($("#end-date-field").val())),
                is_still_working: still_working,
                ctc: ($("#ctc-field").val() == 'undefined' ? 0: $("#ctc-field").val()),
                in_hand: ($("#in-hand-field").val() == 'in_hand' ? 0: $("#in-hand-field").val()),
                roles_responsibility: $("#role-res-field").val()
            };
            // allData.push(formData);
        console.log('Save experience clicked.........................'+formData);

            $.ajax({
                url: "/experience/addexperience",
                type: "POST",
                data: formData,
                success: function (response) {
                    alert(response.success);
                    if (response.success) {

                        $("#review-experience-btn").addClass("show");
                        $('#review-experience-btn').removeClass("hide");

                        $('#expAddedInfoModal').fadeIn();
                        
                        resetAddExperienceFields();

                        loadExperience();
                    }
                },
                error: function (xhr) {
                    // alert(xhr.status);
                    if( xhr.status === 422 ) {
                        var response = $.parseJSON(xhr.responseText);
                        console.log(response);

                        if(xhr.responseJSON.errors.company_name && xhr.responseJSON.errors.company_name != 'undefined') {
                            $('.companyname-error').text(xhr.responseJSON.errors.company_name["0"]); 
                        } 
                        if(xhr.responseJSON.errors.designation && xhr.responseJSON.errors.designation != 'undefined') {
                            $('.designation-error').text(xhr.responseJSON.errors.designation["0"]); 
                        } 
                        if(xhr.responseJSON.errors.projects && xhr.responseJSON.errors.projects != 'undefined') {
                            $('.projects-error').text(xhr.responseJSON.errors.projects["0"]); 
                        } 
                        if(xhr.responseJSON.errors.start_date && xhr.responseJSON.errors.start_date != 'undefined') {
                            $('.start-date-error').text(xhr.responseJSON.errors.start_date["0"]); 
                        } 
                        if(xhr.responseJSON.errors.ctc && xhr.responseJSON.errors.ctc != 'undefined') {
                            $('.ctc-error').text(xhr.responseJSON.errors.ctc["0"]); 
                        } 
                        if(xhr.responseJSON.errors.in_hand && xhr.responseJSON.errors.in_hand != 'undefined') {
                            $('.in-hand-error').text(xhr.responseJSON.errors.in_hand["0"]); 
                        } 
                        if(xhr.responseJSON.errors.roles_responsibility && xhr.responseJSON.errors.roles_responsibility != 'undefined') {
                            $('.roles-responsibility-error').text(xhr.responseJSON.errors.roles_responsibility["0"]); 
                        } 

                        $.each(xhr.responseJSON.errors, function (key, item) 
                        {
                            $("#errors").append("<li class='alert alert-danger'>"+item+"</li>")
                        });
                    }
                }
            });

    
        // Reset Form After Submit
        // $("#add-experience-form-container").html(`
        //     <div class="form-group border mb-2 position-relative" id="form-1">
        //                           <button id = "add-experience-btn-close" class='x'> X </button>
        //                           <form action="#" method="post">
        //                           <label>Company/Employer Name</label>
        //                           <input id='company_name' type="text" required title="This field should not be left blank." class="form-control company-name" placeholder="Enter company name">
        //                           <span class="companyname-error error-text"></span>     

        //                           </br><label>Designation</label>
        //                           <input type="text" required class="form-control company-designation" placeholder="Enter designation">
        //                           <span class="designation-error error-text"></span>     

        //                           <!-- Project Section Section -->
        //                           </br></br><label>Project</label>
        //                           <div class="project-container">
        //                               <div class="input-group mb-2 project-group">
        //                                   <input type="text"  id='add-project-input' class="form-control project" placeholder="Enter project">
        //                                   <button class="btn btn-success add-project" type="button">+</button>
        //                               </div>
        //                           </div>
        //                           <span class="projects-error error-text"></span>     
        //                           <div class="added-project-container"></div>
        
        //                           </br><label>Start Date</label>
        //                           <input type="date" required class="form-control start-date" placeholder="Enter your start date">

        //                           </br><label>End Date</label>
        //                           </br><input name="still_working" id="still_working" type="checkbox"><span>&nbsp;&nbsp;Still Working</span>
        //                           <input type="date" class="form-control end-date" placeholder="Enter last date">
        
        //                           </br><label>CTC (Approx)</label>    
        //                           <input type="number" required class="form-control ctc" placeholder="Enter CTC yearly">
        //                           <span class="ctc-error error-text"></span> 

        //                           </br></br><label>In hand (PA - Approx)</label>
        //                           <input type="number" required class="form-control in_hand" placeholder="Enter Inhand yearly">
        //                           <span class="in-hand-error error-text"></span>     
        
                                  
        //                           </br></br><label>Roles & Resposiablites</label> 
        //                           <input type="text" class="form-control company-role" placeholder="Enter company role">
        //                           <span class="roles-responsibility-error error-text"></span>  

        //                           </br><button id="save-experience" class="btn btn-primary mt-2">Save Experience</button>
                               
        //                           </form>
        //                         </div>
        // `);
    
        // formCount = 1; // Reset form count

    });

    
    $("#save-qualification").click(function () {
        resetQualificationErrorFields();
        
        let formData = {
            eimager_id: $('#eimagerid').text(),
            school: $("#qualification-school-filed").val(),
            degree: $("#qualification-degree-field").val(),
            study: $("#qualification-study-field").val(),
            start_date: changeDateFormat( $("#qualification-start-date-field").val()),
            end_date: changeDateFormat( $("#qualification-end-date-field").val()),
            grade: $("#qualification-grade-field").val(),
            description: $("#qualification-description-field").val()
        };

        $.ajax({
            url: "/qualification/addqualification",
            type: "POST",
            data: formData,
            success: function (response) {
                
                if (response.success) {

                    $('#qualificationAddedInfoModal').fadeIn();
                    
                    resetAddQualificationFields();

                    
                    loadQualification();
                }
            },
            error: function (xhr) {
                if( xhr.status === 419 ) {
                    
                    alert(xhr.status);
                }
                if( xhr.status === 422 ) {

                    var response = $.parseJSON(xhr.responseText);
                    console.log(xhr.responseJSON.errors.start_date);
                    console.log(xhr.responseJSON.errors.end_date);
                    

                    if(xhr.responseJSON.errors.school && xhr.responseJSON.errors.school != 'undefined') {
                        $('.qualification-school-error').text(xhr.responseJSON.errors.school["0"]); 
                    } 
                    if(xhr.responseJSON.errors.degree && xhr.responseJSON.errors.degree != 'undefined') {
                        $('.qualification-degree-error').text(xhr.responseJSON.errors.degree["0"]); 
                    } 
                    if(xhr.responseJSON.errors.study && xhr.responseJSON.errors.study != 'undefined') {
                        $('.qualification-study-error').text(xhr.responseJSON.errors.study["0"]); 
                    } 
                    if(xhr.responseJSON.errors.grade && xhr.responseJSON.errors.grade != 'undefined') {
                        $('.qualification-grade-error').text(xhr.responseJSON.errors.grade["0"]); 
                    } 
                    if(xhr.responseJSON.errors.start_date && xhr.responseJSON.errors.start_date != 'undefined') {
                        $('.qualification-start-date-error').text(xhr.responseJSON.errors.start_date["0"]); 
                    } 
                    if(xhr.responseJSON.errors.end_date && xhr.responseJSON.errors.end_date != 'undefined') {
                        $('.qualification-end-date-error').text(xhr.responseJSON.errors.end_date["0"]); 
                    } 
                    if(xhr.responseJSON.errors.description && xhr.responseJSON.errors.description != 'undefined') {
                        $('.qualification-description-error').text(xhr.responseJSON.errors.description["0"]); 
                    } 

                    $.each(xhr.responseJSON.errors, function (key, item) 
                    {
                        $("#errors").append("<li class='alert alert-danger'>"+item+"</li>")
                    });
                }
            }
        });

    });
    


    // $("#add_exp").click(loadExperience());
    // $("#all_exp").click(loadExperience());

    // $("#all_exp_link").click(function() {
    //     $('#list2-tab').tabs('select', 1); 
    // });
    

    function loadExperience() {
        let eimager_id= $('#eimagerid').text().trim();

        if (eimager_id ) {
            $.ajax({
                url: "/experience/allexperience", // Laravel login route
                type: "GET",
                data: {
                    eimagerId: eimager_id,
                },
                headers: {
                    "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
                },
                success: function (response) {
                    // console.log('-------------------->>>>>>>>>>>>>. ', response.success);

                    if (response.success) {
                        $("#user_exp_list_comp").empty();
                        let allexp=response.data;
                        $.each(allexp, function(i, item) {

                            var approval_status_class='color-orange';
                            var review_button_class='';
                            if(item.approval_status == null) {
                                item.approval_status = 'Not Initiated'
                            } else if(item.approval_status.toLowerCase() == 'pending') {
                                item.approval_status = 'Pending';
                                approval_status_class = 'color-yellow';
                            } else if(item.approval_status.toLowerCase() == 'approved') {
                                item.approval_status = 'Approved';
                                review_button_class='hide-and-remove-element';
                                approval_status_class = 'color-green';
                            } else if(item.approval_status.toLowerCase() == 'rejected') {
                                item.approval_status = 'Rejected';
                                approval_status_class = 'color-red';
                            }
                            if(item.status_note == null) {item.status_note = 'N/A'}

                            let exp_item = `
                                        <div class="card-component" id="expid-`+item.exp_id+`">
                                            
                                        <div class="card-component2">
                                            <div style="width: 50%; float:left">
                                            <span class="font-15 text-secondary me-2 font-weight-600">Company Name:</span> <span >`+item.company_name + `</span>
                                            </div>

                                            <div style="width: 50%; float:right">
                                            <span class="font-15 text-secondary me-2 font-weight-600">Designation:</span> <span >`+item.designation + `</span>
                                            </div>
                                        </div>
                                        <div class="card-component2">
                                            <div style="width: 50%; float:left">
                                            <span class="font-15 text-secondary me-2 font-weight-600">DOJ:</span> <span >`+item.start_date + `</span>
                                            </div>

                                            <div style="width: 50%; float:right">
                                            <span class="font-15 text-secondary me-2 font-weight-600">LWD:</span> <span>`+item.end_date + `</span>
                                            </div>
                                        </div>
                                        <div class="card-component2">
                                            <div style="width: 100%; float:left">
                                            <span class="font-15 text-secondary me-2 font-weight-600">Projects:</span> <span id='user_mobile_number'>`+item.projects + `</span>
                                            </div>
                                        </div>
                                        <div class="card-component2">
                                            <div style="width: 50%; float:left">
                                            <span class="font-15 text-secondary me-2 font-weight-600">CTC (P/A):</span> <span id='user_mobile_number'>`+item.ctc + `</span>
                                            </div>

                                            <div style="width: 50%; float:right">
                                            <span class="font-15 text-secondary me-2 font-weight-600">In hand (P/A - Approx):</span> <span id='user_mobile_number'>`+item.in_hand + `</span>
                                            </div>
                                        </div>
                                        <div class="card-component2">
                                            <div style="width: 100%; float:left">
                                            <span class="font-15 text-secondary me-2 font-weight-600">Roles & Responsibilites:</span> <span id='user_mobile_number'>`+item.roles_responsibility + `</span>
                                            </div>
                                        </div>
                                        <div class="card-component2">
                                            <div style="width: 50%; float:left">
                                            <span class="font-15 text-secondary me-2 font-weight-600">Approval Status:</span> 
                                            <span class="`+approval_status_class+`">`+item.approval_status + `</span>
                                            </div>

                                            <div style="width: 50%; float:right">
                                            <span class="font-15 text-secondary me-2 font-weight-600">Approval Feedback:</span> <span class='tag'>`+item.status_note + `</span>
                                            </div>
                                        </div>
                                        <div class="card-component2 `+review_button_class+`">
                                            <div style="width: 50%; float:left ">
                                            <button id="openModalBtn" class="btn btn-primary mt-2" >Verify/Review</button>
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

    
    function loadQualification() {
        let eimager_id= $('#eimagerid').text().trim();

        if (eimager_id ) {
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
                        let allexp=response.data;
                        $.each(allexp, function(i, item) {

                            
                            let qualification_item = `
                                        <div class="card-component" id="expid-`+item.qualification_id+`">
                                            
                                        <div class="card-component2">
                                            <div style="width: 50%; float:left">
                                            <span class="font-15 text-secondary me-2 font-weight-600">School:</span> <span >`+item.school + `</span>
                                            </div>

                                            <div style="width: 50%; float:right">
                                            <span class="font-15 text-secondary me-2 font-weight-600">Degree:</span> <span >`+item.degree + `</span>
                                            </div>
                                        </div>
                                        <div class="card-component2">
                                            <div style="width: 50%; float:left">
                                            <span class="font-15 text-secondary me-2 font-weight-600">DOJ:</span> <span >`+item.start_date + `</span>
                                            </div>

                                            <div style="width: 50%; float:right">
                                            <span class="font-15 text-secondary me-2 font-weight-600">LWD:</span> <span>`+item.end_date + `</span>
                                            </div>
                                        </div>
                                        <div class="card-component2">
                                            <div style="width: 50%; float:left">
                                            <span class="font-15 text-secondary me-2 font-weight-600">Study:</span> <span id='user_mobile_number'>`+item.study + `</span>
                                            </div>

                                            <div style="width: 50%; float:right">
                                            <span class="font-15 text-secondary me-2 font-weight-600">Grade:</span> <span id='user_mobile_number'>`+item.grade + `</span>
                                            </div>
                                        </div>
                                        <div class="card-component2">
                                            <div style="width: 100%; float:left">
                                            <span class="font-15 text-secondary me-2 font-weight-600">Description:</span> <span id='user_mobile_number'>`+item.description + `</span>
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
    
    $(document).on('click', '#openModalBtn', function()
    {
        expId = $(this).parent().parent().parent().attr('id');
        window.expId = expId;
        $('#expReviewModal').fadeIn();
    });

    
    $(document).on('click', '#deleteExpBtn', function()
    {
        expId = $(this).parent().parent().parent().attr('id');
        window.expId = expId;
        console.log(expId);
        $('#confirmationModal').fadeIn();
    });

    





    // Close the modal when the close button is clicked
    $('#modalYesBtn').click(function() {
        $('#confirmationModal').fadeOut();

        var expId = window.expId.split('-')[1];
        let formData = {
            experience_id: expId,
        };

        $.ajax({
            url: "/experience/deleteExperience",
            type: "POST",
            data: formData,
            success: function (response) {
                if (response.success) {

                    $("#infoModalMsgBox").text(response.message);
                        
                    $('#informationModal').fadeIn();

                    loadExperience();
                }
            },
            error: function (xhr) {
                alert("Error: " + xhr.responseText);
            }
        }); 
    });

    $('#modalNoBtn').click(function() {
        $('#confirmationModal').fadeOut();
    });

    $('#modalYesBtn').click(function() {
        $('#confirmationModal').fadeOut();
    });

    $('#modalOkBtn').click(function() {
        $('#informationModal').fadeOut();
    });

    // Submit the input and close the modal when the submit button is clicked
    $('#submitBtn').click(function() {
        var expId = window.expId.split('-')[1];
        var eIds = $('#approver_email').val();
        var name = $('#approver_name').val();
        var number = $('#approver_number').val();
        if(eIds) {
            let formData = {
                approver_email: eIds,
                approver_name: name,
                approver_number: number,
                experience_id: expId,
            };

            $.ajax({
                url: "/experience/addApprovalRequest",
                type: "POST",
                data: formData,
                success: function (response) {
                    if (response.success) {
                        // alert(response.message);
                        $("#infoModalMsgBox").text(response.message);
                        
                        $('#informationModal').fadeIn();
                    }
                },
                error: function (xhr) {
                    alert("Error: " + xhr.responseText);
                }
            });

        } else {
            alert("Please enter a value!");
        }
        $('#expReviewModal').fadeOut();
    });

    $('#closeModalBtn').click(function() {
        $('#expReviewModal').fadeOut();
    });

    // Close the modal if clicked outside of it
    $(window).click(function(event) {
        if ($(event.target).is('#expReviewModal')) {
            $('#expReviewModal').fadeOut();
        }
        
        if ($(event.target).is('#confirmationModal')) {
            $('#confirmationModal').fadeOut();
        }
        
        if ($(event.target).is('#expAddedInfoModal')) {
            $('#expAddedInfoModal').fadeOut();
        }
        
        if ($(event.target).is('#informationModal')) {
            $('#informationModal').fadeOut();
        }
    });

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


    //On Experience Page Load
    if (window.location.pathname == "/userprofile") {
        loadUserProfile();
        loadExperience();
        loadQualification();
    }

    
    // if (window.location.pathname == "/userprofile") {
    //     loadUserProfile();
    // }


    function loadUserProfile() {
        console.log('----------->-->loadUserProfile ');
        let eimager_id= $('#eimagerid').text().trim();

        if (eimager_id ) {
            $.ajax({
                url: "/user/fetchUserProfile", // Laravel login route
                type: "GET",
                data: {
                    eimagerId: eimager_id,
                },
                headers: {
                    "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
                },
                success: function (response) {
                    if (response.success) {
                        // console.log(response.data);
                        let profileData=response.data;

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
                        $("#user_profile_experience_section").addClass("show");
                        $('#user_profile_experience_section').removeClass("hide");
                        console.log(profileData.email, '----------->--> ', profileData.profile_image);
                        $("#profile_preview").attr("src", profileData.profile_image);
                        
                        
                        $("#request_current_name").text(profileData.first_name); 
                        $("#request_current_aadhar").text(profileData.aadhar_number); 
                        $("#request_current_pan").text(profileData.pan_number); 


                        if(!profileData.facebook) {
                            $('#fb_li').removeClass("show");
                            $("#fb_li").addClass("hide");
                        }
                        if(!profileData.linkedin) {
                            $('#linkedin_li').removeClass("show");
                            $("#linkedin_li").addClass("hide");
                        }
                        if(!profileData.twitter) {
                            $('#twitter_li').removeClass("show");
                            $("#twitter_li").addClass("hide");
                        }
                        
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


    $('#add-new-experience-btn').click(function() {
        $('#add-experience-form-container').removeClass("hide");
        $('#add-experience-form-container').addClass("show");
    });

    $('#add-experience-btn-close').click(function() {
        $('#add-experience-form-container').removeClass("show");
        $('#add-experience-form-container').addClass("hide");
    });


    $('#add-new-qualification-btn').click(function() {
        $('#add-qualification-form-container').removeClass("hide");
        $('#add-qualification-form-container').addClass("show");
    });

    $('#add-qualification-btn-close').click(function() {
        $('#add-qualification-form-container').removeClass("show");
        $('#add-qualification-form-container').addClass("hide");
    });

    $('#reviewExpBtn').click(function() {
        $('#expAddedInfoModal').fadeOut();
        $('html, body').animate({
            scrollTop: $("#all-experience-div").offset().top
        }, 1000);
    });

    $('#addMoreExpBtn').click(function() {
        $('#expAddedInfoModal').fadeOut();
        $('html, body').animate({
            scrollTop: $("#add-exp-box-container").offset().top
        }, 1000);
    });
    $('#addMoreQualificationBtn').click(function() {
        $('#qualificationAddedInfoModal').fadeOut();
        $('html, body').animate({
            scrollTop: $("#add-qualification-box-container").offset().top
        }, 1000);
    });
     

    //binds to onchange event of your input field
    $('#profileimage').bind('change', function() {
    //this.files[0].size gets the size of your file.
    console.log(this.files[0].size);
    if(this.files[0].size > 180000) {

    }
  });

});



document.addEventListener(
    'click', 
    function(e) {
      if (e.target.id === "collapse-ignore-button") {
        
        
        // Prevent all other listeners from being called 
        e.stopImmediatePropagation();
      }
    },
    true // Add listener to capturing phase
  );

  


