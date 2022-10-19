<?php
  $fields = array('image_ttd' => "", 'ktp' => "", 'surat_rekomendasi' => "");

    $curl = curl_init();
    

        $file1 = "http://simpel2.pasamanbaratkab.go.id/upload/a.jpg";
                $file2 = "http://simpel2.pasamanbaratkab.go.id/upload/b.png";
               $file3 = "http://simpel2.pasamanbaratkab.go.id/upload/c.pdf";

        $filenames = array($file1, $file2, $file3);

        foreach ($filenames as $f){
            $files[$f] = file_get_contents($f);
        }

    $url_data = http_build_query($fields);
    $boundary = uniqid();
        $delimiter = '-------------' . $boundary;
        
        $post_data = build_data_files($boundary, $fields, $files);

    curl_setopt_array($curl, array(
        
      CURLOPT_URL => "http://103.124.89.212/api/user/registrasi?nik=1275051212960002&nama=Dedi Kurniawan&email=laplace.shc@gmail.com&nomor_telepon=082386437418&kota=Pasaman Barat&provinsi=Sumatera Barat&nip=19790221 199711 2 001&jabatan=Kepala Bidang E-Goverment&unit_kerja=Diskominfo Pasaman Barat",
      
      CURLOPT_RETURNTRANSFER => true,
      CURLOPT_ENCODING => "",
      CURLOPT_MAXREDIRS => 10,
      CURLOPT_TIMEOUT => 30,
      CURLOPT_SSL_VERIFYPEER => false,
          CURLOPT_SSL_VERIFYHOST => false,
      CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
      CURLOPT_CUSTOMREQUEST => "POST",
      CURLOPT_POSTFIELDS => $post_data,
      CURLOPT_HTTPHEADER => array(
              "Authorization:Bearer 1077e2ca-7c8e-484e-85d8-0284a7bef30f",
              "cache-control:no-cache",
              "Content-Type: multipart/form-data; boundary=" . $delimiter,
              "Content-Length: " . strlen($post_data)
          ),
    ));

    $response = curl_exec($curl);
    $err = curl_error($curl);

    curl_close($curl);

    if ($err) {
      echo "cURL Error #:" . $err;
    } else {
      echo $response;

    }


    function build_data_files($boundary, $fields, $files){
        $data = '';
        $eol = "\r\n";

        $delimiter = '-------------' . $boundary;

        /*foreach ($fields as $name => $content) {
            $data .= "--" . $delimiter . $eol
                . 'Content-Disposition: form-data; name="' . $name . "\"".$eol.$eol
                . $content . $eol;
        }*/


        foreach ($files as $name => $content) {
            $data .= "--" . $delimiter . $eol
            // . 'Content-Disposition: form-data; name="file"; filename="fips_186-3.pdf"' . $eol
                . 'Content-Disposition: form-data; name="file"; filename="http://simpel2.pasamanbaratkab.go.id/upload/a.jpg"' . $eol
                . 'Content-Disposition: form-data; name="file"; filename="http://simpel2.pasamanbaratkab.go.id/upload/b.png"' . $eol
                 . 'Content-Disposition: form-data; name="file"; filename="http://simpel2.pasamanbaratkab.go.id/upload/c.pdf"' . $eol
                //. 'Content-Disposition: form-data; name="' . $name . '"; filename="' . $name . '"' . $eol
                               // . 'Content-Disposition: form-data; name="imageTTD"; filename="simpel.pasamanbaratkab.go.id/upload/a.jpg"' . $eol
                . 'Content-Type: image/jpg'.$eol
                . 'Content-Type: application/pdf'.$eol
                //. 'Content-Transfer-Encoding: binary'.$eol
            ;
            var_dump($name);

            $data .= $eol;
            $data .= $content . $eol;
        }
        $data .= "--" . $delimiter . "--".$eol;


        return $data;
    }

?>
