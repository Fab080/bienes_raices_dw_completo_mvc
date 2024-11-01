<?php

namespace Controllers;

use Model\Propiedad;
use MVC\Router;
use PHPMailer\PHPMailer\PHPMailer;

class PaginasController
{
	public static function index(Router $router)
	{

		$propiedades = Propiedad::get(3);
		$inicio = true;

		$router->render('paginas/index', [
			'propiedades' => $propiedades,
			'inicio' => $inicio,
		]);
	}

	public static function nosotros(Router $router)
	{
		$router->render('paginas/nosotros');
	}

	public static function propiedades(Router $router)
	{

		$propiedades = Propiedad::all();

		$router->render('paginas/propiedades', [
			'propiedades' => $propiedades,
		]);
	}

	public static function propiedad(Router $router)
	{
		$id = validarORedireccionar('/propiedades');

		$propiedad = Propiedad::find($id);

		if (!$propiedad) {
			header('Location: /');
		}

		$router->render('paginas/propiedad', [
			'propiedad' => $propiedad
		]);
	}

	public static function blog(Router $router)
	{
		$router->render('paginas/blog');
	}

	public static function entrada(Router $router)
	{
		$router->render('paginas/entrada');
	}

	public static function contacto(Router $router)
	{
		$mensaje = null;

		if ($_SERVER['REQUEST_METHOD'] === 'POST') {

			$respuestas = $_POST["contacto"];

			// Crear una instancia de PHPMailer
			$mail = new PHPMailer();

			// Configurar SMTP
			// Looking to send emails in production? Check out our Email API/SMTP product!
			$mail = new PHPMailer();
			$mail->isSMTP();
			$mail->Host = 'sandbox.smtp.mailtrap.io';
			$mail->SMTPAuth = true;
			$mail->Port = 2525;
			$mail->Username = '31e6834f1fa6cc';
			$mail->Password = '42ab28672bbe5d';
			$mail->SMTPSecure = 'tls';

			// Configurar el Contenido del Email
			$mail->setFrom('admin@bienesraices.com');
			$mail->addAddress('admin@bienesraices.com', 'BienesRaices.com');
			$mail->Subject = 'Tienes un Nuevo Mensaje';

			// Habilitar HTML
			$mail->isHTML(true);
			$mail->CharSet = 'UTF-8';

			// Definir el Contenido
			$contenido = '<html>';
			$contenido .= '<p>Tienes un Nuevo Mensaje</p>';
			$contenido .= '<p>Nombre: ' . $respuestas['nombre'] . ' </p>';


			// Enviar de Forma Condicional algunos campos de email o teléfono
			if ($respuestas['contacto'] === 'telefono') {
				$contenido .= '<p>Eligió ser contactado por Teléfono:</p>';
				$contenido .= '<p>Teléfono: ' . $respuestas['telefono'] . ' </p>';
				$contenido .= '<p>Fecha de Contacto: ' . $respuestas['fecha'] . ' </p>';
				$contenido .= '<p>Hora: ' . $respuestas['hora'] . ' </p>';
			} else {
				// Es email, entonces agregamos el campo de email
				$contenido .= '<p>Eligió ser contactado por email:</p>';
				$contenido .= '<p>Email: ' . $respuestas['email'] . ' </p>';
			}


			$contenido .= '<p>Mensaje: ' . $respuestas['mensaje'] . ' </p>';
			$contenido .= '<p>Vende o Compra: ' . $respuestas['tipo'] . ' </p>';
			$contenido .= '<p>Precio o Presupuesto: $' . $respuestas['precio'] . ' </p>';
			$contenido .= '<p>Prefiere ser contactado por: ' . $respuestas['contacto'] . ' </p>';
			$contenido .= '</html>';

			$mail->Body = $contenido;
			$mail->AltBody = 'Esto es Texto Alternativo sin HTML';

			// Enviar el Email
			if ($mail->send()) {
				$mensaje = "Mensaje Enviado Correctamente";
			} else {
				$mensaje = "El mensaje no se pudo enviar...";
			}
		}

		$router->render('paginas/contacto', [
			'mensaje' => $mensaje
		]);
	}
}
