<?php
include 'config.php';
include 'includes/header.php';

if (!isset($_SESSION['user_id'])) {
    redirect('admin.php');
}

if (!isset($_GET['id'])) {
    redirect('dashboard.php');
}

$id = $conn->real_escape_string($_GET['id']);
$post = null;

$sql = "SELECT id, title, content, category FROM posts WHERE id = '$id'";
$result = $conn->query($sql);
if ($result->num_rows == 1) {
    $post = $result->fetch_assoc();
} else {
    redirect('dashboard.php');
}

$error = '';
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $title = $conn->real_escape_string($_POST['title']);
    $content = $conn->real_escape_string($_POST['content']);
    $category = $conn->real_escape_string($_POST['category']);

    if (empty($title) || empty($content)) {
        $error = "Title and content cannot be empty.";
    } else {
        $sql = "UPDATE posts SET title='$title', content='$content', category='$category' WHERE id='$id'";
        if ($conn->query($sql) === TRUE) {
            redirect('dashboard.php');
        } else {
            $error = "Error updating record: " . $conn->error;
        }
    }
}
?>
<div class="w-full max-w-3xl p-8 space-y-6 bg-white rounded-xl shadow-2xl mx-auto">
    <h2 class="text-3xl font-bold text-center text-blue-600">Edit Post</h2>
    <?php if (isset($error) && !empty($error)): ?>
        <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative" role="alert">
            <span class="block sm:inline"><?php echo $error; ?></span>
        </div>
    <?php endif; ?>
    <!-- Added an ID to the form for easy JavaScript selection -->
    <form action="edit.php?id=<?php echo $id; ?>" method="post" id="postForm" class="space-y-4">
        <div>
            <label for="title" class="sr-only">Title</label>
            <input type="text" name="title" id="title" class="w-full px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500" placeholder="Post Title" value="<?php echo htmlspecialchars($post['title']); ?>" required>
        </div>
        <div>
            <label for="category" class="sr-only">Category</label>
            <select name="category" id="category" class="w-full px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500" required>
                <option value="Programming" <?php echo ($post['category'] == 'Programming') ? 'selected' : ''; ?>>Programming</option>
                <option value="Science" <?php echo ($post['category'] == 'Science') ? 'selected' : ''; ?>>Science</option>
                <option value="Technology" <?php echo ($post['category'] == 'Technology') ? 'selected' : ''; ?>>Technology</option>
                <option value="News" <?php echo ($post['category'] == 'News') ? 'selected' : ''; ?>>News</option>
            </select>
        </div>
        <div>
            <label for="content" class="sr-only">Content</label>
            <textarea name="content" id="content" rows="10" class="w-full px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500" placeholder="Post Content" required><?php echo htmlspecialchars($post['content']); ?></textarea>
        </div>
        <div class="flex justify-between items-center">
            <!-- The button now has an onclick handler -->
            <button type="button" onclick="submitPostForm()" class="py-2 px-6 bg-indigo-600 text-white font-semibold rounded-md hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2">
                Update Post
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
        tinyMCE.triggerSave();
        document.getElementById('postForm').submit();
    }
</script>
<?php
include 'includes/footer.php';
?>
