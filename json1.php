<?php
$servidor = "localhost";
$usuario = "root";
$senha = "Rebeca@20192020";
$dbname = "yara";

$conn = mysqli_connect($servidor, $usuario, $senha, $dbname);

function retorna1($cpf, $conn){
    $result = "SELECT * from caminhao WHERE cpf = '$cpf'";
    $resultado = mysqli_query($conn, $result);
    if($resultado->num_rows){
        $linhas = mysqli_fetch_array($resultado);  
        $valores['motorista'] = $linhas['motorista'];
        $valores['cnh'] = $linhas['cnh'];
        $valores['valcnh'] = $linhas['val_cnh'];
        $valores['catcnh'] = $linhas['catcnh'];
        $valores['tel'] = $linhas['fone'];
        $valores['mopp'] = $linhas['mopp'];
        $valores['placacav'] = $linhas['placacv'];
        $valores['placacar'] = $linhas['placac'];
        $valores['vendor'] = $linhas['vendor'];
        $valores['transp'] = $linhas['transp'];
        $valores['frete'] = $linhas['frete'];
        $valores['cliente'] = $linhas['cliente'];
        $valores['tipocam'] = $linhas['tipocam'];
        $valores['grade'] = $linhas['grade'];
        $valores['comp'] = $linhas['comp'];
        $valores['tam'] = $linhas['tam'];
    }else{
        $valores['nome'] = '';
    }
    return json_encode($valores);
}
if(isset($_GET['cpf'])){
    $cpf = $_GET['cpf'];
    echo retorna1($cpf, $conn);
}