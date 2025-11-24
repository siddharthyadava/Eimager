<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Experience</title>

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
      <a class="navbar-brand fw-bold" href="index.html">EImager</a>
      
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
        <a class="navbar-brand fw-bold" href="{{ route('dashboard')  }}">
            <img src="{{url('/images/logo.jpg')}}" alt="BootstrapBrain Logo" width="200">
        </a>
      </div>
    </div>
    <div class="offcanvas-body pt-3 p-0">
      <nav class="navbar-dark">
        <ul class="navbar-nav sidenav">
          <li class="nav-link bordered px-3 active">
            <a href="index.html" class="nav-link px-3 active">
              <!-- <span class="me-2"><i class="bi bi-speedometer2"></i></span>
              <span>Dashboard</span> -->
              @if(session()->has('user'))
            <p><strong>Name:</strong> {{ session('user')->first_name }}</p>
            <p><strong>EImager ID:</strong> <p id="eimagerid" >{{ session('user')->unique_id }}</p></p>
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
                    <a href="{{ route('experience-page')  }}" class="nav-link px-3">
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
            <a href="{{ route('experience-page')  }}" class="nav-link px-3">
              <span class="me-2"><i class="bi bi-award"></i></span>
              <span>Experiences</span>
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
            <a href="{{ route('profile')  }}" class="nav-link px-3">
              <span class="me-2"><i class="bi bi-person"></i></span>
              <span>Profile</span>
            </a>
          </li> -->
          <li class="nav-link bordered px-3">
            <a href="{{ route('userprofile')  }}" class="nav-link px-3">
              <span class="me-2"><i class="bi bi-person"></i></span>
              <span>User Profile</span>
            </a>
          </li>
        </ul>
      </nav>
    </div>
  </div>
  <!-- sidebar end -->

  <!-- main content -->
  <main class="mt-3 p-2">
  <div class="container">
      <div class="page-title">
        <div style="font-weight: 500;" class="fs-3">Experience</div>
      </div>
      <nav class="mt-2 mb-4" style="--bs-breadcrumb-divider: '>';" aria-label="breadcrumb">
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="#">Home</a></li>
          <li class="breadcrumb-item active" aria-current="page">Experience</li>
        </ol>
      </nav>
     
      <div>
      <section id='user_profile_experience_section' class="bg-light hide">
        <div class="container">
                <div class="row">
                    <div class="col-lg-12 mb-4 mb-sm-5">
                        <div class="card card-style1 border-0">
                            <div class="card-body p-1-9 p-sm-2-3 p-md-6 p-lg-7">
                                <div class="row align-items-center">
                                    <div class="col-lg-6 mb-4 mb-lg-0">
                                        <img src="https://bootdey.com/img/Content/avatar/avatar7.png" alt="...">
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
                    </div>
                    <div class="col-lg-12 mb-4 mb-sm-5">
                        <div id='add-exp-box-container'>
                            <span class="section-title text-primary mb-3 mb-sm-4">Add Experience</span>
                            <p>Please add your relavant experience</p>        
                            <button id="add-new-experience-btn" class="btn btn-primary mt-2">Add New Experience</button>                
                            
                                                
                            <div id="add-experience-form-container" class='hide'>
                              <div class="form-group border mb-2 position-relative" id="form-1">
                                  <button id = "add-experience-btn-close" class='x'> X </button>
                                  <!-- <form action="" onSubmit="search();return false;"> -->
                                  <label>Company/Employer Name</label>
                                  <input id='company-name-filed' type="text" required title="This field should not be left blank." class="form-control company-name" placeholder="Enter company name">
                                  <span class="companyname-error error-text"></span>     

                                  </br><label>Designation</label>
                                  <input id='designation-field' type="text" required class="form-control company-designation" placeholder="Enter designation">
                                  <span class="designation-error error-text"></span>     

                                  <!-- Project Section Section -->
                                  </br></br><label>Project</label>
                                  <div class="project-container">
                                      <div class="input-group mb-2 project-group">
                                          <input id='project-field' type="text" id='add-project-input' class="form-control project" placeholder="Enter project">
                                          <button class="btn btn-success add-project" type="button">+</button>
                                      </div>
                                  </div>
                                  <span class="projects-error error-text"></span>     
                                  <div id='added-project-container' class="added-project-container"></div>
        
                                  </br><label>Start Date</label>
                                  <input  id='start-date-field' type="date" required class="form-control start-date" placeholder="Enter your start date">

                                  </br><label>End Date</label>
                                  </br><input name="still_working" id="still_working" type="checkbox"><span>&nbsp;&nbsp;Still Working</span>
                                  <input  id='end-date-field' type="date" required class="form-control end-date" placeholder="Enter last date">
        
                                  </br><label>CTC (Approx)</label>    
                                  <input  id='ctc-field' type="number" required class="form-control ctc" placeholder="Enter CTC yearly">
                                  <span class="ctc-error error-text"></span> 

                                  </br></br><label>In hand (PA - Approx)</label>
                                  <input  id='in-hand-field' type="number" class="form-control in_hand" placeholder="Enter Inhand yearly">
                                  <span class="in-hand-error error-text"></span>     
        
                                  
                                  </br></br><label>Roles & Resposiablites</label> 
                                  <input  id='role-res-field' type="text" class="form-control company-role" placeholder="Enter roles and responsibilites">
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
                                  <ul id="user_exp_list_comp" class="list-component2" style="margin-left: 100px">
                                </div>
                                
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>


    <!-- <button class="open-modal-btn" id="openModalBtn">Open Modal</button> -->
    <div id="expReviewModal" class="modal">
      
        <!-- Modal content -->
        <div class="modal-content">
            <h3>Please share your hr/manager/employer mail id for verification/approval</h3>
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
  <!-- main content end-->

  <script src="js/jquery-3.5.1.js"></script>
  <script src="js/jquery.dataTables.min.js"></script>
  <script src="js/dataTables.bootstrap5.min.js"></script>
  <script src="js/bootstrap.bundle.min.js"></script>

  <script>
    $(document).ready(function () {
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
