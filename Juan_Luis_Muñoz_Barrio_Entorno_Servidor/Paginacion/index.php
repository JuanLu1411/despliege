<!DOCTYPE html>
<html lang="en">
<head>

    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="hoja.css">
    <title>CRUD</title>
</head>
<body>
<?php
    
    include("conexion.php");
    //---------------------------------------------paginacion--------------------------------//
    $sql_total="SELECT * FROM productos";
		$registros_por_pagina=5; /* CON ESTA VARIABLE INDICAREMOS EL NUMERO DE REGISTROS QUE QUEREMOS POR PAGINA*/
		$estoy_en_pagina=1;/* CON ESTA VARIABLE INDICAREMOS la pagina en la que estamos*/
		
			if (isset($_GET["pagina"])){
				$estoy_en_pagina=$_GET["pagina"];				
			}
		
		$empezar_desde=($estoy_en_pagina-1)*$registros_por_pagina;
		
		$sql_total="SELECT * FROM productos";
/* CON LIMIT 0,3 HACE LA SELECCION DE LOS 3 REGISTROS QUE HAY EMPEZANDO DESDE EL REGISTRO 0*/
		$resultado=$base->prepare($sql_total);
		$resultado->execute(array());
		
		$num_filas=$resultado->rowCount(); /* nos dice el numero de registros del reusulset*/
		$total_paginas=ceil($num_filas/$registros_por_pagina); /* FUNCION CEIL REDONDEA EL RESULTADO*/
		echo "Numero de Registros de la consulta: " . $num_filas . "<br>";
		echo "Mostramos " . $registros_por_pagina . " Registros por página." . "<br>";
		echo "Mostrando la página " . $estoy_en_pagina . " de " . $total_paginas . "<br>" . "<br>";

/* ESTA PRIMERA CONSULTA ES PARA SABER NUMERO TOTAL DE REGISTROS Y MOSTRAR LAS PAGINAS Y REGISTROS QUE HAY*/
		
/*		while ($registro=$resultado->fetch(PDO::FETCH_ASSOC)){
			echo "Código Articulo: " . $registro['CODIGOARTICULO'] . " Seccion: " . $registro['SECCION'] ." Nombre Articulo: " . $registro['NOMBREARTICULO'] .  " Precio: " . $registro['PRECIO'] .  " Fecha: " . $registro['FECHA'] .  " Importado: " . $registro['IMPORTADO'] . " Pais de Origen: " . $registro['PAISDEORIGEN'] . "<br>";
		}*/
		
		$resultado->CloseCursor();
		$sql_limite="SELECT * FROM productos LIMIT $empezar_desde,$registros_por_pagina";
		$resultado=$base->prepare($sql_limite);
		$resultado->execute(array());
		
		while ($registro=$resultado->fetch(PDO::FETCH_ASSOC)){
			echo "Código Articulo: " . $registro['CODIGOARTICULO'] . " Seccion: " . $registro['SECCION'] ." Nombre Articulo: " . $registro['NOMBREARTICULO'] .  " Precio: " . $registro['PRECIO'] .  " Fecha: " . $registro['FECHA'] .  " Importado: " . $registro['IMPORTADO'] 
            . " Pais de Origen: " . $registro['PAISDEORIGEN'] . "<br>";
		}
		
	
    //fin paginacion -------------------------------------------------------------------------------------//

    $conexion=$base->query("SELECT * FROM productos  LIMIT $empezar_desde,$registros_por_pagina ");
    $registros=$conexion->fetchAll(PDO::FETCH_OBJ);

    if(isset($_POST["cr"])) {

        $codigoArt=$_POST["CODIGOARTICULO"];
        $seccion=$_POST["SECCION"];
        $nombreArt=$_POST["NOMBREARTICULO"];
        $precio=$_POST["PRECIO"];
        $fecha=$_POST["FECHA"];
        $importado=$_POST["IMPORTADO"];
        $paisOrigen=$_POST["PAISDEORIGEN"];

        $sql="INSERT INTO productos (CODIGOARTICULO, SECCION, NOMBREARTICULO, PRECIO,FECHA,IMPORTADO,PAISDEORIGEN) VALUES(:CODIGOARTICULO, :SECCION, :NOMBREARTICULO, :PRECIO, :FECHA, :IMPORTADO, :PAISDEORIGEN)";
        $resultado=$base->prepare($sql);
        $resultado->execute(array(":CODIGOARTICULO"=>$codigoArt, ":SECCION"=>$seccion, ":NOMBREARTICULO"=>$nombreArt, ":PRECIO"=>$precio, ":FECHA"=>$fecha, ":IMPORTADO"=>$importado, ":PAISDEORIGEN"=>$paisOrigen));

        header("Location:index.php");
    }

?>
    <h1>CRUD CESUR 2022</h1>
    <form action="<?php echo $_SERVER['PHP_SELF'];?>" method="post">
    <table width="50%" border="0" align="center">
    <tr>
        <td class="primera_fila">CODIGOARTICULO</td>
        <td class="primera_fila">SECCION</td>
        <td class="primera_fila">NOMBREARTICULO</td>
        <td class="primera_fila">PRECIO</td>
        <td class="primera_fila">FECHA</td>
        <td class="primera_fila">IMPORTADO</td>
        <td class="primera_fila">PAISDEORIGEN</td>
        <td class="sin">&nbsp;</td>
        <td class="sin">&nbsp;</td>
        <td class="sin">&nbsp;</td>
    </tr>

    <?php


    foreach($registros as $persona) :?>

    <tr>
        <td><?php echo $persona->CODIGOARTICULO?></td>
        <td><?php echo $persona->SECCION?></td>
        <td><?php echo $persona->NOMBREARTICULO?></td>
        <td><?php echo $persona->PRECIO?></td>
        <td><?php echo $persona->FECHA?></td>
        <td><?php echo $persona->IMPORTADO?></td>
        <td><?php echo $persona->PAISDEORIGEN?></td>


        <td class="bot"><a href="borrar.php?CODIGOARTICULO=<?php echo $persona->CODIGOARTICULO?>"><input type='button' name='del' id='del' value='Borrar'></a></td>
        <td class='bot'><a href="editar.php?CODIGOARTICULO=<?php echo $persona->CODIGOARTICULO?> & SECCION=<?php echo $persona->SECCION?> & NOMBREARTICULO=<?php echo $persona->NOMBREARTICULO?>
        & PRECIO=<?php echo $persona->PRECIO?>& FECHA=<?php echo $persona->FECHA?>& IMPORTADO=<?php echo $persona->IMPORTADO?>& PAISDEORIGEN=<?php echo $persona->PAISDEORIGEN?>"><input type='button' name='up' id='up' value='Actualizar'></a></td>
    </tr>

    <?php
    endforeach;
    ?>



    <tr>
    <td><input type='text' name='CODIGOARTICULO' size='10' class='centrado'></td>
    <td><input type='text' name='SECCION' size='10' class='centrado'></td>
    <td><input type='text' name='NOMBREARTICULO' size='10' class='centrado'></td>
    <td><input type='text' name='PRECIO' size='10' class='centrado'></td>
    <td><input type='text' name='FECHA' size='10' class='centrado'></td>
    <td><input type='text' name='IMPORTADO' size='10' class='centrado'></td>
    <td><input type='text' name='PAISDEORIGEN' size='10' class='centrado'></td>
    <td class='bot'><input type='submit' name='cr' value='Insertar'><input type='submit' name='selec' value='Seleccionar'><input type='submit' name='cr' value='Mostrar todo'></td>
    </tr>   
    </table>
</form>

<?php
/*-------------------------PAGINACION-----------------*/
	echo "<br>";
	
	for ($i=1; $i<=$total_paginas; $i++){
/*		echo "<a href='?pagina=" . $i . "'>" . $i . "</a>  ";*/
		echo "<a href='index.php?pagina=" . $i . "'>" . $i . "</a>  ";
	}
	

?>

<p>&nbsp</p>
</body>
</html>
