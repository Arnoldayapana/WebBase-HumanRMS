<?php
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (isset($_POST["branch_id"])) {
        $branch_id = $_POST["branch_id"];

        // Connections
        include("../../../../Database/db.php");

        // Step 1: Delete the record with the specified branch_id
        $sql = "DELETE FROM branches WHERE branch_id = ?";
        $stmt = $connection->prepare($sql);
        $stmt->bind_param("i", $branch_id);
        $stmt->execute();

        if ($stmt->affected_rows > 0) {
            // Renumber IDs after deletion
            // Step 2: Set a session variable to renumber the IDs
            $sql_reorder = "SET @new_id = 0";
            $connection->query($sql_reorder);

            // Step 3: Renumber remaining IDs
            $sql_update_ids = "UPDATE branches SET branch_id = (@new_id := @new_id + 1) ORDER BY branch_id";
            $connection->query($sql_update_ids);

            // Step 4: Reset the AUTO_INCREMENT value
            $sql_reset_ai = "ALTER TABLE branches AUTO_INCREMENT = 1";
            $connection->query($sql_reset_ai);
        } else {
            header("location:../../View/Branch.php?error_msg=Failed to delete Branch!");
        }

        $stmt->close();
        $connection->close();

        // Redirect back to Branch.php
        header("location:../../View/Branch.php?msg=Branch deleted successfully!");
        exit;
    }
}
