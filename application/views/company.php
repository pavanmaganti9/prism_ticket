<?php include 'header.php';?>

<div class="container">
  <div class="row">

    <div class="main">

      <h3>About Company</h3>
      
      <div class="login-or">
        <hr class="hr-or">
      </div>
		<?php  
						echo $this->session->flashdata('message');
						//print_r($company);
					?>
					
					Company Name : <?php echo $company['title'];?><br><br>
					
					Company Logo : <img src="<?php echo base_url();?>assets/companylogo/<?php echo $company['logo']; ?>" width="100"><br><br>
					
					Description : <?php echo $company['desc'];?><br><br>
    
    </div>
    
  </div>
</div>