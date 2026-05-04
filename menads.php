<?php 
include ('includes/header.php');

// Nome da tabela
$table_name = "menuads";
$pagem = "menads.php";
$newads = "menuads_create.php";
$updateads = "menuads_edit.php";

$res = $db->select($table_name, '*', '', '');

// Deletar linha
if(isset($_GET['delete'])){
    $db->delete($table_name, 'id = :id',[':id' => $_GET['delete']]);
    echo "<script>window.location.href='".$pagem."?status=2'</script>";
}

?>
<style>
        img.preview {
            width: 200px; /* Ajustar a largura conforme necessário */
            height: auto; /* Manter a proporção da imagem */
        }
</style>
<div class="modal fade" id="confirm-delete" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
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
<div class="col-md-12 mx-auto ctmain-table">
    <div class="card-body">
        <div class="card ctcard">
            <div class="card-header card-header-warning">
                <center>
                    <h2><i class="icon icon-commenting"></i> Anúncios Manuais</h2>
                </center>
            </div>
            <div class="card-body">
                <div class="col-12">
                    <center>
                        <a id="button" href="./<?=$newads ?>" class="btn btn-info">Novo Anúncio</a>
                    </center>
                </div>
                <br><br>
                <div class="table-responsive">
                    <table class="table table-striped table-sm">
                        <thead style="color:white!important">
                            <tr>
                                <th>Título</th>
                                <th>Pré-visualização</th>
                                <th>Editar&nbsp;&nbsp;&nbsp;&nbsp;Deletar</th>
                            </tr>
                        </thead>
                        <?php foreach ($res as $row) { ?>
                        <tbody>
                            <tr>
                                <td><?=$row['title'] ?></td>
                                <td><img src="<?=$row['url'] ?>" alt="Pré-visualização da imagem" class="preview"></td>
                                <td>
                                    <a class="btn btn-info btn-ok" href="<?=$updateads ?>?update=<?=$row['id'] ?>"><i
                                            class="fa fa-pencil-square-o"></i></a>
                                    &nbsp;&nbsp;&nbsp;
                                    <a class="btn btn-danger btn-ok" href="#" data-href="<?=$pagem ?>?delete=<?=$row['id'] ?>" data-toggle="modal" data-target="#confirm-delete"><i class="fa fa-trash-o"></i></a>                  
                                 </td>
                            </tr>
                        </tbody>
                        <?php } ?>
                    </table>
                </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?php include ('includes/footer.php');?>

</body>

</html>
