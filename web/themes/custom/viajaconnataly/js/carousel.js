(function (Drupal, once) {
  Drupal.behaviors.bootstrapCarouselFix = {
    attach(context) {

      once('bootstrap-carousel', '.carousel', context).forEach(carousel => {
        const instance = bootstrap.Carousel.getOrCreateInstance(carousel, {
          interval: 5000,
          ride: 'carousel',
          pause: 'hover',
          touch: true
        });

        once('bootstrap-carousel-controls', '[data-slide]', carousel)
          .forEach(btn => {
            btn.addEventListener('click', e => {
              e.preventDefault();
              btn.dataset.slide === 'next'
                ? instance.next()
                : instance.prev();
            });
          });
      });

    }
  };
})(Drupal, once);
