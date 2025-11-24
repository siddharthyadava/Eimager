<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Dashboard</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Ubuntu:wght@400;500;700&display=swap" rel="stylesheet">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz"
        crossorigin="anonymous"></script>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.2/font/bootstrap-icons.css">
    <!-- <link rel="stylesheet" href="css/bootstrap.css"> -->
    <!-- <link rel="stylesheet" href="css/style.css"> -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    <!-- <link rel="stylesheet" href="{{ asset('css/custom.css') }}"> -->
    <link rel="stylesheet" href="{{ asset('css/employer.css') }}">
    <link rel="stylesheet" href="css/dataTables.bootstrap5.min.css">
    <link rel="stylesheet" href="css/style.css">
</head>
<style>

    .list-component2 {
            padding-left: 0px;
        }
        
    /* Apply only on small phones */
    @media (max-width: 576px) {
        .img-center {
            display: flex;
            justify-content: center;
            align-items: center;
            text-align: center;
        }
    
        #profile_preview {
            max-width: 100%;
            height: auto;
            margin: 0 auto;
        }
    }
        
    @media print {
        body * {
            visibility: hidden;
            /* Hide everything */
        }

        #user_profile_experience_section,
        #user_profile_experience_section * {
            visibility: visible;
            /* Show only the profile section */
        }

        #user_profile_experience_section {
            position: absolute;
            left: 0;
            top: 0;
            width: 100%;
        }

        .no-print {
            display: none !important;
            /* Hide elements like buttons */
        }
    }
</style>

<body>
    <script src="{{ asset('js/custom.js') }}"></script>
    <script src="{{ asset('js/employeer.js') }}"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
    <nav class="navbar navbar-expand-lg navbar-light shadow-sm bg-light">
        <div class="container-fluid">
            <button class="navbar-toggler" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasExample"
                aria-controls="offcanvasExample">
                <span class="navbar-toggler-icon"></span>
            </button>
            <a class="navbar-brand fw-bold" href="{{ route('hrdashboard')  }}">
                <img src="{{url('/images/logo.jpg')}}" alt="BootstrapBrain Logo" width="200">
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent"
                aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav ms-auto me-md-4 mb-2 mb-lg-0">
                    <li class="nav-item dropdown d-flex text-light">

                        <button id="hr-logout-btn" class="btn btn-danger">Logout</button>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
    <!-- navbar end -->
    <!-- sidebar -->
    <div class="offcanvas offcanvas-start bg-purple text-white sidebar-nav" tabindex="-1" id="offcanvasExample"
        aria-labelledby="offcanvasExampleLabel">
        <div class="offcanvas-header shadow-sm d-block text-center">
            <div class="offcanvas-title" id="offcanvasExampleLabel">
                <a class="navbar-brand fw-bold" href="{{ route('hrdashboard')  }}">
                    <img src="{{url('/images/logo.jpg')}}" alt="BootstrapBrain Logo" width="200">
                </a>
            </div>
        </div>
        <div class="offcanvas-body pt-3 p-0">
            <nav class="navbar-dark">
                <ul class="navbar-nav sidenav">
                    <li class="nav-link bordered px-3 active">
                        <a href="{{ route('hrdashboard')  }}" class="nav-link px-3 active">
                            @if(session()->has('user'))
                            <p><strong>Name:</strong> {{ session('user')->hr_name }}</p>
                            <p><strong>EImager ID:</strong>
                                <p id='eimagerid'>{{ session('user')->hr_unique_id }}</p>
                            </p>
                            @else
                            <p>User not logged in.</p>
                            @endif
                        </a>
                    </li>
                    <li class="nav-link bordered px-3">
                        <a href="{{ route('hrdashboard')  }}" class="nav-link px-3">
                            <span class="me-2"><i class="bi bi-intersect"></i></span>
                            <span>All Requests</span>
                        </a>
                    </li>
                    <li class="nav-link bordered px-3">
                        <a href="{{ route('hr.employeeprofile')  }}" class="nav-link px-3">
                            <span class="me-2"><i class="bi bi-award"></i></span>
                            <span>Employee Profile</span>
                        </a>
                    </li>
                    <li class="nav-link bordered px-3">
                        <a href="{{ route('hr.profile')  }}" class="nav-link px-3">
                            <span class="me-2"><i class="bi bi-person"></i></span>
                            <span>Profile</span>
                        </a>
                    </li>
                    @php
                    $isHrAdmin = session('user')->is_hr_admin;
                    @endphp

                    @if($isHrAdmin)
                    <!-- Show something for HR admin -->
                    <li class="nav-link bordered px-3">
                        <a href="" class="nav-link px-3" id="openaddHrModal">
                            <span class="me-2"><i class="bi bi-person"></i></span>
                            <span>Add HR</span>
                        </a>
                    </li>
                    @else

                    @endif
                </ul>
            </nav>
        </div>
    </div>
    <!-- sidebar end -->
    <main class="mt-3 p-2">
        <div class="container">
            <div class="row">
                <div class="col-md-8 no-print">
                    <div class="page-title">
                        <div style="font-weight: 500;" class="fs-3">Search Employee Profile/Report</div>
                    </div>
                    <div class="card-component row " style="margin-top:30px">
                        <div style="width: 100%;  float:left">
                            <input id='eimager_id_seach_input' class="form-control py-2 rounded-pill mr-1 pr-5" type="search" placeholder="Enter Employee EImager Id">
                            <input type="hidden" id="eimager_id_hidden" name="eimager_id">
                        </div>

                        <div style="width: 100%; margin-top:10px; margin-bottom:10px; text-align:center;">
                            <span style="width: 100%; float:center"> OR </span>
                        </div>
                        <div style="width: 100%;  float:left">
                            <input id='aadhar_number_search_input' class="form-control py-2 rounded-pill mr-1 pr-5" type="search" placeholder="Enter Employee Aadhar Number">
                        </div>

                        <div style="width: 100%; margin-top:10px; margin-bottom:10px; text-align:center;">
                            <span style="width: 100%; float:center"> OR </span>
                        </div>
                        <div style="width: 100%;  float:left">
                            <input id='pan_number_search_input' style="width: 100%; float:left" class="form-control py-2 rounded-pill mr-1 pr-5" type="search" placeholder="Enter Employee PAN Number">
                        </div>

                        <div style="width: 100%; margin-top:10px; margin-bottom:10px; text-align:center;">
                            <span style="width: 100%; float:center"> OR </span>
                        </div>
                        <div style="width: 100%;  float:left">
                            <input id='email_search_input' style="width: 100%; float:left" class="form-control py-2 rounded-pill mr-1 pr-5" type="search" placeholder="Enter Employee Email">
                        </div>
                        <a id='employee_search_btn' class="btn btn-success m-3 mb-2 w-25 mt-3">
                            Search
                        </a>
                        <div>
                        </div>
                    </div>
                </div>
                <div class="col-md-12">
                    <!-- profile add -->
                    <section id='user_profile_experience_section' class="bg-light hide">
                        <div class="page-title">
                            <div style="font-weight: 500;" class="fs-3 profile-title">Employee Profile</div>
                        </div>
                        <div class="container">
                            <div class="row">
                                <div class="col-lg-12 mb-4 mb-sm-5">
                                    <div class="card card-style1 border-0">
                                        <div class="card-body p-1-9 p-sm-2-3 p-md-6 p-lg-7">
                                            <div class="row align-items-center">
                                                <div class="col-lg-6 mb-4 mb-lg-0 img-center">
                                                    <img id="profile_preview"
                          src="{{url('/images/avatar7.png')}}"
                          alt="Profile Image" width="280px">
                                                </div>
                                                <div class="col-lg-6 px-xl-10">
                                                    <div class="bg-secondary d-lg-inline-block py-1-9 px-1-9 px-sm-6 mb-1-9 rounded">
                                                        <h3 id='user_first_name' class="h2 text-white mb-0"></h3>
                                                        <span id='user_type' class="text-primary"></span>
                                                    </div>
                                                    <ul class="list-unstyled mb-1-9">
                                                        <li class="mb-2 mb-xl-3 display-28"><span class="display-26 text-secondary me-2 font-weight-600">Contact:</span> <span id='user_mobile_number'></span></li>
                                                        <li class="mb-2 mb-xl-3 display-28"><span class="display-26 text-secondary me-2 font-weight-600">DOB:</span> <span id='user_dob'></span></li>
                                                        <li class="mb-2 mb-xl-3 display-28"><span class="display-26 text-secondary me-2 font-weight-600">Email:</span> <span id='user_email'></span></li>
                                                        <li class="mb-2 mb-xl-3 display-28"><span class="display-26 text-secondary me-2 font-weight-600">Aadhar:</span> <span id='user_aadhar_number'></span></li>
                                                        <li class="mb-2 mb-xl-3 display-28"><span class="display-26 text-secondary me-2 font-weight-600">PAN:</span> <span id='user_pan_number'></span></li>
                                                        <li id='fb_li' class="mb-2 mb-xl-3 display-28"><span class="display-26 text-secondary me-2 font-weight-600"><i class="fa-brands fa-facebook" data-bs-toggle="tooltip" data-bs-placement="left" title="Facebook"></i></span> <span id='user_facebook'></span></li>
                                                        <li id='linkedin_li' class="mb-2 mb-xl-3 display-28"><span class="display-26 text-secondary me-2 font-weight-600"><i class="fa-brands fa-linkedin" data-bs-toggle="tooltip" data-bs-placement="left" title="LinkedIn"></i></span> <span id='user_linkedin'></span></li>
                                                        <li id='twitter_li' class="mb-2 mb-xl-3 display-28"><span class="display-26 text-secondary me-2 font-weight-600"><i class="fa-brands fa-twitter" data-bs-toggle="tooltip" data-bs-placement="left" title="Twitter"></i></span> <span id='user_twitter'></span></li>
                                                    </ul>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-6 col-md-6 mb-2 mb-sm-5 no-print">
                                    <a id='send_otp' class="btn btn-success mr-1 mb-2 w-90 mt-3" style="font-size:20px;">
                                        Send OTP to See Profile
                                    </a>
                                </div>
                                
                                <div class="col-lg-6 col-md-6 mb-2 mb-sm-5 verify-otp no-print">
                                    <!-- <button type="button" class="btn btn-success" id="verifyOtpBtn">
                                        Verify OTP
                                    </button> -->
                                    <div id="otpForm" style="display: none; margin-top: 20px;">
                                        <label for="otpInput" class="form-label">Enter OTP:</label>
                                        <input type="text" class="form-control" id="otpInput" placeholder="Enter OTP">
                                        <a href="javascript:void(0);" class="btn btn-primary w-100 mt-3" id="submitOtp">
                                            Verify
                                        </a>
                                    </div>
                                </div>
                                <div class="col-lg-12 mb-4 mb-sm-5">
                                    <div>
                                        <span class="section-title text-primary mb-3 mb-sm-4">About Me</span>
                                        <p>Results-driven customer service representative with experience in relavant sector, recognized for delivering exceptional customer experiences and resolving conflicts effectively. Achieved a 25% increase in customer retention through prompt and efficient complaint resolution. Promoted to lead associate for consistently exceeding sales targets and maintaining a 95% customer satisfaction score.</p>
                                        <p class="mb-0">This summary highlights your most significant accomplishments, relevant work experience, and job-specific skills.</p>
                                    </div>
                                </div>
                                <div id='all-qualification-div'>
                                    <span class="section-title text-primary mb-3 mb-sm-4">Qualification</span>
                                    <ul id="user_qualification_list_comp" class="list-component2" style="margin-left: 0px">
                                    </ul>
                                </div>
                                <div class="col-lg-12">
                                    <div class="row">
                                        <div class="col-lg-12 mb-4 mb-sm-5">
                                            <div id='all-experience-div'>
                                                <span class="section-title text-primary mb-3 mb-sm-4">Experience</span>
                                                <ul id="user_exp_list_comp" class="list-component2" style="margin-left: 0px">
                                                </ul>
                                            </div>

                                        </div>
                                    </div>
                                </div>

                                <div id='all-complain-div'>
                                    <div class="col-lg-12 mb-4 mb-sm-5">
                                        <div id='add-complaint-box-container'>
                                            <span class="section-title text-primary mb-3 mb-sm-4">Complaint Report</span>
                                            <p>Report a complaint</p>
                                            <button id="add-new-complaint-btn" class="btn btn-primary mt-2 no-print">Report here</button>
                                            <div id="add-complaint-form-container" class='hide'>
                                                <div class="form-group-q border mb-2 position-relative" id="form-1">
                                                    <button id="add-complaint-btn-close" class='x'> X </button>
                                                    <label>Complaint Report for</label>
                                                    <input id='complaint-name-filed' type="text" required title="This field should not be left blank." class="form-control q-school" placeholder="Ex: Stolen Device or Not Served Notice Period">
                                                    <span class="complaint-name-error error-text"></span>

                                                    </br><label>Complaint Description</label>
                                                    <input id='complaint-details-field' type="text" required class="form-control q-degree" placeholder="Ex: Details incident about the complaint">
                                                    <span class="complaint-details-error error-text"></span>


                                                    </br><button id="save-complaint" class="btn btn-primary mt-2">Save Complaint</button>

                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div id='all-complaint-div'>
                                        <span class="section-title text-primary mb-3 mb-sm-4">Complaints</span>
                                        <ul id="user_complaint_list_comp" class="list-component2" style="margin-left: 100px">
                                    </div>
                                </div>

                            </div>
                        </div>
                        <!-- extra button -->
                        <button id="print-profile-btn" class="btn btn-primary mt-3 no-print" style="display:none;">Print Profile</button>
                        <!-- extra button -->
                    </section>
                </div>
            </div>
            <!-- Information Modal -->
            <div id="informationModal" class="modal">
                <!-- Modal content -->
                <div class="modal-content2">
                    <h3 id='infoModalMsgBox'></h3>
                    <br>
                    <div class='button-container'>
                        <button class="submit-btn width-100" id="modalOkBtn">OK</button>
                    </div>
                </div>
            </div>
            <!-- Approval Popup Modal -->
            <div class="modal fade" id="approvalRejectionModal" tabindex="-1" aria-labelledby="approvalModalLabel" aria-hidden="true">

                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="approvalModalLabel">Update Approval Status</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <input type="hidden" id="expId">
                            <input type="hidden" id="approvalStatus">
                            <div class="mb-3">
                                <label for="statusNote" class="form-label">Remarks</label>
                                <textarea id="statusNote" class="form-control" rows="3" placeholder="Enter your note"></textarea>
                            </div>
                            <div class="modal-footer">
                                <button type="button" id="submitApproval" class="btn btn-primary">Send OTP</button>
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                            </div>
                        </div>

                        <div id='approvalRejectionOTPSection' class="modal-body hide">
                            <div class="mb-3">
                                <label for="otp" class="form-label">Verify OTP</label>
                                <textarea id="approvalRejectionOtp" class="form-control" rows="1" placeholder="OTP"></textarea>
                            </div>
                            <div class="modal-footer">
                                <button type="button" id="verifySubmitApproval" class="btn btn-success">Verify & Submit</button>
                            </div>
                        </div>

                    </div>
                </div>
            </div>

            <!-- Update Experience End date Popup Modal -->
            <div class="modal fade" id="updateExperienceEnddateModal" tabindex="-1" aria-labelledby="approvalModalLabel" aria-hidden="true">

                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="approvalModalLabel">Update Last working date</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <input type="hidden" id="lwdexpId">
                            <input type="hidden" id="lwd_val">
                            <label>Last Working Day</label>
                            <input id='end-date-field' type="date" required class="form-control end-date" placeholder="Enter last date">

                            <div class="modal-footer">
                                <button type="button" id="submitLwdOTP" class="btn btn-primary">Send OTP</button>
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                            </div>
                        </div>

                        <div id='lwdOTPSection' class="modal-body hide">
                            <div class="mb-3">
                                <label for="otp" class="form-label">Verify OTP</label>
                                <textarea id="lwdOtp" class="form-control" rows="1" placeholder="OTP"></textarea>
                            </div>
                            <div class="modal-footer">
                                <button type="button" id="verifySubmitlwd" class="btn btn-success">Verify & Submit</button>
                            </div>
                        </div>

                    </div>
                </div>
            </div>

            <!-- Complaint Added Info Modal -->
            <div id="complaintAddedInfoModal" class="modal">
                <!-- Modal content -->
                <div class="modal-content2">
                    <h3>Complaint has been raised successfully. </h3>
                    <br>
                    <div class='button-container'>
                        <button class="submit-btn" id="addMoreComplaintBtn">Add more Complaint</button>
                    </div>
                </div>
            </div>



            <!-- approval-modal -->
            <!-- add hr modal -->
            <div id="hrModal" style="display: none;">
                <div style="background: #fff; padding: 20px; border-radius: 8px; width: 500px; margin: 100px auto; position: relative;">
                    <button id="closeHrModal" class="close-btn" style="position: absolute; top: 10px; right: 10px;">&times;</button>
                    <h4>Add HR</h4>
                    <form id="hrForm">
                        <div class="mb-2">
                            <label for="hr_name" class="form-label">HR Name</label>
                            <input type="text" name="hr_name" id="hr_name" class="form-control">
                            <span class="text-danger error-text hr_name_error"></span>
                        </div>

                        <div class="mb-2">
                            <label for="hr_email" class="form-label">HR Email</label>
                            <input type="email" name="hr_email" id="hr_email" class="form-control" required>
                            <span class="text-danger error-text hr_email_error"></span>
                        </div>

                        <div class="mb-2">
                            <label for="hr_phone" class="form-label">HR Phone</label>
                            <input type="text" name="hr_phone" id="hr_phone" class="form-control" required>
                            <span class="text-danger error-text hr_phone_error"></span>
                        </div>

                        <div class="mb-2">
                            <label for="hr_password" class="form-label">HR Password</label>
                            <input type="password" name="hr_password" id="hr_password" class="form-control" required>
                            <span class="text-danger error-text hr_password_error"></span>
                        </div>

                        <div class="mb-2">
                            <label for="company_name" class="form-label">Company Name</label>
                            <input type="text" name="company_name" id="company_name" class="form-control" required>
                            <span class="text-danger error-text company_name_error"></span>
                        </div>

                        <div class="mb-2">
                            <label for="reporting_manager_mail" class="form-label">Reporting Manager Email</label>
                            <input type="email" name="reporting_manager_mail" id="reporting_manager_mail" class="form-control" required>
                            <span class="text-danger error-text reporting_manager_mail_error"></span>
                        </div>

                        <div class="mb-2">
                            <label for="hr_aadhar" class="form-label">HR Aadhar</label>
                            <input type="text" name="hr_aadhar" id="hr_aadhar" class="form-control" required>
                            <span class="text-danger error-text hr_aadhar_error"></span>
                        </div>

                        <div class="mb-2">
                            <label for="hr_pan" class="form-label">HR PAN</label>
                            <input type="text" name="hr_pan" id="hr_pan" class="form-control" required>
                            <span class="text-danger error-text hr_pan_error"></span>
                        </div>

                        <div class="mb-2">
                            <label for="hr_dob" class="form-label">Date of Birth</label>
                            <input type="date" name="hr_dob" id="hr_dob" class="form-control" required>
                            <span class="text-danger error-text hr_dob_error"></span>
                        </div>

                        <div class="mb-2">
                            <label for="reporting_manager_name" class="form-label">Reporting Manager Name</label>
                            <input type="text" name="reporting_manager_name" id="reporting_manager_name" class="form-control" required>
                            <span class="text-danger error-text reporting_manager_name_error"></span>
                        </div>

                        <div class="mb-2">
                            <label for="reporting_manager_contact" class="form-label">Reporting Manager Contact</label>
                            <input type="text" name="reporting_manager_contact" id="reporting_manager_contact" class="form-control" required>
                            <span class="text-danger error-text reporting_manager_contact_error"></span>
                        </div>

                        <div class="mb-3">
                            <label for="company_website" class="form-label">Company Website</label>
                            <input type="text" name="company_website" id="company_website" class="form-control" required>
                            <span class="text-danger error-text company_website_error"></span>
                        </div>

                        <button type="submit" id="addhrstore" class="btn btn-primary w-100">Submit</button>
                    </form>
                </div>
            </div>
            <!-- add hr modal -->
            <!-- Bootstrap OTP Verification Modal -->
            <!-- Bootstrap OTP Verification Modal -->
            <!-- otp verification modal -->
            <!-- <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            ...
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                            <button type="button" class="btn btn-primary">Save changes</button>
                        </div>
                    </div>
                </div>
            </div> -->
        </div>
    </main>


    <script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.6/js/dataTables.bootstrap5.min.js"></script>
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'));
            var tooltipList = tooltipTriggerList.map(function(tooltipTriggerEl) {
                return new bootstrap.Tooltip(tooltipTriggerEl);
            });
        });
    </script>
    <script>
        $(document).ready(function() {
            $(".navbar-toggler").click(function() {
                $("#offcanvasExample").addClass("show");
            });
            // document.getElementById("verifyOtpBtn").addEventListener("click", function() {
            //     document.getElementById("otpForm").style.display = "block";  
            //     this.style.display = "none"; 
            // });
            $(document).on('click', '#verifyOtpBtn', function() {
                $('#otpForm').show(); // Show OTP form
                $(this).hide(); // Hide "Verify OTP" button
            });
            $("#eimager_id_seach_input").on("input", function() {
                var enteredValue = $(this).val();
                $("#eimager_id_hidden").val(enteredValue);
            });
            document.getElementById('print-profile-btn').addEventListener('click', function() {
                window.print();
            });
        });
    </script>
    <script>
        $(document).ready(function() {
            $('#openaddHrModal').on('click', function(e) {
                e.preventDefault();
                $('#hrModal').show();
            });

            $('#closeHrModal').on('click', function() {
                $('#hrModal').fadeOut();
            });

        });
    </script>
    <style>
        /* #hrModal {
  position: fixed;
  top: 0;
  left: 0;
  right: 0;
  bottom: 0;
  background: rgba(0, 0, 0, 0.5);
  z-index: 9999;
  overflow-y: auto; 
  display: none;
} */
        #hrModal {
            position: fixed;
            inset: 0;
            /* shorthand for top, right, bottom, left = 0 */
            background: rgba(0, 0, 0, 0.5);
            z-index: 9999;
            display: none;
            overflow-y: auto;
            /* Scroll if content is long */
        }

        /* Modal content box */
        #hrModal .modal-content {
            background: #fff;
            padding: 30px 20px;
            border-radius: 10px;
            width: 95%;
            max-width: 600px;
            margin: 50px auto;
            position: relative;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.2);
        }

        /* Close button styling */
        #hrModal .close-btn {
            position: absolute;
            top: 15px;
            right: 15px;
            background: #000;
            color: #fff;
            border: none;
            border-radius: 50%;
            width: 32px;
            height: 32px;
            font-size: 18px;
            font-weight: bold;
            cursor: pointer;
            transition: background 0.3s;
        }

        #hrModal .close-btn:hover {
            background: #dc3545;
        }

        .form-label {
            font-weight: 600;
            margin-bottom: 4px;
            display: inline-block;
            color: #333;
        }

        .text-danger {
            font-size: 0.875rem;
            margin-top: 4px;
            display: block;
        }
    </style>
</body>

</html>
