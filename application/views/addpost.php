<link href="//maxcdn.bootstrapcdn.com/bootstrap/3.3.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
<script src="//maxcdn.bootstrapcdn.com/bootstrap/3.3.0/js/bootstrap.min.js"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/jquery/2.2.4/jquery.min.js"></script>

<?php  
					if(!empty($success_msg)){ 
						echo '<p class="status-msg success">'.$success_msg.'</p>'; 
					}elseif(!empty($error_msg)){ 
						echo '<p class="status-msg error">'.$error_msg.'</p>'; 
					} 
				?>
                    <form role="Form" method="post" action="" accept-charset="UTF-8">
						<div class="form-group">
							<label for="title">Title</label>
							<input type="text" id="title" class="form-control" name="title" value="<?php echo !empty($user['title'])?$user['title']:''; ?>">
                <?php echo form_error('title','<p class="help-block">','</p>'); ?>
						</div>
                        <div class="form-group">
						<label for="desc">Description</label>
						<textarea name="desc" rows="8" class="form-control" value="<?php echo !empty($user['desc'])?$user['desc']:''; ?>"></textarea>
               <?php echo form_error('desc','<p class="help-block">','</p>'); ?>
            </div>
            <div class="form-group text-center">
						<input type="submit" name="postSubmit" class="btn btn-primary btn-lg" value="Sign up">
                        </div>
                    </form>