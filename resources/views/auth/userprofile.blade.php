<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta name="csrf-token" content="{{ csrf_token() }}">
  <title>User Profile</title>
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
  <link rel="stylesheet" href="css/bootstrap.css">
  <link rel="stylesheet" href="css/style.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
  <link rel="stylesheet" href="css/custom.css">
  <link rel="stylesheet" href="css/style.css">
  <link rel="stylesheet" href="css/dataTables.bootstrap5.min.css">
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js" integrity="sha384-Atwg2Pkwv9vp0ygtn1JAojH0nYbwNJLPhwyoVbhoPwBhjQPR5VtM2+xf0Uwh9KtT" crossorigin="anonymous"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
</head>

<body>
  <script src="{{ asset('js/custom.js') }}"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
  <nav class="navbar navbar-expand-lg navbar-light shadow-sm bg-light">
    <div class="container-fluid">
      <button class="navbar-toggler" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasExample"
        aria-controls="offcanvasExample">
        <span class="navbar-toggler-icon"></span>
      </button>
      <a class="navbar-brand fw-bold" href="#">EImager</a>
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent"
        aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav ms-auto me-md-4 mb-2 mb-lg-0">
          <li class="nav-item dropdown d-flex text-light">
            <!-- <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
              <i class="fa-regular fa-user"></i> Admin
            </a>
            <ul class="dropdown-menu border-0 bg-light ms-auto">
              <li><a class="dropdown-item" href="#">Edit Profile</a></li>
              <li><a class="dropdown-item" href="#">Logout</a></li>
            </ul> -->
            <button id="logout-btn" class="btn btn-danger">Logout</button>
        </ul>


        </li>
      </div>
    </div>
  </nav>
  <!-- navbar end -->

  <!-- sidebar -->
  <div class="offcanvas offcanvas-start bg-purple text-white sidebar-nav" tabindex="-1" id="offcanvasExample"
    aria-labelledby="offcanvasExampleLabel">
    <div class="offcanvas-header shadow-sm d-block text-center">
      <div class="offcanvas-title" id="offcanvasExampleLabel">
        <!-- <a class="navbar-brand fw-bold" href="index.html">EImager</a> -->
        <!-- <a class="navbar-brand fw-bold" href="#"> -->

        <a class="navbar-brand fw-bold" href="/userprofile">
          <img src="{{url('/images/logo.jpg')}}" alt="BootstrapBrain Logo" width="200">
        </a>
      </div>
    </div>
    <div class="offcanvas-body pt-3 p-0">
      <nav class="navbar-dark">
        <ul class="navbar-nav sidenav">
          <li class="nav-link bordered px-3 active">
            <a href="{{ route('userprofile-page')  }}" class="nav-link px-3 active">
              <!-- <span class="me-2"><i class="bi bi-speedometer2"></i></span>
              <span>Dashboard</span> -->
              @if(session()->has('user'))
              <p><strong>Name:</strong> {{ session('user')->first_name }}</p>
              <p><strong>EImager ID:</strong>
                <p id="eimagerid">{{ session('user')->unique_id }}</p>
              </p>
              @else
              <p>User not logged in.</p>
              @endif
            </a>


          </li>
          <!-- <li class="nav-link bordered px-3">
            <a class="nav-link px-3 sidebar-link" data-bs-toggle="collapse" href="#collapseExample" role="button"
              aria-expanded="false" aria-controls="collapseExample">
              <span class="me-2">
                <i class="bi bi-people-fill"></i>
              </span>
              <span>Experience</span>
              <span class="right-icon ms-auto">
                <i class="bi bi-chevron-down"></i>
              </span>
            </a>
            <div class="collapse show" id="collapseExample">
              <div>
                <ul class="navbar-nav ps-3">
                  <li>
                    <a href="#" class="nav-link px-3">
                      <span class="me-2"><i class="bi bi-1-circle"></i></span>
                      <span>Add Experience</span>
                      
                    </a>
                  </li>
                   <li>
                    <a href="#" class="nav-link px-3">
                      <span class="me-2"><i class="bi bi-2-circle"></i></span>
                      <span>All Experiences</span>
                    </a>
                  </li> 
                  
                </ul>
              </div>
            </div>
          </li> -->
          <li class="nav-link bordered px-3">
            <a href="{{ route('userprofile-page')  }}" class="nav-link px-3">
              <span class="me-2"><i class="bi bi-award"></i></span>
              <span>User Profile</span>
            </a>
          </li>
          <li class="nav-link bordered px-3">
            <a href="{{ route('approval-page')  }}" class="nav-link px-3">
              <span class="me-2"><i class="bi bi-intersect"></i></span>
              <span>Approvals</span>
            </a>
          </li>

          <!-- <li class="nav-link bordered px-3">
            <a href="programs.html" class="nav-link px-3">
              <span class="me-2"><i class="bi bi-journal-text"></i></span>
              <span>Program</span>
            </a>
          </li> -->
          <!-- <li class="nav-link bordered px-3">
            <a href="#" class="nav-link px-3">
              <span class="me-2"><i class="bi bi-person"></i></span>
              <span>Profile</span>
            </a>
          </li> -->
          <!-- <li class="nav-link bordered px-3">
            <a href="#" class="nav-link px-3">
              <span class="me-2"><i class="bi bi-person"></i></span>
              <span>User Profile</span>
            </a>
          </li> -->
        </ul>
      </nav>
    </div>
  </div>
  <!-- sidebar end -->

  <!-- main content -->
  <main class="mt-3 p-2">
    <div class="container">
      <div class="page-title">
        <!-- <div style="font-weight: 500;" class="fs-3">User Profile</div> -->
      </div>
      <!-- <nav class="mt-2 mb-4" style="--bs-breadcrumb-divider: '>';" aria-label="breadcrumb">
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="#">Home</a></li>
          <li class="breadcrumb-item active" aria-current="page">Experience</li>
        </ol>
      </nav> -->


      <div>
        <section id='user_profile_experience_section' class="bg-light hide">
          <div class="container">
            <div class="row">
              <div class="col-lg-12 mb-4 mb-sm-5">
                <div class="card card-style1 border-0">
                  <div class="card-body p-1-9 p-sm-2-3 p-md-6 p-lg-7">
                    <div class="row align-items-center">
                      
                      <div class="col-lg-6 mb-4 mb-lg-0">
                        <!-- Profile Image -->
                        <!-- <img id="profile_preview" src="https://bootdey.com/img/Content/avatar/avatar7.png" alt="Profile Image" > -->
                        <img id="profile_preview"
                          src="{{url('/images/avatar7.png')}}"
                          alt="Profile Image" width="315px">
                        <br><br>
                        <!-- Image Upload Form -->
                        <form id="uploadProfileImage" enctype="multipart/form-data">
                          <input type="hidden" id="unique_id" name="unique_id" value="{{ session('user')->unique_id }}"> <!-- Replace with dynamic user ID -->

                          <label>Upload and submit to change Profile Image.
                            <input id="profileimage" type="file" name="profile_image" accept="image/png, image/gif, image/jpeg">
                            <br>(Image size limit: 150KB)
                          </label>

                          <br><br>
                          <button type="submit" id="uploadBtn" class="btn btn-primary">Upload</button>
                        </form>
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
                          <li class="mb-2 mb-xl-3 display-28"><span class="display-26 text-secondary me-2 font-weight-600">PAN:</span><span id='user_pan_number'></span></li>
                          <li id='fb_li' class="mb-2 mb-xl-3 display-28"><span class="display-26 text-secondary me-2 font-weight-600">
                              <i class="fa-brands fa-facebook" data-bs-toggle="tooltip" data-bs-placement="left" title="Facebook"></i>
                            </span> <span id='user_facebook'></span></li>
                          <li id='linkedin_li' class="mb-2 mb-xl-3 display-28"><span class="display-26 text-secondary me-2 font-weight-600"><i class="fa-brands fa-linkedin" data-bs-toggle="tooltip" data-bs-placement="left" title="LinkedIn"></i></span><span id='user_linkedin'></span></li>
                          <li id='twitter_li' class="mb-2 mb-xl-3 display-28"><span class="display-26 text-secondary me-2 font-weight-600"><i class="fa-brands fa-twitter" data-bs-toggle="tooltip" data-bs-placement="left" title="Twitter"></i></span><span id='user_twitter'></span></li>
                        </ul>
                        <!-- <ul class="social-icon-style1 list-unstyled mb-0 ps-0">
                                            <li><a href="#!"><i class="ti-twitter-alt"></i></a></li>
                                            <li><a href="#!"><i class="ti-facebook"></i></a></li>
                                            <li><a href="#!"><i class="ti-pinterest"></i></a></li>
                                            <li><a href="#!"><i class="ti-instagram"></i></a></li>
                                        </ul> -->
                      </div>
                    </div>
                  </div>
                </div>
              </div>
              <div class="col-lg-12 mb-4 mb-sm-5">
                <div>
                  <span class="section-title text-primary mb-3 mb-sm-4">About Me</span>
                  <p>Results-driven customer service representative with experience in relavant sector, recognized for delivering exceptional customer experiences and resolving conflicts effectively. Achieved a 25% increase in customer retention through prompt and efficient complaint resolution. Promoted to lead associate for consistently exceeding sales targets and maintaining a 95% customer satisfaction score.</p>
                  <p class="mb-0">This summary highlights your most significant accomplishments, relevant work experience, and job-specific skills.</p>
                </div>

                <button id="openModalBtnsocial" class="btn btn-primary mt-2">Add Social Links</button>
                <button id="openModalBtnProfileUpdateRequest" class="btn btn-primary mt-2">Update/Edit Profile</button>
              </div>
              
              
              <div class="col-lg-12 mb-4 mb-sm-5">
                <div id='add-qualification-box-container'>
                  <span class="section-title text-primary mb-3 mb-sm-4">Add Qualification</span>
                  <p>Please add your all Qualification</p>
                  <button id="add-new-qualification-btn" class="btn btn-primary mt-2">Add Your Qualification</button>
                  <div id="add-qualification-form-container" class='hide'>
                    <div class="form-group-q border mb-2 position-relative" id="form-1">
                      <button id="add-qualification-btn-close" class='x'> X </button>
                      <label>School</label>
                      <input id='qualification-school-filed' type="text" required title="This field should not be left blank." class="form-control q-school" placeholder="Ex: Delhi University">
                      <span class="qualification-school-error error-text"></span>

                      </br><label>Degree</label>
                      <input id='qualification-degree-field' type="text" required class="form-control q-degree" placeholder="Ex: Bachelor's">
                      <span class="qualification-degree-error error-text"></span>

                      </br><label>Field of study</label>
                      <input id='qualification-study-field' type="text" required class="form-control q-study" placeholder="Ex: Business">
                      <span class="qualification-study-error error-text"></span>

                      </br><label>Start Date</label>
                      <input id='qualification-start-date-field' type="date" required class="form-control q-start-date" placeholder="Enter start date">
                      <span class="qualification-start-date-error error-text"></span>

                      </br><label>End Date</label>
                      <input id='qualification-end-date-field' type="date" required class="form-control q-end-date" placeholder="Enter last date">
                      <span class="qualification-end-date-error error-text"></span>

                      </br><label>Grade</label>
                      <input id='qualification-grade-field' type="text" required class="form-control q-grade" placeholder="Enter Grade">
                      <span class="qualification-grade-error error-text"></span>

                      </br><label>Description</label>
                      <input id='qualification-description-field' type="text" class="form-control q-description" placeholder="Enter qualification description and Skills">
                      <span class="qualification-description-error error-text"></span>

                      </br><button id="save-qualification" class="btn btn-primary mt-2">Save Qualification</button>
                      <!-- <input id="save-experience" class="btn btn-primary mt-2" type="submit" value='Save Experience'> -->
                      <!-- <button id="review-experience-btn" class="btn btn-success mt-2 hide" >Review Experience</button> -->

                      <!-- </form> -->
                    </div>
                  </div>
                </div>
              </div>

              <div id='all-qualification-div'>
                <span class="section-title text-primary mb-3 mb-sm-4">Qualification</span>
                <ul id="user_qualification_list_comp" class="list-component2" style="margin-left: 0px">
              </div>

              <div class="col-lg-12 mb-4 mb-sm-5">
                <div id='add-exp-box-container'>
                  <span class="section-title text-primary mb-3 mb-sm-4">Add Experience</span>
                  <p>Please add your relavant experience</p>
                  <button id="add-new-experience-btn" class="btn btn-primary mt-2">Add New Experience</button>


                  <div id="add-experience-form-container" class='hide'>
                    <div class="form-group border mb-2 position-relative" id="form-1">
                      <button id="add-experience-btn-close" class='x'> X </button>
                      <!-- <form action="" onSubmit="search();return false;"> -->
                      <label>Company/Employer Name</label>
                      <input id='company-name-filed' type="text" required title="This field should not be left blank." class="form-control company-name" placeholder="Enter company name">
                      <span class="companyname-error error-text"></span>

                      </br><label>Designation</label>
                      <input id='designation-field' type="text" required class="form-control company-designation" placeholder="Enter designation">
                      <span class="designation-error error-text"></span>

                      <!-- Project Section Section -->
                      </br></br><label>Projects</label>
                      <div class="project-container">
                        <div class="input-group mb-2 project-group">
                          <input id='project-field' type="text" id='add-project-input' class="form-control project" placeholder="Enter project">
                          <button class="btn btn-success add-project" type="button">+</button>
                        </div>
                      </div>
                      <span class="projects-error error-text"></span>
                      <div id='added-project-container' class="added-project-container"></div>

                      </br><label>Date of Joining</label>
                      <input id='start-date-field' type="date" required class="form-control start-date" placeholder="Enter your start date">
                      <span class="start-date-error error-text"></span>

                      </br><label>Last Working Day / Current Status</label>
                      </br><input name="still_working" id="still_working" type="checkbox"><span>&nbsp;&nbsp;Still Working</span>
                      <input id='end-date-field' type="date" required class="form-control end-date" placeholder="Enter last date">

                      </br><label>CTC (Approx)</label>
                      <input id='ctc-field' type="number" required class="form-control ctc" placeholder="Enter CTC yearly">
                      <span class="ctc-error error-text"></span>

                      </br></br><label>In hand (PA - Approx)</label>
                      <input id='in-hand-field' type="number" class="form-control in_hand" placeholder="Enter Inhand yearly">
                      <span class="in-hand-error error-text"></span>


                      </br></br><label>Roles & Resposiablites</label>
                      <input id='role-res-field' type="text" class="form-control company-role" placeholder="Enter roles and responsibilites">
                      <span class="roles-responsibility-error error-text"></span>

                      </br><button id="save-experience" class="btn btn-primary mt-2">Save Experience</button>
                      <!-- <input id="save-experience" class="btn btn-primary mt-2" type="submit" value='Save Experience'> -->
                      <!-- <button id="review-experience-btn" class="btn btn-success mt-2 hide" >Review Experience</button> -->

                      <!-- </form> -->
                    </div>
                  </div>
                </div>
              </div>
              <div class="col-lg-12">
                <div class="row">
                  <div class="col-lg-12 mb-4 mb-sm-5">
                    <!-- <div class="mb-4 mb-sm-5">
                                    <span class="section-title text-primary mb-3 mb-sm-4">Skill</span>
                                    <div class="progress-text">
                                        <div class="row">
                                            <div class="col-6">Driving range</div>
                                            <div class="col-6 text-end">80%</div>
                                        </div>
                                    </div>
                                    <div class="custom-progress progress progress-medium mb-3" style="height: 4px;">
                                        <div class="animated custom-bar progress-bar slideInLeft bg-secondary" style="width:80%" aria-valuemax="100" aria-valuemin="0" aria-valuenow="10" role="progressbar"></div>
                                    </div>
                                    <div class="progress-text">
                                        <div class="row">
                                            <div class="col-6">Short Game</div>
                                            <div class="col-6 text-end">90%</div>
                                        </div>
                                    </div>
                                    <div class="custom-progress progress progress-medium mb-3" style="height: 4px;">
                                        <div class="animated custom-bar progress-bar slideInLeft bg-secondary" style="width:90%" aria-valuemax="100" aria-valuemin="0" aria-valuenow="70" role="progressbar"></div>
                                    </div>
                                    <div class="progress-text">
                                        <div class="row">
                                            <div class="col-6">Side Bets</div>
                                            <div class="col-6 text-end">50%</div>
                                        </div>
                                    </div>
                                    <div class="custom-progress progress progress-medium mb-3" style="height: 4px;">
                                        <div class="animated custom-bar progress-bar slideInLeft bg-secondary" style="width:50%" aria-valuemax="100" aria-valuemin="0" aria-valuenow="70" role="progressbar"></div>
                                    </div>
                                    <div class="progress-text">
                                        <div class="row">
                                            <div class="col-6">Putting</div>
                                            <div class="col-6 text-end">60%</div>
                                        </div>
                                    </div>
                                    <div class="custom-progress progress progress-medium" style="height: 4px;">
                                        <div class="animated custom-bar progress-bar slideInLeft bg-secondary" style="width:60%" aria-valuemax="100" aria-valuemin="0" aria-valuenow="70" role="progressbar"></div>
                                    </div>
                                </div> -->
                    <!-- <div>
                                    <span class="section-title text-primary mb-3 mb-sm-4">Education</span>
                                    <p>Many desktop publishing packages and web page editors now use Lorem Ipsum as their default model text, and a search for 'lorem ipsum' will uncover many web sites still in their infancy.</p>
                                    <p class="mb-1-9">There are many variations of passages of Lorem Ipsum available, but the majority have suffered alteration in some form, by injected humour.</p>
                      
                                </div> -->



                    <div id='all-experience-div'>
                      <span class="section-title text-primary mb-3 mb-sm-4">Experience</span>
                      <ul id="user_exp_list_comp" class="list-component2" style="margin-left: 0px">
                    </div>

                  </div>
                </div>
              </div>
            </div>
          </div>
        </section>
      </div>


      <!-- Bootstrap Modal -->

      <!-- social media modal -->

      <!-- Custom Modal -->
      <div id="customModal" class="modal-overlay">
        <div class="modal-content">
          <span class="close-modal">&times;</span>
          <h3>Add/Update Social Links</h3>
          <form id="socialMediaForm">
            <div class="mb-3">
              <input type="hidden" id="eimager-login-id" name="unique_id" value="{{ session('user')->unique_id }}">
              <label for="facebook">Facebook</label>
              <input type="url" id="facebook" name="facebook" placeholder="Enter Facebook link">
            </div>
            <div class="mb-3">
              <label for="linkedin">LinkedIn</label>
              <input type="url" id="linkedin" name="linkedin" placeholder="Enter LinkedIn link">
            </div>
            <div class="mb-3">
              <label for="twitter">Twitter</label>
              <input type="url" id="twitter" name="twitter" placeholder="Enter Twitter link">
            </div>
            <a href="javascript:void(0);" class="btn social-link-save">Save Links</a>
          </form>
        </div>
      </div>
      
      
      <!-- Profile Update Modal -->
      <div id="updateProfileModal" class="modal-overlay">
        <div class="modal-content" style="width: 60%">
          <span class="close-modal">&times;</span>
          <h3>Profile Update Request</h3>
          <div id="error-message" style="color: red;"></div>
          <table class="display">
            <thead>
                <tr>
                    <th>Field Name</th>
                    <th>Current Details</th>
                    <th>New Details</th>
                </tr>
            </thead>
            <tbody>
              <tr>
                  <td>Name</td>
                  <td><span id='request_current_name'></span></td>
                  <td><input type="text" id="new_name_request" /></td>
               </tr>
                <tr>
                  <td>Aadhar Number</td>
                  <td><span id='request_current_aadhar'></span></td>
                  <td><input type="text" id="new_aadhar_request" /></td>
                </tr>
                <tr>
                  <td>PAN</td>
                  <td><span id='request_current_pan'></span></td>
                  <td><input type="text" id="new_pan_request" /></td>
                </tr>
                <tr>
                  <td>Upload Aadhar/Pan Card</td>
                  <td>
                    
                      <input type="hidden" id="unique_id" name="unique_id" value="{{ session('user')->unique_id }}"> <!-- Replace with dynamic user ID -->

                      <label>.
                        <input id="evidenceimage" type="file" name="profile_image" accept="image/png, image/gif, image/jpeg">
                        <br>(Image size limit: 150KB)
                      </label>
                      <br><br>
                      
                  </td>
                  <td>
                    <button type="submit" id="uploadProfileUpdateRequestBtn" class="btn btn-primary">Submit Request</button>
                  </td>
                </tr>
            </tbody>
          </table>
        </div>
      </div>
      
      <!-- <button class="open-modal-btn" id="openModalBtn">Open Modal</button> -->
      <div id="expReviewModal" class="modal">

        <!-- Modal content -->
        <div class="modal-content">
          <h3>Please share your HR/Manager/Employer Mail Id of the Company for Verification/Approval
            Remove experience option instead keep only user profile</h3>
          <!-- <input type="text" id="inputBox"  placeholder="e.g. alvas@gmail.com;bivas@gmail.com"> -->
          <!-- <br> -->
          <div class="inner-modal-content">
            <div class="fieldParent">
              <!-- <div class="labelErrorParent">
                    <label for="name">Name as per Aadhar/PAN</label>
                </div> -->
              <input id="approver_email" placeholder="e.g. amit@gmail.com" type="text">
              <input id="approver_name" placeholder="e.g. Amit Singh" type="text">
              <input id="approver_number" placeholder="e.g. 9999998900" type="text">
            </div>
            <button class="submit-btn" id="submitBtn">Submit</button>
            <button class="close-btn" id="closeModalBtn">Close</button>
          </div>

        </div>
      </div>

      <!-- Confirmation Modal -->
      <div id="confirmationModal" class="modal">
        <!-- Modal content -->
        <div class="modal-content">
          <h3>Are you Sure? You want to delete your experience!!</h3>
          <br>

          <div class='button-container'>
            <button class="submit-btn width-100" id="modalYesBtn">Yes</button>
            <button class="close-btn width-100" id="modalNoBtn">No</button>
          </div>
        </div>
      </div>

      <!-- Information Modal -->
      <div id="informationModal" class="modal">
        <!-- Modal content -->
        <div class="modal-content">
          <h3 id='infoModalMsgBox'></h3>
          <br>

          <div class='button-container'>
            <button class="submit-btn width-100" id="modalOkBtn">OK</button>
          </div>
        </div>
      </div>

      <!-- Experience Added Info Modal -->
      <div id="expAddedInfoModal" class="modal">
        <!-- Modal content -->
        <div class="modal-content">
          <h3>Experience has been added successfully. </h3>
          <br>

          <div class='button-container'>
            <button class="submit-btn" id="addMoreExpBtn">Add more Experience</button>
            <button class="submit-btn" id="reviewExpBtn">Review Your Experience</button>
          </div>
        </div>
      </div>
  </main>
  <!-- Qualification Added Info Modal -->
  <div id="qualificationAddedInfoModal" class="modal">
    <!-- Modal content -->
    <div class="modal-content">
      <h3>Qualification has been added successfully. </h3>
      <br>
      <div class='button-container'>
        <button class="submit-btn" id="addMoreQualificationBtn">Add more Qualification</button>
      </div>
    </div>
  </div>
  </main>
  <!-- main content end-->
  <style>
    .modal-overlay {
      display: none;
      position: fixed;
      top: 0;
      left: 0;
      width: 100%;
      height: 100%;
      background: rgba(0, 0, 0, 0.5);
      justify-content: center;
      align-items: center;
    }

    /* Modal Box */
    .modal-content {
      background: #fff;
      padding: 20px;
      width: 350px;
      text-align: center;
      border-radius: 10px;
      position: relative;
    }

    /* Close Button */
    .close-modal {
      position: absolute;
      top: 10px;
      right: 15px;
      font-size: 20px;
      cursor: pointer;
    }

    /* Form Input */
    .modal-content input {
      width: 100%;
      padding: 8px;
      margin: 10px 0;
      border: 1px solid #ccc;
      border-radius: 5px;
    }

    /* Submit Button */
    .modal-content .btn {
      background: #28a745;
      color: white;
      border: none;
      padding: 10px;
      cursor: pointer;
      width: 100%;
      border-radius: 5px;
    }
  </style>
  <script src="js/jquery-3.5.1.js"></script>
  <script src="js/jquery.dataTables.min.js"></script>
  <script src="js/dataTables.bootstrap5.min.js"></script>
  <script src="js/bootstrap.bundle.min.js"></script>
  <script>
    document.addEventListener("DOMContentLoaded", function() {
      let modal = document.getElementById("customModal");
      let openBtn = document.getElementById("openModalBtnsocial");
      let closeBtn = document.querySelector(".close-modal");

      // Open Modal
      openBtn.addEventListener("click", function() {
        modal.style.display = "flex";
      });

      // Close Modal
      closeBtn.addEventListener("click", function() {
        modal.style.display = "none";
      });

      // Close modal when clicking outside the modal content
      window.addEventListener("click", function(event) {
        if (event.target === modal) {
          modal.style.display = "none";
        }
      });
    });
  </script>
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
      $('#datatable').DataTable({
        paging: false,
        info: true,
        dom: 'Bfrtip',
        select: true,
        pageLength: 5,
        recordsTotal: 10,
      });
    });
  </script>
  <script src="js/jquery-3.5.1.js"></script>
  <script src="js/jquery.dataTables.min.js"></script>
  <script src="js/dataTables.bootstrap5.min.js"></script>
  <script src="js/bootstrap.bundle.min.js"></script>
</body>

</html>