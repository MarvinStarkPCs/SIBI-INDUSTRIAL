$(document).ready(function() {
    const $sedeCheckboxes = $('.sede-checkbox');
    const $ubicacionSelect = $('#openUbicacion');
    const $loadingMessage = $('#loadingMessage');

    // Inicializa Select2 para los select del modal
    $('#openUbicacion, #openProcedencia,#openArticulo').select2({
        width: '100%',
        placeholder: function() {
            return $(this).data('placeholder');
        },
        dropdownParent: $('#openInventoryModal')
    });

    function filtrarUbicaciones() {
        // Muestra el mensaje de carga
        $loadingMessage.show();

        // Retrasa la actualización de ubicaciones por 1 segundo
        setTimeout(() => {
            const $selectedSede = $sedeCheckboxes.filter(':checked');
            const sedeId = $selectedSede.length ? $selectedSede.val() : null;

            // Filtra las ubicaciones según la sede seleccionada
            const ubicacionesFiltradas = sedeId ? ubicaciones.filter(ubicacion => ubicacion.sede_id === sedeId) : [];

            // Limpia y actualiza el select de ubicaciones
            $ubicacionSelect.empty().append('<option value="" selected disabled>Seleccione una ubicación</option>');
            if (ubicacionesFiltradas.length > 0) {
                $.each(ubicacionesFiltradas, function(index, ubicacion) {
                    $ubicacionSelect.append(new Option(ubicacion.nombre, ubicacion.id));
                });
                // Refresca Select2 para actualizar las opciones
                $ubicacionSelect.trigger('change');
            } else {
                // Si no hay ubicaciones filtradas, vacía el select
                $ubicacionSelect.val(null).trigger('change');
            }

            // Oculta el mensaje de carga
            $loadingMessage.hide();
        }, 200); // 1000 ms = 1 segundo
    }

    $sedeCheckboxes.on('change', function() {
        // Desmarcar otros checkboxes cuando uno se selecciona
        if ($(this).is(':checked')) {
            $sedeCheckboxes.not(this).prop('checked', false);
        }
        // Filtrar ubicaciones según los checkboxes seleccionados
        filtrarUbicaciones();
    });

    // Filtra las ubicaciones en la carga inicial en caso de que ya haya alguna sede seleccionada
    filtrarUbicaciones();
});
