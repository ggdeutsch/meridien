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
	alert("Cliente n�o encontrado - 1.\n");
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

<script language="javascript">

function validar(formulario) 
{
		msg = 'Ocorreram os seguintes erros:\n';
		conta = 0;
		foco = '';

		if (form_email.value == '')
			{
			conta = conta + 1; msg += '\n'+conta+' - Campo \'EMail\' inv�lido.'; if(foco == '') {foco = 'form_email';}
			//alert("Nome do Roteiro inv�lido!");
			}

		if (document.getElementById("form_nome").value == '')
			{
			conta = conta + 1; msg += '\n'+conta+' - Campo \'Nome\' obrigat�rio.'; if(foco == '') {foco = 'form_nome';}
			//alert("Nome do Roteiro inv�lido!");
			}
	
	
		if (document.getElementById("form_senha").value == '')
			{
			conta = conta + 1; msg += '\n'+conta+' - Campo \'Senha\' obrigat�rio.'; if(foco == '') {foco = 'form_nome';}
			//alert("Nome do Roteiro inv�lido!");
			}
		else
			{
			if (document.getElementById("form_senha").value != document.getElementById("form_conf_senha").value)
				{
				conta = conta + 1; msg += '\n'+conta+' - Campo \'Senha DIFERENTE da Confirma��o de Senha\'.'; if(foco == '') {foco = 'form_nome';}
				//alert("Nome do Roteiro inv�lido!");
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
			alert ("\rCLIENTE N�O ENCONTRADO - 2!\r"); 
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
			alert ("\rCLIENTE N�O ENCONTRADO - 3 !\r"); 
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
						alert("Problemas no registro do Cliente.\nAvise Ger�ncia.");
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
			  <td class="azul14"><font color="red"><b>*&nbsp;</b></font> Nome / Raz�o Social:</td>
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
			  <td class="azul14"> J� � S�cio ?</td>
			  <td align="left" class="laranja14">
				<select name="socio" id="socio" class="laranja14" value="<? echo $dbcliente->result["socio"]; ?>">
				<option value="S"> Sim</option>
				<option value="N"> N�o</option>
				</select>
			</td>
			</tr>

			<tr>
			<td colspan="2" class="preto16" align="center">
			<hr style="background-color:#000000;border-width:0;color:#000000;height:1.5px;width:100%;">
			<font color="red">*&nbsp;</b></font> Campos assinalados com <font color="red"><b>*&nbsp;</font> s�o obrigat�rios.
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
