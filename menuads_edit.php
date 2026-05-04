<?php 
include ('includes/header.php');

//table name
$table_name = "menuads";
$page = "menads.php";

//table call
$res = $db->select($table_name, '*', '', '');

@$resU = $db->select($table_name, '*', 'id = :id', '', [':id' => $_GET['update']]);

if(isset($_POST['submitU'])){
	unset($_POST['submitU']);
	$updateData = $_POST;
	$db->update($table_name, $updateData, 'id = :id',[':id' => $_GET['update']]);
	echo "<script>window.location.href='".$page."?status=1'</script>";
}

//submit new
if (isset($_POST['submit'])){
	unset($_POST['submit']);
	$db->insert($table_name, $_POST);
	$db->close();
	echo "<script>window.location.href='".$page."?status=1'</script>";
}
?>
<div class="col-md-8 mx-auto ctmain-table">
    <div class="card-body">
        <div class="card ctcard">
            <div class="card-header card-header-warning">
                <center>
                    <h3><i class="icon icon-bullhorn"></i> Add New Image</h3>
                </center>
            </div>
            <div class="card-body">
                <form method="post">
                    <div class="form-group ctinput">
                        <label class="form-label" for="title">Image Title</label>
                        <input class="form-control" id="title" name="title" value="<?=$resU[0]['title'] ?>" placeholder="Image Title"
                            type="text" required />
                    </div>  
                    <div class="form-group ctinput">
                        <label class="form-label" for="url">Image URL</label>
                        <input class="form-control" id="url" name="url" value="<?=$resU[0]['url'] ?>" placeholder="Image URL" type="text"
                            required />
                    </div>
                    <div class="form-group ctinput">
                        <center>
                            <button class="btn btn-info" name="submitU" type="submit">
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
</body>

</html>