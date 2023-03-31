<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <title>StuEvento APP Back Barcelona</title>
  <!-- jQuery -->
  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.6.0/js/bootstrap.min.js"></script>
  <!-- CSS de Bootstrap -->
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
  <!-- FontAwesome -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.2/css/all.min.css">
  <!-- JavaScript de Bootstrap -->
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>


</head>

<body>
  <header>
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
      <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav mx-auto">
        <li class="nav-item">
            <a class="nav-link" href="{{ route('events.index') }}">Listar eventos</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="{{ route('events.create') }}">Añadir evento</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="{{ route('logout') }}">Log out</a>
          </li>
        </ul>
      </div>
    </nav>
  </header>

  @yield('content')
  @yield('scripts')
</body>

</html>

<style>
  .nav-link:hover {
    font-weight: 700;
  }

  .footer-text {
    color: darkgray;
    position: absolute;
    right: 20px;
    font-style: italic;
  }
</style>