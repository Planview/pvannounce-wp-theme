<?php
get_header();
if (have_posts()) :
	while (have_posts()) : the_post();

 if ( have_rows( 'ppannounce_home_login_sections' ) ) : ?>
	<?php while ( have_rows( 'ppannounce_home_login_sections' ) ) : the_row(); ?>
		<!-- Main (Home) section -->
		<section class="section" id="<?php the_sub_field( 'section_id' ); ?>">
			<div class="container">
				<div class="row">
					<div class="col-md-10 col-lg-10 col-md-offset-1 col-lg-offset-1">	
						<h1 class="title text-center"><?php the_sub_field( 'section_title' ); ?></h1>
						<div class="content">
							<?php the_sub_field( 'section_content' ); ?>
						</div>
					</div> <!-- /col -->
				</div> <!-- /row -->
			</div>
		</section>
	<?php endwhile; ?>
<?php endif; ?>

<?php if ( have_rows( 'ppannounce_home_login_modals' ) ) : ?>
	<?php while ( have_rows( 'ppannounce_home_login_modals' ) ) : the_row(); ?>
		<!-- Modal -->
		<div class="modal fade" id="<?php the_sub_field( 'modal_id' ); ?>" tabindex="-1" role="dialog" aria-hidden="true">
		  <div class="modal-dialog">
		    <div class="modal-content">
		      <div class="modal-header">
		        <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
		        <?php if ( get_sub_field( 'modal_title' ) ) : ?><h4 class="modal-title text-center" id="myModalLabel"><?php the_sub_field( 'modal_title' ); ?></h4><?php endif; ?>
		      </div>
		      <div class="modal-body">
		        <?php the_sub_field( 'modal_body' ); ?>
		      </div>
		      <?php if ( get_sub_field( 'modal_footer' ) ) : ?>
			      <div class="modal-footer">
			    	<?php the_sub_field( 'modal_footer' ); ?>
			      </div>
			  <?php endif; ?>
		    </div>
		  </div>
		</div>
	<?php endwhile; ?>
<?php endif; ?>


<?php endwhile; endif; get_footer();