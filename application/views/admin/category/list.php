<table class="table table-bordered">
    <thead>
        <tr>
            <th style="width: 10px">#</th>
            <th>Name</th>
            <th>Actions</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach($categories as $category) : ?>
            <tr>
                <td><?php echo $category->category_id ?></td>
                <td><?php echo $category->name ?></td>
                <td>
                    <a class="btn btn-sm btn-primary" href="<?php echo base_url('admin/category_save/') . $category->category_id ?>">
                        <i class="fas fa-pencil-alt"></i>
                    </a>
                    <a class="btn btn-sm btn-danger" data-toggle="modal" data-target="#modalDelete" data-categoryid="<?php echo $category->category_id ?>">
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
        <button type="button" class="btn btn-danger" id="btn-delete-category" data-dismiss="modal">Delete</button>
      </div>
    </div>
  </div>
</div>


<script type="text/javascript">

    let category_id = 0
    let button_delete

    $('#modalDelete').on('show.bs.modal', function (event) {
        button_delete = $(event.relatedTarget) // Button that triggered the modal
        category_id = button_delete.data('categoryid') // Extract info from data-* attributes
        // If necessary, you could initiate an AJAX request here (and then do the updating in a callback).
        // Update the modal's content. We'll use jQuery here, but you could use a data binding library or other methods instead.
        let modal = $(this)
        modal.find('.modal-title').text('Are you sure want to Delete category ' + category_id + ' ?') 

    })

    $("#btn-delete-category").click(function (){
        $.ajax({
            url: "<?php echo base_url("admin/category_delete/")?>" + category_id
        }).done(function(res){
            if(res){
                $(button_delete).parent().parent().remove()
            }else{

            }
        })
    })


</script>