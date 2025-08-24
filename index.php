<?php
include 'config.php';
include 'includes/header.php';

$category = null;
if (isset($_GET['category']) && in_array($_GET['category'], ['Science', 'Technology', 'Programming', 'News'])) {
    // Use prepared statements to prevent SQL injection for security
    $stmt = $conn->prepare("SELECT id, title, content, category, created_at FROM posts WHERE category = ? ORDER BY created_at DESC");
    $stmt->bind_param("s", $_GET['category']);
    $stmt->execute();
    $result = $stmt->get_result();
    $category = htmlspecialchars($_GET['category']);
} else {
    $sql = "SELECT id, title, content, category, created_at FROM posts ORDER BY created_at DESC";
    $result = $conn->query($sql);
}
?>
<div class="container mx-auto p-4 md:p-8">
    <header class="text-center mb-12">
        <h1 class="text-4xl md:text-6xl font-extrabold text-blue-800 tracking-tight">
            <?php echo ($category) ? htmlspecialchars($category) . " Posts" : "Our Latest Posts"; ?>
        </h1>
        <p class="text-violet-800 mt-2"><b>Dev Diaries</b></p>
    </header>

    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
        <?php
        if ($result->num_rows > 0) {
            while($row = $result->fetch_assoc()) {
                // Sanitize content for preview
                // First, remove HTML tags to avoid rendering them.
                $preview_content = strip_tags($row['content']);
                // Second, decode HTML entities like '&nbsp;' into a regular space.
                $preview_content = html_entity_decode($preview_content);
                // Finally, truncate the content for a clean preview.
                $preview_content = substr($preview_content, 0, 150) . '...';
                
                echo "<a href='post.php?id=" . $row['id'] . "' class='block bg-white rounded-lg shadow-lg overflow-hidden transition-transform duration-300 hover:scale-105 hover:shadow-2xl'>";
                echo "<div class='p-6'>";
                echo "<div class='flex justify-between items-center mb-2'>";
                echo "<h2 class='text-2xl font-bold text-gray-800'>" . htmlspecialchars($row['title']) . "</h2>";
                echo "<span class='text-xs font-semibold px-2 py-1 rounded-full text-white bg-blue-500'>" . htmlspecialchars($row['category']) . "</span>";
                echo "</div>";
                echo "<p class='text-sm text-gray-500 mb-4'>" . date("F j, Y, g:i a", strtotime($row['created_at'])) . "</p>";
                echo "<p class='text-gray-700 leading-relaxed'>" . htmlspecialchars($preview_content) . "</p>";
                echo "</div>";
                echo "</a>";
            }
        } else {
            echo "<p class='text-center text-gray-600 col-span-full'>No blog posts found in this category.</p>";
        }
        
        // Close the prepared statement if it was used
        if (isset($stmt)) {
            $stmt->close();
        }
        
        // Close the database connection
        $conn->close();
        ?>
    </div>
</div>
<?php
include 'includes/footer.php';
?>
