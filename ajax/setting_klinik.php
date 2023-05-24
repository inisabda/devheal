<?php
$conn = mysqli_connect("localhost", "root", "", "klinik_project");

if(isset($_FILES['fileImg']['name'])){
  global $conn;

  $imageName = $_FILES["fileImg"]["name"];
  $tmpName = $_FILES["fileImg"]["tmp_name"];

  // Image extension validation
  $validImageExtension = ['jpg', 'jpeg', 'png'];
  $imageExtension = explode('.', $imageName);

  $name = $imageExtension[0];
  $imageExtension = strtolower(end($imageExtension));

  if (!in_array($imageExtension, $validImageExtension)){
    echo "Invalid Extension";
    exit;
  }
  else{
    $newImageName = $name; // Generate new image name
    $newImageName .= '.' . $imageExtension;
    $id_klinik =$_POST['id_klinik'];
    $nm_klinik =$_POST['nm_klinik'];
    $alm_klinik =$_POST['alm_klinik'];
    $kab =$_POST['kab'];
    $dokter1 =$_POST['dokter1'];
    $dokter2 =$_POST['dokter2'];
    $sip1 =$_POST['sip1'];
    $sip2 =$_POST['sip2'];
    $no_hp =$_POST['no_hp'];
    $email =$_POST['email'];

    move_uploaded_file($tmpName, '../images/' . $newImageName);
    $query = "UPDATE tbl_setting SET nama_klinik='$nm_klinik', alamat_klinik='$alm_klinik', kab='$kab', dokter1='$dokter1', dokter2='$dokter2', sip1='$sip1', sip2='$sip2', no_hp='$no_hp', email='$email', logo ='$newImageName' WHERE id_klinik='$id_klinik'";
	// 	$sql = mysqli_query($conn, $query) or die ($conn->error);


    // $query = "INSERT INTO tb_upload VALUES('', '$id_klinik', '$newImageName')";
    mysqli_query($conn, $query);
    echo "Success";
    exit;
  }
}

?>
