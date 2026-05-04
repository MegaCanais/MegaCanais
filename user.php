<?php
include ('includes/header.php');

$nome_tabela = 'user';
$página = 'user.php';
$res = $db->select($nome_tabela, '*', '', '');

if(isset($_POST['submit'])){
	unset($_POST['submit']);
	$dadosAtualizados = $_POST;
	$db->update($nome_tabela, $dadosAtualizados, 'id = :id',[':id' => 1]);
	session_regenerate_id();
	$_SESSION['logado'] = true;
	$_SESSION['nome'] = $_POST['username'];
	echo "<script>window.location.href='".$página."?status=1'</script>";
}

?>
    	<div class="col-md-6 mx-auto">
			<div class="card-body">
				<div class="card text-white ctluser-main">
					<div class="card-header ctheading">
                        <center>
                            <h2><i class="icon icon-user"></i> Atualizar Credenciais</h2>
                        </center>
                    </div>
					<div class="card-body">
						<form  method="post">

							<div class="form-group">
								<div class="form-group form-float form-group-lg">
                                    <div class="form-line">
                                        <label class="form-label">Nome de Usuário</label>
										<input type="text" class="form-control" name="username" value="<?=$res[0]['username'] ?>">
									</div>
								</div>
							</div>

							<div class="form-group">
								<div class="form-group form-float form-group-lg">
                                    <div class="form-line">
                                        <label class="form-label">Senha</label>
										<input type="text" class="form-control" name="password" value="<?=$res[0]['password'] ?>">
									</div>
								</div>
							</div>

							<hr>

							<center>
								<button type="submit" name="submit" class="btn btn-info">
									<i class="icon icon-check"></i>Atualizar Credenciais
								</button>
							</center>
						</form>
					</div>
				</div>
			</div>
		</div>


<?php include ('includes/footer.php'); ?>

</body>
</html>