<?php 

session_start();

$mysqli = new mysqli('127.0.0.1', 'teste', '123456', 'phpoo') or die(mysqli_error($mysqli));

$idproduct = "";
$update = false;
$nome = '';
$vlpreco = '';
$vlregistro = '';
$vlvalidade = '';
$vlcodigo = '';

if(isset($_POST['save'])) {
  $nome = $_POST['nome'];
  $vlpreco = $_POST['vlpreco'];
  $vlregistro = $_POST['vlregistro'];
  $vlvalidade = $_POST['vlvalidade'];
  $vlcodigo = $_POST['vlcodigo'];

  $mysqli->query("INSERT INTO tb_products (nome, vlpreco, vlregistro, vlvalidade, vlcodigo) VALUES ('$nome', '$vlpreco', '$vlregistro', '$vlvalidade', '$vlcodigo')") or
  die($mysqli->error);

  $_SESSION['message'] = "Salvo com sucesso!";
  $_SESSION['msg_type'] = "success";

  header("location: index.php");
}

if(isset($_GET['delete'])){
  $idproduct = $_GET['delete'];
  $mysqli->query("DELETE FROM tb_products WHERE idproduct=$idproduct") or die($mysqli->error());

  $_SESSION['message'] = "Apagado com sucesso!";
  $_SESSION['msg_type'] = "danger";

  header("location: index.php");
}

if(isset($_GET['edit'])){
  $idproduct = $_GET['edit'];
  $result = $mysqli->query("SELECT * FROM tb_products WHERE idproduct=$idproduct") or die($mysqli->error());
  $contador = (is_array($result) ? count($result) : 1);
  if ($contador == 1) {
    $row = $result->fetch_array();
    $nome = $row['nome'];
    $vlpreco = $row['vlpreco'];
    $vlregistro = $row['vlregistro'];
    $vlvalidade = $row['vlvalidade'];
    $vlcodigo = $row['vlcodigo'];
    $update = true;
  }
}

if(isset($_POST['update'])) {

  $idproduct = $_POST['idproduct'];
  $nome = $_POST['nome'];
  $vlpreco = $_POST['vlpreco'];
  $vlregistro = $_POST['vlregistro'];
  $vlvalidade = $_POST['vlvalidade'];
  $vlcodigo = $_POST['vlcodigo'];

  $mysqli->query("UPDATE tb_products SET nome='$nome', vlpreco='$vlpreco', vlregistro='$vlregistro', vlvalidade='$vlvalidade', vlcodigo='$vlcodigo' WHERE idproduct='$idproduct'") 
  or die($mysqli->error);

  $_SESSION['message'] = "Atualizado com sucesso!";
  $_SESSION['msg_type'] = "warning";

  header("location: index.php");
}
