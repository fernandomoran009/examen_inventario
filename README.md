# Examen Interciclo - Desarrollo de Aplicaciones Web

## Tema: Inventario de una tienda

**Usuario:** El encargado de la tienda.  
**Necesidad:** Consultar y actualizar las existencias de productos.  
**Regla de negocio:** La cantidad debe ser un número entero mayor o igual a cero.

## Instrucciones para ejecutar

1. Tener MySQL 8.0 corriendo: `Start-Service MySQL80`
2. Importar el archivo `database/base_datos.sql` en MySQL Workbench o línea de comandos.
3. Copiar `app/config.example.php` como `app/config.php` y ajustar credenciales si es necesario.
4. En la carpeta del proyecto ejecutar: `php -S localhost:8000 -t Public`
5. Abrir en el navegador: `http://localhost:8000`

## Pruebas de aceptación

| # | Prueba | Resultado |
|---|--------|-----------|
| 1 | **Registro y persistencia:** Se registró "Lápices de colores" con cantidad 25. Al actualizar la página aparece una sola vez con sus valores correctos. | ✅ Cumplido |
| 2 | **Regla de negocio:** Cantidad `0` fue aceptada. Cantidad `-1` fue rechazada con mensaje "La cantidad debe ser un número entero mayor o igual a cero". La base de datos no guardó el registro inválido. | ✅ Cumplido |
| 3 | **Búsqueda:** Buscar "Papelería" muestra 2 registros. Buscar "Inexistente" muestra "No se encontraron registros que coincidan con la búsqueda". | ✅ Cumplido |
| 4 | **Edición:** Se cambió el precio del "Cuaderno A4". Los demás campos y los otros productos permanecieron intactos. | ✅ Cumplido |
| 5 | **Eliminación:** Al dar "Cancelar" el registro permanece. Al dar "Eliminar" desaparece solo ese registro y se muestra mensaje de éxito. | ✅ Cumplido |
| 6 | **Interfaz y texto:** Se registró "Cuaderno<A4>& notas". Se visualiza completo sin romper el HTML. En vista de 375px los campos son legibles y se navega con Tab. | ✅ Cumplido |