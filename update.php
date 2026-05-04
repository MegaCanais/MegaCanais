<?php 
include ('includes/header.php');
$table_name = 'appupdate';
$page_name = 'atualizar';
$data = ['nversion' => '3.9','nurl' => 'https://apk_download.url'];
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
                            <h2><i class="icon icon-bullhorn"></i> Atualização Remota</h2>
                        </center>
                    </div>
                    
                    <div class="card-body">
                            <form method="post">
                                <div class="form-group ctinput">
                                    <label class="form-label " >Nova versão de atualização</label>
                                        <input class="form-control"  name="nversion" value="<?=$res[0]['nversion'] ?>" type="text"/>
                                </div>
                                <div class="form-group ctinput">
                                    <label class="form-label " >URL de download do APK</label>
                                        <input class="form-control"  name="nurl" value="<?=$res[0]['nurl'] ?>" type="text"/>
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