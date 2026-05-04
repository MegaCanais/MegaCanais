<?php 
include ('includes/header.php');

// Nome da tabela
$table_name = "ibocode";
$pagem = "activation_code.php";
$newuser = "code_create.php";

$results_per_page = 6;

if (isset($_GET['view'])) {
    $page = $_GET['view'];
} else {
    $page = 1;
}

$start_from = ($page - 1) * $results_per_page;

// Funcionalidade de pesquisa
$searchTerm = isset($_GET['search']) ? $_GET['search'] : '';
$searchQuery = '';
$placeholders = array();

if (!empty($searchTerm)) {
    $searchQuery = "ac_code LIKE :searchTerm OR username LIKE :searchTerm";
    $placeholders[':searchTerm'] = "%$searchTerm%";
}

// Recupera o total de registros com base nos critérios de pesquisa
$countResult = $db->selectWithCount($table_name, "id", $searchQuery, $placeholders);
$totaleview = $countResult[0]['total'];
$total_pages = ceil($totaleview / $results_per_page);

// Busca os registros com base no filtro de pesquisa
$res = $db->select($table_name, '*', $searchQuery, 'id ASC LIMIT :start_from, :results_per_page', array_merge($placeholders, [':start_from' => $start_from, ':results_per_page' => $results_per_page]));

// Deletar linha
if(isset($_GET['delete'])){
    $db->delete($table_name, 'id = :id',[':id' => $_GET['delete']]);
    echo "<script>window.location.href='".$pagem."?status=2'</script>";
}

?>
<style>
  .pagination-gap {
  margin-left: 2px; 
  margin-right: 2px; 
  background-color: red; 
  color: white; 
  padding: 5px 10px;
}

.pagination-red {
  margin-left: 2px; 
  margin-right: 2px; 
  background-color: red; 
  color: white; 
  text-align: center; 
  padding: 5px 10px;
}
.text-color{
    color: white;
}

</style>
<div class="modal fade" id="confirm-delete" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content" style="background-color: black;">
            <div class="modal-header">
                <h2 style="color: white;">Confirmar</h2>
            </div>
            <div class="modal-body" style="color: white;">
                Você realmente deseja excluir?
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-primary" data-dismiss="modal">Cancelar</button>
                <a style="color: white;" class="btn btn-danger btn-ok">Excluir</a>
            </div>
        </div>
    </div>
</div>
<div class="col-md-12 mx-auto ctmain-table">
    <div class="card-body">
        <div class="card ctcard">
            <div class="card-header card-header-warning">
                <center>
                    <h2><i class="icon icon-commenting"></i> Código de Ativação</h2>
                </center>
            </div>
            <div class="card-body">
                <div class="col-12">
                    <center>
                        <a id="button" href="./<?=$newuser ?>" class="btn btn-info">Novo Código de Ativação</a>
                    </center>
                </div>
                <br><br>
                <form method="get" class="mb-3">
                        <div class="form-group ctinput">
                            <div class="input-group">
                                <input type="text" name="search" class="form-control" placeholder="Pesquisar por Mac Address ou Título">
                                <div class="input-group-append">
                                    <button type="submit" class="btn btn-primary">Pesquisar</button>
                                </div>
                            </div>
                        </div>
                    </form>
                <br>
                <div class="table-responsive">
                    <table class="table table-striped table-sm">
                        <thead style="color:white!important">
                            <tr>
                                <th>Código de Ativação</th>
								<th>Status do Usuário</th>
                                <th>DNS</th>
                                <th>&nbsp;&nbsp;&nbsp;Excluir</th>
                            </tr>
                        </thead>
                        <?php foreach ($res as $row) { ?>
                        <tbody>
                            <tr>
                                <td><?=$row['ac_code'] ?></td>
                        		<td style="color: <?= $row['status'] == 'NotUsed' ? 'green' : 'red' ?>"><?= $row['status'] ?></td>
                                <td><?=$row['url'] ?></td>
                                <td>
                                    &nbsp;&nbsp;&nbsp;
                                    <a class="btn btn-danger btn-ok" href="#" data-href="<?=$pagem ?>?delete=<?=$row['id'] ?>" data-toggle="modal" data-target="#confirm-delete"><i class="fa fa-trash-o"></i></a>                  
                                    </td>
                            </tr>
                        </tbody>
                        <?php } ?>
                    </table>
                </div>
                <?php if ($results_per_page < $totaleview) { ?>
                    <div class="pagination">
                        <?php if ($page > 1) { ?>
                            <a class="pagination pagination-gap" href='<?=$pagem ?>?view=<?php echo ($page - 1); ?><?php echo $searchTerm; ?>'>&lt; Anterior</a>
                        <?php } ?>
                        <?php for ($i = 1; $i <= $total_pages; $i++) { ?>
                            <?php if ($i == $page) { ?>
                                <a class="active pagination pagination-red" href='<?=$pagem ?>?view=<?php echo $i; ?><?php echo $searchTerm; ?>'>[<?php echo $i; ?>]</a>
                            <?php } else { ?>
                                <a class="pagination pagination-gap" href='<?=$pagem ?>?view=<?php echo $i; ?><?php echo $searchTerm; ?>'><?php echo $i; ?></a>
                            <?php } ?>
                        <?php } ?>
                        <?php if ($page < $total_pages) { ?>
                            <a class="pagination pagination-gap" href='<?=$pagem ?>?view=<?php echo ($page + 1); ?><?php echo $searchTerm; ?>'>Próximo &gt;</a>
                        <?php } ?>
                    </div>
                <?php } ?>
            </div>
        </div>
    </div>
</div>
<?php include ('includes/footer.php');?>

</body>

</html>
