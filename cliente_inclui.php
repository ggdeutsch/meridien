<? 
include("bd/base.cfg.php");
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

		if (document.getElementById("email").value == '')
			{
			conta = conta + 1; msg += '\n'+conta+' - Campo \'EMail\' inválido.'; if(foco == '') {foco = 'email';}
			}

		if (document.getElementById("nome_razao").value == '')
			{
			conta = conta + 1; msg += '\n'+conta+' - Campo \'Nome\' obrigatório.'; if(foco == '') {foco = 'nome_razao';}
			}
		
		if (document.getElementById("socio").value == '0')
			{
			conta = conta + 1; msg += '\n'+conta+' - Campo \'Socio\' obrigatório.'; if(foco == '') {foco = 'socio';}
			}
		
		if (document.getElementById("cpf_cnpj").value == '0')
			{
			conta = conta + 1; msg += '\n'+conta+' - Campo \'CPF / CNPJ\' obrigatório.'; if(foco == '') {foco = 'cpf_cnpj';}
			}
		
		if (document.getElementById("telefone").value == '0')
			{
			conta = conta + 1; msg += '\n'+conta+' - Campo \'Telefone\' obrigatório.'; if(foco == '') {foco = 'telefone';}
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
    var tam = (s).length; // removendo os caracteres năoo numéricos
    if (!(tam == 11 || tam == 14 || tam == 0)) { // validando o tamanho
        alert("'" + s + "' Năo é um CPF ou um CNPJ Válido!"); // tamanho inválido
        obj.focus();
        return false;
    }

// se for CPF
    if (tam == 11) {
        if (!validaCPF(s)) { // chama a funçăo que valida o CPF
            alert("'" + s + "' Năo é um CPF Válido!"); // se quiser mostrar o erro
            obj.select(); // se quiser selecionar o campo em questăo
            obj.focus();
            return false;
        }
        obj.value = maskCPF(s); // se validou o CPF mascaramos corretamente
        return true;
    }

// se for CNPJ
    if (tam == 14) {
        if (!validaCNPJ(s)) { // chama a funçăo que valida o CNPJ
            alert("'" + s + "' Năo é um CNPJ Válido!"); // se quiser mostrar o erro
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

body {

#container
{
z-index:2;position:relative
}
</style>

<style rel="stylesheet" type="text/css">
body { 

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

<div class="fundotransparente">
</div>
  
<?
if(isset($_POST['acao']))
{
	extract($_GET);
	extract($_POST);
	extract($_SESSION);

	
	$data_inclusao = date("Y-m-d");		
	$cad = "select * from cliente 
	where (email='$email') ";

	$r_cad = new TMySQL($host, $base, $user, $pass);
	$r_cad->query($cad);
	if ($r_cad->count > 0) 
		{
		echo '<script>
					alert("Já existe cliente com este nome. ESCOLHA OUTRO NOME !");
					history.go(-1);
				</script>';
			die();
		}
	
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
					alert("Problemas no registro do Cliente-1.\nAvise Geręncia.");
				</script>';
		}
	else
		echo '<script>
					alert("Cliente cadastrado comm sucesso.\n");
				</script>';
				echo $grava . '<hr>';
				die();
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
			  <td class="azul14"><font color="red"><b>*&nbsp;</b></font> Nome / Razăo Social:</td>
			  <td align="left" class="laranja14">
			  <input name="nome_razao" id="nome_razao" type="text" size="50" class="laranja14">
			</tr>

			<tr>
			  <td class="azul14" width="20%"><font color="red"><b>*&nbsp;</b></font> E-Mail:</td>
			  <td align="left" class="laranja14" width="80%">
				<input name="email" id="email" type="text" size="50" class="laranja14">
			  </td>
			</tr>

			<tr>
			  <td class="azul14"> Telefone:</td>
			  <td align="left" class="laranja14">
			  <input name="telefone" id="telefone" type="text" size="15" maxlength="15" class="laranja14">
			</tr>

			<tr>
			  <td class="azul14"> CPF / CNPJ:</td>
			  <td align="left" class="laranja14">
			  <input name="cpf_cnpj" id="cpf_cnpj" type="text" size="15" maxlength="15" class="laranja14" onblur="validar(this)">
			</tr>

			<tr>
			  <td class="azul14"> Já é Sócio ?</td>
			  <td align="left" class="laranja14">
				<select name="socio" id="socio" class="laranja14">
				<option value="S"> Sim</option>
				<option value="N"> Năo</option>
				</select>
			</td>
			</tr>

			<tr>
			<td colspan="2" class="preto16" align="center">
			<hr style="background-color:#000000;border-width:0;color:#000000;height:1.5px;width:100%;">
			<font color="red">*&nbsp;</b></font> Campos assinalados com <font color="red"><b>*&nbsp;</font> săo obrigatórios.
			</td>
			</tr>
									
			<tr>
			<td height="50" colspan="2"align="center">
			<input name="submit" type="submit" class="texto" value="Cadastrar Usu&aacute;rio" style="font-face: 'Comic Sans MS'; font-size: 14px; color: #0B0B3B; background-color: #81F7F3; border: 2pt ridge lightgrey">
			<input type="button" class="buttonFale" value="Cancelar" onClick="window.close();" style="font-face: 'Comic Sans MS'; font-size: 14px; color: #FFFFFF; background-color: #FF0000; border: 2pt ridge lightgrey">
			<input type="Hidden" name="acao" value="ok">
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
