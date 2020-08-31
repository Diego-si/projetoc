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
  
  <!-- funçao para complementar o CEP -->
  <script src="js/app.js"></script>

</head>
  <body>
<main>
  <div class="container text-center">

    <h1 class="py-4 rounded"><i class="fas fa-store"></i>VENDAS DAS FRUTAS</h1>

    <?php require_once 'proceVenda.php'; ?>

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
      <form action="proceVenda.php" method="post" class="w-50">

        <input type="hidden" name="id" value="<?php echo $id; ?>">
        <div class="py-2">
            
            <div class="col-md-12 mb-2">
              <label>Produto da Fruta</label>
              <input type="text" name="produto"
              value="<?php echo $produto; ?>" class="form-control" id="produto" required>
            </div>

            <div class="col-md-12 mb-2">
            <label>Data da venda</label>
                <input type="date" name="dataVenda" 
                value="<?php echo $dataVenda; ?>" class="form-control" id="dataVenda" required>
            </div> 

            <div class="form-row">

              <div class="col-md-6 mb-2">
              <label>Forma de pagamento</label>
                <input type="boolean" name="credito" 
                value="<?php echo $credito; ?>" placeholder="Crédito = 0" class="form-control" id="credito" required>
              </div>

              <div class="col-md-6 mb-2">
              <label>Forma de pagamento</label>
                <input type="boolean" name="debito" 
                value="<?php echo $debito; ?>" placeholder="Débito = 1" class="form-control" id="debito" required>
              </div>
            </div>
            <div class="form-row">
              <div class="col-md-4 mb-2">
                <label>Cep</label>
                <input type="int" name="cep"
                value="<?php echo $cep; ?>" class="form-control" id="cep" 
                onblur="pesquisacep(this.value);" required>
              </div>
 
              <div class="col-md-8 mb-2">
                <label>Rua</label>
                  <input type="text" name="rua" 
                  value="<?php echo $rua; ?>" class="form-control" id="rua" required>
              </div>
            </div>
            <div class="col-md-12 mb-2">
              <label>Bairro</label>
                <input type="text" name="bairro" 
                value="<?php echo $bairro; ?>" class="form-control" id="bairro" required>
            </div>
          <div class="form-row">
            <div class="col-md-6 mb-2">
                  <label>UF</label>
                  <input type="text" name="uf" 
                  value="<?php echo $uf; ?>" class="form-control" id="uf" required>
                </div>
                
                <div class="col-md-6 mb-2">
                  <label>Cidade</label>
                  <input type="text" name="cidade"
                  value="<?php echo $cidade; ?>" class="form-control" id="cidade" required>
           </div>
          </div>
          <button type="submit" class="btn btn-info" name="cadastra">Salvar venda</button>
          <a href="index.php" class="btn btn-success" name="inicio">Inicio</a>
      
        </div>

      </form>
    </div>

    <?php 
      $mysqli = new mysqli('127.0.0.1', 'teste', '123456', 'phpoo') or die(mysqli_error($mysqli));
      $result = $mysqli->query("SELECT * FROM vendas") or die($mysqli->error);
    ?>

    <div class="row d-flex table-data">
      <table class="table table-striped">
        <thead class="thead-dark">
          <tr>
            <th>Produto</th>
            <th>Data venda</th>
            <th>Credito</th>
            <th>Debito</th>
            <th>Cep</th>
            <th>Rua</th>
            <th>Bairro</th>
            <th>Cidade</th>
            <th>UF</th>
          <tr>
        </thead>

        <tbody>
        <?php 
        while ($row = $result->fetch_assoc()): ?>
          <tr>
            <td><?php echo $row['produto']; ?></td>
            <td><?php echo $row['dataVenda']; ?></td>
            <td><?php echo $row['credito']; ?></td>
            <td><?php echo $row['debito']; ?></td>
            <td><?php echo $row['cep']; ?></td>
            <td><?php echo $row['rua']; ?></td>
            <td><?php echo $row['bairro']; ?></td>
            <td><?php echo $row['cidade']; ?></td>
            <td><?php echo $row['uf']; ?></td>
          </tr>
          <?php endwhile; ?>
        </tbody>
        
      </table>
    </div>

  <?php
    function pre_r($array) {
      echo '<pre>';
      pint_r($array);
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
