<?
include("bd/base.cfg.php");

extract($_GET);
extract($_POST);
?>
<html>
<head>
<title>Manutenção Clientes - MERIDIEN CLUBE</title>
<meta name="author" content="Gunther Goemann">
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<meta name="language" content="pt-br">

<meta name="robots" content="index, follow">

<link href="css/estilos.css" rel="stylesheet" type="text/css">
<style rel="stylesheet" type="text/css">

body {
	background-position: 0% 0%;
//	background:transparent url("./img/logo-meridien-tiny.png") repeat scroll 0 0;
	background-size: 10% 10%;

	filter: progid:DXImageTransform.Microsoft.Alpha;
	zoom: 1;
	
}
.campos {
	font-family: Arial, Helvetica, sans-serif;
	font-size: 12px;
	color: #000000;
	text-decoration: none;
	border: 1px solid #e3e3e3;
}
</style>

<style type="text/css">
#menu {
    left:0px;
    margin:0;
    padding:0;
    position:absolute;
    top:50px;
    width:75px;
}
#menu ul {
    list-style:none;
    margin:0;
    padding:0;
}
#menu ul li {
    margin-bottom:2px;
}
#menu ul li a {
    //background-color:#333;
    //border:1px solid #999;
    color:#FFF;
    display:block;
    padding:5px 5px 5px 15px;
    text-decoration:none;
}
#menu ul li a:hover {
    background-color:#ccc;
    color:#333;
}
</style>
</head>
<script language="javascript" type="text/javascript" src="default.js"></script>

<body leftmargin="0" topmargin="0" marginwidth="0" marginheight="0">
<div align="center">
	<table align="center" border="0" cellpadding="0" cellspacing="3" width="50%">
	<tr>
	<td>
		<img src="img/logo-meridien-tiny.png"  border="0">
	</td>
	
	<td align="center">
		<font size="5" color="#191970"><b>
			Meridien Clube
		</b></font>
	</td>
	</tr>
	
	<tr>
	<td>
	</td>
	
	<td align="center">
		<font size="5"><b>
		<br><br><br>
			Manutenção de Clientes
			<br><br>
		</b></font>
	</td>
	</tr>

	<tr>
		<td>
		</td>
		<td class="texto" align="center">
		 <input type="hidden" name="acao" value="altera">
		 <input type="button" onClick="window.open('cliente_inclui.php?opcao=I','clienteinclui','width=900,height=500,menubar=no,location=no,resizable=yes,status=no,toolbar=no,scrollbars=yes');" value="CADASTRAR / INCLUIR" class="texto" style="width:200px;height:30px;color:#FFFFFF;font-family:Verdana;font-weight:bold;font-size:12;background-color:#191970;border-color:#191970;">&nbsp; 
<br>
<br>
		 <input type="button" onClick="window.open('cliente_lista.php?opcao=L','clienteinclui','width=900,height=500,menubar=no,location=no,resizable=yes,status=no,toolbar=no,scrollbars=yes');" value="CONSULTAR / ATUALIZAR" class="texto" style="width:200px;height:30px;color:#FFFFFF;font-family:Verdana;font-weight:bold;font-size:12;background-color:#191970;border-color:#191970;">&nbsp; 
		 <br><br>
		</td>
	</tr>
	
	
	</table>
</div>

</body>
</html>
