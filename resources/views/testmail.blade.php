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
                        <p class="personal">Mail Send Test </p>
                        <p class="personalInfo">Please provide your mail id and mail content and send mail</p>
                    </div>
                    <div class="form-login form">
                        <div class="fieldParent">
                            <div class="labelErrorParent">
                                <label for="email_to">Email To</label>
                                <p class="error"></p>
                            </div>
                            <input placeholder="e.g. John Doe" type="text" id="email_to" name="email_to"
                                class="name" value='irvingtech004@gmail.com'>
                        </div>
                        <div class="fieldParent">
                            <div class="labelErrorParent">
                                <label for="mail_content">Mail Content</label>
                                <p class="error"></p>
                            </div>
                            <input placeholder="e.g. 12@lorem568" type="text" id="mail_content" name="mail_content"
                                class="password">
                        </div>
                        <div class="bottom-section">
                            <!-- <div class="register-btn-wrapper">
                                <a href="{{ route('hr-register-page') }}">Create Account</a>
                            </div> -->
                            <div class="login-from-btn">
                                <a href="javascript:void(0);" id="send-mail-submit">
                                    Send Mail
                                </a>
                            </div>
                        </div>
                        <div class="back-to-home">
                            <a href="{{ url('/') }}" class="home-link">← Back to Home</a>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
<script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.13.6/js/dataTables.bootstrap5.min.js"></script>
<script src="js/custom.js"></script>
<script src="js/employeer.js"></script>
</body>
</html> 
<style>
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
</style>