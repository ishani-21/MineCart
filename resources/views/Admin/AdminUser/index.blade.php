@extends('Admin.layouts.master')
@section('title', 'Admin User Listing')
@push('css')
<link href="https://cdn.datatables.net/1.10.19/css/dataTables.bootstrap4.min.css" rel="stylesheet">
@endpush
@section('content')
<div class="content-overlay"></div>
<div class="content-wrapper">
    <div class="col-12">
        <a href="{{route('admin.role.index')}}">
            <div class="content-header">Admin User Listing</div>
            <p class="content-sub-header mb-1">Admin User list also here.</p>
        </a>
    </div>
    <hr class="mt-1 mt-sm-2"></br>
    <button class="btn btn-primary mr-1 mb-1" data-toggle="modal" data-target="#add_adminuser_modal" data-id="'.$data->id.'"><i class="ft-plus mr-2"></i>Add Admin User</button>
    <div class="row">
        <div class="col-12">
            <div class="card m-b-30">
                <div class="card-header">
                    <div class="card-header-actions">
                    </div>
                </div>
                <div class="card-body">
                    <div class="ajax-msg"></div>
                    <div class="table-responsive">
                        {!! $dataTable->table(['class' => 'table table-striped zero-configuration dataTable']) !!}
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
</section>

@endsection
@section('modal')
@include('Admin.AdminUser.create')
@endsection
@push('scripts')
{!! $dataTable->scripts() !!}
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.2/jquery.validate.min.js"></script>
<script>
    $(document).on('click', '.btn-save', function() {
        $('#add_adminuser_form').trigger('reset');
        $('#question-error').html('');
        $('.form-control').removeClass('is-invalid');
    })

    // $(document).on('click', '.btn-save', function() {
    //     $('#add_adminuser_form').trigger('reset');
    //     $('#question-error').html('');
    //     $('.form-control').removeClass('is-invalid');
    // })

    $('#add_adminuser_modal').on('show.bs.modal', function(e) {
        var button = $(e.relatedTarget)
        var category_id = button.data('id');
        $('.error-msg-input').text('');
        $('.invalid-feedback').text('');
        $('.form-control').removeClass('is-invalid');
        $('#add_adminuser_form').trigger('reset');
        $('#category_id').val(category_id);
    });

    function addCategory(form) {
        $.ajax({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
            },
            url: "{{ route('admin.adminUser.store') }}",
            type: 'post',
            processData: false,
            contentType: false,
            data: new FormData(form),
            success: function(result) {
                if (result) {
                    $html = '<div class="alert alert-block alert-' + result.status + '"><button type="button" class="close" data-dismiss="alert">×</button><strong>' + result.message + '</strong></div>';

                    $('.ajax-msg').append($html);
                }
                $('#add_adminuser_modal').modal('hide');

                window.LaravelDataTables["admin-table"].draw();
            },
            complete: function() {
                window.setTimeout(function() {
                    $(".alert").fadeTo(500, 0).slideUp(500, function() {
                        $(this).remove();
                    });
                }, 3000);
            },
            error: function(data) {
                if (data.status === 422) {
                    var errors = $.parseJSON(data.responseText);
                    $.each(errors.errors, function(key, value) {
                        $('#add_adminuser_form').find('input[name=' + key + ']').parents('.form-group')
                            .find('.error-msg-input').html(value);
                    });
                }
            }
        });
    }
    
    $("#add_adminuser_form").validate({
        errorClass: 'invalid-feedback animated fadeInDown',
        errorElement: 'div',
        rules: {
            name: {
                required: true,
            },
            email: {
                required: true,
                email: true,
            },
            password: {
                required: true,
            },
            role: {
                required: true,
            },

        },
        messages: {
            name: {
                required: "The name field is required.",
            },
            email: {
                required: "The email field is required.",
            },
            password: {
                required: "This password field is required.",
            },
            role: {
                required: "The role field is required.",
            },
        },
        submitHandler: function(form) {
            addCategory(form);
        },
        highlight: function(element, errorClass, validClass) {
            $(element).addClass('is-invalid');
            $(element).parents("div.form-control").addClass(errorClass).removeClass(validClass);
        },
        unhighlight: function(element, errorClass, validClass) {
            $(element).removeClass('is-invalid');
            $(element).parents(".error").removeClass(errorClass).addClass(validClass);
        }
    });
    $('#edit_adminuser_modal').on('show.bs.modal', function(e) {
        var button = $(e.relatedTarget)
        var category_id = button.data('id');
        $(this).find("input").val('');
        $('.error-msg-input').text('');
        $('.invalid-feedback').text('');
        $('.form-control').removeClass('is-invalid');
        $('#category_id').val(category_id);

        $.ajax({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
            },
            url: '{{route("admin.adminUser.edit")}}',
            type: 'GET',
            data: {
                id: category_id
            },
            success: function(result) {
                console.log(result);
                if (result) {

                    $("#edit_adminuser_modal").find('#id').val(result.admin.id);
                    $("#edit_adminuser_modal").find('#name').val(result.admin.name);
                    $("#edit_adminuser_modal").find('#email').val(result.admin.email);

                    var role = '<option value="">Select One</option>';
                    $.each(result.roles, function(key, value) {
                        if(result.adminRole == null)
                        {
                            role += '<option value="'+value.id+'">'+value.name+'</option>';
                        }
                        else{
                            if(value.id == result.adminRole.pivot.role_id)
                            {
                                role += '<option value="'+value.id+'" selected>'+value.name+'</option>';
                            }
                            else{
    
                                role += '<option value="'+value.id+'">'+value.name+'</option>';
                            }
                        }
                    });
                    $('#role').html(role);
                }
            }
        });
    });

    function editCategory(form) {
        $.ajax({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
            },
            url: '{{ route("admin.adminUser.update") }}',
            type: 'POST',
            processData: false,
            contentType: false,
            data: new FormData(form),
            success: function(result) {
                if (result) {
                    $html = '<div class="alert alert-block alert-' + result.status + '"><button type="button" class="close" data-dismiss="alert">×</button><strong>' + result.message + '</strong></div>';

                    $('.ajax-msg').append($html);
                }
                $('#edit_adminuser_modal').modal('hide');

                window.LaravelDataTables["admin-table"].draw();
            },
            complete: function() {
                window.setTimeout(function() {
                    $(".alert").fadeTo(500, 0).slideUp(500, function() {
                        $(this).remove();
                    });
                }, 3000);
            },
            error: function(data) {
                if (data.status === 422) {
                    var errors = $.parseJSON(data.responseText);
                    $.each(errors.errors, function(key, value) {
                        $('#edit_adminuser_form').find('input[name=' + key + ']').parents('.form-group')
                            .find('.error-msg-input').html(value);
                    });
                }
            }
        });
    }

    $("#edit_adminuser_form").validate({
        errorClass: 'invalid-feedback animated fadeInDown',
        errorElement: 'div',
        rules: {
            name: {
                required: true,
            },
            email: {
                required: true,
                email: true,
            },
            password: {
                required: true,
            },
            role: {
                required: true,
            },

        },
        messages: {
            name: {
                required: "The name field is required.",
            },
            email: {
                required: "The email field is required.",
            },
            password: {
                required: "This password field is required.",
            },
            role: {
                required: "The role field is required.",
            },
        },
        submitHandler: function(form) {
            editCategory(form);
        },
        highlight: function(element, errorClass, validClass) {
            $(element).addClass('is-invalid');
            $(element).parents("div.form-control").addClass(errorClass).removeClass(validClass);
        },
        unhighlight: function(element, errorClass, validClass) {
            $(element).removeClass('is-invalid');
            $(element).parents(".error").removeClass(errorClass).addClass(validClass);
        },
    });
    $(document).on('click', '#delete', function() {
        var id = $(this).attr('category_id');

        swal({
            // title: 'Are you sure?',
            text: "Are you sure want to Delete!",
            type: "warning",
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, delete it!',
            reverseButtons: true
        }).then((result) => {
            if (result) {
                $.ajax({
                    type: 'POST',
                    url: '{{ route("admin.adminUser.delete") }}',
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    data: {
                        'id': id
                    },
                    success: function(data) {
                        if (data) {
                            swal(
                                'Deleted!',
                                'Admin User has been deleted.',
                                'success'
                            )
                            window.LaravelDataTables["admin-table"].draw();
                        }
                    }
                });
            } else {
                swal("Cancelled", "Your record is safe :)", "error");
            }
        })
    });

</script>
@endpush