document.addEventListener('DOMContentLoaded', function() {
    function aplicarEstilosNuclear() {
        const carousel = document.getElementById('carouselRefuPets');
        if (!carousel) return;
        
        const images = carousel.querySelectorAll('.carousel-item img');
        const inner = carousel.querySelector('.carousel-inner');
        const items = carousel.querySelectorAll('.carousel-item');
        
        const height = window.innerWidth <= 768 ? '300px' : '500px';
        

        [inner, ...items, ...images].forEach(element => {
            if (element) {
                element.style.height = height;
                element.style.minHeight = height;
                element.style.maxHeight = height;
            }
        });
        
        // Estilos específicos para imágenes
        images.forEach(img => {
            img.style.width = '100%';
            img.style.objectFit = 'cover';
            img.style.objectPosition = 'center';
            img.style.display = 'block';
        });
   
    }
    
   
    aplicarEstilosNuclear();
    
 
    window.addEventListener('resize', aplicarEstilosNuclear);
    
    const carouselElement = document.getElementById('carouselRefuPets');
    if (carouselElement) {
        carouselElement.addEventListener('slid.bs.carousel', function() {
            setTimeout(aplicarEstilosNuclear, 100);
        });
    }
    
 
    const carouselInstance = bootstrap.Carousel.getInstance(carouselElement) || 
         new bootstrap.Carousel(carouselElement);

    carouselElement.addEventListener('mouseenter', function() {
        carouselInstance.pause();
    });

    carouselElement.addEventListener('mouseleave', function() {
        carouselInstance.cycle();
    });

    document.addEventListener('keydown', function(e) {
        if (e.key === 'ArrowLeft') carouselInstance.prev();
        if (e.key === 'ArrowRight') carouselInstance.next();
    });
});


function cambiarVelocidadCarrusel(velocidad) {
    const carousel = document.getElementById('carouselRefuPets');
    if (carousel) carousel.setAttribute('data-bs-interval', velocidad);
}

function irASlide(numeroSlide) {
    const carousel = document.getElementById('carouselRefuPets');
    if (carousel) {
        const instance = bootstrap.Carousel.getInstance(carousel);
        instance.to(numeroSlide);
    }
}