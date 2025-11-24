
$(document).ready(function () {
    if (window.location.pathname == "/admin-dashboard") {
        loadAdminReportData()
    }

    function loadAdminReportData() {
        $.ajax({
            url: "/admin/report", // Laravel login route
            type: "GET",
            headers: {
                "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
            },
            success: function (response) {
                if (response.success) {                    
                    $("#total_hr_registration").text(response.data[0]['hr_registration_count']); 
                    $("#total_employee_registration").text(response.data[0]['user_registration_count']); 

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

let profile_update_request_table = $('#profile_update_request_table').DataTable({
    "processing": true,
    "serverSide": false,
    "paging": true,
    "searching": true,
    "ordering": true,
    "info": true,
    "destroy": true,
    "ajax": {
        url: "/admin/profile-update-requests",
        type: "GET",
        dataSrc: function (data) {
            return data.map(row => ({
                ...row,
            }));
        }
    },
    "columns": [
        { "data": "eimager_id" },
        { "data": "existing_name" },
        { "data": "new_name" },
        { "data": "existing_aadhar" },
        { "data": "new_aadhar" },
        { "data": "existing_pan" },
        { "data": "new_pan" },
        {
            data: 'evidence_image',
            render: function(data, type, row, meta) {
                return `<a href="${data}" target="_blank">
                            <img src="${data}" alt="Image" style="height:50px;" />
                        </a>`;
            }
        },
        {
            data: 'approval_status',
            render: function(data, type, row, meta) {
                if(data === 'pending') {
                    return `<button class="btn btn-success mt-2 profile_update_request_btn" data-id="${row.id}" data-status="approved">Approve</button>
                            <button class="btn btn-danger mt-2 profile_update_request_btn" data-id="${row.id}" data-status="rejected">Reject</button>`;
                } else {
                    return data;
                }
                
            }
        },
    ]
});

// $("#profile_request_approval").on("click", function (e) {
$(document).on('click', '.profile_update_request_btn', function () {
    let id = $(this).data('id');       // Get data-id value
    let status = $(this).data('status');       // Get data-status value
    console.log('Clicked:', id, status);

    $.ajax({
        url: "/admin/profile-update-requests-approval", // Laravel login route
        type: "POST",
        data: {
            id: id,
            status: status,
        },
        headers: {
            "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
        },
        success: function (response) {
            if (response.success) {
                // Show Toastr success message
                toastr.success("Status Updated Sucessfully", "Success", {
                    closeButton: true,
                    progressBar: true,
                    positionClass: "toast-top-right",
                    timeOut: 2000 // 2 seconds before redirection
                });
        
        
                // Redirect after a short delay
                setTimeout(function () {
                    window.location.href = response.redirect;
                }, 2000); 
            } else {
                // Show Toastr error message
                toastr.error(response.message, "Failed to update the", {
                    closeButton: true,
                    progressBar: true,
                    positionClass: "toast-top-right",
                    timeOut: 3000 // 3 seconds
                });
            }
        },
    });
}); 
    
let hr_registration_table = $('#hr_registration_report_table').DataTable({
    "processing": true,
    "serverSide": false,
    "paging": true,
    "searching": true,
    "ordering": true,
    "info": true,
    "destroy": true,
    "ajax": {
        url: "/admin/hr_registration_by_date", // Admin route
        type: "GET",
        dataSrc: function (data) {
            return data.map(row => ({
                ...row,
            }));
        }
    },
    "columns": [
        { "data": "date" },
        { "data": "count" },
    ]
});

let employee_registration_table = $('#employee_registration_report_table').DataTable({
    "processing": true,
    "serverSide": false,
    "paging": true,
    "searching": true,
    "ordering": true,
    "info": true,
    "destroy": true,
    "ajax": {
        url: "/admin/employee_registration_by_date", // Admin route
        type: "GET",
        dataSrc: function (data) {
            return data.map(row => ({
                ...row,
            }));
        }
    },
    "columns": [
        { "data": "date" },
        { "data": "count" },
    ]
});


    
let all_employer_table = $('#employer_profile_deactivation_table').DataTable({
    "processing": true,
    "serverSide": false,
    "paging": true,
    "searching": true,
    "ordering": true,
    "info": true,
    "destroy": true,
    "ajax": {
        url: "/admin/viewAllEmployer", 
        type: "GET",
        dataSrc: function (data) {
            return data.map(row => ({
                ...row,
            }));
        }
    },
    "columns": [
        { "data": "hr_unique_id" },
        { "data": "hr_name" },
        { "data": "hr_email" },
        { "data": "hr_phone" },
        { "data": "hr_aadhar" },
        { "data": "hr_pan" },
        { "data": "hr_dob" },
        { "data": "company_name" },
        { "data": "reporting_manager_name" },
        {
            data: 'is_profile_deactivated',
            render: function(data, type, row, meta) {
                if (data == 1) {
                  return 'Deactivated';
                } else if (data == 0) {
                //   return '<span class="badge bg-success">Active</span>';
                return `<button class="btn btn-danger mt-2 profile_deactivate_request_btn" data-id="${row.id}" data-eimagerid="${row.hr_unique_id}" data-status="deactivate">Deactivate</button>`
                }
            }
        },
        
    ]
});


// $("#profile_request_approval").on("click", function (e) {
$(document).on('click', '.profile_deactivate_request_btn', function () {
    let $btn = $(this); // Store button reference
    $btn.prop("disabled", true).text("Please wait..."); // Disable and change text
    let eId = $(this).data('eimagerid');       // Get data-id value


    let formData = {
            eimagerId: eId,
        };

        $.ajax({
            url: '/admin/deactivateHrProfileByAdmin',
            type: "POST",
            data: formData,
            headers: {
                "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
            },
            success: function (response) {
                $('#updateExperienceEnddateModal').modal('hide'); 

                toastr.success("Profile has been deactivated successfully", "Success", {
                    timeOut: 1500,  // Disappears after 1.5 seconds
                    progressBar: true, // Show progress bar
                    closeButton: true, // Show close button
                    positionClass: "toast-top-right" // Center position
                });
                
                console.log('-----------',  response.redirect);
                
                // Redirect after a short delay
                setTimeout(function () {
                    window.location.href = response.redirect;
                }, 2000); // Matches toast display time
            },
            error: function (xhr) {
                alert("Error updating status");
            }
        });
}); 

$("#admin-login-submit").on("click", function (e) {
    e.preventDefault(); // Prevent default form submission
    console.log("Admin Login clicked");
    $(".error").text(""); // Clear previous errors

    let adminEmail = $("#admin_email").val().trim();
    let adminPassword = $("#admin_password").val().trim();

    if (adminEmail === "" || adminPassword === "") {
        if (adminEmail === "") {
            $("#admin_email").siblings(".error").text("Email is required.");
        }
        if (adminPassword === "") {
            $("#admin_password").siblings(".error").text("Password is required.");
        }
        return;
    }

    $.ajax({
        url: "/admin-login", // Laravel login route
        type: "POST",
        data: {
            admin_email: adminEmail,
            admin_password: adminPassword,
        },
        headers: {
            "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
        },
        success: function (response) {
            if (response.success) {
                // Show Toastr success message
                toastr.success("Admin Login Successful!", "Success", {
                    closeButton: true,
                    progressBar: true,
                    positionClass: "toast-top-right",
                    timeOut: 2000 // 2 seconds before redirection
                });
        
                // ✅ Reset the form fields after success
                $("#admin_email").val("");
                $("#admin_password").val("");
        
                // Redirect after a short delay
                setTimeout(function () {
                    window.location.href = response.redirect;
                }, 2000); // Matches toast display time
            } else {
                // Show Toastr error message
                toastr.error(response.message, "Login Failed", {
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
                if (errors.admin_email) {
                    $("#admin_email").siblings(".error").text(errors.admin_email[0]);
                }
                if (errors.admin_password) {
                    $("#admin_password").siblings(".error").text(errors.admin_password[0]);
                }
                if (!errors.admin_email && !errors.admin_password) {
                    alert("Please enter valid email and password");
                }
            } else {
                // ❌ Show alert message for invalid login
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

$("#admin-logout-btn").on("click", function (e) {
    e.preventDefault();

    $.ajax({
        url: "/admin-logout",
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
            // Show Toastr error message for failed request
            toastr.error("Something went wrong. Please try again.", "Error", {
                closeButton: true,
                progressBar: true,
                positionClass: "toast-top-right",
                timeOut: 3000 // 3 seconds
            });
        }
    });
}); 

// let table = $('#adminapprovalRequestsTable').DataTable({
//     "processing": true,
//     "serverSide": false,
//     "paging": true,
//     "searching": true,
//     "ordering": true,
//     "info": true,
//     "destroy": true,
//     "ajax": {
//         url: "/admin/approval-requests", // Admin route
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
//         { "data": "approval_status" } // ❌ Removed action buttons
//     ]
// });

// // Refresh DataTable when clicking "View Requests"
// $('#adminviewRequestsBtn').on('click', function () {
//     table.ajax.reload();
// });
let table = $('#adminapprovalRequestsTable').DataTable({
    processing: true,
    serverSide: false,
    paging: true,
    searching: true,
    ordering: true,
    info: true,
    destroy: true,
    ajax: {
        url: "/admin/approval-requests",
        type: "GET",
        dataSrc: function (json) {
            // json might be { data: [...] } or just [...] depending on backend
            let rows = (json && json.data) ? json.data : json;

            if (!Array.isArray(rows)) {
                console.error('DataTables: unexpected AJAX response for approval-requests', json);
                // return empty array so DataTables displays "No data" instead of raising error
                return [];
            }

            // Normalize nulls
            return rows.map(row => ({
                ...row,
                ctc: row.ctc ?? "N/A",
                in_hand: row.in_hand ?? "N/A",
                // also ensure these fields exist so DataTable columns don't break
                first_name: row.first_name ?? '',
                aadhar_number: row.aadhar_number ?? '',
                pan_number: row.pan_number ?? '',
                company_name: row.company_name ?? '',
                designation: row.designation ?? '',
                projects: row.projects ?? '',
                start_date: row.start_date ?? '',
                end_date: row.end_date ?? '',
                roles_responsibility: row.roles_responsibility ?? '',
                approval_status: row.approval_status ?? ''
            }));
        },
        error: function(xhr, status, error) {
            // helpful console info (and avoid default DataTables alert if you prefer)
            console.error('AJAX error fetching approval-requests:', status, error, xhr.responseText);
            // optionally show a friendly toast
            toastr.error('Failed to load approval requests. See console for details.');
        }
    },
    columns: [
        { data: "eimager_id" },
        { data: "first_name" },
        { data: "aadhar_number" },
        { data: "pan_number" },
        { data: "company_name" },
        { data: "designation" },
        { data: "projects" },
        { data: "start_date" },
        { data: "end_date" },
        { data: "roles_responsibility" },
        { data: "ctc" },
        { data: "in_hand" },
        { data: "approval_status" }
    ]
});



$('#userForm').on('submit', function(e){
    e.preventDefault();

    let formData = {
        name: $("#name").val(),
        email: $("#email").val(),
        number: $("#number").val(),
        password: $("#password").val(),
        aadhar: $("#aadhar").val(),
        pan: $("#pan").val(),
        dob: $("#dob").val(),
       
    };

    $.ajax({
        type: "POST",
        url: "/user/store",
        data: formData,
        success: function(response){
            if(response.success){
                // alert(response.message + "\nGenerated Unique ID: " + response.unique_id);
                toastr.success(
                    response.message + '<br>Generated Unique ID: <strong>' + response.unique_id + '</strong>',
                    'Success',
                    {
                        closeButton: true,
                        progressBar: true,
                        positionClass: 'toast-top-right',
                        timeOut: 3000
                    }
                );
                $('#userForm')[0].reset();
                $('userModal').hide();
            }
        },
        error: function(xhr){
            if(xhr.responseJSON.errors){
                $.each(xhr.responseJSON.errors, function(key, val){
                    $('.' + key + '_error').text(val[0]);
                });
            }
        }
    });
});

});