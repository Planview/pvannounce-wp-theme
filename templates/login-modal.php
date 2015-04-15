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