<!-- Sidebar -->
<ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

<!-- Sidebar - Brand -->
<a class="sidebar-brand d-flex align-items-center justify-content-center" href="index.html">
    <div class="sidebar-brand-icon rotate-n-15">
        <i class="fas fa-hand-holding-usd"></i>
    </div>
    <div class="sidebar-brand-text mx-3">Donasi Kita</div>
</a>

<!-- Divider -->
<hr class="sidebar-divider">

<div class="sidebar-heading">ADMIN</div>

<!-- Nav Item - Dashboard -->
<li class="nav-item active">
    <!-- Nav Item - Dashboard -->
    <li class="nav-item">
        <a class="nav-link pb-0" href="<?= base_url('admin'); ?>">
            <i class="fas fa-fw fa-home"></i>
            <span>Dashboard</span>
        </a>
    </li>
    <li class="nav-item">
        <a class="nav-link pb-0" href="<?= base_url('admin/kategori'); ?>">
            <i class="fas fa-fw fa-bars"></i>
            <span>Kategori</span>
        </a>
    </li>
    <li class="nav-item">
        <a class="nav-link pb-0" href="<?= base_url('admin/donasi'); ?>">
            <i class="fas fa-fw fa-donate"></i>
            <span>Donasi</span>
        </a>
    </li>
    <li class="nav-item">
        <a class="nav-link" href="<?= base_url('user/anggota'); ?>">
            <i class="fas fa-fw fa-clipboard-check"></i>
            <span>Konfirmasi Donasi</span>
        </a>
    </li>
</li>

<!-- Divider -->
<hr class="sidebar-divider d-none d-md-block">

<!-- Sidebar Toggler (Sidebar) -->
<div class="text-center d-none d-md-inline">
    <button class="rounded-circle border-0" id="sidebarToggle"></button>
</div>

</ul>
<!-- End of Sidebar -->