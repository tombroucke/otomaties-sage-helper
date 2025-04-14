import Swiper from 'swiper';
import { Navigation, Pagination, Autoplay } from 'swiper/modules'

Swiper.use([Navigation, Pagination, Autoplay]);

new Swiper('.wp-block-hero-slider .swiper', {
  // Optional parameters
  loop: true,
  height: 500,
  autoplay: {
    delay: 4500,
    disableOnInteraction: false,
  },
  navigation: {
    nextEl: '.swiper-button-next',
    prevEl: '.swiper-button-prev',
  },
  pagination: {
    el: '.swiper-pagination',
    clickable: true,
  },
});
