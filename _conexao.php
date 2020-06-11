<?php
################################# CONECTA A BASE DE DADOS UTILIZANDO A BIBLIOTECA PDO #################################
include_once 'config.php';
//include_once 'funcoes.php';

class conecta extends config{
    var $pdo;
    function __construct(){
        $this->pdo = new PDO('mysql:host='.$this->host.';dbname='.$this->banco, $this->user, $this->senha.'');
        return $this->pdo;
    }
    //Converte formato de data
    function converte_data($data){
       return $newDate = date("d-m-Y", strtotime($data));
    } 
    function converte_dataTime($data){
      if(!empty($data))
        return $newDate = date("d-m-Y H:i:s", strtotime($data));
    }
    //verifica se o login e a senha existem e realiza o login no sistema
    function login($user,$senha){
        $consulta = $this->pdo->prepare("SELECT * from login WHERE login = :user AND senha = :senha");
        $consulta->bindValue(":user", $user);
        $consulta->bindValue(":senha", $senha);
        $consulta->execute();
        $resultado = $consulta->fetchAll(PDO::FETCH_ASSOC);
        return $resultado;
    }
    //verifica se existe sessão ativa
    
    function verifica_sessao(){
       if (session_status() !== PHP_SESSION_ACTIVE) {
        session_start();
       }
        #Verifica se não existe sessão e redireciona para página de login
        if(!(isset($_SESSION['login']))){
            #Redireciona para página de login
               header("location: login.php");
               die;
        }
    }
    
    //verifica se o usuário tem permissão para acessar o modulo selecionado
    function verificaPermissao($login,$tela){
        $consulta = $this->pdo->prepare("SELECT modulo FROM login WHERE login= :login");
        $consulta->bindValue(":login", $login);
        $consulta->execute();
        $resultado = $consulta->fetch(PDO::FETCH_ASSOC);
        if($resultado){
          $modulos=explode(',', $resultado['modulo']);
          foreach ($modulos as $modulo ){
              if($modulo == $tela){
                return 1;
              }
          }
          return 0;
        }
        else{
          return 0;
        }
    }
    
//retorna a quantidade de linhas da consulta
    function busca($campo){
        $consulta= $this->pdo->prepare("SELECT * FROM cliente WHERE nome LIKE :campo OR cpf_cnpj= :campo1");
        $consulta->bindValue(":campo", "%".$campo."%");
        $consulta->bindValue(":campo1", $campo);
        $consulta->execute();
        $linhas = $consulta->rowCount();
        return $linhas;
    }
    
//retorna os registros limitados pela quantidade a ser exibida na tela
    function buscaCliente($campo,$inicio,$registros){
        $consulta = $this->pdo->prepare("SELECT * FROM cliente WHERE nome LIKE :campo OR cpf_cnpj= :campo1 limit $inicio,$registros");
        $consulta->bindValue(":campo", "%".$campo."%");
        $consulta->bindValue(":campo1", $campo);
        $consulta->execute();
        $resultado = $consulta->fetchAll(PDO::FETCH_ASSOC);
        return $resultado;
    }
//Funcao para recuperar informações do Banco de Dados e popular os inputs da tela com JSON  
    function getInfo($cpf_cnpj){
        $consulta = $this->pdo->prepare("SELECT * FROM cliente WHERE cpf_cnpj= :campo");
        $consulta->bindValue(":campo", $cpf_cnpj);
        $consulta->execute();
        $resultado = $consulta->rowCount();
        if($resultado>0){
            $linha = $consulta->fetchAll(PDO::FETCH_ASSOC);
            foreach($linha as $linhas){
                $valores['nome'] = $linhas['nome'];
                echo $valores['nome'];
            }
        }else{
           $valores['nome'] ='Nao encontrado';
        }
        return json_encode($valores['nome']);          
    }
    
//Função para inserir novo cliente no Banco de Dados    
    function insereCliente($cliente){
        $cpf_cnpj = $cliente[1];
        $consulta = $this->pdo->prepare("SELECT * FROM cliente WHERE cpf_cnpj= :campo");
        $consulta->bindValue(":campo", $cpf_cnpj);
        $consulta->execute();
        if($consulta->rowCount()>0){
            return 0;
        }else{
            $consulta = $this->pdo->prepare("INSERT INTO cliente(nome,cpf_cnpj,tel,email,cidade,uf,obs)
            VALUES('$cliente[0]','$cliente[1]','$cliente[2]','$cliente[3]','$cliente[4]','$cliente[5]','$cliente[6]')");
            if($consulta->execute()){
                return 1;
            }
        }
    }
//Função para deletar cliente do Banco de Dados
    function deleteCliente($id){
        $consulta = $this->pdo->prepare("DELETE FROM cliente WHERE id= :campo");
        $consulta->bindValue(":campo", $id);
        if($consulta->execute()){
            return true;
        }
        else{
            return false;
        }
    }
//Função para importar informações sobre resumo do pedido e enviar ao cliente
    function insereDadosPedido($dados){
        $consulta = $this->pdo->prepare("INSERT INTO pedido (nf,data,cliente,material,qtd,pedido,destino,inter)
        VALUES('$dados[0]','$dados[1]','$dados[2]','$dados[3]','$dados[4]','$dados[5]','$dados[6]','$dados[7]')");
        if($consulta->execute()){
            return true;
        }
        else{
            return false;
        }
    }
//Funcão para listar na tela o status de envio de emails com pedido do cliente    
    function listarPedido(){
        $consulta = $this->pdo->prepare("SELECT * FROM pedido WHERE status=0");
        $consulta->execute();
        $resultado = $consulta->rowCount();
        if($resultado>0){
            $linha = $consulta->fetchAll(PDO::FETCH_ASSOC);
            foreach($linha as $resp){
               $data= converte_data($resp['data']); $id=$resp['id_pedido'];
               echo '<tr>
                <td>'.$resp['nf'].'</td>
                <td>'.$data.'</td>
                <td>'.$resp['cliente'].'</td>
                <td>'.$resp['material'].'</td>
                <td>'.$resp['qtd'].' ton</td>
                <td>'.$resp['pedido'].'</td>
                <td>'.$resp['destino'].'</td>
                <td>'.$resp['inter'].'</td>';
                if($resp['status']==0){
                   echo '<form method="POST">
                   <td align="center"><a href="enviaMail.php?id='.$id.'" class="btn btn-primary btn-sm">Enviar</a>';
                }
                else{
                    echo '<td align="center"><img src="image/check.png"/></td></tr>';
                }
            }     
        }
        echo "</table> <br><br>";
    }
//Envio de email com status do pedido
    function EnvioPedido($id_pedido){
        $consulta = $this->pdo->prepare("SELECT * FROM pedido WHERE status = 1");
        $consulta->execute();
        $resultado = $consulta->rowCount();
        if($resultado>0){
            $linha = $consulta->fetchAll(PDO::FETCH_ASSOC);
            foreach($linha as $linhas){
                $valores['nf'] = $linhas['nf'];
                $valores['data'] = $linhas['data'];
                $valores['cliente'] = $linhas['cliente'];
                $valores['material'] = $linhas['material'];
                $valores['qtd'] = $linhas['qtd'];
                $valores['pedido'] = $linhas['pedido'];
                $valores['destino'] = $linhas['destino'];
                $valores['inter'] = $linhas['inter'];
            }
            $data= converte_data($valores['data']);
            if(EnviarMail($valores, $data)){
                $consulta = $this->pdo->prepare("UPDATE pedido SET status = 1 Where id_pedido= $id_pedido");
                $consulta->execute();
                return true;
            }
        }
        else {
            return false;
        }
    }  
    function atualizaCliente($cliente){
        $id = $cliente[7];
        $consulta = $this->pdo->prepare("UPDATE cliente SET nome ='$cliente[0]' ,cpf_cnpj='$cliente[1]',tel='$cliente[2]',
            email='$cliente[3]',cidade='$cliente[4]',uf='$cliente[5]',obs='$cliente[6]' WHERE id= :campo");
        $consulta->bindValue(":campo", $id);
        if($consulta->execute()){
           return 1;
        }else{
           return 0;
        }
    }
    
    function consultaBloqueio($cpf){
        $consulta= $this->pdo->prepare("SELECT * FROM status_motorista WHERE cpf= :campo");
        $consulta->bindValue(":campo", $cpf);
        $consulta->execute();
        $resultado = $consulta->rowCount();
     //retorna a quantidade de linhas da consulta
       if($resultado>0){  
        $resp = $consulta->fetchAll(PDO::FETCH_ASSOC);
        foreach($resp as $linha){
         if($linha['status']==0){
             return 0;
         }
         else{
             return 1;
         }
        }
       }
       return 0;
    }
    function insereCaminhao($dados){
        $cpf = $dados[1];
        $consulta = $this->pdo->prepare("SELECT * FROM caminhao WHERE cpf= :campo AND status= 'Aguardando'");
        $consulta->bindValue(":campo",$cpf);
        $consulta->execute();
    //Verifica se já tem motorista cadastrado com mesmo CPF e Status Aguardando - Se retornar algum registro, aborta a função;
        $resultado = $consulta->rowCount();  
        if($resultado>0){ //Se retornar algum registro aborta
        return 0;
        }
        else{
            $consulta = $this->pdo->prepare("INSERT INTO caminhao(motorista,cpf,cnh,catcnh,
                placac,cliente,data,entradaPatio,operacao,status,obs,val_cnh,fone,
                placacv,transp,mopp,entradaPor,tipocam,grade,comp,tam,vendor,epi,frete,pedido)
            VALUES('$dados[0]','$dados[1]','$dados[2]','$dados[3]','$dados[4]',"
                    . "'$dados[5]','$dados[6]','$dados[7]','$dados[8]','$dados[9]',"
                    . "'$dados[10]','$dados[11]','$dados[12]','$dados[13]',"
                    . "'$dados[14]','$dados[15]','$dados[16]','$dados[17]','$dados[18]','$dados[19]','$dados[20]','$dados[21]','$dados[22]','$dados[23]','$dados[24]')");
            if($consulta->execute()){
                return true;
            }
            else{
                return false;
            }
        } 
    }
    function buscaCaminhao($campo){
        $consulta = $this->pdo->prepare("SELECT * FROM caminhao WHERE status='Aguardando' AND (motorista LIKE :campo OR cpf= :campo1)");
        $consulta->bindValue(":campo", "%".$campo."%");
        $consulta->bindValue(":campo1", $campo);
        $consulta->execute();
        $resultado = $consulta->fetchAll(PDO::FETCH_ASSOC);
       if($consulta->rowCount()>0){
           return $resultado;
       }
       else return false;
    }
    function checkoutCam($dados){
        $id=$dados[2];
        $consulta= $this->pdo->prepare("SELECT * FROM caminhao WHERE id= :campo");
        $consulta->bindValue(":campo", $id);
        $consulta->execute();
        $resultado = $consulta->rowCount();  
        if($resultado>0){ //Se retornar algum registro atualiza
          $consulta = $this->pdo->prepare("UPDATE caminhao SET status='$dados[0]', saida='$dados[1]' WHERE id= :campo");
          $consulta->bindValue(":campo", $id);  
          if($consulta->execute()){
                return true;
            }
            else{
                return false;
            }
        } 
    }
    function buscaCamStatus($campo){
        $consulta = $this->pdo->prepare("SELECT * FROM caminhao WHERE status= :campo ORDER BY data DESC");
        $consulta->bindValue(":campo", $campo);
        $consulta->execute();
        $resultado = $consulta->fetchAll(PDO::FETCH_ASSOC);
       if($consulta->rowCount()>0){
           return $resultado;
       }
       else {
           return false;
       }
    }
    function buscaCamCPF($campo){
        $consulta = $this->pdo->prepare("SELECT * FROM caminhao WHERE cpf= :campo OR id= :campo ORDER BY data DESC");
        $consulta->bindValue(":campo", $campo);
        $consulta->execute();
        $resultado = $consulta->fetchAll(PDO::FETCH_ASSOC);
       if($consulta->rowCount()>0){
           return $resultado;
       }
       else {
           return false;
       }
    }
    function atualizaCam($reg){
        $id = $reg[21];
        $consulta = $this->pdo->prepare("UPDATE caminhao SET motorista ='$reg[0]',cpf='$reg[1]',cnh='$reg[2]',
        catcnh='$reg[3]',placac='$reg[4]',cliente='$reg[5]',data='$reg[6]',entradaPatio='$reg[7]',operacao='$reg[8]',
        status='$reg[9]',obs='$reg[10]',val_cnh='$reg[11]',fone='$reg[12]',placacv='$reg[13]',transp='$reg[14]',
        mopp='$reg[15]',entradaPor='$reg[16]',tipocam='$reg[17]',grade='$reg[18]',comp='$reg[19]',tam='$reg[20]',
        vendor='$reg[22]',epi='$reg[23]',frete='$reg[24]',pedido='$reg[25]' WHERE id= :campo");
        $consulta->bindValue(":campo", $id);
        if($consulta->execute()){
           return true;
        }else{
           return false;
        }
    }
    
}
