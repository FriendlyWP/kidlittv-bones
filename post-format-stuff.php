// RENAME POST FORMATS

function rename_post_formats( $safe_text ) {
    if ( $safe_text == 'Aside' ) {
        return 'Gribble\'s Scribbles';
    } elseif ( $safe_text == 'Video' ) {
        return 'KLTV Exclusives';
    }

    return $safe_text;
}
add_filter( 'esc_html', 'rename_post_formats' );

//rename Aside in posts list table
function live_rename_formats() { 
    global $current_screen;

    if ( $current_screen->id == 'edit-post' ) { ?>
        <script type="text/javascript">
        jQuery('document').ready(function() {

            jQuery("span.post-state-format").each(function() { 
                if ( jQuery(this).text() == "Aside" )
                    jQuery(this).text("Gribble\'s Scribbles");             
                if ( jQuery(this).text() == "Video" )
                    jQuery(this).text("KLTV Exclusives");
            });

        });      
        </script>
<?php }
}
add_action('admin_head', 'live_rename_formats');

// REMOVE 'TYPE' FROM POST-FORMAT SLUGS
//add_action( 'init', 'mysite_change_taxonomy_permalinks', 1 );
function mysite_change_taxonomy_permalinks() {
  // changing the post_format permastruct
   $taxonomy = 'post_format';
    
   // change the settings at will but make sure 'slug' is set to NULL
   $post_format_rewrite = array(
      'slug' => NULL, // we don't want no slug!
      );
      
   // overwrites default post_format permastruct
   add_permastruct( $taxonomy, "%$taxonomy%", $post_format_rewrite );

}

function my_get_post_format_slugs() {

  $slugs = array(
    'aside'   => 'gribbles-scribbles',
    'audio'   => 'audio',
    'chat'    => 'chats',
    'gallery' => 'galleries',
    'image'   => 'images',
    'link'    => 'links',
    'quote'   => 'quotes',
    'status'  => 'status-updates',
    'video'   => 'kltv-exclusives'
  );

  return $slugs;
}

/* Remove core WordPress filter. */
//remove_filter( 'term_link', '_post_format_link', 10 );

/* Add custom filter. */
//add_filter( 'term_link', 'my_post_format_link', 10, 3 );

/**
 * Filters post format links to use a custom slug.
 *
 * @param string $link The permalink to the post format archive.
 * @param object $term The term object.
 * @param string $taxnomy The taxonomy name.
 * @return string
 */
function my_post_format_link( $link, $term, $taxonomy ) {
  global $wp_rewrite;

  if ( 'post_format' != $taxonomy )
    return $link;

  $slugs = my_get_post_format_slugs();

  $slug = str_replace( 'post-format-', '', $term->slug );
  $slug = isset( $slugs[ $slug ] ) ? $slugs[ $slug ] : $slug;

  if ( $wp_rewrite->get_extra_permastruct( $taxonomy ) )
    $link = str_replace( "/{$term->slug}", '/' . $slug, $link );
  else
    $link = add_query_arg( 'post_format', $slug, remove_query_arg( 'post_format', $link ) );

  return $link;
}

/* Remove the core WordPress filter. */
//remove_filter( 'request', '_post_format_request' );

/* Add custom filter. */
//add_filter( 'request', 'my_post_format_request' );

/**
 * Changes the queried post format slug to the slug saved in the database.
 *
 * @param array $qvs The queried variables.
 * @return array
 */
function my_post_format_request( $qvs ) {

  if ( !isset( $qvs['post_format'] ) )
    return $qvs;

  $slugs = array_flip( my_get_post_format_slugs() );

  if ( isset( $slugs[ $qvs['post_format'] ] ) )
    $qvs['post_format'] = 'post-format-' . $slugs[ $qvs['post_format'] ];

  $tax = get_taxonomy( 'post_format' );

  if ( !is_admin() )
    $qvs['post_type'] = $tax->object_type;

  return $qvs;
}