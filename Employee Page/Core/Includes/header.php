<?php
include("../../../Database/database.php");
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo isset($title) ? $title : 'Default Title'; ?></title>

    <link rel="shortcut icon" href="../../../Assets/Images/SEDPfavicon.png" type="image/x-icon">
    <link rel="stylesheet" href="../../Public/Assets/Css/navbar.css">
    <link rel="stylesheet" href="../../Public/Assets/Css/employee_home.css">
    <link rel="stylesheet" href="../../Public/Assets/Css/calendar.css">


    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css"
        integrity="sha512-SnH5WK+bZxgPHs44uWIX+LLJAJ9/2PkPKZ5QiAj6Ta86w+fsb2TkcmfRyVX3pBnMFcV7oQPJkl9QevSCWr3W6A=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600&display=swap" rel="stylesheet">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.lineicons.com/4.0/lineicons.css" rel="stylesheet" />

    <head>
        <!-- Other head elements -->
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

        <!-- Calendar cdn-->
        <link href="https://cdn.jsdelivr.net/npm/fullcalendar@6.1.6/index.global.min.css" rel="stylesheet">

        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,700;1,900&display=swap" rel="stylesheet">

        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
        <link href="https://cdn.lineicons.com/4.0/lineicons.css" rel="stylesheet" />

        <head>
            <!-- Other head elements -->
            <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

            <!-- Calendar cdn-->
            <link href="https://cdn.jsdelivr.net/npm/fullcalendar@6.1.6/index.global.min.css" rel="stylesheet">
        </head>

    <body>
        <header>
            <div class="hamburger" id="hamburger">
                <div></div>
                <div></div>
                <div></div>
            </div>
            <nav>
                <ul>
                    <li>
                        <a href="../../App/View/employee_home.php" class="sedp-link" style="display: flex; align-items: center;">
                            <?php include("svg.php"); ?>
                            <h4 style="padding-right: 20px; margin: 0;
            font-size: 16px;
            font-weight: 700;
            padding-bottom: -10px;">SEDP HRMS</h4>
                        </a>
                    </li>
                    <li class="home <?php echo ($page === 'employee home') ? 'active' : ''; ?>">
                        <a href="../../App/View/employee_home.php">Home</a>
                    </li>
                </ul>
                <div class="profile">
                    <a href="#" id="notification-link"><i class="fa-solid fa-bell"></i></a>
                    <img src="../../Public/Assets/Images/profile.jpg" alt="Profile" id="profile-img">
                    <i class="fa-solid fa-angle-down" id="dropdown-toggle" style="color: #fff;"></i>
                    <div class="dropdown-menu" id="dropdown-menu">
                        <a href="../../App/View/employee_profile.php"><i class="fa-solid fa-user"></i>&nbsp;Profile</a>
                        <a href="#"><i class="fa-solid fa-gear"></i>&nbsp;Settings</a>
                        <a href="../../../Assets/logout.php"><i class="fa-solid fa-sign-out-alt"></i>&nbsp;Logout</a>
                    </div>
                </div>
            </nav>
        </header>

        <!-- Notification Modal -->
        <div class="modal fade" id="notificationModal" tabindex="-1" aria-labelledby="notificationModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="notificationModalLabel">Notifications</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <ul class="list-group">
                            <li class="list-group-item">Notification 1</li>
                            <li class="list-group-item">Notification 2</li>
                            <li class="list-group-item">Notification 3</li>
                            <!-- Add more notifications as needed -->
                        </ul>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    </div>
                </div>
            </div>
        </div>

        <script>
            // Dropdown toggle functionality
            const dropdownToggle = document.getElementById('dropdown-toggle');
            const profileImg = document.getElementById('profile-img');
            const dropdownMenu = document.getElementById('dropdown-menu');
            const hamburger = document.getElementById('hamburger');

            function toggleDropdown() {
                dropdownToggle.classList.toggle('active');
                dropdownMenu.classList.toggle('active');
            }

            dropdownToggle.addEventListener('click', toggleDropdown);
            profileImg.addEventListener('click', toggleDropdown);

            // Hamburger toggle functionality for mobile
            hamburger.addEventListener('click', function() {
                hamburger.classList.toggle('active');
            });

            // Notification modal toggle functionality
            const notificationIcon = document.querySelector('.fa-bell');
            notificationIcon.addEventListener('click', function() {
                const notificationModal = new bootstrap.Modal(document.getElementById('notificationModal'));
                notificationModal.show();
            });
        </script>

        <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.min.js"></script>

    </body>

</html>