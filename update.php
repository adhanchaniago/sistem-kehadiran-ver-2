<?php
    session_start();
    include './php/dbconnect.php';      //need to put one dot because this file outside php folder

    //check session
    if (empty($_SESSION["name"]) || empty($_SESSION["password"]))
    {
        header("location: ./administrator.php");
    }
    else
    {
        //get data by id parse on url, to show on text input
        if (!empty($_GET['u']))
        {
            $id = $_GET['u'];

            $query = mysqli_query($con,"SELECT * FROM data_user WHERE id = $id") or die ("Gagal untuk query database " .mysqli_error($query));
            $row = mysqli_fetch_array($query);

            if($row['id'] == $id)
            {
                $id1 = $id;
                $nama1 = $row['nama'];
                $nostaf1 = $row['nostaf'];
                $kumpulan1 = $row['kumpulan'];
            }
        }
        //when click submit button from form
        if (isset($_POST['submit']))
        {
            $id = $_GET['u'];
            $nama = $_POST['nama'];
            $nostaf = $_POST['nostaf'];
            $kumpulan = $_POST['kumpulan'];

            if (empty($nama) || empty($nostaf) || empty($kumpulan))
            {
                ?>
                    <script type="text/javascript">
                        alert("Sila isi maklumat yang diperlukan");
                        location.replace("./update.php");
                    </script>
                <?php
                die();
            }
            else
            {
                if (!$con)
                {
                    die("Sambungan gagal : " . mysqli_connect_error());
                }
                else
                {
                    //update data
                    $UPDATE = "UPDATE data_user SET nama = '".$nama."', nostaf = '".$nostaf."', kumpulan = '".$kumpulan."' WHERE id = $id ";
                    $qry = mysqli_query($con,$UPDATE) or die ("Failed to query database" .mysqli_error($UPDATE));

                    if ($qry)
                    {
                        ?>
                            <script type="text/javascript">
                                alert("Anda berjaya untuk kemaskini maklumat anda");
                                location.replace("./tambah.php");
                            </script>
                        <?php
                        die();
                    }
                    else
                    {
                        ?>
                            <script type="text/javascript">
                                alert("Maaf, kemaskini anda gagal");
                                location.replace("./tambah.php");
                            </script>
                        <?php
                        die();
                    }
                }
            }
        }
        else if (empty($_GET['u']))
        {
            header("location: ./tambah.php");
        }
    }
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=yes">
    <title>Admin Bengkel Ceicnet</title>
    <link rel="stylesheet" href="assets/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="assets/css/styles.css">
</head>
<body style="padding-right: 5px;padding-left: 5px;">
    <section>
        <div class="row no-gutters text-right" style="padding-top: 11px;">
            <div class="col-12"><a class="btn btn-link" role="button" style="background-color: transparent;color: rgb(0,0,0);font-size: 15px;" href="administrator.php">LOG KELUAR</a></div>
        </div>
        <div class="row no-gutters text-center d-xl-flex justify-content-center align-items-center justify-content-xl-center" style="margin-top: 20px;width: auto;">
            <div class="col-xl-11 text-center d-xl-flex justify-content-xl-center" style="padding-right: 0px;padding-left: 0px;"><img class="img-fluid d-xl-flex" style="background-image: url(&quot;jhkkj.png&quot;);height: 81px;width: 150px;" src="assets/img/LogoUniMAP2017.png" loading="auto"></div>
        </div>
    </section>
    <section style="margin-top: 22px;width: auto;height: auto;margin-bottom: 40px;padding-right: 20px;padding-left: 20px;"><span class="text-center d-flex justify-content-center" style="width: auto;height: auto;margin-bottom: 18px;font-size: 15px;color: rgb(0,0,0);padding-right: 20px;padding-left: 20px;padding-top: 8px;padding-bottom: 14px;">Kemas Kini Peserta :</span>
        <form method="POST" action="./update.php?u=<?php echo $id1 ?>">
            <div class="form-row d-flex align-items-center" style="padding-bottom: 10PX;">
                <div class="col-3 d-flex align-items-center"><span style="font-size: 15px;">Nama</span></div>
                <div class="col-1 d-flex align-items-center"><span style="font-size: 15px;">:</span></div>
                <div class="col-8"><input value="<?php echo $nama1 ?>" name="nama" class="form-control" type="text" style="font-size: 15px;"></div>
            </div>
            <div class="form-row d-flex align-items-center" style="padding-bottom: 10PX;">
                <div class="col-3 d-flex align-items-center"><span style="font-size: 15px;">No Staf</span></div>
                <div class="col-1 d-flex align-items-center"><span style="font-size: 15px;">:</span></div>
                <div class="col-8"><input value="<?php echo $nostaf1 ?>" name="nostaf" class="form-control" type="number" style="font-size: 15px;" readonly></div>
            </div>
            <div class="form-row d-flex align-items-center" style="padding-bottom: 10PX;">
                <div class="col-3 d-flex align-items-center"><span style="font-size: 15px;">Kumpulan</span></div>
                <div class="col-1 d-flex align-items-center"><span style="font-size: 15px;">:</span></div>
                <div class="col-8"><input value="<?php echo $kumpulan1 ?>" name="kumpulan" class="form-control" type="text" style="font-size: 15px;"></div>
            </div>
            <div class="form-row text-center d-flex justify-content-center align-items-center" style="margin-top: 36px;">
                <div class="d-flex justify-content-center align-items-center" style="padding-right: 10px;padding-left: 0px;"><a class="btn btn-primary d-flex justify-content-center align-items-center" style="font-size: 15px;" role="button" href="tambah.php">KEMBALI</a></div>
                <div class="d-flex justify-content-center align-items-center" style="padding-right: 0px;padding-left: 10px;"><button class="btn btn-primary d-flex justify-content-center align-items-center" style="font-size: 15px;" name="submit" type="submit">KEMAS KINI</button></div>
            </div>
        </form>
    </section>
    <script src="assets/js/jquery.min.js"></script>
    <script src="assets/bootstrap/js/bootstrap.min.js"></script>
</body>
</html>