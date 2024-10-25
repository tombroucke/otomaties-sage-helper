import {domReady} from '@roots/sage/client';
import Swiper from 'swiper';
import { Navigation, Autoplay } from 'swiper/modules'

/**
 * editor.main
 */
const main = (err) => {
  if (err) {
    // handle hmr errors
    console.error(err);
  }

  Swiper.use([Navigation, Autoplay]);

  const carousels = document.querySelectorAll('.wp-block-carousel > .swiper');
  for (let i = 0; i < carousels.length; i++) {
    const carousel = carousels[i];
    const uid = carousel.dataset.uid;
    const loop = carousel.dataset.loop;
    const centeredSlides = carousel.dataset.centeredSlides;
    const settings = JSON.parse(carousel.dataset.settings);
    const breakpoints = JSON.parse(carousel.dataset.breakpoints);
    const prevButton = document.getElementById(`swiper-button-prev-${uid}`);
    const nextButton = document.getElementById(`swiper-button-next-${uid}`);
    const defaultSettings = {
      slidesPerView: 1,
      spaceBetween: 0,
      loop: loop == 1 ? true : false,
      centeredSlides: centeredSlides == 1 ? true : false,
      observer: true,
      observeParents: true,
      navigation: {
        nextEl: nextButton,
        prevEl: prevButton,
      },
      on: {
        init: function(swiper) {
          const currentSlidesPerView = String(swiper.params.slidesPerView);
          if (currentSlidesPerView.includes(',') || currentSlidesPerView.includes('.')) {
            swiper.el.parentNode.classList.add('wp-block-carousel--half-slides');
          }

          toggleButtonVisibility(
            nextButton,
            swiper.slides.length > swiper.params.slidesPerView
          );
          toggleButtonVisibility(
            prevButton,
            swiper.slides.length > swiper.params.slidesPerView
          );
          toggleSwiperEndClass(swiper);
        },
        resize: function(swiper) {
          const currentSlidesPerView = swiper.params.slidesPerView;
          if (currentSlidesPerView.includes(',') || currentSlidesPerView.includes('.')) {
            swiper.el.parentNode.classList.add('wp-block-carousel--half-slides');
          } else {
            swiper.el.parentNode.classList.remove('wp-block-carousel--half-slides');
          }

          if (swiper.slides.length <= currentSlidesPerView) {
            swiper.el.parentNode.classList.add('wp-block-carousel--all-items-visible');
          } else {
            swiper.el.parentNode.classList.remove('wp-block-carousel--all-items-visible');
          }

          toggleButtonVisibility(
            nextButton,
            swiper.slides.length > swiper.params.slidesPerView
          );
          toggleButtonVisibility(
            prevButton,
            swiper.slides.length > swiper.params.slidesPerView
          );
          toggleSwiperEndClass(swiper);
        },
        slideChangeTransitionEnd: function(swiper) {
          toggleSwiperEndClass(swiper);
        },
      },
    };

    new Swiper(carousel,
      {
        ...defaultSettings,
        ...settings,
        breakpoints: breakpoints,
      }
    );
  }

  function toggleSwiperEndClass(swiper) {
    if (!swiper.isEnd && swiper.el.parentNode.classList.contains('wp-block-carousel--end')) {
      swiper.el.parentNode.classList.remove('wp-block-carousel--end');
    } else if (!swiper.el.parentNode.classList.contains('wp-block-carousel--end') && swiper.isEnd) {
      swiper.el.parentNode.classList.add('wp-block-carousel--end');
    }
  }

  function toggleButtonVisibility(button, show) {
    if (button) {
      button.style.display = show ? 'block' : 'none';
    }
  }
};

/**
 * Initialize
 *
 * @see https://webpack.js.org/api/hot-module-replacement
 */
domReady(main);
import.meta.webpackHot?.accept(main);
