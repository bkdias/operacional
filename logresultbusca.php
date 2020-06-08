<?PHP
  include ("_conexao.php");
  include ("verifica_sessao.php");
  include ("funcoes.php");

       if(isset($_GET['acao'])=='logout')
           @session_destroy();
       if(isset($_REQUEST['search']))
          $campo = $_REQUEST['consultar'];
         // echo '$campo';
    ?>
<html>   
<head>
        <link href="css/estilo.css" rel="stylesheet">
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Logistica</title>
        <script type="text/javascript" src="jquery-ui-1.12.1/jquery-ui.js"></script>
        <script type="text/javascript" src="jquery-ui-1.12.1/jquery-ui.min.js"></script>
           <script type="text/javascript">
               //BOTÃO DE CONFIRMAÇÃO PARA EXCLUIR
            function funcao1($vendor){
               decisao = confirm("Deseja excluir o cadastro selecionado???");
                if(decisao){
                    document.altera.excluir.value= true;
                    document.altera.codvendor.value=$vendor;
                }
                else document.altera.excluir.value= false;
            }
        </script>
    </head>
    <body class="style">
     <div class="div1">
           <img class="vertical-align" src="image/yara.png"/>   
           LOGISTICA <br><br>
        </div>
        <div class="p1"> 
            <div class="back"> <p align="left"><a href="logistica.php"><img src="image/voltar.png" title="Voltar"/></a></p></div>
            <p align= "right" style="margin-right: 20px;">
                <?php echo 'Usuário logado: '.$_SESSION['login'].' / '?>
                <a href="login.php?acao=logout">Sair</a>
           </p><br>
         <div class="conteudo1">
             <center><strong><p>Consultar Transportadora<p></strong> 
                 <br><br><br>
            <?php 
                $sql = mysqli_query($conexao,"SELECT * FROM transportadora WHERE nome LIKE '%$campo%' OR vendor LIKE '%$campo%'")or die(mysqli_error($conexao));
                if(mysqli_num_rows($sql)==0){
                    echo '<script>alert("TRANSPORTADORA NÃO CADASTRADA!!")</script>';
                    echo "<script>window.location='logbusca.php';</script>";
                }
                else{
                 echo "<table border='3',border-radius='2px'>";
                    echo "<tr><td><strong><center>Nome</center></strong></td>"
                     ."<td><strong><center>Código Vendor</center></strong></td>"
                     ."<td><strong><center>Ação</center></strong></td>"
                     ."</tr>";

                 while($reg = mysqli_fetch_array($sql)){
                   $id=$reg['id']; $nome=$reg['nome'];$vendor=$reg['vendor'];
                   echo '<tr>
                         <td><font size=2><center>'.$reg['nome'].'</center></td>
                         <td><font size=2><center>'.$reg['vendor'].'</center></td>
                         <td><center><form name="altera" action="logexclusao.php" method="post">
                                       <input type="hidden" name="excluir">
                                       <input type="hidden" name="codvendor">
                                       <input type="submit" value="Excluir" name="delete" class="botaosubmit" onclick="funcao1('.$vendor.')"></form>
                                     
                                        <form name="edita" action="logalteracad.php" method="post">
                                        <input type="hidden" name="id" value="'.$id.'" >
                                        <input type="hidden" name="nome" value="'.$nome.'" >
                                        <input type="hidden" name="codvendor" value="'.$vendor.'" >
                                        <input type="submit" name="editar" value="Editar"  class="botaosubmit"></form>
                                        </center></td>
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