<?php
include 'config.php';
include 'includes/header.php';

// Check if the user is already logged in
if (isset($_SESSION['user_id'])) {
    redirect('dashboard.php');
}

$error = '';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $conn->real_escape_string($_POST['username']);
    $password = $_POST['password'];

    // In a real application, use password_hash() and password_verify()
    $sql = "SELECT id FROM admin_users WHERE username = '$username' AND password = '$password'";
    $result = $conn->query($sql);

    if ($result->num_rows == 1) {
        $user = $result->fetch_assoc();
        $_SESSION['user_id'] = $user['id'];
        redirect('dashboard.php');
    } else {
        $error = "Invalid username or password.";
    }
}
?>
<div class="w-full max-w-md p-8 space-y-6 bg-white rounded-xl shadow-2xl mx-auto">
    <h2 class="text-3xl font-bold text-center text-blue-600">Admin Login</h2>
    <?php if ($error): ?>
        <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative" role="alert">
            <span class="block sm:inline"><?php echo $error; ?></span>
        </div>
    <?php endif; ?>
    <form action="admin.php" method="post" class="space-y-4">
        <div>
            <label for="username" class="sr-only">Username</label>
            <input type="text" name="username" id="username" class="w-full px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500" placeholder="Username" required>
        </div>
        <div>
            <label for="password" class="sr-only">Password</label>
            <input type="password" name="password" id="password" class="w-full px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500" placeholder="Password" required>
        </div>
        <button type="submit" class="w-full py-2 px-4 bg-blue-600 text-white font-semibold rounded-md hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2">
            Log In
        </button>
    </form>
</div>
<?php
include 'includes/footer.php';
?>
