
<!-- Modal -->
<div class="modal fade" id="student-modal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header py-3">
                <h2 class="modal-title" id="title-modal"></h2>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form method="post" id="ajaxForm" class="ajaxForm" enctype="multipart/form-data">
                    @csrf
                    <input type="hidden" id="update_id" name="update">
                    <div class="row" style="box-shadow: 1px -8px 20px 0px #ddd;padding: 16px;border-radius: 9px;">
                        <div class="col-md-5">
                            <div class="mb-3">
                                <label for="name-label" class="form-label">Name</label>
                                <input type="text" name="name" id="name"
                                    class="form-control form-control-sm name">
                            </div>

                            <div class="mb-3">
                                <label for="email-label" class="form-label">Email Address</label>
                                <input type="email" name="email" id="email" class="form-control form-control-sm">
                            </div>

                            <div class="mb-3">
                                <label for="phone-label" class="form-label">Phone Number</label>
                                <input type="text" name="phone" id="phone" class="form-control form-control-sm">
                            </div>

                            <div class="mb-3">
                                <label for="roll-label" class="form-label">Roll Number</label>
                                <input type="number" name="roll" id="roll" class="form-control form-control-sm">
                            </div>

                        </div>
                        <div class="col-md-6">

                            <div class="mb-3">
                                <label for="reg-label" class="form-label">Registration No</label>
                                <input type="number" name="reg" id="reg" class="form-control form-control-sm">
                            </div>

                            <div class="mb-3 board-select">
                                <label for="board-label" class="form-label">Board</label>

                                <select name="board" class="form-select" id="board">
                                    <option value="">select please</option>
                                    <option value="Dhaka">Dhaka</option>
                                    <option value="Bogura">Bogura</option>
                                    <option value="Rangpur">Rangpur</option>
                                    <option value="Barishal">Barishal</option>
                                </select>
                            </div>

                            <div class="mb-3">
                                <label for="profile-label" class="form-label">Profile</label>
                                <input type="file" name="avatar" id="avatar"class="form-control form-control-sm">
                                    <div class="modalEdit_avatar">

                                    </div>
                            </div>


                        </div>
                    </div>

                    <div class="text-end">
                        <button type="reset" class="btn btn-secondary"> Reset </button>
                        <button type="submit" class="btn btn-primary save-btn"> </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
