<?php

/*
 * Form
 */
function jst_person_metabox_form( $post, $metabox ) {
	// Use nonce for verification
	echo $content;
}

/*
 * Saving form
 */
function jst_save_person_metabox( $post_id ){
  if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) 
      return;

  if ( !wp_verify_nonce( $_POST['pp_design_template_file_nonce'], plugin_basename( __FILE__ ) ) )
      return;

  // Check permissions
  if ( 'pp-design-templates' == $_POST['post_type'] ) 
  {
    if ( !current_user_can( 'edit_page', $post_id ) )
        return;
  }
  else
  {
    if ( !current_user_can( 'edit_post', $post_id ) )
        return;
  }
  
  update_post_meta( $post_id, 'template_file', $_REQUEST[ 'template_file' ] );
}