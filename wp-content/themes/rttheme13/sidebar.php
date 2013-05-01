	<?php /* ?>
	<div class="box four">
	    <!-- box title-->
	    <h4>Categories</h4>				
	<!-- sub link-->
		<ul class="sub_navigation">
			<?php 
				$args = array(
				  'public'   => true,
				  '_builtin' => false
				  
				); 
				$output = 'names'; // or objects
				$operator = 'and'; // 'and' or 'or'
				$taxonomies = get_taxonomies( $args, $output, $operator ); 
				foreach ($taxonomies as $taxonomy ) {
				  	//print_r('<pre>');
				  	//print_r($taxonomy);
				  	//print_r('</pre>');

				  	$args = array('hide_empty' => 0);
				  	$terms = get_terms($taxonomy, $args);
				  		//print_r('<pre>');
					  	//print_r($terms);
					  	//print_r('</pre>');
					  	foreach($terms as $tax){ ?>
					  		<li>
					  			<a href="<?php echo get_term_link($tax->slug,$taxonomy); ?>">
					  				<?php echo $tax->name; ?>
					  			</a>
					  		</li>
					  	<?php } 


				}
			?>
		</ul>			
	<!-- /sub link-->
	</div>
	<?php */ ?>
	<!--luxury travel categories-->
	<div class="box four" style="margin-bottom:10px !important;">
	    <!-- box title-->
	    <h4>Categories</h4>				
	<!-- sub link-->
		<ul class="sub_navigation" style="margin-bottom:0;">
			<?php $luxury_taxonomies = get_terms('luxury_taxonomy'); ?>
			<li class="heading"><a title="Luxury Travel" href="http://luxuryatsunset.com/New/?page_id=164">Luxury Travel</a>
				<ul class="children" style="margin-bottom:10px;">
			<?php foreach ($luxury_taxonomies as $luxury_taxonomy) {
			?>
					
						<li class="sub-heading">
							<a href="<?php echo get_term_link( $luxury_taxonomy->slug, 'luxury_taxonomy' ); ?>">
							<?php echo $luxury_taxonomy->name; ?>
							</a>
						</li>
				
			<?php 
			}
			?>
				</ul>
			</li>
		</ul>
			
	<!-- /sub link-->
</div>
<!--/luxury travel categories-->
<!--Destination categories-->
<div class="box four" style="margin-bottom:10px !important;">
	    <!-- box title-->
	<!-- sub link-->
		<ul class="sub_navigation" style="margin-bottom:0;">
			<?php $destination_taxonomies = get_terms('destinations_taxonomy'); ?>
			<li class="heading"><a title="Destination" href="http://luxuryatsunset.com/New/?page_id=162">Destination</a>
				<ul class="children" style="margin-bottom:10px;">
			<?php foreach ($destination_taxonomies as $destination_taxonomy) {
			?>
					
						<li class="sub-heading">
							<a href="<?php echo get_term_link( $destination_taxonomy->slug, 'destinations_taxonomy' ); ?>">
							<?php echo $destination_taxonomy->name; ?>
							</a>
						</li>
				
			<?php 
			}
			?>
				</ul>
			</li>
		</ul>
			
	<!-- /sub link-->
</div>
<!--/Desctination categories-->
<!--Personal concierge categories-->
<div class="box four" style="margin-bottom:10px !important;">
	    <!-- box title-->
	<!-- sub link-->
		<ul class="sub_navigation" style="margin-bottom:0;">
			<?php $personal_taxonomies = get_terms('personalconcierge_taxonomy'); ?>
			<li class="heading"><a title="Personal Concierge" href="http://luxuryatsunset.com/New/?page_id=176">Personal Concierge</a>
				<ul class="children" style="margin-bottom:10px;">
			<?php foreach ($personal_taxonomies as $personal_taxonomy) {
			?>
					
						<li class="sub-heading">
							<a href="<?php echo get_term_link( $personal_taxonomy->slug, 'personalconcierge_taxonomy' ); ?>">
							<?php echo $personal_taxonomy->name; ?>
							</a>
						</li>
				
			<?php 
			}
			?>
				</ul>
			</li>
		</ul>
			
	<!-- /sub link-->
</div>
<!--/Personal Concierge categories-->
	<div class="box four">
		<h4>New Category</h4>
			<div class="textwidget">
				<span class="border alignleft">
					<a class="imgeffect plus" rel="prettyPhoto[rt_theme_thumb]" title="My image" href="http://luxuryatsunset.com/New/wp-content/uploads/2013/04/4-150x150.jpg ">
				<span class="imagemask imgeffect plus" style="top: 8px; left: 8px; width: 190px; height: 249px; background-position: center center; opacity: 0;"></span>
					<img class="align" alt="" src="http://luxuryatsunset.com/New/wp-content/uploads/2013/04/4-150x150.jpg">
					</a>
				</span>

Aenean tincidunt pharetra leo. Curabitur euismod sollicitudin elit. Donec faucibus lacus nec sapien.

			</div>
	</div>
<style type="text/css">
	.sub-heading{
		display:none;
	}

</style>
<script type="text/javascript">
	jQuery(function($){
		$('.heading').mouseenter(function(){
			$(this).find('.sub-heading').slideDown('100');
		}).mouseleave(function(){
			$(this).find('.sub-heading').slideUp('100');
		});
	});
</script>