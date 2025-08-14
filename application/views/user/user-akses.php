<?php
foreach ($akses as $row) {
    $name = $row->name;
    $id = $row->id;
}
?>

<div class="content">
    <div class="page-inner">
        <div class="page-header">
            <h4 class="page-title"><?= $title ?></h4>

        </div>
        <div class="card">
            <div class="card-header">
                <h4 class="card-title">Akses <?= $name ?></h4>
            </div>
            <div class="card-body">
                <form id="formAkses" data-user-id="<?= $id ?>">
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th>Nama Modul</th>
                                <th>Akses Role</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($modul as $row) { ?>
                                <tr>
                                    <td>
                                        <?= $row->name ?>
                                        <input type="hidden" name="modul_id[]" value="<?= $row->id ?>">
                                    </td>
                                    <td>
                                        <select name="role_id[]" class="form-control">
                                            <option value=""></option>
                                            <?php foreach ($role as $r) { ?>
                                                <option value="<?= $r->id ?>" <?= (isset($akses_map[$row->id]) && $akses_map[$row->id] == $r->id) ? 'selected' : '' ?>>
                                                    <?= $r->nama_role ?>
                                                </option>
                                            <?php } ?>
                                        </select>
                                    </td>
                                </tr>
                            <?php } ?>
                        </tbody>
                    </table>
                    <button type="submit" class="btn btn-primary btn-sm">
                        <i class="fa fa-save"></i> | Simpan Akses
                    </button>
                </form>
                <!-- <div class="table-responsive">
                    <div id="div-table-user-akses"></div>
                </div> -->
            </div>

        </div>
    </div>
</div>