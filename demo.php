<?php 
include ('includes/header.php');
$table_name = 'demopls';
$page_name = 'demo';
$data = ['mplname' => 'Playlist de Demonstração', 'mdns' => 'adicione seu demo', 'muser' => 'adicione seu demo', 'mpass' => 'adicione seu demo'];
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
                            <h2><i class="icon icon-bullhorn"></i> Configuração de Demo</h2>
                        </center>
                    </div>
                    
                    <div class="card-body">
                            <form method="post">
								<div class="form-group ctinput">
                                    <label class="form-label">Nome da Playlist:</label>
                                        <input class="form-control"  name="mplname" value="<?=$res[0]['mplname'] ?>" type="text"/>
                                </div>
                                <div class="form-group ctinput">
                                    <label class="form-label">DNS:</label>
                                        <input class="form-control"  name="mdns" value="<?=$res[0]['mdns'] ?>" type="text"/>
                                </div>
                                <div class="form-group ctinput">
                                    <label class="form-label">Nome de Usuário:</label>
                                        <input class="form-control"  name="muser" value="<?=$res[0]['muser'] ?>" type="text"/>
                                </div>
								<div class="form-group ctinput">
                                    <label class="form-label">Senha:</label>
                                        <input class="form-control"  name="mpass" value="<?=$res[0]['mpass'] ?>" type="text"/>
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