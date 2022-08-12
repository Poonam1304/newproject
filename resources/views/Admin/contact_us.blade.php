@extends('Admin.layout.main')
@section('content')
<link rel="stylesheet" href="{{ asset('assets/cs/style2.css') }}">
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.1.3/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.12.1/css/dataTables.bootstrap5.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css" integrity="sha512-SfTiTlX6kk+qitfevl/7LibUOeJWlt9rbyDn92a1DqWOw9vWG2MFoays0sgObmWazO5BQPiFucnnEAjpAB+/Sw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="//code.jquery.com/ui/1.13.1/themes/base/jquery-ui.css">

  <div class="container ">
    <h4>ContactUs list</h4>

<table id="example" class="table table-striped" style="width:100%">




        <thead>
            <tr>
                <th>id</th>
                <th>Name</th>
                <th>mobile_number</th>
                <th>Query</th>

                <th>Action</th>

            </tr>
        </thead>
        <tbody class="data">
            @foreach($data as $key=>$row)
            <tr>

                <td>{{$row->getContactList->id}} </td>
                <td>{{$row->getContactList->name}}</td>
                <td>{{$row->getContactList->mobile_number}}</td>
                <td>{{$row->Query}}</td>

                <td>

                <div class="delete-modal btn  btn-sm" data-id='{{$row->getContactList->id}}'  id="deletecategory1" name='.$row->name.'><i class="fa fa-trash" aria-hidden="true"></i></div></td>

            </tr>

   <!---- delete model -------------->
   <div class="modal fade" id="myModal" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                <h4 class="modal-title"></h4>
            </div>
            <input type="hidden" name="category_id" id="category_id" value="">
            <div class="modal-body">
                <form method="POST" action="{{ url('/delete/service_provider') }}">
                    @csrf
                    <p>Are you Sure you want Delete this service_provider?.</p>
            </div>
            <div class="modal-footer">
                <button type="submit" value class="btn btn-info " id="category_delete1">Confirm</button>
                <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Close</button>
            </div>
            </form>
        </div>
    </div>
</div>


{{-- @endif --}}
            @endforeach
        </tbody>

    </table>
  </div>

<script src="https://code.jquery.com/jquery-3.6.0.js"></script>
<script src="https://code.jquery.com/ui/1.13.1/jquery-ui.js"></script>
<script src="https://cdn.datatables.net/1.12.1/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.12.1/js/dataTables.bootstrap5.min.js"></script>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous">
    </script>
{{-- <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script> --}}

</body>

 <script>
     $(document).on("click", ".delete-modal", function(e) {
    var delete_id = $(this).data('id')
    ;


    $('#category_id').val(delete_id);
    $('#myModal').modal('show');
});


$(document).ready(function () {
    $('#example').DataTable();
});

$(document).on("click", "#category_delete1", function(e) {
     var service_provider_id = $('#category_id').val();
    $.ajax({
        type: 'POST',
        url: '{{ url('/delete/users') }}',
        data: {
            id: service_provider_id
        },
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
         success: function(data) {
            $('#myModal').modal('hide');
            $('.edit_category').append('<div class="alert alert-success message">' + data +
                '</div>');
            $(".message").delay(4000).slideUp(300);
            var oTable = $('.categoryTable').dataTable();
            oTable.fnDraw(false);
        }
    });
});




</script>


@endsection





