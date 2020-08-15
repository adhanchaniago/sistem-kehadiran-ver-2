<?php
    session_start();
    unset($_SESSION["nostaf"]); 
?>

<!DOCTYPE html>
<html class="text-center" style="width: auto;height: auto;margin-right: 10px;margin-bottom: 10px;margin-top: 10px;margin-left: 10px;">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
    <title>Bengkel CEICnet</title>
    <link rel="stylesheet" href="assets/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="assets/css/styles.css">
    <link rel="icon" href="./assets/img/LogoUniMAP2017.png">
</head>

<body class="text-center" style="width: auto;height: auto;">
    <div class="row no-gutters text-center d-xl-flex justify-content-center align-items-center justify-content-xl-center" style="margin-top: 20px;width: auto;">
        <div class="col-xl-11 text-center d-xl-flex justify-content-xl-center" style="padding-right: 0px;padding-left: 0px;"><img class="img-fluid d-xl-flex" style="height: 81px;width: 150px;" src="assets/img/LogoUniMAP2017.png" loading="auto"></div>
    </div>
    <section style="margin-top: 22px;width: auto;height: auto;"><span class="text-center d-flex justify-content-center" style="width: auto;height: auto;margin-bottom: 18px;font-size: 17px;color: rgb(0,0,0);padding-right: 20px;padding-left: 20px;padding-top: 8px;">BENGKEL STRATEGIK<br>PUSAT KEUSAHAWANAN, JARINGAN INDUSTRI &amp; MASYARAKAT (CEICnet)<br>UNIVERSITI MALAYSIA PERLIS</span>
        <section
            class="text-center text-sm-center text-md-center text-lg-center text-xl-center align-items-center justify-content-sm-center justify-content-md-center justify-content-lg-center justify-content-xl-center" style="width: auto;height: auto;margin-bottom: 10px;padding-top: 11px;margin-right: 65px;margin-left: 65px;">
            <div class="row no-gutters" style="margin-left: 5px;margin-bottom: 4px;margin-right: 5px;">
                <div class="col-3 text-nowrap text-right" style="font-size: 13px;width: auto;height: auto;max-width: auto;padding-right: 0px;padding-left: 0px;"><span style="font-size: 15px;">Tarikh<br></span></div>
                <div class="col-1" style="font-size: 13px;width: 124px;padding-right: 0px;padding-left: 0px;"><span>-</span></div>
                <div class="col-8 text-left" style="font-size: 13px;padding-right: 0px;padding-left: 0px;width: auto;height: auto;"><span style="font-size: 15px;">23 &amp; 24 Jun 2020<br></span></div>
            </div>
            <div class="row no-gutters" style="margin-right: 5px;margin-left: 5px;margin-bottom: 4px;">
                <div class="col-3 text-nowrap text-right" style="font-size: 13px;width: auto;height: auto;max-width: auto;padding-right: 0px;padding-left: 0px;"><span style="font-size: 15px;">Lokasi<br></span></div>
                <div class="col-1" style="font-size: 13px;width: 124px;padding-right: 0px;padding-left: 0px;"><span>-</span></div>
                <div class="col text-left" style="font-size: 13px;padding-right: 0px;padding-left: 0px;width: auto;height: auto;"><span style="font-size: 15px;">Bilik Seminar, Kolej Kediaman PFI2, Pauh Putra<br></span></div>
            </div>
    </section>
    </section>
    <section style="margin-top: 33px;width: auto;height: auto;"><span class="text-center d-flex justify-content-center" style="width: auto;height: auto;margin-bottom: 18px;font-size: 19px;color: rgb(0,0,0);padding-top: 7px;">Masukkan No. Staf</span>
        <div class="row no-gutters text-center justify-content-center align-items-center"
            style="width: auto;height: auto;">
            <div class="col text-center d-flex justify-content-center" style="height: auto;width: auto;">
                <form method="POST" action="./php/sah.php"><input id="nostaf" name="nostaf" class="nostaf form-control text-center d-flex justify-content-center" type="number" style="height: auto;width: 253px;font-size: 18px;" autofocus="">
                    <div class="form-row no-gutters" style="width: auto;height: auto;">
                        <div class="col" style="margin-bottom: 29px;"><button class="btn btn-primary" id="submit" type="submit" style="margin-top: 39px;width: 155px;font-size: 15px;margin-bottom: 15px;">SAHKAN</button></div>
                    </div>
                </form>
            </div>
        </div>
        <div class="row no-gutters text-center justify-content-center align-items-center" style="width: auto;height: auto;">
            <div class="col text-center d-flex justify-content-center" style="height: auto;width: auto;"><a class="btn btn-primary" role="button" style="width: auto;font-size: 15px;height: auto;" href="23jun.html">ATURCARA 23 JUN 2020</a></div>
        </div>
        <div class="row no-gutters text-center justify-content-center align-items-center" style="width: auto;height: auto;padding-top: 20px;">
            <div class="col" style="width: auto;height: auto;"><a class="btn btn-primary" role="button" style="width: auto;font-size: 15px;margin-bottom: 40px;height: auto;" href="24jun.html">ATURCARA 24 JUN 2020</a></div>
        </div>
    </section>
    <script src="assets/js/jquery.min.js"></script>
    <script src="assets/bootstrap/js/bootstrap.min.js"></script>
    <script>
        //guna jquery
        //untuk check bila tekan submit button, jika tiada data yang di parsing, akan keluar alert dekat page tu sendiri
        $('#submit').click(function() //bila guna # itu merujuk pada id, kalau guna . itu merujuk pada class
        {
            if($.trim($('#nostaf').val()) == '')
            {
                alert('No staf diperlukan!');
                return false;
            }
        });
    </script>
</body>
</html>
