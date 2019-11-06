<?php include 'header.php';?>

        <div id="page-wrapper">
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">Add a user</h1>
					<div class="pull-right">
		
        <a href="users" class="btn btn-default-btn-xs btn-success"> Back to users</a>
    </div>
                </div>
                <!-- /.col-lg-12 -->
            </div>
			<div class="row">
                                <div class="col-lg-6">
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
							<label for="first_name">First Name</label>
							<input type="text" id="first_name" class="form-control" name="first_name"  value="<?php echo set_value('first_name'); ?>">
                <?php echo form_error('first_name','<p class="help-block" style="color:red;">','</p>'); ?>
						</div>
                        <div class="form-group">
						<label for="last_name">Last Name</label>
                <input type="text" name="last_name" class="form-control" value="<?php echo set_value('last_name'); ?>">
                <?php echo form_error('last_name','<p class="help-block" style="color:red;">','</p>'); ?>
            </div>
            <div class="form-group">
			<label for="email">Email</label>
                <input type="email" name="email" class="form-control" value="<?php echo set_value('email'); ?>" >
                <?php echo form_error('email','<p class="help-block" style="color:red;">','</p>'); ?>
            </div>
			<div class="form-group">
			<label for="phone">Phone</label>
                <input type="number" name="phone" class="form-control" value="<?php echo set_value('phone'); ?>" >
                <?php echo form_error('phone','<p class="help-block" style="color:red;">','</p>'); ?>
            </div>
            <!--<div class="form-group">
			<label for="password">Password</label>
                <input type="password" class="form-control" name="password" >
                <?php echo form_error('password','<p class="help-block" style="color:red;">','</p>'); ?>
            </div>
            <div class="form-group">
			<label for="conf_password">Confirm Password</label>
                <input type="password" class="form-control" name="conf_password">
                <?php echo form_error('conf_password','<p class="help-block" style="color:red;">','</p>'); ?>
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
						<div class="form-group text-center">
						<input type="submit" name="signupSubmit" class="btn btn-primary btn-lg" value="Add User">
                        </div>

										</form>
										</div></div>
        </div>
        <!-- /#page-wrapper -->

<?php include 'footer.php';?>