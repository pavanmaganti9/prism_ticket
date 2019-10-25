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