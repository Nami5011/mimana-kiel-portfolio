// fade in images
const images = document.querySelectorAll('img');
const observer = new IntersectionObserver(entries => {
  entries.forEach(entry => {
    if(entry.isIntersecting) {
    const target = entry.target;
    // target.setAttribute('src', target.dataset.src);
    target.classList.add('fade-in');
    target.classList.add('slide-up');
    observer.unobserve(target);
    }
  });
}, {
 threshold: 0.1
});
if (images) {
  images.forEach(image => observer.observe(image));
}

// scroll nav
setTimeout(() => {
  const scroll_nav = document.querySelectorAll('.scroll-nav');
  if (scroll_nav) {
    scroll_nav.forEach(item => item.classList.add('scroll-nav-hide'));
  }
}, 3000);

// blog slider
$(document).ready(function(){
  $('.blog-swiper').slick({
    autoplay: true,
    autoplaySpeed: 4000,
    infinite: true,
    dots: false,
    arrows: false,
    centerMode: true,
    slidesToShow: 3,
    slidesToScroll: 1,
    lazyLoad: 'progressive',
    pauseOnHover: true,
    responsive: [
      {
        breakpoint: 767,
        settings: {
          slidesToShow: 1,
        }
      },
    ]
  });
});
