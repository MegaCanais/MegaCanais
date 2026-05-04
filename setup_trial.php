<?php 
include ('includes/header.php');

//nome da tabela
$table_name = "trial";
$page = "setup_trial.php";

//chamada da tabela
$res = $db->select($table_name, '*', '', '');

//chamada de atualização
@$resU = $db->select($table_name, '*', 'id = :id', '', [':id' => $_GET['update']]);

if(isset($_GET['index'])) {
    $index = $_GET['index'];
} else {
    $index = ""; // Valor padrão
}

if(isset($_POST['submitU'])){
	unset($_POST['submitU']);
	$updateData = $_POST;
	$db->update($table_name, $updateData, 'id = :id',[':id' => $_GET['update']]);
	echo "<script>window.location.href='".$page."?status=1'</script>";
}

//enviar novo
if (isset($_POST['submit'])) {
    // Sanitizar e converter o endereço MAC para maiúsculas
    $macAddress = $_POST['mac_address'];
	$existingSubscriptions = $db->selectWithCount('trial', 'mac_address', 'mac_address = :macAddress', [':macAddress' => $macAddress]);

	if ($existingSubscriptions[0]['total'] > 0) {
        echo '<script>alert("Somente um período de assinatura pode ser adicionado para um único endereço MAC. Edite se desejar fazer alterações.");</script>';
    } else {
        unset($_POST['submit']);
        $db->insert($table_name, $_POST);
        $db->close();
        echo "<script>window.location.href='".$page."?status=1'</script>";
    }
}

//deletar linha
if(isset($_GET['delete'])){
	$db->delete($table_name, 'id = :id',[':id' => $_GET['delete']]);
	echo "<script>window.location.href='".$page."?status=2'</script>";
}

?>
<div class="modal fade" id="confirm-delete" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
    aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content" style="background-color: black;">
            <div class="modal-header">
                <h2 style="color: white;">Confirmar</h2>
            </div>
            <div class="modal-body" style="color: white;">
                Você realmente deseja deletar?
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-primary" data-dismiss="modal">Cancelar</button>
                <a style="color: white;" class="btn btn-danger btn-ok">Deletar</a>
            </div>
        </div>
    </div>
</div>
<?php
if (isset($_GET['create'])){

//formulário de criação
?>
<script>
document.addEventListener("DOMContentLoaded", function() {
    var macAddressInput = document.getElementById("mac_address");

    macAddressInput.addEventListener("input", function(e) {
        var value = e.target.value;
        value = value.replace(/[^a-fA-F0-9]/g, "").toUpperCase();

        var formattedValue = "";
        for (var i = 0; i < value.length; i++) {
            formattedValue += value[i];
            if ((i + 1) % 2 === 0 && i < value.length - 1) {
                formattedValue += ":";
            }
        }

        e.target.value = formattedValue;
    });
});
</script>
<script>
function getParameterByName(name, url) {
  name = name.replace(/[\[\]]/g, "\\$&");
  var regex = new RegExp("[?&]" + name + "(=([^&#]*)|&|#|$)"),
      results = regex.exec(url);
  if (!results) return "";
  if (!results[2]) return "";
  return decodeURIComponent(results[2].replace(/\+/g, " "));
}
</script>
<div class="col-md-12 mx-auto ctmain-table">
    <div class="card-body">
        <div class="card ctcard">
            <div class="card-header card-header-warning">
                <center>
                    <h2><i class="icon icon-bullhorn"></i> Configurar Período de Teste</h2>
                </center>
            </div>

            <div class="card-body">
                <div class="col-12">
                    <h3>Adicionar Endereço MAC e Data de Expiração</h3>
                </div>
                <form method="post">
                    <div class="form-group ctinput">
                        <label class="form-label " for="mac_address">Endereço MAC</label>
                        <input class="form-control" id="mac_address" name="mac_address" placeholder="Endereço MAC"
                            type="text" value="<?php echo strtoupper($index); ?>" />
                    </div>
                    <div class="form-group ctinput">
                        <label class="form-label " for="expire_date">Data de Expiração</label>
                        <input class="form-control" id="datepicker" name="expire_date" placeholder="Data de Expiração"
                            type="date" />
                    </div>
                    <div class="form-group ctinput">
                        <center>
                            <button class="btn btn-info " name="submit" type="submit">
                                <i class="icon icon-check"></i> Enviar
                            </button>
                        </center>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<?php 
}else if (isset($_GET['update'])){ 

//formulário de atualização
?>
<div class="col-md-12 mx-auto ctmain-table">
    <div class="card-body">
        <div class="card ctcard">
            <div class="card-header card-header-warning">
                <center>
                    <h2><i class="icon icon-bullhorn"></i> Configurar Período de Teste</h2>
                </center>
            </div>

            <div class="card-body">
                <div class="col-12">
                    <h3>Editar Endereço MAC e Data de Expiração</h3>
                </div>
                <form method="post">
                    <input type="hidden" name="id" value="<?=$_GET['update'] ?>">
                    <div class="form-group ctinput">
                        <label class="form-label " for="mac_address">Endereço MAC</label>
                        <input class="form-control" id="mac_address" name="mac_address" placeholder="Endereço MAC"
                            value="<?=$resU[0]['mac_address'] ?>" type="text" disabled/>
                    </div>
                    <div class="form-group ctinput">
                        <label class="form-label " for="expire_date">Data de Expiração</label>
                        <input class="form-control" id="datepicker" name="expire_date" placeholder="Data de Expiração"
                            value="<?=$resU[0]['expire_date'] ?>" type="date" />
                    </div>
                    <div class="form-group ctinput">
                        <center>
                            <button class="btn btn-info " name="submitU" type="submit">
                                <i class="icon icon-check"></i> Enviar
                            </button>
                        </center>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<?php
 }else{
//tabela principal/formulário
	 ?>

<div class="col-md-12 mx-auto ctmain-table">
    <div class="card-body">
        <div class="card ctcard">
            <div class="card-header card-header-warning">
                <center>
                    <h2><i class="icon icon-commenting"></i> Períodos de Teste Atuais</h2>
                </center>
            </div>
            <div class="card-body">
                <div class="col-12">
                    <center>
                        <a id="button" href="./<?=$page ?>?create" class="btn btn-info">Novo DNS/Usuário</a>
                    </center>
                </div>
                <br>
                <div class="table-responsive">
                    <table class="table table-striped table-sm">
                        <thead style="color:white!important">
                            <tr>
                                <th>Endereço MAC</th>
                                <th>Data de Expiração</th>
                                <th>Editar&nbsp&nbsp&nbspDeletar</th>
                            </tr>
                        </thead>
                        <?php foreach ($res as $row) {
							?>
                        <tbody>
                            <tr>
                                <td><?=$row['mac_address'] ?></a></td>
                                <td><?=$row['expire_date'] ?></td>
                                <td>
                                    <a class="btn btn-info btn-ok" href="<?=$page ?>?update=<?=$row['id'] ?>"><i
                                            class="fa fa-pencil-square-o"></i></a>
                                    &nbsp&nbsp&nbsp
                                    <a class="btn btn-danger btn-ok" href="#"
                                        data-href="<?=$page ?>?delete=<?=$row['id'] ?>" data-toggle="modal"
                                        data-target="#confirm-delete"><i class="fa fa-trash-o"></i></a>
                                </td>
                            </tr>
                        </tbody>
                        <?php
							}?>
                    </table>
                </div>
            </div>
        </div>
    </div>


</div>
<?php }?>

<?php include ('includes/footer.php');?>

</body>

</html>
