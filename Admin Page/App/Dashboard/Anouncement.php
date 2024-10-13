<?php
// Initialize variables to avoid undefined variable issue
$content = "";
?>

<div class="col-lg-6 col-md-6 col-sm-6 mb-3 mt-2">
    <div class="container m-0 ms-2 p-4">
        <form action="../Dao/Announcement-db/announcement_db.php" method="POST">
            <h1>Create announcements!</h1>
            <p class="ms-2 text-secondary">Connect with others!</p>
            <div class="form-floating mb-3">
                <input type="text" required class="form-control" id="title" name="title" placeholder="title here!">
                <label for="title">Title</label>
            </div>
            <div class="form-floating mb-2">
                <textarea class="form-control" rows="3" required name="content" placeholder="Leave a comment here" id="content" style="height: 100px"><?php echo htmlspecialchars($content); ?></textarea>
                <label for="content">What's on your mind?</label>
            </div>
            <div class="d-flex flex-row-reverse me-2">
                <button type="submit" class="btn text-white btn-md" style="background-color: #003c3c;">Post</button>
            </div>
        </form>
    </div>
</div>