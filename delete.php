<?php
include 'config.php';

if (!isset($_SESSION['user_id'])) {
    redirect('admin.php');
}

if (isset($_GET['id'])) {
    $id = $conn->real_escape_string($_GET['id']);
    $sql = "DELETE FROM posts WHERE id='$id'";
    $conn->query($sql);
}

redirect('dashboard.php');
?>
