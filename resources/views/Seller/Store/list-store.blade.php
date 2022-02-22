@extends('Seller.layouts.master')
@section('title', 'Seller-Store')
@section('content')
<div class="content-overlay"></div>
<div class="content-wrapper">
   <div class="row">
      <div class="col-12">
         <div class="content-header">Store Table</div>
      </div>
      <div class="text-right">
         <div class="mb-2">
            <a href="{{ route('seller.add_store')}}" class="btn gradient-pomegranate big-shadow">Add Store</a>
         </div>
      </div>
   </div>
   <!-- Zero configuration table -->
   <section id="configuration">
      <div class="row">
         <div class="col-12 gradient-man-of-steel d-block rounded">
            <div class="card">
               <div class="card-header">
                  <h4 class="card-title">Store List</h4>
               </div>
               <div class="card-content">
                  <div class="card-body">
                     <div class="table-responsive-sg">
                        {!! $dataTable->table()!!}
                     </div>
                  </div>
               </div>
            </div>
         </div>
      </div>
   </section>
   <!--/ Zero configuration table -->
</div>
@endsection
@push('js')
<link rel="stylesheet" href="https://cdn.datatables.net/buttons/1.0.3/css/buttons.dataTables.min.css">
    <link rel="stylesheet" type="text/css" href="http://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">
{!! $dataTable->scripts() !!}

<script>
   // Approve
   $(document).on('click', '.approve', function() {
      toastr.error("Please Wait admin will Approve...");
   });
   // Status
   $(document).on('click', '.status', function() {
      swal({
            title: "Are you sure?",
            text: "You Want To Change The Status!",
            icon: "warning",
            buttons: true,
            dangerMode: true,
         })
         .then((willDelete) => {
            if (willDelete) {
               var id = $(this).data('id');
               var number = $(this).attr('id', 'asd');
               $.ajax({
                  url: "{{route('seller.store_status')}}",
                  type: 'get',
                  data: {
                     id: id,
                  },
                  dataType: "json",
                  success: function(data) {
                     $('#storedatatable-table').DataTable().ajax.reload();
                  }
               })
               swal("Your Status Has Ben Change Succesfully", {
                  icon: "success",
               });
            } else {
               swal("Your Status is safe!");
            }
         });
   });
   // Delete
   $(document).on('click', '.delete', function() {
      swal({
            title: "Are you sure?",
            text: "You Want To Delete The Store!",
            icon: "warning",
            buttons: true,
            dangerMode: true,
         })
         .then((willDelete) => {
            if (willDelete) {
               var delet = $(this).data('id');
               var url = '{{route("seller.delete_store", ":queryId")}}';
               url = url.replace(':queryId', delet);
               $.ajax({
                  url: url,
                  type: "POST",
                  data: {
                     id: delet,
                     _token: '{{ csrf_token() }}'
                  },
                  dataType: "json",
                  success: function(data) {
                     $('#storedatatable-table').DataTable().ajax.reload();
                  }
               });
               swal("Your Store has been deleted!", {
                  icon: "success",
               });
            } else {
               swal("Your Store is safe!");
            }
         });
   });

   //select store
   $(document).ready(function() {
      $('.store').on('change', function() {
         $('.category').remove();
         var val = $(this).val();
         $('.brand').prop('checked', false);
         $.ajax({
            headers: {
               'X-CSRF-TOKEN': $('meta[name="csrf-token"]')
                  .attr('content')
            },
            type: 'POST',
            url: "{{ route('seller.slecetCategory') }}",
            data: {
               val: val,
            },
            success: function(query) {
               $.each(query, function(index, value) {
                  $('.brand' + value.id).prop('checked', true);
                  $("#dis-category").append(
                     "<div class='alert alert-secondary category' role='alert' id=" +
                     value.id + ">" +
                     value.en_name +
                     "<small class='text-white ml-2'>commision</small>" +
                     " " + value.commission + '%' + "</div>");
               });
            }
         });
      });
      $(".store").trigger('change');
   });
</script>
@endpush
