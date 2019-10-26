<?php include 'header.php';?>

        <div id="page-wrapper">
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">Projects</h1>
					<div class="pull-right">
		
        <a href="addproject" class="btn btn-default-btn-xs btn-success"><i class="glyphicon glyphicon-plus"></i> Add a project</a>
    </div>
                </div>
				
                <!-- /.col-lg-12 -->
            </div><br>
            <!-- /.row -->
            <div class="row">
                <div class="col-lg-12">
				
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            Projects List
                        </div>
						
                        <!-- /.panel-heading -->
                        <div class="panel-body">
                            <div class="dataTable_wrapper">
                                <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                                    <thead>
                                        <tr>
                                            <th>Title</th>
                                            <th>Description</th>
                                            <th>Created</th>
											<th>Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody>
									<?php if(!empty($user)){ 
									$user_type = $sess['user_type'];
									foreach($user as $post): ?>
                                        <tr class="odd gradeX">
                                            <td><?php echo $post['title']; ?></td>
                                            <td><?php echo $post['desc']; ?></td>
                                            <td class="center"><?php echo $post['created']; ?></td>
											<td align="center">
											<a href="<?php echo site_url('admin/editproject/'.$post['id']); ?>" class="glyphicon glyphicon-edit"></a>&nbsp;&nbsp;
											<?php if($user_type == 'superadmin'){?>
											<a href="<?php echo site_url('admin/deleteproject/'.$post['id']); ?>" class="glyphicon glyphicon-trash" onclick="return confirm('Are you sure to delete?')"></a><?php } ?>
										</td>
                                        </tr>
                                     <?php endforeach; }?>  
                                    </tbody>
                                </table>
                            </div>
                            <!-- /.table-responsive -->
                           
                        </div>
                        <!-- /.panel-body -->
                    </div>
                    <!-- /.panel -->
                </div>
                <!-- /.col-lg-12 -->
            </div>
            <!-- /.row -->
            
        </div>
        <!-- /#page-wrapper -->

    </div>
    <!-- /#wrapper -->

    <!-- jQuery -->
    <script src="<?php echo base_url(); ?>assets/bower_components/jquery/dist/jquery.min.js"></script>

    <!-- Bootstrap Core JavaScript -->
    <script src="<?php echo base_url(); ?>assets/bower_components/bootstrap/dist/js/bootstrap.min.js"></script>

    <!-- Metis Menu Plugin JavaScript -->
    <script src="<?php echo base_url(); ?>assets/bower_components/metisMenu/dist/metisMenu.min.js"></script>

    <!-- DataTables JavaScript -->
    <script src="<?php echo base_url(); ?>assets/bower_components/datatables/media/js/jquery.dataTables.min.js"></script>
    <script src="<?php echo base_url(); ?>assets/bower_components/datatables-plugins/integration/bootstrap/3/dataTables.bootstrap.min.js"></script>

    <!-- Custom Theme JavaScript -->
    <script src="<?php echo base_url(); ?>assets/dist/js/sb-admin-2.js"></script>

    <!-- Page-Level Demo Scripts - Tables - Use for reference -->
    <script>
    $(document).ready(function() {
        $('#dataTables-example').DataTable({
                responsive: true
        });
    });
    </script>

</body>

</html>
