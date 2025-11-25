<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Auth\MailController;
use Illuminate\Http\Request;
use Exception;
use Carbon\Carbon;
use App\Models\RegisterData;
use App\Models\ExperienceModel;
use App\Models\QualificationModel;
use App\Models\CustomPasswordReset;
use App\Models\ExperienceApprovalModel;
use App\Models\ProfileUpdateRequest;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\DB;
use Illuminate\Mail\Mailable;
use App\Mail\PasswordForgotOtpUser;
use App\Mail\UserRegistration;
use App\Mail\SendResetPasswordLinkUser;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;
// use Session;
use App\Models\User;
// use Hash;
use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;
use Symfony\Component\Console\Output\ConsoleOutput;

class AuthController extends Controller
{
    /**
     * Write code on Method
     *
     * @return response()
     */
    public function index(): View
    {
        return view('auth.login');
    }

    /**
     * Write code on Method
     *
     * @return response()
     */
    public function registration(): View
    {
        return view('auth.registration');
    }
    public function testmethod(): View
    {
        return view('auth.login');
    }

    // image upload
    public function uploadProfileImage(Request $request)
    {
        $request->validate([
            'profile_image' => 'required|image|mimes:jpeg,png,jpg,gif|max:1500', // Max 150KB
            'unique_id' => 'required|exists:register_data,unique_id' // Validate user_id (mapped to unique_id in DB)
        ]);

        // Find user by unique_id
        $user = DB::table('register_data')->where('unique_id', $request->unique_id)->first();
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
        DB::table('register_data')->where('unique_id', $request->unique_id)->update([
            'profile_image' => $path
        ]);

        return response()->json([
            'success' => true,
            'image_url' => asset('/storage/public/' . $path)
        ]);
    }
    // image upload

    public function socialstore(Request $request)
    {
        $request->validate([
            'unique_id' => 'required|exists:register_data,unique_id',
            'facebook' => 'nullable|url',
            'linkedin' => 'nullable|url',
            'twitter' => 'nullable|url',
        ]);

        // Update social media links in database
        $update = DB::table('register_data')
            ->where('unique_id', $request->unique_id)
            ->update([
                'facebook' => $request->facebook,
                'linkedin' => $request->linkedin,
                'twitter' => $request->twitter,
                'updated_at' => now(),
            ]);

        if ($update) {
            return response()->json(['success' => true, 'message' => 'Links saved successfully!']);
        } else {
            return response()->json(['success' => false, 'message' => 'No changes detected!']);
        }
    }
    // public function store(Request $request)
    // {
    //     $validatedData = $request->validate([
    //         'first_name' => 'required|string|max:255|regex:/^[a-zA-Z\s]+$/',
    //         'email' => 'required|email|unique:register_data,email',
    //         'phone_number' => 'required|string|digits:10|regex:/^[6-9][0-9]{9}$/',
    //         'password' => 'required|string|min:8|max:20',
    //         'password_confirmation' => 'required|string|same:password',
    //         // 'first_name' => 'required|string|max:255',
    //         // 'email' => 'required|email|unique:register_data,email',
    //         // 'phone_number' => 'required|string|max:20',
    //         // 'password' => 'required|string|min:6',
    //         // 'aadhar_number' => 'required|string|max:12',
    //         // 'pan_number' => 'required|string|max:10',
    //         // 'dob' => 'required|string|max:10',
    //         // 'unique_id' => 'required|string|unique:register_data,unique_id',
    //     ]);

    //     // Store data in the database
    //     $registerData = RegisterData::create([
    //         'first_name' => $validatedData['first_name'],
    //         // 'last_name' => $validatedData['last_name'],
    //         'email' => $validatedData['email'],
    //         'phone_number' => $validatedData['phone_number'],
    //         'password' => Hash::make($validatedData['password']), // Hashing password
    //         // 'aadhar_number' => $validatedData['aadhar_number'],
    //         // 'pan_number' => $validatedData['pan_number'],
    //         // 'dob' => $validatedData['dob'],
    //         // 'unique_id' => $validatedData['unique_id'],
    //     ]);

    //     try {
    //         // $to = $validatedData['email'];
    //         // $unique_id = $validatedData['unique_id'];
    //         // $subject = "Employer Registration";


    //         //  Mail::to($to)->send(new UserRegistration($subject, $unique_id));
    //     } catch (Exception $e) {
    //         Log::error('Error--->', $e);
    //     }
    //     $user = $registerData;
    //     session(['user' => $user]);
    //     return response()->json([
    //         'success' => true,
    //         'message' => 'Registration First Step Successful!',
    //         'data' => $registerData,
    //         'redirect' => url('userprofile')
    //     ]);
    // }

    public function store(Request $request)
{
    // 🔴 1) Clean up any INCOMPLETE registration with same email or phone
    $email = $request->input('email');
    $phone = $request->input('phone_number');

    if ($email || $phone) {
        RegisterData::where(function ($q) use ($email, $phone) {
                // Match by email and/or phone_number
                if ($email) {
                    $q->where('email', $email);
                }
                if ($phone) {
                    // if both email & phone provided → match either
                    if ($email) {
                        $q->orWhere('phone_number', $phone);
                    } else {
                        $q->where('phone_number', $phone);
                    }
                }
            })
            // Only delete INCOMPLETE records (no unique_id created yet)
            ->where(function ($q) {
                $q->whereNull('unique_id')
                  ->orWhere('unique_id', '');
            })
            ->delete();
    }
    // 🔴 1) END

    // 🔵 2) Your existing validation (UNCHANGED)
    $validatedData = $request->validate([
        'first_name' => 'required|string|max:255|regex:/^[a-zA-Z\s]+$/',
        'email' => 'required|email|unique:register_data,email',
        'phone_number' => 'required|string|digits:10|regex:/^[6-9][0-9]{9}$/',
        'password' => 'required|string|min:8|max:20',
        'password_confirmation' => 'required|string|same:password',
        // 'first_name' => 'required|string|max:255',
        // 'email' => 'required|email|unique:register_data,email',
        // 'phone_number' => 'required|string|max:20',
        // 'password' => 'required|string|min:6',
        // 'aadhar_number' => 'required|string|max:12',
        // 'pan_number' => 'required|string|max:10',
        // 'dob' => 'required|string|max:10',
        // 'unique_id' => 'required|string|unique:register_data,unique_id',
    ]);

    // 🔵 3) Your existing creation logic (UNCHANGED)
    $registerData = RegisterData::create([
        'first_name'   => $validatedData['first_name'],
        'email'        => $validatedData['email'],
        'phone_number' => $validatedData['phone_number'],
        'password'     => Hash::make($validatedData['password']),
    ]);

    try {
        // $to = $validatedData['email'];
        // $unique_id = $validatedData['unique_id'];
        // $subject = "Employer Registration";
        // Mail::to($to)->send(new UserRegistration($subject, $unique_id));
    } catch (Exception $e) {
        Log::error('Error--->', [$e->getMessage()]);
    }

    $user = $registerData;
    session(['user' => $user]);

    return response()->json([
        'success'  => true,
        'message'  => 'Registration First Step Successful!',
        'data'     => $registerData,
        'redirect' => url('userprofile'),
    ]);
}


    public function storeStep2(Request $request)
    {
        $validatedData = $request->validate([
            'first_name' => 'required|string|max:255|regex:/^[a-zA-Z\s]+$/',
            'email' => 'required|email|exists:register_data,email',
            'aadhar_number' => 'required|string|digits:12|unique:register_data,aadhar_number|regex:/^[0-9]{12}$/',
            'pan_number' => 'required',
            'dob' => 'required|date|before:today|after:1900-01-01',
            ], [
            'first_name.required' => 'First name is required.',
            'first_name.regex' => 'First name should contain only letters and spaces.',
            'email.required' => 'Email is required.',
            'email.exists' => 'Email not found in our records.',
            'aadhar_number.required' => 'Aadhar number is required.',
            'aadhar_number.digits' => 'Aadhar number must be exactly 12 digits.',
            'aadhar_number.unique' => 'This Aadhar number is already registered.',
            'aadhar_number.regex' => 'Aadhar number should contain only 12 digits.',
            'pan_number.required' => 'PAN number is required.',
            'pan_number.size' => 'PAN number must be exactly 10 characters.',
            'pan_number.unique' => 'This PAN number is already registered.',
            'pan_number.regex' => 'PAN number format is invalid. Format: AAAAA9999A',
            'dob.required' => 'Date of birth is required.',
            'dob.date' => 'Please enter a valid date.',
            'dob.before' => 'Date of birth must be before today.',
            'dob.after' => 'Date of birth must be after 1900.',
            // 'first_name' => 'required',
            // 'email' => 'required|email|exists:register_data,email',
            // 'aadhar_number' => 'required|string|max:12|unique:register_data,aadhar_number',
            // 'pan_number' => 'required|string|max:10|unique:register_data,aadhar_number',
            // 'dob' => 'required|date',

        ]);
        $firstName = $validatedData['first_name'];
        $panNumber = $validatedData['pan_number'];
        $aadharNumber = $validatedData['aadhar_number'];
        $dob = $validatedData['dob'];

        // Get initials from first name
        $firstInitial = strtoupper(substr($firstName, 0, 1));
        $secondInitial = '';
        if (str_contains($firstName, ' ')) {
            $parts = explode(' ', $firstName);
            $secondInitial = strtoupper(substr($parts[1], 0, 1));
        }

        // Build the unique ID
        $uniqueID = 'EI' .
            $firstInitial .
            $secondInitial . '-' .
            strtoupper(substr($panNumber, 0, 4)) . '-' .
            substr($aadharNumber, -4) . '-' .
            strtoupper(substr($dob, 0, 4)); // assumes YYYY-MM-DD format

        // Add it to the validated data
        $validatedData['unique_id'] = $uniqueID;
        // Find the HR record by email
        $hrData = RegisterData::where('email', $validatedData['email'])->first();

        if ($hrData) {
            // Update existing HR record
            $hrData->update([
                'aadhar_number' => $validatedData['aadhar_number'],
                'pan_number' => $validatedData['pan_number'],
                'dob' => $validatedData['dob'],
                'unique_id' => $validatedData['unique_id'],
            ]);
            $to = $validatedData['email'];
            $unique_id = $validatedData['unique_id'];
            $subject = "Employer Registration";
            Mail::to($to)->send(new UserRegistration($subject, $unique_id));
            session(['user' => $hrData]);
            return response()->json([
                'success' => true,
                'message' => 'Register step2 successfully!',
                'data' => $hrData,
                'redirect' => url('userprofile')
            ]);
        }
        return response()->json([
            'success' => false,
            'message' => 'User email not found!',
        ], 404);
    }

    public function checkPartialEmployeeRegistration(Request $request)
{
    $validatedData = $request->validate([
        'email'        => 'nullable|email',
        'phone_number' => 'nullable|string|digits:10',
    ]);

    if (!$request->filled('email') && !$request->filled('phone_number')) {
        return response()->json([
            'success' => false,
            'message' => 'Please provide email or phone_number.',
            'data'    => false,
        ], 422);
    }

    $query = RegisterData::query();

    // Match by email or phone
    $query->where(function ($q) use ($request) {
        if ($request->filled('email')) {
            $q->orWhere('email', $request->input('email'));
        }
        if ($request->filled('phone_number')) {
            $q->orWhere('phone_number', $request->input('phone_number'));
        }
    });

    $employee = $query->first();

    $is_partially_created = false;

    if ($employee) {
        // "Incomplete" means unique_id not assigned yet
        if (empty($employee->unique_id)) {
            $is_partially_created = true;
        }
    }

    return response()->json([
        'success' => true,
        'message' => 'Employee creation status',
        'data'    => $is_partially_created,
    ]);
}

public function deletePartiallyCreatedEmployeeAccount(Request $request)
{
    $validatedData = $request->validate([
        'email'        => 'nullable|email',
        'phone_number' => 'nullable|string|digits:10',
    ]);

    if (!$request->filled('email') && !$request->filled('phone_number')) {
        return response()->json([
            'success' => false,
            'message' => 'Please provide email or phone_number.',
        ], 422);
    }

    $query = RegisterData::query();

    $query->where(function ($q) use ($request) {
        if ($request->filled('email')) {
            $q->orWhere('email', $request->input('email'));
        }
        if ($request->filled('phone_number')) {
            $q->orWhere('phone_number', $request->input('phone_number'));
        }
    });

    // Only delete INCOMPLETE accounts (no unique_id yet)
    $query->where(function ($q) {
        $q->whereNull('unique_id')
          ->orWhere('unique_id', '');
    });

    $deletedCount = $query->delete();

    return response()->json([
        'success' => true,
        'message' => 'Partially created employee account(s) deleted.',
        'deleted' => $deletedCount,
    ]);
}

    // public function login(Request $request)
    // {
    //     try {
    //         $validatedData = $request->validate([

    //             'unique_id' => 'required|string',
    //             'password' => 'required|string|min:6',
    //         ]);
    //         $user = null;
    //         $user = RegisterData::where('unique_id', $validatedData['unique_id'])->orWhere('email', $validatedData['unique_id'])->first();
    //     } catch (\Exception $e) {
    //         Log::info($e);
    //         return $e->getMessage();
    //     }
    //     if (!$user || !Hash::check($validatedData['password'], $user->password)) {
    //         return response()->json([
    //             'success' => false,
    //             'message' => 'Invalid unique ID or password!'
    //         ], 401);
    //     }
    //     session(['user' => $user]);
    //     return response()->json([
    //         'success' => true,
    //         'message' => 'Login successful!',
    //         'data' => $user,
    //         'redirect' => url('userprofile')
    //     ]);
    // }
    public function login(Request $request)
    {
        try {
            $validatedData = $request->validate([
                'unique_id' => 'required|string',
                'password' => 'required|string|min:6',
            ]);

            // Attempt to find user by unique_id or email
            $user = RegisterData::where(function ($query) use ($validatedData) {
                $query->where('unique_id', $validatedData['unique_id'])
                    ->orWhere('email', $validatedData['unique_id']);
            })->first();

            // If user not found or doesn't have unique_id, deny access
            if (!$user || !$user->unique_id || !Hash::check($validatedData['password'], $user->password)) {
                return response()->json([
                    'success' => false,
                    'message' => 'Invalid EImager ID, email, or password!'
                ], 401);
            }

            // Set session
            session(['user' => $user]);

            return response()->json([
                'success' => true,
                'message' => 'Login successful!',
                'data' => $user,
                'redirect' => url('userprofile')
            ]);
        } catch (\Exception $e) {
            Log::info($e);
            return response()->json([
                'success' => false,
                'message' => 'Something went wrong.',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    public function logout(Request $request)
    {
        // Clear session data
        Session::forget('user');
        Session::flush();

        return response()->json([
            'success' => true,
            'message' => 'Logged out successfully!',
            'redirect' => url('/')
        ]);
    }
    public function addexperience(Request $request)
    {
        $validatedData = $request->validate([
            'eimager_id' => 'required|string|max:200',
            'company_name' => 'required|string|max:255',
            'designation' => 'required|string|max:50',
            'projects' => 'required|string|max:100',
            'start_date' => 'required|string|min:10',
            'end_date' => 'nullable|string',
            'is_still_working' => 'required|string',
            'ctc' => 'required|numeric',
            'in_hand' => 'required|numeric',
            'roles_responsibility' => 'required|string|max:200',
        ]);


        // Store data in the database
        $experience = ExperienceModel::create([
            'eimager_id' => $validatedData['eimager_id'],
            'company_name' => $validatedData['company_name'],
            'designation' => $validatedData['designation'],
            'projects' => $validatedData['projects'],
            'start_date' => $validatedData['start_date'],
            'end_date' => $validatedData['end_date'],
            'is_still_working' => $validatedData['is_still_working'],
            'ctc' => $validatedData['ctc'],
            'in_hand' => $validatedData['in_hand'],
            'roles_responsibility' => $validatedData['roles_responsibility'],
        ]);



        return response()->json([
            'success' => true,
            'message' => 'Experience Added!',
            'data' => $experience
        ]);
    }

    public function addQualification(Request $request)
    {
        $validatedData = $request->validate([
            'eimager_id' => 'required|string|max:200',
            'school' => 'required|string|max:255',
            'degree' => 'required|string|max:50',
            'study' => 'required|string|max:100',
            'start_date' => 'required|string|min:10',
            'end_date' => 'required|string|min:10',
            'grade' => 'required|string',
            'description' => 'required|string|max:255',
        ]);

        // Store data in the database
        $qualification = QualificationModel::create([
            'eimager_id' => $validatedData['eimager_id'],
            'school' => $validatedData['school'],
            'degree' => $validatedData['degree'],
            'study' => $validatedData['study'],
            'start_date' => $validatedData['start_date'],
            'end_date' => $validatedData['end_date'],
            'grade' => $validatedData['grade'],
            'description' => $validatedData['description'],
        ]);

        return response()->json([
            'success' => true,
            'message' => 'Qualification Added!',
            'data' => $qualification
        ]);
    }

    // public function login(Request $request)
    // {

    //     $validatedData = $request->validate([
    //         'unique_id' => 'required|string|exists:register_data,unique_id',
    //         'password' => 'required|string|min:6',
    //     ]);


    //     $user = RegisterData::where('unique_id', $validatedData['unique_id'])->first();


    //     if (!$user || !Hash::check($validatedData['password'], $user->password)) {
    //         return response()->json([
    //             'success' => false,
    //             'message' => 'Invalid unique ID or password!'
    //         ], 401);
    //     }


    //     Auth::login($user);


    //     session(['user' => $user]);

    //     return response()->json([
    //         'success' => true,
    //         'message' => 'Login successful!',
    //         'redirect' => url('/dashboard')
    //     ]);
    // }

    public function dashboard()
    {
        // Check if user is logged in via session
        if (!session()->has('user')) {
            return redirect()->route('login-page')->with('error', 'Please login first.');
        }

        // Get logged-in user from session
        $user = session('user');


        // Log::info(print_r($user, true));

        $eimagerId = $user['unique_id'];

        $totExp = DB::select('select count(*) total_experience_count from user_experience where eimager_id = ?', [$eimagerId]);
        $experience_count = $totExp[0]->total_experience_count;

        $totRequest = DB::select('select count(*) request_count from user_experience_approval where experience_id in (select id from user_experience where eimager_id=?)', [$eimagerId]);
        $request_count = $totRequest[0]->request_count;

        $pending = DB::select('select count(*) pending_count from user_experience_approval where experience_id in (select id from user_experience where eimager_id=?) and lower(approval_status)=lower(?)', [$eimagerId, 'pending']);
        $pending_count = $pending[0]->pending_count;

        $all_approval_request = DB::select('select * from user_experience as ue inner join user_experience_approval as uea on uea.experience_id=ue.id where ue.eimager_id=?', [$eimagerId]);


        $approval_request = [];
        foreach ($all_approval_request as $req) {
            $approval_request[] = [
                'exp_id'             => $req->id,
                'company_name'             => $req->company_name,
                'designation'            => $req->designation,
                'projects' => $req->projects,
                'start_date'       => $req->start_date,
                'end_date'       => $req->end_date,
                'roles_responsibility'       => $req->roles_responsibility,
                'approver_email'       => $req->approver_email,
                'approval_status'       => $req->approval_status,
            ];
        }

        // Log::info($approval_request);


        session(['experience_count' => $experience_count]);
        session(['request_count' => $request_count]);
        session(['pending_count' => $pending_count]);
        session(['approval_request' => $approval_request]);
        // if (session()->has('experience_count')) {
        //     Log::info('session has experience_count');
        // } else {
        //     Log::info('No................');

        // }
        // Log::info([($user['unique_id']) , '-------------',  $experience_count, $request_count, $pending_count]);

        return view('auth.dashboard', compact('user', 'experience_count', 'request_count', 'pending_count', 'approval_request'));
    }

    // public function experience()
    // {
    //     // Check if user is logged in via session
    //     if (!session()->has('user')) {
    //         return redirect()->route('login-page')->with('error', 'Please login first.');
    //     }

    //     // Get logged-in user from session
    //     $user = session('user');

    //     return view('auth.experience', compact('user'));
    // }



    public function userprofile()
    {
        // Check if user is logged in via session
        if (!session()->has('user')) {
            return redirect()->route('login-page')->with('error', 'Please login first.');
        }

        // Get logged-in user from session
        $user = session('user');

        return view('auth.userprofile', compact('user'));
    }

    public function allexperience(Request $request)
    {
        $output = new ConsoleOutput();
        $eimager_id = $request->input('eimagerId');

        // $allExperience = ExperienceModel::where('eimager_id', $eimager_id)->orderby('created_at','DESC')->get();

        $allExperience = DB::select('SELECT ue.*, (select approval_status from user_experience_approval where experience_id=ue.id ORDER by created_at desc LIMIT 1) as approval_status, (select status_note from user_experience_approval where experience_id=ue.id ORDER by created_at desc LIMIT 1) as status_note FROM user_experience as ue WHERE eimager_id= ?', [$eimager_id]);

        $data = [];
        foreach ($allExperience as $exp) {
            $data[] = [
                'exp_id'             => $exp->id,
                'company_name'             => $exp->company_name,
                'designation'            => $exp->designation,
                'projects' => $exp->projects,
                'start_date'       => $exp->start_date,
                'end_date'       => ($exp->end_date == null ? 'Still Working' : $exp->end_date),
                'ctc'       => $exp->ctc,
                'in_hand'       => $exp->in_hand,
                'roles_responsibility'       => $exp->roles_responsibility,
                'approval_status'       => $exp->approval_status,
                'status_note'       => $exp->status_note,
            ];
        }

        return response()->json([
            'success' => true,
            'message' => 'success',
            'data' => $data
        ]);
    }


    public function allQualification(Request $request)
    {
        // $output = new ConsoleOutput();
        $eimager_id = $request->input('eimagerId');

        $allQualification = QualificationModel::where('eimager_id', $eimager_id)->orderby('created_at', 'DESC')->get();

        // $allExperience = DB::select('SELECT ue.*, (select approval_status from user_experience_approval where experience_id=ue.id ORDER by created_at desc LIMIT 1) as approval_status, (select status_note from user_experience_approval where experience_id=ue.id ORDER by created_at desc LIMIT 1) as status_note FROM user_experience as ue WHERE eimager_id= ?', [$eimager_id]);

        $data = [];
        foreach ($allQualification as $qualification) {
            $data[] = [
                'qualification_id'             => $qualification->id,
                'school'             => $qualification->school,
                'degree'            => $qualification->degree,
                'study' => $qualification->study,
                'start_date'       => $qualification->start_date,
                'end_date'       => $qualification->end_date,
                'grade'       => $qualification->grade,
                'description'       => $qualification->description,
            ];
        }

        return response()->json([
            'success' => true,
            'message' => 'success',
            'data' => $data
        ]);
    }


    public function fetchUserProfile(Request $request)
    {
        if (!session()->has('user')) {
            return redirect()->route('login')->with('error', 'You need to login first');
        }

        $eimager_id = $request->input('eimagerId');

        $user = RegisterData::where('unique_id', $eimager_id)->first();

        $user->aadhar_number = str_repeat('*', strlen($user->aadhar_number) - 4) . substr($user->aadhar_number, -4);
        $user->pan_number = substr($user->pan_number,0,  5) . str_repeat('*', strlen($user->pan_number) - 5);
        $user->phone_number = substr($user->phone_number, 0, 3) . str_repeat('*', (strlen($user->phone_number) - 3)) . substr($user->phone_number, -2);
        $user->email = Str::mask($user->email, '*', 2, 7);

        $user->profile_image = '/storage/public/' . $user->profile_image;



        return response()->json([
            'success' => true,
            'message' => 'success',
            'data' => $user
        ]);
    }

    public function addApprovalRequest(Request $request)
    {
        $validatedData = $request->validate([
            'experience_id' => 'required|int|max:200',
            'approver_email' => 'required|string|max:1000',
            'approver_name' => 'string|max:1000',
            'approver_number' => 'string|max:1000'
        ]);

        // Store data in the database
        $experience = ExperienceApprovalModel::create([
            'experience_id' => $validatedData['experience_id'],
            'approver_email' => $validatedData['approver_email'],
            'approver_name' => $validatedData['approver_name'],
            'approver_number' => $validatedData['approver_number'],
        ]);

        $experience_id = $validatedData['experience_id'];
        $approver_email = $validatedData['approver_email'];
        // $approver_name = $validatedData['approver_name'];
        // $approver_number = $validatedData['approver_number'];


        $user_details = DB::select('select first_name, email, unique_id from register_data where unique_id=(select eimager_id from user_experience where id = ?)', [$experience_id]);
        $user_name = $user_details[0]->first_name;
        $eimager_id = $user_details[0]->unique_id;

        $to = $approver_email;
        $from = 'eimager@gmail.com';
        $subject = 'Experience Approval Request for EImager';

        MailController::sendReviewRequestMail($to, $from, $subject, $user_name, $eimager_id);

        return response()->json([
            'success' => true,
            'message' => 'Approval Request has been sent.',
            'data' => $experience
        ]);
    }

    public function deleteExperience(Request $request)
    {
        Log::info($request->experience_id);
        // $request->experience_id

        DB::table('user_experience')->where('id', $request->experience_id)->delete();

        return response()->json([
            'success' => true,
            'message' => 'Experience details deleted!',
            'data' => $request
        ]);
    }


    public function addProfileUpdateRequest(Request $request)
    {
        $validatedData = $request->validate([
            'eimager_id' => 'required|string|max:200',
            // 'new_name' => 'required|string|max:255',
            // 'new_aadhar' => 'required|string|max:12',
            // 'new_pan' => 'required|string|max:10',
        ]);
        
        $user = RegisterData::where('unique_id',  $validatedData['eimager_id'])->first();

        // Store data in the database
        $update_request = ProfileUpdateRequest::create([
            'eimager_id' => $validatedData['eimager_id'],
            'existing_name' => $user->first_name,
            'new_name' => $request->new_name,
            'existing_aadhar' => $user->aadhar_number,
            'new_aadhar' => $request->new_aadhar,
            'existing_pan' => $user->pan_number,
            'new_pan' =>  $request->new_pan,
        ]);

        return response()->json([
            'success' => true,
            'message' => 'Profile Update Request Added!',
            'data' => $update_request
        ]);
    }

    public function uploadProfileRequestEvidenceImage(Request $request)
    {
        $request->validate([
            'evidence_image' => 'required|image|mimes:jpeg,png,jpg,gif|max:1500', // Max 150KB
            'id' => 'required' // Validate user_id (mapped to unique_id in DB)
        ]);

        // Find user by unique_id
        $update_request = DB::table('user_profile_update_request')->where('id', $request->id)->first();
        // dd($user);
        if (!$update_request) {
            return response()->json(['success' => false, 'message' => 'Update Request not found'], 404);
        }


         // Get the uploaded file
        //$file = $request->file('evidence_image');

        // Generate a unique filename
        //$filename = time() . '_' . $file->getClientOriginalName();

        // Define the destination path in the public folder
        //$destinationPath = public_path('evidence_images');

         // Move the file to the public/evidence_images directory
        //$file->move($destinationPath, $filename);

        // Save the path if needed
        //$filePath = 'evidence_images/' . $filename;

        // Store new image
        $path = $request->file('evidence_image')->store('evidence_images', 'public');

        // Update user profile image
        DB::table('user_profile_update_request')->where('id', $request->id)->update([
            'evidence_image' => $path
        ]);

        return response()->json([
            'success' => true,
            'image_url' => asset('/storage/public/' . $path)
        ]);
    }


    /**
     * Write code on Method
     *
     * @return response()
     */
    // public function postLogin(Request $request): RedirectResponse
    // {
    //     $request->validate([
    //         'email' => 'required',
    //         'password' => 'required',
    //     ]);

    //     $credentials = $request->only('email', 'password');
    //     if (Auth::attempt($credentials)) {
    //         return redirect()->intended('dashboard')
    //                     ->withSuccess('You have Successfully loggedin');
    //     }

    //     return redirect("login")->withError('Oppes! You have entered invalid credentials');
    // }

    /**
     * Write code on Method
     *
     * @return response()
     */
    // public function postRegistration(Request $request): RedirectResponse
    // {  
    //     $request->validate([
    //         'name' => 'required',
    //         'email' => 'required|email|unique:users',
    //         'password' => 'required|min:6',
    //     ]);

    //     $data = $request->all();
    //     $user = $this->create($data);

    //     Auth::login($user); 

    //     return redirect("dashboard")->withSuccess('Great! You have Successfully loggedin');
    // }

    /**
     * Write code on Method
     *
     * @return response()
     */
    // public function dashboard()
    // {
    //     if(Auth::check()){
    //         return view('dashboard');
    //     }

    //     return redirect("login")->withSuccess('Opps! You do not have access');
    // }

    /**
     * Write code on Method
     *
     * @return response()
     */
    // public function create(array $data)
    // {
    //   return User::create([
    //     'name' => $data['name'],
    //     'email' => $data['email'],
    //     'password' => Hash::make($data['password'])
    //   ]);
    // }

    /**
     * Write code on Method
     *
     * @return response()
     */
    // public function logout(): RedirectResponse
    // {
    //     Session::flush();
    //     Auth::logout();

    //     return Redirect('login');
    // }




    public function showProfile()
    {
        if (!session()->has('user')) {
            return redirect()->route('login')->with('error', 'You need to login first');
        }
        $uniqueid = session('user')->unique_id;
        $user = RegisterData::where('unique_id', $uniqueid)->first();

        if (!$user) {
            return redirect()->route('dashboard')->with('error', 'User profile not found');
        }

        $user->aadhar_number = str_repeat('*', strlen($user->aadhar_number) - 4) . substr($user->aadhar_number, -4);
        //$user->pan_number = substr($user->pan_number, 5) . str_repeat('*', strlen($user->pan_number) - 5);
        $user->pan_number = str_repeat("*", strlen(($user->pan_number) - 5)) . substr($user->pan_number, -5);
        $user->phone_number = substr($user->phone_number, 0, 3) . str_repeat('*', (strlen($user->phone_number) - 3)) . substr($user->phone_number, -2);
        $user->email = Str::mask($user->email, '*', 2, 7);

        return view('auth.profile', compact('user'));
    }

    public function showUserProfile()
    {
        if (!session()->has('user')) {
            return redirect()->route('login')->with('error', 'You need to login first');
        }
        $uniqueid = session('user')->unique_id;
        $user = RegisterData::where('unique_id', $uniqueid)->first();

        if (!$user) {
            return redirect()->route('dashboard')->with('error', 'User profile not found');
        }

        $user->aadhar_number = str_repeat('*', strlen($user->aadhar_number) - 4) . substr($user->aadhar_number, -4);
        $user->pan_number = substr($user->pan_number, 5) . str_repeat('*', strlen($user->pan_number) - 5);
        $user->phone_number = substr($user->phone_number, 0, 3) . str_repeat('*', (strlen($user->phone_number) - 3)) . substr($user->phone_number, -2);
        $user->email = Str::mask($user->email, '*', 2, 7);

        return view('auth.userprofile', compact('user'));
    }

    public function approval()
    {
        // Check if user is logged in via session
        if (!session()->has('user')) {
            return redirect()->route('login-page')->with('error', 'Please login first.');
        }


        // Get logged-in user from session
        $user = session('user');


        // Log::info(print_r($user, true));

        $eimagerId = $user['unique_id'];

        $totExp = DB::select('select count(*) total_experience_count from user_experience where eimager_id = ?', [$eimagerId]);
        $experience_count = $totExp[0]->total_experience_count;

        $totRequest = DB::select('select count(*) request_count from user_experience_approval where experience_id in (select id from user_experience where eimager_id=?)', [$eimagerId]);
        $request_count = $totRequest[0]->request_count;

        $pending = DB::select('select count(*) pending_count from user_experience_approval where experience_id in (select id from user_experience where eimager_id=?) and lower(approval_status)=lower(?)', [$eimagerId, 'pending']);
        $pending_count = $pending[0]->pending_count;

        $all_approval_request = DB::select('select * from user_experience as ue inner join user_experience_approval as uea on uea.experience_id=ue.id where ue.eimager_id=?', [$eimagerId]);


        $approval_request = [];
        foreach ($all_approval_request as $req) {
            $approval_request[] = [
                'exp_id'             => $req->id,
                'company_name'             => $req->company_name,
                'designation'            => $req->designation,
                'projects' => $req->projects,
                'start_date'       => $req->start_date,
                'end_date'       => $req->end_date,
                'roles_responsibility'       => $req->roles_responsibility,
                'approver_email'       => $req->approver_email,
                'approval_status'       => $req->approval_status,
            ];
        }

        // Log::info($approval_request);


        session(['experience_count' => $experience_count]);
        session(['request_count' => $request_count]);
        session(['pending_count' => $pending_count]);
        session(['approval_request' => $approval_request]);
        // if (session()->has('experience_count')) {
        //     Log::info('session has experience_count');
        // } else {
        //     Log::info('No................');

        // }
        // Log::info([($user['unique_id']) , '-------------',  $experience_count, $request_count, $pending_count]);

        // return view('auth.approval', compact('user'));
        return view('auth.approval', compact('user', 'experience_count', 'request_count', 'pending_count', 'approval_request'));
    }

    // forgot password
    public function forgotpasswordsendOtp(Request $request)
    {
        $request->validate([
            'email' => 'required|email'
        ]);

        // Check if user exists
        $user = DB::table('register_data')->where('email', $request->email)->first();
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

        try {
            Mail::to($to)->send(new PasswordForgotOtpUser($subject, $otp));
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
            Mail::to($to)->send(new SendResetPasswordLinkUser($subject, $resetLink));
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

        return view('auth.reset-password-user', ['token' => $token, 'email' => $record->email]);
    }

    public function resetPassword(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required|min:6|confirmed',
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
        \App\Models\RegisterData::where('email', $request->email)->update([
            'password' => Hash::make($request->password)
        ]);

        // Delete the token record
        $record->delete();

        return redirect()->route('hr-login-page')->with('success', 'Password reset successfully.');
    }
    // forgot password
}
