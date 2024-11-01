<?php

namespace Controllers;

use MVC\Router;
use Model\Propiedad;
use Model\Vendedor;
use Intervention\Image\ImageManagerStatic as Image;

class PropiedadController
{
	public static function index(Router $router)
	{

		$propiedades = Propiedad::all();
		$vendedores = Vendedor::all();
		$resultado = $_GET['resultado'] ?? null;

		$router->render('propiedades/admin', [
			'propiedades' => $propiedades,
			'vendedores' => $vendedores,
			'resultado' => $resultado
		]);
	}

	public static function crear(Router $router)
	{
		$propiedad = new Propiedad;
		$vendedores = Vendedor::all();
		// Arreglo con mesajes de errores
		$errores = Propiedad::getErrores();

		if ($_SERVER['REQUEST_METHOD'] === 'POST') {

			// Crear una nueva instancia
			$propiedad = new Propiedad($_POST['propiedad']);

			// Subida de Archivos

			// Generar un nombre único
			$nombreImagen = md5(uniqid(rand(), true)) . ".jpg";

			// Setear la imagen
			// Realiza un resize a la imagen con Intervention
			if ($_FILES['propiedad']['tmp_name']['imagen']) {
				$image = Image::make($_FILES['propiedad']['tmp_name']['imagen'])->fit(800, 600);
				$propiedad->setImagen($nombreImagen);
			}

			// Validar
			$errores = $propiedad->validar();

			// Revisar que el array de errores esté vacío
			if (empty($errores)) {

				// Crear la carpeta para subir imagenes
				// Crear carpeta
				if (!is_dir(CARPETA_IMAGENES)) {
					mkdir(CARPETA_IMAGENES);
				}

				// Guarda la imagen en el servidor
				$image->save(CARPETA_IMAGENES . $nombreImagen);

				// Guarda en la base de datos
				$propiedad->guardar();
			}
		}

		$router->render('propiedades/crear', [
			'propiedad' => $propiedad,
			'vendedores' => $vendedores,
			'errores' => $errores
		]);
	}

	public static function actualizar(Router $router)
	{
		$id = validarORedireccionar('/admin');

		// Obtener Datos de la propiedad
		$propiedad = Propiedad::find($id);
		// Consulta para obtener todos los vendedores
		$vendedores = Vendedor::all();
		// Arreglo con mensajes de errores
		$errores = Propiedad::getErrores();

		// Ejecutar el código después de que el ususario envía el formulario
		if ($_SERVER['REQUEST_METHOD'] === 'POST') {

			// Asignar los atributos
			$args = $_POST['propiedad'];


			$propiedad->sincronizar($args);

			// Validación
			$errores = $propiedad->validar();

			// Subida de archivos
			// Generar un nombre único
			$nombreImagen = md5(uniqid(rand(), true)) . ".jpg";

			if ($_FILES['propiedad']['tmp_name']['imagen']) {
				$image = Image::make($_FILES['propiedad']['tmp_name']['imagen'])->fit(800, 600);
				$propiedad->setImagen($nombreImagen);
			}

			// Revisar que el array de errores esté vacío
			if (empty($errores)) {
				// Almacenar la imagen 
				if ($_FILES['propiedad']['tmp_name']['imagen']) {
					$image->save(CARPETA_IMAGENES . $nombreImagen);
				}

				$propiedad->guardar();
			}
		}


		$router->render('propiedades/actualizar', [
			'propiedad' => $propiedad,
			'vendedores' => $vendedores,
			'errores' => $errores
		]);
	}

	public static function eliminar()
	{
		if ($_SERVER['REQUEST_METHOD'] === 'POST') {
			// Validar ID
			$id = $_POST['id'];
			$id = filter_var($id, FILTER_VALIDATE_INT);

			if ($id) {
				$tipo = $_POST['tipo'];
				if (validarTipoContenido($tipo)) {
					$propiedad = Propiedad::find($id);
					$propiedad->eliminar();
				}
			}
		}
	}
}
