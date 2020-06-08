<?PHP
  include("verifica_sessao.php");
  if(isset($_GET['acao'])=='logout')
     @session_destroy();
?>     
<html>
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="shortcut icon" type="image/png" href="image/favicon.png"/>
        <link href="css/estilo.css" rel="stylesheet">
        <script type="text/javascript" src="js/jquery-3.4.1.js"></script>
        <script type="text/javascript" src="js/jquery.mask.min.js"></script>
        <script type="text/javascript">
            $("#cpf").mask("'000.000.000-00'");
            $("#uf").mask("'AA'");
            $("#tel").mask("'(00) 0 0000-0000 / 0 0000-0000'");
            $(document).on('keydown', '[data-mask-for-cpf-cnpj]', function (e) {
                var digit = e.key.replace(/\D/g, '');
                var value = $(this).val().replace(/\D/g, '');
                var size = value.concat(digit).length;
                $(this).mask((size <= 11) ? '000.000.000-00' : '00.000.000/0000-00');
            });
            
            $(document).ready(function() {
             $('#inputOculto').hide();
              $('#input1').show();
             $('#opcao').change(function() {
               if ($('#opcao').val() == 'status') {
                   $('#inputOculto').show();
                   $('#input1').hide();
               }
               else{
                 $('#inputOculto').hide();
                 $('#input1').show();  
               }
            });
        });

        </script>
    <title>Logistica</title>
    </head>
    <body class="style">
      <div class="div1">
        <img class="vertical-align" src="image/yara.png"/>   
         LOGÍSTICA <br><br>
      </div>
        <br>
       <div class="p1">
           <div class="back"> <p align="left"><a href="motorista.php"><img src="image/voltar.png" title="Voltar"/></a></p></div>
            <p align= "right" style="margin-right: 20px;">
                <?php echo 'Usuário logado: '.$_SESSION['login'].' / '?>
                <a href="login.php?acao=logout">Sair</a><br><br>
            </p>
          
             <center><strong><p>Consultar Status Motorista</p></strong><br><br><br>
                 <form name="buscar" action="motoristabusca.php" method="POST" enctype="multipart/form-data">
               Buscar por:  <select name="opcao" id="opcao" required class="input_buton">
                                <option value="0" selected> </option>
                                <option value="cpf">CPF</option>
                                <option value="status">STATUS</option>
                            </select> <br><br><br>
              <div id="input1"> <input type="text" name="consultar" id="consultar" class="input_buton" class= "form-control" data-mask-for-cpf-cnpj></div><br>
              <div id="inputOculto"> 
              <select name="status" id="status" class="input_buton">
                            <option selected> </option>
                            <option value="bloqueado">BLOQUEADO</option>
                            <option value="liberado">LIBERADO</option>
              </select>
              </div>
              <br><br><br><br>
              <input type="submit" name="search" value="BUSCAR" class="botaosubmit"/>
                 </form>
             </center>      
          
       </div>
        <div class="footer" >
              EQUIPE DE TI - 2019                
        </div>
    </body>
</html>