<!DOCTYPE html>
<html lang="en">

<head>

  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">

  <title>Cek Barang</title>

  <!-- Bootstrap core CSS-->
  <link href="css/bootstrap.min.css" rel="stylesheet">

  <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.6.3/css/all.css" integrity="sha384-UHRtZLI+pbxtHCWp1t77Bi1L4ZtiqrqD80Kn4Z8NTSRyMA2Fd33n5dQ8lWUE00s/" crossorigin="anonymous">

  <!-- Custom styles for this template-->
  <link href="css/sb-admin.css" rel="stylesheet">

</head>

<body id="page-top" class="bg-dark">
  <br><br>
  <div class="row">
    <div class="col-md-2"></div>

    <div class="col-md-4">
      <div class="card border-info">
        <div class="card-header text-center">Cek Barang</div>
        <div class="card-body">
          <div class="card border-info">
            <div class="card-body">

              <div class="row">
                          <div class="col-md-12">
                        <img src="img/encomp.png" class="rounded mx-auto d-block form-control"  alt="Logo">
                        </div>
                      </div>
              <br>
              <form id="form_login" method="post" action="user/process/cekbarang.php">
                <input type="text" class="form-control" name="kode" id="kode" maxlength="15" placeholder="Masukkan kode anda..." required="">
                <br>
                <button type="submit" class="btn btn-info">Cek</button>
                <br><br>
              </form>
            </div>
          </div>
        </div>
      </div>
    </div>

    <div class="col-md-4">
      <div class="card border-info">
        <div class="card-header text-center">Keterangan Barang</div>
        <div class="card-body">
          <div class="card border-info">
            <div class="card-body">

              <?php 
              if (isset($_GET['msg'])) {                       
                if ($_GET['msg'] == "notfound") { 
                  $ket="Barang dengan kode tersebut tidak ditemukan."?>
                  <div class="alert alert-info" role="alert">
                    Barang dengan kode tersebut tidak ditemukan.
                  </div>  
                <?php    }
              }
              if (isset($_GET['id'])) {
                $ket="Kode : ".$_GET['id']."\nNama Barang : ".$_GET['n']."\nTanggal Masuk : ".$_GET['tm']."\nStatus : ".$_GET['s']."\nTotal Biaya: Rp. ".number_format($_GET['tb'],0,",",".");
              }
              ?>
              <div class="form-group">
                <label for="comment">Keterangan:</label>
                <textarea class="form-control" rows="6" id="comment" disabled=""><?php if (isset($ket)){echo$ket;} ?></textarea>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    
    <div class="com-md-2"></div>
  </div>
</div>



<!-- Bootstrap core JavaScript-->
<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>

</body>

</html>
