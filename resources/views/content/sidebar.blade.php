 <!-- Sidebar -->
 <ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

    <!-- Sidebar - Brand -->
    <a class="sidebar-brand d-flex align-items-center justify-content-center" href="index.html">
        <div class="sidebar-brand-icon rotate-n-15">
            <i class="fas fa-laugh-wink"></i>
        </div>
        <div class="sidebar-brand-text mx-3">SB Admin <sup>2</sup></div>
    </a>

    <!-- Divider -->
    <hr class="sidebar-divider my-0">

    <!-- Heading -->
@if($fonction ==2)
    <div class="sidebar-heading">
        {{$nom_profil}}
        {{$fonction}}
    </div>
    <li class="nav-item">
        <a class="nav-link" href="{{ url('/demande') }}">
            <i class="fas fa-fw fa-table"></i>
            <span>Demande</span></a>
    </li>

    <li class="nav-item">
        <a class="nav-link" href="{{ url('/liste') }}">
            <i class="fas fa-fw fa-table"></i>
            <span>Liste Demande</span></a>
    </li>

    <li class="nav-item">
       <a class="nav-link" href="{{ url('/proforma') }}">
       <i class="fas fa-fw fa-table"></i>
       <span>Proforma</span></a>
   </li>
   <li class="nav-item">
       <a class="nav-link" href="{{ url('/listbondecommande') }}">
       <i class="fas fa-fw fa-table"></i>
       <span>Bon de commande</span></a>
   </li>
        <li class="nav-item">
        <a class="nav-link" href="{{ url('/listbondereception') }}">
        <i class="fas fa-fw fa-table"></i>
        <span>Bon de reception</span></a>
    </li>
</li>
<li class="nav-item">
<a class="nav-link" href="{{ url('/depot') }}">
<i class="fas fa-fw fa-table"></i>
<span>Depot</span></a>
</li>
</ul>

@elseif($fonction == 4)
    <div class="sidebar-heading">
        {{$nom_profil}}
    </div>
    <li class="nav-item">
        <a class="nav-link" href="{{ url('/demande') }}">
            <i class="fas fa-fw fa-table"></i>
            <span>Demande</span></a>
    </li>

    <li class="nav-item">
        <a class="nav-link" href="{{ url('/liste') }}">
            <i class="fas fa-fw fa-table"></i>
            <span>Liste Demande</span></a>
    </li>
</ul>
@elseif($fonction == 3)
<div class="sidebar-heading">
        {{$nom_profil}}
    </div>
    <li class="nav-item">
        <a class="nav-link" href="{{ url('/demande') }}">
            <i class="fas fa-fw fa-table"></i>
            <span>Demande</span></a>
    </li>
    <li class="nav-item">
       <a class="nav-link" href="{{ url('/listbondecommande') }}">
       <i class="fas fa-fw fa-table"></i>
       <span>Bon de commande</span></a>
   </li>
</ul>
@else
<div class="sidebar-heading">
        {{$nom_profil}}
    </div>
    <li class="nav-item">
        <a class="nav-link" href="{{ url('/demande') }}">
            <i class="fas fa-fw fa-table"></i>
            <span>Demande</span></a>
    </li>
</ul>

@endif
<!-- End of Sidebar -->
