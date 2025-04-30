<?php
    include 'config.php';
?>
<div class="main-content">
<div class="bd-example">
  <table class="table">
    <thead>
      <tr>
        <th scope="col">id</th>
        <th scope="col">Категория</th>
        <th scope="col">Тип</th>
        <th scope="col">Размер</th>
        <th scope="col">Колличество</th>
      </tr>
    </thead>
    <tbody>
        <?php
            if ($_SERVER['REQUEST_METHOD'] == 'GET') {
                $sql = "SELECT * FROM tovar";
                $result = $pdo->query($sql);
                foreach($result as $row){
                    $id = $row["id"];
                    $category = $row["category"];
                    $type = $row["type"];
                    $size = $row["size"];
                    $qual = $row["qual"];
                    echo('<tr class="table-secondary">');
                    echo('<th scope="row">'.$id.'</th>');
                    echo('<td>'.$category.'</th>');
                    echo('<td>'.$type.'</th>');
                    echo('<td>'.$size.'</th>');
                    echo('<td>'.$qual.'</th>');
                    echo('</tr>');
                }
            }
        ?>
    </tbody>
  </table>
</div>
<div class="add_tovar_form">
    <br>
<form action="add_tovar.php" method="POST">
    <h2>Добавление товара.</h2>
  <div class="mb-3">
    <label for="exampleInputEmail1" class="form-label">Категория товара</label>
    <input type="text" class="form-control" id="category" name="category" aria-describedby="emailHelp">
    <div id="emailHelp" class="form-text"></div>
  </div>
  <div class="mb-3">
    <label for="exampleInputPassword1" class="form-label">Тип товара</label>
    <input type="text" class="form-control" id="text" name="type">
  </div>
  <div class="mb-3">
    <label for="exampleInputPassword1" class="form-label">Размер</label>
    <input type="number" class="form-control" id="size" name="size">
  </div>
  <div class="mb-3">
    <label for="exampleInputPassword1" class="form-label">Колличество</label>
    <input type="number" class="form-control" id="qual" name="qual">
  </div>
  <div class="mb-3 form-check">
    <input type="checkbox" class="form-check-input" id="exampleCheck1">
    <label class="form-check-label" for="exampleCheck1">Заготовка</label>
  </div>
  <button type="submit" class="btn btn-primary">Отправить</button>
</form>
</div>
<br>
        </div>
        <div></div>
        <div></div>