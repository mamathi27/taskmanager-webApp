<?php
session_start();
include 'db.php';

if (!isset($_SESSION['user_id'])) {
    header("Location: index.php");
    exit();
}

$user_id = $_SESSION['user_id'];

// Step 1: Get Task Details
if (isset($_GET['id'])) {
    $task_id = $_GET['id'];

    $query = "SELECT * FROM tasks WHERE id = ? AND user_id = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("ii", $task_id, $user_id);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows !== 1) {
        echo "<script>alert('Task not found.'); window.location.href='dashboard.php';</script>";
        exit();
    }

    $task = $result->fetch_assoc();
} else {
    header("Location: dashboard.php");
    exit();
}

// Step 2: Handle Update Submission
if (isset($_POST['update_task'])) {
    $title = trim($_POST['title']);
    $description = trim($_POST['description']);
    $deadline = $_POST['deadline'];
    $status = $_POST['status'];

    $update_query = "UPDATE tasks SET title = ?, description = ?, deadline = ?, status = ? WHERE id = ? AND user_id = ?";
    $stmt = $conn->prepare($update_query);
    $stmt->bind_param("ssssii", $title, $description, $deadline, $status, $task_id, $user_id);

    if ($stmt->execute()) {
        header("Location: dashboard.php");
        exit();
    } else {
        echo "<script>alert('Failed to update task.');</script>";
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Edit Task | TaskManager</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">

<div class="container mt-5">
    <div class="card mx-auto" style="max-width: 600px;">
        <div class="card-body">
            <h4 class="card-title mb-4">Edit Task</h4>
            <form method="POST">
                <div class="mb-3">
                    <label>Title</label>
                    <input type="text" name="title" class="form-control" value="<?php echo htmlspecialchars($task['title']); ?>" required>
                </div>
                <div class="mb-3">
                    <label>Description</label>
                    <textarea name="description" class="form-control"><?php echo htmlspecialchars($task['description']); ?></textarea>
                </div>
                <div class="mb-3">
                    <label>Deadline</label>
                    <input type="date" name="deadline" class="form-control" value="<?php echo $task['deadline']; ?>" required>
                </div>
                <div class="mb-3">
                    <label>Status</label>
                    <select name="status" class="form-select">
                        <option value="pending" <?php if ($task['status'] === 'pending') echo 'selected'; ?>>Pending</option>
                        <option value="completed" <?php if ($task['status'] === 'completed') echo 'selected'; ?>>Completed</option>
                    </select>
                </div>
                <button type="submit" name="update_task" class="btn btn-success">Update Task</button>
                <a href="dashboard.php" class="btn btn-secondary ms-2">Cancel</a>
            </form>
        </div>
    </div>
</div>

</body>
</html>
