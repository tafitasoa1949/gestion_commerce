<!DOCTYPE html>
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <!-- Custom fonts for this template-->
    <link href="{{ asset('assets/vendor/fontawesome-free/css/all.min.css') }}" rel="stylesheet" type="text/css">
    <!-- Custom styles for this template-->
    <link href="{{ ('assets/css/sb-admin-2.min.css') }}" rel="stylesheet">
    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
    <title>Gestion de stock</title>
</head>

<body id="page-top">

<!-- Page Wrapper -->
<div id="wrapper">

    <!-- Sidebar -->
    @include('content.sidebar')
    <!-- End of Sidebar -->

    <!-- Content Wrapper -->
    <div id="content-wrapper" class="d-flex flex-column">

        <!-- Main Content -->
        <div id="content">

            <!-- Topbar -->
            @include('content.topbar')
            <!-- End of Topbar -->

            <!-- Begin Page Content -->
            <div class="container-fluid">

                <!-- Page Heading -->
                <div class="d-sm-flex align-items-center justify-content-between mb-4">
                    <h1 class="h3 mb-0 text-gray-800">Ndw ary euh</h1>
                </div>
                <!-- Content Row -->
                <div class="row">
                    <!-- Content Column -->
                    <div class="col-lg-12 mb-8">
                    <div class="card-body">
                        <!-- table -->
                                    <div class="card shadow mb-12SS">
                        <div class="card-header py-3">
                            <h6 class="m-0 font-weight-bold text-primary">Liste des demandes</h6>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                    <thead>
                                        <tr>
                                            <th>Numero</th>
                                            <th>Departement</th>
                                            <th>Materiel</th>
                                            <th>Quantite</th>
                                            <th>Date</th>
                                            <th>Validation</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    @foreach ($listeDemande as $indice)
                                        <tr>
                                            <td>{{ $indice->id }}</td>
                                            <td>{{ $indice->departement }}</td>
                                            <td>{{ $indice->materiel }}</td>
                                            <td>{{ $indice->quantite }}</td>
                                            <td>{{ $indice->date }}</td>
                                            @include('demande.bouton')
                                        </tr>
                                    @endforeach
                                    </tbody>
                                </table>
                            @include('demande.boutonconfirmer')
                            </div>
                        </div>
                    </div>

                </div>

                    </div>
                </div>

            </div>
            <!-- /.container-fluid -->

        </div>
        <!-- End of Main Content -->

        <!-- Footer -->
        <footer class="sticky-footer bg-white">
            <div class="container my-auto">
                <div class="copyright text-center my-auto">
                    <span>Copyright &copy; Your Website 2021</span>
                </div>
            </div>
        </footer>
        <!-- End of Footer -->

    </div>
    <!-- End of Content Wrapper -->

</div>
<!-- End of Page Wrapper -->

<!-- Scroll to Top Button-->
<a class="scroll-to-top rounded" href="#page-top">
    <i class="fas fa-angle-up"></i>
</a>

<!-- Logout Modal-->
<div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
     aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Ready to Leave?</h5>
                <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body">Select "Logout" below if you are ready to end your current session.</div>
            <div class="modal-footer">
                <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                <a class="btn btn-primary" href="login.html">Logout</a>
            </div>
        </div>
    </div>
</div>

<!-- Bootstrap core JavaScript-->
<!--<script src="vendor/jquery/jquery.min.js"></script>
<script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>-->

<!-- Core plugin JavaScript-->
<!--<script src="vendor/jquery-easing/jquery.easing.min.js"></script>-->

<!-- Custom scripts for all pages-->
<!--<script src="js/sb-admin-2.min.js"></script>-->

<!-- Page level plugins -->
<!--<script src="vendor/chart.js/Chart.min.js"></script>-->

<!-- Page level custom scripts -->
<!--<script src="js/demo/chart-area-demo.js"></script>
<script src="js/demo/chart-pie-demo.js"></script>-->


</body>

</html>
