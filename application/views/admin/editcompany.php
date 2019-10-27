<?php include 'header.php';?>

        <div id="page-wrapper">
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">Edit Comnpany</h1>
					<div class="pull-right">
		
        <a href="../company" class="btn btn-default-btn-xs btn-success"> Back to Companies</a>
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
							<label for="title">Company Name</label>
							<input type="text" id="title" class="form-control" name="title"  value="<?php echo !empty($post['title'])?$post['title']:''; ?>">
                <?php echo form_error('title','<p class="help-block" style="color:red;">','</p>'); ?>
						</div>
						 <div class="form-group">
							<label for="title">Company Logo</label>
							 <img src="<?php echo base_url();?>assets/companylogo/<?php echo $post['logo']; ?>" width="100">
                <?php echo form_error('title','<p class="help-block" style="color:red;">','</p>'); ?>
						</div>
                        <div class="form-group">
						<label for="desc">Company Description</label>
						<textarea name="desc" class="form-control"><?php echo !empty($post['desc'])?$post['desc']:''; ?></textarea>
                <?php echo form_error('desc','<p class="help-block" style="color:red;">','</p>'); ?>
            </div>
            	
            
						<div class="form-group text-center">
						<input type="submit" name="projectSubmit" class="btn btn-primary" value="Update Company">
                        </div>

										</form>
										</div></div>
        </div>
        <!-- /#page-wrapper -->

<?php include 'footer.php';?>