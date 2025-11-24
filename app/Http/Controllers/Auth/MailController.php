<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Mail\SftpMail;
use App\Mail\EmployeeProfileOtp;
use App\Mail\ProfileDeactivateOtp;
use App\Mail\EmployeerRegisterOtp;
use App\Mail\ProfileDeactivationConfirmation;
use App\Mail\ExperienceApprovalOrRejectionOtp;
use App\Mail\ProfileCreatedMail;
use App\Mail\ProfileCreatedByAdminMail;
use App\Mail\ExperienceLastWorkingDayOtp;
use App\Mail\TestMail;
use Illuminate\Mail\Mailable;
use Illuminate\Support\Facades\Mail;


class MailController extends Controller
{
    public static function sendReviewRequestMail($to, $from, $subject, $user_name, $eimager_id) {
        Mail::to($to)->send(new SftpMail($subject, $user_name, $eimager_id));
    }

    public static function sendEmployeeProfileOtp($to, $subject, $otp) {
        Mail::to($to)->send(new EmployeeProfileOtp($subject, $otp));
    } 

    public static function sendExperienceApprovalRejectionOtp($to, $subject, $otp) {
        Mail::to($to)->send(new ExperienceApprovalOrRejectionOtp($subject, $otp));
    } 

    public static function sendEmployeerRegisterOtp($to, $subject, $otp) {
        Mail::to($to)->send(new EmployeerRegisterOtp($subject, $otp));
    }

    public static function sendExperienceLastWorkingDayOtp($to, $subject, $otp) {
        Mail::to($to)->send(new ExperienceLastWorkingDayOtp($subject, $otp));
    } 
    
    public static function testMail($to, $subject, $content) {
        Mail::to($to)->send(new TestMail($subject, $content));
    } 

    public static function sendProfileDeactivateOtp($to, $subject, $otp) {
        Mail::to($to)->send(new ProfileDeactivateOtp($subject, $otp));
    } 

    public static function sendProfileDeactivationConfirmation($to, $subject, $content) {
        Mail::to($to)->send(new ProfileDeactivationConfirmation($subject, $content));
    } 
    
    public static function sendProfileCreatedMail($to, $subject, $content) {
        Mail::to($to)->send(new ProfileCreatedMail($subject, $content));
    } 
    
    public static function sendProfileCreatedByAdminMail($to, $subject, $content) {
        Mail::to($to)->send(new ProfileCreatedByAdminMail($subject, $content));
    }
}

