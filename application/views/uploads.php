<?php include 'header.php';?>

<div class="container">
  <div class="row">

    <div class="main">

      <h3>Documents</h3>
      
      <div class="login-or">
        <hr class="hr-or">
      </div>
		<?php  
					if($this->session->flashdata('message')){
					?>	
						<div class="alert alert-success" role="alert">
					<?php	echo $this->session->flashdata('message'); ?>
						
						</div>
				<?php	}
				?>
					
				<form role="form" method="post" enctype="multipart/form-data">
					
					<div class="form-group">
    <label for="exampleFormControlFile1">Immigration Document</label>
    <input type="file" class="form-control-file" id="exampleFormControlFile1" name="file1">
	<?php echo form_error('file1','<p class="help-block" style="color:red;">','</p>'); ?>
  </div>
  
  <div class="form-group">
    <label for="exampleFormControlFile1">I4 Document</label>
    <input type="file" class="form-control-file" id="exampleFormControlFile2" name="file2">
  </div>
  
  <div class="form-group">
    <label for="exampleFormControlFile1">WQ Document</label>
    <input type="file" class="form-control-file" id="exampleFormControlFile2" name="file3">
  </div>
                                       
      <div class="form-group">
						<input type="submit" name="uploadSubmit" class="btn btn-primary btn" value="Add Documents">
                        </div>      	
            
					

				</form>
    
    </div>
    
  </div>
</div>