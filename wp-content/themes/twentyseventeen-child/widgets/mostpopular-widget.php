<?php

class Most_Popular_Widget extends WP_Widget {

    public function __construct(){
        $widget_args = array('description' => 'most popular car widget' );
        parent::__construct( 'most_popular' , 'Most Popular cars' , $widget_args );

    }

    public function widget( $args , $instance ){
    	
    	$brands_name = array( 'Alfa Romeo' , 'Dacia' );
        //titre de widget
	  	echo "<b> Most Popular cars </b>";

	  	//contentu de widget
        foreach ( $brands_name as $brand_name ) {

	  		echo do_shortcode( "[popular-cars name='$brand_name']" );

	  	}

    }

}
