/*
 *  Provides additional ACF functionality.
 */
jQuery(document).ready(function($){
    palette = ['#f9e0c5', '#dcc6b2', '#f9ebe1', '#344857'];
    if ($('.acf-color_picker').length) {
      $('.acf-color_picker').iris('option', 'palettes', palette);
    }
  });