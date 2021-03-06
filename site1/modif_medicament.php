<?php require_once('../Connections/conn.php'); ?>
<?php
if (!function_exists("GetSQLValueString")) {
function GetSQLValueString($theValue, $theType, $theDefinedValue = "", $theNotDefinedValue = "") 
{
  $theValue = get_magic_quotes_gpc() ? stripslashes($theValue) : $theValue;

  $theValue = function_exists("mysql_real_escape_string") ? mysql_real_escape_string($theValue) : mysql_escape_string($theValue);

  switch ($theType) {
    case "text":
      $theValue = ($theValue != "") ? "'" . $theValue . "'" : "NULL";
      break;    
    case "long":
    case "int":
      $theValue = ($theValue != "") ? intval($theValue) : "NULL";
      break;
    case "double":
      $theValue = ($theValue != "") ? "'" . doubleval($theValue) . "'" : "NULL";
      break;
    case "date":
      $theValue = ($theValue != "") ? "'" . $theValue . "'" : "NULL";
      break;
    case "defined":
      $theValue = ($theValue != "") ? $theDefinedValue : $theNotDefinedValue;
      break;
  }
  return $theValue;
}
}

$editFormAction = $_SERVER['PHP_SELF'];
if (isset($_SERVER['QUERY_STRING'])) {
  $editFormAction .= "?" . htmlentities($_SERVER['QUERY_STRING']);
}
$var = $_GET["n"];

if ((isset($_POST["MM_update"])) && ($_POST["MM_update"] == "form1")) {
  $updateSQL = sprintf("UPDATE medicament SET nom_med=%s, nom_c_med=%s, dosage=%s, pays_f_med=%s, generique=%s, cond=%s, frome=%s, tarif_r=%s WHERE n_med like ".$var,
                       GetSQLValueString($_POST['nom_med'], "text"),
                       GetSQLValueString($_POST['nom_c_med'], "text"),
                       GetSQLValueString($_POST['dosage'], "text"),
                       GetSQLValueString($_POST['pays_f_med'], "text"),
                       GetSQLValueString($_POST['generique'], "text"),
                       GetSQLValueString($_POST['cond'], "text"),
                       GetSQLValueString($_POST['frome'], "text"),
                       GetSQLValueString($_POST['tarif_r'], "text"),
                       GetSQLValueString($_POST['n_med'], "int"));

  mysql_select_db($database_conn, $conn);
  $Result1 = mysql_query($updateSQL, $conn) or die(mysql_error());
}

mysql_select_db($database_conn, $conn);
$query_medicament = "SELECT * FROM medicament where n_med like ".$var;
$medicament = mysql_query($query_medicament, $conn) or die(mysql_error());
$row_medicament = mysql_fetch_assoc($medicament);
$totalRows_medicament = mysql_num_rows($medicament);
?><!DOCTYPE html>
<html lang="en">
<head>
	<title>maj medicament</title>
	<meta charset="utf-8">
	<link rel="stylesheet" href="css/reset.css" type="text/css" media="screen">
	<link rel="stylesheet" href="css/style.css" type="text/css" media="screen">
	<link rel="stylesheet" href="css/grid.css" type="text/css" media="screen">  
	<script src="js/jquery-1.7.1.min.js" type="text/javascript"></script>
	<script src="js/cufon-yui.js" type="text/javascript"></script>
	<script src="js/cufon-replace.js" type="text/javascript"></script>
	<script src="js/Vegur_500.font.js" type="text/javascript"></script>
	<script src="js/Ropa_Sans_400.font.js" type="text/javascript"></script> 
	<script src="js/FF-cash.js" type="text/javascript"></script>	
	<script src="js/script.js" type="text/javascript"></script>  
	<!--[if lt IE 8]>
	<div style=' clear: both; text-align:center; position: relative;'>
		<a href="http://windows.microsoft.com/en-US/internet-explorer/products/ie/home?ocid=ie6_countdown_bannercode">
			<img src="http://storage.ie6countdown.com/assets/100/images/banners/warning_bar_0000_us.jpg" border="0" height="42" width="820" alt="You are using an outdated browser. For a faster, safer browsing experience, upgrade for free today." />
		</a>
	</div>
	<![endif]-->
	<!--[if lt IE 9]>
 		<script type="text/javascript" src="js/html5.js"></script>
		<link rel="stylesheet" href="css/ie.css" type="text/css" media="screen">
	<![endif]--></head>
<body id="page5">
	<div align="center"></div>
<div align="center">
	  <!--==============================header=================================-->
</div>
	<header>
		<div class="border-bot">
			<div class="main">
				<h1 align="center"><a href="index.html">InternetCafe</a></h1>
				<nav>
					<div align="center">
					  <ul class="menu">
					    <li><a href="index.html">Acceuil</a></li>
					    <li><a href="index1.html">Cabinet</a></li>
					    <li><a href="index2.html">Services</a></li>
					    <li><a href="index3.html">Personnel</a></li>
					    <li><a class="" href="index4.html">Contacts</a></li>
				      </ul>
				  </div>
				</nav>
				<div class="clear"></div>
			</div>
		</div>
	</header>
	<div align="center">
	  <!--==============================content================================-->
</div>
	<section id="content"><div class="ic">
	  <div align="center">More Website Templates @ TemplateMonster.com - Mrach 03, 2012!</div>
	</div>
		<div class="main">
			<div class="container_12">
				<div class="wrapper">
				  <div class="aligncenter">
				    <div align="center"><strong>mise a jour medicament</strong></div>
				  </div>
				  <p align="center">&nbsp;</p>
				  <form method="post" name="form1" action="<?php echo $editFormAction; ?>">
                    <div align="center">
                      <table align="center">
                        <tr valign="baseline">
                          <td nowrap align="right">Nom :</td>
                          <td><input type="text" name="nom_med" value="<?php echo htmlentities($row_medicament['nom_med'], ENT_COMPAT, ''); ?>" size="32"></td>
                        </tr>
                        <tr valign="baseline">
                          <td nowrap align="right">Nom commercial :</td>
                          <td><input type="text" name="nom_c_med" value="<?php echo htmlentities($row_medicament['nom_c_med'], ENT_COMPAT, ''); ?>" size="32"></td>
                        </tr>
                        <tr valign="baseline">
                          <td nowrap align="right">Dosage:</td>
                          <td><input type="text" name="dosage" value="<?php echo htmlentities($row_medicament['dosage'], ENT_COMPAT, ''); ?>" size="32"></td>
                        </tr>
                        <tr valign="baseline">
                          <td nowrap align="right">Pays de fabrication:</td>
                          <td><input type="text" name="pays_f_med" value="<?php echo htmlentities($row_medicament['pays_f_med'], ENT_COMPAT, ''); ?>" size="32"></td>
                        </tr>
                        <tr valign="baseline">
                          <td nowrap align="right">Generique:</td>
                          <td><input type="text" name="generique" value="<?php echo htmlentities($row_medicament['generique'], ENT_COMPAT, ''); ?>" size="32"></td>
                        </tr>
                        <tr valign="baseline">
                          <td nowrap align="right">Conditionnement:</td>
                          <td><input type="text" name="cond" value="<?php echo htmlentities($row_medicament['cond'], ENT_COMPAT, ''); ?>" size="32"></td>
                        </tr>
                        <tr valign="baseline">
                          <td nowrap align="right">Frome:</td>
                          <td><input type="text" name="frome" value="<?php echo htmlentities($row_medicament['frome'], ENT_COMPAT, ''); ?>" size="32"></td>
                        </tr>
                        <tr valign="baseline">
                          <td nowrap align="right">Tarif de reference:</td>
                          <td><input type="text" name="tarif_r" value="<?php echo htmlentities($row_medicament['tarif_r'], ENT_COMPAT, ''); ?>" size="32"></td>
                        </tr>
                        <tr valign="baseline">
                          <td nowrap align="right">&nbsp;</td>
                          <td><input type="submit" value="Mettre à jour l'enregistrement"></td>
                        </tr>
                      </table>
                      <input type="hidden" name="MM_update" value="form1">
                      <input type="hidden" name="n_med" value="<?php echo $row_medicament['n_med']; ?>">
                      </div>
                  </form>
                  <p align="center">&nbsp;</p>
                  <p align="center">&nbsp;</p>
				  <p align="center">&nbsp;</p>
				  <p align="center">&nbsp;</p>
				</div>
		  </div>
		</div>
	</section>
	<div align="center">
	  <!--==============================footer=================================-->
</div>
	<footer></footer>
	<div align="center">    </div>
    <script type="text/javascript"> Cufon.now(); </script>
</body>
</html>
<?php
mysql_free_result($medicament);
?>