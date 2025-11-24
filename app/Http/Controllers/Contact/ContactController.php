<?php
namespace App\Http\Controllers\Contact;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Contact;
use App\Models\Career;
class ContactController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'ca_name' => ['required', 'string', 'max:255', 'regex:/^[a-zA-Z\s]+$/'],
            'ca_email' => ['required', 'email:rfc,dns', 'max:255'],
            'ca_number' => ['required', 'regex:/^\d{10}$/'],
            'ca_address' => 'required|string',
            'ca_type' => 'required|in:General,Support,Business',
            'ca_message' => 'required|string'
        ]);
        
        

        Contact::create([
            'ca_name' => $request->ca_name,
            'ca_email' => $request->ca_email,
            'ca_number' => $request->ca_number,
            'ca_address' => $request->ca_address,
            'ca_type' => $request->ca_type,
            'ca_message' => $request->ca_message
        ]);

        return response()->json(['success' => 'Message sent successfully!']);
    } 

    public function careerstore(Request $request)
    {
        $request->validate([
            // Name: required, letters only
            'career_name' => ['required', 'string', 'max:255', 'regex:/^[a-zA-Z\s]+$/'],
            
            // Email: required and must be valid
            'career_email' => ['required', 'email', 'max:255'],
            
             // Contact Number: required, must be exactly 10 digits
            'career_contact_number' => ['required', 'regex:/^\d{10}$/'],
            
            // Current Designation: required, letters and spaces only
            'career_current_designation' => ['required', 'string', 'max:255', 'regex:/^[a-zA-Z\s]+$/'],
            
            // Applied Post: required, letters and spaces only
            'career_applied_post' => ['required', 'string', 'max:255', 'regex:/^[a-zA-Z\s]+$/'],
            
            // Total Experience: required, digits only (non-negative)
            'career_total_experience' => ['required', 'regex:/^\d+$/'],
            
            // Current CTC: required, numeric, non-negative
            'career_current_ctc' => ['required', 'numeric', 'min:0'],
            
            // Expected CTC: required, numeric, non-negative
            'career_expected_ctc' => ['required', 'numeric', 'min:0'],
            
            // Notice Period: required, digits only (non-negative)
            'career_notice_period' => ['required', 'regex:/^\d+$/'],
        ]);

        Career::create([
            'career_name' => $request->career_name,
            'career_email' => $request->career_email,
            'career_contact_number' => $request->career_contact_number,
            'career_current_designation' => $request->career_current_designation,
            'career_applied_post' => $request->career_applied_post,
            'career_total_experience' => $request->career_total_experience,
            'career_current_ctc' => $request->career_current_ctc,
            'career_expected_ctc' => $request->career_expected_ctc,
            'career_notice_period' => $request->career_notice_period,
        ]);

        return response()->json(['success' => 'Application submitted successfully!']);
    }
}

