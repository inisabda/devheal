<nav aria-label="breadcrumb">
  <ol class="breadcrumb bg-light">
    <li class="breadcrumb-item"><a href="./"><i class="fas fa-home"></i> Home</a></li>
    <li class="breadcrumb-item active" aria-current="page"><i class="fas fa-align-left"></i> Form Perawatan</li>
  </ol>
</nav>

<div class="page-content">
  <div class="row">
    <div class="col-6"><h4>Bank Data Pencarian Dan Pendaftaran Pasien</h4></div>
    <div class="col-6 text-right">
      <a href="?page=perawatan">
        <button class="btn btn-sm btn-info">Data Perawatan</button>
      </a>
            <a href="?page=datapasien">
        <button class="btn btn-sm btn-success">Data Pasien</button>
      </a>
    </div>
  </div>

<div class="form-container">
    <div class="row" style="padding: 0 16px;">
        <div class="col-md-12 vertical-form">
            <div class="row data-pengobatan">
                <div class="position-relative form-group col-md-12">
                    <label for="no_daftar" class="">Cari Nama, No. RM, NIK, No. HP (Tekan Enter) </label>
                    <div class="input-group input-group-sm">
                        <div class="col-sm-3">
                            <input type="text" class="form-control form-control-sm" id="search" placeholder="Cari data pasien lama">
                        </div>
                        <a href="?page=tambah_datapasien">
                            <button class="btn btn-sm btn-info">Pendaftaran Pasien Baru</button>
                        </a>
                        &nbsp;&nbsp;
                        <a href="?page=datapasien">
                            <button class="btn btn-sm btn-warning">Master Data Pasien</button>
                        </a>
                    </div>
                </div>
            </div>
            <div class="position-relative form-group col-md-12">
                <ul id="result"></ul>                        
            </div>
        </div>
    </form>
    </div>
    </div>
  </div>
</div>

<script type="text/javascript">
    $(document).ready(function(){                 
         function search(){
              var nama_pas=$("#search").val();
               var nomor_rm=$("#search").val();
               var no_hp=$("#search").val();
               var nik=$("#search").val();

              if(nama_pas!=""){
                $("#result").html("<img src='img/ajax-loader.gif'/>");
                 $.ajax({
                    type:"post",
                    url:"ajax/search.php",
                    data:"nama_pas="+nama_pas+"&nomor_rm="+nomor_rm+"&no_hp="+no_hp+"&nik="+nik,
                    success:function(data){
                        $("#result").html(data);
                        $("#search").val("");
                     }
                  });
              }                     
         }
          $("#button").click(function(){
          	 search();
          });

          $('#search').keyup(function(e) {
             if(e.keyCode == 13) {
                search();
              }
          });
    });
</script>
