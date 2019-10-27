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
					
					Company Name : <?php echo $company[0]['title'];?><br><br>
					
					Company Logo : <img src="<?php echo base_url();?>assets/companylogo/<?php echo $company[0]['logo']; ?>" width="100"><br><br>
					
					Description : <?php echo $company[0]['desc'];?><br><br>
    
    </div>
    
  </div>
</div>