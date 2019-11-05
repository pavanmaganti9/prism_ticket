<?php include 'header.php';?>

        <div id="page-wrapper">
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">Change Password</h1>
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
							<label for="title">First Name</label>
							<input type="text" name="first_name" disabled class="form-control" name="title"  value="<?php echo $_SESSION['first_name']; ?>">
                <?php //echo form_error('first_name','<p class="help-block" style="color:red;">','</p>'); ?>
						</div>
                       <div class="form-group">
						<label for="last_name">Last Name</label>
                <input type="text" name="last_name" disabled class="form-control" value="<?php echo $_SESSION['last_name']; ?>">
                <?php echo form_error('last_name','<p class="help-block" style="color:red;">','</p>'); ?>
            </div>
            <div class="form-group">
			<label for="email">Email</label>
                <input type="email" name="email" disabled class="form-control" value="<?php echo $_SESSION['email'];; ?>" >
                <?php echo form_error('email','<p class="help-block" style="color:red;">','</p>'); ?>
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
			<label for="role">Role</label>
			<input type="text"  class="form-control" disabled name="role" value="<?php echo $_SESSION['type'];?>">
						</div>
						
            
						<div class="form-group">
						<input type="submit" name="profileSubmit" class="btn btn-primary" value="Update Password">
                        </div>

										</form>
										</div></div>
        </div>
        <!-- /#page-wrapper -->

<?php include 'footer.php';?>