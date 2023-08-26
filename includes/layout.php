<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Woocommerce Products Data Table</title>
	<script src="https://code.jquery.com/jquery-3.3.1.js"></script>
</head>
<body>

<h1>Hello World!</h1>
<table id="product-data-table" class="display nowrap" style="width:100%">
	<thead>
		<tr>
			<th>#</th>
			<th>Name</th>
			<th>SKU</th>
			<th>Price</th>
			<th>Date</th>
			<th>Stock</th>
		</tr>
	</thead>
	
	<tfoot>
		<tr>
			<th>#</th>
			<th>Name</th>
			<th>SKU</th>
			<th>Price</th>
			<th>Date</th>
			<th>Stock</th>
		</tr>
	</tfoot>
	
	<tbody>
		<?php 
		// WP_Query arguments
		$args = array(
		    'post_type'              => array('product'), // use any for any kind of post type, custom post type slug for custom post type
		    'post_status'            => array('publish'), // Also support: pending, draft, auto-draft, future, private, inherit, trash, any
		    'posts_per_page'         => '5', // use -1 for all post
		    'order'                  => 'DESC', // Also support: ASC
		    'orderby'                => 'date', // Also support: none, rand, id, title, slug, modified, parent, menu_order, 
		);

		// The Query
		$query = new WP_Query($args);

		// The Loop
		if ($query->have_posts()) {
		    while ($query->have_posts()) {
		        $query->the_post();
		        $product = wc_get_product(get_the_ID()); ?>
		        
		        <tr>
		        	<td><?php echo wp_get_attachment_image( $product->get_image_id() , array('50', '50'), "", array( "class" => "img-responsive" ) ); ?></td>
					<td><a target="_blank" title="<?php echo $product->get_name(); ?>" href="<?php echo get_permalink( $product->get_id() ); ?>"><?php echo $product->get_name(); ?></a></td>
					<td><?php echo $product->get_sku(); ?></td>
					<td><?php echo $product->get_price(); ?></td>
					<td><?php echo date('Y/m/d h:i:s a', strtotime($product->get_date_created())); ?></td>
					<td>61</td>
				</tr>	

		    <?php }
		} else {
		    // no posts found
		}

		// Restore original Post Data
		wp_reset_postdata();

		?>
	</tbody>
</table>

</body>
</html>