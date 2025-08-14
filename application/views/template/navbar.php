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
        <!-- Dashboard selalu muncul -->
        <li class="nav-item active">
          <a href="<?= site_url('Dashboard') ?>">
            <i class="fas fa-home"></i>
            <p>Dashboard</p>
          </a>
        </li>

        <!-- Modul lain sesuai akses -->
        <?php foreach ($this->session->userdata('modul_akses') as $modul): ?>
          <?php if (empty($modul['menus'])): ?>
            <li class="nav-item">
              <a href="<?= site_url($modul['url_modul']) ?>">
                <i class="<?= $modul['icon'] ?>"></i>
                <p><?= $modul['name'] ?></p>
              </a>
            </li>
          <?php else: ?>
            <li class="nav-item">
              <a data-toggle="collapse" href="#modul<?= $modul['id'] ?>">
                <i class="<?= $modul['icon'] ?>"></i>
                <p><?= $modul['name'] ?></p>
                <span class="caret"></span>
              </a>
              <div class="collapse" id="modul<?= $modul['id'] ?>">
                <ul class="nav nav-collapse">
                  <?php foreach ($modul['menus'] as $menu): ?>
                    <li>
                      <a href="<?= site_url($menu['url']) ?>">
                        <span class="sub-item"><?= $menu['name'] ?></span>
                      </a>
                    </li>
                  <?php endforeach; ?>
                </ul>
              </div>
            </li>
          <?php endif; ?>
        <?php endforeach; ?>
      </ul>


    </div>
  </div>
</div>
<div class="main-panel">