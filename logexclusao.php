<?php
include("funcoes.php");

if(isset($_REQUEST['delete'])){
   $opcao=$_REQUEST['excluir'];
   $campo= $_REQUEST['codvendor']; 
   
}
if($opcao =='true'){
    if(excluirtransp($conexao, $campo)){
      echo '<script>alert("REGISTRO EXCLUÍDO COM SUCESSO!!!");</script>';
      echo '<script>window.location="logbusca.php"</script>';
    
    }
    else
        echo '<script>alert("ERRO!!! REGISTRO NÃO FOI EXCLUÍDO");</script>';
}
else{
    echo '<script>alert("AÇÃO CANCELADA!!!");</script>';
    echo '<script>window.location="logbusca.php"</script>';
}
?>

