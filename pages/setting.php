<style media="screen">
    .preview{
      display: block;
      width: 150px;
      height: 150px;
      border: 1px solid black;
      margin-top: 10px;
    }
</style>
<nav aria-label="breadcrumb">
  <ol class="breadcrumb bg-light">
    <li class="breadcrumb-item"><a href="./"><i class="fas fa-home"></i> Home</a></li>
    <li class="breadcrumb-item active" aria-current="page"><i class="fas fa-tools"></i> Setting Aplikasi</li>
  </ol>
</nav>

<div class="page-content">
	<div class="row">
		<div class="col-12" align="center" id="judul"><h4><i class="fas fa-wrench"></i> Setting Aplikasi ERM <?php echo $nama_klinik; ?></h4>
			<p>Setelah disetting clear history gambar dan file dalam cache</div>
		</div>
		<div class="table-container">			
		<div class="row" style="padding: 0 80px;">
			<div class="col-md-12 vertical-form table-responsive"><br>				
				<form method = "post" id="submit_file" action = "" enctype = "multipart/form-data">
			        <table align="center" width=100%>
			        	<tr>			                
			              <td style="padding-left: 10px;"><input class="form-control form-control-sm "type="hidden" name="id_klinik" id="id_klinik" value="<?php echo $id_klinik; ?>"></td>
			            </tr>
			            <tr>
			                <td style="padding-left: 1px; font-size: 14px;">Nama Klinik</td>
			                <td>:</td>
			                <td style="padding-left: 10px; padding-top: 8px;"><input class="form-control form-control-sm "type="text" name="nm_klinik" id="nm_klinik" value="<?php echo $nama_klinik; ?>"></td>
			            </tr>
			            <tr>
			                <td style="padding-left: 1px; font-size: 14px;">Alamat Klinik</td>
			                <td>:</td>
			                <td style="padding-left: 10px; padding-top: 8px;"><input class="form-control form-control-sm "type="text" name="alm_klinik" id="alm_klinik" value="<?php echo $alamat_klinik; ?>"></td>
			            </tr>
			            <tr>
			                <td style="padding-left: 1px; font-size: 14px;">Kabupaten</td>
			                <td>:</td>
			                <td style="padding-left: 10px; padding-top: 8px;"><input class="form-control form-control-sm "type="text" name="kab" id="kab" value="<?php echo $kab; ?>"></td>
			            </tr>
			            <tr>
			                <td style="padding-left: 1px; font-size: 14px;">No Hp</td>
			                <td>:</td>
			                <td style="padding-left: 10px; padding-top: 8px;"><input class="form-control form-control-sm "type="number" name="no_hp" id="no_hp" value="<?php echo $no_hp; ?>"></td>
			            </tr>
			            <tr>
			                <td style="padding-left: 1px; font-size: 14px;">Nama Dokter 1</td>
			                <td>:</td>
			                <td style="padding-left: 10px; padding-top: 8px;"><input class="form-control form-control-sm "type="text" name="dokter1" id="dokter1" value="<?php echo $dokter1; ?>"></td>
			            </tr>
			            <tr>
			                <td style="padding-left: 1px; font-size: 14px;">Nama Dokter 2</td>
			                <td>:</td>
			                <td style="padding-left: 10px; padding-top: 8px;"><input class="form-control form-control-sm "type="text" name="dokter2" id="dokter2" value="<?php echo $dokter2; ?>"></td>
			            </tr>
						<tr>
			                <td style="padding-left: 1px; font-size: 14px;">Nama Dokter 3</td>
			                <td>:</td>
			                <td style="padding-left: 10px; padding-top: 8px;"><input class="form-control form-control-sm "type="text" name="dokter3" id="dokter3" value="<?php echo $dokter3; ?>"></td>
			            </tr>
						<tr>
			                <td style="padding-left: 1px; font-size: 14px;">Nama Dokter 4</td>
			                <td>:</td>
			                <td style="padding-left: 10px; padding-top: 8px;"><input class="form-control form-control-sm "type="text" name="dokter4" id="dokter4" value="<?php echo $dokter4; ?>"></td>
			            </tr>
						<tr>
			                <td style="padding-left: 1px; font-size: 14px;">Nama Dokter 5</td>
			                <td>:</td>
			                <td style="padding-left: 10px; padding-top: 8px;"><input class="form-control form-control-sm "type="text" name="dokter5" id="dokter5" value="<?php echo $dokter5; ?>"></td>
			            </tr>
			            <tr>
			                <td style="padding-left: 1px; font-size: 14px;">SIP Dokter 1</td>
			                <td>:</td>
			                <td style="padding-left: 10px; padding-top: 8px;"><input class="form-control form-control-sm "type="text" name="sip1" id="sip1" value="<?php echo $sip1; ?>" required></td>
			            </tr>
			            <tr>
			                <td style="padding-left: 1px; font-size: 14px;">SIP Dokter 2</td>
			                <td>:</td>
			                <td style="padding-left: 10px; padding-top: 8px;"><input class="form-control form-control-sm "type="text" name="sip2" id="sip2" value="<?php echo $sip2; ?>" required></td>
			            </tr>
						<tr>
			                <td style="padding-left: 1px; font-size: 14px;">SIP Dokter 3</td>
			                <td>:</td>
			                <td style="padding-left: 10px; padding-top: 8px;"><input class="form-control form-control-sm "type="text" name="sip3" id="sip3" value="<?php echo $sip3; ?>" required></td>
			            </tr>
						<tr>
			                <td style="padding-left: 1px; font-size: 14px;">SIP Dokter 4</td>
			                <td>:</td>
			                <td style="padding-left: 10px; padding-top: 8px;"><input class="form-control form-control-sm "type="text" name="sip4" id="sip4" value="<?php echo $sip4; ?>" required></td>
			            </tr>
						<tr>
			                <td style="padding-left: 1px; font-size: 14px;">SIP Dokter 5</td>
			                <td>:</td>
			                <td style="padding-left: 10px; padding-top: 8px;"><input class="form-control form-control-sm "type="text" name="sip5" id="sip5" value="<?php echo $sip5; ?>" required></td>
			            </tr>
			            <tr>
			                <td style="padding-left: 1px; font-size: 14px;">E-Mail</td>
			                <td>:</td>
			                <td style="padding-left: 10px; padding-top: 8px;"><input class="form-control form-control-sm "type="email" name="email" id="email" value="<?php echo $email; ?>"></td>
			            </tr>
			            <tr>
			                <td style="padding-left: 1px; font-size: 14px;">Logo Klinik</td>
			                <td>:</td>
			                <td style="padding-left: 10px; padding-top: 8px;"><div class = "preview"><img src="images/logoklinik.png" id = "img" alt = "Preview" style = "width: 100%; height: 100%"></div>
			                <br><input type="file" name="fileImg" id="fileImg">
			                <br>Nama file logo ekstensi logoklinik.png
			            </td>

			            </tr>
			            <tr>
			            	<td></td>
			            	<td></td>
			                <td style="padding-rigt: 10px; padding-top: 8px; text-align: right;">
			                	<button type="submit" class="btn btn-success btn-sm" id="submitButtom"><i class="fas fa-save"></i> Update</button></td>
			            </tr>
			        </table>
			  	</form>
			</div>
		</div>
	</div>
</div>

<script type="text/javascript">
  // Preview
  fileImg.onchange = evt => {
    const [file] = fileImg.files
    if (file) {
      img.src = URL.createObjectURL(file)
    }
  }
  // Submit
  $(document).ready(function(){
          $("#submit_file").on('submit', function(e){
            e.preventDefault();
           $.ajax({
            url: 'ajax/setting_klinik.php',
            type: 'post',
            data: new FormData(this),
            contentType: false,
            processData: false,
            success:function(response){
              if(response == "Success"){
                Swal.fire({
		          title: 'Berhasil',
		          text: 'Data Berhasil Disimpan',
		          type: 'success',
		          confirmButtonColor: '#3085d6',
		          confirmButtonText: 'OK'
		        }).then((ok) => {
		          if (ok.value) {
		           window.location='?page=setting' ;
		          }
		        });
              }
              else if(response == "Invalid Extension"){
                alert("Invalid Extension");
              }
              else{
                alert("Please Fill Out The Form");
              }
            }
          });
        });
     })
</script>
