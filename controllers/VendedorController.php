<?php

namespace Controllers;

use Model\Vendedor;
use MVC\Router;

class VendedorController
{

	public static function crear(Router $router)
	{
		$vendedor = new Vendedor;
		$errores = Vendedor::getErrores();

		if ($_SERVER['REQUEST_METHOD'] === 'POST') {

			// Crear una nueva Instancia
			$vendedor = new Vendedor($_POST['vendedor']);

			// Validar que no haya campos vacíos
			$errores = $vendedor->validar();

			// No hay errores
			if (empty($errores)) {
				$vendedor->guardar();
			}
		}

		$router->render('/vendedores/crear', [
			'vendedor' => $vendedor,
			'errores' => $errores
		]);
	}

	public static function actualizar(Router $router)
	{
		$id = validarORedireccionar('/admin');

		// Obtener el arreglo del vendedor
		$vendedor = Vendedor::find($id);

		// Arreglo con mesajes de errores
		$errores = Vendedor::getErrores();

		if ($_SERVER['REQUEST_METHOD'] === 'POST') {

			// Asignar los valores
			$args = $_POST['vendedor'];
			
			// Sincronizar Objeto en Memoria con lo que el usurio escribió
			$vendedor->sincronizar($args);
		
			// Validación
			$errores = $vendedor->validar();
		
			if (empty($errores)) {
				$vendedor->guardar();
			}
			
		}

		$router->render('/vendedores/actualizar', [
			'vendedor' => $vendedor,
			'errores' => $errores
		]);
	}

	public static function eliminar() {
		if ($_SERVER['REQUEST_METHOD'] === 'POST') {
			// Validar ID
			$id = $_POST['id'];
			$id = filter_var($id, FILTER_VALIDATE_INT);

			if ($id) {
				$tipo = $_POST['tipo'];
				if (validarTipoContenido($tipo)) {
					$vendedor = Vendedor::find($id);
					$vendedor->eliminar();	
				}
			}
		}
	}
}
