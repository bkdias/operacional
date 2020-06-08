<?php
include("funcoes.php");
if(isset($_REQUEST['atualizar'])){
    $status= $_REQUEST['status'];
    $horasaida=$_REQUEST['horasaida'];
    $id= $_REQUEST['id'];
    $reg= array($status,$horasaida,$id);          
           
      if($status=='Concluido') 
        if(atualizaccess($reg,$conexao)){
          echo '<script>alert("Dados atualizados com sucesso!!!");</script>';
          echo '<script>window.location="acesso.php"</script>';
        }
      }
      else{
          if($status=='Desistencia'){
          EnviaAlerta($resp)
          
              
          }
      }
          echo '<script>alert("ALTERE O STATUS PARA CONCLUÍDO!!!");</script>';
          echo '<script>window.location="altaccess.php"</script>';
          
      }
  }
?>