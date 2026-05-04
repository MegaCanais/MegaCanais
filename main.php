<?php 
include ('includes/header.php');

// Nome da tabela
$table_name = "dns";
$page = "main.php";

// Chamada para a tabela
$res = $db->select($table_name, '*', '', '');

// Chamada para atualizar
@$resU = $db->select($table_name, '*', 'id = :id', '', [':id' => $_GET['update']]);

if(isset($_POST['submitU'])){
	unset($_POST['submitU']);
	$updateData = $_POST;
	$db->update($table_name, $updateData, 'id = :id',[':id' => $_GET['update']]);
	echo "<script>window.location.href='".$page."?status=1'</script>";
}

// Envio de novo
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
<?php
if (isset($_GET['create'])){

// Formulário de criação
?>

		<div class="col-md-12 mx-auto ctmain-table">
			<div class="card-body">
				<div class="card ctcard">
					<div class="card-header card-header-warning">
						<center>
							<h2><i class="icon icon-bullhorn"></i> Entrada de DNS & Nome de Usuário</h2>
						</center>
					</div>
					
					<div class="card-body">
						<div class="col-12">
							<h3>Adicionar DNS ou Nome de Usuário/Senha</h3>
						</div>
							<form method="post">
								<div class="form-group ctinput">
									<label class="form-label " for="title">Título</label>
										<input class="form-control" id="description" name="title" placeholder="Título" type="text"/>
								</div>
								<div class="form-group ctinput">
									<label class="form-label " for="dns">DNS</label>
										<input class="form-control" id="description" name="url" placeholder="DNS" type="text"/>
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

// Formulário de atualização
?>
		<div class="col-md-12 mx-auto ctmain-table">
			<div class="card-body">
				<div class="card ctcard">
					<div class="card-header card-header-warning">
						<center>
							<h2><i class="icon icon-bullhorn"></i> Entrada de DNS & Nome de Usuário</h2>
						</center>
					</div>
					
					<div class="card-body">
						<div class="col-12">
							<h3>Editar DNS ou Nome de Usuário/Senha</h3>
						</div>
							<form method="post">
								<input type="hidden" name="id" value="<?=$_GET['update'] ?>">
								<div class="form-group ctinput">
									<label class="form-label " for="title">Título</label>
										<input class="form-control" id="description" name="title" placeholder="Título" value="<?=$resU[0]['title'] ?>" type="text"/>
								</div>
								<div class="form-group ctinput">
									<label class="form-label " for="dns">DNS</label>
										<input class="form-control" id="description" name="url" placeholder="DNS" value="<?=$resU[0]['url'] ?>" type="text"/>
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
// Tabela/formulário principal
	 ?>

		<div class="col-md-12 mx-auto ctmain-table">
			<div class="card-body">
				<div class="card ctcard">
					<div class="card-header card-header-warning">
						<center>
							<h2><i class="icon icon-commenting"></i> DNSs e Usuários Atuais</h2>
						</center>
					</div>
					<div class="card-body" >
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
									<th>Título</th>
									<th>DNS</th>
									<th>Editar&nbsp&nbsp&nbspDeletar</th>
								</tr>
							</thead>
							<?php foreach ($res as $row) {
							?>
							<tbody>
								<tr>
									<td><?=$row['title'] ?></a></td>
									<td><?=$row['url'] ?></td>
									<td>
									<a class="btn btn-info btn-ok" href="<?=$page ?>?update=<?=$row['id'] ?>"><i class="fa fa-pencil-square-o"></i></a>
									&nbsp&nbsp&nbsp
									<a class="btn btn-danger btn-ok" href="#" data-href="<?=$page ?>?delete=<?=$row['id'] ?>" data-toggle="modal" data-target="#confirm-delete"><i class="fa fa-trash-o"></i></a>
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