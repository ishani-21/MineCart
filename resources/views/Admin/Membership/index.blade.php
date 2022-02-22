@extends('Admin.layouts.master')
@section('title', 'Membership Plan Listing')
@push('css')
<!-- <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.1.3/css/bootstrap.min.css" /> -->
<!-- <link href="https://cdn.datatables.net/1.10.16/css/jquery.dataTables.min.css" rel="stylesheet"> -->
<link href="https://cdn.datatables.net/1.10.19/css/dataTables.bootstrap4.min.css" rel="stylesheet">
@endpush
@section('content')
<div class="content-overlay"></div>
<div class="content-wrapper">
    <div class="col-12">
        <a href="{{route('admin.Membership.membershipindex')}}">
            <div class="content-header">Membership Plan Listing</div>
            <p class="content-sub-header mb-1">Membership Plan list also here.</p>
        </a>
    </div>
    <hr class="mt-1 mt-sm-2"></br>
    @can('membership_plan_create')
    <button class="btn btn-primary mr-1 mb-1" data-toggle="modal" data-target="#membership_add_modal" data-id="'.$data->id.'"><i class="ft-plus mr-2"></i>Add Membership Paln</button>
    @endcan
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
@include('Admin.Membership.create')
@endsection

@push('scripts')
{!! $dataTable->scripts() !!}

<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.2/jquery.validate.min.js"></script>

<script>
    $(document).on('click', '.btn-save', function() {
        $('#add_membership_form').trigger('reset');
        $('#question-error').html('');
        $('.form-control').removeClass('is-invalid');
    })
    $('#membership_add_modal').on('show.bs.modal', function(e) {
        var button = $(e.relatedTarget)
        var category_id = button.data('id');
        $(this).find("input").val('');
        $('.error-msg-input').text('');
        $('.invalid-feedback').text('');
        $('.form-control').removeClass('is-invalid');
        $('#category_id').val(category_id);
    });

    function addCategory(form) {
        $.ajax({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
            },
            url: "{{ route('admin.Membership.membershipstore') }}",
            type: 'post',
            processData: false,
            contentType: false,
            data: new FormData(form),
            success: function(result) {
                if (result) {
                    $html = '<div class="alert alert-block alert-' + result.status + '"><button type="button" class="close" data-dismiss="alert">×</button><strong>' + result.message + '</strong></div>';

                    $('.ajax-msg').append($html);
                }
                $('#membership_add_modal').modal('hide');

                window.LaravelDataTables["membership-table"].draw();
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
                        $('#add_membership_form').find('input[name=' + key + ']').parents('.form-group')
                            .find('.error-msg-input').html(value);
                    });
                }
            }
        });
    }

    $("#add_membership_form").validate({
        errorClass: 'invalid-feedback animated fadeInDown',
        errorElement: 'div',
        rules: {
            en_package_name: {
                required: true,
            },
            ar_package_name: {
                required: true,
            },
            price: {
                required: true,
            },
            duration: {
                required: true,
            },
            en_discription: {
                required: true,
            },
            ar_discription: {
                required: true,
            }

        },
        messages: {
            en_package_name: {
                required: "The package name field is required.",
            },
            ar_package_name: {
                required: "The arebic package name field is required.",
            },
            price: {
                required: "This price field is required.",
            },
            duration: {
                required: "The duration field is required.",
            },
            en_discription: {
                required: "The discription field is required.",
            },
            ar_discription: {
                required: "This arebic discription field is required.",
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
        errorPlacement: function(error, element) {
            error.insertAfter(element.parents('.form-group').find('.controls'));
        }
    });

    $('#membership_edit_modal').on('show.bs.modal', function(e) {
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
            url: '{{route("admin.Membership.edit")}}',
            type: 'GET',
            data: {
                id: category_id
            },
            success: function(result) {
                if (result) {

                    $("#membership_edit_modal").find('#id').val(result.id);
                    $("#membership_edit_modal").find('#en_package_name').val(result.en_package_name);
                    $("#membership_edit_modal").find('#ar_package_name').val(result.ar_package_name);
                    $("#membership_edit_modal").find('#price').val(result.price);
                    $("#membership_edit_modal").find('#duration').val(result.duration);
                    $("#membership_edit_modal").find('#en_discription').val(result.en_discription);
                    $("#membership_edit_modal").find('#ar_discription').val(result.ar_discription);

                }
            }
        });
    });

    function editCategory(form) {
        $.ajax({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
            },
            url: '{{ route("admin.Membership.update") }}',
            type: 'POST',
            processData: false,
            contentType: false,
            data: new FormData(form),
            success: function(result) {
                if (result) {
                    $html = '<div class="alert alert-block alert-' + result.status + '"><button type="button" class="close" data-dismiss="alert">×</button><strong>' + result.message + '</strong></div>';

                    $('.ajax-msg').append($html);
                }
                $('#membership_edit_modal').modal('hide');

                window.LaravelDataTables["membership-table"].draw();
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
                        $('#edit_membership_form').find('input[name=' + key + ']').parents('.form-group')
                            .find('.error-msg-input').html(value);
                    });
                }
            }
        });
    }

    $("#edit_membership_form").validate({
        errorClass: 'invalid-feedback animated fadeInDown',
        errorElement: 'div',
        rules: {
            en_package_name: {
                required: true,
            },
            ar_package_name: {
                required: true,
            },
            price: {
                required: true,
            },
            duration: {
                required: true,
            },
            en_discription: {
                required: true,
            },
            ar_discription: {
                required: true,
            }

        },
        messages: {
            en_package_name: {
                required: "The package name field is required.",
            },
            ar_package_name: {
                required: "The arebic package name field is required.",
            },
            price: {
                required: "This price field is required.",
            },
            duration: {
                required: "The duration field is required.",
            },
            en_discription: {
                required: "The discription field is required.",
            },
            ar_discription: {
                required: "This arebic discription field is required.",
            }
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
        errorPlacement: function(error, element) {
            error.insertAfter(element.parents('.form-group').find('.controls'));
        }
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
                    url: '{{ route ("admin.Membership.delete") }}',
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
                                'Mebership paln has been deleted.',
                                'success'
                            )
                            window.LaravelDataTables["membership-table"].draw();
                        }
                    }
                });
            } else {
                swal("Cancelled", "Your record is safe :)", "error");
            }
        })
    });

    $(document).on('click', '.changeStatus', function() {
        var this_var = this;
        $(this).attr('disabled', true);
        var category_id = $(this).attr('category_id');
        var status = $(this).attr('status');
        var msg = "";

        if (status == 0) {
            msg = "Active";
        } else {
            msg = "Inactive";
        }

        swal({
            title: 'Are you sure want to ' + msg + '?',
            type: "warning",
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, ' + msg + ' it!',
            reverseButtons: true
        }).then((result) => {
            if (result) {
                $.ajax({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    url: "{{ route('admin.Membership.changestatus') }}",
                    type: 'PATCH',
                    data: {
                        'status': status,
                        'id': category_id
                    },
                    success: function(res) {

                        swal(
                            res.action, //get from controller (block/unblock/cancel)
                            res.msg, // get from controller
                            res.status // get from controller (success/error)
                        )

                        window.LaravelDataTables["membership-table"].draw();
                    }
                });
            } else {
                swal("Cancelled", "Status not changed :)", "error");
                $(this).attr('disabled', false);
            }
        }).catch((error) => {
            $('.changeStatus').attr('disabled', false);
        });

    });
</script>

@endpush