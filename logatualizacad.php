<?php
include("funcoes.php");

if(isset($_REQUEST['alterar'])){
   $transp=$_REQUEST['nome'];
   $id=$_REQUEST['id'];
   $codvendor= $_REQUEST['codvendor']; 
   $reg= array($id,$transp,$codvendor);
}
if(atualizatransp($reg,$conexao)){
      echo '<script>alert("DADOS ATUALIZADOS COM SUCESSO!!!");</script>';
      echo '<script>window.location="logbusca.php"</script>';
}
else '<script>alert("ERRO! DADOS NÃO ATUALIZADOS!!!");</script>';
?>

