<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta name="csrf-token" content="{{ csrf_token() }}">
  <title>Dashboard</title>

  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
  <link href="https://fonts.googleapis.com/css2?family=Ubuntu:wght@400;500;700&display=swap" rel="stylesheet">

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz"
    crossorigin="anonymous"></script>

  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.2/font/bootstrap-icons.css">
  <link rel="stylesheet" href="css/bootstrap.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">
  <!-- <link rel="stylesheet" href="css/style.css"> -->
  <link rel="stylesheet" href="{{ asset('css/style.css') }}">
  <link rel="stylesheet" href="css/dataTables.bootstrap5.min.css">
</head>

<body>
  <script src="{{ asset('js/custom.js') }}"></script>
  <script src="{{ asset('js/admin.js') }}"></script>
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

            <button id="admin-logout-btn" class="btn btn-danger">Logout</button>
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
      <a class="navbar-brand fw-bold" href="{{ route('admin-dashboard')  }}">
        <img src="{{url('/images/logo.jpg')}}" alt="BootstrapBrain Logo" width="200">
      </a>
      </div>
    </div>
    <div class="offcanvas-body pt-3 p-0">
      <nav class="navbar-dark">
        <ul class="navbar-nav sidenav">
          <li class="nav-link bordered px-3 active">
            <a href="/admin-dashboard" class="nav-link px-3 active">
              @if(session()->has('admin'))
              <p><strong>Name:</strong> {{ session('admin')->admin_name }}</p>
              <p><strong>Email id:</strong>
                <p id='#eimagerid'>{{ session('admin')->admin_email }}</p>
              </p>
              @else
              <p>User not logged in.</p>
              @endif
            </a>

          </li>
          
          <!-- add user -->
          <li class="nav-link bordered px-3">
            <a href="" class="nav-link px-3" id="openaddUserModal">
              <span class="me-2"><i class="bi bi-intersect"></i></span>
              <span>Add User</span>
            </a>
          </li>
          <!-- add user -->
          <!-- add user -->
          <li class="nav-link bordered px-3">
            <a href="#" class="nav-link px-3" id="openaddUserModal">
              <span class="me-2"><i class="bi bi-intersect"></i></span>
              <span>Contact</span>
            </a>
          </li>
          <!-- add user -->
        </ul>
      </nav>
    </div>
  </div>
  <!-- sidebar end -->

  <!-- main content -->
  <main class="mt-3 p-2">
    <div class="container">
      <div class="page-title">
        <div style="font-weight: 500;" class="fs-3">Admin Dashboard</div>
      </div>
      <nav class="mt-2 mb-4" style="--bs-breadcrumb-divider: '>';" aria-label="breadcrumb">
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="#">Home</a></li>
          <li class="breadcrumb-item active" aria-current="page">Dashboard</li>
        </ol>
      </nav>

      <div class="dashboard">
        <div class="row">
          <div class="col-md-4">
            <div class="card px-4 border-0 shadow-sm">
              <div class="card-body">
                <div class="fs-5 text-end">
                <span id='total_employee_registration'>0</span>
                </div>
                <div style="margin-top: -10px;" class="fs-3 text-start text-info">
                  <i class="bi bi-people-fill"></i>
                </div>
                <div style="margin-top: -40px;" class="fs-5 pt-4 text-end">
                  Total Employee Registration
                </div>
              </div>
            </div>
          </div>
          <div class="col-md-4">
            <div class="card px-4 border-0 shadow-sm">
              <div class="card-body">
                <div class="fs-5 text-end">
                  <span id='total_hr_registration'>0</span>
                </div>
                <div style="margin-top: -10px;" class="fs-3 text-start text-warning">
                  <i class="bi bi-intersect"></i>
                </div>
                <div style="margin-top: -40px;" class="fs-5 pt-4 text-end">
                Total HR/Employeer Registration
                </div>
              </div>
            </div>
          </div>
          
        </div>
      </div>
      <!-- Contact Details -->
      <div class="latest-added mt-5">
        <div class="card border-0 shadow-sm">
          <div class="card-body">
            <div class="d-flex justify-content-between align-items-center mb-3">
              <div class="page-title fs-5 fw-bold">Contact Details</div>
            </div>
                <div class="card-body table-responsive">
                    <table class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th>ID</th><th>Name</th><th>Email</th><th>Phone</th><th>Address</th><th>Message</th><th>Created</th><th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($contacts as $contact)
                            <tr id="contact-row-{{ $contact->id }}">
                                <td>{{ $contact->ca_id }}</td>
                                <td>{{ $contact->ca_name }}</td>
                                <td>{{ $contact->ca_email }}</td>
                                <td>{{ $contact->ca_number ?? '—' }}</td>
                                <td>{{ $contact->ca_address ?? '—' }}</td>
                                <td>{{ \Illuminate\Support\Str::limit($contact->ca_message, 100) }}</td>
                                <td>{{ optional($contact->created_at)->format('Y-m-d H:i') }}</td>
                                <td>
                                    
                                    <form action="{{ url('admin/contacts/' . $contact->ca_id) }}" method="POST" style="display:inline;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-danger"
                                            onclick="return confirm('Delete this contact?')">
                                        Delete
                                    </button>
                                    </form>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                    <div class="d-flex justify-content-center">
                    {!! $contacts->links() !!}
                    </div>
                </div>
            </div>
        </div>
    </div>
      <!-- Career Details -->
      <div class="latest-added mt-5">
        <div class="card border-0 shadow-sm">
          <div class="card-body">
            <div class="d-flex justify-content-between align-items-center mb-3">
              <div class="page-title fs-5 fw-bold">Career Details</div>
            </div>
                <div class="card-body table-responsive">
                    <table class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th>ID</th><th>Name</th><th>Email</th><th>Phone Number</th><th>Current_designation</th><th>Applied_post</th><th>Total_experience</th><th>Current_ctc</th><th>Expected_ctc</th><th>Notice_period</th><th>Created</th><th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($careers as $career)
                            <tr id="career-row-{{ $career->id }}">
                                <td>{{ $career->id }}</td>
                                <td>{{ $career->career_name }}</td>
                                <td>{{ $career->career_email }}</td>
                                <td>{{ $career->career_contact_number ?? '—' }}</td>
                                <td>{{ $career->career_current_designation ?? '—' }}</td>
                                <td>{{ $career->career_applied_post ?? '—' }}</td>
                                <td>{{ $career->career_total_experience ?? '—' }}</td>
                                <td>{{ $career->career_current_ctc ?? '—' }}</td>
                                <td>{{ $career->career_expected_ctc ?? '—' }}</td>
                                <td>{{ $career->career_notice_period ?? '—' }}</td>
                                <td>{{ optional($career->created_at)->format('Y-m-d H:i') }}</td>
                                <td>
                                    <form action="{{ url('admin/careers/' . $career->id) }}" method="POST" style="display:inline;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-danger"
                                            onclick="return confirm('Delete this Career Details?')">
                                        Delete
                                    </button>
                                    </form>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                    <div class="d-flex justify-content-center">
                    {!! $careers->links() !!}
                    </div>
                </div>
            </div>
        </div>
    </div>

      <!-- Profile Update Request -->
      <div class="latest-added mt-5">
        <div class="card border-0 shadow-sm">
          <div class="card-body">
            <div class="d-flex justify-content-between align-items-center mb-3">
              <div class="page-title fs-5 fw-bold">Profile Update Request</div>
            </div>
            <div class="table-responsive">
              <table id="profile_update_request_table" class="table table-striped table-bordered display nowrap" style="width:100%">
                <thead>
                  <tr>
                    <th>Eimager ID</th>
                    <th>Existing Name</th>
                    <th>New Name</th>
                    <th>Existing Aadhar</th>
                    <th>New Aadhar</th>
                    <th>Existing PAN</th>
                    <th>New PAN</th>
                    <th>Image Evidence</th>
                    <th>Approval Status</th>
                  </tr>
                </thead>
                <tbody></tbody>
              </table>
            </div>
          </div>
        </div>
      </div>



<script>
document.addEventListener('click', function(e) {
    if (e.target.matches('.ajax-delete')) {
        const id = e.target.dataset.id;
        if (!confirm('Delete this contact?')) return;

        fetch("{{ url('admin/contacts') }}/" + id + "/ajax-delete", {
            method: 'POST',
            headers: {
                'X-CSRF-TOKEN': '{{ csrf_token() }}',
                'Accept': 'application/json',
                'Content-Type': 'application/json'
            }
        }).then(r => r.json()).then(data => {
            if (data.status === 'ok') {
                document.getElementById('contact-row-' + id)?.remove();
            } else {
                alert(data.message || 'Delete failed');
            }
        }).catch(err => {
            console.error(err);
            alert('Request failed');
        });
    }
});
</script>
<script>
document.addEventListener('click', function(e) {
    if (e.target.matches('.ajax-delete')) {
        const id = e.target.dataset.id;
        if (!confirm('Delete this career?')) return;

        fetch("{{ url('admin/career') }}/" + id + "/ajax-delete", {
            method: 'POST',
            headers: {
                'X-CSRF-TOKEN': '{{ csrf_token() }}',
                'Accept': 'application/json',
                'Content-Type': 'application/json'
            }
        }).then(r => r.json()).then(data => {
            if (data.status === 'ok') {
                document.getElementById('career-row-' + id)?.remove();
            } else {
                alert(data.message || 'Delete failed');
            }
        }).catch(err => {
            console.error(err);
            alert('Request failed');
        });
    }
});
</script>



      <div class="latest-added mt-5">
        <div class="card border-0 shadow-sm">
          <div class="card-body">
            <div class="d-flex justify-content-between align-items-center mb-3">
              <div class="page-title fs-5 fw-bold">Employeer Registration By Date</div>
            </div>
            <div class="table-responsive">
              <table id="hr_registration_report_table" class="table table-striped table-bordered display nowrap" style="width:100%">
                <thead>
                  <tr>
                    <th>Date</th>
                    <th>Registration Count</th>
                  </tr>
                </thead>
                <tbody></tbody>
              </table>
            </div>
          </div>
        </div>
      </div>

      

      <!-- table add -->
      <div class="latest-added mt-5">
        <div class="card border-0 shadow-sm">
          <div class="card-body">
            <div class="d-flex justify-content-between align-items-center mb-3">
              <div class="page-title fs-5 fw-bold">Employee Registration By Date</div>
            </div>
            <div class="table-responsive">
              <table id="employee_registration_report_table" class="table table-striped table-bordered display nowrap" style="width:100%">
                <thead>
                  <tr>
                    <th>Date</th>
                    <th>Registration Count</th>
                  </tr>
                </thead>
                <tbody></tbody>
              </table>
            </div>
          </div>
        </div>
      </div>

    
    
      <!-- HR Account Deactivation -->
    <div class="latest-added mt-5">
        <div class="card border-0 shadow-sm">
          <div class="card-body">
            <div class="d-flex justify-content-between align-items-center mb-3">
              <div class="page-title fs-5 fw-bold">Employer Accounts Summary</div>
            </div>
            <div class="table-responsive">
              <table id="employer_profile_deactivation_table" class="table table-striped table-bordered display nowrap" style="width:100%">
                <thead>
                  <tr>
                    <th>User ID</th>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Phone number</th>
                    <th>Aadhar</th>
                    <th>PAN</th>
                    <th>DOB</th>
                    <th>Company</th>
                    <th>Reporting Manager</th>
                    <th>Action</th>
                  </tr>
                </thead>
                <tbody></tbody>
              </table>
            </div>
          </div>
        </div>
      </div>
      <!-- table add -->
      <div class="latest-added mt-5">
        <div class="card border-0 shadow-sm">
          <div class="card-body">
            <div class="d-flex justify-content-between align-items-center mb-3">
              <div class="page-title fs-5 fw-bold">Experience Review Requests</div>
              <button id="adminviewRequestsBtn" class="btn btn-primary">View Requests</button>
            </div>
            <div class="table-responsive">
              <table id="adminapprovalRequestsTable" class="table table-striped table-bordered display nowrap" style="width:100%">
                <thead>
                  <tr>
                    <th>Eimager ID</th>
                    <th>Name</th>
                    <th>Aadhar</th>
                    <th>PAN</th>
                    <th>Company Name</th>
                    <th>Designation</th>
                    <th>Projects</th>
                    <th>Start Date</th>
                    <th>End Date</th>
                    <th>Roles & Responsibilities</th>
                    <th>CTC</th>
                    <th>In Hand</th>
                    <!-- <th>Created At</th>
                    <th>Updated At</th> -->
                    <th>Approval Status</th>
                  </tr>
                </thead>
                <tbody></tbody>
              </table>
            </div>
          </div>
        </div>
      </div>
      
      <!-- table add -->
      <!-- add user modal -->
      <div id="userModal" style="display: none;">
        <div style="background: #fff; padding: 20px; border-radius: 8px; width: 500px; margin: 100px auto; position: relative;">
          <button id="closeUserModal" class="close-btn" style="position: absolute; top: 10px; right: 10px;">&times;</button>
          <h4>Add User</h4>
          <form id="userForm">
            <div class="mb-2">
              <label for="name" class="form-label">User Name</label>
              <input type="text"  id="name" class="form-control">
              <span class="text-danger error-text name_error"></span>
            </div>

            <div class="mb-2">
              <label for="hr_email" class="form-label">Email</label>
              <input type="email" name="email" id="email" class="form-control">
              <span class="text-danger error-text email_error"></span>
            </div>

            <div class="mb-2">
              <label for="number" class="form-label">Phone</label>
              <input type="text" name="number" id="number" class="form-control" >
              <span class="text-danger error-text number_error"></span>
            </div>

            <div class="mb-2">
              <label for="hr_password" class="form-label">Password</label>
              <input type="password" name="password" id="password" class="form-control" >
              <span class="text-danger error-text password_error"></span>
            </div>

            <div class="mb-2">
              <label for="aadhar" class="form-label">Addhar Number</label>
              <input type="text" name="aadhar" id="aadhar" class="form-control" >
              <span class="text-danger error-text aadhar_error"></span>
            </div>

            <div class="mb-2">
              <label for="pan" class="form-label">Pan Number</label>
              <input type="text" name="pan" id="pan" class="form-control" >
              <span class="text-danger error-text pan_error"></span>
            </div>
         

            <div class="mb-2">
              <label for="dob" class="form-label">Date of Birth</label>
              <input type="date" name="dob" id="dob" class="form-control" >
              <span class="text-danger error-text dob_error"></span>
            </div>

            <!-- <div class="mb-2">
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
            </div> -->

            <button type="submit" id="adduserstore" class="btn btn-primary w-100">Submit</button>
          </form>
        </div>
      </div>
      
     
    </div>
        @php
      $show = function ($v, $pretty = false) {
        if (is_null($v) || $v === '')
          return '—';
        if (is_array($v) || is_object($v)) {
          if ($pretty) {
            return json_encode($v, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE);
          }
          return json_encode($v, JSON_UNESCAPED_UNICODE);
        }
        return (string) $v;
      };
    @endphp

          <!-- AdminActivity -->
     <div class="latest-added mt-5">
  <div class="card border-0 shadow-sm">
    <div class="card-body">
      <div class="d-flex justify-content-between align-items-center mb-3">
        <div class="page-title fs-5 fw-bold">Admin Activity</div>
      </div>

      <div class="card-body table-responsive">
        <table class="table table-bordered table-striped">
          <thead>
            <tr>
              <th>ID</th>
              <th>Admin_Id</th>
              <th>Action</th>
              <th>Subject Type</th>
              <th>Subject ID</th>
              <th>Message</th>
              <th>Changes</th>
              <th>IP Address</th>
              <th>User Agent</th>
              <th>Created At</th>
            </tr>
          </thead>
          <tbody>
            @foreach($admin_activities as $activity)
              {{-- debug: uncomment to inspect the record if errors persist --}}
              {{-- @php dd($activity->toArray()); @endphp --}}

              <tr id="activity-row-{{ $show($activity->id) }}">
                <td>{{ $show($activity->id) }}</td>

                {{-- If you later add admin relation: use optional($activity->admin)->email ?? $activity->admin_id --}}
                <td>{{ $show($activity->admin_id) }}</td>

                <td>{{ $show($activity->action) }}</td>
                <td>{{ $show($activity->subject_type) }}</td>
                <td>{{ $show($activity->subject_id) }}</td>

                {{-- Message: allow newlines --}}
                <td>{!! nl2br(e($show($activity->message))) !!}</td>

                <td style="max-width: 100vw;">{{ $show($activity->changes) }}</td>

                <td>{{ $show($activity->ip_address) }}</td>

                <td>{{ $show($activity->user_agent) }}</td>

                <td>{{ optional($activity->created_at)->format('Y-m-d H:i') }}</td>
              </tr>
            @endforeach
          </tbody>
        </table>

        <div class="d-flex justify-content-center">
          {!! $admin_activities->links() !!}
        </div>
      </div>
    </div>
  </div>
</div>
  </main>
  <!-- main content end-->

  <!-- <script src="js/jquery-3.5.1.js"></script>
  <script src="js/jquery.dataTables.min.js"></script>
  <script src="js/dataTables.bootstrap5.min.js"></script>
  <script src="js/bootstrap.bundle.min.js"></script> -->
  <script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
  <script src="https://cdn.datatables.net/1.13.6/js/dataTables.bootstrap5.min.js"></script>

  <script>
    // $(document).ready(function() {
    //   $('#approvalRequestsTable').DataTable({
    //     paging: false,
    //     info: true,
    //     dom: 'Bfrtip',
    //     select: true,
    //     pageLength: 5,
    //     recordsTotal: 10,
    //   });
    // });
  </script>
  <script>
    $(document).ready(function() {
      $('#openaddUserModal').on('click', function(e) {
        e.preventDefault();
        $('#userModal').show();
      });

      $('#closeUserModal').on('click', function() {
        $('#userModal').fadeOut();
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
    #userModal {
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
    #userModal .modal-content {
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
    #userModal .close-btn {
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

    #userModal .close-btn:hover {
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
//   <script>
//         $(document).ready(function() {
//           // destroy previous if initialized accidentally (safe to include)
//           if ($.fn.DataTable.isDataTable('#contacts_table')) {
//             $('#contacts_table').DataTable().destroy();
//           }
        
//           $('#contacts_table').DataTable({
//             paging: true,
//             searching: true,
//             info: true,
//             ordering: true,
//             responsive: true,
//             order: [[0, 'desc']],
//             pageLength: 10
//           });
//         });
// </script>

</body>
</html>