<?php 
include ('includes/header.php');

//table name
$table_name = "ibocode";
$page = "activation_code.php";

//table call
$res = $db->select($table_name, '*', '', '');

//submit new
if (isset($_POST['submit'])){
	unset($_POST['submit']);
	$db->insert($table_name, $_POST);
	$db->close();
	echo "<script>window.location.href='".$page."?status=1'</script>";
}

function getCurrentDate() {
    // Get current time in seconds since Unix epoch
    $currentTime = time();

    // Take the last 8 digits of the current time
    $activationCode = substr($currentTime, -4);

    // Ensure the code is exactly 8 digits long
    $activationCode = str_pad($activationCode, 4, '0', STR_PAD_LEFT);

    // Append a unique identifier
    $uniqueId = uniqid();
    $activationCode .= substr($uniqueId, -4); // Append last 4 characters of the unique id

    return $activationCode;
}
?>
<script>
function extract(event) {
    event.preventDefault(); // Prevent page refresh

    var m3uLink = document.getElementById("m3u_address").value;

    // Extract server URL
    var serverUrl = m3uLink.split("/get.php")[0];
    document.getElementById("url").value = serverUrl;

    // Extract username
    var username = getParameterByName("username", m3uLink);
    document.getElementById("username").value = username;

    // Extract password
    var password = getParameterByName("password", m3uLink);
    document.getElementById("password").value = password;
}

function getParameterByName(name, url) {
    name = name.replace(/[\[\]]/g, "\\$&");
    var regex = new RegExp("[?&]" + name + "(=([^&#]*)|&|#|$)"),
        results = regex.exec(url);
    if (!results) return "";
    if (!results[2]) return "";
    return decodeURIComponent(results[2].replace(/\+/g, " "));
}
</script>
<script>
    function disableInput() {
        document.getElementById("status").disabled = true;
    }
</script>
<div class="col-md-8 mx-auto ctmain-table">
    <div class="card-body">
        <div class="card ctcard">
            <div class="card-header card-header-warning">
                <center>
                    <h3><i class="icon icon-bullhorn"></i> Activation code</h3>
                </center>
            </div>
            <div class="card-body">
                <form>
                    <div class="form-group ctinput">
                        <label class="control-label" for="mac_address">
                            <strong>M3U Extractor</strong>
                        </label>
                        <div class="input-group">
                            <input class="form-control" id="m3u_address" name="m3u_address" placeholder="Enter M3U Link"
                                type="text" required />
                            <br>
                            <button class="btn btn-success btn-icon-split" id="extract_button" onclick="extract(event)">
                                <span class="icon text-white-50"><i class="fa fa-expand"></i></span><span
                                    class="text">extract</span>
                            </button>
                        </div>
                    </div>
                    <div>
                </form>
            </div>
            <div class="card-body">
                <form method="post">
                    <div class="form-group ctinput">
                        <label class="form-label" for="ac_code">Activation code</label>
                        <input class="form-control" id="ac_code" name="ac_code" value="<?php echo getCurrentDate(); ?>" placeholder="Activation code"
                            type="text" required />
                    </div>
                    <div class="form-group ctinput">
                        <label class="form-label" for="url">DNS</label>
                        <input class="form-control" id="url" name="url" placeholder="Enter DNS" type="text" id="url"
                            required />
                    </div>
                    <div class="form-group ctinput">
                        <label class="form-label" for="username">Username</label>
                        <input class="form-control" id="username" name="username" placeholder="Enter Username"
                            type="text" id="username" required />
                    </div>
                    <div class="form-group ctinput">
                        <label class="form-label" for="password">Password</label>
                        <input class="form-control" id="password" name="password" placeholder="Enter Password"
                            type="text" id="password" required />
                    </div>
                    <div class="form-group ctinput">
                        <label class="form-label" for="status">User status</label>
                        <input class="form-control" id="status" name="status" placeholder="User status"
                            type="text" id="status" value="NotUsed" readonly/>
                    </div>    
                    <div class="form-group ctinput">
                        <center>
                            <button class="btn btn-info" name="submit" type="submit">
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