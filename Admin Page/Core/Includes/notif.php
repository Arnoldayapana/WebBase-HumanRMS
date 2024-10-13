<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Notification Dropdown</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Bootstrap Icons -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-icons/1.8.1/font/bootstrap-icons.min.css" rel="stylesheet">
    <style>
        .notification-container {
            position: relative;
            display: inline-block;
        }

        /* Notification dropdown styling */
        .notification-dropdown {
            display: none;
            position: absolute;
            right: 0;
            top: 50px;
            width: 300px;
            background-color: white;
            border: 1px solid #ccc;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            z-index: 1;
        }

        .notification-dropdown:before {
            content: '';
            position: absolute;
            top: -10px;
            right: 20px;
            border-width: 10px;
            border-style: solid;
            border-color: transparent transparent white transparent;
        }

        .notification-header {
            padding: 10px;
            border-bottom: 1px solid #ccc;
            font-weight: bold;
        }

        .no-notifications {
            text-align: center;
            padding: 20px;
            color: #888;
        }

        /* Profile image */
        .profile-img {
            height: 40px;
            width: 40px;
            border-radius: 50%;
        }

        /* Dropdown and hover effect */
        .list-group-item-action:hover {
            background-color: #003c3c;
            color: white;
        }
    </style>
</head>

<body>
    <div class="container-fluid shadow-sm mb-4 bg-body-tertiary rounded">
        <nav class="navbar navbar-expand-lg bg-body-tertiary">
            <a class="navbar-brand fs-4 fw-bold mx-2" href="#" style="color: #003c3c;">My Website</a>

            <div class="d-flex align-items-center ms-auto">
                <!-- Notification Bell -->
                <div class="notification-container">
                    <i class="bi bi-bell-fill notification-icon" style="font-size: 1.5rem; cursor: pointer;"></i>
                    <!-- Dropdown Notification Menu -->
                    <div class="notification-dropdown">
                        <div class="notification-header">Notifications</div>
                        <div class="no-notifications">
                            <img src="https://via.placeholder.com/150" alt="No Notifications" style="width: 100px; display: block; margin: 0 auto;">
                            <p>No notifications available!</p>
                        </div>
                    </div>
                </div>

                <!-- Calendar -->
                <div class="d-flex align-items-center shadow-sm" style="height: 40px; width: 170px; background-color: #fff; border-radius: 12px; padding-left: 6px; margin-left: 10px;">
                    <i class="bi bi-calendar2-week me-2" style="font-size: 1.3rem; color: #003c3c;"></i>
                    <span id="currentDate" class="fs-6 fw-bold" style="color: #003c3c;"></span>
                </div>

                <!-- Profile Image -->
                <div class="profile-container ms-3">
                    <img src="profile.jpg" alt="Profile Image" class="profile-img">
                </div>
            </div>
        </nav>
    </div>

    <!-- Bootstrap JS and JavaScript -->
    <script>
        // Show or hide the dropdown
        const notificationIcon = document.querySelector('.notification-icon');
        const notificationDropdown = document.querySelector('.notification-dropdown');

        notificationIcon.addEventListener('click', function() {
            notificationDropdown.style.display = notificationDropdown.style.display === 'block' ? 'none' : 'block';
        });

        // Close the dropdown if clicked outside
        document.addEventListener('click', function(event) {
            if (!notificationIcon.contains(event.target) && !notificationDropdown.contains(event.target)) {
                notificationDropdown.style.display = 'none';
            }
        });

        // Display current date
        const date = new Date();
        const options = {
            month: 'long',
            day: 'numeric',
            year: 'numeric'
        };
        document.getElementById('currentDate').innerText = date.toLocaleDateString(undefined, options);
    </script>

    <!-- Bootstrap Bundle JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>