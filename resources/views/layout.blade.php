<!DOCTYPE html>
<html>
<head>
    <title>@yield('title')</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    <style>
      .btn-primary {
        background-color: #36B37E;
        color: black;
        border-color: #36B37E;
      }

      .btn-primary:hover {
        background-color: hsl(155, 54%, 50%);
        color: black;
        border-color: hsl(155, 54%, 50%);
      }
      .container-button {
        text-align: center;
      }
      .error {
        color: red;
        font-size: 12px;
      }

      .custom-file-label::after {
        content: "Parcourir";
      }
    </style>
</head>
<body>
    {{-- <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarSupportedContent">
          <ul class="navbar-nav mr-auto">
            <li class="nav-item @if (request()->routeIs('assos.create')) active @endif">
              <a class="nav-link" href="{{ route('assos.create') }}">Associations</a>
            </li>
            <li class="nav-item @if (request()->routeIs('sites.create')) active @endif">
              <a class="nav-link" href="{{ route('sites.create') }}">Sites</a>
            </li>
          </ul>
        </div>
      </nav> --}}
    <div class="container mt-4">
        @yield('content')
    </div>
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ho+j7jyWK8fNQe+A12Hb8AhRq26LrZ/JpcUGGOn+Y7RsweNrtN/tE3MoK7ZeZDyx" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

    @yield('js')
</body>
</html>
