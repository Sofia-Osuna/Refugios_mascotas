// Filtro reutilizable para adopciones por estatus
$(document).ready(function(){
    // Verificar si existen los elementos necesarios en la página
    if ($('#filtro_estatus').length > 0) {
        inicializarFiltro();
    }
});

function inicializarFiltro() {
    function filtrarPorEstatus() {
        const estatusSeleccionado = $('#filtro_estatus').val().toLowerCase().trim();
        let contadorVisibles = 0;
        
        $('.fila-adopcion').each(function(){
            const $fila = $(this);
            const estatusFila = $fila.data('estatus');
            
            // Mostrar todas si no hay filtro, o solo las que coincidan
            if(estatusSeleccionado === '' || estatusFila === estatusSeleccionado) {
                $fila.show();
                contadorVisibles++;
            } else {
                $fila.hide();
            }
        });
        
        // Mostrar u ocultar el mensaje de "sin resultados"
        if(contadorVisibles === 0 && estatusSeleccionado !== '') {
            $('#mensaje-sin-resultados-filtro').show();
            // Ocultar la tabla si existe
            $('.table-responsive').hide();
        } else {
            $('#mensaje-sin-resultados-filtro').hide();
            $('.table-responsive').show();
        }
        
        // Actualizar el contador del badge si existe
        const $badgeContador = $('.badge.fs-6');
        if ($badgeContador.length && contadorVisibles > 0) {
            $badgeContador.text(contadorVisibles + ' solicitud' + (contadorVisibles != 1 ? 'es' : ''));
        }
    }
    
    // Ejecutar filtro cuando cambie el select
    $('#filtro_estatus').on('change', filtrarPorEstatus);
    
    // Botón para limpiar el filtro
    $('#btn-limpiar-estatus').on('click', function(){
        $('#filtro_estatus').val('');
        filtrarPorEstatus();
    });
}