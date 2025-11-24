$(document).ready(function(){
    function filtrar() {
        const nombre = $('#filtro_nombre').val().toLowerCase().trim();
        const correo = $('#filtro_correo').val().toLowerCase().trim();
        
        let contadorVisibles = 0;
        
        $('.usuario-item').each(function(){
            const $tarjeta = $(this);
            const nombreUsuario = $tarjeta.find('.usuario-nombre').text().toLowerCase();
            const correoUsuario = $tarjeta.find('.usuario-correo').text().toLowerCase();
            
            // Filtramos por nombre y correo
            const coincideNombre = nombre === '' || nombreUsuario.includes(nombre);
            const coincideCorreo = correo === '' || correoUsuario.includes(correo);
            
            const coincide = coincideNombre && coincideCorreo;
            
            $tarjeta.toggle(coincide);
            
            if(coincide) {
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
    $('#filtro_nombre, #filtro_correo').on('input', filtrar);
    
    // Botón limpiar
    $('#btn-limpiar').on('click', function(){
        console.log('Limpiando filtros de usuarios');
        
        $('#filtro_nombre').val('');
        $('#filtro_correo').val('');
        
        filtrar();
    });
});