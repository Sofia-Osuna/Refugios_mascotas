$(document).ready(function(){
    function filtrar() {
        const nombre = $('#filtro_nombre').val().toLowerCase();
        const estado = $('#filtro_estado').val().toLowerCase();
        const municipio = $('#filtro_municipio').val().toLowerCase();
        
        $('.col').each(function(){
            const textoTarjeta = $(this).text().toLowerCase();
            const coincide = textoTarjeta.includes(nombre) && 
                           (estado === '' || textoTarjeta.includes(estado)) &&
                           (municipio === '' || textoTarjeta.includes(municipio));
            
            $(this).toggle(coincide);
        });
    }
    
    $('#filtro_nombre, #filtro_estado, #filtro_municipio').on('input change', filtrar);
});