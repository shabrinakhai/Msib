<?php
include 'db.php';

if (isset($_GET['course_id'])) {
    $course_id = $_GET['course_id'];

    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $title = $_POST['title'];
        $description = $_POST['description'];
        $embed_link = $_POST['embed_link'];

        $stmt = $conn->prepare("INSERT INTO materials (course_id, title, description, embed_link) VALUES (?, ?, ?, ?)");
        $stmt->bind_param("isss", $course_id, $title, $description, $embed_link);
        $stmt->execute();
        $stmt->close();

        header("Location: materials_list.php?course_id=$course_id");
        exit();
    }
}

include 'templates/header.php';
?>

<h2>Add Material</h2>
<form method="POST">
    <input type="text" name="title" placeholder="Material Title" required>
    <textarea name="description" placeholder="Material Description" required></textarea>
    <input type="text" name="embed_link" placeholder="Embed Link" required>
    <button type="submit">Add Material</button>
</form>

<?php
include 'templates/footer.php';
?>