<?php 
session_start();

if (!isset($_SESSION["username"])) {
    header("location:../../index.php");
    exit();
}

$username = $_SESSION['username'];
if (strpos($username, '@') !== false) {
    $username = explode('@', $username)[0];
}


$possibleNames = preg_split('/[._]/', $username);

if (preg_match('/([a-z]+)([A-Z][a-z]+)/', $username)) {
    
    $firstName = preg_replace('/([a-z])([A-Z])/', '$1 $2', $username); 
    $firstName = explode(' ', $firstName)[0];
} elseif (count($possibleNames) > 1) {
  
    $firstName = $possibleNames[0];
} else {
    
    $firstName = $username;
}


$firstName = ucfirst(strtolower($firstName));



$title = 'Scholar Home | SEDP HRMS';
$page = 'home';
include('../../Core/Includes/header.php');
?>

<style>
    .custom-list-group-item {
    display: flex;
    justify-content: space-between;
    align-items: center;
}
.progress-bar {
    background-color: #003c3c;
}

</style>
</head>
<body>

<div class="container">
    <div class="row" style="margin-top: 5.5rem;">
        <div class="col-md-4">
            <div class="dashboard-card">
                <div class="icon-section-title">
                    <i class="lni lni-graduation"></i>
                    <span style="font-weight: 700; font-size: 25px;" >Good Day, <?php echo $firstName; ?>!</span>
                </div>
                <span style="padding-left: 2.3rem; font-weight: 600; font-size: 16px;">Welcome Back!</span>
            </div>

            <div class="dashboard-card">
                <h5 class="section-title">Academic Performance Overview</h5>
                <div class="progress">
                    <div class="progress-bar" role="progressbar" style="width: 80%;" aria-valuenow="80" aria-valuemin="0" aria-valuemax="100">80%</div>
                </div>
                <p class="mt-2">GPA: 3.8 / 4.0</p>
            </div>

            <div class="dashboard-card">
                <h5 class="section-title">Calendar</h5>
                <div id="calendar" class="event-calendar" style="background-color: #003c3c; color: #fff;"></div>
            </div>

        </div>

        <div class="col-md-8">
            <div class="dashboard-card" style="height: 330px; position: relative;">
                <div class="custom-card-header bg-white shadow rounded border-dark">
                <div class="admin-profile">
                        <img src="../../Public/Assets/Images/profile.jpg" alt="Admin Profile"> <!-- Replace with actual image path -->
                        <div>
                            <strong style="font-size: 20px;">System Administrator</strong><br>
                            <small class="text-muted" style="font-size: 10px;">1 minute ago</small>
                        </div>
                    </div>
                    <span class="floating-announcement" >Announcement</span>
                </div>
                <div class="announcement shadow rounded p-2 mt-3 bg-white">                    
                    <p>Upcoming seminar on career development on October 5th.</p>
                    <p>Financial aid disbursement due on October 10th.</p>
                </div>
            </div>

            <div class="dashboard-card">
                <h5 class="section-title">INC Requirements Tracker</h5>
                <ul class="list-group">
                    <li class="list-group-item custom-list-group-item">Submit transcript <i class="fas fa-check-circle"></i></li>
                    <li class="list-group-item custom-list-group-item">Register for courses <i class="fas fa-check-circle"></i></li>
                    <li class="list-group-item custom-list-group-item">Schedule advisor meeting <i class="fas fa-check-circle"></i></li>
                    <li class="list-group-item custom-list-group-item">Submit transcript <i class="fas fa-check-circle"></i></li>
                    <li class="list-group-item custom-list-group-item">Register for courses <i class="fas fa-check-circle"></i></li>
                    <li class="list-group-item custom-list-group-item">Schedule advisor meeting <i class="fas fa-check-circle"></i></li>
                </ul>
            </div>
        </div>
    </div>

    <div class="col-md-12 shadow rounded p-4 mb-4" style="background-color: #f0f9f9;">
        <h5 class="text-center" style="color: #003c3c; font-weight: bold; letter-spacing: 1px;">User Activity Over Time</h5>
        <canvas id="userActivityChart"></canvas>
    </div>

</div>
<div class="container-fluid bg-dark text-center text-light" style="padding: 10px 0;">
    <div class="footer-content" style="min-height: 100px; line-height: 30px;">
        <p class="mb-2">&copy; 2024 Your Organization. All Rights Reserved.</p>
        
        <ul class="list-inline mb-2">
            <li class="list-inline-item"><a href="https://sedp.ph/about-us/" class="text-light">About Us</a></li>
            <li class="list-inline-item"><a href="https://sedp.ph/services/" class="text-light">Services</a></li>
            <li class="list-inline-item"><a href="/privacy-policy" class="text-light">Privacy Policy</a></li>
            <li class="list-inline-item"><a href="/terms-of-service" class="text-light">Terms of Service</a></li>
        </ul>
        
        <p class="mb-2">Contact Us: <a href="mailto:simbag_sedp@yahoo.com" class="text-light">simbag_sedp@yahoo.com</a></p>
        
        <div class="social-media-links mb-2">
            <a href="https://web.facebook.com/sedp.ph" target="_blank" class="mx-2 text-light"><i class="fa fa-facebook"></i></a>
            <a href="https://twitter.com/yourprofile" class="mx-2 text-light"><i class="fa fa-twitter"></i></a>
            <a href="https://linkedin.com/in/yourprofile" class="mx-2 text-light"><i class="fa fa-linkedin"></i></a>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/fullcalendar@6.1.6/index.global.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
<script src="../../Public/Assets/Js/lineGraph.js"></script>
<script src="../../Public/Assets/Js/calendar.js"></script>

</script>
</body>
</html>