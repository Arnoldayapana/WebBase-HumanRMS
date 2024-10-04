            <!--successMessage-->
            <?php
            if (isset($_GET['msg'])) {
                $msg = $_GET['msg'];
                echo '
                    <div class="alert alert-primary alert-dismissible fade show mt-2" role="alert">
                    ' . $msg . '
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>';
            }
            ?>

            <!--successMessage-->
            <?php
            if (isset($_GET['error_msg'])) {
                $error_msg = $_GET['error_msg'];
                echo '
                    <div class="alert alert-warning alert-dismissible fade show mt-2" role="alert">
                    ' . $error_msg . '
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>';
            }
            ?>