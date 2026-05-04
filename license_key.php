<?php 
include ('includes/header.php');
$table_name = 'licens';
$page_name = 'license_key';
$data = ['lkey' => 'null'];
$db->insertIfEmpty($table_name, $data);
$res = $db->select($table_name, '*', '', '');

if(isset($_POST['submit'])){
	unset($_POST['submit']);
	$updateData = $_POST;
	$db->update($table_name, $updateData, 'id = :id',[':id' => 1]);
	echo "<script>window.location.href='". $page_name.".php?status=1'</script>";
}
function curruntvaleu($res){
    $getvalue = $res[0]['lkey'];
    if (empty($getvalue) || $getvalue == 'null'){
    	return "❌ A license key has not been added ";
    }else{
    	return "✅ A license key has been added ";
    }
}
?>

        <div class="col-md-6 mx-auto ctmain-table">
            <div class="card-body">
                <div class="card text-white ctcard">
                    <div class="card-header card-header-warning">
                        <center>
                            <h2><i class="icon icon-bullhorn"></i> License Key</h2>
							<h4><i class="icon icon-bullhorn"></i> The license key is always invisible</h4>
							<h5><i class="icon icon-bullhorn"></i> Always make sure to only add a valid key</h5>
                        </center>
                    </div>
                    
                    <div class="card-body">
                            <form method="post">
								<div class="form-group ctinput">
                        			<label class="form-label"> License key status :</label>
                        			<label><?php echo curruntvaleu($res); ?></label>
                    			</div>
                                <div class="form-group ctinput">
                                    <label class="form-label " >Enter the license key</label>
                                        <input class="form-control"  name="lkey" placeholder="Enter the license key" type="text" required />
                                </div>
                                <div class="form-group ctinputform-group">
                                    <center>
                                        <button class="btn btn-info " name="submit" type="submit">
                                            <i class="icon icon-check"></i> Submit
                                        </button>
                                    </center>
                                </div>
                            </form>
                    </div>
                </div>
            </div>
        </div>

<?php include ('includes/footer.php');?>