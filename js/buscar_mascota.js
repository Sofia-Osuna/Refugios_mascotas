$(document).ready(function(){
    function filtrar() {
        const nombre = $('#filtro_nombre').val().toLowerCase().trim();
        const especie = $('#filtro_especie').val().toLowerCase().trim();
        
        if(especie === '0') especie = '';

        let contadorVisibles = 0;
        
        $('.col').each(function(){
            const $tarjeta = $(this);
            const textoTarjeta = $tarjeta.text().toLowerCase();
    
            const coincideNombre = nombre === '' || textoTarjeta.includes(nombre);
            const coincideEspecie = especie === '' || textoTarjeta.includes(especie);
            
            const coincide = coincideNombre && coincideEspecie;
            
            $tarjeta.toggle(coincide);
            
            if(coincide) {
                contadorVisibles++;
            }
        });
        
        if(contadorVisibles === 0) {
            $('#mensaje-sin-resultados').show();
        } else {
            $('#mensaje-sin-resultados').hide();
        }
    }
    
    $('#filtro_nombre, #filtro_especie').on('input change', filtrar);
    
    $('#btn-limpiar').on('click', function(){
        console.log(' Limpiando filtros');
    
        $('#filtro_nombre').val('');
        $('#filtro_especie').val('');
    
        filtrar();
    });
});