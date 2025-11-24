<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Global Html Template</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Ubuntu:wght@400;500;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.css" />
    <link href="css/custom.css" rel="stylesheet">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz"
        crossorigin="anonymous"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
</head>

<body>
    <div class="container mt-4">
        <h2 class="mb-3">Profile View</h2>

        <!-- Form Wrapper -->
        <div id="form-container" class="profile-wrapper">
            <div class="form-group border mb-2 position-relative" id="form-2">
                <label>Company Name</label>
                <input type="text" class="form-control company-name" placeholder="Enter company name">

                <label>Designation</label>
                <input type="text" class="form-control company-designation" placeholder="Enter designation">

                <!-- Phone Numbers Section -->
                <label>Project</label>
                <div class="phone-container">
                    <div class="input-group mb-2 phone-group">
                        <input type="text" class="form-control project" placeholder="Enter project">
                       
                    </div>
                </div>

                <label>Start Date</label>
                <input type="text" class="form-control start-date" placeholder="Enter your start date">

                <label>End Date</label>
                <input type="text" class="form-control end-date" placeholder="Enter last date">

                <label>Roles & Resposiablites</label>
                <input type="text" class="form-control company-role" placeholder="Enter company role">
            </div>
        </div>
        <!-- Add/Delete Buttons -->
        <div class="update-btn-wrapper">
            <button id="update-profile" class="btn btn-primary mt-2 update-profile">Update Profile</button>
        </div>
        <!-- Display Submitted Data -->
    </div>
</body>

</html>