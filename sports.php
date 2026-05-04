<?php 
include ('includes/header.php');
$table_name = 'sports';
$data = ['header_n' => 'Evento', 'border_c' => '#000000', 'background_c' => '#000000', 'text_c' => '#ffffff', 'days' => '7', 'api' => '1'];
$db->insertIfEmpty($table_name, $data);
$res = $db->select($table_name, '*', '', '');

if(isset($_POST['submit'])){
    unset($_POST['submit']);
    $updateData = $_POST;
    $db->update($table_name, $updateData, 'id = :id', [':id' => 1]);
    echo "<script>window.location.href='". $table_name.".php?status=1'</script>";
}

?>
<div class="col-md-6 mx-auto">
    <div class="modal fade" id="how2" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Como Obter a Chave da API</h5>
        </div>
        <div class="modal-body">
            <p>Vá para o site https://www.tvsportguide.com/page/widget/, role até o final, insira algumas informações e ele fornecerá um URL como o abaixo. A parte em vermelho é o que você precisa.</p>
            <p><small>https://www.tvsportguide.com/widget/<em style="color:red;">5cc316f797659</em>?filter_mode=all&filter_value</small></p>
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Fechar</button>
            <a href="https://www.tvsportguide.com/page/widget/"><button type="button" class="btn btn-primary">Ir para a página</button></a>
        </div>
        </div>
    </div>
    </div>
    <div class="card-body">
        <div class="card bg-primary text-white">
            <div class="card-header">
                <center>
                    <h2><i class="fa fa-wrench"></i> Eventos Esportivos</h2>
                </center>
            </div>
            <div class="card-body">
                <form method="post">

                    <div class="form-group ">
                        <div class="form-line">
                          <label class="form-group form-float form-group-lg">Chave da API</label><br>
                          <button type="button" class="btn btn-secondary" data-toggle="modal" data-target="#how2">Como obter a chave da API</button><br><br>
                          <input class="form-control" name="api" value="<?=$res[0]['api'] ?>" type="text"/>
                        </div>
                    </div>


                    <div class="form-group ">
                        <div class="form-line">
                            <label class="form-group form-float form-group-lg">Nome do Cabeçalho</label>
                            <input class="form-control" name="header_n" value="<?=$res[0]['header_n'] ?>" type="text"/>
                        </div>
                    </div>

                    <div class="form-group ">
                        <div class="form-line">
                            <label class="form-group form-float form-group-lg">Borda</label>
                            <input class="form-control" name="border_c" value="<?=$res[0]['border_c'] ?>" type="color"/>
                        </div>
                    </div>

                    <div class="form-group ">
                        <div class="form-line">
                            <label class="form-group form-float form-group-lg">Cor de Fundo</label>
                            <input class="form-control" name="background_c" value="<?=$res[0]['background_c'] ?>" type="color"/>
                        </div>
                    </div>

                    <div class="form-group ">
                        <div class="form-line">
                            <label class="form-group form-float form-group-lg">Cor do Texto</label>
                            <input class="form-control" name="text_c" value="<?=$res[0]['text_c'] ?>" type="color"/>
                        </div>
                    </div>

                    <!--<div class="form-group ">
                        <div class="form-line">
                          <label class="form-group form-float form-group-lg">Dias</label>
                          <select class="form-control" id="select" name="days">
                              <option value="1" <?//=$res[0]['days']='1'?'selected':'' ?>>1</option>
                              <option value="3" <?//=$res[0]['days']=='3'?'selected':'' ?>>3</option>
                              <option value="7" <?//=$res[0]['days']=='7'?'selected':'' ?>>7</option>
                          </select>
                        </div>
                    </div>-->

                    <hr>

                    <div class="form-group">
                        <center>
                            <button class="btn btn-info" name="submit" type="submit">
                                <i class="fa fa-check"></i> Atualizar Status
                            </button>
                        </center>
                    </div>
                </form>     
            </div>
        </div>
    </div>
</div>

<?php include ('includes/footer.php');?>

</body>
</html>