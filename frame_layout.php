<?php 
include ('includes/header.php');
$nome_tabela = 'framelayout';
$nome_pagina = 'frame_layout';
$dados = ['layout' => 'layout_0'];
$db->insertIfEmpty($nome_tabela, $dados);
$res = $db->select($nome_tabela, '*', '', '');

if(isset($_POST['submit'])){
	unset($_POST['submit']);
	$dadosAtualizados = $_POST;
	$db->update($nome_tabela, $dadosAtualizados, 'id = :id',[':id' => 1]);
	echo "<script>window.location.href='". $nome_pagina.".php?status=1'</script>";
}

function valorAtual($res){
    $valor = $res[0]['layout'];
    if($valor == 'layout_0'){
        return " layout [1]";
    } else if ($valor == 'layout_1'){
        return " layout [2]";
    } else if ($valor == 'layout_2'){
        return " layout [3]";
    } else if ($valor == 'layout_3'){
        return " layout [4]";
    } else if ($valor == 'layout_4'){
        return " layout [5]";
    } else if ($valor == 'layout_5'){
        return " layout [6]";
    } else{
        return " layout [1]]";
    }
}
?>

<div class="col-md-12 mx-auto ctmain-table">
    <div class="card-body">
        <div class="card text-white ctcard">
            <div class="card-header card-header-warning">
                <center>
                    <h2><i class="icon icon-bullhorn"></i> Layout dos anúncios em quadro</h2>
                </center>
            </div>
            
            <div class="card-body">
                <form method="post">
                    <div class="form-group ctinput">
                        <label class="form-label"> Layout atual :</label>
                        <label><?php echo valorAtual($res); ?></label>
                    </div>
                    <div class="form-group ctinput">
                        <label class="form-label">Escolher layout </label>
                        <select id="layout" name="layout">
                            <option value="layout_0">layout 1</option>
                            <option value="layout_1">layout 2</option>
                            <option value="layout_2">layout 3</option>
                            <option value="layout_3">layout 4</option>
                            <option value="layout_4">layout 5</option>
                            <option value="layout_5">layout 6</option>
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

            <div class="grid-container">
                <div class="grid-item">
                    <img src="./frame/frm_0.resized.png" alt="Imagem 1">
                    <div class="image-text">layout 1 [Auto / Manual / Guia esportivo]</div>
                </div>
                <div class="grid-item">
                    <img src="./frame/frm_1.resized.png" alt="Imagem 2">
                    <div class="image-text">layout 2 [Auto / Manual / Widget de liga]</div>
                </div>
                <div class="grid-item">
                    <img src="./frame/frm_2.resized.png" alt="Imagem 3">
                    <div class="image-text">layout 3 [Auto / Guia esportivo / Widget de liga]</div>
                </div>
                <div class="grid-item">
                    <img src="./frame/frm_3.resized.png" alt="Imagem 1">
                    <div class="image-text">layout 4 [Auto / Manual]</div>
                </div>
                <div class="grid-item">
                    <img src="./frame/frm_4.resized.png" alt="Imagem 2">
                    <div class="image-text">layout 5 [Auto / Guia esportivo]</div>
                </div>
                <div class="grid-item">
                    <img src="./frame/frm_5.resized.png" alt="Imagem 3">
                    <div class="image-text">layout 6 [Manual / Guia esportivo]</div>
                </div>
            </div>

        </div>
    </div>
</div>
</div>

<style>
    .grid-container {
        display: grid;
        grid-template-columns: repeat(3, 1fr);
        gap: 10px; /* Ajuste o espaço entre as imagens */
        padding: 10px;
    }
    .grid-item {
        text-align: center;
    }
    .grid-item img {
        max-width: 100%;
        height: auto;
    }
    .image-text {
        margin-top: 5px;
        font-size: 16px;
        color: #fff;
    }
</style>

<?php include ('includes/footer.php');?>
