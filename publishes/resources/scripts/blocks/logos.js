import Swiper from "swiper";
import { Autoplay, Navigation } from "swiper/modules";

Swiper.use([Navigation, Autoplay]);
new Swiper('.wp-block-logos .swiper', {
  // Optional parameters
  loop: true,
  slidesPerView: 3,
  height: 500,
  spaceBetween: 30,
  autoplay: {
    delay: 4500,
    disableOnInteraction: false,
  },
  navigation: {
    nextEl: '.swiper-button-next',
    prevEl: '.swiper-button-prev',
  },
  breakpoints: {
    576: {
      slidesPerView: 4,
      spaceBetween: 20,
    },
    768: {
      slidesPerView: 6,
      spaceBetween: 30,
    },
    992: {
      slidesPerView: 7,
      spaceBetween: 40,
    },
    1200: {
      slidesPerView: 8,
      spaceBetween: 40,
    },
  },
});
