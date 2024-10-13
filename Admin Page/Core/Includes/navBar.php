<div class="container-fluid shadow-sm mb-4 bg-body-tertiary rounded">
    <nav class="navbar navbar-expand-lg bg-body-tertiary">
        <a class="navbar-brand fs-4 fw-bold mx-2" href="#" style="color: #003c3c;">Simbag sa Pag-Asenso Inc.</a>

        <!-- Notification Bell and Calendar Layout aligned horizontally and left of profile image -->
        <div class="d-flex align-items-center ms-auto">
            <div class="profile position-relative d-flex align-items-center gap-2">
                <!--<a href="#"><i class="bi bi-app-indicator" style="font-size: 1.5rem; color: #003c3c;"></i></a>-->
                <div class="notification-container">
                    <i class="bi bi-app-indicator notification-icon" style="font-size:  1.5rem; cursor: pointer; color: #003c3c;"></i>
                    <!-- Dropdown Notification Menu -->
                    <div class="notification-dropdown">
                        <div class="notification-header">Notifications</div>
                        <div class="no-notifications">
                            <img src="../../Public/Assets/Images/notif.png" alt="No Notifications" style="width: 300px; display: block; margin: 0 auto;">
                            <p>No notifications available!</p>
                        </div>
                    </div>
                </div>




                <!-- Calendar Layout -->
                <div class="d-flex align-items-center shadow-sm" style="height: 40px; width: 170px; background-color: #fff; border-radius: 12px; padding-left: 6px;">
                    <i class="bi bi-calendar2-week me-2" style="font-size: 1.3rem; color: #003c3c;"></i> <!-- Calendar Icon -->
                    <span id="currentDate" class="fs-6 fw-bold" style="color: #003c3c;"></span> <!-- Date -->
                </div>

                <!-- Profile Image and Dropdown -->
                <img src="../../public/assets/images/profile.jpg" style="height: 40px;" class="rounded-circle" alt="profile" id="profile-img">
                <i class="bi bi-chevron-down" id="dropdown-toggle" style="color: #000000;"></i>

                <!-- Dropdown Menu -->
                <div class="dropdown-menu p-2 m-2" id="dropdown-menu" style="display: none; position: absolute; top: 50px; right: 0; background-color: white; box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1); border-radius: 8px;">
                    <a href="../../App/View/scholar_profile.php" class="list-group-item list-group-item-action p-2"><i class="bi bi-person"></i>&nbsp;Profile</a>
                    <a href="#" class="list-group-item list-group-item-action p-2"><i class="bi bi-gear"></i>&nbsp;Settings</a>
                    <a href="../../../Assets/logout.php" class="list-group-item list-group-item-action p-2"><i class="bi bi-box-arrow-right"></i>&nbsp;Logout</a>
                </div>
            </div>
        </div>

        <!-- Hamburger for Mobile -->
        <button class="navbar-toggler" type="button" id="hamburger" data-bs-toggle="collapse" data-bs-target="#navbarContent">
            <span class="navbar-toggler-icon"></span>
        </button>

        <style>
            /* Hover effect for dropdown items */
            .list-group-item-action:hover {
                background-color: #003c3c;
                color: white;
            }
        </style>
    </nav>
</div>
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
        top: 55px;
        width: 420px;
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
</style>


<script>
    // Dropdown toggle functionality
    const dropdownToggle = document.getElementById('dropdown-toggle');
    const profileImg = document.getElementById('profile-img');
    const dropdownMenu = document.getElementById('dropdown-menu');
    const hamburger = document.getElementById('hamburger');

    // Toggle the dropdown when the profile image or chevron is clicked
    function toggleDropdown() {
        dropdownMenu.style.display = dropdownMenu.style.display === 'block' ? 'none' : 'block';
    }

    // Close dropdown when clicking outside of it
    function closeDropdownOnOutsideClick(event) {
        if (!dropdownMenu.contains(event.target) && !profileImg.contains(event.target) && !dropdownToggle.contains(event.target)) {
            dropdownMenu.style.display = 'none';
        }
    }

    dropdownToggle.addEventListener('click', toggleDropdown);
    profileImg.addEventListener('click', toggleDropdown);

    // Listen for clicks outside the dropdown to close it
    document.addEventListener('click', closeDropdownOnOutsideClick);

    // Prevent default behavior for any direct clicks inside the dropdown
    dropdownMenu.addEventListener('click', function(event) {
        event.stopPropagation();
    });

    // Hamburger toggle functionality for mobile
    hamburger.addEventListener('click', function() {
        hamburger.classList.toggle('active');
    });
</script>

<script>
    // JavaScript to dynamically display the current date
    const date = new Date();
    const options = {
        month: 'long',
        day: 'numeric',
        year: 'numeric'
    };
    document.getElementById('currentDate').innerText = date.toLocaleDateString(undefined, options);
</script>
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
</script>