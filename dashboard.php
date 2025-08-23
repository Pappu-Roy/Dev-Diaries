<?php
include 'config.php';
include 'includes/header.php';

// Check if the user is NOT logged in
if (!isset($_SESSION['user_id'])) {
    redirect('admin.php');
}

// Fetch all posts for the dashboard
$sql = "SELECT id, title, content, created_at FROM posts ORDER BY created_at DESC";
$result = $conn->query($sql);
?>
<div class="container mx-auto p-4 md:p-8">
    <header class="flex justify-between items-center mb-8 pb-4 border-b-2 border-gray-300">
        <h1 class="text-3xl font-bold text-gray-800">Admin Dashboard</h1>
        <a href="create.php" class="py-2 px-4 bg-green-500 text-white rounded-md hover:bg-green-600 transition-colors duration-300">Create New Post</a>
    </header>

    <div class="bg-white rounded-lg shadow-xl overflow-hidden">
        <table class="min-w-full divide-y divide-gray-200">
            <thead class="bg-gray-50">
                <tr>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">ID</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Title</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Created At</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Actions</th>
                </tr>
            </thead>
            <tbody class="bg-white divide-y divide-gray-200">
                <?php
                if ($result->num_rows > 0) {
                    while($row = $result->fetch_assoc()) {
                        echo "<tr>";
                        echo "<td class='px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900'>" . $row['id'] . "</td>";
                        echo "<td class='px-6 py-4 whitespace-nowrap text-sm text-gray-500'>" . htmlspecialchars($row['title']) . "</td>";
                        echo "<td class='px-6 py-4 whitespace-nowrap text-sm text-gray-500'>" . date("F j, Y", strtotime($row['created_at'])) . "</td>";
                        echo "<td class='px-6 py-4 whitespace-nowrap text-sm font-medium'>";
                        echo "<a href='edit.php?id=" . $row['id'] . "' class='text-indigo-600 hover:text-indigo-900 mr-4'>Edit</a>";
                        echo "<a href='delete.php?id=" . $row['id'] . "' class='text-red-600 hover:text-red-900' onclick=\"return confirm('Are you sure you want to delete this post?');\">Delete</a>";
                        echo "</td>";
                        echo "</tr>";
                    }
                } else {
                    echo "<tr><td colspan='4' class='px-6 py-4 text-center text-gray-500'>No posts found.</td></tr>";
                }
                ?>
            </tbody>
        </table>
    </div>
</div>
<?php
include 'includes/footer.php';
?>
