<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Documento sin título</title>
<link rel="stylesheet" type="text/css" href="hoja.css">
</head>
<body>
<h1>ACTUALIZAR</h1>
<?php
  include("conexion.php");
  if(!isset($_POST["bot_actualizar"])) {
    $codigoArt=$_GET["CODIGOARTICULO"];
    $seccion=$_GET["SECCION"];
    $nombreArt=$_GET["NOMBREARTICULO"];
    $precio=$_GET["PRECIO"];
    $fecha=$_GET["FECHA"];
    $importado=$_GET["IMPORTADO"];
    $paisOrigen=$_GET["PAISDEORIGEN"];
  }else{
        $codigoArt=$_POST["CODIGOARTICULO"];
        $seccion=$_POST["SECCION"];
        $nombreArt=$_POST["NOMBREARTICULO"];
        $precio=$_POST["PRECIO"];
        $fecha=$_POST["FECHA"];
        $importado=$_POST["IMPORTADO"];
        $paisOrigen=$_POST["PAISDEORIGEN"];

    $sql="UPDATE productos SET CODIGOARTICULO=:CODIGOARTICULO, SECCION=:SECCION, NOMBREARTICULO=:NOMBREARTICULO, PRECIO=:PRECIO, FECHA=:FECHA, IMPORTADO=:IMPORTADO, PAISDEORIGEN=:PAISDEORIGEN WHERE CODIGOARTICULO=:CODIGOARTICULO";
   
    $resultado=$base->prepare($sql);
    $resultado->execute(array(":CODIGOARTICULO"=>$codigoArt, ":SECCION"=>$seccion, ":NOMBREARTICULO"=>$nombreArt, ":PRECIO"=>$precio, ":FECHA"=>$fecha, ":IMPORTADO"=>$importado, ":PAISDEORIGEN"=>$paisOrigen));
    header("Location:index.php");
  }
?>
<p>
</p>
<p>&nbsp;</p>
<form name="form1" method="post" action="<?php echo $_SERVER['PHP_SELF'];?>">
  <table width="25%" border="0" align="center">
    <tr>
      <td></td>
      <td><label for="id"></label>
      <input type="hidden" name="CODIGOARTICULO" id="CODIGOARTICULO" value="<?php echo $codigoArt ?>"></td>
    </tr>
    <tr>
      <td>Nombre</td>
      <td><label for="nom"></label>
      <input type="text" name="SECCION" id="SECCION" value="<?php echo $seccion ?>"></td>
    </tr>
    <tr>
      <td>Apellido</td>
      <td><label for="ape"></label>
      <input type="text" name="NOMBREARTICULO" id="NOMBREARTICULO" value="<?php echo $nombreArt ?>"></td>
    </tr>
    <tr>
      <td>Dirección</td>
      <td><label for="dir"></label>
      <input type="text" name="PRECIO" id="PRECIO" value="<?php echo $precio ?>"></td>
    </tr>
    <tr>
      <td>Dirección</td>
      <td><label for="dir"></label>
      <input type="text" name="FECHA" id="FECHA" value="<?php echo $fecha ?>"></td>
    </tr>
    <tr>
      <td>Dirección</td>
      <td><label for="dir"></label>
      <input type="text" name="IMPORTADO" id="IMPORTADO" value="<?php echo $importado ?>"></td>
    </tr>
    <tr>
      <td>Dirección</td>
      <td><label for="dir"></label>
      <input type="text" name="PAISDEORIGEN" id="PAISDEORIGEN" value="<?php echo $paisOrigen ?>"></td>
    </tr>
    <tr>
      <td colspan="2"><input type="submit" name="bot_actualizar" id="bot_actualizar" value="Actualizar"></td>
    </tr>
  </table>
</form>
<p>&nbsp;</p>
</body>
</html>