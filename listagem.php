<?PHP
  include_once 'verifica_sessao.php';
  if(isset($_GET['acao'])=='logout')
     @session_destroy();
?>     
<html>
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link href="css/estilo.css" rel="stylesheet">
        <script type="text/javascript" src="js/jquery-3.4.1.js"></script>
        <script type="text/javascript" src="js/jquery.mask.min.js"></script>
        <link rel="shortcut icon" type="image/png" href="image/favicon.png"/>
<!--formatação dos inputs------------------------------------------------------------>
<script>  
$(document).ready(function() {
  $('#inputOculto').hide();
  $('#inputOculto2').hide();
  //$('#inputConsultar').hide();
  $('#opcao').change(function() {
    if($('#opcao').val() == 'cpf'){
        $("#cpf").mask("'000.000.000-00'");
        $(document).on('keydown', '[data-mask-for-cpf-cnpj]', function (e) {
                var digit = e.key.replace(/\D/g, '');
                var value = $(this).val().replace(/\D/g, '');
                var size = value.concat(digit).length;
                $(this).mask((size <= 11) ? '000.000.000-00' : '00.000.000/0000-00');
        });
    }
    if ($('#opcao').val() == 'status') {
          $('#inputConsultar').hide();
          $('#inputOculto2').show();
          $('#inputOculto').hide();
    } else {
        if ($('#opcao').val() == 'periodo') {
          $('#inputConsultar').hide();
          $('#inputOculto2').hide();
          $('#inputOculto').show();
      }
      else{
      $('#inputOculto').hide();
      $('#inputOculto2').hide();
      $('#inputConsultar').show();
    }
  }
})
});

</script>
<script>


    
</script>
<!------------------------------------------------------------------------------------>
     <title>Gerenciamento de Acesso</title>
    </head>
    <body class="style">
      <div class="div1">
        <img class="vertical-align" src="image/yara.png"/>  
        CONTROLE DE ENTRADA E SAÍDA PARA CARREGAMENTO<br><br>
      </div>
       <div class="p1">
            <div class="back"> <p align="left"><a href="acesso.php"><img src="image/voltar.png" title="Voltar"/></a></p></div>
            <p align="right">
                <?php echo 'Usuário logado: '.$_SESSION['login'].' / '?>
                <a href="login.php?acao=logout">Sair</a><br><br>
            </p><br>
            <center>
                <p><strong>Registros de Entrada e Saída - Caminhões</p></strong><br><br>
                <div class="conteudo1">
                
                <?php 
                echo'<form name="consultar" action="listar.php" method="POST" enctype="multipart/form-data">'
                .'<table><tr>'
                .'<td>Buscar por: <select name="opcao" id="opcao" required class="input_buton">'
                                .'<option selected> </option>'
                                .'<option value="cpf">CPF</option>'
                                .'<option value="periodo">PERIODO</option>'
                                .'<option value="status">STATUS</option>'
                                .'</select></td>'
                    
                .'<td><div id="inputConsultar">'
                .'<input type="text" name="consultar" id="consultar" class="input_buton" class="form-control" data-mask-for-cpf-cnpj>'
                .'</div></td>'
                .'</tr>'
                .'<td><br><br><div id="inputOculto">'
                .'<input type="date" name="dataI" class="input_buton"/> à <input type="date" name="dataF" class="input_buton"/>'
                .'</div>'
                .'<div id="inputOculto2">'
                   .'&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<select name="status" id="status" class="input_buton">'
                       .'<option selected> </option>'
                       .'<option value="Aguardando">AGUARDANDO</option>'
                       .'<option value="Desistencia">DESISTENCIA</option>'
                       .'<option value="Concluido">CONCLUÍDO</option>'
                   .'</select>'
                 .'</div></td></tr>'
                .'</table><br><br>'
                .'<input type="submit" name="search" value="BUSCAR" class="botaosubmit"/> <br><br>'
                 .'</form>'
                ?>
                </div>
            </center>
        </div>
        <div class="footer" >
            <img class="img-fluid" src="image/copyright.png"/>
            POWERED BY REBECA SANTANA - 2020               
        </div>
    </body>
</html>