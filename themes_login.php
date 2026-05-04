<?php 
include ('includes/header.php');
$table_name = 'logintheme';
$page_name = 'themes_login';
$data = ['themelog' => 'theme_0'];
$db->insertIfEmpty($table_name, $data);
$res = $db->select($table_name, '*', '', '');

if(isset($_POST['submit'])){
	unset($_POST['submit']);
	$updateData = $_POST;
	$db->update($table_name, $updateData, 'id = :id',[':id' => 1]);
	echo "<script>window.location.href='". $page_name.".php?status=1'</script>";
}

function curruntvaleu($res){
    $getvalue = $res[0]['themelog'];
    if($getvalue == 'theme_0'){
        return " Tema [1]";
    } else if ($getvalue == 'theme_1'){
        return " Tema [2]";
    } else if ($getvalue == 'theme_2'){
        return " Tema [3]";
    }else{
        return "Tema [1]]";
    }
}
?>

?>

        <div class="col-md-12 mx-auto ctmain-table">
            <div class="card-body">
                <div class="card text-white ctcard">
                    <div class="card-header card-header-warning">
                        <center>
                            <h2><i class="icon icon-bullhorn"></i> Temas da Página de Login</h2>
                        </center>
                    </div>
                    
           <div class="card-body">
                <form method="post">
                    <div class="form-group ctinput">
                        <label class="form-label"> Tema Atual :</label>
                        <label><?php echo curruntvaleu($res); ?></label>
                    </div>
                    <div class="form-group ctinput">
                        <label class="form-label">Escolher Tema </label>
                        <select id="themelog" name="themelog">
                            <option value="theme_0">Tema 1</option>
                            <option value="theme_1">Tema 2</option>
                            <option value="theme_2">Tema 3</option>
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
            <img src="./login/login_01.resized.png" alt="Image 1">
            <div class="image-text">Tema 1</div>
        </div>
        <div class="grid-item">
            <img src="./login/login_02.resized.png" alt="Image 2">
            <div class="image-text">Tema 2</div>
        </div>
        <div class="grid-item">
            <img src="./login/login_03.resized.png" alt="Image 3">
            <div class="image-text">Tema 3</div>
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
            gap: 10px; /* Adjust the gap between images */
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