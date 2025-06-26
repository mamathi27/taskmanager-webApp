<?php
session_start();
include 'db.php';

// Redirect if user is not logged in
if (!isset($_SESSION['user_id'])) {
    header("Location: index.php");
    exit();
}

// Fetch tasks for logged-in user
$user_id = $_SESSION['user_id'];
$query = "SELECT * FROM tasks WHERE user_id = ? ORDER BY deadline ASC";
$stmt = $conn->prepare($query);
$stmt->bind_param("i", $user_id);
$stmt->execute();
$result = $stmt->get_result();
?>

<!DOCTYPE html>
<html>
<head>
    <title>Dashboard | TaskManager</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">

<div class="container mt-4">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2>Welcome, <?php echo $_SESSION['username']; ?> 👋</h2>
        <a href="logout.php" class="btn btn-danger">Logout</a>
    </div>

    <div class="card mb-4">
        <div class="card-body">
            <h4>Add New Task</h4>
            <form action="add_task.php" method="POST">
                <div class="row g-3">
                    <div class="col-md-4">
                        <input type="text" name="title" class="form-control" placeholder="Task title" required>
                    </div>
                    <div class="col-md-4">
                        <input type="date" name="deadline" class="form-control" required>
                    </div>
                    <div class="col-md-4">
                        <textarea name="description" class="form-control" placeholder="Task description (optional)"></textarea>
                    </div>
                </div>
                <button type="submit" name="add_task" class="btn btn-primary mt-3">Add Task</button>
            </form>
        </div>
    </div>

    <h4>Your Tasks</h4>
    <?php if ($result->num_rows > 0): ?>
        <table class="table table-striped">
            <thead class="table-dark">
                <tr>
                    <th>Title</th>
                    <th>Description</th>
                    <th>Deadline</th>
                    <th>Status</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php while ($task = $result->fetch_assoc()): ?>
                    <tr>
                        <td><?php echo htmlspecialchars($task['title']); ?></td>
                        <td><?php echo htmlspecialchars($task['description']); ?></td>
                        <td><?php echo $task['deadline']; ?></td>
                        <td>
                            <?php echo ucfirst($task['status']); ?>
                        </td>
                        <td>
                            <a href="edit_task.php?id=<?php echo $task['id']; ?>" class="btn btn-sm btn-warning">Edit</a>
                            <a href="delete_task.php?id=<?php echo $task['id']; ?>" class="btn btn-sm btn-danger" onclick="return confirm('Delete this task?');">Delete</a>
                        </td>
                    </tr>
                <?php endwhile; ?>
            </tbody>
        </table>
    <?php else: ?>
        <p class="text-muted">No tasks added yet.</p>
    <?php endif; ?>
</div>

</body>
</html>
