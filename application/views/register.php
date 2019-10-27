<?php include 'header.php';?><br><br>
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-3">
            <div class="panel panel-primary">
                <div class="panel-heading"><h4>Create a New Account</h4></div>
                <div class="panel-body">
				<?php  
					if($this->session->flashdata('message')){
					?>	
						<div class="alert alert-success" role="alert">
					<?php	echo $this->session->flashdata('message'); ?>
						
						</div>
				<?php	}
				?>
				
                    <form role="Form" method="post" action="" accept-charset="UTF-8">
						<div class="form-group">
							<label for="first_name">First Name</label>
							<input type="text" id="first_name" class="form-control" name="first_name" value="<?php echo set_value('first_name'); ?>">
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
			<label for="company">Company</label>
			<select name="company" class="form-control">
 <option>---Select Company---</option>
 <?php foreach($user as $post): ?>
<option value="<?php echo $post['title'];?>"> <?php echo $post['title'];?></option>
<?php endforeach;?>
</select>
			</div>
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
						<input type="submit" name="signupSubmit" class="btn btn-primary" value="Sign up">
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
</body>
</html>