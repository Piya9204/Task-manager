<?php
include 'db.php';

if ($_SERVER['REQUEST_METHOD'] == 'GET') {
    $id = $_GET['id'];
    $task = $conn->query("SELECT * FROM tasks WHERE id = $id")->fetch_assoc();
?>

<form method="POST" class="container">
    <input type="hidden" name="id" value="<?= $task['id'] ?>">
    <input type="text" name="title" value="<?= $task['title'] ?>" required>
    <textarea name="description"><?= $task['description'] ?></textarea>
    <select name="priority" required>
        <option value="High" <?= $task['priority'] == 'High' ? 'selected' : '' ?>>High</option>
        <option value="Medium" <?= $task['priority'] == 'Medium' ? 'selected' : '' ?>>Medium</option>
        <option value="Low" <?= $task['priority'] == 'Low' ? 'selected' : '' ?>>Low</option>
    </select>
    <select name="status" required>
        <option value="Pending" <?= $task['status'] == 'Pending' ? 'selected' : '' ?>>Pending</option>
        <option value="Completed" <?= $task['status'] == 'Completed' ? 'selected' : '' ?>>Completed</option>
    </select>
    <input type="date" name="due_date" value="<?= $task['due_date'] ?>" required>
    <button type="submit">💾 Save</button>
</form>

<?php
} else {
    $id = $_POST['id'];
    $title = $_POST['title'];
    $desc = $_POST['description'];
    $priority = $_POST['priority'];
    $status = $_POST['status'];
    $due = $_POST['due_date'];

    $sql = "UPDATE tasks SET title=?, description=?, priority=?, status=?, due_date=? WHERE id=?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("sssssi", $title, $desc, $priority, $status, $due, $id);
    $stmt->execute();

    header("Location: index.php");
}
?>
