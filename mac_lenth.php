<?php 
include ('includes/header.php');
$table_name = 'macl';
$page_name = 'mac_lenth';
$data = ['mac_length' => '12'];
$db->insertIfEmpty($table_name, $data);
$res = $db->select($table_name, '*', '', '');

if(isset($_POST['submit'])){
    unset($_POST['submit']);
    $updateData = $_POST;
    $db->update($table_name, $updateData, 'id = :id',[':id' => 1]);
    echo "<script>window.location.href='". $page_name.".php?status=1'</script>";
}

// Função definida antes do seu uso
function curruntvaleu($res){
    $getvalue = $res[0]['mac_length'];
    if($getvalue == 0){
        return " XX:XX:XX:XX:XX:XX [12]";
    } else if ($getvalue == 4){
        return " XX:XX [4]";
    } else if ($getvalue == 6){
        return " XX:XX:XX [6]";
    } else if ($getvalue == 8){
        return " XX:XX:XX:XX [8]";
    } else if ($getvalue == 10){
        return " XX:XX:XX:XX:XX [8]";
    } else if ($getvalue == 12){
        return " XX:XX:XX:XX:XX:XX [12]";
    } else{
        return "XX:XX:XX:XX:XX:XX [12]";
    }
}
?>

<div class="col-md-6 mx-auto ctmain-table">
    <div class="card-body">
        <div class="card text-white ctcard">
            <div class="card-header card-header-warning">
                <center>
                    <h2><i class="icon icon-bullhorn"></i> Comprimento do Endereço MAC</h2>
                </center>
            </div>
            
            <div class="card-body">
                <form method="post">
                    <div class="form-group ctinput">
                        <label class="form-label"> Comprimento atual do Endereço MAC :</label>
                        <label><?php echo curruntvaleu($res); ?></label>
                    </div>
                    <div class="form-group ctinput">
                        <label class="form-label">Escolha o comprimento do MAC </label>
                        <select id="mac_length" name="mac_length">
                            <option value="4">XX:XX</option>
                            <option value="6">XX:XX:XX</option>
                            <option value="8">XX:XX:XX:XX</option>
                            <option value="10">XX:XX:XX:XX:XX</option>
                            <option value="12">XX:XX:XX:XX:XX:XX</option>
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
