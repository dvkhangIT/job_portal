<!DOCTYPE html>
<html class="no-js" lang="en_AU">

<head>
  <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
  <title>CareerVibe | @yield("title")</title>
  <meta name="description" content="" />
  <meta name="viewport"
    content="width=device-width, initial-scale=1, shrink-to-fit=no, maximum-scale=1, user-scalable=no" />
  <meta name="HandheldFriendly" content="True" />
  <meta name="pinterest" content="nopin" />
  <meta name="csrf-token" content="{{ csrf_token() }}" />
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.css" />
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/Trumbowyg/2.27.3/ui/trumbowyg.min.css"
    integrity="sha512-Fm8kRNVGCBZn0sPmwJbVXlqfJmPC13zRsMElZenX6v721g/H7OukJd8XzDEBRQ2FSATK8xNF9UYvzsCtUpfeJg=="
    crossorigin="anonymous" referrerpolicy="no-referrer" />
  <link rel="stylesheet" type="text/css" href="{{ asset("assets/css/style.css") }}" />
  <!-- Fav Icon -->
  <link rel="shortcut icon" type="image/x-icon" href="#" />
</head>

<body data-instant-intensity="mousedown">
  <header>
    <nav class="navbar navbar-expand-lg navbar-light bg-white py-3 shadow">
      <div class="container">
        <a class="navbar-brand" href="{{ route("home") }}">CareerVibe</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent"
          aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>
        <div class="navbar-collapse collapse" id="navbarSupportedContent">
          <ul class="navbar-nav ms-sm-0 mb-lg-0 ms-lg-4 mb-2 me-auto ms-0">
            <li class="nav-item">
              <a class="nav-link" aria-current="page" href="{{ route("home") }}">Home</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" aria-current="page" href="jobs.html">Find Jobs</a>
            </li>
          </ul>
          @if (!Auth::check())
            <a class="btn btn-outline-primary me-2" href="{{ route("account.login") }}" type="submit">Login</a>
          @else
            <a class="btn btn-outline-primary me-2" href="{{ route("account.profile") }}" type="submit">Account</a>
          @endif
          <a class="btn btn-primary" href="post-job.html" type="submit">Post a Job</a>
        </div>
      </div>
    </nav>
  </header>
  @yield("main")
  <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title pb-0" id="exampleModalLabel">Change Profile Picture</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <form>
            <div class="mb-3">
              <label for="exampleInputEmail1" class="form-label">Profile Image</label>
              <input type="file" class="form-control" id="image" name="image">
            </div>
            <div class="d-flex justify-content-end">
              <button type="submit" class="btn btn-primary mx-3">Update</button>
              <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            </div>

          </form>
        </div>
      </div>
    </div>
  </div>

  <footer class="bg-dark bg-2 py-3">
    <div class="container">
      <p class="fw-bold fs-6 pt-3 text-center text-white">© 2023 xyz company, all right reserved</p>
    </div>
  </footer>
  <script src="{{ asset("assets/js/jquery-3.6.0.min.js") }}"></script>
  <script src="{{ asset("assets/js/bootstrap.bundle.5.1.3.min.js") }}"></script>
  <script src="{{ asset("assets/js/instantpages.5.1.0.min.js") }}"></script>
  <script src="{{ asset("assets/js/lazyload.17.6.0.min.js") }}"></script>
  <script src="{{ asset("assets/js/slick.min.js") }}"></script>
  <script src="{{ asset("assets/js/lightbox.min.js") }}"></script>
  <script src="{{ asset("assets/js/custom.js") }}"></script>
  <script>
    $.ajaxSetup({
      headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
      }
    });
  </script>
  @yield("customJs")
</body>

</html>
