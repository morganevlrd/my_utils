<?php 

    $errors="";
     
    $db = mysqli_connect('localhost' , 'root' , '' , 'todo');

    if (isset($_POST['submit'])) {
        $task = $_POST['task'];
        if (empty($task)){
            $errors = "Ce champs est obligatoire";

        }else {
            mysqli_query($db, "INSERT INTO tasks (task) VALUES ('$task')");
            header('location: index.php');
        }
    }

    if (isset($_GET['del_task'])) {
        $id = $_GET['del_task'];
        mysqli_query($db, "DELETE FROM tasks WHERE id=$id");
        header('location: index.php');

    }

    $tasks = mysqli_query($db, "SELECT * FROM tasks");

?>

<!DOCTYPE html>
<html>
<head>
     <title>To do List</title>
     <link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>
    <div class="heading">
        <h2>To Do list</h2>
    </div>

    <form method="POST" action="index.php">
         <?php if (isset($errors)){ ?>
            <p><?php echo $errors; ?></p>
         <?php } ?>

         <input type="text" name="task" class="task_input" placeholder="Nouvelle tâche">
         <button type="submit" class="add_btn" name="submit">Ajouter</button>
    </form>

    <table>
         <thead>
            <tr>
                <th>&nbsp; Numero &nbsp;</th>
                <th>&nbsp; A Faire &nbsp;</th>
                <th>&nbsp; Supprimer &nbsp;</th>
            </tr>
         </thead>

         <tbody>
             <?php $i = 1; while ($row = mysqli_fetch_array($tasks)){ ?>
                <tr>
                 <td><?php echo $i; ?></td>
                 <td class="task"><?php echo $row ['task']; ?></td>
                 <td class="delete">
                    <a href="index.php?del_task=<?php echo $row['id'] ?>">x</a>
                 </td>
                 <td>
                     <input type="checkbox" id="scales" name="scales"
                      checked>
                 </td>
             </tr>

            <?php $i++; } ?>
        
         </tbody>
    </table>

    <table>
         <thead>
            <tr>
                <th>&nbsp; Tâche finie &nbsp;</th>
                <th> Supprimer </th>
            </tr>
         </thead>
   </table>

</body>
</html>
