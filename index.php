<?php

    // require_once('function.php');
    require_once 'function.php';

    $order = '';
    if (isset($_GET['order'])) {
        $order = $_GET['order'];
    }

    // require_once('Models/Todo.php');
    require_once 'Models/Todo.php';

    //Todoクラスのインスタンス化
    $todo = new Todo();

    //DBからデータを全件取得
    $tasks = $todo->all($order);

    // echo '<pre>';
    // var_dump($tasks);
    // exit();
?>

<!DOCTYPE html>
<html lang="ja">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>Document</title>
  <link rel="stylesheet" href="assets/css/reset.css">
  <link rel="stylesheet" href="assets/css/bootstrap.min.css">
  <link rel="stylesheet" href="assets/css/style.css">
  <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.4.1/css/all.css" integrity="sha384-5sAR7xN1Nv6T6+dT2mhtzEpVJvfS3NScPQTrOxhwjIuvcA67KV2R5Jz6kr4abQsz" crossorigin="anonymous">
</head>
<body>
  <header class="px-5 bg-primary">
      <nav class="navbar navbar-dark">
          <a href="index.php" class="navbar-brand">TODO APP</a>
          <div class="justify-content-end text-white">
              ORDER:
              <a href="index.php?order=asc" class="text-white"><i class="fas fa-arrow-up"></i></a>
              <a href="index.php?order=desc" class="text-white"><i class="fas fa-arrow-down"></i></a>
          </div>
      </nav>
    </header>
    <main class="container py-5">
        <section>
            <form class="form-row justify-content-center" action="create.php" method="POST">
                <div class="col-10 col-md-6 py-2">
                      <input type="text" class="form-control" placeholder="ADD TODO" name="task">
                </div>
                <div class="py-2 col-md-3 col-10">
                    <button type="submit" class="col-12 btn btn-primary">ADD</button>
                </div>
            </form>
        </section>
        <section class="mt-5">
          <table class="table table-hover">
            <thead>
              <tr class="bg-primary text-light">
                  <th class=>TODO</th>
                  <th>DUE DATE</th>
                  <th>STATUS</th>
                  <th></th>
                  <th></th>
              </tr>
            </thead>
            <tbody>
              <?php foreach ($tasks as
              $task):?>
              <tr>
                <td>
                <?php echo h($task['name']); ?>
                </td>
                <td class="nowrap">registered:<?php echo date('Y年m月d日', strtotime(h($task['due_date']))); ?>
                <?php
                if (strtotime(h($task['updated_at'])) > 0):?>
                <br>
                modified:<?php echo date('Y年m月d日', strtotime(h($task['updated_at']))); ?>
                <?php endif; ?>
                </td>
                <td>NOT YET</td>
                <td>
                    <a class="text-success" href="edit.php?id=<?php echo h($task['id']); ?>"><i class="fas fa-pencil-alt"></i></a>
                </td>
                <td>
                    <a class="text-danger" href="delete.php?id=<?php echo h($task['id']); ?>"><i class="fas fa-trash-alt"></i></a>
                </td>
              </tr>
              <?php endforeach; ?>
            </tbody>
          </table>
        </section>
    </main>

</body>
</html>
