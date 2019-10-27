<?php include 'header.php';?>

<div class="container">
  <div class="row">

    <div class="main">

      <h3>Profile</h3>
      
      <div class="login-or">
        <hr class="hr-or">
      </div>
		<?php  
						echo $this->session->flashdata('message');
					?>
					<?php $attributes = array("name" => "contactform");
					echo form_open("login",$attributes);
					?>
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
    
  </div>
</div>