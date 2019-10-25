<link href="//maxcdn.bootstrapcdn.com/bootstrap/3.3.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
<script src="//maxcdn.bootstrapcdn.com/bootstrap/3.3.0/js/bootstrap.min.js"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/jquery/2.2.4/jquery.min.js"></script>
<script src="https://cdn.datatables.net/1.10.20/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.10.20/js/dataTables.bootstrap.min.js"></script>



<div class=col-md-12>
    
    <form id="form-list-client">
            <legend>List of posts</legend>
    
    <div class="pull-right">
		
        <a href="addpost" class="btn btn-default-btn-xs btn-success"><i class="glyphicon glyphicon-plus"></i> Add post</a>
    </div>
   
    </form>

<table id="example" class="table table-striped table-bordered" style="width:100%">
        <thead>
            <tr>
                <th>Title</th>
                <th>Description</th>
                <th>Actions</th>
               
            </tr>
        </thead>
        <tbody>
            <?php if(!empty($posts)){ 
					
					foreach($posts as $post): ?>
                        <tr>
                            <td><?php echo $post['title']; ?></td>
							<td><?php echo $post['desc']; ?></td>
							<td>
                                <a href="<?php echo site_url('editpost/'.$post['id']); ?>" title="edit this post" class="btn btn-default btn-sm "> <i class="glyphicon glyphicon-edit text-primary"></i> </a>
								<a href="<?php echo site_url('deletepost/'.$post['id']); ?>" title="delete this post" class="btn btn-default btn-sm "> <i class="glyphicon glyphicon-trash text-danger"></i> </a>
                            </td>
                        </tr><br>
					<?php endforeach; }?>
		</tbody>
		</table>
    
</div>
<script>
$(document).ready(function() {
    $('#example').DataTable();
} );
</script>