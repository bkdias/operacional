<?php
include_once '_conexao.php';
$conn = new conecta();
$id= $_GET['id'];

if($conn->EnvioPedido($id)){?>
   <div class='modal fade' id='ModalMail' tabindex='-1' role='dialog' aria-labelledby='exampleModalLabel' aria-hidden='true'>
            <div class='modal-dialog modal-dialog-centered' role='document'>
              <div class='modal-content'>
                <div class='modal-header bg-success text-white'>
                  <h5 class='modal-title' id='ModalMail'>Confirmação de Ação</h5>
                  <button type='button' class='close' data-dismiss='modal' aria-label='Fechar'>
                    <span aria-hidden='true'>&times;</span>
                  </button>
                </div>
                <div class='modal-body'>
                  Email enviado com sucesso!!
                </div>
                <div class='modal-footer'>
                  <button type='button' id='modal-btn-sim' class='btn btn-secondary' data-dismiss='modal'>Fechar</button>
                 </div>
              </div>
            </div>
    </div>   

<?php echo '<script>$("#ModalMail").modal("show")</script>';
      echo "<script>$('#ModalMail').on('hidden.bs.modal', function (e) {
                            window.location='envio_pedido.php';
            })</script>";

}
else{?>
    <div class="modal fade" id="ModalMailErro" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
              <div class="modal-content">
                <div class="modal-header bg-danger text-white">
                  <h5 class="modal-title" id="ModalMailErro">Confirmação de Ação</h5>
                  <button type="button" class="close" data-dismiss="modal" aria-label="Fechar">
                    <span aria-hidden="true">&times;</span>
                  </button>
                </div>
                <div class="modal-body">
                  Erro - Email não enviado!!
                </div>
                <div class="modal-footer">
                  <button type="button" id="modal-btn-sim" class="btn btn-secondary" data-dismiss="modal">Fechar</button>

                </div>
              </div>
            </div>
          </div>
<?php 
    echo '<script>$("#ModalMailErro").modal("show")</script>';
    echo "<script>$('#ModalMailErro').on('hidden.bs.modal', function (e) {
                            window.location='envio_pedido.php';
            })</script>";
}
     
                   
