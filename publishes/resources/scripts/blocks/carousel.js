import {domReady} from '@roots/sage/client';
import Swiper, { Navigation, Pagination, Autoplay } from 'swiper';

/**
 * editor.main
 */
const main = (err) => {
  if (err) {
    // handle hmr errors
    console.error(err);
  }

  Swiper.use([Navigation, Pagination, Autoplay]);

  new Swiper('.wp-block-carousel .swiper', {
    // Optional parameters
    loop: true,
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
    pagination: {
      el: '.swiper-pagination',
      clickable: true,
    },
  });
};

/**
 * Initialize
 *
 * @see https://webpack.js.org/api/hot-module-replacement
 */
domReady(main);
import.meta.webpackHot?.accept(main);
