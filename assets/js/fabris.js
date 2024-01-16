let testimonials = document.getElementById('testimonials');

if(testimonials){
  testimonials = new Splide( '#testimonials', {
    perPage: 3,
    perMove: 1,
    loop: true,
    padding: '2.5rem',
    pagination: false,
    breakpoints: {
      640: {
        perPage: 2,
      },
      480: {
        perPage: 1,
      },
    },
  } );
  
  testimonials.mount();
}

const tooltipTriggerList = document.querySelectorAll('[data-bs-toggle="tooltip"]')
const tooltipList = [...tooltipTriggerList].map(tooltipTriggerEl => new bootstrap.Tooltip(tooltipTriggerEl))