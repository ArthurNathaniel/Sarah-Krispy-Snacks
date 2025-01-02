<?php
require 'db.php'; // Include database connection
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $title = $_POST['title'];
    $text_content = $_POST['text_content'];
    $date = $_POST['date'];
    $image_path = '';

    // Handle image upload
    if (isset($_FILES['image']) && $_FILES['image']['error'] == 0) {
        $upload_dir = 'uploads/';
        $image_path = $upload_dir . basename($_FILES['image']['name']);
        if (move_uploaded_file($_FILES['image']['tmp_name'], $image_path)) {
            $image_path = $image_path; // Store the uploaded image path
        } else {
            $image_path = ''; // Set empty if upload failed
        }
    }

    // Insert into database
    $stmt = $conn->prepare("INSERT INTO blogs (title, image_path, text_content, date) VALUES (?, ?, ?, ?)");
    if ($stmt->execute([$title, $image_path, $text_content, $date])) {
        echo "<script>alert('Blog added successfully!');</script>";
    } else {
        echo "<script>alert('Error adding blog.');</script>";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Blog</title>
    <link href="https://cdn.quilljs.com/1.3.7/quill.snow.css" rel="stylesheet">
    <style>
        .form-group {
            margin-bottom: 15px;
        }
        label {
            font-weight: bold;
        }
        .quill-editor {
            height: 300px;
        }
    </style>
</head>
<body>
    <h1>Add Blog</h1>
    <form action="" method="POST" enctype="multipart/form-data">
        <div class="form-group">
            <label for="title">Title:</label>
            <input type="text" id="title" name="title" required>
        </div>
        <div class="form-group">
            <label for="image">Image:</label>
            <input type="file" id="image" name="image">
        </div>
        <div class="form-group">
            <label for="text_content">Content:</label>
            <div id="quill-editor" class="quill-editor"></div>
            <input type="hidden" name="text_content" id="text_content">
        </div>
        <div class="form-group">
            <label for="date">Date:</label>
            <input type="date" id="date" name="date" required>
        </div>
        <button type="submit">Add Blog</button>
    </form>

    <script src="https://cdn.quilljs.com/1.3.7/quill.min.js"></script>
    <script>
        // Initialize Quill editor
        var quill = new Quill('#quill-editor', {
            theme: 'snow'
        });

        // Update hidden input with Quill's content on form submission
        document.querySelector('form').onsubmit = function () {
            document.getElementById('text_content').value = quill.root.innerHTML;
        };
    </script>
</body>
</html>
