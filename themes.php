<?php 
include ('includes/header.php');
$table_name = 'theme'; // Nome da tabela
$page_name = 'themes'; // Nome da página
$data = ['theme_no' => 'theme_0']; // Dados iniciais
$db->insertIfEmpty($table_name, $data); // Insere dados se a tabela estiver vazia
$res = $db->select($table_name, '*', '', ''); // Seleciona todos os dados da tabela

if(isset($_POST['submit'])){ // Verifica se o botão de envio foi pressionado
	unset($_POST['submit']);
	$updateData = $_POST;
	$db->update($table_name, $updateData, 'id = :id',[':id' => 1]); // Atualiza dados
	echo "<script>window.location.href='". $page_name.".php?status=1'</script>"; // Redireciona após o envio
}

function curruntvaleu($res){ // Função para obter o tema atual
    $getvalue = $res[0]['theme_no'];
    if($getvalue == 'theme_0'){
        return " Tema [1]";
    } else if ($getvalue == 'theme_1'){
        return " Tema [2]";
    } else if ($getvalue == 'theme_2'){
        return " Tema [3]";
    } else if ($getvalue == 'theme_3'){
        return " Tema [4]";
    } else if ($getvalue == 'theme_4'){
        return " Tema [5]";
    } else if ($getvalue == 'theme_5'){
        return " Tema [6]";
    } else if ($getvalue == 'theme_6'){
        return " Tema [7]";
    } else if ($getvalue == 'theme_7'){
        return " Tema [8]";
    } else if ($getvalue == 'theme_8'){
        return " Tema [9]";
    } else if ($getvalue == 'theme_9'){
        return " Tema [10]";
    } else if ($getvalue == 'theme_10'){
        return " Tema [11]";
    } else if ($getvalue == 'theme_11'){
        return " Tema [12]";
    } else if ($getvalue == 'theme_12'){
        return " Tema [13]";
    } else if ($getvalue == 'theme_13'){
        return " Tema [14]";
    }else if ($getvalue == 'theme_14'){
        return " Tema [15]";
    }else if ($getvalue == 'theme_15'){
        return " Tema [16]";
    }else if ($getvalue == 'theme_16'){
        return " Tema [17]";
    }else{
        return "Tema [1]]";
    }
}
?>

<div class="col-md-12 mx-auto ctmain-table">
    <div class="card-body">
        <div class="card text-white ctcard">
            <div class="card-header card-header-warning">
                <center>
                    <h2><i class="icon icon-bullhorn"></i> Notificação</h2> <!-- Título alterado para "Notificação" -->
                </center>
            </div>
            
            <div class="card-body">
                <form method="post">
                    <div class="form-group ctinput">
                        <label class="form-label"> Tema Atual :</label> <!-- Alterado para "Tema Atual" -->
                        <label><?php echo curruntvaleu($res); ?></label>
                    </div>
                    <div class="form-group ctinput">
                        <label class="form-label">Escolha o Tema</label> <!-- Alterado para "Escolha o Tema" -->
                        <select id="theme_no" name="theme_no">
                            <option value="theme_0">Tema 1</option> <!-- Alterado para "Tema" -->
                            <option value="theme_1">Tema 2</option>
                            <option value="theme_2">Tema 3</option>
                            <option value="theme_3">Tema 4</option>
                            <option value="theme_4">Tema 5</option>
                            <option value="theme_5">Tema 6</option>
                            <option value="theme_6">Tema 7</option>
                            <option value="theme_7">Tema 8</option>
                            <option value="theme_8">Tema 9</option>
                            <option value="theme_9">Tema 10</option>
                            <option value="theme_10">Tema 11</option>
                            <option value="theme_11">Tema 12</option>
                            <option value="theme_12">Tema 13</option>
                            <option value="theme_13">Tema 14</option>
                            <option value="theme_14">Tema 15</option>
                            <option value="theme_15">Tema 16</option>
                            <option value="theme_16">Tema 17</option>
                        </select>
                    </div>
                    <div class="form-group ctinputform-group">
                        <center>
                            <button class="btn btn-info" name="submit" type="submit">
                                <i class="icon icon-check"></i> Enviar <!-- Alterado para "Enviar" -->
                            </button>
                        </center>
                    </div>
                </form>
            </div>       

    <div class="grid-container">
        <div class="grid-item">
            <img src="./theme/thme_1_resized.png" alt="Imagem 1"> <!-- Alterado para "Imagem" -->
            <div class="image-text">Tema 1</div> <!-- Alterado para "Tema" -->
        </div>
        <div class="grid-item">
            <img src="./theme/thme_2_resized.png" alt="Imagem 2">
            <div class="image-text">Tema 2</div>
        </div>
        <div class="grid-item">
            <img src="./theme/thme_3_resized.png" alt="Imagem 3">
            <div class="image-text">Tema 3</div>
        </div>
        <div class="grid-item">
            <img src="./theme/thme_4_resized.png" alt="Imagem 1">
            <div class="image-text">Tema 4</div>
        </div>
        <div class="grid-item">
            <img src="./theme/thme_5_resized.png" alt="Imagem 2">
            <div class="image-text">Tema 5</div>
        </div>
        <div class="grid-item">
            <img src="./theme/thme_6_resized.png" alt="Imagem 3">
            <div class="image-text">Tema 6</div>
        </div>
        <div class="grid-item">
            <img src="./theme/thme_7.resized.png" alt="Imagem 1">
            <div class="image-text">Tema 7</div>
        </div>
        <div class="grid-item">
            <img src="./theme/thme_8.resized.png" alt="Imagem 2">
            <div class="image-text">Tema 8</div>
        </div>
        <div class="grid-item">
            <img src="./theme/thme_9.resized.png" alt="Imagem 3">
            <div class="image-text">Tema 9</div>
        </div>
        <div class="grid-item">
            <img src="./theme/thme_10.resized.png" alt="Imagem 1">
            <div class="image-text">Tema 10 [Somente anúncios manuais]</div> <!-- Alterado para "Somente anúncios manuais" -->
        </div>
        <div class="grid-item">
            <img src="./theme/thme_11.resized.png" alt="Imagem 2">
            <div class="image-text">Tema 11 [Somente anúncios manuais]</div>
        </div>
        <div class="grid-item">
            <img src="./theme/thme_12.resized.png" alt="Imagem 3">
            <div class="image-text">Tema 12 [Somente anúncios manuais]</div>
        </div>     
        <div class="grid-item">
            <img src="./theme/thme_13.resized.png" alt="Imagem 1">
            <div class="image-text">Tema 13</div>
        </div>    
        <div class="grid-item">
            <img src="./theme/thme_14.resized.png" alt="Imagem 2">
            <div class="image-text">Tema 14</div>
        </div>  
        <div class="grid-item">
            <img src="./theme/thme_15.resized.png" alt="Imagem 3">
            <div class="image-text">Tema 15</div>
        </div>  
                        
        <div class="grid-item">
            <img src="./theme/thme_16.resized.png" alt="Imagem 1">
            <div class="image-text">Tema 16 [Somente anúncios em quadros]</div> <!-- Alterado para "Somente anúncios em quadros" -->
        </div>    
        <div class="grid-item">
            <img src="./theme/thme_17.resized.png" alt="Imagem 2">
            <div class="image-text">Tema 17 [Somente anúncios em quadros]</div>
        </div>                 
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
            gap: 10px; /* Ajusta o espaço entre as imagens */
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
