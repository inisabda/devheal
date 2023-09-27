<style>
	.card {
  border-radius: 1rem;
}

.rounded-2 {
  border-radius: 1rem !important;
}

.feature-icon-1 {
  display: inline-flex;
  align-items: center;
  justify-content: center;
  width: 5rem;
  height: 5rem;
  font-size: 3rem;
  color: #fff;
  border-radius: 100%;
}

.feature-icon-2 {
  display: inline-flex;
  align-items: center;
  justify-content: center;
  width: 7rem;
  height: 7rem;
  font-size: 4rem;
  color: #fff;
  border-radius: 100%;
}

.feature-icon-3 {
  display: inline-flex;
  align-items: center;
  justify-content: center;
  width: 5rem;
  height: 5rem;
  font-size: 3.5rem;
  color: #fff;
  border-radius: 100%;
}
</style>
<!-- <link href="https://fonts.googleapis.com/css?family=Raleway:100,200,300,400,500,600,700,800,900&amp;display=swap" rel="stylesheet"> -->
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css">
<!-- <link rel="stylesheet" href="assets/css/style.css"> -->

<div class="page-content">
	<div class="row">
		<!-- menampilkan informasi jumlah antrian -->
    <div class="col-md-3 mb-4">
      <div class="card border-0 shadow-sm">
        <div class="card-body p-3">
          <div class="d-flex justify-content-start">
            <div class="feature-icon-3 me-4">
              <i class="bi-people text-warning"></i>
            </div>
            <div>
              <p id="jumlah-antrian" class="fs-3 text-warning mb-1"></p>
              <p class="mb-0">Jumlah Antrian</p>
            </div>
          </div>
        </div>
      </div>
    </div>
    <!-- menampilkan informasi nomor antrian yang sedang dipanggil -->
    <div class="col-md-3 mb-4">
      <div class="card border-0 shadow-sm">
        <div class="card-body p-3">
          <div class="d-flex justify-content-start">
            <div class="feature-icon-3 me-4">
              <i class="bi-person-check text-success"></i>
            </div>
            <div>
              <p id="antrian-sekarang" class="fs-3 text-success mb-1"></p>
              <p class="mb-0">Antrian Sekarang</p>
            </div>
          </div>
        </div>
      </div>
    </div>
    <!-- menampilkan informasi nomor antrian yang akan dipanggil selanjutnya -->
    <div class="col-md-3 mb-4">
      <div class="card border-0 shadow-sm">
        <div class="card-body p-3">
          <div class="d-flex justify-content-start">
            <div class="feature-icon-3 me-4">
              <i class="bi-person-plus text-info"></i>
            </div>
            <div>
              <p id="antrian-selanjutnya" class="fs-3 text-info mb-1"></p>
              <p class="mb-0">Antrian Selanjutnya</p>
            </div>
          </div>
        </div>
      </div>
    </div>
    <!-- menampilkan informasi jumlah antrian yang belum dipanggil -->
    <div class="col-md-3 mb-4">
      <div class="card border-0 shadow-sm">
        <div class="card-body p-3">
          <div class="d-flex justify-content-start">
            <div class="feature-icon-3 me-4">
              <i class="bi-person text-danger"></i>
            </div>
            <div>
              <p id="sisa-antrian" class="fs-3 text-danger mb-1"></p>
              <p class="mb-0">Sisa Antrian</p>
            </div>
          </div>
        </div>
      </div>
    </div>
		<div class="col-8" id="judul"><h4>Data Rawat Pasien Hari Ini (<font color="#FF0000"><?php echo $_SESSION['nama_peg']; ?></font>)</h4></div>
		<div class="col-4 text-right">
			<a href="?page=pendaftaran">
				<button class="btn btn-sm btn-warning">Pendaftaran Pasien</button>
			</a>
		</div>
		
	<marquee><i>Silahkan isi data pemeriksaan pada form Assesment (Diagnosa wajib sebagai acuan laporan data), form e-Resep, form Tindakan dan Laborat ...</marquee>
	</div>
	<div class="table-container">
    <div class="row" style="padding: 0 16px;">
      <div class="col-md-12 vertical-form table-responsive"><br>
    		<table id="daftar" class="table table-hover display tabel-data" style="width:100%">
    			<thead>
    	        <tr style="font-size: 11px">
                  <th>Id antrian</th>
    	        		<th>Antrian</th>
    	            <th>No. Registasi</th>
    	            <th>Tgl Periksa</th>
    	            <th>Nama Pasien</th>
    	            <th>No. RM</th>
                  <th>Dokter</th>
    							<th>Status Rawat</th>
      		        <th>Assesment</th>
      		        <th>Aksi</th>
      		        <th>Panggil</th>
    		 			</tr>
    		    </thead>
    		</table>
      </div>
    </div>
	</div>
</div>

  <!-- load file audio bell antrian -->
  <audio id="tingtung" src="assets/audio/tingtung.mp3"></audio>

  <!-- jQuery Core -->
  <script src="assets/js/jquery-3.6.0.min.js"></script>
  <!-- Popper and Bootstrap JS -->
  <!-- <script src="assets/js/popper.min.js"></script>
  <script src="assets/js/bootstrap.min.js"></script> -->

  <!-- DataTables -->
  <!-- <script type="text/javascript" src="https://cdn.datatables.net/v/bs5/dt-1.10.25/datatables.min.js"></script> -->
  <!-- Responsivevoice -->
  <!-- Get API Key -> https://responsivevoice.org/ -->
  <script src="https://code.responsivevoice.org/responsivevoice.js?key=jQZ2zcdq"></script>

  <script type="text/javascript">
		$(document).ready(function() {
			// tampilkan informasi antrian
      $('#jumlah-antrian').load('panggilan-antrian/get_jumlah_antrian.php');
      $('#antrian-sekarang').load('panggilan-antrian/get_antrian_sekarang.php');
      $('#antrian-selanjutnya').load('panggilan-antrian/get_antrian_selanjutnya.php');
      $('#sisa-antrian').load('panggilan-antrian/get_sisa_antrian.php');
  		var table = $("#daftar").DataTable({
				"ajax": {
				"url" : "ajax/load_daftarpasien4.php",
				"dataSrc" : ""
			},
			"lengthMenu" : [[20, 30, 40, -2], [20, 30, 40, "All"]],
      "order": [[ 0, "desc" ]],
			"columns" : [
        {"data": "id",
          "visible": false},
				{"data" : "no_antrian",
          "width": "40px",
					"className": "text-center",
          render: function (data, type) {
                    var number = $.fn.dataTable.render
                        .number() //String pecahan misal rupiah ,00 Tambahkan kodenya
                        .display(data);
 
                    if (type === "display") {
                        let color = "";
                        // if (data < 250000) { //kondisi
                        //     color = 'red';
                        // } else if (data < 500000) {
                        //     color = 'orange';
                        // } 
                        return "<span style=\"color:red; font-size: 16px; font-weight:bold;\">A-"+ number +"</span>";
                    } 
                    return number;
                  },
				},
				{"data": "no_daftar"},
				{"data": "tgl_daftar", "width": "80px"},
				{"data" : "nama_pas",
        "width": "110px"},
				{"data" : "nomor_rm", "width": "70px"},
        {"data" : "nm_dokter", "width": "90px"},
				{	"data" : null,
          	"width": '90px',
            "className": 'text-center',
            "render": function (data, row, type) {
	              // jika tidak ada data "status_rawat"
	              let status_rawat = '';
	              //jika data "status_rawat = Belum diperiksa"
	              if (data.status_rawat == "Belum diperiksa") {
	                // tampilkan button panggil
	                status_rawat += "<a style=\"padding: 8px; font-size: 11px;\" class=\"badge badge-pills badge-warning\"><i class=\"fas fa-stethoscope\"></i> Belum diperiksa</a>";
	              } 
	              // jika data "status_rawat = Sudah diperiksa"
	              else if (data.status_rawat == "Sudah diperiksa") {
	                // tampilkan button ulangi panggilan
	                status_rawat += "<a style=\"padding: 8px; font-size: 11px; color: #ffff;\" class=\"badge badge-pills badge-success\"><i class=\"fas fa-stethoscope\"></i> Sudah diperiksa</a>";
	              }
	              return status_rawat;
          	}
        	},
          {	"data" : null,
          	"width": '80px',
            "className": 'text-center',
            "render": function (data, row, type) {
            		var btn = "<a style=\"margin-right:7px; font-size: 11px;\" title=\"Periksa Pasien\" class=\"btn btn-info btn-sm btnPeriksa\" href=\"#\"><i class=\"fas fa-stethoscope\"></i> Periksa</a>";
            		return btn;
          	}	            
        	},
          {	"data" : null,
            "className": 'text-center',
            "render": function (data, row, type) {
            		var btn = "<a style=\"margin-right:7px; font-size: 11px\" title=\"Hapus\" class=\"btn btn-danger btnHapus\" href=\"#\"><i class=\"fas fa-trash\"></i></a>";
                return btn;
          	}
          },
          {	"data" : null,
          	"width": '130px',
          	"className": 'text-center',
          	"render": function (data, row, type) {
              // jika tidak ada data "status"
              if (data["status"] === "") {
                // sembunyikan button panggil
                var btn = "-";
              } 
              // jika data "status = 0"
              else if (data["status"] === "0") {
                // tampilkan button panggil
          		var btn = "<button class=\"btn btn-primary btn-sm btnPanggil\" style=\"font-size:11px\" href=\"#\"><i class=\"fas fa-bullhorn\"></i> Panggil</button>";
              }
              // jika data "status = 1"
              else if (data["status"] === "1") {
                // tampilkan button ulangi panggilan
                var btn = "<button class=\"btn btn-success btn-sm btnPanggil\" style=\"font-size:11px\" href=\"#\">Sudah dipanggil</button>";
              };
          		return btn;
          	}
        	},
        ],   
		})
  		setInterval(function() {
  			$('#jumlah-antrian').load('panggilan-antrian/get_jumlah_antrian.php').fadeIn("slow");
        $('#antrian-sekarang').load('panggilan-antrian/get_antrian_sekarang.php').fadeIn("slow");
        $('#antrian-selanjutnya').load('panggilan-antrian/get_antrian_selanjutnya.php').fadeIn("slow");
        $('#sisa-antrian').load('panggilan-antrian/get_sisa_antrian.php').fadeIn("slow");
			table.ajax.reload(null, false);
		      }, 10000); //request update data per 1000 = 1 detik	
 		$('#daftar tbody').on( 'click', '.btnHapus', function (){
 				var data = table.row( $(this).parents('tr') ).data();
				Swal.fire({
          title: 'Apakah Anda Yakin?',
          text: 'Akan menghapus data pendaftaran pasien '+data['nama_pas']+', semua data pendaftaran akan ikut terhapus',
          type: 'warning',
          showCancelButton: true,
          confirmButtonColor: '#3085d6',
          cancelButtonColor: '#d33',
          confirmButtonText: 'Ya'
        }).then((hapus) => {
          if (hapus.value) {
          	var id = data['id'];
            var id_pas = data['no_daftar'];
            $.ajax({
              type: "POST",
              url: "ajax/hapus.php?page=antrian",
              data: {id:id},
            });

            $.ajax({
              type: "POST",
              url: "ajax/hapus.php?page=datapendaftaran",
              data: {id:id_pas},
              success: function(hasil) {
                Swal.fire({
		          title: 'Berhasil',
		          text: 'Data Berhasil Dihapus',
		          type: 'success',
		          confirmButtonColor: '#3085d6',
		          confirmButtonText: 'OK'
		        }).then((ok) => {
		          if (ok.value) {
		            window.location='?page=perawatan';
		          }
		        })
              }
            })  
          }
        })			    
 			});
 		$('#daftar tbody').on('click', '.btnPanggil', function() {
      	var data = table.row( $(this).parents('tr') ).data();
        var id = data['id'];
        var bell = document.getElementById('tingtung');

        // mainkan suara bell antrian
        bell.pause();
        bell.currentTime = 0;
        bell.play();
       
        // set delay antara suara bell dengan suara nomor antrian
        durasi_bell = bell.duration * 770;

        // mainkan suara nomor antrian
        setTimeout(function() {
          responsiveVoice.speak("Nomor Antrian A, " +data['no_antrian']+ ", menuju ruang periksa, dokter ovi", "Indonesian Male", {
            rate: 0.9,
            pitch: 1,
            volume: 1
          });
        }, durasi_bell);

        // proses update data
        $.ajax({
          type: "POST",               // mengirim data dengan method POST
          url: "panggilan-antrian/update.php",          // url file proses update data
          data: { id: id }            // tentukan data yang dikirim
        });
      });
 		$('#daftar tbody').on('click', '.btnPeriksa', function() {
      	var data = table.row( $(this).parents('tr') ).data();
      	//var id = data['no_daftar'];
				window.location='?page=form_assesment&id='+data['no_daftar'];
      });

 	});
	</script>
