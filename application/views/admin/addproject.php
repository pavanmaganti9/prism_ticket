<?php include 'header.php';?>

        <div id="page-wrapper">
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">Add a project</h1>
					<div class="pull-right">
		
        <a href="projects" class="btn btn-default-btn-xs btn-success"> Back to projects</a>
    </div>
                </div>
                <!-- /.col-lg-12 -->
            </div>
			<div class="row">
                                <div class="col-lg-6">
			<?php  
					if(!empty($success_msg)){ 
						echo '<p class="status-msg success">'.$success_msg.'</p>'; 
					}elseif(!empty($error_msg)){ 
						echo '<p class="status-msg error">'.$error_msg.'</p>'; 
					} 
				?>
            <form role="form" method="post">
                                        <div class="form-group">
							<label for="title">Title</label>
							<input type="text" id="title" class="form-control" name="title" value="<?php echo !empty($user['title'])?$user['title']:''; ?>">
                <?php echo form_error('title','<p class="help-block">','</p>'); ?>
						</div>
                        <div class="form-group">
						<label for="desc">Description</label>
						<textarea name="desc" class="form-control"><?php echo !empty($post['desc'])?$post['desc']:''; ?></textarea>
                <?php echo form_error('desc','<p class="help-block">','</p>'); ?>
            </div>
            	
            
						<div class="form-group text-center">
						<input type="submit" name="projectSubmit" class="btn btn-primary btn-lg" value="Add Project">
                        </div>

										</form>
										</div></div>
        </div>
        <!-- /#page-wrapper -->

<?php include 'footer.php';?>