<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta http-equiv="x-ua-compatible" content="ie=edge">

  <title>SISTEM PENDUKUNG KEPUTUSAN UNTUK MEMILIH APARTEMEN MENGGUNAKAN METODE ANALYTICAL HIERARCHY PROCESS DAN METODE SIMPLE ADDITIVE WEIGHTING</title>
  
  <!-- Font Awesome Icons -->
  <link rel="stylesheet" href="../assets/plugins/fontawesome-free/css/all.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="../assets/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css">
  <link rel="stylesheet" href="../assets/plugins/datatables-responsive/css/responsive.bootstrap4.min.css">
  <link rel="stylesheet" href="../assets/dist/css/adminlte.min.css">
  <!-- Google Font: Source Sans Pro -->
  <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">
  <script src="../assets/plugins/jquery/jquery.min.js"></script>
</head>
<body class="hold-transition sidebar-mini">
  <div class="wrapper">

    <!-- Navbar -->
    <nav class="main-header navbar navbar-expand navbar-light" style="background-color: #2f5792">
      <ul class="navbar-nav">
        <li class="nav-item">
          <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
        </li>
      </ul>
    </nav>
    <!-- /.navbar -->

    <!-- Main Sidebar Container -->
    <aside class="main-sidebar sidebar-dark-primary elevation-4" style="background-color:#0D101C">

      <div href="index3.html" class="brand-link">
        <span class="brand-text font-weight-light">SPK APARTEMEN AHP SAW</span>
      </div>

      <!-- Sidebar -->
      <div class="sidebar">
        <!-- Sidebar user panel (optional) -->
        <div class=" mt-3 pb-3 mb-3 d-flex">

      </div>

      <!-- Sidebar Menu -->
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false" >
          <li class="nav-item">
            <a href="/" class="nav-link">
              <i class="nav-icon fas fa-home"></i>
              <p>
                Dashboard 
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="/alternatif" class="nav-link">
              <i class="nav-icon fas fa-window-restore"></i>
              <p>
                Data Alternatif   
              </p>
            </a>
          </li>

          <li class="nav-item">
            <a href="/kriteria" class="nav-link">
              <i class="nav-icon fas fa-list-alt"></i>
              <p>
                Data Kriteria   
              </p>
            </a>
          </li>

           <li class="nav-item">
            <a href="/rel_kriteria" class="nav-link">
              <i class="nav-icon fas fa-calendar-check"></i>
              <p>
                Nilai Kriteria   
              </p>
            </a>
          </li>

          <li class="nav-item">
            <a href="/relasi" class="nav-link">
              <i class="nav-icon fas fa-calculator"></i>
              <p>
                Nilai Alternatif  
              </p>

            </a>
          </li>

          <li class="nav-item">
            <a href="/perhitungan" class="nav-link">
              <i class="nav-icon fas fa-cogs"></i>
              <p>
                Perhitungan   
              </p>
            </a>
          </li>
        </ul>
      </nav>
      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
  </aside>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper" style="background-color:#E4E2E9">
   @yield('content')
 </div>
 <!-- /.content-wrapper -->
</div>
<!-- ./wrapper -->

<!-- REQUIRED SCRIPTS -->

<!-- jQuery -->

<!-- Bootstrap 4 -->
<script src="../assets/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- DataTables -->
<script src="../assets/plugins/datatables/jquery.dataTables.min.js"></script>
<script src="../assets/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js"></script>
<script src="../assets/plugins/datatables-responsive/js/dataTables.responsive.min.js"></script>
<script src="../assets/plugins/datatables-responsive/js/responsive.bootstrap4.min.js"></script>
<!-- AdminLTE App -->
<script src="../assets/dist/js/adminlte.min.js"></script>
<script src="../assets/js/jquery.number.js"></script>
<!-- script -->
<script>
  $(function () {
    $('#tabeldata').DataTable({
      "paging": true,
      "lengthChange": false,
      "searching": true,
      "ordering": true,
      "info": true,
      "autoWidth": false,
      "responsive": true,
    });
  });
</script>
<!-- end script -->
</body>
</html>
