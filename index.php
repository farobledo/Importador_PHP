<?php
require_once "recaptchalib.php";

include "database.php";
$datos = $con->query("select * from person");
?>
<!DOCTYPE html>
<html>
<head>
	<title></title>
</head>
<script src='https://www.google.com/recaptcha/api.js?render= 6Ld5esgUAAAAAO8WHsnbkvr_bxe_KA--V-vUEcUo'> 
</script>

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
<link href="./css/styles.css" rel="stylesheet">
<body>

<h4 class="emp">Importador</h4>
<h4 class="em">hola</h4>
<?php
 echo '<img class="img" src="https://rematealdia.com/img/listados-judiciales-logo-1542575763.jpg">';
?> 

<a href="https://rematealdia.com/cb/" class="inicio" role="button" data-bs-toggle="button">INICIO</a>
<h3 class="titulo">Importador de remates judiciales para rematealdia.com</h3>

 <form method="post" id="addproduct" action="import.php" enctype="multipart/form-data" role="form">
  <div>
    <label class="col"> Cargar archivo</label>
      <input type="file" name="name"  id="name" placeholder="Archivo">
	  <br>
	  <input  type="hidden" name="recaptcha_response" id="recaptchaResponse">
      <button type="submit" class="btn">Importar Datos</button>
	  <div class="g-recaptcha" data-sitekey=" 6Ld5esgUAAAAAO8WHsnbkvr_bxe_KA--V-vUEcUo"></div>
    </div>
</form>


<?php if($datos->num_rows>0):?>
	
	<p class="resul">Resultados <?php echo $datos->num_rows; ?></p>
	<table class="table table-bordered border-dark">
	<thead>
		<th>No</th>
		<th>Departamento</th>
		<th>Ciudad</th>
		<th>Nombre</th>
		<th>Dia</th>
		<th>Precio</th>
		<th>Avaluo</th>
		<th>Descripcion</th>
	</thead>
	<?php while($d= $datos->fetch_object()):?>
		<tr>
		<td><?php echo $d->no; ?></td>
		<td><?php echo $d->name; ?></td>
		<td><?php echo $d->lastname; ?></td>
		<td><?php echo $d->email1; ?></td>
		<td><?php echo $d->created_at; ?></td>
		<td><?php echo $d->phone1; ?></td>
		<td><?php echo $d->phone1; ?></td>
		<td><?php echo $d->phone1; ?></td>
		</tr>

	<?php endwhile; ?>
</table>
<?php else:?>
	<h3>No hay Datos</h3>
<?php endif; ?>

</body>
</html>