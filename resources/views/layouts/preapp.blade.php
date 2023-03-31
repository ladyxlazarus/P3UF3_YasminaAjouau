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
      <div id="title">
        <span>StuEvento APP Back Barcelona</span>
      </div>
  </header>

  @yield('content')
  @yield('scripts')
</body>
</html>

<style>
#title{
    width: 100%;
    text-align: center;
    font-weight: 900;
    margin-block: 2em;
    font-size: x-large;
}
</style>