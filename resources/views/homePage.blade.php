<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <title>PMB STKIP PGRI PACITAN</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="{{ asset('assets/bower_components/font-awesome/css/font-awesome.min.css') }}">
    <link rel="icon" href="https://pmb.demoo.net/assets/img/stkip.png" type="image/png">
    <link rel="stylesheet" href="{{ asset('zenTheme/css/login.cs') }}s">
    <link rel="stylesheet" href="{{ asset('zenTheme/css/materialdesignicons.css') }}">
    <link rel="stylesheet" href="{{ asset('zenTheme/css/bootsrtap.css') }}">
    <link href="https://fonts.googleapis.com/css?family=Quicksand" rel="stylesheet">
    <link rel="icon" type="image/x-icon" href="{{ asset('assets/img/stkip.png') }}">

    <link type='text/css' href="{{ asset('zenTheme/css/siteman.css') }}" rel='Stylesheet' />
    <link rel="shortcut icon" href="{{ asset('zenTheme/images/logo.png') }}" />

    <style>
        @media (max-width:800px) {
            .img-stat {
                display: none;
            }
        }

        .login-form .form-control {
            margin-bottom: 0px !important;
            padding: 0px !important;
            border-radius: 10px !important;
            min-height: 10px !important;
            font-size: 12px !important;
        }

        .login-card .login-btn {
            font-size: 14px !important;
            line-height: 10px !important;
        }

        .login-card-description {
            font-size: 16px !important;
        }

        .login-card .card-body {
            padding: 30px 40px 10px;
        }

        label {
            font-size: 14px !important;
            margin-bottom: 0px !important;
        }

        .blink {
            animation: blink 3s infinite;
        }

        @keyframes blink {
            0% {
                opacity: 1;
            }

            50% {
                opacity: 0;
            }

            100% {
                opacity: 1;
            }
        }
    </style>
</head>

<body>
    <main class="d-flex align-items-center min-vh-100 py-3 py-md-0 mt-4">
        <div class="container">
            <div class="card login-card">
                <div class="row no-gutters">
                    <div class="col-md-7">
                        <img style="width: 620px; height: 620px;" class="mx-auto img-fluid img-stat"
                            src="{{ isset($photoFront) ? asset('storage/' . $photoFront) : asset('assets/img/daftardepan.jpg') }}"
                            alt="login" class="login-card-img">
                    </div>
                    <div class="col-md-5">
                        <div class="card-body">
                            <div class="brand-wrapper">
                                <div align="center"><img src="{{ asset('assets/img/stkip.png') }}" width="70px"
                                        alt="" border="0" class="logo"></div>
                            </div>
                            <p class="login-card-description"><a href="#">STKIP PGRI PACITAN</a></p>
                            <p class="text-center blink" style="color: red !important; font-size: 14px !important;">
                                Silahkan Masukkan Biodata Anda Dengan Menggunakan Huruf Besar !
                            </p>
                            @if ($isOpen)
                            <form class="login-form" action="{{ route('register.mahasiswa') }}" method="POST">
                                @csrf
                                <div class="mb-2">
                                    <label for="exampleFormControlInput1" class="form-label">NISN </label>
                                    <input type="number" class="form-control  @error('nisn') is-invalid @enderror "
                                        value="{{ old('nisn') }}" name="nisn" placeholder="Masukan Nisn">
                                    @error('nisn')<span class="help-block text-danger">{{ $message }}</span>@enderror
                                </div>
                                <div class="mb-2">
                                    <label for="exampleFormControlInput1" class="form-label">NAMA LENGKAP </label>
                                    <input type="text" class="form-control @error('name') is-invalid @enderror"
                                        value="{{ old('name') }}" name="name" placeholder="Masukan Nama">
                                    @error('name')<span class="help-block text-danger">{{ $message }}</span>@enderror
                                </div>
                                <div class="mb-2">
                                    <label for="exampleFormControlInput1" class="form-label">NO WhatsApp (Contoh
                                        6281234567890) </label>
                                    <input type="number" class="form-control @error('phone') is-invalid @enderror"
                                        value="{{ old('phone') }}" name="phone" placeholder="Masukan No WhatsApp">
                                    @error('phone')<span class="help-block text-danger">{{ $message }}</span>@enderror
                                </div>
                                <div class="mb-2">
                                    <label for="exampleFormControlInput1" class="form-label">EMAIL </label>
                                    <input type="email" class="form-control @error('email') is-invalid @enderror"
                                        name="email" value="{{ old('email') }}" placeholder="Masukan Email">
                                    @error('email')<span class="help-block text-danger">{{ $message }}</span>@enderror
                                </div>
                                <div class="form-group mb-2 @error('gelombang_id') has-error @enderror ">
                                    <label for="exampleInputPassword1">Gelombang Pendaftaran</label>
                                    <select name="gelombang_id" class="form-control" id="">
                                        <option value="">Pilih Gelombang Pendaftaran</option>
                                        @foreach ($gelombangs as $gelombang)
                                            <option value="{{ $gelombang->id }}">{{ $gelombang->nama }}</option>
                                        @endforeach
                                    </select>
                                    @error('gelombang_id')<span class="help-block text-danger">{{ $message }}</span>@enderror
                                    @error('nisn_gelombang')<span class="help-block text-danger">{{ $message }}</span>@enderror
                                </div>
                                <button class="btn btn-block login-btn mb-2" type="submit" name="submit"
                                    value="submit">
                                    DAFTAR
                                </button>
                            </form>
                            @endif
                            <p>Sudah Mendaftar ? <a href="{{ route('login') }}">Login</a></p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="credit">
                <p>PMB STKIP PACITAN v2.0</p>
            </div>
        </div>
    </main>
    <a style="  position:fixed;
  width:60px;
  height:60px;
  bottom:40px;
  right:40px;
  background-color:#25d366;
  color:#FFF;
  border-radius:50px;
  text-align:center;
  font-size:30px;
  box-shadow: 2px 2px 3px #999;
  z-index:100;"
        href="https://wa.me/6287755115100" target="_blank">
        <i style="margin-top:16px;" class="fa fa-whatsapp"></i>
    </a>
    <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"></script>
</body>

</html>
