<?PHP
  include("verifica_sessao.php");
  
  if(isset($_GET['acao'])=='logout')
     @session_destroy();
  
  if (isset($_REQUEST['editar'])){
    $motorista= $_REQUEST['motorista'];
    $cpf= $_REQUEST['cpf'];
    $cnh= $_REQUEST['cnh'];
    $valcnh= $_REQUEST['valcnh'];
    $data= $_REQUEST['data'];
    $cliente= $_REQUEST['cliente'];
    $entradaPor= $_REQUEST['entradaPor'];
    $entradaPatio= $_REQUEST['entradaPatio'];
    $status= $_REQUEST['status'];
    $obs= $_REQUEST['obs'];
    $id= $_REQUEST['id'];
    $placac= $_REQUEST['placac'];
    $placacv= $_REQUEST['placacv'];
    $grade= $_REQUEST['grade'];
    $categoria= $_REQUEST['tipocam'];
    $tam= $_REQUEST['tam'];
    $comp=$_REQUEST['comp'];
    $transp=$_REQUEST['transp'];
    $mopp=$_REQUEST['mopp'];
    $fone=$_REQUEST['fone'];
    $operacao=$_REQUEST['operacao'];
    $pedido=$_REQUEST['pedido'];
    $catcnh=$_REQUEST['catcnh'];
    $epis= $_REQUEST['epi'];
    $epi=  explode(', ', $epis);
    $vendor=$_REQUEST['vendor'];
    $frete=$_REQUEST['frete'];
  }
  
  ?>  
<html>
    <head>
        <meta charset="UTF-8">
        <link href="css/estilo.css" rel="stylesheet">
        <link rel="shortcut icon" type="image/png" href="image/favicon.png"/>
        <script type="text/javascript" src="js/jquery-3.4.1.js"></script>
        <script type="text/javascript" src="js/jquery.mask.min.js"></script>
<!----------------formatação dos inputs---------------------------------------------->
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
            
        </script>
<!------------------------------------------------------------------------------------>
     <title>CONTROLE DE ACESSO</title>
    </head>
    <body class="style">
      <div class="div1">
        <img class="vertical-align" src="image/yara.png"/>  
        CONTROLE DE MARCAÇÃO<br><br>
      </div>
        <div class="p1">
            <div class="back"> <p align="left"><a href="acesso.php"><img src="image/voltar.png" title="Voltar"/></a></p></div>
            <div class="back"> <p align="left"><a href="index.php"><img src="image/home.png" title="Página Inicial" alter="Home"/></a></p></div>
            <p align="right">
                <?php echo 'Usuário logado: '.$_SESSION['login'].' / '?>
                <a href="login.php?acao=logout">Sair</a><br><br>
            </p>
            <center><strong><p>ALTERAR INFORMAÇÕES</p></strong></center>
            <div class="conteudo1">
           
                <form name="registro" action="atualizaccess.php" method="post" enctype="multipart/form-data">
                <form name="cadastro" method="post" enctype="multipart/form-data">
                Motorista: <input type="text" name="motorista" id="motorista" size="30" value="<?php echo $motorista?>" required class="input_buton"/>&nbsp;&nbsp;
                CPF: <input type="text" name="cpf" id="cpf" value="<?php echo $cpf?>" required class="input_buton" class="form-control" data-mask-for-cpf-cnpj>&nbsp;&nbsp;
                CNH: <input type="text" name="cnh" maxlength="15"  id="cnh" value="<?php echo $cnh?>" required class="input_buton"/>&nbsp;&nbsp;
                Val. CNH: <input type="date" name="valcnh" id="valcnh" value="<?php echo $valcnh?>" required class="input_buton"/>&nbsp;&nbsp;
                Categoria CNH: <input type="text" size="1" maxlength="1" name="catcnh" id="catcnh"  value="<?php echo $catcnh?>" onkeyup="maiuscula(this)" required class="input_buton"/>&nbsp;&nbsp;
                MOPP <select name="mopp" id="mopp" required class="input_buton">
                                <option value="<?php echo $mopp?>" selected><?php echo $mopp?></option>
                                <option value="SIM">SIM</option>
                                <option value="NÃO">NÃO</option>
                </select>&nbsp;&nbsp;
                Telefone: <input type="text" name="fone" maxlength="30" value="<?php echo $fone?>" required class="input_buton" class="form-control" onkeypress="$(this).mask('(00) 0 0000-0000 / 0 0000-0000');"><br><br><br>
                Placa Cavalo/UF: <input type="text" name="placacv"  size="10" value="<?php echo $placacv?>" required class="input_buton"/>&nbsp;&nbsp;
                Placa Carreta/UF:  <input type="text" name="placac"  size="10" value="<?php echo $placac?>" required class="input_buton"/>&nbsp;&nbsp;
                Vendor: <input type="text" name="vendor" size="10" value="<?php echo $vendor?>" required class="input_buton"/>&nbsp;&nbsp;
                Transportadora: <input type="text" name="transp"  size="45" value="<?php echo $transp?>"required class="input_buton"/>&nbsp;&nbsp;
                Cliente: <input type="text" name="cliente" size="45"  value="<?php echo $cliente?>"required class="input_buton"/><br><br><br>
                Data: <input name="data" type="date" value="<?php echo $data?>" class="input_buton"/>&nbsp;&nbsp;
                Entrada Patio: <input name="entradaPatio" type="time"  value="<?php echo $entradaPatio?>" class="input_buton"/>&nbsp;&nbsp;
                Entrada Portaria: <input name="entradaPor" type="time"  value="<?php echo $entradaPor?>" class="input_buton"/>&nbsp;&nbsp;
                Operação: <select name="operacao" id="operacao" required class="input_buton">
                                <option value="<?php echo $operacao?>" selected><?php echo $operacao?></option>
                                <option value="Carregamento">Carregamento</option>
                                <option value="Descarga">Descarga</option>
                                
                </select>&nbsp;&nbsp;
                Status <select name="status" id="status" required class="input_buton">
                                <optionvalue="<?php echo $status?>" selected><?php echo $status?></option>
                                <option value="Aguardando">Aguardando</option>
                                
                </select>&nbsp;&nbsp;
                Tipo Cam: <select name="tipocam" id="tipocam" required class="input_buton">
                                <option value="<?php echo $categoria?>" selected><?php echo $categoria?></option>
                                <option value="TRUCK">TRUCK</option>
                                <option value="BITRUCK">BI-TRUCK</option>
                                <option value="CACAMBA">CAÇAMBA</option>
                                <option value="LS SIMPLES">LS SIMPLES</option>
                                <option value="LS TRUCK">LS TRUCK</option>
                                <option value="VANDERLEIA">VANDERLEIA</option>
                                <option value="BITREM">BITREM</option>
                                <option value="RODOTREM">RODOTREM</option></select> &nbsp;&nbsp;
                
                OBS.: <input type="text" name="obs" value="<?php echo $obs?>" size="45" class="input_buton"/><br><br><br>
                Nº Pedido: <input type="text" name="pedido"  size="12" value="<?php echo $pedido?>" class="input_buton"/>&nbsp;&nbsp;
                Frete: <select name="frete" id="frete" required class="input_buton">
                    <option value="<?php echo $frete?>"selected><?php echo $frete?></option>
                                            <option value="CIF">CIF</option>
                                            <option value="FOB">FOB</option>
                       </select> &nbsp;&nbsp;&nbsp;&nbsp;
                Grade: <select name="grade" id="tipo" required class="input_buton">
                                            <option value="<?php echo $grade?>" selected><?php echo $grade?></option>
                                            <option value="ALTA">ALTA</option>
                                            <option value="BAIXA">BAIXA</option></select> &nbsp;&nbsp;
                Comprimento: <select name="comp" id="comp" required class="input_buton">
                                         <option value="<?php echo $comp?>" selected><?php echo $comp?></option>
                                         <option value="CURTO">CURTO</option>
                                         <option value="LONGO">LONGO</option></select>&nbsp;&nbsp;
                Tamanho: <select name="tam" id="comp" required class="input_buton"> 
                                         <option value="<?php echo $tam?>" selected><?php echo $tam?></option>
                                         <option value="25MT">25MT</option>
                                         <option value="30MT">30MT</option>
                                         <option value="SIDER">SIDER</option></select>&nbsp;&nbsp;
               
                EPI's: &nbsp;&nbsp;<input type="checkbox" name="epi[]" value="Capacete"<?php foreach ($epi as $valor) if($valor == 'Capacete'){ echo "checked"; } ?>>Capacete</input>&nbsp;&nbsp;
                <input type="checkbox" name="epi[]" value="Oculos"<?php foreach ($epi as $valor)if($valor == 'Oculos'){ echo "checked"; } ?>>Óculos</input>&nbsp;&nbsp;
                                 <input type="checkbox" name="epi[]" value="Sapato Fechado"<?php foreach ($epi as $valor) if($valor == 'Sapato Fechado'){ echo "checked"; } ?>>Sapato Fechado</input>&nbsp;&nbsp;
                                 <input type="checkbox" name="epi[]" value="Faixa Refletiva"<?php foreach ($epi as $valor) if($valor == 'Faixa Refletiva'){ echo "checked"; } ?>>Faixa Refletiva</input>&nbsp;&nbsp;
                                 <input type="checkbox" name="epi[]" value="Nenhum"<?php foreach ($epi as $valor) if($valor == 'Nenhum'){ echo "checked"; } ?>>Nenhum dos Anteriores</input>
                <br><br><br><br>   
                <input type="hidden" name="id" value="<?php echo $id?>"/>&nbsp;&nbsp;
               <center>
                    <input type="submit" name="atualizar" value="Alterar" class="botaosubmit"/>&nbsp;&nbsp;
                    <input type="reset" name="reset" value="Limpar" class="botaosubmit"/>&nbsp;&nbsp;
                </center>
                
             </form>
              </div>
            
        </div>
        <div class="footer" >
              EQUIPE DE TI - 2019                
        </div>
    </body>
</html>