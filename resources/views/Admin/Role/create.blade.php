<div class="modal fade" id="add_role_modal" tabindex="-1" role="dialog" aria-labelledby="add_role_modal" data-backdrop="static" data-keyboard="false" aria-modal="true" aria-hidden="true">
    <div class="modal-dialog modal-large" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="workerLabel">Add Role</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form class="" action="" method="POST" enctype="multipart/form-data" id="add_role_form">
                    @csrf
                    <div class="form-group">
                        <label>Role Name :</label>
                        <input type="text" id="name" name="name" class="form-control" placeholder="Enter role name" required>
                        <span class="error-msg-input text-danger"></span>
                    </div>

                    <div class="form-group">
                        <div class="heading-flex d-flex align-items-start">
                            <input type="checkbox" name="" id="globalCheckbox" class="mr-1">
                            <label for="globalCheckbox">Permisstion Name :</label>
                        </div>

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

                                <td>
                                    <input type="checkbox" class="permision_check" name="permissions[]" value="{{$permission->id}}"> &nbsp;{{ $permission->name }}
                                </td>

                                @if($row == 5)
                            </tr>
                            @php $row=0; @endphp
                            @endif
                            @php $row++; @endphp
                            @endforeach
                        </table>
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