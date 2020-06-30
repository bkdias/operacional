<?php
$servidor = "localhost";
$usuario = "root";
$senha = "Rebeca@20192020";
$dbname = "yara";

$conn = mysqli_connect($servidor, $usuario, $senha, $dbname);

function retorna($vendor, $conn){
    $result = "SELECT * from transportadora WHERE vendor = '$vendor'";
    $resultado = mysqli_query($conn, $result);
    if($resultado->num_rows){
      $row = mysqli_fetch_array($resultado);  
      $valores['transp'] = $row['transp'];
      
    }else{
        $valores['transp'] = 'erro';
    }
    return json_encode($valores);
}
if(isset($_GET['vendor'])){
    $vendor = $_GET['cpf_cnpj'];
    echo retorna($vendor, $conn);
}
