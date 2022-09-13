<?php 
$tabs = get_sub_field('tab');
?>

<section class="tabs" data-aos="fade-up">
<ul class="nav nav-tabs">
	<?php 
	$counter = 0;

	foreach($tabs as $tab): ?>

		<li<?php echo $counter === 0 ? ' class="active"' : ''; ?>>
			<a href="#tab-<?php echo str_replace(' ', '_', $tab['tab']); ?>" data-toggle="tab"><?php echo $tab['tab']; ?></a>
		</li>	

	<?php 
	$counter++;
	endforeach; ?>
</ul>



<div class="tab-content">
	<?php 
	$counter = 0;

	foreach($tabs as $tab): ?>
		<div class="tab-pane fade<?php echo $counter === 0 ? ' active in' : ''; ?>" id="tab-<?php echo str_replace(' ', '_', $tab['tab']); ?>">
			<?php if( $tab['list'] ): ?>
				<div class="list-group">
				<?php foreach($tab['list'] as $list_item): ?>
					<div class="list-group-item">
						<div class="row">

							<div class="col-md-3 col-sm-5">
								<strong><?php echo $list_item['desc']; ?></strong>
							</div><!-- col end -->

							<div class="col-md-9 col-sm-7">
								<?php echo $list_item['cont']; ?>
							</div><!-- col end -->

						</div><!-- row end -->
					</div><!-- list-group-item end -->
				<?php endforeach; ?>
				</div><!-- list-group end -->
			<?php endif; ?>
		</div><!-- tab-pane end -->

		<!-- <pre><?php //var_dump($tab); ?></pre> -->
	
	<?php 
	$counter++;
	endforeach; ?>
</div><!-- tab-content end -->
</section>
