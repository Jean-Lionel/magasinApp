<!doctype html>
<html lang="en">
<head>
 <title>GESTION MAGASIN</title>
 <meta charset="utf-8">
 <meta name="csrf-token" content="{{ csrf_token() }}">
 <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

 <link href="https://fonts.googleapis.com/css?family=Poppins:300,400,500,600,700,800,900" rel="stylesheet">

 <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
 <link rel="stylesheet" href="{{ asset('css/style.css') }}">
</head>
<body>

  <div class="wrapper d-flex align-items-stretch">
   <nav id="sidebar" class="active">
    <h1><a href="" class="logo">M.</a></h1>
    <ul class="list-unstyled components mb-5">

      <li>
        <a href="{{ route('ventes.index') }}"><span class="fa fa-shopping-cart"></span> Vente</a>
      </li>

      <li class="active">
        <a href="{{ route('products.create') }}"><span class="fa fa-product-hunt"></span> Entre</a>
      </li>
      <li>
        <a href="{{ route('products.index') }}"><span class="fa fa-sticky-note"></span> Stock</a>
      </li>
      <li>
        <a href="#"><span class="fa fa-cogs"></span> Services</a>
      </li>
      <li>
        <a href="{{ route('stockes.journal') }}"><span class="fa fa-calendar"></span> Journal</a>
      </li> 

      <li>
        <a href="{{ route('categories.index') }}"><span class="fa fa-paper-plane"></span> Category</a>
      </li>
    </ul>

    <div class="footer">

    </div>
  </nav>

  <!-- Page Content  -->
  <div id="content" class="p-0 p-md-6">

    <nav class="navbar navbar-expand-lg navbar-light bg-light">
      <div class="container-fluid">

        <button type="button" id="sidebarCollapse" class="btn btn-primary">
          <i class="fa fa-bars"></i>
          <span class="sr-only">Toggle Menu</span>
        </button>
        <button class="btn btn-dark d-inline-block d-lg-none ml-auto" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
          <i class="fa fa-bars"></i>
        </button>

        <div class="collapse navbar-collapse" id="navbarSupportedContent">
          <ul class="nav navbar-nav ml-auto">
            <li class="nav-item">

              <a href="{{ route('panier.index') }}" class="btn btn-primary">
               
                <i class="fa fa-shopping-cart text-lg-center"></i> <span class="badge badge-light">{{ Cart::count()}}</span>
             
            </a>

          </li>
          <li class="nav-item active">
            <a class="nav-link" href="#">Home</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="{{ route('products.index') }}">Produit</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="{{ route('clients.index') }}">Client</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="{{ route('stockes.index') }}">Stocke</a>
          </li>
        </ul>
      </div>
    </div>
  </nav>

  <div class="container-fluid">

    <div>
      @if (session('success'))
      {{-- expr --}} 

      <div class="alert alert-warning alert-dismissible fade show" role="alert">
        <strong>SUCCESS</strong> {{ session('success')}}
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      @endif


      @if (session('error'))
      {{-- expr --}} 

      <div class="alert alert-danger alert-dismissible fade show" role="alert">
        <strong>SUCCESS</strong> {{ session('success')}}
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      @endif
    </div>

    @yield('content')
  </div>



</div>
</div>


<script src="//code.jquery.com/jquery-3.5.1.min.js"></script>
<script src="{{ asset('js/popper.js') }}"></script>
<script src="{{ asset('js/bootstrap.min.js') }}"></script>


<script src="{{ asset('js/main.js') }}"></script>


@yield('javascript')

</body>
</html>