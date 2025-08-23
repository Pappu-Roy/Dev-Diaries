<?php
include 'config.php';
include 'includes/header.php';

// Check if an ID is provided in the URL
if (!isset($_GET['id'])) {
    redirect('index.php');
}

$id = $conn->real_escape_string($_GET['id']);
$post = null;

// Fetch the single post data from the database
$sql = "SELECT id, title, content, category, created_at FROM posts WHERE id = '$id'";
$result = $conn->query($sql);

if ($result->num_rows == 1) {
    $post = $result->fetch_assoc();
} else {
    // If post not found, redirect back to the home page
    redirect('index.php');
}
?>
<div class="container mx-auto p-4 md:p-8">
    <article class="bg-white rounded-lg shadow-xl p-8 lg:p-12">
        <a href="index.php" class="inline-flex items-center text-blue-600 hover:underline mb-6">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-1" viewBox="0 0 20 20" fill="currentColor">
                <path fill-rule="evenodd" d="M12.707 5.293a1 1 0 010 1.414L9.414 10l3.293 3.293a1 1 0 01-1.414 1.414l-4-4a1 1 0 010-1.414l4-4a1 1 0 011.414 0z" clip-rule="evenodd" />
            </svg>
            Back to all posts
        </a>

        <div class='flex justify-between items-center mb-4'>
            <h1 class="text-4xl md:text-5xl font-extrabold text-gray-900 leading-tight"><?php echo htmlspecialchars($post['title']); ?></h1>
            <span class='text-sm font-semibold px-3 py-1 rounded-full text-white bg-blue-500'><?php echo htmlspecialchars($post['category']); ?></span>
        </div>
        
        <p class="text-lg text-gray-500 mb-8">Published on: <?php echo date("F j, Y, g:i a", strtotime($post['created_at'])); ?></p>
    
        <div class="prose max-w-none text-gray-700 leading-relaxed">
            <!-- Here's the key change: we echo the content directly. -->
            <!-- This assumes the content has been properly sanitized before being saved. -->
            <p><?php echo $post['content']; ?></p> 
        </div>
        
    </article>
</div>
<?php
include 'includes/footer.php';
?>
