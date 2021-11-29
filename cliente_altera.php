<? 

extract ($_GET); 

extract ($_POST);

include("./bd/base.cfg.php");

//authPage();
session_start();
//print_r($_SESSION);
$db = new TMySQL($host,$base,$user,$pass);
$queryNome= "select * from cliente where (email = '".$_SESSION["email"]."') ";

$db->query($queryNome);
if ($db->count == 0)
	{
	echo $queryNome . '<br>'; 
	echo '<script>
	alert("Cliente não encontrado - 1.\n");
		//window.close();
	</script> ';
	}
$fnivel = $db->result["nivel"];
$data_inclusao = $db->result["data_inclusao"];
?>
<html>
<head>
<title>Cadastra Cliente</title>
<script language="javascript" src="./js/default.js">
MM_reloadPage(true);
</script>

<script>
  var largura = 0;
  var altura = 0;
   largura = 750;
   altura = 500;
   x = (screen.width - 850) / 2;
   y = 50;
self.focus();
window.resizeTo(largura,altura);
window.moveTo(x,y);

</script>

<script src="https://code.jquery.com/jquery-latest.min.js"></script>

<script language="javascript">

function validar(formulario) 
{
		msg = 'Ocorreram os seguintes erros:\n';
		conta = 0;
		foco = '';

		if (form_email.value == '')
			{
			conta = conta + 1; msg += '\n'+conta+' - Campo \'EMail\' inválido.'; if(foco == '') {foco = 'form_email';}
			//alert("Nome do Roteiro inválido!");
			}

		if (document.getElementById("form_nome").value == '')
			{
			conta = conta + 1; msg += '\n'+conta+' - Campo \'Nome\' obrigatório.'; if(foco == '') {foco = 'form_nome';}
			//alert("Nome do Roteiro inválido!");
			}
	
	
		if (document.getElementById("form_senha").value == '')
			{
			conta = conta + 1; msg += '\n'+conta+' - Campo \'Senha\' obrigatório.'; if(foco == '') {foco = 'form_nome';}
			//alert("Nome do Roteiro inválido!");
			}
		else
			{
			if (document.getElementById("form_senha").value != document.getElementById("form_conf_senha").value)
				{
				conta = conta + 1; msg += '\n'+conta+' - Campo \'Senha DIFERENTE da Confirmação de Senha\'.'; if(foco == '') {foco = 'form_nome';}
				//alert("Nome do Roteiro inválido!");
				}
			}
		

		if(parseInt(conta) != 0)
			{
			alert(msg);
			foco_em = 'formulario.'+foco+'.focus();';
			eval(foco_em);
			return false;
			}
		return true;
}

function SomenteNumero()  //numeros e virgula (44)
{  
/*
 if (event.keyCode==48 || event.keyCode==49 || event.keyCode==50 || event.keyCode==51 || event.keyCode==52 
	|| event.keyCode==53 || event.keyCode==54 || event.keyCode==55 || event.keyCode==56 || event.keyCode==57 
	|| event.keyCode==44)
*/
 if ((event.keyCode>=48 && event.keyCode<=57 ) || (event.keyCode==13) || (event.keyCode==44))
 {  
	return true;  
 }  
 else
 {  
	alert("Tecla invalida. Validos apenas numeros (0 a 9) e virgula (casa decimal).");
	return false;  
 }  
}

function SomenteNumeroMesmo()  //so numeros mesmo
{  
/*
 if (event.keyCode==48 || event.keyCode==49 || event.keyCode==50 || event.keyCode==51 || event.keyCode==52 
	|| event.keyCode==53 || event.keyCode==54 || event.keyCode==55 || event.keyCode==56 || event.keyCode==57)
*/
 if ((event.keyCode>=48 && event.keyCode<=57 ) || (event.keyCode==13))
{  
	return true;  
 }  
 else
 {  
	alert("Tecla invalida. Validos apenas numeros (0 a 9).");
	return false;  
 }  
}



/*
CPF e CNPJ - Inicio
*/

function validar(obj) { // recebe um objeto
    var s = (obj.value).replace(/\D/g, '');
    var tam = (s).length; // removendo os caracteres nãoo numéricos
    if (!(tam == 11 || tam == 14 || tam == 0)) { // validando o tamanho
        alert("'" + s + "' Não é um CPF ou um CNPJ Válido!"); // tamanho inválido
        obj.focus();
        return false;
    }

// se for CPF
    if (tam == 11) {
        if (!validaCPF(s)) { // chama a função que valida o CPF
            alert("'" + s + "' Não é um CPF Válido!"); // se quiser mostrar o erro
            obj.select(); // se quiser selecionar o campo em questão
            obj.focus();
            return false;
        }
        obj.value = maskCPF(s); // se validou o CPF mascaramos corretamente
        return true;
    }

// se for CNPJ
    if (tam == 14) {
        if (!validaCNPJ(s)) { // chama a função que valida o CNPJ
            alert("'" + s + "' Não é um CNPJ Válido!"); // se quiser mostrar o erro
            obj.select(); // se quiser selecionar o campo enviado
            return false;
        }
        obj.value = maskCNPJ(s); // se validou o CNPJ mascaramos corretamente
        return true;
    }
}

function validaCPF(s) {
    var c = s.substr(0, 9);
    var dv = s.substr(9, 2);
    var d1 = 0;
    for (var i = 0; i < 9; i++) {
        d1 += c.charAt(i) * (10 - i);
    }
    if (d1 == 0)
        return false;
    d1 = 11 - (d1 % 11);
    if (d1 > 9)
        d1 = 0;
    if (dv.charAt(0) != d1) {
        return false;
    }
    d1 *= 2;
    for (var i = 0; i < 9; i++) {
        d1 += c.charAt(i) * (11 - i);
    }
    d1 = 11 - (d1 % 11);
    if (d1 > 9)
        d1 = 0;
    if (dv.charAt(1) != d1) {
        return false;
    }
    return true;
}

function validaCNPJ(CNPJ) {
    var a = new Array();
    var b = new Number;
    var c = [6, 5, 4, 3, 2, 9, 8, 7, 6, 5, 4, 3, 2];
    for (i = 0; i < 12; i++) {
        a[i] = CNPJ.charAt(i);
        b += a[i] * c[i + 1];
    }
    if ((x = b % 11) < 2) {
        a[12] = 0
    } else {
        a[12] = 11 - x
    }
    b = 0;
    for (y = 0; y < 13; y++) {
        b += (a[y] * c[y]);
    }
    if ((x = b % 11) < 2) {
        a[13] = 0;
    } else {
        a[13] = 11 - x;
    }
    if ((CNPJ.charAt(12) != a[12]) || (CNPJ.charAt(13) != a[13])) {
        return false;
    }
    return true;
}
function maskCPF(CPF) {
    return CPF.substring(0, 3) + "." + CPF.substring(3, 6) + "." + CPF.substring(6, 9) + "-" + CPF.substring(9, 11);
}
function maskCNPJ(CNPJ) {
    return CNPJ.substring(0, 2) + "." + CNPJ.substring(2, 5) + "." + CNPJ.substring(5, 8) + "/" + CNPJ.substring(8, 12) + "-" + CNPJ.substring(12, 14);
}
/*
CPF e CNPJ -FIM
*/

</script>

<link href="./css/estilos.css" rel="stylesheet" type="text/css">
<style type="text/css">
<!--
.bt1 {	width:80px; border-top: solid 1px #dddddd; border-right: solid 1px #dddddd; height:18px; 
	border-left: solid 2px #cccccc; border-bottom: solid 2px #cccccc; backGround-Color:'#eeeeee';
}
-->
body {
background-image:url('img/fundos/parede_01.jpg');
background-repeat:repeat;
background-position:left;
background-attachment:scroll;
//background-size:cover;
}
.fundotransparente 
{
max-height:100%;
background:#fff;
position:absolute;
top:0;
left:0;
width:100%;
height:100%;
opacity:0.4;
filter:alpha(opacity=80);
z-index:1
}

#container
{
z-index:2;position:relative
}
</style>

<style rel="stylesheet" type="text/css">
body { 
	background-image:url("img/fundos/parede_01.jpg"); 
//	background-image:url("img/fundos/parede_13.jpg"); 
//	background-image:url("img/fundos/parede_05.jpg"); 
	background-opacity: .2;
	background-position:left; 
	background-repeat: repeat;
	background-attachment:scroll;  
	background-color:#ffffff;
	}

.campos {
	font-family: Arial, Helvetica, sans-serif;
	font-size: 12px;
	color: #000000;
	text-decoration: none;
	border: 1px solid #e3e3e3;
}
</style>

</head>
<body leftmargin="0" topmargin="0" marginwidth="0" marginheight="0">


  
<?
extract($_GET);
extract($_POST);

if (isset($codusu))
	{
	$dbcliente = new TMySQL($host,$base,$user,$pass);

	$queryinicial = "select * from cliente  
						where (email = '" . $codusu . "') ";
	$dbcliente->query($queryinicial);
	if ($dbcliente->count == 0)
		{
		?>
		<script language="javascript" type="text/javascript">
			alert ("\rCLIENTE NÃO ENCONTRADO - 2!\r"); 
					window.close(); 
		</script>
		<?
				die();
		}
	
	
	}
if(isset($_POST['acao']))
{
	extract($_GET);
	extract($_POST);

	$dbcliente = new TMySQL($host,$base,$user,$pass);

	$queryinicial = "select * from cliente  
						where (email = '" . $email_passado . "') ";
	$dbcliente->query($queryinicial);
	echo 'Query1:'.$queryinicial.'<hr>'; $form_empresa = $dbcliente->result["empresa"];	echo 'empresa1:'.$form_empresa.'<hr>'; 
	//die();

	if ($dbcliente->count == 0)
		{
		?>
		<script language="javascript" type="text/javascript">
			alert ("\rCLIENTE NÃO ENCONTRADO - 3 !\r"); 
					window.close(); 
		</script>
		<?
				die();
		}

	//$form_senha = $dbcliente->result["senha"];	
	$queryinicial = "delete from cliente  
						where (email = '" . $email_passado . "') ";
	$dbcliente->query($queryinicial);
	
	$cad = "insert into cliente set 
	email='$email',
	tipo_pj_pf=$tipo_pj_pf,
	nome_razao='$nome_razao',
	cpf_cnpj='$cpf_cnpj',
	email='$email',
	tefone='$tefone',
	data_inclusao='$data_inclusao'	
	";
				
		$r_cad = new TMySQL($host, $base, $user, $pass);
		if(!$r_cad->query($cad)) 
			{
			echo '<script>
						alert("Problemas no registro do Cliente.\nAvise Gerência.");
					</script>';
					echo $cad; die();
			}
		else
			{
			echo '<script>
						alert("Cliente alterado com sucesso.\n");
					</script>';
			}

}
?>

<div align="center">
<br>
<br>

<div id=container>
<table width="700" border="0" cellspacing="0" cellpadding="0">
	<tr>
	  <td width="100%" valign="top">
			<!-- COLUNA DO MEIO - INICIO -->
		<form name="cadastra" method="post" onSubmit="return validar(this);" enctype="multipart/form-data">
		<table width="100%" border="0" cellspacing="0" cellpadding="0">
			<tr height="50">
			<td colspan="2" class="azul18" align="center">
			Cadastramento de Cliente
			<hr style="background-color:#000000;border-width:0;color:#000000;height:1.5px;width:100%;">
			</td>
			</tr>
			
			
			<tr>
			  <td class="azul14"><font color="red"><b>*&nbsp;</b></font> Nome / Razão Social:</td>
			  <td align="left" class="laranja14">
			  <input name="nome_razao" id="nome_razao" type="text" size="50" class="laranja14" value="<? echo $dbcliente->result["nome_razao"]; ?>">
			</tr>

			<tr>
			  <td class="azul14" width="20%"><font color="red"><b>*&nbsp;</b></font> E-Mail:</td>
			  <td align="left" class="laranja14" width="80%">
				<input name="email" id="email" type="text" size="50" class="laranja14" value="<? echo $dbcliente->result["email"]; ?>">
			  </td>
			</tr>

			<tr>
			  <td class="azul14"> Telefone:</td>
			  <td align="left" class="laranja14">
			  <input name="telefone" id="telefone" type="text" size="15" maxlength="15" class="laranja14" value="<? echo $dbcliente->result["telefone"]; ?>">
			</tr>

			<tr>
			  <td class="azul14"> CPF / CNPJ:</td>
			  <td align="left" class="laranja14">
			  <input name="cpf_cnpj" id="cpf_cnpj" type="text" size="15" maxlength="15" class="laranja14" value="<? echo $dbcliente->result["socio"]; ?>" onblur="validar(this)">
			</tr>

			<tr>
			  <td class="azul14"> Já é Sócio ?</td>
			  <td align="left" class="laranja14">
				<select name="socio" id="socio" class="laranja14" value="<? echo $dbcliente->result["socio"]; ?>">
				<option value="S"> Sim</option>
				<option value="N"> Não</option>
				</select>
			</td>
			</tr>

			<tr>
			<td colspan="2" class="preto16" align="center">
			<hr style="background-color:#000000;border-width:0;color:#000000;height:1.5px;width:100%;">
			<font color="red">*&nbsp;</b></font> Campos assinalados com <font color="red"><b>*&nbsp;</font> são obrigatórios.
			</td>
			</tr>
									
			<tr>
			<td height="50" colspan="2"align="center">
			<input name="submit" type="submit" class="texto" value="Alterar Cliente" style="font-face: 'Comic Sans MS'; font-size: 14px; color: #0B0B3B; background-color: #81F7F3; border: 2pt ridge lightgrey">
			<input type="button" class="buttonFale" value="Cancelar" onClick="window.close();" style="font-face: 'Comic Sans MS'; font-size: 14px; color: #FFFFFF; background-color: #FF0000; border: 2pt ridge lightgrey">
			<input type="Hidden" name="acao" value="ok">
			<input type="Hidden" name="d" value="<? echo $dbcliente->result["data_inclusao"]; ?>">
			</td>
			</tr>
		</table>
		</form>
            <!-- COLUNA DO MEIO - FIM -->
</table>
</div>

</div>
</body>
</html>
