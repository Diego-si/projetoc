<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>FRUTARIA</title>

  <!-- BOOTSTRAP CSS-->
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" integrity="sha384-JcKb8q3iqJ61gNV9KGb8thSsNjpSL0n8PARn9HuZOnIxN0hoP+VmmDGMN5t9UJ0Z" crossorigin="anonymous">

  <!-- Font Icons -->
  <script src="https://kit.fontawesome.com/be5fa35e72.js" crossorigin="anonymous"></script>

  <link rel="stylesheet" href="./css/style.css">

</head>
<body>
<main>
  <div class="container text-center">
    <h1 class="py-4 rounded"><i class="fas fa-store"></i>LOJA DAS FRUTAS</h1>
    <?php require_once 'process.php'; ?>

    <?php 
      if(isset($_SESSION['message'])): ?>
    <div class="alert alert-<?=$_SESSION['msg_type']?>">
        <?php
        echo $_SESSION['message'];
        unset($_SESSION['message']);
        ?>
    </div>
    <?php endif ?>
    <div class="d-flex justify-content-center">
      <form action="process.php" method="post" class="w-50">
        <input type="hidden" name="idproduct" value="<?php echo $idproduct; ?>">
        <div class="py-2">
            
            <div class="col-md-12 mb-2">
              <label>Nome da Fruta</label>
              <input type="text" name="nome"
              value="<?php echo $nome; ?>" placeholder="nome da fruta" class="form-control" id="nome" required>
            </div>

            <div class="col-md-12 mb-2">
            <label>Preço da fruta</label>
                <input type="Decimal" name="vlpreco" 
                value="<?php echo $vlpreco; ?>" placeholder="Preço da fruta" class="form-control" id="vlpreco" required>
            </div> 

            <div class="col-md-12 mb-2">
            <label>Data do registro</label>
              <input type="Date" name="vlregistro" 
              value="<?php echo $vlregistro; ?>" placeholder="Data do registro" class="form-control" id="vlregistro" required>
            </div>

            <div class="col-md-12 mb-2">
              <label>Data do validade</label>
                <input type="Date" name="vlvalidade" 
                value="<?php echo $vlvalidade; ?>" placeholder="Data do validade" class="form-control" id="vlvalidade" required>
            </div>
                        
            <div class="col-md-12 mb-2">
              <label>Código da Fruta</label>
                <input type="Number" name="vlcodigo" 
                value="<?php echo $vlcodigo; ?>" placeholder="Código da fruta" class="form-control" id="vlcodigo" required>
            </div>
            
            <?php
              if($update == true):
            ?> 
            <button type="submit" class="btn btn-info" name="update">Salvar</button>
            <a href="index.php" class="btn btn-success" name="inicio">Inicio</a>
              <?php else: ?>    
            <button type="submit" class="btn btn-success" name="save">Cadastrar</button>
            <a href="vendas.php" class="btn btn-info" name="vendas">Vendas</a>
              <?php endif; ?>
        </div>

      </form>
    </div>

    <?php 
      $mysqli = new mysqli('127.0.0.1', 'teste', '123456', 'phpoo') or die(mysqli_error($mysqli));
      $result = $mysqli->query("SELECT * FROM tb_products") or die($mysqli->error);
    ?>

    <div class="row d-flex table-data">
      <table class="table table-striped">
        <thead class="thead-dark">
          <tr>
            <th>Nome</th>
            <th>Preço</th>
            <th>Registro</th>
            <th>Validade</th>
            <th>Código</th>
          <tr>
        </thead>
        <tbody>
        <?php 
        while ($row = $result->fetch_assoc()): ?>
          <tr>
            <td><?php echo $row['nome']; ?></td>
            <td><?php echo $row['vlpreco']; ?></td>
            <td><?php echo $row['vlregistro']; ?></td>
            <td><?php echo $row['vlvalidade']; ?></td>
            <td><?php echo $row['vlcodigo']; ?></td>
            <td>
              <a href="vendas.php?vender=<?php echo $row['idproduct']; ?>" class="btn btn-outline-light btn-xs"><i class="fas fa-hand-holding-usd"></i></a>
              <a href="index.php?edit=<?php echo $row['idproduct']; ?>" class="btn btn-primary btn-xs"><i class="fa fa-edit"></i></a>
              <a href="process.php?delete=<?php echo $row['idproduct']; ?>" onclick="return confirm('Deseja realmente excluir este registro?')" class="btn btn-danger btn-xs"><i class="fa fa-trash"></i></a>
            </td>
          </tr>
          <?php endwhile; ?>
        </tbody>
        
      </table>
    </div>

  <?php
    function pre_r($array) {
      echo '<pre>';
      print_r($array);
      echo '</pre>';
    }
  ?>

  </div>
</main>
    <!-- BOOTSTRAP JS-->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js" integrity="sha384-B4gt1jrGC7Jh4AgTPSdUtOBvfO8shuf57BaghqFfPlYxofvL8/KUEfYiJOMMV+rV" crossorigin="anonymous"></script>
  </body>
</html>
