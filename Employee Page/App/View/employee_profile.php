<?php
$title = 'Employee Profile | SEDP HRMS';
$page = 'employee_profile';
include('../../Core/Includes/header.php');
?>

<div class="main-container shadow-sm p-4" style="margin: 5.5rem 7% 0;">
    <div class="row justify-content-center">
        <div class="col-md-3 d-flex justify-content-center align-items-center">
            <img src="../../Public/Assets/Images/profile.jpg" alt="Scholar Profile Picture" class="img-fluid rounded-circle shadow" style="width: 200px; height: 200px; object-fit: cover;">
        </div>
        <div class="col-md-9 d-flex flex-column justify-content-center">
            <h2 class="font-weight-bold text-dark">Jerick Navales</h2>
            <h5 class="text-muted">Employee</h5>
        </div>
    </div>

    <div class="row mt-4">
        <div class="col-md-12 d-flex justify-content-between align-items-center" style="padding: 10px;">
            <div class="options">
                <div class="btn-group" role="group" aria-label="Options">
                    <button type="button" class="btn btn-link text-dark option-btn" onclick="changeContent('personal')">Personal Info</button>
                    <button type="button" class="btn btn-link text-dark option-btn" onclick="changeContent('account')">Account Info</button>
                    <button type="button" class="btn btn-link text-dark option-btn" onclick="changeContent('change-password')">Change Password</button>
                </div>
            </div>
        </div>
    </div>

    <div class="content-item personal active">
        <div class="row mt-3" style="background-color: #003c3c; padding: 15px; border-radius: 5px;">
            <div class="col-md-12">
                <h4 class="font-weight-bold text-white d-flex justify-content-between align-items-center">
                    Personal Information
                    <button class="btn btn-warning" id="editPersonalInfoBtn" onclick="toggleEdit()">Edit</button>
                </h4>
                <div class="row">
                    <div class="col-md-3 d-flex justify-content-center align-items-start flex-column">
                        <img src="../../Public/Assets/Images/profile.jpg" alt="Scholar Profile Picture" class="img-fluid rounded-circle shadow" style="width: 140px; height: 140px; object-fit: cover;">
                        <button class="btn btn-primary mt-2">Change Profile Picture</button>
                    </div>
                    <div class="col-md-9 text-white">
                        <div class="row mb-3">
                            <div class="col-md-4">
                                <label for="fullName" class="font-weight-bold">Full Name:</label>
                                <p id="fullName" class="editable">Jerick Navales</p>
                                <input type="text" id="fullNameInput" class="form-control" style="display:none;" value="Jerick Navales">
                            </div>
                            <div class="col-md-4">
                                <label for="email" class="font-weight-bold">Email Address:</label>
                                <p id="email" class="editable">jericknavales@sorsu.edu.ph</p>
                                <input type="email" id="emailInput" class="form-control" style="display:none;" value="jericknavales@sorsu.edu.ph">
                            </div>
                            <div class="col-md-4">
                                <label for="address" class="font-weight-bold">Address:</label>
                                <p id="address" class="editable">123 Main St, City, Country</p>
                                <input type="text" id="addressInput" class="form-control" style="display:none;" value="123 Main St, City, Country">
                            </div>
                        </div>
                        <div class="row mb-3">
                            <div class="col-md-4">
                                <label for="contactNumber" class="font-weight-bold">Contact Number:</label>
                                <p id="contactNumber" class="editable">+1234567890</p>
                                <input type="text" id="contactNumberInput" class="form-control" style="display:none;" value="+1234567890">
                            </div>
                            <div class="col-md-4">
                                <label for="dob" class="font-weight-bold">Date of Birth:</label>
                                <p id="dob" class="editable">01/01/2002</p>
                                <input type="date" id="dobInput" class="form-control" style="display:none;" value="2002-01-01">
                            </div>
                            <div class="col-md-4">
                                <label for="nationality" class="font-weight-bold">Nationality:</label>
                                <p id="nationality" class="editable">Country</p>
                                <input type="text" id="nationalityInput" class="form-control" style="display:none;" value="Country">
                            </div>
                        </div>
                        <div class="row mb-3">
                            <div class="col-md-4">
                                <label for="maritalStatus" class="font-weight-bold">Marital Status:</label>
                                <p id="maritalStatus" class="editable">Single</p>
                                <input type="text" id="maritalStatusInput" class="form-control" style="display:none;" value="Single">
                            </div>
                            <div class="col-md-4">
                                <label for="gender" class="font-weight-bold">Gender:</label>
                                <p id="gender" class="editable">Male</p>
                                <input type="text" id="genderInput" class="form-control" style="display:none;" value="Male">
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Save button is part of the Edit button now -->
            </div>
        </div>
    </div>

    <div class="content-item account">
        <div class="row mt-3" style="background-color: #003c3c; padding: 15px; border-radius: 5px;">
            <div class="col-md-12">
                <h4 class="font-weight-bold text-white">Account Information</h4>
                <div class="row mb-3">
                    <div class="col-md-4">
                        <label for="username" class="font-weight-bold text-light">Username:</label>
                        <p id="username" class="text-light">Jerick Navales</p>
                    </div>
                    <div class="col-md-4">
                        <label for="registrationDate" class="font-weight-bold text-light">Registration Date:</label>
                        <p id="registrationDate" class="text-light">01/01/2002</p>
                    </div>
                    <div class="col-md-4">
                        <label for="registrationDate" class="font-weight-bold text-light">Registration Date:</label>
                        <p id="registrationDate" class="text-light">01/01/2002</p>
                    </div>
                </div>
                <div class="row mb-3">
                    <div class="col-md-4">
                        <label for="lastLogin" class="font-weight-bold text-light">Last Login:</label>
                        <p id="lastLogin" class="text-light">01/01/202</p>
                    </div>
                    <div class="col-md-4">
                        <label for="lastLogin" class="font-weight-bold text-light">Last Login:</label>
                        <p id="lastLogin" class="text-light">01/01/202</p>
                    </div>
                    <div class="col-md-4">
                        <label for="registrationDate" class="font-weight-bold text-light">Registration Date:</label>
                        <p id="registrationDate" class="text-light">01/01/2002</p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="content-item change-password">
        <div class="row mt-3" style="background-color: #003c3c; padding: 15px; border-radius: 5px;">
            <div class="col-md-12 ">
                <h4 class="font-weight-bold text-white">Change Password</h4>
                <div class="mb-3">
                    <label for="currentPassword" class="font-weight-bold text-light">Current Password:</label>
                    <input type="password" class="form-control w-50" id="currentPassword" placeholder="Enter current password">
                </div>
                <div class="mb-3">
                    <label for="newPassword" class="font-weight-bold text-light">New Password:</label>
                    <input type="password" class="form-control w-50" id="newPassword" placeholder="Enter new password">
                </div>
                <div class="mb-3">
                    <label for="confirmPassword" class="font-weight-bold text-light">Confirm Password:</label>
                    <input type="password" class="form-control w-50" id="confirmPassword" placeholder="Confirm new password">
                </div>
                <button class="btn btn-success">Change Password</button>
            </div>
        </div>
    </div>
</div>

<!-- CSS Styles for Amazing Underline Effect -->
<style>
    .option-btn {
        position: relative;
        text-decoration: none;
        padding: 0;
        margin: 0 15px;
        font-family: 'Arial', sans-serif;
        color: #333;
        font-weight: bold;
    }

    .option-btn::after {
        content: '';
        position: absolute;
        left: 0;
        bottom: -5px;
        height: 3px;
        border-radius: 3px;
        width: 100%;
        background: linear-gradient(90deg, #003c3c, #026f6f);
        transform: scaleX(0);
        transition: transform 0.3s ease;
    }

    .option-btn:hover::after {
        transform: scaleX(1);
    }

    .content-item {
        display: none;
    }

    .content-item.active {
        display: block;
    }

    .editable {
        cursor: pointer;
    }

    .form-control {
        display: block;
        width: 100%;
        padding: 0.5rem .75rem;
    }
</style>

<!-- JavaScript for changing content and editing personal info -->
<script>
    function changeContent(content) {
        document.querySelectorAll('.content-item').forEach(item => {
            item.classList.remove('active');
        });
        document.querySelector(`.content-item.${content}`).classList.add('active');
    }

    function toggleEdit() {
        const editBtn = document.getElementById('editPersonalInfoBtn');
        const editableFields = document.querySelectorAll('.editable');
        const inputFields = document.querySelectorAll('input[type="text"], input[type="email"], input[type="date"]');

        const isEditing = editBtn.textContent === 'Save';

        editableFields.forEach(field => {
            field.style.display = isEditing ? 'block' : 'none';
        });

        inputFields.forEach(field => {
            field.style.display = isEditing ? 'none' : 'block';
        });

        editBtn.textContent = isEditing ? 'Edit' : 'Save';

        if (isEditing) {
            savePersonalInfo();
        }
    }

    function savePersonalInfo() {
        const editableFields = document.querySelectorAll('.editable');
        const inputFields = document.querySelectorAll('input[type="text"], input[type="email"], input[type="date"]');

        inputFields.forEach((input, index) => {
            const editableField = editableFields[index];
            editableField.textContent = input.value;
        });
    }
</script>

<?php
include('../../Core/Includes/footer.php');
?>