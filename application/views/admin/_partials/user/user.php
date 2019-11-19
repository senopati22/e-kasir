<link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/sweetalert/dist/sweetalert.css') ?>">
<script type="text/javascript" src="<?php echo base_url('assets/sweetalert/dist/sweetalert.min.js') ?>"></script>
<!-- Page Heading -->
<h1 class="h3 mb-2 text-gray-800">Data User TP4D</h1>

<div class="card shadow mb-4">
  <div class="card-header py-3">
    <a href="<?php echo site_url('admin/users/add') ?>">
      <button class="pull-right btn btn-primary"><i class="fa fa-plus"></i> Tambah data user</button>
    </a>
    <h6 class="m-0 font-weight-bold text-success">Data User</h6>
  </div>
  <div class="card-body">
    <div class="table-responsive">
      <table class="table display nowrap table-bordered table-hover" id="example" width="100%" cellspacing="0">
        <thead>
          <tr>
            <th>No.</th>
            <th>Username</th>
            <th>Level</th>
            <th>Opsi</th>
          </tr>
        </thead>
        <tbody>
          <?php
            $no = 1;
            foreach($users as $user):
          ?>
            <tr>
              <td><?= $no++ ?></td>
              <td><?= $user->uname ?></td>
              <td><?= $user->status ?></td>
              <td width="250" style="text-align: center;">
                <a href="<?php echo site_url('admin/users/edit/'.$user->id) ?>" class="btn btn-success btn-circle" data-toggle="tooltip" data-placement="left" title="Edit">
                  <i class="material-icons">edit</i>
                </a>
                <a onclick="deleteConfirm('<?php echo site_url('admin/users/delete/'.$user->id) ?>')" data-toggle="tooltip" data-placement="left" title="Hapus" href="#" class="btn btn-small btn-danger btn-circle">
                  <i class="material-icons">delete_outline</i>
                </a>
              </td>
            </tr>
          <?php endforeach; ?>
        </tbody>
      </table>
    </div>
  </div>
</div>