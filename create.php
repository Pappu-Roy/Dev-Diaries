<?php
include 'config.php';
include 'includes/header.php';

if (!isset($_SESSION['user_id'])) {
    redirect('admin.php');
}

$error = '';
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $title = $conn->real_escape_string($_POST['title']);
    // TinyMCE sends HTML content, so we sanitize it before saving.
    $content = $conn->real_escape_string($_POST['content']);
    $category = $conn->real_escape_string($_POST['category']);

    if (empty($title) || empty($content)) {
        $error = "Title and content cannot be empty.";
    } else {
        $sql = "INSERT INTO posts (title, content, category) VALUES ('$title', '$content', '$category')";
        if ($conn->query($sql) === TRUE) {
            redirect('dashboard.php');
        } else {
            $error = "Error: " . $sql . "<br>" . $conn->error;
        }
    }
}
?>
<div class="w-full max-w-3xl p-8 space-y-6 bg-white rounded-xl shadow-2xl mx-auto">
    <h2 class="text-3xl font-bold text-center text-blue-600">Create New Post</h2>
    <?php if (isset($error) && !empty($error)): ?>
        <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative" role="alert">
            <span class="block sm:inline"><?php echo $error; ?></span>
        </div>
    <?php endif; ?>
    <!-- Added an ID to the form for easy JavaScript selection -->
    <form action="create.php" method="post" id="postForm" class="space-y-4">
        <div>
            <label for="title" class="sr-only">Title</label>
            <input type="text" name="title" id="title" class="w-full px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500" placeholder="Post Title" required>
        </div>
        <div>
            <label for="category" class="sr-only">Category</label>
            <select name="category" id="category" class="w-full px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500" required>
                <option value="Programming">Programming</option>
                <option value="Science">Science</option>
                <option value="Technology">Technology</option>
                <option value="News">News</option>
            </select>
        </div>
        <div>
            <label for="content" class="sr-only">Content</label>
            <textarea name="content" id="content" rows="10" class="w-full px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500" placeholder="Post Content" required></textarea>
        </div>
        <div class="flex justify-between items-center">
            <!-- The button now has an onclick handler -->
            <button type="button" onclick="submitPostForm()" class="py-2 px-6 bg-green-600 text-white font-semibold rounded-md hover:bg-green-700 focus:outline-none focus:ring-2 focus:ring-green-500 focus:ring-offset-2">
                Publish Post
            </button>
            <a href="dashboard.php" class="py-2 px-6 bg-gray-300 text-gray-800 rounded-md hover:bg-gray-400">Cancel</a>
        </div>
    </form>
</div>

<!-- TinyMCE Script -->
<script src="https://cdn.tiny.cloud/1/m1qwxubmuoob9mx3so4jvktlbpgrx4nqya41or8l9rwc93zr/tinymce/7/tinymce.min.js" referrerpolicy="origin"></script>
<script>
    tinymce.init({
        selector: '#content',
        plugins: 'advlist autolink lists link image charmap print preview anchor',
        toolbar_mode: 'floating',
    });

    // Custom JavaScript function to submit the form
    function submitPostForm() {
        // This is the key line: it forces TinyMCE to save the content
        // back to the textarea before the form is submitted.
        tinyMCE.triggerSave();
        document.getElementById('postForm').submit();
    }
</script>
<?php
include 'includes/footer.php';
?>
