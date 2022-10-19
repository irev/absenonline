<?php
  $fields = array('imageTTD' => "", 'file' => "");

    $curl = curl_init();
    

        $file1 = "http://simpel2.pasamanbaratkab.go.id/upload/a.jpg";
               $file2 = "http://simpel2.pasamanbaratkab.go.id/upload/c.pdf";

        $filenames = array($file1, $file2);

        foreach ($filenames as $f){
            $files[$f] = file_get_contents($f);
        }

    $url_data = http_build_query($fields);
    $boundary = uniqid();
        $delimiter = '-------------' . $boundary;
        
        $post_data = build_data_files($boundary, $fields, $files);

    curl_setopt_array($curl, array(
          CURLOPT_PORT => "8080",
      CURLOPT_URL => "http://103.124.89.212/api/sign/pdf?nik=1371116102790007&passphrase=nani090911@&tampilan=visible&halaman=terakhir&image=true&linkQR=http://siktln.kemensetneg.go.id/doc&xAxis=43.63&width=350.78&height=100.88&yAxis=28.71",
      
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
              "Authorization:Basic YnNyZTpzZWN1cmV0cmFuc2FjdGlvbnMhISE=",
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
                . 'Content-Disposition: form-data; name="imageTTD"; filename="' . $name . '"' . $eol
                . 'Content-Disposition: form-data; name="file"; filename="' . $name . '"' . $eol
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
