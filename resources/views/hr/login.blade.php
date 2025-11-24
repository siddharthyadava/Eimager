<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>EImager</title>

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
                        <p class="personal">HR/Employer Login</p>
                        <p class="personalInfo">Please provide your emagerid/ email address, and password.</p>
                    </div>
                    <div class="form-login form">
                        <div class="fieldParent">
                            <div class="labelErrorParent">
                                <label for="hr_unique_id">HR/Employer ID or Mail ID</label>
                                <p class="error"></p>
                            </div>
                            <input placeholder="e.g. John Doe" type="text" id="hr_unique_id" name="hr_unique_id"
                                class="name">
                        </div>
                        <div class="fieldParent">
                            <div class="labelErrorParent">
                                <label for="hr_password">Password</label>
                                <p class="error"></p>
                            </div>
                            <input placeholder="e.g. 12@lorem568" type="password" id="hr_password" name="hr_password"
                                class="password">
                        </div>
                        <div class="bottom-section">
                            <div class="register-btn-wrapper">
                                <a href="{{ route('hr-register-page') }}" class="account-create-btn">Create Account</a>
                            </div>
                            <div class="login-from-btn">
                                <a href="javascript:void(0);" id="hr-login-submit">
                                    Login
                                </a>
                            </div>

                        </div>
                        <div class="bottom-wrapper">
                            <div class="back-to-home">
                                <a href="{{ url('/') }}" class="home-link">← Back to Home</a>
                            </div>
                            <!-- forgot password -->
                            <div class="forgot-password-link back-to-home" style="">
                                <a href="javascript:void(0);" id="open-forgot-modal" class="home-link">Forgot Password?</a>
                            </div>
                            <!-- forgot password -->
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Forgot Password Modal -->
    <!-- Forgot Password Modal -->
    <div id="forgotPasswordModal" style="display: none; position: fixed; top: 0; left: 0; width:100%; height:100%; background:rgba(0,0,0,0.6); z-index:9999; justify-content: center; align-items: center;">
        <div style="background: #fff; width: 90%; max-width: 400px; padding: 30px 25px; border-radius: 10px; box-shadow: 0 8px 20px rgba(0, 0, 0, 0.2); position: relative;">
            <h3 style="margin-bottom: 20px; font-size: 20px; font-weight: 600; color: #333;">Reset Your Password</h3>

            <form id="forgot-password-form">
                @csrf
                <div class="fieldParent" style="margin-bottom: 20px;">
                    <label for="forgot_email" style="display: block; margin-bottom: 8px; color: #222; font-weight: 500;">Enter Your Email</label>
                    <input type="email" id="forgot_email" name="email" placeholder="you@example.com" required
                        style="width: 100%; padding: 10px 12px; border: 1px solid #ccc; border-radius: 6px; font-size: 14px;">
                </div>

                <div style="text-align: right;">
                    <button type="button" id="close-forgot-modal"
                        style="padding: 8px 14px; margin-right: 10px; background: #f0f0f0; border: 1px solid #ccc; border-radius: 4px; cursor: pointer;">Cancel</button>
                    <button type="submit"
                        style="padding: 8px 14px; background: #007BFF; color: white; border: none; border-radius: 4px; cursor: pointer;">Send OTP</button>
                </div>
            </form>
        </div>
    </div>

    <!-- OTP Verification Modal -->
    <div id="verifyOtpModal" style="display: flex; position: fixed; top: 0; left: 0; width:100%; height:100%; background:rgba(0,0,0,0.6); z-index:9999; display: none; justify-content: center; align-items: center;">
        <div style="background: #fff; width: 90%; max-width: 400px; padding: 30px 25px; border-radius: 10px; box-shadow: 0 8px 20px rgba(0, 0, 0, 0.2); position: relative;">
            <h3 style="margin-bottom: 20px; font-size: 20px; font-weight: 600; color: #333;">Enter OTP</h3>

            <form id="verify-otp-form">
                @csrf
                <input type="hidden" id="otp_email" name="email"> {{-- this will be filled dynamically --}}
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
    <script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.6/js/dataTables.bootstrap5.min.js"></script>
    <script src="js/custom.js"></script>
    <script src="js/employeer.js"></script>
    <script src="{{ asset('js/forgotpassword.js') }}"></script>
    <script>
        $(document).ready(function() {
            $('#open-forgot-modal').click(function() {
                $('#forgotPasswordModal').css('display', 'flex');
                $('#forgotPasswordModal').fadeIn();
            });

            $('#close-forgot-modal').click(function() {
                $('#forgotPasswordModal').fadeOut();
            });

            $('#close-otp-modal').click(function() {
                $('#verifyOtpModal').fadeOut();
            });

        });
    </script>
</body>

</html>
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

    .forgotPasswordModal {
        display: none !important;
    }
</style>