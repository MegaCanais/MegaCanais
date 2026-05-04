<?php 
include ('includes/header.php');
$nome_da_tabela = 'autolayout';
$nome_da_pagina = 'auto_layout';
$dados = ['layout' => 'layout_0'];
$db->insertIfEmpty($nome_da_tabela, $dados);
$res = $db->select($nome_da_tabela, '*', '', '');

if(isset($_POST['submit'])){
	unset($_POST['submit']);
	$dadosAtualizados = $_POST;
	$db->update($nome_da_tabela, $dadosAtualizados, 'id = :id',[':id' => 1]);
	echo "<script>window.location.href='". $nome_da_pagina.".php?status=1'</script>";
}

function valorAtual($res){
    $valorObtido = $res[0]['layout'];
    if($valorObtido == 'layout_0'){
        return " layout [1]";
    } else if ($valorObtido == 'layout_1'){
        return " layout [2]";
    } else if ($valorObtido == 'layout_2'){
        return " layout [3]";
    } else if ($valorObtido == 'layout_3'){
        return " layout [4]";
    } else if ($valorObtido == 'layout_4'){
        return " layout [5]";
    } else if ($valorObtido == 'layout_5'){
        return " layout [6]";
    } else if ($valorObtido == 'layout_6'){
        return " layout [7]";
    } else if ($valorObtido == 'layout_7'){
        return " layout [8]";
    } else if ($valorObtido == 'layout_8'){
        return " layout [9]";
    } else if ($valorObtido == 'layout_9'){
        return " layout [10]";
    } else if ($valorObtido == 'layout_10'){
        return " layout [11]";
    } else if ($valorObtido == 'layout_11'){
        return " layout [12]";
    } else if ($valorObtido == 'layout_12'){
        return " layout [13]";
    } else if ($valorObtido == 'layout_13'){
        return " layout [14]";
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
                    <h2><i class="icon icon-bullhorn"></i> Layout de Anúncios Automáticos</h2>
                </center>
            </div>
            
            <div class="card-body">
                <form method="post">
                    <div class="form-group ctinput">
                        <label class="form-label"> Layout Atual :</label>
                        <label><?php echo valorAtual($res); ?></label>
                    </div>
                    <div class="form-group ctinput">
                        <label class="form-label">Escolha o layout</label>
                        <select id="layout" name="layout">
                            <option value="layout_0">layout 1</option>
                            <option value="layout_1">layout 2</option>
                            <option value="layout_2">layout 3</option>
                            <option value="layout_3">layout 4</option>
                            <option value="layout_4">layout 5</option>
                            <option value="layout_5">layout 6</option>
                        	<option value="layout_6">layout 7</option>
                        	<option value="layout_7">layout 8</option>
                        	<option value="layout_8">layout 9</option>
                        	<option value="layout_9">layout 10</option>
                        	<option value="layout_10">layout 11</option>
                        	<option value="layout_11">layout 12</option>
                        	<option value="layout_12">layout 13</option>
                        	<option value="layout_13">layout 14</option>
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
            <img src="./ads/ads_0.png" alt="Imagem 1">
            <div class="image-text">layout 1 [Por RTX]</div>
        </div>
        <div class="grid-item">
            <img src="./ads/ads_1.png" alt="Imagem 2">
            <div class="image-text">layout 2 [Por JEMUMAN-appsnscripts]</div>
        </div>
        <div class="grid-item">
            <img src="./ads/ads_2.png" alt="Imagem 3">
            <div class="image-text">layout 3 [Por JEMUMAN-appsnscripts]</div>
        </div>
        <div class="grid-item">
            <img src="./ads/ads_3.png" alt="Imagem 1">
            <div class="image-text">layout 4 [Por JEMUMAN-appsnscripts]</div>
        </div>
        <div class="grid-item">
            <img src="./ads/ads_4.png" alt="Imagem 2">
            <div class="image-text">layout 5 [Por JEMUMAN-appsnscripts]</div>
        </div>
        <div class="grid-item">
            <img src="./ads/ads_5.png" alt="Imagem 3">
            <div class="image-text">layout 6 [Por JEMUMAN-appsnscripts]</div>
        </div>
        <div class="grid-item">
            <img src="./ads/ads_6.png" alt="Imagem 1">
            <div class="image-text">layout 7 [Por blackestflag-appsnscripts]</div>
        </div>
        <div class="grid-item">
            <img src="./ads/ads_7.png" alt="Imagem 2">
            <div class="image-text">layout 8 [Por blackestflag-appsnscripts]</div>
        </div>   
         <div class="grid-item">
            <img src="./ads/ads_8.png" alt="Imagem 3">
            <div class="image-text">layout 9 [Por @silenc_e_r]</div>
        </div>          
         <div class="grid-item">
            <img src="./ads/ads_9.png" alt="Imagem 1">
            <div class="image-text">layout 10 [Por @silenc_e_r]</div>
        </div>
        <div class="grid-item">
            <img src="./ads/ads_10.png" alt="Imagem 2">
            <div class="image-text">layout 11 [Por @silenc_e_r]</div>
        </div>   
         <div class="grid-item">
            <img src="./ads/ads_11.png" alt="Imagem 3">
            <div class="image-text">layout 12 [Por @silenc_e_r]</div>
        </div>  
                        
        <div class="grid-item">
            <img src="./ads/ads_12.png" alt="Imagem 1">
            <div class="image-text">layout 13 [Por @silenc_e_r]</div>
        </div>
        <div class="grid-item">
            <img src="./ads/ads_13.png" alt="Imagem 2">
            <div class="image-text">layout 14 [Por blackestflag-appsnscripts@silenc_e_r]</div>
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
