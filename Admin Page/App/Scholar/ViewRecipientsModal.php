<?php
echo "
    <div class='modal fade' id='$ViewId' tabindex='-1' aria-labelledby='viewRecipientLabel' aria-hidden='true'>
        <div class='modal-dialog modal-fullscreen modal-dialog-scrollable'>
            <div class='modal-content rounded' style='width: 70%; height: auto;'>
                <div class='modal-header'>
                    <h5 class='modal-title' id='viewRecipientLabel'>Applicant Information</h5>
                    <button type='button' class='btn-close' data-bs-dismiss='modal' aria-label='Close'></button>
                </div>
                <div class='modal-body'>
                    <div class='row mb-2 mx-2'>
                        <div class='col-md-4'>
                            <h1 class='fs-6 fw-semi-bold'>Full Name :</h1>
                            <p>{$row['name']}</p>
                        </div>
                        <div class='col-md-4'>
                            <h1 class='fs-6 fw-semi-bold'>Email Address :</h1>
                            <p>{$row['email']}</p>
                        </div>
                        <div class='col-md-4'>
                            <h1 class='fs-6 fw-semi-bold'>School :</h1>
                            <p>{$row['school']}</p>
                        </div>
                    </div>
    
                    <div class='row mb-2 mx-2'>
                        <div class='col-md-4'>
                            <h1 class='fs-6 fw-semi-bold'>Contact Number :</h1>
                            <p>{$row['contact']}</p>
                        </div>
                        <div class='col-md-4'>
                            <h1 class='fs-6 fw-semi-bold'>Grade Level :</h1>
                            <p>{$row['GradeLevel']}</p>
                        </div>
                        <div class='col-md-4'>
                            <h1 class='fs-6 fw-semi-bold'>Applied Date :</h1>
                            <p>{$row['admission_date']}</p>
                        </div>
                    </div>
                </div>
                <div class='modal-footer'>
                    <button type='button' class='btn btn-outline-secondary' data-bs-dismiss='modal'>Cancel</button>
                </div>
            </div>
        </div>
    </div>";
