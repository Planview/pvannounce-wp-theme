<?php

get_header();
if ( have_posts() ) :
	while ( have_posts() ) : the_post();


		 if ( have_rows( 'ppannounce_home_logout_sections' ) ) : ?>
			<?php while ( have_rows( 'ppannounce_home_logout_sections' ) ) : the_row(); ?>
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

		<?php if ( have_rows( 'ppannounce_home_logout_modals' ) ) : ?>
			<?php while ( have_rows( 'ppannounce_home_logout_modals' ) ) : the_row(); ?>
				<!-- Modal -->
				<div class="modal fade" id="<?php the_sub_field( 'modal_id' ); ?>" tabindex="-1" role="dialog" aria-hidden="true" aria-labelledby="<?php the_sub_field( 'modal_id' ); ?>Label">
				  <div class="modal-dialog">
				    <div class="modal-content">
				      <div class="modal-header">
				        <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
				        <?php if ( get_sub_field( 'modal_title' ) ) : ?><h4 class="modal-title text-center" id="<?php the_sub_field( 'modal_id' ); ?>Label"><?php the_sub_field( 'modal_title' ); ?></h4><?php endif; ?>
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

	<div class="modal fade" id="login" tabindex="-1" role="dialog" aria-hidden="true" aria-labelledby="loginLabel">
	  <div class="modal-dialog modal-sm">
	    <div class="modal-content">
	      <div class="modal-header">
	        <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
	        <h4 class="modal-title text-center" id="loginLabel">Login</h4>
	      </div>
	      <div class="modal-body">
	      <?php wp_login_form( array(
		        'echo'           => true,
		        'redirect'       => get_permalink(), 
		        'form_id'        => 'loginform',
		        'label_username' => __( 'Username' ),
		        'label_password' => __( 'Password' ),
		        'label_remember' => __( 'Remember Me' ),
		        'label_log_in'   => __( 'Log In' ),
		        'id_username'    => 'user_login',
		        'id_password'    => 'user_pass',
		        'id_remember'    => 'rememberme',
		        'id_submit'      => 'wp-submit',
		        'remember'       => true,
		        'value_username' => NULL,
		        'value_remember' => false
			) ); ?>
			<p class="text-center"><a href="<?php echo wp_lostpassword_url( get_permalink() ); ?>" class="btn btn-default btn-sm" title="Lost Your Password?">Lost Your Password?</a></p>
	      </div>
	    </div>
	  </div>
	</div>
<?php endwhile; endif; get_footer();