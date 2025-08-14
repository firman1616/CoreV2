<div class="sidebar sidebar-style-2">
  <div class="sidebar-wrapper scrollbar scrollbar-inner">
    <div class="sidebar-content">
      <div class="user">
        <div class="avatar-sm float-left mr-2">
          <img src="<?= base_url('') ?>assets/template/assets/img/profile.jpg" alt="..." class="avatar-img rounded-circle">
        </div>
        <div class="info">
          <a data-toggle="collapse" href="#collapseExample" aria-expanded="true">
            <span>
              <?= $this->session->userdata('name') ?>
              <!-- <span class="user-level">Administrator</span> -->
              <!-- <span class="caret"></span> -->
            </span>
          </a>
          <div class="clearfix"></div>
        </div>
      </div>
      <ul class="nav nav-primary">
        <li class="nav-item active">
          <a href="<?= site_url('Dashboard') ?>">
            <i class="fas fa-home"></i>
            <p>Dashboard</p>
          </a>
        </li>
        <li class="nav-item">
          <a data-toggle="collapse" href="#base">
            <i class="fas fa-layer-group"></i>
            <p>Setting</p>
            <span class="caret"></span>
          </a>
          <div class="collapse" id="base">
            <ul class="nav nav-collapse">
              <li>
                <a href="<?= site_url('Modul') ?>">
                  <span class="sub-item">Modul</span>
                </a>
              </li>
              <li>
                <a href="<?= site_url('Menu') ?>">
                  <span class="sub-item">Menu</span>
                </a>
              </li>
              <li>
                <a href="<?= site_url('Role') ?>">
                  <span class="sub-item">Role</span>
                </a>
              </li>
              <li>
                <a href="<?= site_url('User') ?>">
                  <span class="sub-item">User</span>
                </a>
              </li>
            </ul>
          </div>
        </li>
      </ul>
    </div>
  </div>
</div>
<div class="main-panel">