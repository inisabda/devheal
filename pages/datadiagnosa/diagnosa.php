<nav aria-label="breadcrumb">
  <ol class="breadcrumb bg-light">
    <li class="breadcrumb-item"><a href="./"><i class="fas fa-home"></i> Home</a></li>
    <li class="breadcrumb-item active" aria-current="page"><i class="fas fa-briefcase-medical"></i> Data Diagnosa</li>
  </ol>
</nav>

<div class="page-content">
	<div class="row">
		<div class="col-12" id="judul"><h4><i class="fas fa-receipt"></i> Data Diagnosa ICD - 10</h4></div>
	</div>
	<div class="table-container">			
		<div class="row" style="padding: 0 25px;">
			<div class="col-md-12 vertical-form table-responsive"><br>
				<table id="diagnosa" class="table table-hover display tabel-data" width="100%">
					<thead>
				        <tr>
				            <th>No</th>
				            <th>Id ICD</th>
				            <th>Kode ICD - 10</th>
				            <th>Nama Diagnosa</th>
				            <th>Keterangan</th>
				        </tr>
				    </thead>
				    <tbody>
				    </tbody>
				</table>
			</div>
		</div>
	</div>
</div>

<script>
	$(document).ready(function() {
		var table = $("#diagnosa").DataTable({
			"ajax": {
			"url" : "ajax/load_datadiagnosa.php",
			"dataSrc" : ""
		},
			"lengthMenu" : [[20, 30, 40, -2], [20, 30, 40, "All"]],
			"order": [[ 0, "asc" ]],
			"columns" :
			[
				{"data" : "no",
					"width": '5px',
					render: function ( data, type, row ) {
	            	return row.no + '.';
		          }
				},
				{"data" : "id_icd",
					"visible": false},
				{"data" : "code", "width": '50px'},
				{"data": "diagnosa",
					"width": '200px'},
				{"data": "deskripsi",
					"width": '200px'},
	        ],          
		});
	});
</script>
