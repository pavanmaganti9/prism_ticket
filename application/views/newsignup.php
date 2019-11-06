<?php include 'header.php';?>

<div class="container">
  <div class="row">

    <div class="main">

     <br>
		<?php  
					echo "Hello <b>".$user['first_name']." ".$user['last_name']."</b>";
					?>
      
	  
	  <?php if($user['status'] == 1){
		  echo "You have already registered with ".$user['company']." Please <a href='".base_url()."login'>login</a> to View your dashboard!";
	  }else{?>
	  Welcome to Prism. <br>Please fill your details below and signup.<br><br>
	  <?php  
					if($this->session->flashdata('message')){
					?>	
						<div class="alert alert-success" role="alert">
					<?php	echo $this->session->flashdata('message'); ?>
						
						</div>
				<?php	}
				?>
            <form role="form" method="post">
			<div class="form-group">
			<label for="password">Email</label>
                <input type="text" class="form-control" disabled value="<?php echo $user['email']?>" >
            </div>
			<div class="form-group">
			<label for="password">Password</label>
                <input type="password" class="form-control" name="password" >
                <?php echo form_error('password','<p class="help-block" style="color:red;">','</p>'); ?>
            </div>
            <div class="form-group">
			<label for="conf_password">Confirm Password</label>
                <input type="password" class="form-control" name="conf_password">
                <?php echo form_error('conf_password','<p class="help-block" style="color:red;">','</p>'); ?>
            </div>
			<div class="form-group">
						<input type="submit" name="signupSubmit" class="btn btn-primary" value="Sign Up">
                        </div>

										</form>
			
	  <?php } ?>
    
    </div>
    
  </div>
</div>