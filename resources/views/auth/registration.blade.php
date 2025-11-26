<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Registration</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Ubuntu:wght@400;500;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.css" />
    <link href="css/custom.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.min.js"></script>
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
                        <a href="{{ route('login-page') }}">
                        <img src="{{url('/images/logo.jpg')}}" alt="BootstrapBrain Logo" width="250">
                        </a>
                    </div>
                    <div class="login-btn">
                        <a href="{{ route('login-page') }}">Log in</a>
                    </div>
 
                </div>
                
                <div class="formParentWrapper">
                    <div class="steps">
                        <div class="stepInfo">
                            <div class="step active" data-step="1">1</div>
                            <div>
                                <p class="label">STEP 1</p>
                                <p class="info">BASIC INFO</p>
                            </div>
                        </div>

                        <div class="vertical-progress-bar">
                            <div class="vertical-progress-bar-fill"></div>
                        </div>

                        <div class="stepInfo">
                            <div class="step" data-step="2">2</div>
                            <div>
                                <p class="label">STEP 2</p>
                                <p class="info">PERSONAL INFO</p>
                            </div>
                        </div>

                        <div class="vertical-progress-bar">
                            <div class="vertical-progress-bar-fill"></div>
                        </div>

                        <div class="stepInfo">
                            <div class="step" data-step="3">3</div>
                            <div>
                                <p class="label">STEP 3</p>
                                <p class="info">SUMMARY</p>
                            </div>
                        </div>

                        <!-- <div class="vertical-progress-bar">
                            <div class="vertical-progress-bar-fill"></div>
                        </div> -->

                        <!-- <div class="stepInfo">
                            <div class="step" data-step="4">4</div>
                            <div>
                                <p class="label">STEP 4</p>
                                <p class="info">CREATE ID</p>
                            </div>
                        </div>

                        <div class="step lastStep" data-step="5">5</div> -->
                    </div>

                    <div class="rightSectionParent">
                        <div class="rightSectionWrapper">
                            
                            <div class="formContainer" data-step="1">
                                <div class="mainForm">
                                    <div>
                                        <p class="personal">Personal Info</p>
                                        <p class="personalInfo">Please provide your name, email address, and phone number. Your information is very secured.</p>
                                    </div>
                                    <div class="form">
                                        <div class="fieldParent">
                                            <div class="labelErrorParent">
                                                <label for="name">Name as per Aadhar/PAN</label>
                                            </div>
                                            <input placeholder="e.g. John Doe" type="text" id="first_name">
                                            <p class="error-message" id="error-first_name"></p>
                                        </div>
                                        <div class="fieldParent">
                                            <div class="labelErrorParent">
                                                <label for="email">Email Address</label>
                                            </div>
                                            <input placeholder="e.g. doe@lorem.com" type="email" id="email">
                                            <p class="error-message" id="error-email"></p>
                                        </div>
                                        <div class="fieldParent">
                                            <div class="labelErrorParent">
                                                <label for="number">Phone Number</label>
                                            </div>
                                            <input placeholder="e.g. 9234567890" type="number"  inputmode="numeric" id="phone_number" name="phone_number">
                                            <p class="error-message" id="error-phone_number"></p>
                                        </div>
                                        <!-- Password -->
                                        <div class="fieldParent">
                                            <div class="labelErrorParent">
                                                <label for="password">Password</label>
                                            </div>
                                            <div class="password-wrapper">
                                                <input placeholder="Enter your password" name="password" type="password" id="password">
                                                <button type="button" class="toggle-password" data-target="#password">Show</button>
                                            </div>
                                            <p class="error-message" id="error-password"></p>
                                        </div>

                                        <!-- Confirm Password -->
                                        <div class="fieldParent">
                                            <div class="labelErrorParent">
                                                <label for="confirm-password">Confirm Password</label>
                                            </div>
                                            <div class="password-wrapper">
                                                <input placeholder="Re-enter your password" type="password" name="password_confirmation" id="confirm-password">
                                                <button type="button" class="toggle-password" data-target="#confirm-password">Show</button>
                                            </div>
                                            <p class="error-message" id="error-password"></p>
                                            <input type="hidden" id="user_name_hidden" name="first_name" value="test">
                                            <input type="hidden" id="user_email_hidden" name="email" value="test">
                                        </div>

                                    </div>
                                </div>
                            </div>


                            <!-- Step 2: Personal Info -->
                            <div class="formContainer hide" data-step="2">
                                <div class="mainForm">
                                    <div>
                                        <p class="personal">Please Fill This Attentively</p>
                                        <p class="personalInfo">Please Fill the details for generating your unique eimager id</p>
                                    </div>
                                    <div class="form">
                                        <div class="fieldParent">
                                            <div class="labelErrorParent">
                                                <label for="aadhar_number">Aadhar Number</label>
                                            </div>
                                            <input placeholder="e.g. 1234 5678 9101" type="text" id="aadhar_number" pattern="[0-9]{3}-[0-9]{2}-[0-9]{3}">
                                            <label >Your Aadhar is Secure as 1234 #### #### 2323</label>
                                            <p class="error-message" id="error-aadhar_number"></p>
                                        </div>
                                        <div class="fieldParent">
                                            <div class="labelErrorParent">
                                                <label for="pan">Pan Number(NNNNNNNNNN if not Available)</label>
                                            </div>
                                            <input placeholder="e.g. AAAAA9999A" type="text" id="pan_number" maxlength="10" pattern="[a-zA-Z]{5}[0-9]{4}[a-zA-Z]{1}">
                                            <label >Your PAN Number is Secure as ADSA##########</label>
                                            <p class="error-message" id="error-pan_number"></p>
                                        </div>
                                        <div class="fieldParent">
                                            <div class="labelErrorParent">
                                                <label for="dob">Date of Birth</label>
                                            </div>
                                            <input type="date" id="dob" required>
                                            <p class="error-message" id="error-dob"></p>
                                            <!-- <input placeholder="e.g. 01/01/1990" type="text" id="dob"> -->
                                            <input type="hidden" id="unique_id" name="unique_id">
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Step 3: Summary -->
                            <div class="formContainer hide" data-step="3">
                                <div class="mainForm">
                                    <!-- <div>
                                        <img src="{{url('/images/success.png')}}" alt="">
                                        <p class="personal">Profile Created Successfully. We have shared your Eimager ID in your Mail Id for future reference.</p>
                                        <p class="personalInfo">Please Wait. We are loading to your profile.  We have shared your Eimager ID in your Mail Id for future reference. </p>
                                    </div> -->
                                    <div class="summary-header-wrapper">
                                        <div class="summary-success-holder">
                                            <div class="success-image-holder">
                                              <img src="{{url('/images/success.png')}}" alt="">
                                            </div>
                                            <p class="personal">Profile Created Successfully. We have shared your Eimager ID in your Mail Id for future reference.</p>
                                        </div>
                                        <p class="personalInfo">Please Wait. We are loading to your profile. We have shared your Eimager ID in your Mail Id for future reference. </p>
                                    </div>
                                    <div class="form">

                                        <div class="fieldParent">
                                            <label>Name: <span id="s_name"></span></label>
                                        </div>
                                        <div class="fieldParent">
                                            <label>Email: <span id="s_email"></span></label>
                                        </div>
                                        <div class="fieldParent">
                                            <label>Phone: <span id="s_number"></span></label>
                                        </div>
                                        <div class="fieldParent">
                                            <label>Aadhar: <span id="s_aadhar"></span></label>
                                        </div>
                                        <!-- <div class="fieldParent">
                                            <div class="labelErrorParent">
                                                <label id="s_password" for="s_password" class="s_password">Password</label>
                                            </div>
                                        </div> -->
                                        <div class="fieldParent">
                                            <label>PAN: <span id="s_pan"></span></label>
                                        </div>
                                        <div class="fieldParent">
                                            <label>DOB: <span id="s_dob"></span></label>
                                        </div>
                                        <!-- <div class="fieldParent">
                                            <label>Eimager Id: <span id="s_eimager_id"></span></label>
                                        </div> -->
                                    </div>
                                </div>
                            </div>

                            <!-- Step 4: Create ID -->
                            <div class="formContainer hide" data-step="4">
                                <div class="mainForm">
                                    <div>
                                        <p class="personal">Profile Created Successfully</p>
                                    </div>
                                    <div class="billingContainer">
                                        <p class="eimagerid">Your Unique imager ID: <span id="generatedID"></span></p>
                                        <!-- <input type="hidden" id="unique_id" name="unique_id"> -->
                                    </div>
                                </div>
                            </div>

                            <!-- Step 5: Thank You -->
                            <div class="formContainer hide" data-step="5">
                                <div class="thankContainer">
                                    <div class="thankParent">
                                        <img src="{{url('/images/success.png')}}" alt="">
                                        <p class="thankyou">Thank You!</p>
                                        <p class="thankMsg">
                                            Thanks for confirming your submission! If you ever need support, please email us at support@eimager.com.
                                        </p>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Buttons -->
                        <div class="btnWrapper">
                            <p class="prev hideBtn" data-step="1">Go Back</p>
                            <button class="next" data-step="1">Next Step</button>
                        </div>
                    </div>
                </div>

            </div>
        </div>


    </div>
    
    <script src="js/custom.js"></script>

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            document.querySelectorAll('.toggle-password').forEach(function (btn) {
                var targetSelector = btn.getAttribute('data-target');
                var input = document.querySelector(targetSelector);
                if (!input) return;

                btn.addEventListener('click', function () {
                    var isPassword = input.getAttribute('type') === 'password';
                    input.setAttribute('type', isPassword ? 'text' : 'password');
                    btn.textContent = isPassword ? 'Hide' : 'Show';
                });
            });
        });
    </script>


    <style>
        .summary-success-holder{
            display:flex;
            gap:10px;
            align-items: center;
        }
        .success-image-holder{
            max-width: 48px ;
        }
        .success-image-holder img{
            width:100%;
        }
        .summary-success-holder .personal{
            font-size: 21px;
        }
        .btnWrapper p,
        .btnWrapper button {
          padding: 10px 18px;
          font-size: 16px;
          font-weight: 500;
          border-radius: 6px;
          border: none;
          cursor: pointer;
          transition: all 0.3s ease;
        }
        
         Go Back (styled like a secondary button / link) 
        .btnWrapper .prev {
          background: transparent;
          color: #555;
          border: 1px solid #ccc;
        }
        
        .btnWrapper .prev:hover {
          background: #f5f5f5;
          border-color: #999;
        }
        
        .hideBtn {
          display: none;
        }
        .btnWrapper {
          display: flex;
          justify-content: flex-end;
          margin-top: 20px;
        }
        
        .btnWrapper .next {
          background: #007bff;
          color: #fff;
          padding: 10px 18px;
          font-size: 16px;
          border: none;
          border-radius: 6px;
          cursor: pointer;
          transition: 0.3s;
        }
        
        .btnWrapper .next:hover {
          background: #0056b3;
        }

        /* Added for show and hide password */
        .password-wrapper {
            position: relative;
        }

        .password-wrapper input {
            padding-right: 70px; /* space for the Show/Hide button */
        }

        .password-wrapper .toggle-password {
            position: absolute;
            top: 50%;
            right: 12px;
            transform: translateY(-50%);
            background: transparent;
            border: none;
            font-size: 13px;
            color: #007bff;
            cursor: pointer;
            padding: 0;
        }
        .password-wrapper .toggle-password:focus {
            outline: none;
        }


    </style>
</body>
</html>