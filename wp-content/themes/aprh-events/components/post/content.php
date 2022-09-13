<?php
/**
 * Template part for displaying posts.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package aprh
 */

?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?> data-aos="fade-up">

	<?php if( is_single() ): ?>

	<div class="row">
		<div class="col-sm-10 col-sm-push-1">

			<header>
				<div class="display-4"><?php the_title(); ?></div>
				<div class="posted">
					<div class="date">
						<span class="ti-calendar"></span>
						<?php echo get_the_date('l'.' '.'j').' de '.get_the_date('F'.', '.'Y'); ?>
					</div><!-- date end -->
					<div class="time">
						<span class="ti-alarm-clock"></span>
						<?php echo get_the_time('G'.':'.'i'); ?>
					</div><!-- time end -->
				</div><!-- posted end -->

				<div class="addthis_inline_share_toolbox_3dez"></div>
			</header>




			<!-- If boletines -->
			<?php if( get_post_type() === 'boletines' ): 
				if( get_field('file') || get_field('file_name') ): ?>
					<div class="boletin">
						<div class="row">
							<div class="col-sm-9">
								<?php if( get_field('file_name') ): ?>
								<div class="filename">
									<i class="ti-file"></i>
									<span><?php the_field('file_name'); ?></span>
								</div><!-- filename end -->
								<?php endif; ?>
							</div><!-- col end -->

							<div class="col-sm-3">
								<?php if( get_field('file') ): ?>
									<a href="<?php echo get_field('file')['url']; ?>" class="btn btn-default btn-block btn-sm" target="_blank">DESCARGAR</a>
								<?php endif; ?>
							</div><!-- col end -->
						</div><!-- row end -->
					</div><!-- boletin end -->
				<?php endif;
			endif; ?>





			<!-- If congresos -->
			<?php if( get_post_type() === 'congresos' ): 
				if( get_field('image') ): ?>
					<div class="post-thumbnail">
						<img src="<?php echo get_field('image')['url']; ?>" alt="">
					</div><!-- post-thumbnail end -->
				<?php endif;
			endif; ?>





			<?php if( '' != get_the_post_thumbnail() ) : ?>
				<div class="post-thumbnail">
					<?php the_post_thumbnail('full',array('class'=>'img-responsive')); ?>
				</div><!-- post-thumbnail end -->
			<?php endif; 
			
			the_content(); 
			?>



			<!-- If congresos -->
			<?php if( get_post_type() === 'congresos' ): 
				if( have_rows('files') ): ?>
					<div class="p-t-lg">
						<div class="h4">Descargá los archivos del congreso</div>
					</div>

					<div class="list-group">
    			<?php while( have_rows('files') ) : the_row(); ?>
						<div class="list-group-item">
							<div class="row">
								<div class="col-sm-9">
									<span><?php the_sub_field('file_name'); ?></span>
								</div><!-- col end -->
								
								<div class="col-sm-3">
									<a href="<?php echo get_sub_field('file')['url']; ?>" class="btn btn-default btn-sm btn-block">DESCARGAR</a>	
								</div><!-- col end -->
							</div><!-- row end -->
						</div><!-- list-group-item end -->
        <?php endwhile; ?>
			    </div><!-- list-group end -->
				<?php endif;

			endif; ?>


		</div><!-- col end -->
	</div><!-- row end -->

	<?php else: ?>

		<div class="row">
			<?php 
			if( '' != get_the_post_thumbnail() ) : 

				$d = get_the_date('d');
				$m = get_the_date('F');
				$y = get_the_date('Y');
				?>

			<div class="col-md-3">
				<a class="post-thumbnail" href="<?php the_permalink(); ?>">
					<?php the_post_thumbnail('medium',array('class'=>'img-responsive')); ?>
				</a><!-- post-thumbnail end -->
			</div><!-- col end -->
			<?php endif; ?>
				

			<div class="<?php echo '' != get_the_post_thumbnail() ? 'col-md-9' : 'col-sm-12'; ?>">
				
				<h3 class="post-title">
					<a href="<?php the_permalink(); ?>">
						<?php the_title(); ?>
					</a>
				</h3>

				<div class="post-date">
					<span class="ti-calendar"></span>
					<?php //echo $d .' de '. $m .', '. $y; ?>
				</div><!-- post-date end -->
				
				<div class="post-content">
					<?php the_excerpt(); ?>					
				</div><!-- post-content end -->

			</div><!-- col end -->
		</div><!-- row end -->
	<?php endif; ?>


</article><!-- #post-## -->

<script type="text/javascript" src="//s7.addthis.com/js/300/addthis_widget.js#pubid=ra-511b90fd67e9a7b9"></script> 








