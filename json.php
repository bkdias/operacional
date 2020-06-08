<?php
$servidor = "localhost";
$usuario = "root";
$senha = "Rebeca@20192020";
$dbname = "yara";

$conn = mysqli_connect($servidor, $usuario, $senha, $dbname);

function retorna($cpf_cnpj, $conn){
    $result = "SELECT * from cliente WHERE cpf_cnpj = '$cpf_cnpj'";
    $resultado = mysqli_query($conn, $result);
    if($resultado->num_rows){
      $row = mysqli_fetch_array($resultado);  
      $valores['nome'] = $row['nome'];
      $valores['email'] = $row['email'];
      $valores['tel'] = $row['tel'];
      $valores['cidade'] = $row['cidade'];
      $valores['uf'] = $row['uf'];
      $valores['obs'] = $row['obs'];
    }else{
        $valores['nome'] = '';
    }
    return json_encode($valores);
}
if(isset($_GET['cpf_cnpj'])){
    $cpf_cnpj = $_GET['cpf_cnpj'];
    echo retorna($cpf_cnpj, $conn);
}


