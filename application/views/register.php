<html>
<title>Register</title>
<head>
<link href="//maxcdn.bootstrapcdn.com/bootstrap/3.3.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
<script src="//maxcdn.bootstrapcdn.com/bootstrap/3.3.0/js/bootstrap.min.js"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/jquery/2.2.4/jquery.min.js"></script>
<!------ Include the above in your HEAD tag ---------->
<style>
.help-block{
	color:red;
}
</style>
</head>
</body>
<div class="container">
    <div class="row">
        <div class="col-md-6 col-md-offset-3">
            <div class="panel panel-primary">
                <div class="panel-heading">Create a New Account</div>
                <div class="panel-body">
				<?php  
					if(!empty($success_msg)){ 
						echo '<p class="status-msg success">'.$success_msg.'</p>'; 
					}elseif(!empty($error_msg)){ 
						echo '<p class="status-msg error">'.$error_msg.'</p>'; 
					} 
				?>
                    <form role="Form" method="post" action="" accept-charset="UTF-8">
						<div class="form-group">
							<label for="first_name">First Name</label>
							<input type="text" id="first_name" class="form-control" name="first_name" value="<?php echo !empty($user['first_name'])?$user['first_name']:''; ?>">
                <?php echo form_error('first_name','<p class="help-block">','</p>'); ?>
						</div>
                        <div class="form-group">
						<label for="last_name">Last Name</label>
                <input type="text" name="last_name" class="form-control" value="<?php echo !empty($user['last_name'])?$user['last_name']:''; ?>">
                <?php echo form_error('last_name','<p class="help-block">','</p>'); ?>
            </div>
            <div class="form-group">
			<label for="email">Email</label>
                <input type="email" name="email" class="form-control" value="<?php echo !empty($user['email'])?$user['email']:''; ?>" >
                <?php echo form_error('email','<p class="help-block">','</p>'); ?>
            </div>
			<div class="form-group">
			<label for="phone">Phone</label>
                <input type="number" name="phone" class="form-control" value="<?php echo !empty($user['phone'])?$user['phone']:''; ?>" >
                <?php echo form_error('phone','<p class="help-block">','</p>'); ?>
            </div>
            <div class="form-group">
			<label for="password">Password</label>
                <input type="password" class="form-control" name="password" >
                <?php echo form_error('password','<p class="help-block">','</p>'); ?>
            </div>
            <div class="form-group">
			<label for="conf_password">Confirm Password</label>
                <input type="password" class="form-control" name="conf_password">
                <?php echo form_error('conf_password','<p class="help-block">','</p>'); ?>
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
						<div class="form-group text-center">
						<input type="submit" name="signupSubmit" class="btn btn-primary btn-lg" value="Sign up">
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
</body>
</html>