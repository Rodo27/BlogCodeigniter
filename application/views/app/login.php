<div class="card-body login-card-body">
  <p class="login-box-msg">Sign in to start your session</p>

    <?php echo form_open('app/ajax_login', ['class' => 'std-form'] );?>
    <div class="input-group mb-3">
      <input name="login_string" class="form-control" placeholder="User" type="text">
      <div class="input-group-append">
        <div class="input-group-text">
          <span class="fas fa-envelope"></span>
        </div>
      </div>
    </div>
    <div class="input-group mb-3">
      <input name="login_pass" class="form-control" placeholder="Password" type="password">
      <div class="input-group-append">
        <div class="input-group-text">
          <span class="fas fa-lock"></span>
        </div>
      </div>
    </div>
    <div class="row">
      <!--
      <div class="col-8">
        <div class="icheck-primary">
          <input type="checkbox" id="remember">
          <label for="remember">
            Remember Me
          </label>
        </div>
      </div>
      -->
      <!-- /.col -->
      <div class="col-12 text-right">
        <input type="hidden" id="max_allowed_attempts" value="<?php echo config_item('max_allowed_attempts'); ?>" />
        <input type="hidden" id="mins_on_hold" value="<?php echo ( config_item('seconds_on_hold') / 60 ); ?>" />
        <button type="submit" class="btn btn-primary ">Sign In</button>
      </div>
      <!-- /.col -->
    </div>
  </form>

  <!--
  <div class="social-auth-links text-center mb-3">
    <p>- OR -</p>
    <a href="#" class="btn btn-block btn-primary">
      <i class="fab fa-facebook mr-2"></i> Sign in using Facebook
    </a>
    <a href="#" class="btn btn-block btn-danger">
      <i class="fab fa-google-plus mr-2"></i> Sign in using Google+
    </a>
  </div>
  -->
  <!-- /.social-auth-links -->

  <p class="mb-1">
    <a href="forgot-password.html">I forgot my password</a>
  </p>
  <p class="mb-0">
    <a href="register.html" class="text-center">Register a new membership</a>
  </p>
</div>

<script type="text/javascript">
  $(document).ready(function(){
        $(document).on( 'submit', 'form', function(e){
          $.ajax({
            type: 'post',
            cache: false,
            url: "<?php echo base_url("app/ajax_login") ?>",
            data: {
              'login_string': $('[name = "login_string"]').val(),
              'login_pass': $('[name = "login_pass"]').val(),
              'loginToken': $('[name = "token"]').val(),
            },
            dataType: 'json',
            success: function(response){
              //$('[name=\"" . config_item('login_token_name') . "\"]').val( response.token )
              $('[name="loginToken"]').val(response.token)
              console.log(response)
              if(response.status == 1){
                //$('form').replaceWith('<p>You are now logged in.</p>')
                //$('#login-link').attr('href','" . site_url('examples/logout', $link_protocol ) . "').text('Logout')
                //$('#ajax-login-link').parent().hide()
                window.location.href = "<?php echo base_url("admin") ?>"
              }else if(response.status == 0 && response.on_hold){
                $('form').hide()
                $('#on-hold-message').show()
                alert('You have exceeded the maximum number of login attempts.')
              }else{
                alert("Intente nuevamente, accesos incorrectos.");
                //alert('Failed login attempt ' + response.count + ' of ' + $('#max_allowed_attempts').val())
              }
            }
          })
          return false
        })
      })
</script>