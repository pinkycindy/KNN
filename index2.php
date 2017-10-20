<?php

    $txt_file    = file_get_contents('DataTraining.txt');
    $rows        = explode("\n", $txt_file);
    array_shift($rows);
      foreach($rows as $row => $data)
      {
        $row_data = explode(',', $data);
        $dt[$row][0]      = floatval($row_data[0]);
        $dt[$row][1]      = floatval($row_data[1]);
        $dt[$row][2]      = floatval($row_data[2]);
        $dt[$row][3]      = floatval($row_data[3]);
        $dt[$row][4]      = $row_data[4];
        $dt[$row][5]      = 0;
      }
      $lenght=sizeof($dt); 
      $k = 91;
      $temp=0;
      $temp2=0;
      $dataTes=array(5.5,2.4,3.7,1.0);


      //menghitung jarak
      for($i=0; $i<$lenght; $i++){
          for($j=0; $j<4; $j++){
            $temp=($dt[$i][$j]-$dataTes[$j]);
            $temp2=$temp2+($temp*$temp);
          }
          $dt[$i][5]=sqrt($temp2);
          $temp=0;
          $temp2=0;
            
        }

        //fungsi sorting array
        function array_sort_by_column(&$arr, $col, $dir) {
            $sort_col = array();
                foreach ($arr as $key=> $row) {
                    $sort_col[$key] = $row[$col];
                }
            array_multisort($sort_col, $dir, $arr);
        }

        //sort array berdasarkan jarak terdekat
        array_sort_by_column($dt, 5, SORT_ASC);


        //mencari tetangga
        for($i=0; $i<$k; $i++){
              $tetangga[$i][0]=$dt[$i][4];
             // echo $tetangga[$i][0]."-".$dt[$i][5]."<br>";
          }

        //menghitung jumlah tetangga
        $out = array();
        foreach ($tetangga as $key => $value){
          foreach ($value as $key2 => $value2){
              $index = $key2.'-'.$value2;
              if (array_key_exists($index, $out)){
                  $out[$index]++;
              } else {
                  $out[$index] = 1;
              }
          }
          
        }
        //print_r($out);

        //membuat array penampung label dan jumlah nilai
        $s=0;
        foreach ($out as $key => $val) {
           $label[$s][0]= substr($key, strpos($key, "-") + 1);
           $label[$s][1]=$val;
           $s++;
        }

        echo "<br>";
        //print_r($label);
        //mengurutkan array label dari yang terbesar untuk menentukan hasil
        array_sort_by_column($dt, 5, SORT_DESC);
        echo "<br>";
        //print_r($label);
        echo "hasil : ".$label[0][0];


  
  ?>