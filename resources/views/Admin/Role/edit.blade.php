@extends('Admin.layouts.master')
@section('title', 'Role')
@section('content')
<div class="content-wrapper">
    <div class="col-12">
    <a href="{{route('admin.role.index')}}">
        <div class="content-header">Edit Role</div>
        <p class="content-sub-header mb-1">Edit role also here .</p>
    </a>
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-body">
                    <form class="" action="{{route('admin.role.index')}}" method="POST" enctype="multipart/form-data" id="edit_role_form" novalidate="novalidate">
                        <input type="hidden" name="_token" value="">
                        <div class="form-group">
                            <label>Role Name :</label>
                            <input type="hidden" id="id" name="id" value="{{$role->id}}">
                            <input type="text" id="name" name="name" class="form-control" placeholder="Enter permisstion name" required value="{{$role->name}}">
                            <span class="error-msg-input text-danger"></span>
                        </div>

                        <div class="form-group">
                            <div class="heading-flex d-flex align-items-start">
                                <input type="checkbox" name="" id="globalCheckbox" class="mr-1">
                                <label for="globalCheckbox">Permisstion Name :</label>
                            </div>
                            <div class="table-responsive">
                                <table class="table" id="permission">
                                    <tr>
                                        <td><b>Module Name</b></td>
                                        <td><b>Create</b></td>
                                        <td><b>Update</b></td>
                                        <td><b>View</b></td>
                                        <td><b>Delete</b></td>
                                        <td><b>Status</b></td>
                                    </tr>
                                    @php $row=1; @endphp
                                    @foreach ($permissions as $id => $permission)
                                    @if($row == 1)
                                    <tr class="multipleCheckbox">
                                        <td><b><input type="checkbox" class="checkallrow" name="" id="{{$permission->module}}"> &nbsp; {{($permission->module)}}</b></td>
                                        @endif
                                        @if(isset($rolePermissions))
                                        <td>
                                            <input type="checkbox" class="permision_check" name="permissions[]" value="{{$permission->id}}" {{in_array($permission->id, $rolePermissions) ? 'checked' : ''}}> &nbsp;{{ $permission->name }}
                                        </td>
                                        @endif
                                        @if($row == 5)
                                    </tr>
                                    @php $row=0; @endphp
                                    @endif
                                    @php $row++; @endphp
                                    @endforeach
                                </table>
                            </div>
                            <span class="error-msg-input text-danger"></span>
                        </div>

                        <div class="form-group">
                            <div>
                                <button type="submit" class="btn btn-primary waves-effect waves-light">
                                    Submit
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>


@endsection

@push('scripts')

<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.2/jquery.validate.min.js"></script>

<script type="text/javascript">
    $('#edit_role_form').on('click', '#globalCheckbox', function() {
        if ($(this).prop("checked")) {
            $('#edit_role_form').find("input[type=checkbox]").prop("checked", true);
        } else {
            $('#edit_role_form').find("input[type=checkbox]").prop("checked", false);
        }
    });
    $('#edit_role_form').on('click', '.permision_check', function() {
        $('#edit_role_form').find('#globalCheckbox').prop("checked", false);
        if ($('.permision_check:checked').length == $('.permision_check').length) {
            $('#edit_role_form').find('#globalCheckbox').prop("checked", true);
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
    function editCategory(form) {
        $.ajax({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
            },
            url: '{{ route("admin.role.update")}}',
            type: 'POST',
            processData: false,
            contentType: false,
            data: new FormData(form),
            success: function(result) {

                if (result == 1) {
                    $html = '<div class="alert alert-block alert-' + result.status + '"><button type="button" class="close" data-dismiss="alert">×</button><strong>' + result.message + '</strong></div>';

                    $('.ajax-msg').append($html);
                }
                // window.LaravelDataTables["role-table"].draw();
                window.location.href = "{{ route('admin.role.index') }}";
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
                        $('#edit_role_form').find('input[name=' + key + ']').parents('.form-group')
                            .find('.error-msg-input').html(value);
                    });
                }
            }
        });
    }
    $("#edit_role_form").validate({
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
            editCategory(form);
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
</script>

@endpush