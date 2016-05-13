<?php include 'seguridad.php';?>
<html>
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
	<script src="//code.jquery.com/jquery-1.11.3.min.js"></script>
    <script src="//code.jquery.com/jquery-migrate-1.2.1.min.js"></script>
    <link href="css/style.css" rel="stylesheet" type="text/css">
    <script type="text/javascript">
    	function selection(id){
    		$.getJSON("update_notificado.php",
    		{
    			id_solicitud: id
    		});
    		$("#central").load("ver_solicitudes.php");
    		$("#solicitudes").load("consultar_solicitudes.php");
    	}
    </script>
    <script>
    	
    </script>
</head>
<body>
	<!-- HEADER -->
	<?php include 'snippets/header.html';?>
	<section id="contenedor">
		<!-- MENU -->
		<?php include 'snippets/menu.html';?>
		<div id="central">
			<?php include 'ver_solicitudes.php';?>
		</div>
	</section>
</body>
</html>