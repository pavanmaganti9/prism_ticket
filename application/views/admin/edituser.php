<?php include 'header.php';?>

        <div id="page-wrapper">
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">Edit User</h1>
					<div class="pull-right">
		
        <a href="../users" class="btn btn-default-btn-xs btn-success"> Back to Users</a>
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
							<label for="title">First Name</label>
							<input type="text" name="first_name" class="form-control" name="title"  value="<?php echo !empty($post['first_name'])?$post['first_name']:''; ?>">
                <?php //echo form_error('first_name','<p class="help-block" style="color:red;">','</p>'); ?>
						</div>
                       <div class="form-group">
						<label for="last_name">Last Name</label>
                <input type="text" name="last_name" class="form-control" value="<?php echo !empty($post['last_name'])?$post['last_name']:''; ?>">
                <?php echo form_error('last_name','<p class="help-block" style="color:red;">','</p>'); ?>
            </div>
            <div class="form-group">
			<label for="email">Email</label>
                <input type="email" name="email" disabled class="form-control" value="<?php echo !empty($post['email'])?$post['email']:''; ?>" >
                <?php echo form_error('email','<p class="help-block" style="color:red;">','</p>'); ?>
            </div>
			<div class="form-group">
			<label for="phone">Phone</label>
                <input type="number" name="phone" class="form-control" value="<?php echo !empty($post['phone'])?$post['phone']:''; ?>" >
                <?php echo form_error('phone','<p class="help-block" style="color:red;">','</p>'); ?>
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
                <label>Gender: </label>
                <?php 
                if(!empty($post['gender']) && $post['gender'] == 'Female'){ 
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
			<div class="form-group">
			<label for="role">Role</label>
			<select name="role" class="form-control">
			 <option>---Select Role---</option>
			 <option value="superadmin" <?php if($post['user_type'] == 'superadmin'){ echo "selected";} ?>>Super Admin</option>
			 <option value="admin" <?php if($post['user_type'] == 'admin'){ echo "selected";} ?>>Admin</option>
			 <option value="user" <?php if($post['user_type'] == 'user'){ echo "selected";} ?>>User</option>
			</select>
						</div>
						<div class="form-group">
			<label for="company">Company</label>
			<select name="company" class="form-control">
 <option>---Select Company---</option>
 <option value="<?php echo $post['company'];?>" selected> <?php echo $post['company'];?></option>
 <?php foreach($user as $post): ?>
<option value="<?php echo $post['title'];?>"> <?php echo $post['title'];?></option>
<?php endforeach;?>
</select>
			</div>
            
						<div class="form-group text-center">
						<input type="submit" name="userSubmit" class="btn btn-primary btn-lg" value="Update User">
                        </div>

										</form>
										</div></div>
        </div>
        <!-- /#page-wrapper -->

<?php include 'footer.php';?>