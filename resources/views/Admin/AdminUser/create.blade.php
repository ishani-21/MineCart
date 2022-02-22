<div class="modal fade" id="add_adminuser_modal" tabindex="-1" role="dialog" data-backdrop="static" data-keyboard="false" aria-modal="true" aria-labelledby="add_adminuser_modal" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="workerLabel">Add Admin User</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form class="" action="" method="POST" enctype="multipart/form-data" id="add_adminuser_form">
                    @csrf
                    <div class="form-group">
                        <label>Name :</label>
                        <div class="controls">
                            <input type="text" id="name" name="name" class="form-control" placeholder="Please enter name">
                            <span class="error-msg-input text-danger"></span>
                            @error('name')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                    </div>

                    <div class="form-group">
                        <label>Email :</label>
                        <div class="controls">
                            <input type="text" id="email" name="email" class="form-control" placeholder="Please enter email">
                            <span class="error-msg-input text-danger"></span>
                            @error('email')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                    </div>

                    <div class="form-group">
                        <label>Password :</label>
                        <div class="controls">
                            <input type="password" id="password" name="password" class="form-control" placeholder="Please enter password">
                            <span class="error-msg-input text-danger"></span>
                            @error('password')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                    </div>
                    <div class="form-group">
                        <label>Select Role :</label>
                        <select name="role" class="form-control">
                            <option value="">Select one</option>
                            @foreach($data as $role)
                            <option value="{{$role->id}}">{{$role->name}}</option>
                            @endforeach
                        </select>
                        <span class="error-msg-input text-danger"></span>   
                        @error('role')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
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


<div class="modal fade" id="edit_adminuser_modal" tabindex="-1" role="dialog" data-backdrop="static" data-keyboard="false" aria-modal="true" aria-labelledby="edit_adminuser_modal" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="workerLabel">Edit Admin User</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form class="" action="" method="POST" enctype="multipart/form-data" id="edit_adminuser_form">
                    @csrf
                    <div class="form-group">
                        <label>Name :</label>
                        <div class="controls">
                        <input type="hidden" id="id" name="id" class="form-control">
                            <input type="text" id="name" name="name" class="form-control" placeholder="Please enter name">
                            <span class="error-msg-input text-danger"></span>
                            @error('name')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                    </div>

                    <div class="form-group">
                        <label>Email :</label>
                        <div class="controls">
                            <input type="text" id="email" name="email" class="form-control" placeholder="Please enter email">
                            <span class="error-msg-input text-danger"></span>
                            @error('email')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                    </div>
                    <div class="form-group" id="roles-select">
                        <label>Select Role :</label>
                        <select style="color:white" id="role" name="roles[]" class="form-control" >
                        </select>
                        <span class="error-msg-input text-danger"></span>   
                        @error('role')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
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