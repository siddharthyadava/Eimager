<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Eimager</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Ubuntu:wght@400;500;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">
    <link href="css/custom.css" rel="stylesheet">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <!-- <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.min.js"></script> -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz"
        crossorigin="anonymous"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
</head>

<body>

    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="nav-wrapper">
                    <div class="site-logo">
                        <img src="{{url('/images/logo.jpg')}}" alt="BootstrapBrain Logo" width="250">
                    </div>
                    <div class="login-btn">
                        <a href="{{ route('hr-login-page') }}">Log in</a>
                    </div>
                </div>
                <div class="formParentWrapper">
                    <div class="steps">
                        <div class="stepInfo">
                            <div class="step active" data-step="1">1</div>
                            <div>
                                <p class="label">STEP 1</p>
                                <p class="info">EMPLOYER BASIC INFO</p>
                            </div>
                        </div>
                        <div class="vertical-progress-bar">
                            <div class="vertical-progress-bar-fill"></div>
                        </div>
                        <div class="stepInfo">
                            <div class="step" data-step="2">2</div>
                            <div>
                                <p class="label">STEP 2</p>
                                <p class="info">CREDENTIALS</p>
                            </div>
                        </div>
                        <div class="vertical-progress-bar">
                            <div class="vertical-progress-bar-fill"></div>
                        </div>
                        <div class="stepInfo">
                            <div class="step" data-step="3">3</div>
                            <div>
                                <p class="label">STEP 3</p>
                                <p class="info">COMPANY INFO</p>
                            </div>
                        </div>
                        <div class="vertical-progress-bar">
                            <div class="vertical-progress-bar-fill"></div>
                        </div>
                        <div class="stepInfo">
                            <div class="step lastStep laststephr" data-step="4">4</div>
                            <div>
                                <p class="label">STEP 4</p>
                                <p class="info">SUMMARY</p>
                            </div>
                        </div>
                    </div>
                    <div class="rightSectionParent">
                        <div class="rightSectionWrapper">
                            <!-- Step 1: HR Basic Info -->
                            <div class="formContainer" data-step="1">
                                <div class="mainForm">
                                    <p class="personal">Employer Basic Info</p>
                                    <p class="personalInfo">Please provide your name, email, and phone number.</p>
                                    <div class="form">
                                        <div class="fieldParent">
                                            <label for="company_name">You already have EImager Id?</label>
                                            <input name="previous_eimager_checkbox" id="previous_eimager_checkbox" type="checkbox" class='fieldParent-input-smaller' >
                                            <input class='fieldParent-mid-smaller' type="text" id="previous_eimager_id" placeholder="e.g. EI989898989" disabled data-ignore='true'/>
                                            <button class="submit-btn width-100" id="searchEimagerBtn">Search</button>
                                            <p class="error-message" id="error-previous_eimager_id"></p>
                                        </div>


                                        <div class="fieldParent">
                                            <label for="company_name">Company Name</label>
                                            <input type="text" id="company_name" placeholder="e.g. ABC Corp" required />
                                            <p class="error-message" id="error-company_name"></p>
                                        </div>
                                        <div class="fieldParent">
                                            <label for="hr_name">HR Name</label>
                                            <input type="text" id="hr_name" placeholder="e.g. John Doe" required />
                                            <p class="error-message" id="error-hr_name"></p>
                                        </div>
                                        <div class="fieldParent">
                                            <label for="hr_email">Official Email Address</label>
                                            <input type="email" id="hr_email" placeholder="e.g. hr@company.com" required />
                                            <p class="error-message" id="error-hr_email"></p>
                                        
                                        </div>
                                        <div class="fieldParent">
                                            <label for="hr_phone">Phone Number</label>
                                            <input  placeholder="e.g. 923*****90" type="number"  inputmode="numeric" id="hr_phone"  required />
                                            <p class="error-message" id="error-hr_phone"></p>
                                        </div>
                                        
                                        <div class="fieldParent">
                                            <label for="hr_password">Password</label>
                                            <div id='inputcontainer'>
                                                <input type="password" id="hr_password" placeholder="Password" required />
                                                <p class="error-message" id="error-hr_password"></p>
                                                <div class="svg-wrapper">
                                                    <svg id="password_view_img_1" width="20" class='show' xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512">
                                                        <title>eye-glyph</title>
                                                        <path d="M320,256a64,64,0,1,1-64-64A64.07,64.07,0,0,1,320,256Zm189.81,9.42C460.86,364.89,363.6,426.67,256,426.67S51.14,364.89,2.19,265.42a21.33,21.33,0,0,1,0-18.83C51.14,147.11,148.4,85.33,256,85.33s204.86,61.78,253.81,161.25A21.33,21.33,0,0,1,509.81,265.42ZM362.67,256A106.67,106.67,0,1,0,256,362.67,106.79,106.79,0,0,0,362.67,256Z" />
                                                    </svg>
                                                    <svg id="password_view_img_2" width="20" class='hide' xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512">
                                                        <title>eye-disabled-glyph</title>
                                                        <path d="M409.84,132.33l95.91-95.91A21.33,21.33,0,1,0,475.58,6.25L6.25,475.58a21.33,21.33,0,1,0,30.17,30.17L140.77,401.4A275.84,275.84,0,0,0,256,426.67c107.6,0,204.85-61.78,253.81-161.25a21.33,21.33,0,0,0,0-18.83A291,291,0,0,0,409.84,132.33ZM256,362.67a105.78,105.78,0,0,1-58.7-17.8l31.21-31.21A63.29,63.29,0,0,0,256,320a64.07,64.07,0,0,0,64-64,63.28,63.28,0,0,0-6.34-27.49l31.21-31.21A106.45,106.45,0,0,1,256,362.67ZM2.19,265.42a21.33,21.33,0,0,1,0-18.83C51.15,147.11,148.4,85.33,256,85.33a277,277,0,0,1,70.4,9.22l-55.88,55.88A105.9,105.9,0,0,0,150.44,270.52L67.88,353.08A295.2,295.2,0,0,1,2.19,265.42Z" />
                                                    </svg>
                                                </div>

                                            </div>
                                        </div>
                                        <div class="fieldParent">
                                            <label for="hr_password_confirmation">Confirm Password</label>
                                            <input type="password" id="hr_password_confirmation" placeholder="Re-enter your password" required />
                                            <p class="error-message" id="error-hr_password_confirmation"></p>
                                        </div>

                                    </div>
                                    <input type="hidden" id="hr_unique_hidden" name="hr_unique_hidden" value="testS">
                                </div>
                            </div>

                            <!-- Step 2: Credentials -->
                            
                            <div class="formContainer hide" data-step="2">
                                <div class="mainForm">
                                    <p class="personal">Your personal info</p>
                                    <p class="personalInfo">Enter Your Personal Info</p>
                                    <div class="form">
                                    <input type="hidden" id="hr_email_hidden" name="hr_email">
                                        <div class="fieldParent">
                                            <label for="hr_aadhar">Aadhaar Number</label>
                                            <input id="hr_aadhar" placeholder="e.g. 1234 5678 9101" type="text" pattern="[0-9]{3}-[0-9]{2}-[0-9]{3}" required>
                                            <label >Your Aadhar is Secure as 1234 #### #### 2323</label>
                                            <input type="hidden" id="hr_addhar_hidden" name="hr_addhar_hidden" value="twst">
                                        </div>
                                        <div class="fieldParent">
                                            <label for="hr_pan">PAN Number</label>
                                            <input type="text" id="hr_pan" placeholder="e.g. AAAAA9999A" maxlength="10" pattern="[a-zA-Z]{5}[0-9]{4}[a-zA-Z]{1}">
                                            <label >Your PAN Number is Secure as ADSA##########</label>
                                            <input type="hidden" id="hr_pan_hidden" name="hr_pan_hidden" value="twst">
                                        </div>
                                        <div class="fieldParent">
                                            <label for="hr_dob">Date of Birth</label>
                                            <input type="date" id="hr_dob" required>
                                            <input type="hidden" id="hr_dob_hidden" name="hr_dob_hidden" value="twst">
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Step 3: Company Info -->
                            <div class="formContainer hide" data-step="3">
                                <div class="mainForm">
                                    <p class="personal">Company Details</p>
                                    <p class="personalInfo">Fill in your organization details.</p>
                                    <div class="form">
                                    <!-- <input type="hidden" id="hr_email_hidden" name="hr_email"> -->
                                        <div class="fieldParent">
                                            <label for="reporting_manager_mail">Reporting Manager Email</label>
                                            <input type="email" id="reporting_manager_mail" placeholder="e.g. manager@abc.com" required>
                                            <p class="error-message" id="error-reporting_manager_mail"></p>
                                        </div>
                                        <div class="fieldParent">
                                            <label for="reporting_manager_name">Reporting Manager Name</label>
                                            <input type="text" id="reporting_manager_name" placeholder="e.g. John Doe" required>
                                            <p class="error-message" id="error-reporting_manager_name"></p>
                                        </div>

                                        <div class="fieldParent">
                                            <label for="reporting_manager_contact">Reporting Manager Contact</label>
                                            <input type="tel" id="reporting_manager_contact" placeholder="e.g. 9876543210" required>
                                            <p class="error-message" id="error-reporting_manager_contact"></p>
                                        </div>

                                        <div class="fieldParent">
                                            <label for="company_website">Company Website</label>
                                            <input type="url" id="company_website" placeholder="e.g. https://www.example.com" required>
                                            <p class="error-message" id="error-company_website"></p>
                                        </div>

                                        <!-- <div class="fieldParent">
                                            <label for="date_of_joining">Joinning Date</label>
                                            <input type="date" id="date_of_joining" required>
                                        </div>
                                        <div class="fieldParent">
                                            <label for="last_working_day">Last Working Day</label>
                                            <input type="date" id="last_working_day" required>
                                        </div> -->
                                    </div>
                                </div>
                            </div>
                            <input type="hidden" id="hr_unique_id" name="hr_unique_id">
                            <!-- Step 4: Summary -->
                            <div class="formContainer hide" data-step="4">
                                <div class="mainForm">
                                    <img src="{{url('/images/success.png')}}" alt="">
                                    <p class="personal">Profile Created Successfully. We have shared your Eimager ID in your Mail Id for future reference.</p>
                                    <p class="personalInfo">Please Wait. We are loading to your profile.  We have shared your Eimager ID in your Mail Id for future reference. </p>
                                    <div class="form">
                                        <div class="fieldParent"><label>Name: <span id="s_hr_name"></span></label></div>
                                        <div class="fieldParent"><label>Email: <span id="s_hr_email"></span></label></div>
                                        <div class="fieldParent"><label>Phone: <span id="s_hr_phone"></span></label></div>
                                        <div class="fieldParent"><label>Company: <span id="s_company_name"></span></label></div>
                                        <div class="fieldParent"><label>Manager Email: <span id="s_reporting_manager_mail"></span></label></div>
                                        <div class="fieldParent"><label>Aadhaar: <span id="s_hr_aadhar"></span></label></div>
                                        <div class="fieldParent"><label>PAN: <span id="s_hr_pan"></span></label></div>
                                        <div class="fieldParent"><label>DOB: <span id="s_hr_dob"></span></label></div>
                                        <div class="fieldParent"><label>Unique ID: <span id="s_hr_unique_id"></span></label></div>
                                    </div>
                                </div>
                            </div>
                            <!-- <input type="hidden" id="hr_email_hidden" name="hr_email"> -->
                        </div>
                        <!-- Navigation Buttons -->
                        <div class="btnWrapper">
                            <p class="prev hideBtn" data-step="1">Go Back</p>
                            <button class="next" data-step="1">Next Step</button>
                            <button class="submit hideBtn" data-step="4">Submit</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- otp modal -->
    <div id="otpModal" class="modal-overlay" style="display:none;">
        <div class="modal-box">
            <h2>Enter OTP</h2>
            <p>A One-Time Password (OTP) has been sent to your email. Please enter the OTP below:</p>
            <input type="text" id="otpInput" class="otp-field" placeholder="Enter OTP">
            <div id="otpError" class="error-message"></div>
            <div class="modal-buttons">
                <button id="closeOtpModal">Cancel</button>
                <button id="verifyOtp">Verify OTP</button>
            </div>
        </div>
    </div>
    <!-- otp modal -->
    
    <!-- Yes No Modal -->
      <div id="yesNoModal" class="modal">
        <!-- Modal content -->
        <div class="modal-content">
          <h3 id='infoModalMsgBox'></h3>
          <br>

          <div class='button-container'>
            <button class="submit-btn width-100" id="modalYesBtn">Yes</button>
            <button class="no-btn width-100" id="modalNoBtn">No</button>
          </div>
        </div>
      </div>
    <!-- Yes No Modal -->
    
    <!-- <script src="js/custom.js"></script> -->
    <script src="js/employeer.js"></script>
    <script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.6/js/dataTables.bootstrap5.min.js"></script>
</body>

</html>
<style>
    .fieldParent label {
        padding-bottom: 10px;
    }

    .modal-overlay {
        display: none;
        /* Hidden by default */
        position: fixed;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background: rgba(0, 0, 0, 0.5);
        display: flex;
        align-items: center;
        justify-content: center;
    }

    /* Modal Box */
    .modal-box {
        background: #fff;
        padding: 20px;
        width: 350px;
        text-align: center;
        border-radius: 10px;
        box-shadow: 0 0 10px rgba(0, 0, 0, 0.3);
    }

    /* Input Field */
    .otp-field {
        width: 80%;
        padding: 10px;
        margin: 10px 0;
        text-align: center;
        font-size: 18px;
    }

    /* Buttons */
    .modal-buttons button {
        padding: 10px 15px;
        margin: 5px;
        border: none;
        cursor: pointer;
    }

    .modal-buttons button:first-child {
        background: #ccc;
    }

    .modal-buttons button:last-child {
        background: #28a745;
        color: white;
    }

    /* Error Message */
    .error-message {
        color: red;
        margin-bottom: 10px;
    }
    .fieldParent{
      position:relative;
    }
    .svg-wrapper {
        position: absolute;
        right: 11px;
        top: 50%;
    }
    .stepInfo .laststephr{
        visibility: visible !important;
    }
    button.next {
        background-color: #007BFF; /* Primary blue for trust */
        color: #fff;
        font-size: 16px;
        font-weight: 600;
        padding: 12px 24px;
        border: none;
        border-radius: 6px;
        cursor: pointer;
        transition: background-color 0.3s ease, transform 0.2s ease;
        box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
    }

    button.next:hover {
      background-color: #0056b3; /* Darker blue on hover */
      transform: translateY(-2px);
    }
    
    button.next:active {
      background-color: #004494;
      transform: translateY(0);
    }
    @media (max-width: 600px) {
      button.next {
        width: 100%;
        font-size: 14px;
      }
}


</style>