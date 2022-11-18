<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-OERcA2EqjJCMA+/3y+gxIOqMEjwtxJY7qPCqsdltbNJuaOe923+mo//f6V8Qbsw3" crossorigin="anonymous" defer></script>
</head>
<body>
    <div class="container">
        <!-- form to add a to do task -->
        <form action="add.php" method="post">
            <!-- input for task name -->
            <div class="form-group">
                <label for="task">Task</label>
                <input type="text" name="task" id="task" class="form-control">
            </div>
            <!-- input for task date and time -->
            <div class="form-group">
                <label for="date">Date</label>
                <input type="datetime-local" name="date" id="date" class="form-control">
            </div>
            <!-- input for Submit -->
            <div class="form-group">
                <input type="submit" value="Add Task" class="btn btn-primary">
            </div>
    </div>
</body>
</html>