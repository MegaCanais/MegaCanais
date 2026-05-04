<?php 
include ('includes/header.php');

// nome da tabela
$table_name = "ibo";
$page = "mac_users.php";

// chamada da tabela
$res = $db->select($table_name, '*', '', '');

// chamada para atualização
@$resU = $db->select($table_name, '*', 'id = :id', '', [':id' => $_GET['update']]);

if(isset($_POST['submitU'])){
	unset($_POST['submitU']);
	$updateData = $_POST;
	$db->update($table_name, $updateData, 'id = :id',[':id' => $_GET['update']]);
	echo "<script>window.location.href='".$page."?status=1'</script>";
}// enviar novo
if (isset($_POST['submit'])){
	unset($_POST['submit']);
	$db->insert($table_name, $_POST);
	$db->close();
	echo "<script>window.location.href='".$page."?status=1'</script>";
}
?>
<script>
document.addEventListener("DOMContentLoaded", function() {
    var macAddressInput = document.getElementById("mac_address");

    macAddressInput.addEventListener("input", function(e) {
        var value = e.target.value;
        value = value.replace(/[^a-fA-F0-9]/g, "").toUpperCase();

        var formattedValue = "";
        for (var i = 0; i < value.length; i++) {
            formattedValue += value[i];
            if ((i + 1) % 2 === 0 && i < value.length - 1) {
                formattedValue += ":";
            }
        }

        e.target.value = formattedValue;
    });
});
</script>
<script>
function extract(event) {
    event.preventDefault(); // Impede o recarregamento da página

    var m3uLink = document.getElementById("m3u_address").value;

    // Extrai a URL do servidor
    var serverUrl = m3uLink.split("/get.php")[0];
    document.getElementById("url").value = serverUrl;

    // Extrai o nome de usuário
    var username = getParameterByName("username", m3uLink);
    document.getElementById("username").value = username;

    // Extrai a senha
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
<div class="col-md-8 mx-auto ctmain-table">
    <div class="card-body">
        <div class="card ctcard">
            <div class="card-header card-header-warning">
                <center>
                    <h3><i class="icon icon-bullhorn"></i> Atualizar Usuário</h3>
                </center>
            </div>
            <div class="card-body">
                <form>
                    <div class="form-group ctinput">
                        <label class="control-label" for="mac_address">
                            <strong>Extrator M3U</strong>
                        </label>
                        <div class="input-group">
                            <input class="form-control" id="m3u_address" name="m3u_address" placeholder="Digite o Link M3U"
                                type="text" required />
                            <br>
                            <button class="btn btn-success btn-icon-split" id="extract_button" onclick="extract(event)">
                                <span class="icon text-white-50"><i class="fa fa-expand"></i></span><span
                                    class="text">extrair</span>
                            </button>
                        </div>
                    </div>
                    <div>
                </form>
            </div>
            <div class="card-body">
                <form method="post">
                    <div class="form-group ctinput">
                        <label class="form-label" for="mac_address">Endereço MAC</label>
                        <input class="form-control" id="mac_address" name="mac_address" value="<?=$resU[0]['mac_address'] ?>" placeholder="Endereço MAC"
                            type="text" required />
                    </div>
                    <div class="form-group ctinput">
                        <label class="form-label">Proteger esta playlist</label>
                        <select id="protection" name="protection"  required>
                            <option value="1">SIM</option>
                            <option value="0">NÃO</option>
                        </select>
                    </div>         
                    <div class="form-group ctinput">
                        <label class="form-label" for="title">Nome do Servidor</label>
                        <input class="form-control" id="title" name="title" value="<?=$resU[0]['title'] ?>" placeholder="Nome do Servidor" type="text"
                            required />
                    </div>
                    <div class="form-group ctinput">
                        <label class="form-label" for="url">DNS</label>
                        <input class="form-control" id="url" name="url" value="<?=$resU[0]['url'] ?>" placeholder="Digite o DNS" type="text" id="url"
                            required />
                    </div>
                    <div class="form-group ctinput">
                        <label class="form-label" for="username">Nome de Usuário</label>
                        <input class="form-control" id="username" name="username" value="<?=$resU[0]['username'] ?>" placeholder="Digite o Nome de Usuário"
                            type="text" id="username" required />
                    </div>
                    <div class="form-group ctinput">
                        <label class="form-label" for="password">Senha</label>
                        <input class="form-control" id="password" name="password" value="<?=$resU[0]['password'] ?>" placeholder="Digite a Senha"
                            type="text" id="password" required />
                    </div>
                    <div class="form-group ctinput">
                        <center>
                            <button class="btn btn-info" name="submitU" type="submit">
                                <i class="icon icon-check"></i> Enviar
                            </button>
                        </center>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<script>
    var protectionValue = "<?=$resU[0]['protection']?>";
    var protectionSelect = document.getElementById('protection');
    protectionSelect.value = protectionValue;
</script>                        
<?php include ('includes/footer.php');?>
</body>

</html>