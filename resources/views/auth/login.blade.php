<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Login</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Ubuntu:wght@400;500;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">
    <link href="css/custom.css" rel="stylesheet">
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
        <div class="login-form-wrapper">
            <div class="formContainer-login">
                <div class="mainForm">
                    <div>
                        <p class="personal">User/Employee Login</p>
                        <p class="personalInfo">Please provide your emagerid/ email address, and password.</p>
                    </div>
                    <div class="form-login form">
                        <div class="fieldParent">
                            <div class="labelErrorParent">
                                <label for="unique_id">User ID/Email ID</label>
                                <p class="error"></p>
                            </div>
                            <input placeholder="e.g. John Doe" type="text" id="unique_id" name="unique_id"
                                class="name">
                        </div>
                        <div class="fieldParent">
                            <div class="labelErrorParent">
                                <label for="password">Password</label>
                                <p class="error"></p>
                            </div>
                            <input placeholder="e.g. 12@lorem568" type="password" id="password" name="password"
                                class="password">
                        </div>
                        <div class="bottom-section">
                            <div class="register-btn-wrapper">
                                <a href="{{ route('register-page') }}" class="account-create-btn">Create Account</a>
                            </div>
                            <div class="login-from-btn">
                                <a href="javascript:void(0);" id="login-submit">
                                    Login
                                </a>
                            </div>
                        </div>
                        <!-- <div class="back-to-home">
                            <a href="{{ url('/') }}" class="home-link">← Back to Home</a>
                        </div> -->
                        <div class="bottom-wrapper">
                            <div class="back-to-home">
                                <a href="{{ url('/') }}" class="home-link">← Back to Home</a>
                            </div>
                            <!-- forgot password -->
                            <div class="forgot-password-link back-to-home" style="">
                                <a href="javascript:void(0);" id="open-forgot-modal-user" class="home-link">Forgot Password?</a>
                            </div>
                            <!-- forgot password -->
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>
    <div id="forgotPasswordModalUser" style="display: none; position: fixed; top: 0; left: 0; width:100%; height:100%; background:rgba(0,0,0,0.6); z-index:9999; justify-content: center; align-items: center;">
        <div style="background: #fff; width: 90%; max-width: 400px; padding: 30px 25px; border-radius: 10px; box-shadow: 0 8px 20px rgba(0, 0, 0, 0.2); position: relative;">
            <h3 style="margin-bottom: 20px; font-size: 20px; font-weight: 600; color: #333;">Reset Your Password</h3>

            <form id="forgot-password-form-user">
                @csrf
                <div class="fieldParent" style="margin-bottom: 20px;">
                    <label for="forgot_email" style="display: block; margin-bottom: 8px; color: #222; font-weight: 500;">Enter Your Email</label>
                    <input type="email" id="forgot_email" name="email" placeholder="you@example.com" required
                        style="width: 100%; padding: 10px 12px; border: 1px solid #ccc; border-radius: 6px; font-size: 14px;">
                </div>

                <div style="text-align: right;">
                    <button type="button" id="close-forgot-modal-user"
                        style="padding: 8px 14px; margin-right: 10px; background: #f0f0f0; border: 1px solid #ccc; border-radius: 4px; cursor: pointer;">Cancel</button>
                    <button type="submit"
                        style="padding: 8px 14px; background: #007BFF; color: white; border: none; border-radius: 4px; cursor: pointer;">Send OTP</button>
                </div>
            </form>
        </div>
    </div>

    <!-- OTP Verification Modal -->
    <div id="verifyOtpModalUser" style="display: flex; position: fixed; top: 0; left: 0; width:100%; height:100%; background:rgba(0,0,0,0.6); z-index:9999; display: none; justify-content: center; align-items: center;">
        <div style="background: #fff; width: 90%; max-width: 400px; padding: 30px 25px; border-radius: 10px; box-shadow: 0 8px 20px rgba(0, 0, 0, 0.2); position: relative;">
            <h3 style="margin-bottom: 20px; font-size: 20px; font-weight: 600; color: #333;">Enter OTP</h3>

            <form id="verify-otp-form-user">
                @csrf
                <input type="hidden" id="otp_email" name="email"> 
                <div class="fieldParent" style="margin-bottom: 20px;">
                    <label for="otp" style="display: block; margin-bottom: 8px; color: #222; font-weight: 500;">OTP</label>
                    <input type="text" id="otp" name="otp" placeholder="6-digit code" required
                        style="width: 100%; padding: 10px 12px; border: 1px solid #ccc; border-radius: 6px; font-size: 14px;">
                </div>

                <div style="text-align: right;">
                    <button type="button" id="close-otp-modal"
                        style="padding: 8px 14px; margin-right: 10px; background: #f0f0f0; border: 1px solid #ccc; border-radius: 4px; cursor: pointer;">Cancel</button>
                    <button type="submit"
                        style="padding: 8px 14px; background: #28a745; color: white; border: none; border-radius: 4px; cursor: pointer;">Verify OTP</button>
                </div>
            </form>
        </div>
    </div>
    <!-- Otp Verification Modal -->
    <script src="js/custom.js"></script>
    <script src="{{ asset('js/forgotpassword.js') }}"></script>
</body>

</html>
<script>
    $(document).ready(function() {
        $('#open-forgot-modal-user').click(function() {
            $('#forgotPasswordModalUser').css('display', 'flex');
            $('#forgotPasswordModalUser').fadeIn();
        });

        $('#close-forgot-modal-user').click(function() {
            $('#forgotPasswordModalUser').fadeOut();
        });

        $('#close-forgot-modal-user').click(function() {
            $('#verifyOtpModalUser').fadeOut();
        });

    });
</script>
<style>
    .account-create-btn{
        color: var(--marineBlue) !important;
        font-weight: 500;
        font-size: 15px;
    }
    .back-to-home {
        text-align: center;
        margin-top: 15px;
    }

    .home-link {
        color: var(--marineBlue);
        text-decoration: none;
        font-weight: bold;
    }

    .home-link:hover {
        text-decoration: underline;
    }

    .bottom-wrapper {
        display: flex;
        justify-content: space-between;
        align-items: center;
    }

    .forgotPasswordModalUser {
        display: none !important;
    }
</style>