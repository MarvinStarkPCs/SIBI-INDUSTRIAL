$(document).ready(function () {


    $('#btnAgregarSerial').on('click', function () {
        var serial = $('#inputSerial').val();
        var origenSeleccionado = $('#origen').val();
        var destinoSeleccionado = $('#destino').val();
console.log(origenSeleccionado);
console.log(destinoSeleccionado);
console.log(serial);
        // Validar que todos los campos estén llenos
        if (!serial) {
            Swal.fire({
                title: "Advertencia", text: "Por favor, ingresa un serial.", icon: "warning", button: "Aceptar",
            });
            return; // Detener la ejecución si falta el serial
        }

        if (origenSeleccionado === "") {
            Swal.fire({
                title: "Advertencia",
                text: "Por favor, selecciona una ubicación de origen.",
                icon: "warning",
                button: "Aceptar",
            });
            return; // Detener la ejecución si falta la ubicación de origen
        }



        if (destinoSeleccionado === "") {
            Swal.fire({
                title: "Advertencia",
                text: "Por favor, selecciona una ubicación de destino.",
                icon: "warning",
                button: "Aceptar",
            });
            return; // Detener la ejecución si falta la ubicación de destino
        }
        if (origenSeleccionado === destinoSeleccionado) {
            Swal.fire({
                title: "Advertencia",
                text: "Las ubicaciones de origen y destino no pueden ser iguales.",
                icon: "warning",
                confirmButtonText: "Aceptar",
            });
            return; // Detener la ejecución si origen y destino son iguales
        }
        var exists = false;
        $('#tablaSerial tbody tr').each(function () {
            var currentSerial = $(this).find('td').eq(0).text().trim(); // Obtener el serial de la fila actual
            if (currentSerial === serial) {
                exists = true; // Si el serial ya existe, marcar como existente
            }
        });

        if (exists) {
            Swal.fire({
                title: "Error", text: "Este serial ya ha sido agregado.", icon: "error", button: "Aceptar"
            });
            return; // No agregar el serial si ya existe
        }
        // Si todos los campos están llenos, realizar la solicitud AJAX
        $.ajax({
            url: 'asignar-articulo/buscarPorSerial', // Cambia esta URL según tu configuración de rutas
            type: 'POST', data: {
                serial: serial, ubicacion_id_origen: origenSeleccionado, // Enviar ID de la ubicación de origen
                ubicacion_id_destino: destinoSeleccionado // Enviar ID de la ubicación de destino
            }, dataType: 'json', success: function (response) {
                console.log(response)

                var tableBody = $('#tablaSerial tbody');

                if (response.length > 0) {
                    // Verificar si hay una fila "Lista vacía" y eliminarla si existe
                    if (tableBody.find('tr:contains("Lista vacía")').length) {
                        tableBody.empty(); // Limpiar la tabla
                    }

                    // En lugar de limpiar la tabla, agregamos los resultados uno por uno
                    $.each(response, function (index, item) {
                        tableBody.append(`
                        <tr>
                            <td>${item.serial}</td>
                            <td>${item.nombre_articulo}</td>
                            <td>${item.nombre_marca}</td>
                            <td>${item.modelo_articulo ? item.modelo_articulo : 'NO APLICA'}</td>
                            <td>${item.nombre_estado}</td>
                            <td><button class="btn btn-danger eliminar" data-id="${item.id_inventario}">Eliminar</button></td>
                        </tr>
                    `);
                    });
                    $('#inputSerial').val('');
                } else if (response.error) {
                    // Mostrar alerta de SweetAlert en caso de error
                    Swal.fire({
                        title: "Error", text: response.error, icon: "error", button: "Aceptar",
                    });
                    $('#inputSerial').val('');
                } else {
                    // Si no hay resultados, mostrar un mensaje
                    tableBody.append('<tr><td colspan="6" class="text-center">No se encontraron resultados</td></tr>');
                    $('#inputSerial').val('');
                }
            }, error: function (xhr, status, error) {
                console.error(error);
                // Mostrar alerta de SweetAlert en caso de error en la solicitud
                Swal.fire({
                    title: "Error",
                    text: "Ocurrió un error al realizar la solicitud.",
                    icon: "error",
                    button: "Aceptar",
                });
            }
        });
    });
// Evento para eliminar una fila en la tabla "Por Serial"
    $('#tablaSerial').on('click', '.eliminar', function () {
        var row = $(this).closest('tr'); // Obtener la fila a eliminar

        // Confirmar eliminación visualmente
        Swal.fire({
            title: '¿Estás seguro?',
            text: "Esta acción no se puede deshacer.",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonText: 'Sí, eliminar',
            cancelButtonText: 'Cancelar'
        }).then((result) => {
            if (result.isConfirmed) {
                row.remove(); // Eliminar la fila del DOM

                // Verificar si la tabla está vacía
                if ($('#tablaSerial tbody tr').length === 0) {
                    // Agregar fila "Lista vacía"
                    $('#tablaSerial tbody').append(`
                    <tr>
                        <td colspan="6" class="text-center">Lista vacía</td>
                    </tr>
                `);
                }

                Swal.fire('Eliminado', 'El artículo ha sido eliminado.', 'success');
            }
        });
    });

    // Validación al botón de cambiar ubicación
    $('.btn-primary').on('click', function () {
        var origenSeleccionado = $('#origen').val();
        var destinoSeleccionado = $('#destino').val();

        if (!origenSeleccionado || !destinoSeleccionado) {
            swal({
                title: "Advertencia",
                text: "Por favor, selecciona tanto el origen como el destino.",
                icon: "warning",
                button: "Aceptar",
            });
            return; // Detener la ejecución si falta algún campo
        }

        // Aquí puedes agregar la lógica para cambiar la ubicación si ambos campos están seleccionados
    });


})