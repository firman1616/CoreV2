<div class="content">
    <div class="page-inner">
        <div class="page-header">
            <h4 class="page-title"><?= $title ?></h4>

        </div>

        <div class="row">
            <div class="col-md-4">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title">Form</h4>
                    </div>
                    <div class="card-body">
                        <form action="" id="userForm" name="userForm" method="POST" enctype="multipart/form-data">
                            <input type="hidden" name="id" id="id">
                            <div class="form-group">
                                <label for="username">ID Karyawan</label>
                                <input type="text" class="form-control" id="nik" name="nik">
                            </div>
                            <div class="form-group">
                                <label for="username">Nama User</label>
                                <input type="text" class="form-control" id="nama_user" name="nama_user">
                            </div>
                            <div class="form-group">
                                <label for="username">Username</label>
                                <input type="text" class="form-control" id="username" name="username">
                            </div>
                            <div class="form-group">
                                <label for="username">Password</label>
                                <input type="password" class="form-control" id="password" name="password">
                            </div>
                            <div class="form-check">
                                <label class="form-check-label">
                                    <input class="form-check-input" type="checkbox" id="showPassword">
                                    <span class="form-check-sign">Lihat Password</span>
                                </label>
                            </div>
                            <button class="btn btn-primary" id="save-data">
                                <span class="btn-label">
                                    <i class="fa fa-save"></i>
                                </span>
                                Save
                            </button>
                        <form>
                    </div>
                </div>
            </div>

            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title">Table User</h4>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <div id="div-table-user"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>