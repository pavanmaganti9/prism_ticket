<?php include 'header.php';?>

<div class="container"><br>
  <div class="row">
	<div class="main col-sm-4">

      <h3>Profile</h3>
      
      <div class="login-or">
        <hr class="hr-or">
      </div>
		<div class="text-center">
		<?php if($user['avatar'] != ''){?>
	  <img class="rounded mx-auto d-block" alt="Avatar" width="100" src="<?php echo base_url();?>assets/avatar/<?php echo $user['avatar']; ?>">
		<?php } else{?>
		<img class="rounded mx-auto d-block" alt="Avatar" width="100" src="<?php echo base_url();?>assets/images/noprofile.png">
		<?php } ?>
	  </div>
      <form role="form" method="post">
			
                                        <div class="form-group">
							<label for="title">First Name</label>
							<input type="text" name="first_name" class="form-control" name="title"  value="<?php echo !empty($user['first_name'])?$user['first_name']:''; ?>">
                <?php //echo form_error('first_name','<p class="help-block" style="color:red;">','</p>'); ?>
						</div>
                       <div class="form-group">
						<label for="last_name">Last Name</label>
                <input type="text" name="last_name" class="form-control" value="<?php echo !empty($user['last_name'])?$user['last_name']:''; ?>">
                <?php echo form_error('last_name','<p class="help-block" style="color:red;">','</p>'); ?>
            </div>
            <div class="form-group">
			<label for="email">Email</label>
                <input type="email" name="email" disabled class="form-control" value="<?php echo !empty($user['email'])?$user['email']:''; ?>" >
                <?php echo form_error('email','<p class="help-block" style="color:red;">','</p>'); ?>
            </div>
			<div class="form-group">
			<label for="phone">Phone</label>
                <input type="number" name="phone" class="form-control" value="<?php echo !empty($user['phone'])?$user['phone']:''; ?>" >
                <?php echo form_error('phone','<p class="help-block" style="color:red;">','</p>'); ?>
            </div>
            <!--<div class="form-group">
			<label for="password">Password</label>
                <input type="password" class="form-control" name="password" >
                <?php //echo form_error('password','<p class="help-block" style="color:red;">','</p>'); ?>
            </div>
            <div class="form-group">
			<label for="conf_password">Confirm Password</label>
                <input type="password" class="form-control" name="conf_password">
                <?php //echo form_error('conf_password','<p class="help-block" style="color:red;">','</p>'); ?>
            </div>-->
            <div class="form-group">
                <label>Gender: </label>
                <?php 
                if(!empty($user['gender']) && $user['gender'] == 'Female'){ 
                    $fcheck = 'checked="checked"'; 
                    $mcheck = ''; 
                }else{ 
                    $mcheck = 'checked="checked"'; 
                    $fcheck = ''; 
                } 
				
                ?>
                <div class="radio">
                    <label>
                        <input type="radio" name="gender" value="Male" <?php echo $mcheck; ?>>
						Male
                    </label>
                    <label>
                        <input type="radio" name="gender" value="Female" <?php echo $fcheck; ?>>
                        Female
                    </label>
                </div>
            </div>
			<div class="form-group">
			<label for="phone">Uploaded Documents : </label><br>
			<?php
			if(!empty($docs)){
			foreach($docs as $doc): ?>
				<a href="<?php echo base_url();?>assets/userdocs/<?php echo $doc['filename']; ?>" target="_blank"><?php echo $doc['filename']; ?></a>
                <!--<img src="<?php echo base_url();?>assets/userdocs/<?php echo $doc['filename']; ?>" width="100">--><br><br>
				<?php endforeach; 
				
			} else{
				echo "No Documents Uploaded!";
			}?>
            </div>
			
			</form>
    
    </div>
    <div class="col-sm-8">
		<h3>Upload Profile picture</h3>
      
					
      <div class="login-or">
        <hr class="hr-or">
      </div>
	  <?php echo $this->session->flashdata('message');	?>
	  <form role="form" method="post" enctype="multipart/form-data">
	  <div class="form-group">
			<label for="avatar">Avatar</label>
                <input type="file" name="avatar" class="form-control">
                <?php echo form_error('avatar','<p class="help-block" style="color:red;">','</p>'); ?>
            </div>
		<div class="form-group">
			<input type="submit" name="avatarSubmit" class="btn btn-primary" value="Upload Avatar">
        </div>
	  </form>
	  
	</div>
	 
  </div>
</div>

<style>
.column {
  float: left;
  width: 50%;
}

/* Clear floats after the columns */
.row:after {
  content: "";
  display: table;
  clear: both;
}
.circularsquare {
  border-top-left-radius: 50% 50%;
  border-top-right-radius: 50% 50%;
  border-bottom-right-radius: 50% 50%;
  border-bottom-left-radius: 50% 50%;
}
</style>