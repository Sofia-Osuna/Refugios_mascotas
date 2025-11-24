$(document).ready(function(){
    function filtrar() {
        const nombre = $('#filtro_nombre').val().toLowerCase().trim();
        
        let contadorVisibles = 0;
        
        $('.especie-item').each(function(){
            const $tarjeta = $(this);
            const nombreEspecie = $tarjeta.find('.especie-nombre').text().toLowerCase();
            
            // Solo filtramos por nombre (sin especie como en mascotas)
            const coincideNombre = nombre === '' || nombreEspecie.includes(nombre);
            
            $tarjeta.toggle(coincideNombre);
            
            if(coincideNombre) {
                contadorVisibles++;
            }
        });
        
        // Mostrar/ocultar mensaje de no resultados
        if(contadorVisibles === 0) {
            $('#mensaje-sin-resultados').show();
        } else {
            $('#mensaje-sin-resultados').hide();
        }
    }
    
    // Eventos para filtrar
    $('#filtro_nombre').on('input', filtrar);
    
    // Botón limpiar
    $('#btn-limpiar').on('click', function(){
        console.log('Limpiando filtros de especies');
        
        $('#filtro_nombre').val('');
        
        filtrar();
    });
});