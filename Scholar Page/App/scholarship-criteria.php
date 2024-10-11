<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Scholarship-criteria page</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">
    <script src="https://kit.fontawesome.com/689f460c4e.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">

    <!--fonts-->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">
</head>

<body>
    <style>
        body {
            font-family: 'poppins', sans-serif;
        }

        .navbar ul li {
            font-family: 500px;
        }

        .criteria-container {
            /* From https://css.glass */
            background: rgba(255, 255, 255, 0.09);
            border-radius: 16px;
            box-shadow: 0 4px 30px rgba(0, 0, 0, 0.1);
            backdrop-filter: blur(3.2px);
            -webkit-backdrop-filter: blur(3.2px);
            border: 1px solid rgba(255, 255, 255, 0.37);
        }
    </style>
    <!--Nav-->
    <nav class="navbar navbar-expand-lg navbar-light bg-gradient bg-opacity-75" style="background-color: #003c3c;">
        <div class="container d-flex mb-1">
            <a class="navbar-brand text-white align-text-center fw-bolder fs-5" href="../index.php">
                SEDP Simbag Sa Pag-Asenso Inc.
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navmenu">
                <span class="navbar-toggler-icon"></span>
            </button>
        </div>
    </nav>
    <!--Nav ends-->
    <section id="criteria " class="my-2 m-3">
        <div class="container ">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="../../index.php">Home</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Scholarship Criteria</li>
                </ol>
            </nav>
        </div>

        <?php
        include '../models/ScholarCriteria/ScholarCriteria.php';
        ?>
    </section>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>


</body>

</html>