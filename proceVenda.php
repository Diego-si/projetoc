<?php 
require_once 'process.php';

$mysqli = new mysqli('127.0.0.1', 'teste', '123456', 'phpoo') or die(mysqli_error($mysqli));

$id = "";
$update = false;
$produto = '';
$dataVenda = '';
$credito = '';
$debito = '';
$cep = '';
$rua = '';
$bairro ='';
$cidade ='';
$uf = '';

if(isset($_POST['cadastra'])) {

  $produto = $_POST['produto'];
  $dataVenda = $_POST['dataVenda'];
  $credito = $_POST['credito'];
  $debito = $_POST['debito'];
  $cep = $_POST['cep'];
  $rua = $_POST['rua'];
  $bairro = $_POST['bairro'];
  $cidade = $_POST['cidade'];
  $uf = $_POST['uf'];

  $mysqli->query("INSERT INTO vendas 
  (produto, dataVenda, credito, debito, cep, rua, bairro, cidade, uf) 
  VALUES ('$produto', '$dataVenda', '$credito', '$debito', '$cep', '$rua', '$bairro', '$cidade', '$uf')") or
  die($mysqli->error);

  $_SESSION['message'] = "Vendido com sucesso!";
  $_SESSION['msg_type'] = "success";

  header("location: vendas.php");
}

if(isset($_GET['vender'])){
  $idproduct = $_GET['vender'];
  $result = $mysqli->query("SELECT * FROM tb_products WHERE idproduct=$idproduct") or die($mysqli->error());
  $contador = (is_array($result) ? count($result) : 1);
  if ($contador == 1) {
    $row = $result->fetch_array();
    $produto = ($row['nome'] . " " . $row['vlpreco'] ." ".
    $row['vlregistro'] ." ". $row['vlvalidade'] ." ".
    $row['vlcodigo']);
    $update = true;
  }

}


