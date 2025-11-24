<?php
// namespace App\Http\Controllers\Admin; 
// use App\Http\Controllers\Controller; 
// use App\Models\Admin;
// use Illuminate\Support\Facades\Hash;
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Admin;
use App\Models\Contact;
use App\Models\Career;
use Illuminate\Support\Str;
use App\Models\RegisterData;
use App\Models\ProfileUpdateRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use Illuminate\View\View;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Auth\MailController;
use App\Models\HrModel;
use App\Models\AdminActivity;
use App\Http\Controllers\Concerns\LogsAdminActions;

class AdminController extends Controller
{
    use LogsAdminActions;

    public function index(): View
    {
        return view('admin.login');
    }

    public function insertAdmin()
    {
        Admin::create([
            'admin_name' => 'Super Admin',
            'admin_email' => 'admin@example.com',
            'admin_password' => Hash::make('123456'), // Hash the password
        ]);

        return "Admin created successfully!";
    }


    public function login(Request $request)
    {
        $validatedData = $request->validate([
            'admin_email' => 'required|email|exists:admin,admin_email',
            'admin_password' => 'required|string|min:6',
        ]);

        // ✅ Find Admin by email
        $admin = Admin::where('admin_email', $validatedData['admin_email'])->first();

        // ✅ Check password
        if (!$admin || !Hash::check($validatedData['admin_password'], $admin->admin_password)) {
            return response()->json([
                'success' => false,
                'message' => 'Invalid email or password!'
            ], 401);
        }

        // ✅ Store Admin in Session
        session(['admin' => $admin]);

        return response()->json([
            'success' => true,
            'message' => 'Admin Login successful!',
            'data' => $admin,
            'redirect' => url('admin-dashboard')
        ]);
    }

    public function fetchAdminReport()
    {
        $user_registration = DB::select('select count(*) count from register_data');
        $user_registration_count = $user_registration[0]->count;

        $hr_registration = DB::select('select count(*) count from hr_data');
        $hr_registration_count = $hr_registration[0]->count;

        $data[] = [
            'user_registration_count'             => $user_registration_count,
            'hr_registration_count'             => $hr_registration_count,

        ];

        return response()->json([
            'success' => true,
            'data' => $data,
        ]);
    }

    public function fetchUserRegistrationByDate()
    {
        $user_registration_by_date = DB::select('select date_format(created_at, "%d-%m-%Y") AS "date", count(*) count from register_data group by date order by count desc');

        return response()->json($user_registration_by_date);
    }

    public function fetchHrRegistrationByDate()
    {
        $hr_registration_by_date = DB::select('select date_format(created_at, "%d-%m-%Y") AS "date", count(*) count from hr_data group by date order by count desc');


        return response()->json($hr_registration_by_date);
    }
    public function adminDashboard()
    {
        // Check if Admin is logged in
        if (!session()->has('admin')) {
            return redirect()->route('admin-login')->with('error', 'Please login first.');
        }

        // Get logged-in Admin data
        $admin = session('admin');
        // Get contacts (latest first)
        $contacts = Contact::orderBy('ca_id', 'desc')->paginate(5);
        $careers = Career::orderBy('id', 'desc')->paginate(5);
        $admin_activities = AdminActivity::orderBy('id', 'desc')->paginate(5);

        return view('admin.dashboard', compact('admin', 'contacts', 'careers','admin_activities')); // Ensure this view exists
    }


    //     return view('admin.dashboard', compact('admin','contacts','careers')); // Ensure this view exists
    // }
    // public function destroyContact($id)
    // {
    //     $contact = Contact::findOrFail($id);
    //     $contact->delete();

    //     return redirect()
    //         ->route('admin.dashboard')
    //         ->with('success', 'Contact deleted successfully.');
    // }

    /**
     * Delete a contact via AJAX
     */
    // public function ajaxDestroyContact($id)
    // {
    //     $contact = Contact::findOrFail($id);
    //     $contact->delete();

    //     return response()->json(['status' => 'ok', 'message' => 'Deleted successfully']);
    // }
    // destroy career
    // public function destroyCareer($id)
    // {
    //     $career = Career::findOrFail($id);
    //     $career->delete();

    //     return redirect()
    //         ->route('admin.dashboard')
    //         ->with('success', 'Career deleted successfully.');
    // }

    /**
     * Delete a career via AJAX
     */
    // public function ajaxDestroyCareer($id)
    // {
    //     $career = Career::findOrFail($id);
    //     $career->delete();

    //     return response()->json(['status' => 'ok', 'message' => 'Deleted successfully']);
    // }
    
    
    // new code after admin activity
        public function destroyContact($id)
{
    $contact = Contact::findOrFail($id);

    // Save current state before deletion
    $before = $contact->toArray();

    // Delete the contact
    $contact->delete();

    // Log admin action
    $this->logAdmin(
        'contact.deleted',
        $contact,
        ['before' => $before, 'after' => null],
        "Deleted contact {$contact->ca_id} ({$contact->ca_email})"
    );

    return redirect()
        ->route('admin.dashboard')
        ->with('success', 'Contact deleted successfully.');
}


    /**
     * Delete a contact via AJAX
     */
    public function ajaxDestroyContact($id)
    {
        $contact = Contact::findOrFail($id);
        $before = $contact->toArray();

        $contact->delete();
        $this->logAdmin(
            'contact.deleted',
            $contact,
            ['before' => $before, 'after' => null],
            "Deleted contact {$contact->ca_id} ({$contact->ca_email}) via AJAX"
        );


        return response()->json(['status' => 'ok', 'message' => 'Deleted successfully']);
    }
    // destroy career
    public function destroyCareer($id)
    {
        $career = Career::findOrFail($id);
        $before = $career->toArray();
        $career->delete();
        $this->logAdmin(
            'career.deleted',
            $career,
            ['before' => $before, 'after' => null],
            "Deleted career {$career->id} ({$career->career_email})"
        );

        return redirect()
            ->route('admin.dashboard')
            ->with('success', 'Career deleted successfully.');
    }

    /**
     * Delete a career via AJAX
     */
    public function ajaxDestroyCareer($id)
    {
        $career = Career::findOrFail($id);
        $before = $career->toArray();

        $career->delete();

        $this->logAdmin(
            'career.deleted',
            $career,
            ['before' => $before, 'after' => null],
            "Deleted career {$career->id} ({$career->career_email}) via AJAX"
        );

        return response()->json(['status' => 'ok', 'message' => 'Deleted successfully']);
    }

    public function logout(Request $request)
    {
        // Clear session
        Session::forget('admin');
        Session::flush();

        return response()->json([
            'success' => true,
            'message' => 'Admin Logged out successfully!',
            'redirect' => url('/')
        ]);
    }

    // public function viewAllApprovalRequests()
    // {
    //     // Fetch all approval requests for admin
    //     $requests = DB::table('user_experience_approval')
    //         ->join('user_experience', 'user_experience.id', '=', 'user_experience_approval.experience_id')
    //         ->select(
    //             'user_experience.*',
    //             'user_experience_approval.id as approval_id',
    //             'user_experience_approval.approval_status',
    //             'user_experience_approval.status_note'
    //         )
    //         ->get();
    //      foreach ($requests as $request) {
    //         $user_info = DB::table('register_data') -> where('unique_id', $request->eimager_id)->first();
    //         $request->first_name = $user_info->first_name;
    //         $request->aadhar_number = $user_info->aadhar_number;
    //         $request->pan_number = $user_info->pan_number;
    //     }
    //     // dd($requests->toSql(), $requests->get(1));
    //     return response()->json($requests);
    // }
    public function viewAllApprovalRequests()
{
    // Fetch experience records + approval info
    $requests = DB::table('user_experience_approval')
        ->join('user_experience', 'user_experience.id', '=', 'user_experience_approval.experience_id')
        ->select(
            'user_experience.*',
            'user_experience_approval.id as approval_id',
            'user_experience_approval.approval_status',
            'user_experience_approval.status_note'
        )
        ->get();

    // Convert to array and add fields from register_data safely
    $results = $requests->map(function ($request) {
        $user_info = DB::table('register_data')
            ->where('unique_id', $request->eimager_id)
            ->first();

        // if user_info not found, use sensible defaults
        $first_name   = $user_info->first_name ?? null;
        $aadhar_number = $user_info->aadhar_number ?? null;
        $pan_number    = $user_info->pan_number ?? null;

        // return as array (DataTables handles arrays/objects)
        return array_merge((array) $request, [
            'first_name'    => $first_name,
            'aadhar_number' => $aadhar_number,
            'pan_number'    => $pan_number,
        ]);
    })->toArray();

    // Return object with `data` key — DataTables-friendly
    return response()->json(['data' => $results]);
}

    
    public function viewAllEmployer()
    {
        // Fetch all approval requests for admin
        $requests = DB::table('hr_data')
            ->select('id',
                'hr_name',
                'hr_email',
                'hr_phone',
                'hr_aadhar', 'hr_pan', 'hr_dob', 'hr_unique_id', 'company_name','reporting_manager_name', 'reporting_manager_mail', 'reporting_manager_contact', 'is_profile_deactivated'
            )
            ->get();
        return response()->json($requests);
    }
    
    // public function deactivateHrProfileByAdmin(Request $request)
    // {
    //     if (!session()->has('admin')) {
    //         return redirect()->route('login')->with('error', 'You need to login first');
    //     }

    //     $eimager_id = $request->input('eimagerId');


    //     DB::table('hr_data')
    //         ->where('hr_unique_id', $eimager_id)
    //         ->update(array('is_profile_deactivated' => 1));
            
    //     $admin = session('admin');
    //     DB::table('hr_data')
    //         ->where('hr_unique_id', $eimager_id)
    //         ->update(array('profile_deactivated_by' => $admin->admin_email));


    //     $hr_user = HrModel::where('hr_unique_id', $eimager_id)->first();

    //     try {
    //         $subject='Profile Deactivation';
    //         MailController::sendProfileDeactivationConfirmation($admin->admin_email, $subject, ($hr_user->hr_email . '/' . $hr_user->hr_email));
    //         MailController::sendProfileDeactivationConfirmation($hr_user->hr_email, $subject, ($hr_user->hr_email . '/' . $hr_user->hr_email));
    //         if($hr_user->reporting_manager_mail) {
    //              MailController::sendProfileDeactivationConfirmation($hr_user->reporting_manager_mail, $subject, ($hr_user->hr_email . '/' . $hr_user->hr_email));
    //         }
           
    //     } catch (Exception $e) {
    //         Log::error('Error--->' . $e);
    //     }


    //     return response()->json([
    //         'success' => true,
    //         'message' => 'success',
    //         'data' => $eimager_id,
    //         'redirect'=>'/admin-dashboard',
    //     ]);
    // }
    
    // new code after admin activity
    public function deactivateHrProfileByAdmin(Request $request)
    {
        if (!session()->has('admin')) {
            return redirect()->route('login')->with('error', 'You need to login first');
        }

        $eimager_id = $request->input('eimagerId');
        // before snapshot
        $before = DB::table('hr_data')
            ->where('hr_unique_id', $eimager_id)
            ->select('is_profile_deactivated', 'profile_deactivated_by')
            ->first();


        DB::table('hr_data')
            ->where('hr_unique_id', $eimager_id)
            ->update(array('is_profile_deactivated' => 1));

        $admin = session('admin');
        DB::table('hr_data')
            ->where('hr_unique_id', $eimager_id)
            ->update(array('profile_deactivated_by' => $admin->admin_email));
        // after snapshot
        $after = DB::table('hr_data')
            ->where('hr_unique_id', $eimager_id)
            ->select('is_profile_deactivated', 'profile_deactivated_by')
            ->first();



        $hr_user = HrModel::where('hr_unique_id', $eimager_id)->first();

        try {
            $subject = 'Profile Deactivation';
            MailController::sendProfileDeactivationConfirmation($admin->admin_email, $subject, ($hr_user->hr_email . '/' . $hr_user->hr_email));
            MailController::sendProfileDeactivationConfirmation($hr_user->hr_email, $subject, ($hr_user->hr_email . '/' . $hr_user->hr_email));
            if ($hr_user->reporting_manager_mail) {
                MailController::sendProfileDeactivationConfirmation($hr_user->reporting_manager_mail, $subject, ($hr_user->hr_email . '/' . $hr_user->hr_email));
            }

        } catch (Exception $e) {
            Log::error('Error--->' . $e);
        }
        $this->logAdmin(
            'hr_profile.deactivated',
            null,
            ['eimager_id' => $eimager_id, 'before' => $before, 'after' => $after],
            "Deactivated HR profile for {$eimager_id} by {$admin->admin_email}"
        );


        return response()->json([
            'success' => true,
            'message' => 'success',
            'data' => $eimager_id,
            'redirect' => '/admin-dashboard',
        ]);
    }

    public function viewAllProfileUpdateRequests()
    {

        $profile_update_request = ProfileUpdateRequest::all();
        
        foreach ($profile_update_request as $request) {
            if ($request->evidence_image) {
                $request->evidence_image = '/storage/public/' . $request->evidence_image;
            }
        }
        return response()->json($profile_update_request);
    }

    // public function userProfileUpdateRequestApprovalOrRejection(Request $request)
    // {
    //     $profile_update_request = ProfileUpdateRequest::where('id', $request['id'])->first();
        
    //     $eimager_id=$profile_update_request->eimager_id;
    //     $new_name=$profile_update_request->new_name;
    //     $new_aadhar=$profile_update_request->new_aadhar;
    //     $new_pan=$profile_update_request->new_pan;
    //     if($request['status'] === 'approved') {
    //         if($new_name) {
    //             RegisterData::where('unique_id', $eimager_id)->update(['first_name' => $new_name]);
    //         }
    //         if($new_aadhar) {
    //             RegisterData::where('unique_id', $eimager_id)->update(['aadhar_number' => $new_aadhar]);
    //         }
    //         if($new_aadhar) {
    //             RegisterData::where('unique_id', $eimager_id)->update(['pan_number' => $new_pan]);
    //         }
    //     }
    //     ProfileUpdateRequest::where('id', $request['id'])->update(['approval_status' =>  $request['status']]);
        
    //     return response()->json(['success' => true, 
    //     'redirect'=>'/admin-dashboard',
    //     'message' => 'updated successfully!', 'unique_id' => $eimager_id]);
    // }
    // new code after admin activity
    public function userProfileUpdateRequestApprovalOrRejection(Request $request)
{
    $pur = ProfileUpdateRequest::where('id', $request['id'])->firstOrFail();

    $eimager_id = $pur->eimager_id;
    $changes    = ['fields' => [], 'before' => [], 'after' => []];

    DB::transaction(function () use ($request, $pur, $eimager_id, &$changes) {

        if ($request['status'] === 'approved') {

            // capture current row from register_data
            $row = DB::table('register_data')->where('unique_id', $eimager_id)->first();

            if ($row) {
                $changes['before'] = [
                    'first_name'     => $row->first_name,
                    'aadhar_number'  => $row->aadhar_number,
                    'pan_number'     => $row->pan_number,
                ];
            }

            if ($pur->new_name) {
                DB::table('register_data')->where('unique_id', $eimager_id)->update(['first_name' => $pur->new_name]);
                $changes['fields'][] = 'first_name';
            }

            if ($pur->new_aadhar) {
                DB::table('register_data')->where('unique_id', $eimager_id)->update(['aadhar_number' => $pur->new_aadhar]);
                $changes['fields'][] = 'aadhar_number';
            }

            if ($pur->new_pan) {
                DB::table('register_data')->where('unique_id', $eimager_id)->update(['pan_number' => $pur->new_pan]);
                $changes['fields'][] = 'pan_number';
            }

            // fetch after snapshot
            $rowAfter = DB::table('register_data')->where('unique_id', $eimager_id)->first();
            if ($rowAfter) {
                $changes['after'] = [
                    'first_name'     => $rowAfter->first_name,
                    'aadhar_number'  => $rowAfter->aadhar_number,
                    'pan_number'     => $rowAfter->pan_number,
                ];
            }
        }

        // always update approval status on the request itself
        ProfileUpdateRequest::where('id', $request['id'])
            ->update(['approval_status' => $request['status']]);
    });

    // ⬇️ audit record (subject = the PUR row)
    $this->logAdmin(
        $request['status'] === 'approved'
            ? 'profile_update_request.approved'
            : 'profile_update_request.rejected',
        $pur,
        $changes,
        strtoupper($request['status'])." profile update request #{$pur->id} for {$eimager_id}"
    );

    return response()->json([
        'success'  => true,
        'redirect' => '/admin-dashboard',
        'message'  => 'updated successfully!',
        'unique_id'=> $eimager_id,
    ]);
}


    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string',
            'email' => 'required|email|unique:register_data,email',
            'number' => 'required|string',
            'password' => 'required|string|min:6',
            'aadhar' => 'required|string|max:20|unique:register_data,aadhar_number',
            'pan' => 'required|string|max:20|unique:register_data,pan_number',
            'dob' => 'required|date',
        ]);

        // Extracting data

        // $dob = date('Y', strtotime($request->dob)); 

        // $pan = substr($request->pan,0,4);
        // $aadhar = substr($request->aadhar, -4); 
        // $nameParts = explode(' ', $request->name);
        // $firstNameInitial = isset($nameParts[0]) ? substr($nameParts[0], 0, 1) : '';
        // $lastNameInitial = isset($nameParts[1]) ? substr($nameParts[1], 0, 1) : '';
        // if (empty($lastNameInitial)) {
        //     $lastNameInitial = isset($nameParts[0]) ? substr($nameParts[0], 1, 1) : '';
        // }

        // $unique_id = strtoupper('EI'. $firstNameInitial . $lastNameInitial . '-' . $pan . '-' . $aadhar . '-' . $dob);

        $pan = substr($request->pan, 0, 4);
        $aadhar = substr($request->aadhar, -4); // last 4 of Aadhaar
        // $dob = $request->dob; 
        $dob = date('Y', strtotime($request->dob)); 

        $nameParts = explode(' ', trim($request->name));
        $firstNameInitial = isset($nameParts[0]) ? substr($nameParts[0], 0, 1) : '';
        $lastNameInitial = '';

        // If last name exists, use its first letter
        if (isset($nameParts[1])) {
            $lastNameInitial = substr($nameParts[1], 0, 1);
        } elseif (isset($nameParts[0]) && strlen($nameParts[0]) > 1) {
            // If no last name, take second letter of first name
            $lastNameInitial = substr($nameParts[0], 1, 1);
        }

        // Ensure everything is uppercase
        $unique_id = strtoupper('EI' . $firstNameInitial . $lastNameInitial . '-' . $pan . '-' . $aadhar . '-' . $dob);
        
        $admin = session('admin');

        DB::table('register_data')->insert([
            'first_name'    => $request->name,
            'email'         => $request->email,
            'phone_number'  => $request->number,
            'password'      => Hash::make($request->password),
            'aadhar_number' => $request->aadhar,
            'pan_number'    => $request->pan,
            'dob'           => $request->dob,
            'unique_id'     => $unique_id,
            'created_by'    => $admin->admin_email,
            'created_at'    => Carbon::now(),
            'updated_at'    => Carbon::now(),
        ]);
        
        $to = $admin->admin_email;
        $subject = 'User Profile created by Admin';
        MailController::sendProfileCreatedByAdminMail($to, $subject, $request->email);
        
        return response()->json(['success' => true, 'message' => 'User created successfully!', 'unique_id' => $unique_id]);
    }
    
    // public function contacts()
    // {
    //     // fetch all contact rows
    //     $contacts = Contact::orderBy('ca_id', 'desc')->get();

    //     // pass variable to the dashboard view
    //     return view('dashboard', compact('contacts'));
    // }
   

    // JSON endpoint used by DataTables AJAX
    // public function contactsData(Request $request)
    // {
    //     $query = Contact::query();

    //     // If your table primary key is ca_id, ensure model has $primaryKey set.
    //     // Searching
    //     $search = $request->input('search.value');
    //     if (!empty($search)) {
    //         $query->where(function($q) use ($search) {
    //             $q->where('ca_name', 'like', "%{$search}%")
    //               ->orWhere('ca_email', 'like', "%{$search}%")
    //               ->orWhere('ca_number', 'like', "%{$search}%")
    //               ->orWhere('ca_address', 'like', "%{$search}%")
    //               ->orWhere('ca_type', 'like', "%{$search}%")
    //               ->orWhere('ca_message', 'like', "%{$search}%");
    //         });
    //     }

    //     // total counts
    //     $recordsTotal = Contact::count();
    //     $recordsFiltered = $query->count();

    //     // ordering - DataTables sends column index + dir
    //     $orderColumnIndex = $request->input('order.0.column');
    //     $orderDir = $request->input('order.0.dir', 'asc');

    //     $columns = [
    //         0 => 'ca_id',
    //         1 => 'ca_name',
    //         2 => 'ca_email',
    //         3 => 'ca_number',
    //         4 => 'ca_address',
    //         5 => 'ca_type',
    //         6 => 'ca_message',
    //     ];

    //     if ($orderColumnIndex !== null && isset($columns[$orderColumnIndex])) {
    //         $query->orderBy($columns[$orderColumnIndex], $orderDir);
    //     } else {
    //         $query->orderBy('ca_id', 'desc');
    //     }

    //     // paging
    //     $start = (int) $request->input('start', 0);
    //     $length = (int) $request->input('length', 10);
    //     if ($length !== -1) {
    //         $query->skip($start)->take($length);
    //     }

    //     $rows = $query->get();

    //     $data = [];
    //     foreach ($rows as $row) {
    //         $data[] = [
    //             $row->ca_id ?? $row->id,
    //             $row->ca_name,
    //             $row->ca_email,
    //             $row->ca_number,
    //             $row->ca_address,
    //             $row->ca_type,
    //             $row->ca_message,
    //         ];
    //     }

    //     return response()->json([
    //         'draw' => (int)$request->input('draw', 0),
    //         'recordsTotal' => $recordsTotal,
    //         'recordsFiltered' => $recordsFiltered,
    //         'data' => $data,
    //     ]);
    // }
    


    
}
