<head>
  <meta http-equiv="refresh" content="30">
</head>

<?php
	require_once('connection.php');
	




	$sql = "select * from lokasi";

	
	$exequery = mysqli_query($con,$sql);
	
?>
<center>
<h2>DATA LOKASI KEPALA OPD</h2>
<h1>
    <table border=1 width=60%>

    <tr><td>No</td><td>Nama Kepala OPD</td><td align=center>Latitude</td><td align=center>Longitude</td><td align=center>Lokasi</td></tr>


    <?php
     $no =1;   
while ($tampil = mysqli_fetch_array($exequery) ){
      echo  "<tr><td>$no </td>";
     echo  "<td>$tampil[nama_lengkap]</td>";
  echo  "<td align=center>$tampil[lat]</td>";
  echo "<td align=center>$tampil[lng]</td>";
   echo "<td align=center>$tampil[lokasi]</td></tr>";
  $no++; 
}

?>


</table>
</h1>

</center>
<?php
	mysqli_close($link);
?>
