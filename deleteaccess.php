<?php
include("funcoes.php");

if(isset($_REQUEST['delete'])){
   $opcao=$_REQUEST['excluir'];
   $campo= $_REQUEST['campo1']; 
   
}
if($opcao =='true'){
    if(excluir_acesso($conexao, $campo)){
      echo '<script>alert("Check In excluído com sucesso!!!");</script>';
      echo '<script>window.location="consultaccess.php"</script>';
    }
    else{ echo '<script>alert("ERRO ao Excluir!!!");</script>';}
}
else{
    echo '<script>alert("Ação Cancelada!!!");</script>';
    echo '<script>window.location="consultaccess.php"</script>';
}
?>

