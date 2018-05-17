<?php
/*Template part for displaying posts by categories*/
	foreach ( $categories as $categorie ) {
		/*appliquer filter sur le nom de la categorie*/
		$category_name = $categorie->name;
		$title = apply_filters( 'custom_postsbycategory_title' , $category_name );?>

		<h3><?php echo $title ?></h3>

		<?php $wp_query = new WP_Query( "category_name=$category_name&showposts=4" ); ?>
		
		<ul class="most-popular">
			<?php 
			if ($wp_query->have_posts()) :
				while ( $wp_query->have_posts() ) : $wp_query->the_post();
			?>
					<li>
						<a href="<?php the_permalink();?>"><?php echo get_the_title(); ?></a>
					</li>	
			<?php
				endwhile;        
			endif;
			wp_reset_postdata();
			?>
		</ul>
<?php } ?>	

<!-- pagination -->
<div class="archive-pagination pagination">
	<?php
		$args = array(
			'current'   => $paged,
			'total'     => $max_num_pages,
			'prev_text' => ( '&laquo;' ),
			'next_text' => ( '&raquo;' ),
		); 
		echo paginate_links($args);
	?>
</div>