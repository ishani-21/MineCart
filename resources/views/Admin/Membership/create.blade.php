<div class="modal fade" id="membership_add_modal" tabindex="-1" role="dialog" data-backdrop="static" data-keyboard="false" aria-modal="true" aria-labelledby="membership_add_modal" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="workerLabel">Add Membership Plan</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form class="" action="" method="POST" enctype="multipart/form-data" id="add_membership_form">
                    @csrf
                    <div class="form-group">
                        <label>Package Name (English) :</label>
                        <div class="controls">
                            <input type="text" id="en_package_name" name="en_package_name" class="form-control" placeholder="Please enter package name" onkeypress="return (event.charCode > 64 && event.charCode < 91) || (event.charCode > 96 && event.charCode < 123) || (event.charCode==15)">
                        </div>
                        <span class="error-msg-input text-danger"></span>
                    </div>

                    <div class="form-group">
                        <label>Package Name (Arebic) :</label>
                        <div class="controls">
                            <input type="text" id="ar_package_name" name="ar_package_name" class="form-control" placeholder="الرجاء إدخال اسم الحزمة" required>
                            <span class="error-msg-input text-danger"></span>
                        </div>
                    </div>

                    <div class="form-group">
                        <label>Price :</label>
                        <div class="controls">
                            <input type="text" id="price" name="price" class="form-control" placeholder="Please enter price" required>
                            <span class="error-msg-input text-danger"></span>
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="duration">Duration :</label>
                        <div class="controls">
                            <div class="input-group mb-0">
                                <input type="text" id="duration" name="duration" class="duration form-control @error('duration') is-invalid @enderror" placeholder="Enter duration">
                                <div class="input-group-append">
                                    <span class="input-group-text">Days</span>
                                </div>
                            </div>
                            @error('duration')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                    </div>

                    <div class="form-group">
                        <label>Discription (English) :</label>
                        <div class="controls">
                            <input type="text" id="en_discription" name="en_discription" class="form-control" placeholder="Please enter discription" required>
                            <span class="error-msg-input text-danger"></span>
                        </div>
                    </div>

                    <div class="form-group">
                        <label>Discription (Arebic) :</label>
                        <div class="controls">
                            <input type="text" id="ar_discription" name="ar_discription" class="form-control" placeholder="Please enter discription" required>
                            <span class="error-msg-input text-danger"></span>
                        </div>
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

<div class="modal fade" id="membership_edit_modal" tabindex="-1" role="dialog" data-backdrop="static" data-keyboard="false" aria-modal="true" aria-labelledby="membership_edit_modal" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="workerLabel">Update Membership Plan</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form class="" action="" method="POST" enctype="multipart/form-data" id="edit_membership_form">
                    @csrf
                    <div class="form-group">
                        <label>Package Name (English) :</label>
                        <div class="controls">
                            <input type="hidden" id="id" name="id" value=""> 
                            <input type="text" id="en_package_name" name="en_package_name" class="form-control" placeholder="Please enter package name" onkeypress="return (event.charCode > 64 && event.charCode < 91) || (event.charCode > 96 && event.charCode < 123) || (event.charCode==15)">
                        </div>
                        <span class="error-msg-input text-danger"></span>
                    </div>

                    <div class="form-group">
                        <label>Package Name (Arebic) :</label>
                        <div class="controls">
                            <input type="text" id="ar_package_name" name="ar_package_name" class="form-control" placeholder="الرجاء إدخال اسم الحزمة" required>
                        </div>
                    </div>

                    <div class="form-group">
                        <label>Price :</label>
                        <div class="controls">
                            <input type="text" id="price" name="price" class="form-control" placeholder="Please enter price" required>
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="duration">Duration :</label>
                        <div class="controls">
                            <div class="input-group mb-0">
                                <input type="text" id="duration" name="duration" class="duration form-control @error('duration') is-invalid @enderror" placeholder="Enter duration">
                                <div class="input-group-append">
                                    <span class="input-group-text">Days</span>
                                </div>
                            </div>
                            @error('duration')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                    </div>

                    <div class="form-group">
                        <label>Discription (English) :</label>
                        <div class="controls">
                            <input type="text" id="en_discription" name="en_discription" class="form-control" placeholder="Please enter discription" required>
                        </div>
                    </div>

                    <div class="form-group">
                        <label>Discription (Arebic) :</label>
                        <div class="controls">
                            <input type="text" id="ar_discription" name="ar_discription" class="form-control" placeholder="Please enter discription" required>
                        </div>
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