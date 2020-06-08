<?PHP
  include ("_conexao.php");
  include ("verifica_sessao.php");
  include ("funcoes.php");
  if(isset($_GET['acao'])=='logout')
    @session_destroy();
    if(isset($_REQUEST['search']))
      $campo = $_REQUEST['opcao'];
      if($campo=="status")
        $campo1 = $_REQUEST['status'];
      else
        $campo1 = $_REQUEST['consultar'];
?>
<html>   
<head>
    <link href="css/estilo.css" rel="stylesheet">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Logistica</title>
    <script type="text/javascript" src="jquery-ui-1.12.1/jquery-ui.js"></script>
    <script type="text/javascript" src="jquery-ui-1.12.1/jquery-ui.min.js"></script>
</head>
    <body class="style">
     <div class="div1">
        <img class="vertical-align" src="image/yara.png"/>   
           LOGISTICA <br><br>
     </div>
     <div class="p1"> 
       <div class="back"> <p align="left"><a href="motorista.php"><img src="image/voltar.png" title="Voltar"/></a></p></div>
          <p align= "right" style="margin-right: 20px;">
            <?php echo 'Usuário logado: '.$_SESSION['login'].' / '?>
               <a href="login.php?acao=logout">Sair</a>
          </p><br>
       <div class="conteudo1">
           <center><strong><p>Status dos Motoristas<p></strong> 
        <br><br><br>
            <?php 
                $sql = mysqli_query($conexao,"SELECT * FROM status_motorista WHERE cpf ='$campo' OR status='$campo'")or die(mysqli_error($conexao));
                if(mysqli_num_rows($sql)==0){
                    echo '<script>alert("NÃO HÁ REGISTRO NO SISTEMA DE BLOQUEIO PARA O DADO INFORMADO!!")</script>';
                    echo "<script>window.location='motoristaconsultar.php';</script>";
                }
                else{
                 echo "<table border='1'>";
                    echo "<tr><td><strong><center>Nome</center></strong></td>"
                     ."<td><strong><center>CPF</center></strong></td>"
                     ."<td><strong><center>Status</center></strong></td>"
                     ."<td><strong><center>observação</center></strong></td>"
                     ."</tr>";

                while($reg = mysqli_fetch_array($sql)){
                   $nome=$reg['nome'];$cpf=$reg['cpf'];$obs=$reg['obs'];
                   if($reg['status']==0)
                     $status="BLOQUEADO";
                   else $status="LIBERADO";
                   echo '<tr>
                         <td><font><center>'.$reg['nome'].'</center></td>
                         <td><font><center>'.$reg['cpf'].'</center></td>
                         <td><font><center><center>'.$status.'</center></td>
                         <td><font><center><center>'.$reg['obs'].'</center></td>
                        ';
                }
                echo "</table>";
            }?>
         </center>
         </div>
        </div>
        <div class="footer" >
              EQUIPE DE TI - 2019                
        </div>
    </body>
</html>