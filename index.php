<?php
//session_start();
$errors ="";

// according to stackoverflow i have to conect to the database and us mysqli
$db =mysqli_connect('localhost', 'root', '', 'todo');

if (isset($_POST['submit'])) {
    $task = $_POST['task'];
    if (empty($task)) {
       $errors = "Please add a task";
    }
    else {
            mysqli_query($db, "INSERT INTO tasks (task) VALUES ('$task')");
            header('location: index.php');
    }
}

// to delete a submitted task
if (isset($_GET['del_task'])) {
    $id = $_GET['del_task'];
    mysqli_query($db, "DELETE FROM tasks WHERE id=$id");
    header ('location: index.php');
    $tasks = mysqli_query($db, "SELECT * FROM tasks");
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="style.css">
    <title>To Do List with PHP</title>
</head>
<body>
    <h2>To Do List with PHP</h2>
    <form method="POST" action="index.php">
        <?php if (isset($errors)) {?>
            <p><?php echo $erros; ?></P>
        <?php } ?>
        <input type="text" name="task" class="task_input">
        <button type="submit" class="task_btn" name="submit">Add Task</button>
    </form>

    <table>
        <thead>
            <tr>
                <th>Task #</th>
                <th>Task Description</th>
                <th>Remove Task </th>
            </tr>
        </thead>

        <tbody>
        <?php $i = 1; while ($row = mysqli_fetch_array ($tasks)) { ?>
        <tr>
            <td> <?php echo $row['id']; ?></td>
            <td class="task"> <?php echo $row ['task']; ?></td>
            <td class="delete">
                <a href="index.php?del_task=<?php echo $row['id']; ?>"> x </a>
            </td>
        </tr>
        <?php $i++; } ?>
        </tbody>
    </table>
</body>
</html>

<?php
/**
// References
https://www.w3schools.com/howto/howto_js_todolist.asp
https://blog.devcenter.co/easy-way-to-php-todolist-app-crud-e1284265bb27
stackoverflow and youtube
 */