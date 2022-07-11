<table class="table table-bordered">
    <thead>
        <tr>
            <th style="width: 10px">#</th>
            <th>Title</th>
            <!--<th>Url Clean</th>-->
            <th style="width:300px;">Content</th>
            <th>Description</th>

            <th>Created_at</th>
            <th>Image</th>
            <th>Posted</th>
            <th>Actions</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach($posts as $post) : ?>
            <tr>
                <td><?php echo $post->post_id ?></td>
                <td><?php echo word_limiter($post->title, 4) ?></td>
                <!--<td><?php echo  $post->url_clean ?></td>-->
                <td><?php echo word_limiter($post->content, 5) ?></td>
                <td><?php echo $post->description ?></td>

                <td class="text-center"><?php echo format_date($post->created_at) ?></td>
                <td class="text-center">
                    <?php echo 
                        $post->image != "" ? 
                        '<a class="test-popup-link" href="' . base_url('files/post/') . $post->image . '" >
                            <img class="img-post img-thumbnail img-presentation-small" src="' . base_url('files/post/') . $post->image . '">
                        </a>' :
                        ''
                    ?>        
                </td>
                <td class="text-center"><?php echo $post->posted ?></td>
                <td>
                    <a class="btn btn-sm btn-primary" href="<?php echo base_url('admin/post_save/') . $post->post_id ?>">
                        <i class="fas fa-pencil-alt"></i>
                    </a>
                    <a class="btn btn-sm btn-danger" data-toggle="modal" data-target="#modalDelete" data-postid="<?php echo $post->post_id ?>">
                       <i class="fas fa-trash-alt"></i>
                    </a>
                </td>
            </tr>
        <?php endforeach; ?>
    </tbody>
</table>

<!-- Modal -->
<div class="modal fade" id="modalDelete" tabindex="-1" aria-labelledby="modalDeleteLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
        <button type="button" class="btn btn-danger" id="btn-delete-post" data-dismiss="modal">Delete</button>
      </div>
    </div>
  </div>
</div>


<script type="text/javascript">

    let post_id = 0
    let button_delete

    $('#modalDelete').on('show.bs.modal', function (event) {
        button_delete = $(event.relatedTarget) // Button that triggered the modal
        post_id = button_delete.data('postid') // Extract info from data-* attributes
        // If necessary, you could initiate an AJAX request here (and then do the updating in a callback).
        // Update the modal's content. We'll use jQuery here, but you could use a data binding library or other methods instead.
        let modal = $(this)
        modal.find('.modal-title').text('Are you sure want to Delete post ' + post_id + ' ?') 

    })

    $("#btn-delete-post").click(function (){
        $.ajax({
            url: "<?php echo base_url("admin/post_delete/")?>" + post_id
        }).done(function(res){
            if(res){
                $(button_delete).parent().parent().remove()
            }else{

            }
        })
    })


</script>