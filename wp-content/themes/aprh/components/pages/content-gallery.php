<div class="gallery" data-aos="fade-up">
	<div class="row">

	<?php 
	$images = get_sub_field('images');

	foreach($images as $img): ?>
		<div class="col-sm-3 col-sm-push-0 col-ms-6 col-ms-push-0 col-xs-8 col-xs-push-2">
			<a href="<?php echo $img['url']; ?>" class="gallery-item">
				<figure>
					<span class="img">
						<img src="<?php echo $img['sizes']['medium']; ?>" title="<?php echo isset($img['title']); ?>" class="img-responsive">
					</span>
				<?php if($img['title']): ?>
					<figcaption><?php echo $img['title']; ?></figcaption>
				<?php endif; ?>
				</figure>
			</a>
		</div>
	<?php endforeach; ?>

	</div><!-- row end -->
</div><!-- gallery end -->

