<?php 
include ('includes/header.php');
$table_name = 'welcome';
$page_name = 'nota';
$data = ['message_one' => 'Ibo Player Pro não vende playlists ou assinaturas', 'message_two' => 'Ibo Player Pro é um Reprodutor de Mídia Geral e não inclui nenhum conteúdo ou playlists'];
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
                            <h2><i class="icon icon-bullhorn"></i> Notificação</h2>
                        </center>
                    </div>
                    
                    <div class="card-body">
                            <form method="post">
                                <div class="form-group ctinput">
                                    <label class="form-label " >Título</label>
                                        <input class="form-control"  name="message_one" value="<?=$res[0]['message_one'] ?>" type="text"/>
                                </div>
                                <div class="form-group ctinput">
                                    <label class="form-label " >Conteúdo</label>
                                        <input class="form-control"  name="message_two" value="<?=$res[0]['message_two'] ?>" type="text"/>
                                </div>
                                <div class="form-group ctinputform-group">
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

<?php include ('includes/footer.php');?>