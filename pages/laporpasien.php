<link rel="stylesheet" href="asset/datepicker/datepicker.min.css">
<nav aria-label="breadcrumb">
  <ol class="breadcrumb bg-light">
    <li class="breadcrumb-item"><a href="./"><i class="fas fa-home"></i> Home</a></li>
    <li class="breadcrumb-item active" aria-current="page"><i class="fas fa-align-left"></i> Laporan Kunjungan Pasien</li>
  </ol>
</nav>
<div class="page-content">
  <div class="row">
    <div class="col-6">
      <h4>Laporan Kunjungan Pasien Per Bulan</h4>
    </div>
    <div class="col-6 text-right">
      <button class="btn btn-sm btn-warning" onclick="goBack()"><i class="fas fa-undo"></i> Kembali</button>
    </div>
  </div>
    <?php
      $hari_ini = date("d-m-Y");
      $hari_sem = date("01-m-Y");
    ?>
  <form role="form" class="form-horizontal" method="GET" action="laporan/cetakpasien.php" target="_blank">
    <div class="row data-tindakan">
      <div class="position-relative form-group col-md-2">
        <label for="dokter" class="">Tanggal Awal </label>
        <div class="input-group input-group-sm">
            <input type="text" value="<?php echo $hari_sem; ?>" class="form-control datepicker" data-date-format="dd-mm-yyyy" name="tgl_awal" autocomplete="off" required>
        </div>
      </div>
      <div class="position-relative form-group col-md-2">
        <label for="no_daftar" class="">Tanggal Akhir </label>
        <div class="input-group input-group-sm">
            <input  type="text" value="<?php echo $hari_ini; ?>" class="form-control datepicker" data-date-format="dd-mm-yyyy" name="tgl_akhir" autocomplete="off" required>
        </div>
      </div>
      <div class="position-relative form-group col-md-2">
        <label for="asuransi_pas" class="">Cara Bayar / Insurance </label>
        <div class="input-group input-group-sm">
          <select name="asuransi" class="form-control form-control-sm">
            <?php
            //query menampilkan cara bayar ke dalam combobox
            $query    =mysqli_query($conn, "SELECT * FROM cara_bayar");
            while ($dataku = mysqli_fetch_array($query)) {
            ?>
            <option value="<?=$dataku['cara_bayar'];?>"><?php echo $dataku['cara_bayar'];?></option>
            <?php } ?>
          </select>
        </div>        
      </div>
      <div class="position-relative form-group col-md-2">
        <label for="no_daftar" class="">Cetak</label>
        <div class="input-group input-group-sm">
          <button type="submit" class="btn btn-primary btn-submit btn-sm">
            <i class="fa fa-print"></i> Cetak
          </button>
        </div>
      </div>
    </div>
  </form>
</div>

<script src="asset/datepicker/bootstrap-datepicker.min.js"></script>
<script type="text/javascript">
 $(function(){
  $(".datepicker").datepicker({
      format: 'dd-mm-yyyy',
      autoclose: true,
      todayHighlight: true,
  });
 });
 function goBack() {
        window.history.back();
    }
</script>