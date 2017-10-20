<?php 
  if(!isset($_POST['sepalL'])) $sepalL="";
  else $sepalL=$_POST['sepalL'];

  if(!isset($_POST['sepalW'])) $sepalW="";
  else $sepalW=$_POST['sepalW'];

  if(!isset($_POST['petalL'])) $petalL="";
  else $petalL=$_POST['petalL'];

  if(!isset($_POST['petalW'])) $petalW="";
  else $petalW=$_POST['petalW'];

  if(!isset($_POST['k'])) $k=0;
  else $k=$_POST['k'];
   
   
?>
<html>
<head>
  
  <link href="bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="bootstrap/font-awesome/css/font-awesome.min.css">

    <!-- Custom CSS -->
    <link href="bootstrap/css/landing-page.css" rel="stylesheet">

    <!-- Custom Fonts -->
    <link href="bootstrap/css/font-awesome.min.css" rel="stylesheet" type="text/css">
</head>
<body>

<div class="container-fluid">
  <div class="row">
    <div class="col-md-12">
      <nav class="navbar navbar-default navbar-fixed-top" role="navigation">
        <div class="navbar-header">
           
          <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
             <span class="sr-only">Toggle navigation</span><span class="icon-bar"></span><span class="icon-bar"></span><span class="icon-bar"></span>
          </button> <a class="navbar-brand" href="#">Machine Learning</a>
        </div>
        
        <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
          <ul class="nav navbar-nav">
            <li class="active">
              <a href="#">KNN</a>
            </li>
            
          </ul>
        </div>
        
      </nav>
      <br>
      <div class="page-header">
        <h1>
          Algoritma KNN<small> | Pinky Cindy | 2110151001</small>
        </h1>
        
      </div>
      <div class="row">
      
        <div class="col-md-5">
          Data Training
          <hr>
          
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
          $temp=0;
          $temp2=0;
          $dataTes=array($sepalL, $sepalW, $petalL, $petalW);

          echo" <table  class='table table-bordered table-hover table-condensed'>
            <tr bgcolor='#ccc'>
              <td>Sepal Length</td>
              <td>Sepal Width</td>
              <td>Petal Length</td>
              <td>Petal Width</td>
              <td>Spesies</td>
            </tr>";
          for($i=0; $i<150;){
                echo"<tr>
                  <td>".$dt[$i][0]."</td>
                  <td>".$dt[$i][1]."</td>
                  <td>".$dt[$i][2]."</td>
                  <td>".$dt[$i][3]."</td>
                  <td>".$dt[$i][4]."</td>
                </tr>";

                $i=$i+20;
          }  
          echo "</table>";


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

        if($k!=0){

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
                $lenghtT=sizeof($label);
                 //mengurutkan array label dari yang terbesar untuk menentukan hasil
                array_sort_by_column($label, 1, SORT_DESC);

                $hasil=$label[0][0];

          }
        
        ?>
        
            



        </div>


        <div class="col-md-7" align="left">
          Data Test 
          <hr>
          
          <form class="form-horizontal" action="" method="post" role="form">
            <div class="form-group" >
              <label class="col-sm-3">Sepal Length</label>
              <div class="col-sm-9">
                <input type="text" class="form-control" name="sepalL" value="<?php echo $sepalL;?>" />
              </div>
            </div>
            <div class="form-group">
              <label class="col-sm-3">Sepal Width</label>
              <div class="col-sm-9">
                <input type="text" class="form-control" name="sepalW" value="<?php echo $sepalW;?>" />
              </div>
            </div>
            <div class="form-group">
              <label class="col-sm-3">Petal Length</label>
              <div class="col-sm-9">
                <input type="text" class="form-control" name="petalL" value="<?php echo $petalL;?>" />
              </div>
            </div>
              <div class="form-group">
              <label class="col-sm-3">Petal Width</label>
              <div class="col-sm-9">
                <input type="text" class="form-control" name="petalW" value="<?php echo $petalW;?>" />
              </div>
            </div>
             <div class="form-group">
              <label class="col-sm-3">Jumlah Tetangga (K)</label>
              <div class="col-sm-9">
                <input type="text" class="form-control" name="k" value="<?php echo $k;?>" />
              </div>
            </div>
            <div class="col-sm-14" align="right">
                <input type="submit" class="btn btn-info btn-block" />
            </div>
            
            <?php

            if($sepalW==0){
              echo "";
            }
            else{
              for($i=0; $i<$lenghtT; $i++){
                echo "<br>Spesies : ".$label[$i][0]."| Jumlah :".$label[$i][1]."";
              }
              echo "<br><h2>Kesimpulan : ".$hasil."</h2>";
            }
            

            ?>
          </form>
        </div>
      </div>
    </div>
  </div>
</div>
</body>
</html>