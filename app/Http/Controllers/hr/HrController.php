<?php

namespace App\Http\Controllers\Hr;

use Exception;
use Carbon\Carbon;
use Illuminate\Support\Facades\Log;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\RegisterData;
use App\Models\ExperienceModel;
use App\Models\QualificationModel;
use App\Models\ComplaintModel;
use Illuminate\Support\Facades\Storage;
use App\Models\ExperienceApprovalModel;
use App\Models\HrModel;
use App\Models\CustomPasswordReset;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Auth\MailController;
use Symfony\Component\Console\Output\ConsoleOutput;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Mail;
use App\Mail\EmployeerRegisterOtp;
use App\Mail\PasswordForgotOtp;
use App\Mail\SendResetPasswordLink;
use App\Http\Controllers\utils\Utilities;

// use Session;
use App\Models\User;
// use Hash;
use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;

class HrController extends Controller
{
    /**
     * Write code on Method
     *
     * @return response()
     */
    public function index(): View
    {
        return view('hr.login');
    }

    /**
     * Write code on Method
     *
     * @return response()
     */
    public function registration(): View
    {
        return view('hr.registration');
    }

    public function storeStep1(Request $request)
    {
        // Validate incoming data
        $validator = Validator::make($request->all(), [
            'company_name' => 'required|string|max:255',
            'hr_name' => ['required', 'string', 'min:2', 'max:100', 'regex:/^[a-zA-Z\s.\'-]+$/',],
            'hr_email' => ['required', 'string', 'email:rfc,dns', 'max:255', 'unique:hr_data,hr_email',],
            //'hr_phone' => 'required|digits:10|unique:hr_data,hr_phone',
            'hr_phone' => 'required|string|digits:10|unique:hr_data,hr_phone|regex:/^[6-9][0-9]{9}$/',
            'hr_password' => ['required', 'string', 'min:8', 'max:64', 'regex:/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*?&#])[A-Za-z\d@$!%*?&#]{8,64}$/',],
            'hr_password_confirmation' => 'required|string|same:hr_password',
        ], [
            // Company Name
            'company_name.required' => 'Company name is required.',
            'company_name.string' => 'Company name must be a valid string.',
            'company_name.max' => 'Company name cannot exceed 255 characters.',

            // HR Name
            'hr_name.required' => 'Name is required.',
            'hr_name.string' => 'Name must be a valid string.',
            'hr_name.min' => 'Name must be at least 2 characters.',
            'hr_name.max' => 'Name cannot exceed 100 characters.',
            'hr_name.regex' => 'Name may only contain letters, spaces, periods, hyphens, or apostrophes.',

            // HR Email
            'hr_email.required' => 'email is required.',
            'hr_email.string' => 'email must be a valid string.',
            'hr_email.email' => 'Please enter a valid email address.',
            'hr_email.max' => 'email cannot exceed 255 characters.',
            'hr_email.unique' => 'This email is already registered.',

            // HR Phone (if enabled)
            // 'hr_phone.required' => 'Phone number is required.',
            // 'hr_phone.digits' => 'Phone number must be exactly 10 digits.',
            // 'hr_phone.unique' => 'This phone number is already registered.',

            // HR Password
            'hr_password.required' => 'Password is required.',
            'hr_password.string' => 'Password must be a valid string.',
            'hr_password.min' => 'Password must be at least 8 characters.',
            'hr_password.max' => 'Password cannot exceed 64 characters.',
            'hr_password.regex' => 'Password must have uppercase, lowercase, number & special character (@$!%*?&#).',
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        // Generate Base HR Unique ID
        $companyPrefix = substr(preg_replace('/\s+/', '', $request->company_name), 0, 3); // First 3 letters of company name (without spaces)
        $firstName = explode(' ', trim($request->hr_name))[0]; // Extract first name from hr_name
        $baseHrUniqueId = strtolower($companyPrefix . '_hr_' . $firstName); // Base unique ID

        // Ensure Unique HR Unique ID
        $hrUniqueId = $baseHrUniqueId;
        $count = 1;
        while (HrModel::where('hr_unique_id', $hrUniqueId)->exists()) {
            $hrUniqueId = $baseHrUniqueId . $count; // Append numeric suffix
            $count++;
        }

        // Generate OTP (6-digit random number)
        $otp = rand(100000, 999999);
        $to = $request->hr_email;
        $subject = "OTP Employer Registration";

        // Store Data in Database
        $hr = HrModel::create([
            'company_name' => $request->company_name,
            'hr_name' => $request->hr_name,
            'hr_email' => $request->hr_email,
            'hr_phone' => $request->hr_phone,
            'hr_password' => Hash::make($request->hr_password), // Use Hash::make
            'register_otp' => $otp, // Store OTP
            'is_register_verified' => false, // Not verified yet
            'hr_unique_id' => $hrUniqueId, // Store unique ID
        ]);
        // dd($hr);
        // Send OTP Email
        try {
            Mail::to($to)->send(new EmployeerRegisterOtp($subject, $otp));
        } catch (Exception $e) {
            Log::error('Error--->');
        }
        //   Mail::to($to)->send(new EmployeerRegisterOtp($subject, $otp));
        return response()->json([
            'success' => true,
            'message' => 'Step 1 data saved. OTP sent.',
            'hr_email' => $hr->hr_email, // Return email instead of ID
            'hr_unique_id' => $hrUniqueId, // Return the unique ID for confirmation
        ]);
    }

    public function storeStep2(Request $request)
    {
        $validatedData = $request->validate([
            'hr_email' => ['required', 'string', 'email:rfc,dns', 'max:255', 'exists:hr_data,hr_email',], // Ensure HR email exists
            'hr_aadhar' => ['required', 'string', 'digits:12', 'unique:hr_data,hr_aadhar',],
            'hr_pan' => ['required', 'string', 'size:10', 'regex:/^[A-Z]{5}[0-9]{4}[A-Z]{1}$/', 'unique:hr_data,hr_pan',],
            'hr_dob' => 'required|date',

        ], [
            // Custom messages
            'hr_email.required' => 'email is required.',
            'hr_email.string' => 'email must be a valid string.',
            'hr_email.email' => 'Please enter a valid email address.',
            'hr_email.max' => 'email cannot exceed 255 characters.',
            'hr_email.exists' => 'This email does not exist in our records.',

            'hr_aadhar.required' => 'Aadhar number is required.',
            'hr_aadhar.string' => 'Aadhar number must be a valid string.',
            'hr_aadhar.digits' => 'Aadhar number must be exactly 12 digits.',
            'hr_aadhar.unique' => 'This Aadhar number is already registered.',

            'hr_pan.required' => 'PAN number is required.',
            'hr_pan.string' => 'PAN number must be a valid string.',
            'hr_pan.size' => 'PAN number must be exactly 10 characters.',
            'hr_pan.regex' => 'PAN number format is invalid. Example: ABCDE1234F.',
            'hr_pan.unique' => 'This PAN number is already registered.',

            'hr_dob.required' => 'Date of birth is required.',
            'hr_dob.date' => 'Please enter a valid date of birth.',
        ]);

        // Find the HR record by email
        $hrData = HrModel::where('hr_email', $validatedData['hr_email'])->first();

        if ($hrData) {
            // Update existing HR record
            $hrData->update([
                'hr_aadhar' => $validatedData['hr_aadhar'],
                'hr_pan' => $validatedData['hr_pan'],
                'hr_dob' => $validatedData['hr_dob'],
            ]);

            return response()->json([
                'success' => true,
                'message' => 'HR step2 successfully!',
                'data' => $hrData,

            ]);
        }

        return response()->json([
            'success' => false,
            'message' => 'HR email not found!',
        ], 404);
    }

    public function storeStep3(Request $request)
    {
        $validatedData = $request->validate([
            'hr_email' => ['required', 'string', 'email:rfc,dns', 'max:255', 'exists:hr_data,hr_email',], // Ensure HR email exists
            'reporting_manager_mail' => ['required', 'string', 'email:rfc,dns', 'max:255',],
            'reporting_manager_name' => ['required', 'string', 'min:2', 'max:100', 'regex:/^[A-Za-zÀ-ÖØ-öø-ÿ\s.\'-]+$/u',],
            'reporting_manager_contact' => ['required', 'digits:10', 'numeric',],
            'company_website' => 'required|max:255',
        ], [
            // HR Email
            'hr_email.required' => 'email is required.',
            'hr_email.string' => 'email must be a valid string.',
            'hr_email.email' => 'Please enter a valid email address.',
            'hr_email.max' => 'email cannot exceed 255 characters.',
            'hr_email.exists' => 'This email does not exist in our records.',

            // Reporting Manager Email
            'reporting_manager_mail.required' => 'email is required.',
            'reporting_manager_mail.string' => 'email must be a valid string.',
            'reporting_manager_mail.email' => 'Please enter a valid email address.',
            'reporting_manager_mail.max' => 'email cannot exceed 255 characters.',

            // Reporting Manager Name
            'reporting_manager_name.required' => 'Name is required.',
            'reporting_manager_name.string' => 'Name must be a valid string.',
            'reporting_manager_name.min' => 'Name must be at least 2 characters.',
            'reporting_manager_name.max' => 'Name cannot exceed 100 characters.',
            'reporting_manager_name.regex' => 'Name may only contain letters, spaces, periods, hyphens, or apostrophes.',

            // Reporting Manager Contact
            'reporting_manager_contact.required' => 'Contact number is required.',
            'reporting_manager_contact.digits' => 'Contact number must be exactly 10 digits.',
            'reporting_manager_contact.numeric' => 'Contact number must contain only numbers.',

            // Company Website
            'company_website.required' => 'Company website is required.',
            'company_website.max' => 'Company website cannot exceed 255 characters.',
        ]);

        // Find the HR record by email
        $hrData = HrModel::where('hr_email', $validatedData['hr_email'])->first();

        if ($hrData) {
            // Update existing HR record
            $hrData->update([
                'reporting_manager_mail' => $validatedData['reporting_manager_mail'],
                'reporting_manager_name' => $validatedData['reporting_manager_name'],
                'reporting_manager_contact' => $validatedData['reporting_manager_contact'],
                'company_website' => $validatedData['company_website'],
            ]);


            $reporting_manager_mail = $validatedData['reporting_manager_mail'];
            //MailController::sendProfileCreatedMail($reporting_manager_mail, 'EImager - HR Profile Created', $validatedData['hr_email']);

            return response()->json([
                'success' => true,
                'message' => 'HR step3 successfully!',
                'data' => $hrData,
                'redirect' => url('hrdashboard')

            ]);
        }

        return response()->json([
            'success' => false,
            'message' => 'HR email not found!',
        ], 404);
    }

    public function store(Request $request)
    {
        return response()->json([
            'success' => true,
            'message' => 'HR Registered successfully!',
            'redirect' => url('hr-login')
        ]);
        // return response()->json([
        //     'success' => false,
        //     'message' => 'HR email not found!',
        // ], 404);
    }

    public function checkPartialRegistration(Request $request)
    {
        $validatedData = $request->validate([
            'hr_email' => 'required|email|exists:hr_data,hr_email', // Ensure HR email exists
        ]);

        // Find the HR record by email
        $hrData = HrModel::where('hr_email', $validatedData['hr_email'])->first();

        $is_partially_created = false;
        if ($hrData && $hrData->hr_email) {
            if (!$hrData->hr_unique_id || !$hrData->hr_aadhar || !$hrData->hr_pan || !$hrData->hr_dob) {
                //Account partially created....
                $is_partially_created = true;
            }
        }

        return response()->json([
            'success' => true,
            'message' => 'HR Creation status',
            'data' => $is_partially_created,

        ]);
    }

    public function deletePartiallyCreatedAccount(Request $request)
    {
        $validatedData = $request->validate([
            'hr_email' => 'required|email|exists:hr_data,hr_email', // Ensure HR email exists
        ]);

        DB::table('hr_data')->where('hr_email', $validatedData['hr_email'])->delete();


        return response()->json([
            'success' => true,
            'message' => 'Data Deletion',
            'data' => $validatedData['hr_email'],

        ]);
    }

    // public function login(Request $request)
    // {
    //     $validatedData = $request->validate([

    //         'hr_unique_id' => 'required|string',
    //         'hr_password' => 'required|string|min:6',
    //     ]);


    //     $user = HrModel::where('hr_unique_id', $validatedData['hr_unique_id'])
    //     ->orWhere('hr_email', $validatedData['hr_unique_id'])->first();


    //     if($user && ( $user->is_profile_deactivated)) {
    //         return response()->json([
    //             'success' => false,
    //             'message' => 'User Profile deactivated'
    //         ], 401);
    //     }


    //     if (!$user || !Hash::check($validatedData['hr_password'], $user->hr_password)) {
    //         return response()->json([
    //             'success' => false,
    //             'message' => 'Invalid unique ID or password!'
    //         ], 401);
    //     }

    //     // ✅ Store user in session
    //     session(['user' => $user]);

    //     return response()->json([
    //         'success' => true,
    //         'message' => 'HR Login successful!',
    //         'data' => $user,
    //         'redirect' => url('hrdashboard')
    //     ]);
    // }

    // public function login(Request $request)
    // {
    //     try {
    //         $validatedData = $request->validate([
    //             'hr_unique_id' => 'required|string',
    //             'hr_password' => 'required|string|min:6',
    //         ]);

    //         $input = $validatedData['hr_unique_id'];
    //         $user = HrModel::where(function ($query) use ($input) {
    //             $query->where('hr_unique_id', $input)
    //                 ->orWhere('hr_email', $input);
    //         })->first();

    //         // Check if HR profile is deactivated
    //         if ($user && $user->is_profile_deactivated) {
    //             return response()->json([
    //                 'success' => false,
    //                 'message' => 'User profile is deactivated.',
    //             ], 401);
    //         }
    //         // Check if account is partially created and delete if so
    //         if (
    //             !$user ||
    //             !$user->hr_unique_id ||
    //             !$user->hr_aadhar ||
    //             !$user->hr_pan ||
    //             !$user->hr_dob
    //         ) {
    //             // Delete partially created account
    //             if ($user) {
    //                 HrModel::where('id', $user->id)->delete();
    //             }
    //             return response()->json([
    //                 'success' => false,
    //                 'message' => 'Account was incomplete and has been deleted. Please register again.',
    //             ], 401);
    //         }

    //         // Check if user not found or hr_unique_id is missing or password doesn't match
    //         if (!$user || !$user->hr_unique_id || !Hash::check($validatedData['hr_password'], $user->hr_password)) {
    //             $message = filter_var($input, FILTER_VALIDATE_EMAIL)
    //                 ? 'Invalid email or password!'
    //                 : 'Invalid EImager ID or password!';

    //             return response()->json([
    //                 'success' => false,
    //                 'message' => $message,
    //             ], 401);
    //         }

    //         // Store HR in session
    //         session(['user' => $user]);

    //         return response()->json([
    //             'success' => true,
    //             'message' => 'HR Login successful!',
    //             'data' => $user,
    //             'redirect' => url('hrdashboard'),
    //         ]);
    //     } catch (\Exception $e) {
    //         Log::error('HR Login Error: ' . $e->getMessage());

    //         return response()->json([
    //             'success' => false,
    //             'message' => 'Something went wrong during login.',
    //             'error' => $e->getMessage(),
    //         ], 500);
    //     }
    // }

    public function login(Request $request)
    {
        try {
            $validatedData = $request->validate([
                'hr_unique_id' => 'required|string',
                'hr_password' => 'required|string|min:6',
            ]);
    
            $input = $validatedData['hr_unique_id'];
            $user = HrModel::where(function ($query) use ($input) {
                $query->where('hr_unique_id', $input)
                    ->orWhere('hr_email', $input);
            })->first();
    
            // If user not found, show invalid credentials
            if (!$user) {
                return response()->json([
                    'success' => false,
                    'message' => 'Invalid EImager ID or email!',
                ], 401);
            }
    
            // Check if HR profile is deactivated
            if ($user->is_profile_deactivated) {
                return response()->json([
                    'success' => false,
                    'message' => 'User profile is deactivated.',
                ], 401);
            }
    
            // Use the same partial check logic as checkPartialRegistration
            $is_partially_created = false;
            if (
                !$user->hr_unique_id ||
                !$user->hr_aadhar ||
                !$user->hr_pan ||
                !$user->reporting_manager_mail
            ) {
                $is_partially_created = true;
            }
    
            // If partial, delete and return error
            if ($is_partially_created) {
                HrModel::where('id', $user->id)->delete();
                return response()->json([
                    'success' => false,
                    'message' => 'Account was incomplete and has been deleted. Please register again.',
                ], 401);
            }
    
            // Check password
            if (!Hash::check($validatedData['hr_password'], $user->hr_password)) {
                $message = filter_var($input, FILTER_VALIDATE_EMAIL)
                    ? 'Invalid email or password!'
                    : 'Invalid EImager ID or password!';
    
                return response()->json([
                    'success' => false,
                    'message' => $message,
                ], 401);
            }
    
            // Store HR in session
            session(['user' => $user]);
    
            return response()->json([
                'success' => true,
                'message' => 'HR Login successful!',
                'data' => $user,
                'redirect' => url('hrdashboard'),
            ]);
        } catch (\Exception $e) {
            Log::error('HR Login Error: ' . $e->getMessage());
    
            return response()->json([
                'success' => false,
                'message' => 'Something went wrong during login.',
                'error' => $e->getMessage(),
            ], 500);
        }
    }

    public function hrdashboard()
    {


        // Check if user is logged in via session
        if (!session()->has('user')) {
            return redirect()->route('hr-login-page')->with('error', 'Please login first.');
        }


        $user = session('user');
        $eimagerId = $user->hr_unique_id;

        $allRequestCount = DB::select('select count(*) request_count from user_experience_approval where approver_email = (select hr_email from hr_data where hr_unique_id=?)', [$eimagerId]);
        $request_count = $allRequestCount[0]->request_count;

        $approved = DB::select('select count(*) approval_count from user_experience_approval where approver_email = (select hr_email from hr_data where hr_unique_id=?) and lower(approval_status)=lower(?)', [$eimagerId, 'approved']);
        $approval_count = $approved[0]->approval_count;

        $pending = DB::select('select count(*) pending_count from user_experience_approval where experience_id in (select id from user_experience where eimager_id=?) and lower(approval_status)=lower(?)', [$eimagerId, 'pending']);
        $pending_count = $pending[0]->pending_count;


        // Get logged-in user from session
        $user = session('user');


        session(['request_count' => $request_count]);
        session(['approval_count' => $approval_count]);
        session(['pending_count' => $pending_count]);

        // dd($user);
        return view('hr.dashboard', compact('user'));
    }

    public function hrlogout(Request $request)
    {
        // Clear session data
        Session::forget('user');
        Session::flush();

        return response()->json([
            'success' => true,
            'message' => 'Hr Logged out successfully!',
            'redirect' => url('/')
        ]);
    }

    public function viewApprovalRequests()
    {
        // Check if session data exists
        if (!session()->has('user')) {
            return response()->json(['error' => 'User not authenticated'], 401);
        }

        // Retrieve the logged-in HR's email from the session
        $hrEmail = session('user')->hr_email; // Ensure the column name is correct
        // Fetch approval requests for this HR
        $requests = DB::table('user_experience_approval')
            ->join('user_experience', 'user_experience.id', '=', 'user_experience_approval.experience_id')

            ->where('user_experience_approval.approver_email', $hrEmail)
            ->select(
                'user_experience.*',
                'user_experience_approval.id as approval_id',
                'user_experience_approval.approval_status',
                'user_experience_approval.status_note'
            )
            ->get();

        foreach ($requests as $request) {
            $user_info = DB::table('register_data')->where('unique_id', $request->eimager_id)->first();
            $request->first_name = $user_info->first_name;
            $request->aadhar_number = $user_info->aadhar_number;
            $request->pan_number = $user_info->pan_number;
        }
        return response()->json($requests);
    }
    //   public function viewApprovalRequests()
// {
//     // Return JSON error if not authenticated for AJAX
//     if (!session()->has('user')) {
//         return response()->json(['error' => 'User not authenticated'], 401);
//     }

    //     $hrEmail = session('user')->hr_email;

    //     // Single query: get user_experience + approval info + register_data fields
//     $requests = DB::table('user_experience_approval as uea')
//         ->join('user_experience as ue', 'ue.id', '=', 'uea.experience_id')
//         ->leftJoin('register_data as rd', 'rd.unique_id', '=', 'ue.eimager_id')
//         ->where('uea.approver_email', $hrEmail)
//         ->select(
//             'ue.*',
//             'uea.id as approval_id',
//             'uea.approval_status',
//             'uea.status_note',
//             'rd.first_name as first_name',
//             'rd.aadhar_number as aadhar_number',
//             'rd.pan_number as pan_number'
//         )
//         ->get();

    //     // Return DataTables-friendly payload
//     return response()->json(['data' => $requests]);
// }




    public function addApprovalAndStatusByEmployer(Request $request)
    {
        $validatedData = $request->validate([
            // 'eimagerId' => 'required|string|max:200',
            'experience_id' => 'required|int|max:200',
            'approval_status' => 'required|string|max:1024',
            'status_note' => 'required|string|max:1024',
        ]);


        // $output = new ConsoleOutput();
        // $output->writeln('------------------->>>++ '. $request['approval_status']);
        // $output->writeln('------------------->>>++ '. $request['status_note']);


        $hruniqueid = session('user')->hr_unique_id;
        $experience_id = $request->input('experience_id');

        $employee_details = DB::select('select first_name, email, unique_id from register_data where unique_id=(select eimager_id from user_experience where id = ?)', [$experience_id]);
        $user_details = DB::select('select hr_name, hr_email from hr_data where hr_unique_id=?', [$hruniqueid]);

        // Store data in the database
        $experience = ExperienceApprovalModel::create([
            'experience_id' => $request['experience_id'],
            'approval_status' => $request['approval_status'],
            'status_note' => $request['status_note'],
            'approver_email' => session('user')->hr_email,
        ]);


        // $employee_name = $user_details[0]->first_name;
        // $employee_eimager_id = $user_details[0]->unique_id;

        // $to = $approver_email;
        // $from = 'eimager@gmail.com';
        // $subject = 'Experience Approved';

        // MailController::sendReviewRequestMail($to, $from, $subject, $employee_name, $employee_eimager_id);

        return response()->json([
            'success' => true,
            'message' => 'Request has been created.',
            'data' => $experience
        ]);
    }

    public function showProfile()
    {

        if (!session()->has('user')) {
            return redirect()->route('login')->with('error', 'You need to login first');
        }

        $hruniqueid = session('user')->hr_unique_id;
        $hr = HrModel::where('hr_unique_id', $hruniqueid)->first();
        // dd($hr);
        if (!$hr) {
            return redirect()->route('dashboard')->with('error', 'HR profile not found');
        }

        // $hr->hr_aadhar = str_repeat('*', strlen($hr->hr_aadhar) - 4) . substr($hr->hr_aadhar, -4);
        // $hr->hr_pan = str_repeat('*', strlen($hr->hr_pan) - 4) . substr($hr->hr_pan, -4);
        if (!empty($hr->hr_aadhar)) {
            $hr->hr_aadhar = str_repeat('*', strlen($hr->hr_aadhar) - 4) . substr($hr->hr_aadhar, -4);
        } else {
            $hr->hr_aadhar = '';
        }

        if (!empty($hr->hr_pan)) {
            $hr->hr_pan = str_repeat('*', strlen($hr->hr_pan) - 4) . substr($hr->hr_pan, -4);
        } else {
            $hr->hr_pan = '';
        }


        return view('hr.profile', compact('hr'));
    }

    public function showEmployeeProfile()
    {
        if (!session()->has('user')) {
            // return redirect()->route('hr-login')->with('error', 'You need to login first');
            return redirect()->to('/hr-login')->with('error', 'You need to login first');



        }

        $hr = session('user');


        return view('hr.employeeprofile', compact('hr'));
    }

    public function employeeExperienceByEimagerId(Request $request)
    {
        $output = new ConsoleOutput();
        $eimager_id = $request->input('eimager_id');
        $employee_eimager_id = $request->input('employee_eimager_id');

        // $allExperience = ExperienceModel::where('eimager_id', $eimager_id)->orderby('created_at','DESC')->get();

        $allExperience = DB::select('SELECT ue.*, (select approval_status from user_experience_approval where experience_id=ue.id ORDER by created_at desc LIMIT 1) as approval_status, (select status_note from user_experience_approval where experience_id=ue.id ORDER by created_at desc LIMIT 1) as status_note FROM user_experience as ue WHERE eimager_id= ?', [$employee_eimager_id]);

        $user = HrModel::where('hr_unique_id', $eimager_id)->first();

        $data = [];
        foreach ($allExperience as $exp) {
            $lwd_updated_by = '';
            if ($exp->lwd_updated_by_employer_id) {
                $employer = HrModel::where('id', $exp->lwd_updated_by_employer_id)->first();

                $lwd_updated_by = '  (Updated by ' . $employer->hr_name . ' of ' . $employer->company_name . ')';
            }
            $data[] = [
                'exp_id' => $exp->id,
                'company_name' => $exp->company_name,
                'designation' => $exp->designation,
                'projects' => $exp->projects,
                'start_date' => $exp->start_date,
                'end_date' => ($exp->end_date == null ? 'Still Working' : ($exp->end_date . $lwd_updated_by)),
                'ctc' => $exp->ctc,
                'in_hand' => $exp->in_hand,
                'roles_responsibility' => $exp->roles_responsibility,
                'approval_status' => $exp->approval_status,
                'status_note' => $exp->status_note,
                'is_approval_visible' => ($exp->company_name === $user->company_name ? true : false)
            ];
        }

        return response()->json([
            'success' => true,
            'message' => 'success',
            'data' => $data
        ]);
    }

    // public function searchEmployeeProfile(Request $request)
    // {
    //     if (!session()->has('user')) {
    //         return redirect()->route('login')->with('error', 'You need to login first');
    //     }

    //     $eimager_id = $request->input('eimagerId');
    //     $aadhar_number = $request->input('aadharNumber');
    //     $pan_number = $request->input('panNumber');
    //     $email = $request->input('email');
    //     $user = RegisterData::where('unique_id', $eimager_id)->orWhere('aadhar_number', $aadhar_number)->orWhere('pan_number', $pan_number)->orWhere('email', $email)->first();

    //     if ($user) {
    //         $user->aadhar_number = str_repeat('*', strlen($user->aadhar_number) - 4) . substr($user->aadhar_number, -4);
    //         $user->pan_number = substr($user->pan_number, 5) . str_repeat('*', strlen($user->pan_number) - 5);
    //         $user->phone_number = substr($user->phone_number, 0, 3) . str_repeat('*', (strlen($user->phone_number) - 3)) . substr($user->phone_number, -3);
    //         $user->email = Str::mask($user->email, '*', 2, 7);


    //         if($user->profile_image) {
    //             $user->profile_image = '/storage/public/' . $user->profile_image;
    //         } else {
    //              $user->profile_image = '/images/avatar7.png';
    //         }

    //         return response()->json([
    //             'success' => true,
    //             'message' => 'success',
    //             'data' => $user
    //         ]);
    //     } else {
    //         return response()->json([
    //             'success' => false,
    //             'status' => 'error',
    //             'message' => 'User Not found. Please enter correct input'
    //         ]);
    //     }
    // }
//     public function searchEmployeeProfile(Request $request)
// {
//     if (!session()->has('user')) {
//         return redirect()->route('login')->with('error', 'You need to login first');
//     }

    //     $eimager_id    = $request->input('eimagerId');
//     $aadhar_number = $request->input('aadharNumber');
//     $pan_number    = $request->input('panNumber');
//     $email         = $request->input('email');

    //     $user = RegisterData::where('unique_id', $eimager_id)
//         ->orWhere('aadhar_number', $aadhar_number)
//         ->orWhere('pan_number', $pan_number)
//         ->orWhere('email', $email)
//         ->first();

    //     if ($user) {
//         // Mask Aadhaar (last 4 digits visible)
//         if (!empty($user->aadhar_number) && strlen($user->aadhar_number) > 4) {
//             $user->aadhar_number = str_repeat('*', max(0, strlen($user->aadhar_number) - 4))
//                                  . substr($user->aadhar_number, -4);
//         }

    //         // Mask PAN (first 5 visible, rest hidden)
//         if (!empty($user->pan_number) && strlen($user->pan_number) > 5) {
//             $user->pan_number = substr($user->pan_number, 0, 5)
//                               . str_repeat('*', max(0, strlen($user->pan_number) - 5));
//         }

    //         // Mask Phone (first 3 + last 3 visible)
//         if (!empty($user->phone_number) && strlen($user->phone_number) > 6) {
//             $user->phone_number = substr($user->phone_number, 0, 3)
//                                 . str_repeat('*', max(0, strlen($user->phone_number) - 6))
//                                 . substr($user->phone_number, -3);
//         }

    //         // Mask Email
//         if (!empty($user->email)) {
//             $user->email = Str::mask($user->email, '*', 2, 7);
//         }

    //         // Profile image fallback
//         if ($user->profile_image) {
//             $user->profile_image = '/storage/public/' . $user->profile_image;
//         } else {
//             $user->profile_image = '/images/avatar7.png';
//         }

    //         return response()->json([
//             'success' => true,
//             'message' => 'success',
//             'data'    => $user
//         ]);
//     } else {
//         return response()->json([
//             'success' => false,
//             'status'  => 'error',
//             'message' => 'User Not found. Please enter correct input'
//         ]);
//     }
// }
    public function searchEmployeeProfile(Request $request)
    {
        if (!session()->has('user')) {
            return redirect()->route('login')->with('error', 'You need to login first');
        }

        $eimager_id = $request->input('eimagerId');
        $aadhar_number = $request->input('aadharNumber');
        $pan_number = $request->input('panNumber');
        $email = $request->input('email');

        // Build query only with provided inputs
        $query = RegisterData::query();

        if ($request->filled('eimagerId')) {
            $query->where('unique_id', $eimager_id);
        }
        if ($request->filled('aadharNumber')) {
            $query->where('aadhar_number', $aadhar_number);
        }
        if ($request->filled('panNumber')) {
            $query->where('pan_number', $pan_number);
        }
        if ($request->filled('email')) {
            $query->where('email', $email);
        }

        // If no where clause was added, return early
        if ($query->getQuery()->wheres === null || count($query->getQuery()->wheres) === 0) {
            return response()->json([
                'success' => false,
                'status' => 'error',
                'message' => 'Please provide at least one search field.'
            ]);
        }

        $user = $query->first();

        if ($user) {
            // Mask aadhar (leave last 4 digits)
            if (!empty($user->aadhar_number)) {
                $len = strlen($user->aadhar_number);
                if ($len > 4) {
                    $user->aadhar_number = str_repeat('*', max(0, $len - 4)) . substr($user->aadhar_number, -4);
                } else {
                    $user->aadhar_number = str_repeat('*', $len);
                }
            }

            // Mask PAN (show first 5? your original substr seemed reversed; show first 5 then mask remainder)
            if (!empty($user->pan_number)) {
                $len = strlen($user->pan_number);
                $prefixLen = min(5, $len);
                $user->pan_number = substr($user->pan_number, 0, $prefixLen) . str_repeat('*', max(0, $len - $prefixLen));
            }

            // Mask phone (show first 3 and last 3)
            if (!empty($user->phone_number)) {
                $len = strlen($user->phone_number);
                if ($len > 6) {
                    $user->phone_number = substr($user->phone_number, 0, 3)
                        . str_repeat('*', max(0, $len - 6))
                        . substr($user->phone_number, -3);
                } else {
                    $user->phone_number = str_repeat('*', $len);
                }
            }

            // Mask email (using Str::mask; adjust offsets if needed)
            if (!empty($user->email)) {
                // keep first 2 chars, mask next 7 chars (or as many as possible)
                $user->email = Str::mask($user->email, '*', 2, 7);
            }
            // Profile image path fix: if stored path is inside storage/app/public use Storage::url
            if ($user->profile_image) {
                $user->profile_image = '/storage/public/' . $user->profile_image;
            } else {
                $user->profile_image = '/images/avatar7.png';
            }

            // Profile image path fix: if stored path is inside storage/app/public use Storage::url

            // if ($user->profile_image) {
            //     // if you stored just the path without "public/", create a URL
            //     // this assumes you have `php artisan storage:link` configured
            //     $user->profile_image = Storage::url($user->profile_image);
            // } else {
            //     $user->profile_image = asset('/images/avatar7.png');
            // }

            return response()->json([
                'success' => true,
                'message' => 'success',
                'data' => $user
            ]);
        } else {
            return response()->json([
                'success' => false,
                'status' => 'error',
                'message' => 'User Not found. Please enter correct input'
            ]);
        }
    }


    public function sendOtpRequest(Request $request)
    {
        if (!session()->has('user')) {
            return redirect()->route('login')->with('error', 'You need to login first');
        }

        $eimager_id = $request->input('eimagerId');
        $employeeEmail = $request->input('employeeEmail');
        $employeeEImagerId = $request->input('employeeEImagerId');
        $employee = RegisterData::where('unique_id', $employeeEImagerId)->first();
        $user = HrModel::where('hr_unique_id', $eimager_id)->first();
        // dd($user) ;   
        $user_name = $employee->first_name;
        $eimager_id = $employee->unique_id;
        $employee_eimager = $user->hr_unique_id;
        $to = $user->hr_email;
        $subject = 'OTP for Employee Profile';
        $otp = rand(10000, 99999);
        DB::table('hr_data')
            ->where('hr_unique_id', $employee_eimager)  // find your user by their email
            ->update(array('employee_profile_otp' => $otp));

        try {
            MailController::sendEmployeeProfileOtp($to, $subject, $otp);
        } catch (Exception $e) {
            Log::error('Error--->', $e);
        }
        // MailController::sendEmployeeProfileOtp($to, $subject, $otp);

        return response()->json([
            'success' => true,
            'message' => 'success',
            'data' => $user
        ]);
    }



    public function updateApprovalStatus(Request $request)
    {
        $request->validate([
            'id' => 'required|integer',  // Update to match your table column
            'approval_status' => 'required|in:pending,approved,rejected',  // Ensure valid status
            'status_note' => 'nullable|string'
        ]);

        $approval = ExperienceApprovalModel::find($request->id); // Fetch by ID

        if (!$approval) {
            return response()->json(['message' => 'Approval request not found'], 404);
        }

        // Update fields
        $approval->approval_status = $request->approval_status;
        $approval->status_note = $request->status_note;
        $approval->save();

        return response()->json(['message' => 'Approval status updated successfully']);
    }

    public function approveExperienceByEmployer(Request $request)
    {
        $request->validate([
            'id' => 'required|integer',  // Update to match your table column
            'approval_status' => 'required|in:pending,approved,rejected',  // Ensure valid status
            'status_note' => 'nullable|string'
        ]);

        $approval = ExperienceApprovalModel::find($request->id); // Fetch by ID

        if (!$approval) {
            return response()->json(['message' => 'Approval request not found'], 404);
        }

        // Update fields
        $approval->approval_status = $request->approval_status;
        $approval->status_note = $request->status_note;
        $approval->save();

        return response()->json(['message' => 'Approval status updated successfully']);
    }


    public function sendApprovalOrRejectionRequest(Request $request)
    {
        if (!session()->has('user')) {
            return redirect()->route('login')->with('error', 'You need to login first');
        }

        $eimager_id = $request->input('eimagerId');

        $user = HrModel::where('hr_unique_id', $eimager_id)->first();
        $to = $user->hr_email;
        $subject = 'OTP for Experience Approval/Rejection';
        $otp = rand(10000, 99999);
        DB::table('hr_data')
            ->where('hr_unique_id', $eimager_id)
            ->update(array('employee_approval_rejection_otp' => $otp));

        MailController::sendExperienceApprovalRejectionOtp($to, $subject, $otp);
        return response()->json([
            'success' => true,
            'message' => 'success',
            'data' => $user
        ]);
    }



    // public function approvalRejectionOtpVerification(Request $request)
    // {

    //     $otp = $request->input('otp');

    //     // Check if OTP exists in hr_data table
    //     $exists = DB::table('hr_data')->where('employee_approval_rejection_otp', $otp)->exists();

    //     if ($exists || Utilities::checkAndIgnoreOtpVerification()) {
    //         return response()->json(['success' => true, 'message' => 'OTP Verified Successfully']);
    //     } else {
    //         return response()->json(['success' => false, 'message' => 'Invalid OTP']);
    //     }
    // }

    // public function checkAndIgnoreOtpVerification() {
    //     $ignore_otp_verification = env('APP_IGNORE_OTP_VERIFICATION');
    //     $output = new ConsoleOutput();
    //     return $ignore_otp_verification;
    // }


    // public function verifyOtp(Request $request)
    // {
    //     $otp = $request->input('otp');

    //     // Check if OTP exists in hr_data table
    //     $exists = DB::table('hr_data')->where('employee_profile_otp', $otp)->exists();

    //     if ($exists ||  Utilities::checkAndIgnoreOtpVerification()) {
    //         return response()->json(['success' => true, 'message' => 'OTP Verified Successfully']);
    //     } else {
    //         return response()->json(['success' => false, 'message' => 'Invalid OTP']);
    //     }
    // }


    public function verifyregisterOtp(Request $request)
    {
        $request->validate([
            'hr_email' => 'required|email',
            'otp' => 'required|digits:6',
        ]);

        $hr = HrModel::where('hr_email', $request->hr_email)
            ->where('register_otp', $request->otp)
            ->first();

        $output = new ConsoleOutput();
        // $output->writeln('------------------->>>++ '. $this->checkAndIgnoreOtpVerification() );
        // $output->writeln('------------------->>>0000 '. Utilities::checkAndIgnoreOtpVerification() );
        // $output->writeln('------------------->>>++ ', [$hr] );

        if ($hr || Utilities::checkAndIgnoreOtpVerification()) {
            if ($hr) {
                $hr->update(['is_register_verified' => true]); // Mark as verified
            }
            return response()->json(['success' => true, 'message' => 'OTP Verified! Proceed to the next step.']);
        } else {
            return response()->json(['success' => false, 'message' => 'Invalid OTP! Please try again.']);
        }
    }

    public function addstore(Request $request)
    {
        try {
            $validated = Validator::make($request->all(), [
                'hr_name' => 'required|string|max:255',
                'hr_email' => 'required|email|unique:hr_data,hr_email',
                'hr_phone' => 'required|digits:10|unique:hr_data,hr_phone',
                'hr_password' => 'required|string|min:6',
                'company_name' => 'required|string|max:255',
                'reporting_manager_mail' => 'required|email',
                'hr_aadhar' => 'required|string|max:20',
                'hr_pan' => 'required|string|max:20',
                'hr_dob' => 'required|date',
                'reporting_manager_name' => 'required|string|max:255',
                'reporting_manager_contact' => 'required|string|max:20',
                'company_website' => 'required',
            ]);

            if ($validated->fails()) {
                return response()->json([
                    'status' => 'error123345',
                    'errors' => $validated->errors(),
                ], 422);
            }

            // Generate unique HR ID
            $companyPrefix = substr(preg_replace('/\s+/', '', $request->company_name), 0, 3);
            $firstName = explode(' ', trim($request->hr_name))[0];
            $baseHrUniqueId = strtolower($companyPrefix . '_hr_' . $firstName);
            $hrUniqueId = $baseHrUniqueId;
            $count = 1;
            while (HrModel::where('hr_unique_id', $hrUniqueId)->exists()) {
                $hrUniqueId = $baseHrUniqueId . $count;
                $count++;
            }

            // Insert into DB
            $hr = HrModel::create([
                'hr_name' => $request->hr_name,
                'hr_email' => $request->hr_email,
                'hr_phone' => $request->hr_phone,
                'hr_password' => Hash::make($request->hr_password),
                'company_name' => $request->company_name,
                'reporting_manager_mail' => $request->reporting_manager_mail,
                'hr_aadhar' => $request->hr_aadhar,
                'hr_pan' => $request->hr_pan,
                'hr_dob' => $request->hr_dob,
                'reporting_manager_name' => $request->reporting_manager_name,
                'reporting_manager_contact' => $request->reporting_manager_contact,
                'company_website' => $request->company_website,
                'hr_unique_id' => $hrUniqueId,
            ]);

            return response()->json([
                'status' => 'success',
                'hr_unique_id' => $hr->hr_unique_id,
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => $e->getMessage(),
            ], 500);
        }
    }

    public function addComplaint(Request $request)
    {
        $validatedData = $request->validate([
            'employee_eimager_id' => 'required|string|max:200',
            'name' => 'required|string|max:255',
            'description' => 'required|string|max:50',
            'raised_by' => 'required|string|max:100',
        ]);

        $user = session('user');

        // Store data in the database
        $complaint = ComplaintModel::create([
            'employee_eimager_id' => $validatedData['employee_eimager_id'],
            'name' => $validatedData['name'],
            'description' => $validatedData['description'],
            'raised_by_employee_id' => $user->id

        ]);

        return response()->json([
            'success' => true,
            'message' => 'Complaint Added!',
            'data' => $complaint
        ]);
    }


    public function allComplaint(Request $request)
    {
        $employee_eimager_id = $request->input('employee_eimager_id');

        $allComplaint = ComplaintModel::where('employee_eimager_id', $employee_eimager_id)->orderby('created_at', 'DESC')->get();

        $data = [];
        foreach ($allComplaint as $complaint) {
            $employer = HrModel::where('id', $complaint->raised_by_employee_id)->first();
            $raised_by = $employer->hr_name . ' of ' . $employer->company_name;

            $data[] = [
                'complaint_id' => $complaint->id,
                'name' => $complaint->name,
                'description' => $complaint->description,
                'raised_by' => $raised_by,
            ];
        }

        return response()->json([
            'success' => true,
            'message' => 'success',
            'data' => $data
        ]);
    }



    public function sendLastWorkingDayOtpRequest(Request $request)
    {
        if (!session()->has('user')) {
            return redirect()->route('login')->with('error', 'You need to login first');
        }

        $eimager_id = $request->input('eimagerId');

        $user = HrModel::where('hr_unique_id', $eimager_id)->first();
        $to = $user->hr_email;
        $subject = 'OTP for Updating Experience Last Working Day ';
        $otp = rand(10000, 99999);
        DB::table('hr_data')
            ->where('hr_unique_id', $eimager_id)
            ->update(array('employee_lwd_update_otp' => $otp));

        MailController::sendExperienceLastWorkingDayOtp($to, $subject, $otp);
        return response()->json([
            'success' => true,
            'message' => 'success',
            'data' => $user
        ]);
    }



    // public function lastworkingdayOtpVerification(Request $request)
    // {
    //     $otp = $request->input('otp');

    //     // Check if OTP exists in hr_data table
    //     $exists = DB::table('hr_data')->where('employee_lwd_update_otp', $otp)->exists();

    //     if ($exists || Utilities::checkAndIgnoreOtpVerification()) {
    //         return response()->json(['success' => true, 'message' => 'OTP Verified Successfully']);
    //     } else {
    //         return response()->json(['success' => false, 'message' => 'Invalid OTP']);
    //     }
    // }

    public function updateLastWorkingDay(Request $request)
    {
        if (!session()->has('user')) {
            return redirect()->route('login')->with('error', 'You need to login first');
        }

        $user = session('user');

        $experience_id = $request->input('expId');
        $lwd = $request->input('lwd');

        // $output = new ConsoleOutput();
        // $output->writeln('------------------->>>++ '. $user->id);

        $employer_id = $user->id;

        DB::table('user_experience')
            ->where('id', $experience_id)
            ->update(array('end_date' => $lwd, 'lwd_updated_by_employer_id' => $employer_id));

        return response()->json([
            'success' => true,
            'message' => 'success',
            'data' => $experience_id
        ]);
    }

    public function searchUserByEimager(Request $request)
    {
        $validatedData = $request->validate([
            'employee_eimager_id' => 'required|string',
        ]);

        $user = RegisterData::where('unique_id', $validatedData['employee_eimager_id'])->first();

        $data = [];
        if ($user) {
            $data = [
                'success' => true,
                'message' => 'User found',
                'data' => $user,
            ];
        } else {
            $data = [
                'success' => false,
                'message' => 'User not found',
            ];
        }

        return response()->json($data);
    }

    public function forgotpasswordsendOtp(Request $request)
    {
        $request->validate([
            'email' => 'required|email'
        ]);

        // Check if user exists
        $user = DB::table('hr_data')->where('hr_email', $request->email)->first();
        if (!$user) {
            return response()->json(['message' => 'Email not found.'], 404);
        }
        // Generate 6-digit OTP
        $otp = rand(100000, 999999);
        // Store OTP in custom_password_resets
        DB::table('custom_password_resets')->updateOrInsert(
            ['email' => $request->email],
            [
                'otp' => $otp,
                'token' => null,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ]
        );
        $to = $request->email;
        $subject = "Your OTP for password reset is: ";
        // Send OTP email
        // Mail::raw("Your OTP for password reset is: $otp", function ($message) use ($request) {
        //     $message->to($request->email)
        //         ->subject('Password Reset OTP');
        // });
        try {
            Mail::to($to)->send(new PasswordForgotOtp($subject, $otp));
        } catch (Exception $e) {
            Log::error('Error--->');
        }
        return response()->json(['message' => 'OTP sent successfully.']);
    }

    public function forgotpasswordverifyOtp(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'otp' => 'required|digits:6'
        ]);

        $record = CustomPasswordReset::where('email', $request->email)
            ->where('otp', $request->otp)
            ->first();

        if (!$record) {
            return response()->json(['message' => 'Invalid OTP or email.'], 400);
        }

        // Optionally: Check OTP expiration (15 min)
        if (Carbon::parse($record->created_at)->addMinutes(15)->isPast()) {
            return response()->json(['message' => 'OTP has expired. Please request a new one.'], 410);
        }
        $to = $request->email;
        $token = Str::random(64);
        $record->token = $token;
        $record->save();
        $subject = "Your password reset link: ";
        // Send email with reset link
        $resetLink = url('/reset-password/' . $token);
        // try {
        //     Mail::to($record->email)->send(new SendResetPasswordLink($resetLink));
        // } catch (\Exception $e) {
        //     return response()->json(['message' => 'Failed to send email.'], 500);
        // }
        try {
            Mail::to($to)->send(new SendResetPasswordLink($subject, $resetLink));
        } catch (Exception $e) {
            Log::error('Error--->');
        }
        return response()->json(['message' => 'OTP verified successfully. Send reset link']);
    }

    public function showResetForm($token)
    {
        $record = CustomPasswordReset::where('token', $token)->first();

        if (!$record) {
            return redirect('/')->with('error', 'Invalid or expired reset token.');
        }

        return view('hr.reset-password', ['token' => $token, 'email' => $record->email]);
    }

    public function resetPassword(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'hr_password' => 'required|min:6|confirmed',
            'token' => 'required'
        ]);

        // Find the password reset record
        $record = CustomPasswordReset::where('email', $request->email)
            ->where('token', $request->token)
            ->first();

        if (!$record) {
            return back()->with('error', 'Invalid token or email.');
        }

        // Update HR password
        \App\Models\HrModel::where('hr_email', $request->email)->update([
            'hr_password' => Hash::make($request->hr_password)
        ]);

        // Delete the token record
        $record->delete();

        return redirect()->route('hr-login-page')->with('success', 'Password reset successfully.');
    }

    public function testmailpage(): View
    {
        return view('testmail');
    }
    public function testmail(Request $request)
    {
        $validatedData = $request->validate([
            // 'hr_unique_id' => 'required|string|exists:hr_data,hr_unique_id',
            'email_to' => 'required|string',
            'mail_content' => 'required|string',
        ]);

        try {
            Log::info('mail sending started--->');
            MailController::testMail($validatedData['email_to'], 'Eimager Test Mail', $validatedData['mail_content']);
            Log::info('mail sent successfuly--->');
        } catch (\Exception $e) {
            Log::error('Error--->' . $e);
            return response()->json([
                'success' => false,
                'message' => 'Mail Sent successfully',
                'data' => $e->getMessage(),
            ]);
            return $e->getMessage();
        }

        return response()->json([
            'success' => true,
            'message' => 'Mail Sent successfully',
            'data' => $request,
        ]);
    }


    public function sendProfileDeactivateOtpRequest(Request $request)
    {
        if (!session()->has('user')) {
            return redirect()->route('login')->with('error', 'You need to login first');
        }

        $eimager_id = $request->input('eimagerId');


        $user = HrModel::where('hr_unique_id', $eimager_id)->first();

        $employee_eimager = $user->hr_unique_id;
        $to = $user->hr_email;
        $subject = 'OTP for HR Profile Deactivate';
        $otp = rand(10000, 99999);
        DB::table('hr_data')
            ->where('hr_unique_id', $employee_eimager)  // find your user by their email
            ->update(array('profile_deactivate_otp' => $otp));

        try {
            MailController::sendProfileDeactivateOtp($to, $subject, $otp);
        } catch (Exception $e) {
            Log::error('Error--->', $e);
        }

        return response()->json([
            'success' => true,
            'message' => 'success',
            'data' => $user
        ]);
    }


    // public function profiledeactivateVerification(Request $request)
    // {
    //     $otp = $request->input('otp');

    //     // Check if OTP exists in hr_data table
    //     $exists = DB::table('hr_data')->where('profile_deactivate_otp', $otp)->exists();

    //     if ($exists || Utilities::checkAndIgnoreOtpVerification()) {
    //         return response()->json(['success' => true, 'message' => 'OTP Verified Successfully']);
    //     } else {
    //         return response()->json(['success' => false, 'message' => 'Invalid OTP']);
    //     }
    // }


    public function deactivateHrProfile(Request $request)
    {
        if (!session()->has('user')) {
            return redirect()->route('login')->with('error', 'You need to login first');
        }

        $eimager_id = $request->input('eimagerId');


        DB::table('hr_data')
            ->where('hr_unique_id', $eimager_id)
            ->update(array('is_profile_deactivated' => 1));


        try {
            $user = session('user');
            MailController::sendProfileDeactivationConfirmation($user->reporting_manager_mail, $subject, ($user->hr_email + '/' + $user->hr_email));
            MailController::sendProfileDeactivationConfirmation($user->hr_email, $subject, ($user->hr_email + '/' + $user->hr_email));
        } catch (Exception $e) {
            Log::error('Error--->' . $e);
        }


        return response()->json([
            'success' => true,
            'message' => 'success',
            'data' => $eimager_id
        ]);
    }


    // profile image upload
    public function uploadProfileImageHr(Request $request)
    {
        $request->validate([
            'profile_image' => 'required|image|mimes:jpeg,png,jpg,gif|max:1500', // Max 150KB
            'hr_unique_id' => 'required|exists:hr_data,hr_unique_id' // Validate user_id (mapped to unique_id in DB)
        ]);

        // Find user by unique_id
        $user = DB::table('hr_data')->where('hr_unique_id', $request->hr_unique_id)->first();
        // dd($user);
        if (!$user) {
            return response()->json(['success' => false, 'message' => 'User not found'], 404);
        }
        // Delete old image if exists
        if ($user->profile_image && Storage::disk('public')->exists($user->profile_image)) {
            Storage::disk('public')->delete($user->profile_image);
        }
        // Store new image
        $path = $request->file('profile_image')->store('profile_images', 'public');

        // Update user profile image
        DB::table('hr_data')->where('hr_unique_id', $request->hr_unique_id)->update([
            'profile_image' => $path
        ]);

        return response()->json([
            'success' => true,
            'image_url' => asset('/storage/public/' . $path)
        ]);
    }
    // image upload
// ...existing code...

    public function verifyOtp(Request $request)
    {
        $otp = $request->input('otp');
        $hr_unique_id = session('user')->hr_unique_id ?? null;

        if (!$hr_unique_id) {
            return response()->json(['success' => false, 'message' => 'Session expired. Please login again.']);
        }

        // Check OTP for the logged-in HR only
        $exists = DB::table('hr_data')
            ->where('hr_unique_id', $hr_unique_id)
            ->where('employee_profile_otp', $otp)
            ->exists();

        if ($exists) {
            return response()->json(['success' => true, 'message' => 'OTP Verified Successfully']);
        } else {
            return response()->json(['success' => false, 'message' => 'Invalid OTP']);
        }
    }

    public function approvalRejectionOtpVerification(Request $request)
    {
        $otp = $request->input('otp');
        $hr_unique_id = session('user')->hr_unique_id ?? null;

        if (!$hr_unique_id) {
            return response()->json(['success' => false, 'message' => 'Session expired. Please login again.']);
        }

        // Check OTP for the logged-in HR only
        $exists = DB::table('hr_data')
            ->where('hr_unique_id', $hr_unique_id)
            ->where('employee_approval_rejection_otp', $otp)
            ->exists();

        if ($exists || Utilities::checkAndIgnoreOtpVerification()) {
            return response()->json(['success' => true, 'message' => 'OTP Verified Successfully']);
        } else {
            return response()->json(['success' => false, 'message' => 'Invalid OTP']);
        }
    }

    public function lastworkingdayOtpVerification(Request $request)
    {
        $otp = $request->input('otp');
        $hr_unique_id = session('user')->hr_unique_id ?? null;

        if (!$hr_unique_id) {
            return response()->json(['success' => false, 'message' => 'Session expired. Please login again.']);
        }

        // Check OTP for the logged-in HR only
        $exists = DB::table('hr_data')
            ->where('hr_unique_id', $hr_unique_id)
            ->where('employee_lwd_update_otp', $otp)
            ->exists();

        if ($exists || Utilities::checkAndIgnoreOtpVerification()) {
            return response()->json(['success' => true, 'message' => 'OTP Verified Successfully']);
        } else {
            return response()->json(['success' => false, 'message' => 'Invalid OTP']);
        }
    }

    public function profiledeactivateVerification(Request $request)
    {
        $otp = $request->input('otp');
        $hr_unique_id = session('user')->hr_unique_id ?? null;

        if (!$hr_unique_id) {
            return response()->json(['success' => false, 'message' => 'Session expired. Please login again.']);
        }

        // Check OTP for the logged-in HR only
        $exists = DB::table('hr_data')
            ->where('hr_unique_id', $hr_unique_id)
            ->where('profile_deactivate_otp', $otp)
            ->exists();

        if ($exists || Utilities::checkAndIgnoreOtpVerification()) {
            return response()->json(['success' => true, 'message' => 'OTP Verified Successfully']);
        } else {
            return response()->json(['success' => false, 'message' => 'Invalid OTP']);
        }
    }

    // ...existing code...
}






