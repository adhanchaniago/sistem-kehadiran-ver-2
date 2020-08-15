<?php
    session_start();
    $nostaf = $_SESSION["nostaf"];
    date_default_timezone_set("Asia/Kuala_Lumpur");
    include './php/dbconnect.php';                      //need to put one dot because this file outside php folder

    if (!empty($nostaf))
    {
        if (!$con)  //get data from dbconnect.php
        {
            die("Sambungan gagal : " . mysqli_connect_error());
        }
        else
        {
            $staf = mysqli_query($con,"SELECT * FROM data_user WHERE nostaf = $nostaf ") or die ("Gagal untuk query database" .mysqli_error($staf));
            $row = mysqli_fetch_array($staf);

            if (date("d-m-Y") == '15-08-2020')
            {
                if($row['nostaf'] == $nostaf)
                {
                    $row['nostaf'];
                    $tarikh = $row['15_Aug_tarikh'];
                    $masa = $row['15_Aug_masa'];
                }
            }
            else if (date("d-m-Y") == '23-06-2020')
            {
                if($row['nostaf'] == $nostaf)
                {
                    $row['nostaf'];
                    $tarikh = $row['23_jun_tarikh'];
                    $masa = $row['23_jun_masa'];
                }
            }
            else if (date("d-m-Y") == '24-06-2020')
            {
                if($row['nostaf'] == $nostaf)
                {
                    $row['nostaf'];
                    $tarikh = $row['24_jun_tarikh'];
                    $masa = $row['24_jun_masa'];
                }
            }
            else
            {
                ?>   
                    <script type="text/javascript">
                        alert("Anda hanya boleh sahkan kehadiran pada 23 dan 24 Jun 2020 sahaja"); 
                        location.replace("./index.php");
                    </script>
                <?php  
                die();
            }     
        }
    } 
    else
    {
        header("location: ./index.php");
    }
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
    <title>Bengkel CEICnet</title>
    <link rel="stylesheet" href="assets/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="assets/css/styles.css">
</head>
<body>
    <section class="text-center" style="width: auto;height: auto;margin-bottom: 10px;padding-top: 68px;margin-right: 20px;margin-left: 20px;"><span class="text-center d-flex justify-content-center" style="width: auto;height: auto;font-size: 15px;color: rgb(6,1,40);font-weight: bold;margin-right: 20px;margin-left: 20px;"></span></section>
    <section
        class="text-center" style="width: auto;height: auto;margin-bottom: 10px;padding-top: 11px;margin-right: 40px;margin-left: 40px;"><span class="text-center d-flex justify-content-center" style="width: auto;height: auto;font-size: 17px;color: rgb(6,1,40);font-weight: bold;margin-right: 20px;margin-left: 20px;">MAKLUMAT ANDA</span><span class="text-center d-flex justify-content-center"
            style="width: auto;height: auto;font-size: 15px;color: rgb(98,98,98);font-weight: normal;margin-left: 20px;margin-right: 20px;margin-top: 10px;"><br></span>
        <div class="row no-gutters" style="margin-left: 5px;margin-bottom: 4px;margin-right: 5px;">
            <div class="col-4 text-nowrap text-left" style="font-size: 15px;width: auto;height: 20px;max-width: auto;padding-right: 0px;padding-left: 0px;"><span style="font-size: 15px;">Nama<br></span></div>
            <div class="col-1" style="font-size: 15px;width: 124px;padding-right: 0px;padding-left: 0px;"><span class="text-center">-</span></div>
            <div class="col text-left" style="font-size: 15px;padding-right: 0px;padding-left: 0px;"><span style="font-size: 15px;"><?php echo $row['nama'] ?></span></div>
        </div>
        <div class="row no-gutters" style="margin-left: 5px;margin-bottom: 4px;margin-right: 5px;">
            <div class="col-4 text-nowrap text-left" style="font-size: 15px;width: auto;height: 20px;max-width: auto;padding-right: 0px;padding-left: 0px;"><span style="font-size: 15px;">Kumpulan<br></span></div>
            <div class="col-1" style="font-size: 15px;width: 124px;padding-right: 0px;padding-left: 0px;"><span class="text-center">-</span></div>
            <div class="col text-left" style="font-size: 15px;padding-right: 0px;padding-left: 0px;"><span style="font-size: 15px;"><?php echo $row['kumpulan'] ?></span></div>
        </div>
        <div class="row no-gutters" style="margin-right: 5px;margin-left: 5px;margin-bottom: 4px;">
            <div class="col-4 text-nowrap text-left" style="font-size: 15px;width: auto;height: 20px;max-width: auto;padding-right: 0px;padding-left: 0px;"><span style="font-size: 15px;">No. Staf<br></span></div>
            <div class="col-1" style="font-size: 15px;width: 124px;padding-right: 0px;padding-left: 0px;"><span class="text-center">-</span></div>
            <div class="col text-left" style="font-size: 15px;padding-right: 0px;padding-left: 0px;"><span style="font-size: 15px;"><?php echo $row['nostaf'] ?></span></div>
        </div>
        <div class="row no-gutters" style="margin-right: 5px;margin-left: 5px;margin-bottom: 4px;">
            <div class="col-4 text-nowrap text-left" style="font-size: 15px;width: auto;height: 20px;max-width: auto;padding-right: 0px;padding-left: 0px;"><span style="font-size: 15px;">Tarikh Hadir<br></span></div>
            <div class="col-1" style="font-size: 15px;width: 124px;padding-right: 0px;padding-left: 0px;"><span class="text-center">-</span></div>
            <div class="col text-left" style="font-size: 15px;padding-right: 0px;padding-left: 0px;"><span style="font-size: 15px;"><?php echo $tarikh ?></span></div>
        </div>
        <div class="row no-gutters" style="margin-right: 5px;margin-left: 5px;margin-bottom: 4px;">
            <div class="col-4 text-nowrap text-left" style="font-size: 15px;width: auto;height: 20px;max-width: auto;padding-right: 0px;padding-left: 0px;"><span style="font-size: 15px;">Masa Hadir<br></span></div>
            <div class="col-1" style="font-size: 15px;width: 124px;padding-right: 0px;padding-left: 0px;"><span class="text-center">-</span></div>
            <div class="col text-left" style="font-size: 15px;padding-right: 0px;padding-left: 0px;"><span style="font-size: 15px;"><?php echo $masa ?></span></div>
        </div>
        </section>
        <div class="row no-gutters text-center justify-content-center align-items-center" style="width: auto;height: auto;">
            <div class="col text-center d-flex justify-content-center" style="height: auto;width: auto;"><a class="btn btn-primary" role="button" style="width: auto;font-size: 15px;height: auto;margin-top: 57px;" href="index.php">KEMBALI</a></div>
        </div>
        <script src="assets/js/jquery.min.js"></script>
        <script src="assets/bootstrap/js/bootstrap.min.js"></script>
</body>
</html>