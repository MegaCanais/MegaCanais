<?php 
include ('includes/header.php');

// Nome da tabela
$table_name = "leaguestable";
$page = "leagues_table.php";

// Buscar dados das ligas no endpoint JSON
$json_url = "https://www.thesportsdb.com/api/v1/json/60130162/all_leagues.php";
$json_data = file_get_contents($json_url);
$leagues = json_decode($json_data, true);

// Filtrar ligas de futebol
$soccer_leagues = array_filter($leagues['leagues'], function($league) {
    return $league['strSport'] === 'Soccer';
});

// Buscar dados da tabela
$res = $db->select($table_name, '*', '', '');

// Chamada de atualização
@$resU = $db->select($table_name, '*', 'id = :id', '', [':id' => $_GET['update']]);

if(isset($_POST['submitU'])){
    unset($_POST['submitU']);
    $updateData = $_POST;
    $db->update($table_name, $updateData, 'id = :id',[':id' => $_GET['update']]);
    echo "<script>window.location.href='".$page."?status=1'</script>";
}

// Submeter novos dados
if (isset($_POST['submit'])){
    unset($_POST['submit']);
    $db->insert($table_name, $_POST);
    $db->close();
    echo "<script>window.location.href='".$page."?status=1'</script>";
}

// Deletar linha
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
                Você realmente deseja excluir?
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-primary" data-dismiss="modal">Cancelar</button>
                <a style="color: white;" class="btn btn-danger btn-ok">Excluir</a>
            </div>
        </div>
    </div>
</div>

<?php
if (isset($_GET['create'])){
?>

<div class="col-md-12 mx-auto ctmain-table">
    <div class="card-body">
        <div class="card ctcard">
            <div class="card-header card-header-warning">
                <center>
                    <h2><i class="icon icon-bullhorn"></i> Criar ID da Liga</h2>
                </center>
            </div>

            <div class="card-body">
                <div class="col-12">
                    <h3>Escolher Liga</h3>
                </div>
                <form method="post">
                    <div class="form-group ctinput">
                        <label class="form-label" for="league">Widget da Liga</label>
                        <select name="league" id="league" class="form-control" onchange="updateLeagueId(this)">
                            <?php foreach ($soccer_leagues as $league): ?>
                            <option value="<?= htmlspecialchars($league['strLeague']) ?>"
                                data-idleague="<?= htmlspecialchars($league['idLeague']) ?>"
                                <?= (isset($updateData['leagueId']) && $updateData['leagueId'] === $league['strLeague']) ? 'selected' : '' ?>>
                                <?= htmlspecialchars($league['strLeague']) ?>
                            </option>
                            <?php endforeach; ?>
                        </select>
                    </div>

                    <div class="form-group">
                        <label class="form-label" for="leagueId">ID da Liga</label>
                        <input class="form-control" id="leagueId" name="leagueId" placeholder="ID da Liga" type="text"
                            readonly />
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
} else {
?>

<div class="col-md-12 mx-auto ctmain-table">
    <div class="card-body">
        <div class="card ctcard">
            <div class="card-header card-header-warning">
                <center>
                    <h2><i class="icon icon-commenting"></i> Widget da Liga</h2>
                </center>
            </div>
            <div class="card-body">
                <div class="col-12">
                    <center>
                        <a id="button" href="./<?=$page ?>?create" class="btn btn-info">Criar ID da Liga</a>
                    </center>
                </div>
                <br>
                <div class="table-responsive">
                    <table class="table table-striped table-sm">
                        <thead style="color:white!important">
                            <tr>
                                <th>Nome da Liga</th>
                                <th>ID da Liga</th>
                                <th>Excluir</th>
                            </tr>
                        </thead>
                        <?php foreach ($res as $row) { ?>
                        <tbody>
                            <tr>
                                <td><?=$row['league'] ?></a></td>
                                <td><?=$row['leagueId'] ?></td>
                                <td>
                                    &nbsp&nbsp&nbsp
                                    <a class="btn btn-danger btn-ok" href="#"
                                        data-href="<?=$page ?>?delete=<?=$row['id'] ?>" data-toggle="modal"
                                        data-target="#confirm-delete"><i class="fa fa-trash-o"></i></a>
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

<?php } ?>

<script>
function updateLeagueId(selectElement) {
    var leagueId = selectElement.options[selectElement.selectedIndex].dataset.idleague;
    document.getElementById('leagueId').value = leagueId;
}

// Chamar a função ao carregar a página para definir o valor inicial
window.onload = function() {
    var selectElement = document.getElementById('league');
    updateLeagueId(selectElement);
};
</script>

<?php include ('includes/footer.php'); ?>

</body>
</html>
