<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Dashboard</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
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
    <link rel="stylesheet" href="css/dataTables.bootstrap5.min.css">
    <!-- <link rel="stylesheet" href="css/style.css"> -->
</head>

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
                        <a href="index.html" class="nav-link px-3 active">
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
                            <span>Add Hr</span>
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
            <div class="col-md-12">
                <div class="page-title">
                    <div style="font-weight: 500;" class="fs-3">Employer Profile</div>
                </div>
                <!-- <nav class="mt-2 mb-4" style="--bs-breadcrumb-divider: '>';" aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Dashboard</li>
                    </ol>
                </nav> -->

                <div class="dashboard">
                    <div class="row">
                        <div class="col-md-4">
                            <div class="card px-4 border-0 shadow-sm">
                                <div class="card-body">
                                    <div class="fs-5 text-end">
                                    @if(session()->has('request_count'))
                                        <p>{{ session('request_count')}}</p>
                                    @else
                                        <p>0</p>
                                    @endif
                                    </div>
                                    <div style="margin-top: -10px;" class="fs-3 text-start text-info">
                                      <i class="bi bi-people-fill"></i>
                                    </div>
                                    <div style="margin-top: -40px;" class="fs-5 pt-4 text-end">
                                      Total Requests
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="card px-4 border-0 shadow-sm">
                                <div class="card-body">
                                    <div class="fs-5 text-end">
                                        @if(session()->has('approval_count'))
                                            <p>{{ session('approval_count')}}</p>
                                        @else
                                            <p>0</p>
                                        @endif
                                        </div>
                                        <div style="margin-top: -10px;" class="fs-3 text-start text-warning">
                                          <i class="bi bi-intersect"></i>
                                        </div>
                                        <div style="margin-top: -40px;" class="fs-5 pt-4 text-end">
                                          Approvals
                                        </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="card px-4 border-0 shadow-sm">
                                <div class="card-body">
                                    <div class="fs-5 text-end">
                                    @if(session()->has('pending_count'))
                                        <p>{{ session('pending_count')}}</p>
                                    @else
                                        <p>0</p>
                                    @endif
                                    </div>
                                    <div style="margin-top: -10px;" class="fs-3 text-start text-danger">
                                      <i class="bi bi-journal-text"></i>
                                    </div>
                                    <div style="margin-top: -40px;" class="fs-5 pt-4 text-end">
                                      Pending Approvals
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- profile add -->
                <div class="profile-card card">
                    <div class="card-header bg-primary text-white">
                        <h4>Employer Profile</h4>
                    </div>
                    <div class="card-body">
                        <table class="table">
                            <tr>
                                <th>Name:</th>
                                <td>{{ $hr->hr_name }}</td>
                            </tr>
                            <tr>
                                <th>Company Name:</th>
                                <td>{{ $hr->company_name }}</td>
                            </tr>
                            <tr>
                                <th>Officail Mail Id:</th>
                                <td>{{ $hr->hr_email }}</td>
                            </tr>
                            <tr>
                                <th>Phone:</th>
                                <td>{{ substr($hr->hr_phone, 0, 3) . '****' . substr($hr->hr_phone, -3) }} (your number is secure)</td>
                            </tr>

                            <tr>
                                <th>Aadhaar:</th>
                                <td>{{ $hr->hr_aadhar ?? '' }} {{ $hr->hr_aadhar ? '(Your Aadhar is secure)' : '' }}</td>
                            </tr>
                            <tr>
                                <th>PAN:</th>
                                <td>{{ $hr->hr_pan ?? '' }} {{ $hr->hr_pan ? '(Your Pan is secure)' : '' }}</td>
                            </tr>
                            <tr>
                                <th>DOB:</th>
                                <td>{{ $hr->hr_dob ?? '' }}</td>
                            </tr>
                            <tr>
                                <th>Reporting Manager Name:</th>
                                <td>{{ $hr->reporting_manager_name ?? '' }}</td>
                            </tr>
                            <tr>
                                <th>Reporting Manager Mail Id:</th>
                                <td>{{ $hr->reporting_manager_mail ?? '' }}</td>
                            </tr>
                            <tr>
                                <th>Created At:</th>
                                <td>{{ $hr->created_at }}</td>
                            </tr>
                            <tr>
                                <th>Deactivate Account:</th>
                                <td><button id="hr-deactivate-btn" class="btn btn-danger">Deactivate Account</button></td>
                            </tr>
                        </table>
                    </div>
                </div>
                <!-- profile add -->
            </div>
            <!-- profile image section -->
            <div class="col-lg-6 mb-4 mb-lg-0">
                <!-- <img id="profile_preview"
                    src="{{ session('user')->profile_image ? asset('storage/public/' . session('user')->profile_image) : url('/images/avatar7.png') }}"
                    alt="Profile Image" width="315px"> -->
                <img id="profile_preview"
                    src="{{ $hr->profile_image ? asset('storage/public/' . $hr->profile_image) : url('/images/avatar7.png') }}"
                    alt="Profile Image"
                    width="315px">
                <br><br>
                <br><br>
                <form id="uploadProfileImagehr" enctype="multipart/form-data">
                    <input type="hidden" id="hr_unique_id" name="hr_unique_id" value="{{ session('user')->hr_unique_id }}">
                    <label>Upload and submit to change Profile Image.
                        <input id="profileimage" type="file" name="profile_image" accept="image/png, image/gif, image/jpeg">
                        <br>(Image size limit: 150KB)
                    </label>
                    <br><br>
                    <button type="submit" id="uploadBtnhr" class="btn btn-primary">Upload</button>
                </form>
            </div>
            <!-- profile image section -->
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
        </div>

        <!-- Deactivate Profile Modal -->
        <div class="modal fade" id="otpModal" tabindex="-1" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="approvalModalLabel">Deactivate Profile</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>


                    <div id='' class="modal-body hide">
                        <div class="mb-3">
                            <label for="otp" class="form-label">Verify OTP</label>
                            <textarea id="deactivateOtp" class="form-control" rows="1" placeholder="OTP"></textarea>
                        </div>
                        <div class="modal-footer">
                            <button type="button" id="verifyProfileDeactivateOtp" class="btn btn-primary">Verify & Submit</button>
                        </div>
                    </div>

                </div>
            </div>
        </div>
        <!-- Deactivate Profile modal -->
    </main>

    <script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.6/js/dataTables.bootstrap5.min.js"></script>

    <script>
        $(document).ready(function() {
            $(".navbar-toggler").click(function() {
                $("#offcanvasExample").addClass("show");
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