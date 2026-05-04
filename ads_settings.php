<?php 
include ('includes/header.php');
$nome_tabela = 'adssettings';
$nome_pagina = 'ads_settings';
$dados = ['adstype' => 'auto'];
$db->insertIfEmpty($nome_tabela, $dados);
$res = $db->select($nome_tabela, '*', '', '');

if(isset($_POST['submit'])){
    unset($_POST['submit']);
    $dadosAtualizados = $_POST;
    $db->update($nome_tabela, $dadosAtualizados, 'id = :id',[':id' => 1]);
    echo "<script>window.location.href='". $nome_pagina.".php?status=1'</script>";
}

// Moveu a definição da função para antes de seu uso
function tipoDeAnuncioAtual($res){
    $valorAtual = $res[0]['adstype'];
    if($valorAtual == 'auto'){
        return "Anúncios Automáticos";
    } else if ($valorAtual == 'manual'){
        return "Anúncios Manuais";
    } else{
        return "Anúncios Automáticos";
    }
}
?>

<div class="col-md-6 mx-auto ctmain-table">
    <div class="card-body">
        <div class="card text-white ctcard">
            <div class="card-header card-header-warning">
                <center>
                    <h2><i class="icon icon-bullhorn"></i> Tipo de Anúncio</h2>
                </center>
            </div>
            
            <div class="card-body">
                <form method="post">
                    <div class="form-group ctinput">
                        <label class="form-label"> Tipo de Anúncio Atual:</label>
                        <label><?php echo tipoDeAnuncioAtual($res); ?></label>
                    </div>
                    <div class="form-group ctinput">
                        <label class="form-label">Escolher Tipo de Anúncio</label>
                        <select id="adstype" name="adstype">
                            <option value="auto">Anúncios Automáticos</option>
                            <option value="manual">Anúncios Manuais</option>
                        </select>
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
