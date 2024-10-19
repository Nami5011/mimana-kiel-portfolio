// fade in images
const images = document.querySelectorAll('.fade-in-img-container img, .fade-in-block');
const observer = new IntersectionObserver(entries => {
  entries.forEach(entry => {
    if(entry.isIntersecting) {
      const target = entry.target;
      target.classList.add('fade-in');
      observer.unobserve(target);
    }
  });
}, {
  threshold: 0.2
});
if (images) {
  images.forEach(image => observer.observe(image));
}

const pageImages = document.querySelectorAll('main.page figure');
const pageObserver = new IntersectionObserver(entries => {
  entries.forEach(entry => {
    if(entry.isIntersecting) {
      const target = entry.target;
      target.classList.add('fade-in');
      pageObserver.unobserve(target);
    }
  });
}, {
  root: null,
  rootMargin: "0px",
  threshold: 0.1
});
if (pageImages) {
  pageImages.forEach(image => pageObserver.observe(image));
}

// scroll nav
setTimeout(() => {
  const scroll_nav = document.querySelectorAll('.scroll-nav');
  if (scroll_nav) {
    scroll_nav.forEach(item => item.classList.add('scroll-nav-hide'));
  }
}, 3000);
