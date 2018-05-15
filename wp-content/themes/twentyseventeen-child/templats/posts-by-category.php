<?php
/*Template part for displaying posts by categories*/
	foreach ( $categories as $categorie ) {
		/*appliquer filter sur le nom de la categorie*/
		$category_name = $categorie->name;
		$title = apply_filters( 'custom_postsbycategory_title' , $category_name );?>

		<h3><?php echo $title ?></h3>

		<?php query_posts( "category_name=$category_name&showposts=4" ); ?>
		
		<ul style='list-style-type:none;line-height: 3;margin-left:40px'>
			<?php 
			if (have_posts()) :
				while (have_posts()) : the_post();
			?>
					<li>
						<a href="<?php the_permalink();?>"><?php the_title(); ?></a>
					</li>	
			<?php
				endwhile;        
			endif;
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