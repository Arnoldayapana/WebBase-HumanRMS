<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Job Landing Page</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@100;200;300;400;500;600;700;800;900&display=swap" rel="stylesheet">
    <link rel="shortcut icon" href="./Assets/Images/SEDPfavicon.png" type="image/x-icon">

    <style>
        body,
        html {
            height: 100%;
            background-color: #f0f0f0;
            font-family: 'Poppins', sans-serif;
            display: flex;
            justify-content: center;
            align-items: center;
        }

        .card {
            width: 550px;
            height: 300px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }

        .card-body {
            text-align: center;
        }

        .progress-dots {
            display: flex;
            justify-content: center;
            align-items: center;
            margin-top: 20px;
            margin-bottom: 10px;
        }

        .progress-dots .dot {
            height: 15px;
            width: 15px;
            background-color: #007bff;
            border-radius: 50%;
            display: inline-block;
        }

        .progress-dots .inactive-dot {
            background-color: #cccccc;
        }

        .progress-dots .line {
            width: 170px;
            height: 2px;
            background-color: #cccccc;
            margin: 0 10px;
        }
    </style>
</head>

<body>


    <!-- Main Content to Center the Card -->
    <div class="container">

        <div class="row d-flex align-items-center mb-2 justify-content-center">
            <div class="col-auto">
                <img src="../Scholar Page/Public/Assets/Images/SEDPLogo.png" style="width: 50px;" alt="SEDP Logo">
            </div>
            <div class="col-auto">
                <h1 class="fs-4 fw-bold ms-0">SEDP Simbag sa Pag-Asenso Inc.</h1>
            </div>
        </div>
        <div class="row justify-content-center mb-2">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-body">
                        <h5 class="mb-4 mt-3">Application Status</h5>
                        <p class="mb-5">Your application has been successfully submitted.Please await further updates. We've also sent a message to the account you provided to keep you informed.</p>

                        <!-- Progress Dots -->
                        <div class="progress-dots">
                            <span class="dot"></span>
                            <div class="line"></div>
                            <span class="dot inactive-dot"></span>
                            <div class="line"></div>
                            <span class="dot inactive-dot"></span>
                        </div>

                        <!-- Labels under progress bar -->
                        <div class="d-flex justify-content-between px-2 text-muted">
                            <small>Application Submission</small>
                            <small>Interview</small>
                            <small>Accepted</small>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <a href="Jobpage.php" class="text-center" style="text-decoration:none">Back to Homepage</a>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>

</html>