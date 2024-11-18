<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

    <title>PMB STKIP PGRI Pacitan</title>
  </head>
  
  <style>
      .bg {
          background-color: #d2d6de;
      }
  </style>
  
  <body class="bg">
    <div class="container">
        <div class="row justify-content-center">
            <h4 class="text-center my-4">TERIMA KASIH</h4>
            <!--<p class=".col-md-6 .col-md-offset-3 text-center">Anda Telah Melakukan Pendaftaran Di STKIP PGRI Pacitan. Tahap Selanjutnya, Mohon Menunggu Konfirmasi WhatsApp Dari Admin PMB (Penerimaan Mahasiswa Baru) Melalui Nomor 0877-5511-5100</p>-->
            <h4 class="text-center my-4">PENTING - SILAHKAN SCREENSHOT TAMPILAN INI<br>Pembayaran Mahasiswa Baru</h4>
            <p class=".col-md-6 .col-md-offset-3 text-center">Terimakasih Telah Mendaftar Sebagai Calon Mahasiswa Baru STKIP PGRI Pacitan. Untuk Melanjutkan Tahapan Pendaftaran Silahkan Melakukan Pembayaran Menggunakan Kode BRIVA(BRI Virtual Account) Yang Tertera. Nomor BRIVA Hanya Berlaku 1 x 24 Jam.</p>
            
            <div class="col-md-6">
                <div class="card">
                    <div class="card-body table-responsive">
                      <table class="table table-borderless">
                        
                        <tbody>
                          <tr>
                            <th scope="row">No Briva</th>
                            <td>
                              <input type="text" value="{{ $transaction->briva }}" id="copyText" readonly>
                            </td>
                          </tr>
                          <tr>
                            <td colspan="2" style="text-align: center;">
                              <button id="copyBtn">
                                Copy BRIVA
                              </button>
                            </td>
                          </tr>
                          <tr>
                            <th scope="row">Nama</th>
                            <td>{{ $transaction->user->name }}</td>
                            
                          </tr>
                          <tr>
                            <th scope="row">Nisn</th>
                            <td>{{ $transaction->user->nisn }}</td>
                           
                          </tr>
                          <tr>
                            <th scope="row">No Pendaftaran</th>
                            <td colspan="2">{{ $transaction->no_transaksi }}</td>
                          </tr>
                          <tr>
                            <th scope="row">Nominal Pembayaran</th>
                            <td>{{ moneyFormat($transaction->nominal) }}</td>
                           
                          </tr>
                          <tr>
                            <th scope="row">Status</th>
                            <td>Pending</td>
                           
                          </tr>
                        </tbody>
                      </table>
                      {{-- <div class="mb-3 row">
                        <label for="staticEmail" class="col-sm-2 col-form-label"></label>
                        <div class="col-sm-10">
                          <input type="text" readonly class="form-control-plaintext" id="staticEmail" value="{{ $transaction->user->name }}">
                        </div>
                      </div>
                      <div class="mb-3 row">
                        <label for="staticEmail" class="col-sm-2 col-form-label"></label>
                        <div class="col-sm-10">
                          <input type="text" readonly class="form-control-plaintext" id="staticEmail" value="{{ $transaction->user->nisn }}">
                        </div>
                      </div>
                      <div class="mb-3 row">
                        <label for="staticEmail" class="col-sm-2 col-form-label">No Pendaftaran</label>
                        <div class="col-sm-10">
                          <input type="text" readonly class="form-control-plaintext" id="staticEmail" value="{{ $transaction->no_transaksi }}">
                        </div>
                      </div>
                      <div class="mb-3 row">
                        <label for="staticEmail" class="col-sm-2 col-form-label">Nominal Pembayaran</label>
                        <div class="col-sm-10">
                          <input type="text" readonly class="form-control-plaintext" id="staticEmail" value="{{ moneyFormat($transaction->nominal) }}">
                        </div>
                      </div>
                      <div class="mb-3 row">
                        <label for="staticEmail" class="col-sm-2 col-form-label">Briva</label>
                        <div class="col-sm-10">
                          <input type="text" readonly class="form-control-plaintext" id="staticEmail" value="{{ $transaction->briva }}">
                        </div>
                      </div> --}}
                  </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Optional JavaScript; choose one of the two! -->

    <!-- Option 1: Bootstrap Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>

    <!-- Option 2: Separate Popper and Bootstrap JS -->
    <!--
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous"></script>
    -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
    <script>
            const copyBtn = document.getElementById('copyBtn')
            const copyText = document.getElementById('copyText')
            
            copyBtn.onclick = () => {
                copyText.select();    // Selects the text inside the input
                document.execCommand('copy');    // Simply copies the selected text to clipboard 
                 Swal.fire({         //displays a pop up with sweetalert
                    icon: 'success',
                    title: 'BRIVA Berhasil Di Copy',
                    showConfirmButton: false,
                    timer: 1000
                });
            }
        </script>
  </body>
</html>