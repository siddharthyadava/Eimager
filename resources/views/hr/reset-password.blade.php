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
    <link href="{{ asset('css/custom.css') }}" rel="stylesheet">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz"
        crossorigin="anonymous"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
</head>

<body>
    <!-- <form id="reset-password-form">
      
        <input type="hidden" name="token" value="{{ $token }}">
        <input type="hidden" name="email" value="{{ $email }}">
        <div class="form-group">
            <label for="hr_password">New Password</label>
            <input type="text" name="hr_password" id="hr_password" class="form-control" required>
        </div>

        <div class="form-group">
            <label for="hr_password_confirmation">Confirm Password</label>
            <input type="text" name="hr_password_confirmation" id="hr_password_confirmation" class="form-control" required>
        </div>
        <button type="submit">Reset Password</button>
    </form> -->
    <div class="container">
        <div class="login-form-wrapper">
            <div class="formContainer-login">
                <form class="mainForm" id="reset-password-form">
                    <div>
                        <p class="personal">Employer Reset Password</p>
                    </div>
                    <div class="form-login form">
                        <div class="fieldParent">
                            <input type="hidden" name="token" value="{{ $token }}">
                            <input type="hidden" name="email" value="{{ $email }}">
                            <div class="fieldParent">
                                <!-- <label for="hr_unique_id">User Id</label>
                                <p class="error"></p> -->
                                <label for="hr_password">New Password</label>
                                <input type="password" name="hr_password" id="hr_password" class="form-control" required>
                            </div>
                            <!-- <input placeholder="e.g. John Doe" type="text" id="hr_unique_id" name="hr_unique_id"
                                class="name"> -->
                        </div>
                        <div class="fieldParent">
                            <!-- <div class="labelErrorParent">
                                <label for="hr_password">Password</label>
                                <p class="error"></p>
                            </div> -->
                            <label for="hr_password_confirmation">Confirm Password</label>
                            <input type="password" name="hr_password_confirmation" id="hr_password_confirmation" class="form-control" required>
                            <!-- <input placeholder="e.g. 12@lorem568" type="password" id="hr_password" name="hr_password"
                                class="password"> -->
                        </div>
                        <div class="bottom-section">
                            <div class="login-from-btn">
                                <!-- <a href="javascript:void(0);" id="">
                                    Submit
                                </a> -->
                                <button type="submit" class="reset-password-submit">Reset Password</button>
                            </div>
                        </div>
                        <div id="reset-password-message" class="reset-password-message" style="margin-top: 10px; color: green;"></div>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <!-- Message output -->
    <!-- <div id="reset-password-message" style="margin-top: 10px; color: green;"></div> -->
    <script src="{{ asset('js/forgotpassword.js') }}"></script>
</body>
</html>
<style>
.login-from-btn button {
    padding-top: 10px;
    padding-bottom: 10px;
    padding-left: 18px;
    padding-right: 18px;
    border-radius: 8px;
    color: #FFFFFF !important;
    background-color: #1A2130;
}
.reset-password-message{
    max-width: 400px;
}
</style>