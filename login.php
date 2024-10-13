<?php
include('Database/login.php');
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login into the site | SEDP HRMS</title>

    <!-- Include Bootstrap CSS -->
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.all.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/normalize/8.0.1/normalize.min.css">

    <!-- Custom CSS -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@100;200;300;400;500;600;700;800;900&display=swap" rel="stylesheet">

    <!-- Custom CSS -->
    <link rel="stylesheet" href="Assets/Css/sweetAlert.css">
    <link rel="stylesheet" href="Assets/Css/index.css">
    <style>
        body {
            font-family: 'Poppins', sans-serif;
            margin: 0;
            padding: 0;
        }

        /* Set the navbar to be fixed at the top */
        .navbar {
            position: fixed;
            top: 0;
            width: 100%;
            z-index: 1000;
        }

        /* Carousel takes up the full viewport height minus the navbar */
        .carousel-container {
            height: calc(100vh - 56px);
            margin-top: 56px;
        }

        .carousel-item {
            height: 100vh;
        }

        /* Ensure images fill the entire carousel space */
        .carousel-inner img {
            width: 100%;
            height: 100vh;
            object-fit: cover;
            filter: brightness(0.5);
            /* Ensure the image covers the container without distortion */
        }

        /* Remove padding/margin */
        .carousel-inner,
        .carousel-item {
            padding: 0;
            margin: 0;
        }

        /* Center the login form */
        .login-container {
            position: absolute;
            top: 50%;
            left: 50%;
            width: 440px;
            height: 500px;
            transform: translate(-50%, -50%);
            background: rgba(255, 255, 255, 0.8);
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.5);
        }

        #logo {
            width: 80px;
            height: 80px;
        }

        .login-header {
            margin: 16px;
        }

        .H-side h2 {
            margin: 0;
            text-align: start;
            font-size: 28px;
            font-weight: bold;
            padding-left: 15px;
        }

        .H-side p {
            margin: 0;
            font-size: 16px;
            color: gray;
            padding-left: 15px;
        }

        .form-group input {
            background-color: #eafaf1;
            border: 1px solid #ccc;
            font-size: 16px;
        }

        .form-group i {
            color: #aaa;
        }

        .btn {
            background-color: #275144;
            font-size: 18px;
            border: none;
        }

        .btn:hover {
            background-color: #204938;
        }

        .form-text a {
            color: #7e7e7e;
            text-decoration: none;
        }

        .form-text a:hover {
            text-decoration: underline;
        }

        .login-form-container {
            margin: 10px;
        }

        .login-form-container label {
            font-size: 14px;
            text-align: left;
            display: block;
            margin-left: 0;
        }

        /* Icon styling */
        .input-group-text {
            cursor: pointer;
        }

        .carousel-control-prev,
        .carousel-control-next {
            background: none !important;
            /* Remove background */
            border: none !important;
            /* Remove border */
        }

        .carousel-control-prev-icon,
        .carousel-control-next-icon {
            filter: invert(1);
            /* Change icon color to white */
        }

        .carousel-indicators {
            margin-top: 30px;
            margin-bottom: 20px;
        }

        .navbar-nav .nav-link {
            transition: background-color 0.3s ease, color 0.3s ease;
            padding: 10px 10px;
            color: #ffffff;
            margin-left: 20px;
        }

        .navbar-nav .nav-link:hover {
            background-color: #004f4f;
            color: #ffffff;
            border-radius: 6px;
        }
    </style>
</head>

<body>

    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-dark" style="background-color: #003c3c;">
        <div class="container-fluid">
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarTogglerDemo02" aria-controls="navbarTogglerDemo02" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"><i class="bi bi-list"></i></span>
            </button>
            <div class="collapse navbar-collapse flex-row-reverse" id="navbarTogglerDemo02">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    <li class="nav-item">
                        <a class="nav-link text-white fw-bold" aria-current="page" href="ScholarApplicant-Page/App/View/LandingPage.php">SCHOLAR</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link text-white fw-bold" href="./JobPage/Jobpage.php">JOB</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link text-white fw-bold" href="https://sedp.ph/about-us/">ABOUT</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <div class="carousel-container">
        <div id="carousel" class="carousel slide" data-bs-ride="carousel">
            <div class="carousel-indicators">
                <button type="button" data-bs-target="#carousel" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
                <button type="button" data-bs-target="#carousel" data-bs-slide-to="1" aria-label="Slide 2"></button>
                <button type="button" data-bs-target="#carousel" data-bs-slide-to="2" aria-label="Slide 3"></button>
                <button type="button" data-bs-target="#carousel" data-bs-slide-to="3" aria-label="Slide 4"></button>
            </div>
            <div class="carousel-inner">
                <div class="carousel-item active" data-bs-interval="4000">
                    <img src="Include/image/loginBg.jpg" class="d-block w-100 c-image" alt="...">
                </div>
                <div class="carousel-item" data-bs-interval="4000">
                    <img src="Include/image/1.webp" class="d-block w-100 c-image" alt="...">
                </div>
                <div class="carousel-item" data-bs-interval="4000">
                    <img src="Include/image/2.webp" class="d-block w-100 c-image" alt="...">
                </div>
                <div class="carousel-item" data-bs-interval="4000">
                    <img src="Include/image/3.webp" class="d-block w-100 c-image" alt="...">
                </div>
                <div class="carousel-item" data-bs-interval="4000">
                    <img src="Include/image/4.webp" class="d-block w-100 c-image" alt="...">
                </div>
            </div>
            <button class="carousel-control-prev" type="button" data-bs-target="#carousel" data-bs-slide="prev" style="display: none;">
                <span class="carousel-control-prev-icon" aria-hidden="true" style="filter: invert(1);"></span>
                <span class="visually-hidden">Previous</span>
            </button>
            <button class="carousel-control-next" type="button" data-bs-target="#carousel" data-bs-slide="next" style="display: none;">
                <span class="carousel-control-next-icon" aria-hidden="true" style="filter: invert(1);"></span>
                <span class="visually-hidden">Next</span>
            </button>
        </div>
    </div>



    <!-- Login Form inside the carousel -->
    <div class="login-container text-center ">
        <div class="login-header d-flex mb-4 align-items-center">
            <img src="Include/image/loginLogo.png" alt="SEDP Logo" id="logo"> <!-- Replace with actual logo -->
            <div class="H-side">
                <h2 class="fw-bold">SEDP</h2>
                <p>Simbag sa Pag-Asenso Inc.</p>
            </div>
        </div>
        <hr class="border border-dark border-2 opacity-50">
        <div class="login-form-container mt-4">
            <!-- Email Input Field -->
            <form action="Database/login.php" method="POST">
                <div class="mb-3">
                    <label for="email" class="form-label">Email Address</label>
                    <input type="text" class="form-control" name="username" id="username" placeholder="@email.com" required>
                </div>

                <!-- Password Input Field -->
                <div class="mb-3">
                    <label for="password" class="form-label">Password</label>
                    <div class="input-group">
                        <input type="password" class="form-control" name="password" id="password" placeholder="********" required>
                        <span class="input-group-text" id="toggle-password" onclick="togglePasswordVisibility()"><i class="fas fa-eye"></i></span>
                    </div>
                </div>
                <div class="text-right mb-3" style="font-size:12px">
                    <a href="#" class="forgot-password">Forgot Password?</a>
                </div>

                <!-- Submit Button -->
                <button type="submit" class="btn btn-block rounded-pill text-white p-2" style="background-color: #003c3c;">Login</button>
            </form>
        </div>
    </div>
    <?php if (isset($_SESSION['login_success'])): ?>
        <script>
            document.addEventListener('DOMContentLoaded', function() {
                Swal.fire({
                    icon: 'success',
                    title: 'Login Successful',
                    text: '<?php echo addslashes($_SESSION['login_success']); ?>',
                    showConfirmButton: false,
                    timer: 1500
                }).then(function() {
                    window.location.href = '<?php echo $_SESSION['redirect_to']; ?>';
                });
            });
        </script>
        <?php
        unset($_SESSION['login_success']);
        unset($_SESSION['redirect_to']);
        ?>
    <?php elseif (isset($_SESSION['login_error'])): ?>
        <script>
            document.addEventListener('DOMContentLoaded', function() {
                Swal.fire({
                    icon: 'error',
                    title: 'Login Failed',
                    text: '<?php echo addslashes($_SESSION['login_error']); ?>',
                    showConfirmButton: true,
                    confirmButtonText: 'OK'
                });
            });
        </script>
        <?php unset($_SESSION['login_error']); ?>
    <?php endif; ?>

    <script>
        function togglePasswordVisibility() {
            var passwordField = document.getElementById("password");
            var icon = document.getElementById("toggle-password").firstElementChild;
            if (passwordField.type === "password") {
                passwordField.type = "text";
                icon.classList.remove("fa-eye");
                icon.classList.add("fa-eye-slash");
            } else {
                passwordField.type = "password";
                icon.classList.remove("fa-eye-slash");
                icon.classList.add("fa-eye");
            }
        }
    </script>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>

</body>

</html>