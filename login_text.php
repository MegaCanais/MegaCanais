<?php 
include ('includes/header.php');
$table_name = 'logintext';
$page_name = 'login_text';
$data = ['logintitial' => 'Bem-vindo','loginsubtitial' => 'Nosso serviço IPTV. Para o seu entretenimento, temos uma variedade de novos recursos criados especialmente para você. Você está convidado a fazer login e aproveitar.'];
$db->insertIfEmpty($table_name, $data);
$res = $db->select($table_name, '*', '', '');

if(isset($_POST['submit'])){
	unset($_POST['submit']);
	$updateData = $_POST;
	$db->update($table_name, $updateData, 'id = :id',[':id' => 1]);
	echo "<script>window.location.href='". $page_name.".php?status=1'</script>";
}

?>

        <div class="col-md-6 mx-auto ctmain-table">
            <div class="card-body">
                <div class="card text-white ctcard">
                    <div class="card-header card-header-warning">
                        <center>
                            <h2><i class="icon icon-bullhorn"></i> Configuração do Texto na Página de Login</h2>
                        </center>
                    </div>
                    
                    <div class="card-body">
                            <form method="post">
                                <div class="form-group ctinput">
                                    <label class="form-label">Título</label>
                                        <input class="form-control"  name="logintitial" value="<?=$res[0]['logintitial'] ?>" type="text"/>
                                </div>
                                <div class="form-group ctinput">
                                    <label class="form-label">Conteúdo</label>
                                        <input class="form-control"  name="loginsubtitial" value="<?=$res[0]['loginsubtitial'] ?>" type="text"/>
                                </div>
                                <div class="form-group ctinputform-group">
                                    <center>
                                        <button class="btn btn-info" name="submit" type="submit">
                                            <i class="icon icon-check"></i> Enviar
                                        </button>
                                    </center>
                                </div>
                            </form>
                    </div>
                </div>
            </div>
        </div>

<?php include ('includes/footer.php');?>