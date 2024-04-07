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
                        <!-- Project Card Example -->
                        <div class="card shadow mb-4">
                            <div class="card-body">
                                    <div class="row ml-1">
                                    <div class="mt-2">
                                            <button type="button" class="btn btn-primary ml-4 mt-4" data-toggle="modal" data-target="#exampleModal" onclick="ajouter()">
                                                Ajouter
                                            </button>
                                        </div>
                                        <div class="mt-2">
                                            <button type="button" class="btn btn-primary ml-4 mt-4" data-toggle="modal" data-target="#exampleModal" onclick="supprimer()">
                                                Supprimer
                                            </button>
                                        </div>
                                        <div class="form-group w-50">
                                            <!-- <label for="departement">Departement</label> -->
                                            <!-- <select type="hidden" class="form-control" id="departement" name="departement">
                                                    <option  value="{{ $depart }}"></option>
                                            </select> -->
                                            <input type="hidden" value="{{ $depart }} " id="departement" name="departement">
                                        </div>     
                                    </div>
                                    <div class="row ml-1" id="container_r">
                                        <div id="container_i">
                                            <div class="form-group col-10">
                                                <label for="article">Materiel</label>
                                                <select class="form-control" id="article" name="article[]">
                                                    @foreach($materiels as $materiel)
                                                        <option value="{{ $materiel->id }}">{{ $materiel->nom }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                            <div class="form-group col-10">
                                                <label for="quantite">Quantite</label>
                                                <input type="number" class="form-control" min="1" id="quantite" name="quantite[]" required>
                                            </div>
                                        </div>
                                    </div>
                                    <button type="button" class="btn btn-success" onclick="envoyer()">Envoyer</button>
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

<script>
    function ajouter() {
        var container = document.querySelector('#container_r');
        var container_i = document.querySelector('#container_i');
        var clone = container_i.cloneNode(true);
        container.appendChild(clone);
    }

    function supprimer() {
        var container = document.querySelector('#container_r');
        var container_i = document.querySelector('#container_i');
        var clone = container_i.cloneNode(true);
        if(container.childElementCount > 1){
            container.removeChild(container.lastChild);
        }else{
            alert("Vous ne pouvez pas supprimer le dernier element");
        }
    }

    function envoyer() {
        var article = document.getElementsByName('article[]');
        var quantite = document.getElementsByName('quantite[]');
        var departement = document.getElementById('departement').value;
        if(quantite.length < 1){
            alert("Vous devez ajouter au moins un article");
        }else{
            for(var i = 0; i < quantite.length; i++){
                if(quantite[i].value < 1){
                    alert("La quantite doit etre superieur a 0");
                    break;
                }
            }
        }
        article = Array.from(article).map(el => el.value);
        quantite = Array.from(quantite).map(el => el.value);
        var inputData = {
            '_token': '{{ csrf_token() }}',
            'id_departement': departement,
            'id_article': article,
            'quantite': quantite
        };
        var jsonData = JSON.stringify(inputData);
        $.ajax({
            url: "{{ url('/demander') }}",
            type: "POST",
            data: jsonData,
            contentType: "application/json",
            dataType: "json",
            success: function (data) {
                alert("Demande envoyee");
            },
            error: function (data) {
                alert("Erreur");
            }
        });
        location.reload();
    }


</script>

</body>

</html>
