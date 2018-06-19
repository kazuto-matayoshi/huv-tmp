<?php
function create_mv( $settings = '' ) {
  if ( $settings === '' ) {
    $settings = get_option( MV_Control_prefix.'MV_Control' );
  }

  $options = get_option( MV_Control_prefix.'MV_Control_Options' );

  echo '<div class="MVslide swiper-container">';
    echo '<ul class="MVslide__inner swiper-wrapper">';
      if ( is_array( $settings ) ) {
        foreach ( $settings as $index => $array ) {
          if ( !is_array( $array ) ) {
            continue;
          }

          $link     = isset( $array['link'] ) ? $array['link'] : '';
          $blank    = isset( $array['blank'] ) ? ' target="_blank"' : '';

          echo '<li class="MVslide__item swiper-slide" id="MVslide__item--' . $index . '">';
            if ( $link !== '' ) {
              echo '<a href="'.$link.'"'.$blank.'>';
            }

            foreach ( $array['img'] as $key => $value ) {
              echo '<span class="MVslide__view MVslide__view--' . $key . '" style="background-image: url(' . $value . ');"></span>';
            }
            if ( $link !== '' ) {
              echo '</a>';
            }
          echo '</li>';
        }
      }
    echo '</ul>';

    if ( isset( $options['navigation--navigation'] ) && $options['navigation--navigation'] === 'true' ) {
      echo '<div class="MVslide__next swiper-button-next"></div>';
      echo '<div class="MVslide__prev swiper-button-prev"></div>';
    }

    if ( isset( $options['pagination--pagination'] ) && $options['pagination--pagination'] === 'true' ) {
      echo '<div class="MVslide__pagination swiper-pagination"></div>';
    }

    if ( isset( $options['scrollbar--scrollbar'] ) && $options['scrollbar--scrollbar'] === 'true' ) {
      echo '<div class="MVslide__scrollbar swiper-scrollbar"></div>';
    }
  echo '</div>';

  echo '<script>';
  echo 'var swiperOptions = '.get_option( MV_Control_prefix.'MV_Control_swiperOption' );
  echo '</script>';
  create_mv_styles();
  create_mv_scripts();
}

function create_mv_styles() {
  wp_enqueue_style( 'create_mv_styles_min', 'https://idangero.us/swiper/dist/css/swiper.min.css' );
  wp_enqueue_style( 'create_mv_styles_default', plugins_url().'/mv_control/assets/css/swiper.default.css' );
}
function create_mv_scripts() {
  wp_enqueue_script( 'create_mv_scripts_min', 'https://idangero.us/swiper/dist/js/swiper.min.js' );
  wp_enqueue_script( 'create_mv_scripts_default', plugins_url().'/mv_control/assets/js/swiper.default.js' );
}

// add_action( 'admin_enqueue_scripts', 'create_mv_styles' );
// add_action( 'admin_enqueue_scripts', 'create_mv_scripts' );
