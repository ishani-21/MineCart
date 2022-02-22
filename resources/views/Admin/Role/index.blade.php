@extends('Admin.layouts.master')
@section('title', 'Role Listing')
@push('css')
<!-- <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.1.3/css/bootstrap.min.css" /> -->
<!-- <link href="https://cdn.datatables.net/1.10.16/css/jquery.dataTables.min.css" rel="stylesheet"> -->
<link href="https://cdn.datatables.net/1.10.19/css/dataTables.bootstrap4.min.css" rel="stylesheet">
@endpush
@section('content')
<div class="content-overlay"></div>
<div class="content-wrapper">
    <div class="col-12">
        <a href="{{route('admin.role.index')}}">
            <div class="content-header">Role Listing</div>
            <p class="content-sub-header mb-1">Role list also here.</p>
        </a>
    </div>
    <hr class="mt-1 mt-sm-2"></br>
    <button class="btn btn-primary mr-1 mb-1" data-toggle="modal" data-target="#add_role_modal" data-id="'.$data->id.'"><i class="ft-plus mr-2"></i>Add Role</button>
    
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
@include('Admin.Role.create')
@endsection

@push('scripts')
{!! $dataTable->scripts() !!}

<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.2/jquery.validate.min.js"></script>

<script type="text/javascript">
    $('#add_role_modal').on('click', '#globalCheckbox', function() {
        if ($(this).prop("checked")) {
            $('#add_role_modal').find("input[type=checkbox]").prop("checked", true);
        } else {
            $('#add_role_modal').find("input[type=checkbox]").prop("checked", false);
        }
    });

    $('#add_role_modal').on('click', '.permision_check', function() {
        $('#add_role_modal').find('#globalCheckbox').prop("checked", false);
        if ($('.permision_check:checked').length == $('.permision_check').length) {
            $('#add_role_modal').find('#globalCheckbox').prop("checked", true);
        }
    });

    // Seperate row checkboxes
    $('.checkallrow').on('change', function() {
        if ($(this).prop("checked")) {
            $(this).parents("tr.multipleCheckbox").find("input[type=checkbox]").prop("checked", true);
        } else {
            $(this).parents("tr.multipleCheckbox").find("input[type=checkbox]").prop("checked", false);
        }
    });
</script>

<script>
    $(document).on('click', '.btn-save', function() {
        $('#add_role_form').trigger('reset');
        $('#question-error').html('');
        $('.form-control').removeClass('is-invalid');
    })

    $('#add_role_modal').on('show.bs.modal', function(e) {
        var button = $(e.relatedTarget)
        var category_id = button.data('id');
        $('.error-msg-input').text('');
        $('.invalid-feedback').text('');
        $('.form-control').removeClass('is-invalid');
        $('#add_role_form').trigger('reset');
        $('#category_id').val(category_id);
    });

    function addCategory(form) {

        $.ajax({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
            },
            url: '{{ route("admin.role.rolestore") }}',
            type: 'post',
            processData: false,
            contentType: false,
            data: new FormData(form),
            success: function(result) {
                if (result) {
                    $html = '<div class="alert alert-block alert-' + result.status + '"><button type="button" class="close" data-dismiss="alert">×</button><strong>' + result.message + '</strong></div>';

                    $('.ajax-msg').append($html);
                }
                $('#add_role_modal').modal('hide');

                window.LaravelDataTables["role-table"].draw();
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
                    console.log(errors)
                    $.each(errors.errors, function(key, value) {
                        $('#add_role_form').find('input[name=' + key + ']').parents('.form-group')
                            .find('.error-msg-input').html(value);
                    });
                }
            }
        });
    }

    $("#add_role_form").validate({
        errorClass: 'invalid-feedback animated fadeInDown',
        errorElement: 'div',
        rules: {
            name: {
                required: true,
            },
            permissions: {
                required: true,
            }
        },
        messages: {
            name: {
                required: "The name field is required.",
            },
            permissions: {
                required: "The permissions field is required.",
            }
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
        },
    });

    $(document).on('click', '#cat_delete', function() {
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
                    url: '{{ route("admin.role.delete") }}',
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
                                'Role has been deleted.',
                                'success'
                            )
                            window.LaravelDataTables["role-table"].draw();
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