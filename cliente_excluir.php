<?
include("./bd/base.cfg.php");
//authPage();
session_start();
extract ($_GET); 
extract ($_POST); $empresa = 1;
//print_r($_SESSION);
//echo '<hr>';

if(!isset($acao)) {$acao = '';} else {$acao = $acao;}
?>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<!meta http-equiv="Content-Type" content="text/html;charset=iso-8859-1" />
<title>Exclusão Cliente</title>
<link href="./css/estilos.css" rel="stylesheet" type="text/css" />
<link href="./css/default.css" rel="stylesheet" type="text/css" />
<style rel="stylesheet" type="text/css">

body { 
	background-image:url(); 
	background-position:left; 
	background-repeat:repeat-y; 
	background-attachment:scroll;  
	background-color:#FFFFFF;
	}

body {
  background-image: url("./img/holytour_group.png");
  background-position: 10% 100%;
  background-repeat: no-repeat;
  background-size: 240 144;
}
.campos {
	font-family: Arial, Helvetica, sans-serif;
	font-size: 12px;
	color: #000000;
	text-decoration: none;
	border: 1px solid #e3e3e3;
}
</style>

<script>
  var largura = 600;
  var altura = 500;
  
  pos_x = (screen.width - 800) / 2;
  pos_y = 10;
self.focus();
window.resizeTo(largura,altura);
window.moveTo(pos_x, pos_y);
</script>
<script language="JavaScript">
   function valida_senha()
			{
			    var msg = "Ocorreram os seguintes erros:\n";
							   erro1 = 0;
							   erro2 = 0;
							   erro3 = 0;
							   erro4 = 0;
							   erro5 = 0;
							
							toterros = eval(erro1 + erro2 + erro3 + erro4 + erro5);
							if(toterros != 0)
							   {
										    alert(msg);
														document.senha.atual.focus();
										}
							else
							   {
										    document.senha.submit();
										}			
			}
</script>
</head>
<body leftmargin="0" topmargin="0" marginwidth="0" marginheight="0">
<center><!img src="smac_001.gif" width="100" height="100" border="0"></center>
<br style="line-height: 10px;">
<?
$db = new TMySQL($host,$base,$user,$pass);
$queryNome= "select * from cliente where (email = '".$codusu."') ";

$db->query($queryNome);
if ($db->count == 0)
	{
	echo $queryNome . '<br>'; 
	echo '<script>
	alert("Usuário não encontrado.\n");
		//window.close();
	</script> ';
	}
$nome = $db->result["nome"];
//echo $fsenha . '<br>'; 
//echo $atual . '<br>'; 

if($acao == 'altera') 
  {//INICIO - ROTINA DE EXCLUSÃO CLIENTE
$db = new TMySQL($host,$base,$user,$pass);
$queryNome= "select * from cliente where (email = '".$codusu."') ";

$db->query($queryNome);
if ($db->count == 0)
	{
	echo '<script>
	alert("Usuário não encontrado.\n");
		window.close();
	</script> ';
	}
	
if ($quem_recebe == 'Selecione')
	{
	?>
	<script language="javascript" type="text/javascript">
		alert ("\rFalta selecionar QUEM RECEBERÁ os lançamentos !\r"); 
		history.go(-1);
		//gunther falta fechar essa  janela!!!!!!!!!!!!
//					window.close(); 
	</script>
	<?
	die();
	
	}

$altera1 = "UPDATE fid_movimento 
			SET quem_lancou='" . $quem_recebe . "' 
			WHERE (empresa=1) 
			AND (quem_lancou='" . $codusu . "') ";
$apaga1 = "delete from cliente 
				where (email = '" . $codusu . "') ";	
$apaga = "delete from cliente  
				where (email = '" . $codusu . "') ";	
						
//echo $altera1 . "<br>";
//echo $apaga . "<br>";
//echo $apaga1 . "<br>";
//die();

	$r_cad = new TMySQL($host, $base, $user, $pass);
	$r_cad->query($altera1);

	$r_cad = new TMySQL($host, $base, $user, $pass);
	if(!$r_cad->query($apaga)) 
		{
		echo '<script>
					alert("Problemas na eliminacao.\nAvise Gerência.");
				</script>';
				echo $apaga . '<hr>';
				die();
		}
	else
		{
		$host_salvo = $host; 
		$base_salvo = $base; 
		$user_salvo = $user;  
		$pass_salvo = $pass;	

		$host = "localhost"; 
		$base = "so100net_mysql01"; 
		$user = "so100net_mysql01";  
		$pass = "soeusabia1517";	
		$host = "so100net_my01.mysql.dbaas.com.br"; 		$base = "so100net_my01"; 		$user = "so100net_my01";  		$pass = "soeusabia1517";						
		$r_cad = new TMySQL($host, $base, $user, $pass);
		if(!$r_cad->query($apaga1)) 
			{
			$host = $host_salvo; 
			$base = $base_salvo; 
			$user = $user_salvo;  
			$pass = $pass_salvo;	
			echo '<script>
						alert("Problemas na eliminação.\nAvise Gerência.");
					</script>';
					echo $apaga1 . '<hr>';
					die();
			}
		else
			{
			$host = $host_salvo; 
			$base = $base_salvo; 
			$user = $user_salvo;  
			$pass = $pass_salvo;	
			echo '<script>
			alert("CLIENTE APAGADO.\n");
				window.opener.location.reload()
				window.close();
			</script> ';
			}
		}
			
  } //FIM - ROTINA DE EXCLUSÃO CLIENTE
?>
<form name="senha">

<table width="100%" align="center" style="border-collapse: collapse;" border="0" cellpadding="0" cellspacing="1">
   <tr>
      <td>
         <table width="100%" align="center" border="0" cellpadding="0" cellspacing="0">
            <tr>
               <td class="laranja16" align="center" height="25">:: Exclusão de USUÁRIO <? echo $codusu; ?> ::</td>
            </tr>
         </table>
         <table width="100%" align="center" border="0" cellpadding="0" cellspacing="1">
            <tr>
               <td valign="top" align="center" class="azul14">
			<!--  AQUI DENTRO DESSE TD INICIARÁ AS TABELAS DAS OPÇÕES ESCOLHIDAS -  INÍCIO -->
			<hr>
			Quem recebera os lancamentos de <? echo $codusu; ?> ?&nbsp;
			<br>
			<select name="quem_recebe" class="laranja14">
			  <option value="Selecione">Selecione</option>
			<?
			$consulta = "select * from cliente   							where (empresa = " . $empresa . ") 							and (email != '" .$codusu. "') 							and (apaga_rsv = 'S') 								order by nome ";
			$db = new TMySQL($host,$base,$user,$pass);
			$db->query($consulta);
			for ($i=0;$i<$db->count;$i++) 
				{ 
				echo '<option value="'. $db->result["email"] .'">' . $db->result["Nome"] . '</option>';
				$db->next(); 
				} 
			?>
			  </select>
			<?php			//echo $consulta; die();?>
			<hr>
			
			<table align="center" border="0" cellpadding="0" cellspacing="3" width="100%">
				   <tr>
					  <td class="texto" align="center" colspan="2" >
						 <input type="hidden" name="acao" value="altera">
						 <input type="button" onClick="valida_senha();" value="CONFIRMAR ELIMINACAO" class="texto" style="width:200px;height:30px;color:#FFFFFF;font-family:Verdana;font-weight:bold;font-size:12;background-color:#088A85;border-color:#088A85;">&nbsp; 
						 <br><br>
						 <input type="button" value="Fechar" onClick="javascript:window.close();" class="texto" style="width: 100px;">&nbsp; 
						 <input type="hidden" name="codusu" value="<? echo $codusu; ?>">
						 <br><br>																													
					  </td>
				   </tr>
			  </table>	
<!--  AQUI DENTRO DESSE TD INICIARÁ AS TABELAS DAS OPÇÕES ESCOLHIDAS -  FIM-->
						  </td>
					</tr>
			  </table>
		    </td>
	  </tr>
</table>

</form>

<br>	
</body>
</html>
