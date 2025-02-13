<!doctype html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Hachikoservice</title>
  <script src="https://code.jquery.com/jquery-3.6.3.js"></script>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.3.0/css/all.min.css" />
  <style>
    @import url('https://fonts.googleapis.com/css2?family=Arial&display=swap');

    * {
      margin: 0;
      padding: 0;
      box-sizing: border-box;
      font-family: Arial, sans-serif;
    }

    body {
      background-image: url('{{ asset("image/background_login.jpg") }}');
      background-repeat: no-repeat;
      background-position: center;
      background-attachment: fixed;
      background-size: cover;
    }

    .container {
      margin-top: 16rem !important;
    }

    .card {
      border-radius: 10px;
      background-color: rgba(255, 255, 255, 0.9);
    }

    .btn-primary_1 {
      background-color: #ce0000;
      color: white;
    }

    .btn-primary_1:hover {
      background-color: #ab0202;
    }

    .copyright {
      color: white;
      font-size: 12px;
      margin-top: 2rem;
    }

    .footer-icons a {
      margin: 0 10px;
      color: white;
    }

    .footer-icons a:hover {
      color: #007bff;
    }

    .fa-youtube {
      color: red;
    }

    .fa-youtube:hover {
      color: #ab0202;
    }

    .fa-facebook {
      color: #007bff;
    }

    .fa-facebook:hover {
      color: #0064cf;
    }

    /* Đoạn CSS cơ bản cho thông báo */
    .alert {
      padding: 15px;
      background-color: #4caf50;
      /* Màu nền xanh lá cây */
      color: white;
      /* Màu chữ trắng */
      margin-bottom: 15px;
    }

    .alert.success {
      background-color: #4caf50;
    }

    /* Màu nền xanh lá cây */
  </style>
</head>

<body>

@if($errors->has('useraccount'))
 <div class="alert alert-danger">
   {{ $errors->first('useraccount') }}
  </div>
@endif

  <a style="display:none" id="myid" href="#" target="_top">Link</a>

  <!-- Login Form -->
  <div id="pageA">
    <div class="container">
      <div class="col-md-6 mx-auto card shadow">
        <div class="card-body p-4 text-center">
          <img src="https://hachikoservice.com/wp-content/uploads/2024/03/%E3%80%90JP%E3%80%91HACHIKOSERVICE-2-2048x593.png" height="125px" width="420px" class="w-80" alt="Logo"><br>
          <form method="POST" action="{{ route('admin.login.submit') }}">
            @csrf
            <div class="form-floating mb-3">
              <input type="text" class="form-control" id="useraccount" name="useraccount" placeholder="Tài khoản" required>
              <label for="useraccount"><i class="fa-solid fa-circle-user"></i> Tài khoản</label>
            </div>
            <div class="form-floating mb-3">
              <input type="password" class="form-control" id="password" name="password" placeholder="Mật khẩu" required>
              <label for="password"><i class="fa-solid fa-lock"></i> Mật khẩu</label>
            </div>
            <button type="submit" class="btn btn-primary_1 btn-lg w-100"><i class="fa-solid fa-right-to-bracket me-2"></i>Đăng nhập</button>
          </form>
        </div>
      </div>
    </div>
  </div>

  <!-- Footer -->
  <div class="copyright text-center">
    <div class="footer-icons">
      <a href="https://www.youtube.com/@hachikoservice" target="_blank">
        <i class="fa-brands fa-youtube fa-2x"></i>
      </a>
      <a href="https://www.facebook.com/hachikonetwork" target="_blank">
        <i class="fa-brands fa-facebook fa-2x"></i>
      </a>
    </div>
    <p>
      <a style="color:#c9c7c7;text-decoration:none" href="https://hachikoservice.com/" target="_blank">
        Hachikoservice.com
      </a> &copy; 2024 Phần mềm quản lý
    </p>
  </div>

  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
  <script>
    // Set Footer Content
    window.onload = () => {
      document.body.style.zoom = "94%"; // Adjust zoom for better visibility
    };
  </script>
</body>

</html>