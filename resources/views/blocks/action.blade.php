<div class="table-actions text-center">
    <a href="{{url($actions['edit'])}}" class="edit">
        <i class="fa fa-edit"></i>
    </a>
    <a href="#" class="delete btn-delete" data-delete-action="{{$actions['delete']}}" id="row_{{$actions['id']}}"
       data-toggle="modal" data-target="#confirmDeleteItem">
        <i class="fa fa-trash" aria-hidden="true"></i>
    </a>
</div>
<script>
    $('.table-actions .btn-delete').click(function (){
        $('#btnConfirmDelete').val($(this).attr('data-delete-action'))
    })
</script>
