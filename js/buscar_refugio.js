$(document).ready(function(){
    function filtrar() {
        const nombre = $('#filtro_nombre').val().toLowerCase().trim();
        const estado = $('#cbx_estado').val().toLowerCase().trim();
        const municipio = $('#cbx_municipio').val().toLowerCase().trim();
        
       //esto es para cambiar el value 0 a '' porque si le dejas el value 0 no funciona
        if(estado === '0') estado = '';
        if(municipio === '0') municipio = '';

        let contadorVisibles = 0;
        
        
        $('.col').each(function(){
            const $tarjeta = $(this);
            const textoTarjeta = $tarjeta.text().toLowerCase();
    
            
            const coincideNombre = nombre === '' || textoTarjeta.includes(nombre);
            const coincideEstado = estado === '' || textoTarjeta.includes(estado);
            const coincideMunicipio = municipio === '' || textoTarjeta.includes(municipio);
            
            const coincide = coincideNombre && coincideEstado && coincideMunicipio;
            
            $tarjeta.toggle(coincide);
            
            if(coincide) {
                contadorVisibles++;
            }
        });
        
        // IMPORTANTE, es para que muestre o no el gif de la rata 
        if(contadorVisibles === 0) {
            $('#mensaje-sin-resultados').show();
        } else {
            $('#mensaje-sin-resultados').hide();
        }
    }
    
    // Ejecutar filtro con un pequeño delay para los selects, ya que si esooo se ejecuta el filto de estado antes de que
    // se carguen los municipios, y pues no funciona xdxdxd, al chile creo que no lo vas a necesitar con especie, porque no hay
    //nada despues de especie, pero si no te funciona a lo mejor es porque se ejecuta muy rapido y pues intentas estoo
    $('#filtro_nombre').on('input', filtrar);
    
    $('#cbx_estado, #cbx_municipio').on('change', function(){
        setTimeout(filtrar, 100); // Esperar 100ms antes de filtrar
    });
    
    //boton para limpiar el filtro y que muestre todo de nuevo
    $('#btn-limpiar').on('click', function(){
        console.log('🧹 Limpiando filtros');
    
        // con esto se limpian todos los campo xdxd
        $('#filtro_nombre').val('');
        $('#cbx_estado').val('');
        $('#cbx_municipio').html('<option value="">Todos los municipios</option>');
    
        // Ejecutar filtro asi mostrando toodo de nuevo, es para que no tenga que estar ctrl-r en la pagina para mostrar todo
        filtrar();
    });

});
