<?php

add_filter('df_child_line','display_staff',15);

function display_staff($line_info){
	// bail if not the right type
	if ( 'crm' != $line_info['post_type'] ){
		return $line_info;
	}

	// bail if it's not for staff
	$terms = get_the_terms( $line_info['id'], $line_info['taxonomy'] );

	// bail if no terms returned
	if ( false == $terms ){
		return $line_info;
	}

	if ( 'staff' != $terms[0]->slug ){
		return $line_info;
	}

	// it's the staff line so we are good to go

	$image = get_field('photo', $line_info['id']);

	if( false == empty($image) ){ 

		// vars
		$url = $image['url'];
		$title = $image['title'];
		$alt = $image['alt'];
		$caption = $image['caption'];

		// thumbnail
		$size = 'thumbnail';
		$thumb = $image['sizes'][ $size ];
		$width = $image['sizes'][ $size . '-width' ];
		$height = $image['sizes'][ $size . '-height' ];

		$photo = '<img src="' . $thumb . '" alt="' . $alt . '" width="' . $width . '" height="' . $height . '" />';


		$line_info['line'] = $line_info['line'] . ' ' . $photo;

	}



	return $line_info;
}


/*

class df_field_image {
	
	public static function show_field($id, $field){

		$image = get_field($field, $id);

		if( !empty($image) ){

			echo '<img src="' . $image['url'] . '" alt="' . $image['alt'] . '" />';

		}
	}

}



class df_field_date_picker {
	
	public static function show_field($id, $field){

		$date = DateTime::createFromFormat('Ymd', get_field($field, $id));
		echo $date->format('d-m-Y');

	}

}



class df_field_file {
	
	public static function show_field($id, $field){

		if( $attachment_id = get_field($field,$id) ){
			
	    	echo '<a href="' . $attachment_id['url'] .'" >Download File ' . $attachment_id['title'] . '</a>'; 
		
		}

	}

}

*/

///////// here for testing

/*

class df_crm_customer extends df_standard{

	public function do_view_type_main(){

		parent::do_view_type_main();

		add_action( 'df_after_content', array($this, 'show_customer'), 10);

		add_filter('df_field_display',array($this,'cust_text_field'),5,2);

	}

	public function cust_text_field($display_info, $field){
		if ('text' == $field['type']){
			$display_info['before_label'] = '<h2>txtcust ';
		} else {
			$display_info['before_label'] = '<h2>othercust ';
		}

		return $display_info;
	}

	public function show_customer(){
		echo '<h2>This is here for customers</h2>';
	}

	

}



class df_contact_note extends df_standard{

	public static function show_child_line( $child, $title ){
		$link = get_permalink( $child );
		echo '<span color="red"><a href="' . $link . '">' . $title . '</a></span><br>' . "\n";
	}

}
*/