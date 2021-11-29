<? 
include("./bd/base.cfg.php");
session_start();
$db_movto = new TMySQL($host,$base,$user,$pass);
$db = new TMySQL($host,$base,$user,$pass);
$queryNome= "select * from cliente where (email = '".$_SESSION["email"]."') ";

$db->query($queryNome);
if ($db->count == 0)
	{
	echo $queryNome . '<br>'; 
	echo '<script>
	alert("Cliente não encontrado.\n");
		//window.close();
	</script> ';
	}
$fnivel = $db->result["nivel"];

function formata_dinheiro($numero) 
{
	return number_format($numero, 2, ',', '.');
}

?>
<html>
<head>
<title>Lista Cliente</title>
<script language="javascript" src="./js/default.js">
MM_reloadPage(true);
</script>
<script language="javascript">


function valida(formu)
{
	msg = "Os seguintes campos estão em branco ou com erros:\n";
	count = 0;
	foco = '';


	
	if(count != 0)
	{
		alert(msg);
		foco_em = 'formu.'+foco+'.focus();';
		eval(foco_em);
		return false;
	}
	return true;
}

</script>

<link href="./css/estilos.css" rel="stylesheet" type="text/css">
<style type="text/css">
</style>
</head>
<body leftmargin="0" topmargin="0" marginwidth="0" marginheight="0">

<form name="consulta" method="post" onSubmit="return valida(this);" enctype="multipart/form-data"><table width="95%" border="0" cellspacing="0" cellpadding="0">
	<tr>
		<td width="217" valign="top">			<? //include("_menu.php"); ?>		</td>
	  <td valign="top">			<!-- COLUNA DO MEIO - INICIO -->
			<table width="100%"  border="0" cellspacing="0" cellpadding="0">
              <tr>
                <td width="64%" class="azul14">
				<strong>
				Relação Clientes</strong></td>
              </tr>
            </table>
			<?
			$dbcliente = new TMySQL($host,$base,$user,$pass);

			$queryinicial = "select * from cliente   
								order by nome ";
			$dbcliente->query($queryinicial);
			echo 'Query:'.$queryinicial.'<br>'.$dbcliente->count.'<hr>';
			if ($dbcliente->count == 0)
				{
				?>
				<script language="javascript" type="text/javascript">
					alert ("\rSEM CLIENTES !\r"); 
//					window.close(); 
				</script>
				<?
//				die();
				}
			?>
			<table align="center" width="80%" border="0" cellspacing="0" cellpadding="0" class="azul12">
				<tr> 
					<td class="azul12" valign=top align=left><b>&nbsp; </b></td>
					<td class="azul12" valign=top align=left><b>Email Cliente&nbsp; </b></td>
					<td class="azul12" valign=top align=left><b>Nome&nbsp; </b></td>
					<td class="azul12" valign=top align=right><b>Telefone&nbsp;</b></td>
				</tr>
				<tr> 
					<td colspan="4" valign=top align=left><hr></td>
				</tr>
			<?
$cor = "#BBFFFF";
				for ($i=0;$i<$dbcliente->count;$i++) 
					{//CONTA CLIENTES - INICIO
					if ($cor == "#BBFFFF")
						{
						$cor = "#FFFFFF";
						}
					else
						{
						$cor = "#BBFFFF";
						}
					
?>
				<tr bgcolor="<? echo $cor; ?>"> 
					<td valign=top align=left class="azul12">
						<a title="Clique aqui para EXCLUIR o CLIENTE." style="text-decoration:none" href="#" onClick="window.open('cliente_excluir.php?codcliente=<? echo $dbcliente->result["email"]; ?>','clienteexclui','width=600,height=400,menubar=no,location=no,resizable=no,status=no,toolbar=no,scrollbars=no,copyhistory=yes');">
						<img src="img/excluir.png" width="15" height="15" border="0">
						</a>
					</td>
					<td class="azul12" valign=top align=left>
						<a title="Alterar Cliente" style="text-decoration:none" href="#" onClick="window.open('cliente_altera.php?codcliente=<? echo $dbcliente->result["email"]; ?>','clientealtera','width=900,height=500,menubar=no,location=no,resizable=yes,status=no,toolbar=no,scrollbars=yes');">
						<span class="laranja14">
						<? echo $dbcliente->result["email"]; ?>
						</span>
						</a>
					</td>
					<td class="azul12" valign=top align=left><? echo $dbcliente->result["nome_razao"]; ?>&nbsp;</td>
					<td class="azul12" valign=top align=right><? echo $dbcliente->result["telefone"]; ?>&nbsp;</td>
				</tr>
<?						
						
					$dbcliente->next(); 
					}//CONTA CLIENTES - FIM
					
					?>
	</table>
            <!-- COLUNA DO MEIO - FIM -->
</table>

</form>	

</body>
</html>
