<html>
     <?php
     include_once '_conexao.php';
     $conn = new conecta();
     
     if(isset($_GET['acao'])=='logout')
            @session_destroy();
     ?>
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link href="css/estilo.css" rel="stylesheet">
        <link rel="shortcut icon" type="image/png" href="image/favicon.png"/>
        <script type="text/javascript" src="js/jquery-3.4.1.js"></script>
        <script type="text/javascript" src="js/jquery.mask.min.js"></script>
        <link href="css/bootstrap.css" rel="stylesheet" type="text/css"/>
        <script src="js/bootstrap.min.js" type="text/javascript"></script>
        <title>Gerenciamento Operacional</title>
    </head>
    <body class="style">
        <div class="div1">
            <img class="img-fluid" src="image/yara.png"/>
            <h5> GERENCIAMENTO OPERACIONAL</h5><br>
        </div>
        <div class="p1">
            <div class="conteudo1">
                <center><br>
                    <?php
           
           #Verifica se o botão entrar foi clicado e atribui o valor digitado nos campos às variaveis 
            if(isset($_POST['entrar'])){
               
                $login = preg_replace('/[^[:alnum:]_.-@]/','', $_POST['login']);
                $senha= addslashes($_POST['senha']);
                
                $result = $conn->login($login, $senha);
               
                if($result){
                  #Inicializa sessão de login                      
                       if (session_status() !== PHP_SESSION_ACTIVE) {
                        session_start();
                       }
                       $_SESSION['login']= $login;
                  #Redireciona para página inicial
                       header("location: index.php");
                }
                else {
                  echo '<div class="form-group col-md-4">'
                      .'<div class="alert-danger"role="alert">'
                         .'Login ou Senha Inválidos'
                      .'</div>'
                    .'</div>';
                   }
                }     
        ?>
                   <form method="POST">
                      <div class="form-group col-md-4">
                        <label for="inputEmail4">Login</label>
                        <input type="login" class="form-control" required name="login" id="login" placeholder="ID">
                      </div>
                      <div class="form-group col-md-4">
                        <label for="inputPassword4">Senha</label>
                        <input type="password" class="form-control" name="senha" id="senha" required placeholder="Senha">
                      </div>
                      <div class="form-group col-md-4">
                        <input type="submit" value="Entrar" id="entrar" name="entrar" class="btn btn-info">
                      </div>
                    </div>
                   </form>
                </center>
            </div>
        </div>
        <div class="footer" >
            <img class="img-fluid" src="image/copyright.png"/>
            POWERED BY REBECA SANTANA - 2020             
        </div>
        
        
    </body>
</html>