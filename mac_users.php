<?php 
include ('includes/header.php');

// Nome da tabela
$nome_tabela = "ibo";
$página = "mac_users.php";
$novo_usuario = "users_create.php";
$atualizar_usuario = "users_edite.php";
$adicionar_trial = "setup_trial.php?create";

$resultados_por_página = 6;

if (isset($_GET['view'])) {
    $página_atual = $_GET['view'];
} else {
    $página_atual = 1;
}

$iniciar_de = ($página_atual - 1) * $resultados_por_página;

// Funcionalidade de busca
$termoBusca = isset($_GET['search']) ? $_GET['search'] : '';
$consultaBusca = '';
$placeholders = array();

if (!empty($termoBusca)) {
    $consultaBusca = "mac_address LIKE :termoBusca OR title LIKE :termoBusca";
    $placeholders[':termoBusca'] = "%$termoBusca%";
}

// Recuperar o total de registros com base no critério de busca
$resultadoContagem = $db->selectWithCount($nome_tabela, "id", $consultaBusca, $placeholders);
$totalVisualizacoes = $resultadoContagem[0]['total'];
$total_páginas = ceil($totalVisualizacoes / $resultados_por_página);

// Buscar registros com base no filtro de busca
$res = $db->select($nome_tabela, '*', $consultaBusca, 'id ASC LIMIT :iniciar_de, :resultados_por_página', array_merge($placeholders, [':iniciar_de' => $iniciar_de, ':resultados_por_página' => $resultados_por_página]));

// Deletar linha
if(isset($_GET['delete'])){
    $db->delete($nome_tabela, 'id = :id',[':id' => $_GET['delete']]);
    echo "<script>window.location.href='".$página."?status=2'</script>";
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
                    <h2><i class="icon icon-commenting"></i> Usuários Atuais</h2>
                </center>
            </div>
            <div class="card-body">
                <div class="col-12">
                    <center>
                        <a id="button" href="./<?=$novo_usuario ?>" class="btn btn-info">Novo DNS/Usuário</a>
                    </center>
                </div>
                <br><br>
                <form method="get" class="mb-3">
                        <div class="form-group ctinput">
                            <div class="input-group">
                                <input type="text" name="search" class="form-control" placeholder="Buscar por Mac Address ou Título">
                                <div class="input-group-append">
                                    <button type="submit" class="btn btn-primary">Buscar</button>
                                </div>
                            </div>
                        </div>
                    </form>
                <br>
                <div class="table-responsive">
                    <table class="table table-striped table-sm">
                        <thead style="color:white!important">
                            <tr>
                                <th>Título</th>
                                <th>Mac Address</th>
                                <th>Nome de Usuário</th>
                                <th>Proteger Este</th>
                                <th>DNS</th>
                                <th>Editar&nbsp;&nbsp;&nbsp;Adicionar Trial&nbsp;&nbsp;&nbsp;Excluir</th>
                            </tr>
                        </thead>
                        <?php foreach ($res as $linha) { ?>
                        <tbody>
                            <tr>
                                <td><?=$linha['title'] ?></td>
                                <td><?=$linha['mac_address'] ?></td>
                                <td><?=$linha['username'] ?></td>
                        		<td><?=$linha['protection'] == '1' ? 'SIM' : 'NÃO' ?></td>
                                <td><?=$linha['url'] ?></td>
                                <td>
                                    <a class="btn btn-info btn-ok" href="<?=$atualizar_usuario ?>?update=<?=$linha['id'] ?>"><i
                                            class="fa fa-pencil-square-o"></i></a>
                                    &nbsp;&nbsp;&nbsp;
                                    <a class="btn btn-info btn-ok" href="<?=$adicionar_trial ?>&index=<?=$linha['mac_address'] ?>"><i
                                            class="fa fa-calendar"></i></a>
                                    &nbsp;&nbsp;&nbsp;
                                    <a class="btn btn-danger btn-ok" href="#" data-href="<?=$página ?>?delete=<?=$linha['id'] ?>" data-toggle="modal" data-target="#confirm-delete"><i class="fa fa-trash-o"></i></a>                  
                                    </td>
                            </tr>
                        </tbody>
                        <?php } ?>
                    </table>
                </div>
                <?php if ($resultados_por_página < $totalVisualizacoes) { ?>
                    <div class="pagination">
                        <?php if ($página_atual > 1) { ?>
                            <a class="pagination pagination-gap" href='<?=$página ?>?view=<?php echo ($página_atual - 1); ?><?php echo $termoBusca; ?>'>&lt; Anterior</a>
                        <?php } ?>
                        <?php for ($i = 1; $i <= $total_páginas; $i++) { ?>
                            <?php if ($i == $página_atual) { ?>
                                <a class="active pagination pagination-red" href='<?=$página ?>?view=<?php echo $i; ?><?php echo $termoBusca; ?>'>[<?php echo $i; ?>]</a>
                            <?php } else { ?>
                                <a class="pagination pagination-gap" href='<?=$página ?>?view=<?php echo $i; ?><?php echo $termoBusca; ?>'><?php echo $i; ?></a>
                            <?php } ?>
                        <?php } ?>
                        <?php if ($página_atual < $total_páginas) { ?>
                            <a class="pagination pagination-gap" href='<?=$página ?>?view=<?php echo ($página_atual + 1); ?><?php echo $termoBusca; ?>'>Próximo &gt;</a>
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
