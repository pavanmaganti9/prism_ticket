<?php include 'header.php';?>

<div class="container">
  <div class="row">

    <div class="main">

      <h3>Log In</h3>
      
      <div class="login-or">
        <hr class="hr-or">
      </div>
		<?php  
						echo $this->session->flashdata('message');
					?>
					<?php $attributes = array("name" => "contactform");
					echo form_open("login",$attributes);
					?>
      <!--<form role="form" method="post">-->
	  
	  <input type="hidden" name="prismtoken" value="<?php echo $token;?>">
        <div class="form-group">
          <label for="inputUsernameEmail">Email</label>
          <input type="text" name="email" class="form-control" id="inputUsernameEmail">
		  <?php echo form_error('email','<p class="help-block" style="color:red;">','</p>'); ?>
        </div>
        <div class="form-group">
          <label for="inputPassword">Password</label>
          <input type="password" name="password" class="form-control" id="inputPassword">
		  <?php echo form_error('password','<p class="help-block" style="color:red;">','</p>'); ?>
        </div>
        <div class="checkbox pull-right">
          <label>
            <input type="checkbox">
            Remember me </label>
        </div>
		<input type="submit" class="btn btn btn-primary" name="loginSubmit" value="Login">
      <?php echo form_close();?>
    
    </div>
    
  </div>
</div>

<script type="text/javascript">
    $(document).ready(function () {

        $("#email-error").css({'display': 'none', 'color': 'red'});
        $("#inputUsernameEmail").keyup(function () {
            var emailValue = $("#inputUsernameEmail"); // This is a bit naughty BUT you should always define the DOM element as a var so it only looks it up once
            var tokenValue = $("input[name='csrf_token_name']");
//            console.log('The Email length is ' + emailValue.val().length);
            if (emailValue.val().length >= 0 || emailValue.val() !== '') {
//                console.log('Token is ' + tokenValue.val()); // Now why is this not getting the coorect value?? It should
                $.ajax({
                    type: "post",
                    url: "<?php echo base_url('login'); ?>",
                    data: {
                        '<?php echo $this->security->get_csrf_token_name(); ?>': tokenValue.val(),
                        email: $("#inputUsernameEmail").val()
                    },
                    dataType: "json",
                    cache: false,
                    success: function (data) {
//                        console.log('The returned DATA is ' + JSON.stringify(data));
//                        console.log('The returned token is ' + data.token);
                        tokenValue.val(data.token);
                        if (data.response == false) {
                            $("#email-error").css({'display': 'none'});
                            $(".form-error").css({'border': '', 'background-color': '', 'color': ''});
                            document.getElementById("loginSubmit").disabled = false;
                        } else {
                            $("#email-error").css({'display': 'inline', 'font-size': '12px'});
                            $(".form-error").css({'border': '1px solid red', 'background-color': 'rgba(255, 0, 0, 0.17)', 'color': 'black'});
                            document.getElementById("loginSubmit").disabled = true;
                        }
                    }
                });
            }
        });
    });
</script>