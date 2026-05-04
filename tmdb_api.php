<?php 
include ('includes/header.php');
$nome_pagina = 'tmdb_api';
$caminho_arquivo_json = 'api/ads/tmdbkey.json'; 

if(isset($_POST['submit'])){
	unset($_POST['submit']);
	$chave_tmdb = $_POST['tmdbkey'];
    $dados = [
        'tmdbkey' => $chave_tmdb
    ];
    $dados_json = json_encode($dados, JSON_PRETTY_PRINT);
    $arquivo_json = $caminho_arquivo_json;
    if (file_put_contents($arquivo_json, $dados_json)) {
        echo "<script>window.location.href='". $nome_pagina.".php?status=1'</script>";echo "Chave da API TMDB salva com sucesso.";
    } 
	
}

if (file_exists($caminho_arquivo_json)) {
    $dados_json = file_get_contents($caminho_arquivo_json);
    $dados = json_decode($dados_json, true);

    if ($dados && isset($dados['tmdbkey'])) {
        $chave_tmdb = $dados['tmdbkey'];
    }
}

?>

        <div class="col-md-6 mx-auto ctmain-table">
            <div class="card-body">
                <div class="card text-white ctcard">
                    <div class="card-header card-header-warning">
                        <center>
                            <h2><i class="icon icon-bullhorn"></i> Chave da API TMDB</h2>
                        </center>
                    </div>
                    
                    <div class="card-body">
                            <form method="post">
                                <div class="form-group ctinput">
                                    <label class="form-label " >Chave da API TMDB</label>
                                        <input class="form-control"  name="tmdbkey" value="<?php echo isset($chave_tmdb) ? htmlspecialchars($chave_tmdb) : ''; ?>" type="text"/>
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