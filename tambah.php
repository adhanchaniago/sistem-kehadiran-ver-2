<?php
    session_start();
    include './php/dbconnect.php';      //need to put one dot because this file outside php folder

    //get data from script - DELETE
    if(isset($_GET['d']))
    {
        $d = $_GET['d'];

        if (!$con)
        {
            die("Sambungan gagal : " . mysqli_connect_error());
        }
        else
        {
            $del = mysqli_query($con,"DELETE FROM data_user WHERE id = $d") or die ("Gagal untuk query database " .mysqli_error($del));
            header("Location: ./tambah.php");
        }
    }

    //check session
    if (empty($_SESSION["name"]) || empty($_SESSION["password"]))
    {
        header("location: ./administrator.php");
    }
    else
    {
        //when click submit button from form
        if (isset($_POST['submit']))
        {
            $nama = $_POST['nama'];
            $nostaf = $_POST['nostaf'];
            $kumpulan = $_POST['kumpulan'];

            if (empty($nama) || empty($nostaf) || empty($kumpulan))
            {
                ?>
                    <script type="text/javascript">
                        alert("Sila isi maklumat yang diperlukan ");
                        location.replace("./tambah.php");
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
                    //insert data
                    $SELECT = "SELECT nostaf FROM data_user WHERE nostaf = ? LIMIT 1";          //LIMIT BY ONLY 1 NOSTAF
                    $INSERT = "INSERT INTO data_user(nama, nostaf, kumpulan) values(?,?,?)";

                    $stmt = $con->prepare($SELECT);
                    $stmt->bind_param("s",$nostaf);
                    $stmt->execute();
                    $stmt->bind_result($nostaf);
                    $stmt->store_result();
                    $rnum = $stmt->num_rows;

                    if ($rnum==0)
                    {
                        $stmt->close();
                        $stmt = $con->prepare($INSERT);
                        $stmt->bind_param("sss",$nama, $nostaf, $kumpulan);
                        $stmt->execute();
                        ?>
                            <script type="text/javascript">
                                alert("Anda berjaya untuk menambah peserta ");
                                location.replace("./tambah.php");
                            </script>
                        <?php
                        die();
                    }
                    else if ($rnum==1)
                    {
                        ?>
                            <script type="text/javascript">
                                alert("Peserta berikut telah wujud :\n\nNama   :  <?php echo $nama ?> \nNo Staf :  <?php echo $nostaf ?>");
                                location.replace("./tambah.php");
                            </script>
                        <?php
                        die();
                    }
                    else
                    {
                        ?>
                            <script type="text/javascript">
                                alert("Anda tidak berjaya untuk menambah peserta ");
                                location.replace("./tambah.php");
                            </script>
                        <?php
                        die();
                    }
                    $stmt->close();
                    $con->close();
                }
            }
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
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.21/css/jquery.dataTables.css">
    <!--<link rel="stylesheet" href="//netdna.bootstrapcdn.com/bootstrap/3.0.0/css/bootstrap.min.css">-->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.css">
    <link rel="icon" href="./assets/img/LogoUniMAP2017.png">
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
    <section style="margin-top: 22px;width: auto;height: auto;margin-bottom: 40px;padding-right: 20px;padding-left: 20px;"><span class="text-center d-flex justify-content-center" style="width: auto;height: auto;margin-bottom: 18px;font-size: 15px;color: rgb(0,0,0);padding-right: 20px;padding-left: 20px;padding-top: 8px;padding-bottom: 14px;">Tambah Peserta :</span>
        <form method="POST" action="./tambah.php">
            <div class="form-row d-flex align-items-center" style="padding-bottom: 25PX;">
                <!--<div class="col-4 d-flex align-items-center"><span style="font-size: 15px;">Nama</span></div>-->
                <div class="col-12"><input name="nama" placeholder="Nama" class="form-control" type="text" style="font-size: 15px;" required></div>
            </div>
            <div class="form-row d-flex align-items-center" style="padding-bottom: 25PX;">
                <!--<div class="col-4 d-flex align-items-center"><span style="font-size: 15px;">No Staf</span></div>-->
                <div class="col-12"><input name="nostaf" placeholder="No Staf" class="form-control" type="number" style="font-size: 15px;" required></div>
            </div>
            <div class="form-row d-flex align-items-center" style="padding-bottom: 10PX;">
                <!--<div class="col-4 d-flex align-items-center"><span style="font-size: 15px;">Kumpulan</span></div>-->
                <div class="col-12"><input name="kumpulan" placeholder="Kumpulan" class="form-control" type="text" style="font-size: 15px;" required></div>
            </div>
            <div class="form-row d-flex justify-content-center align-items-center" style="margin-top: 36px;">
                <div class="d-flex justify-content-center align-items-center" style="padding-right: 10px;padding-left: 0px;"><a class="btn btn-primary d-flex justify-content-center align-items-center" style="font-size: 15px;" role="button" href="menu.php">KEMBALI</a></div>
                <div class="d-flex justify-content-center align-items-center" style="padding-right: 0px;padding-left: 10px;"><button class="btn btn-primary d-flex justify-content-center align-items-center" style="font-size: 15px;" id="submit" name="submit" type="submit">TAMBAH</button></div>
            </div>
        </form>
    </section>
    <section style="padding-right: 20px;padding-left: 20px;padding-bottom: 60px;"><br><span class="text-center d-flex justify-content-center" style="width: auto;height: auto;margin-bottom: 18px;font-size: 15px;color: rgb(0,0,0);padding-right: 20px;padding-left: 20px;padding-top: 8px;">Berikut merupakan senarai peserta yang sedia ada :</span><br>
    
    <?php
        $bil = 0;

        if (!$con)
        {
            die("Sambungan gagal : " . mysqli_connect_error());
        }
        else
        {
            //show table
            $query = mysqli_query($con,"SELECT * FROM data_user") or die ("Gagal untuk query database " .mysqli_error($query));
            ?>
                <table style="font-size: 15px;" id="myTable" class="display"><thead>
                <tr style="background-color:#000000">
                    <th style="text-align: center; color:white">Bil.</th>
                    <th style="color:white">Nama</th>
                    <th style="text-align: center; color:white">No. Staf</th>
                    <th style="text-align: center; color:white">Kumpulan</th>
                    <th style="text-align: center; color:white">&nbsp;</th>
                    <th style="text-align: center; color:white">&nbsp;</th>
                </tr></thead>
            <?php
            while ($row = mysqli_fetch_array($query))
            {
                $id = $row["id"];
                $nama1 = $row["nama"];
                $nostaf1 = $row["nostaf"];
                $kumpulan1 = $row["kumpulan"];
                $bil = $bil + 1;
                ?>
                    <tbody><form method="POST" action="./tambah.php"><tr>
                        <td style="text-align: center;"><?php echo $bil ?></td>
                        <td><?php echo $nama1 ?></td>
                        <td style="text-align: center;"><?php echo $nostaf1 ?></td>
                        <td style="text-align: center;"><?php echo $kumpulan1 ?></td>
                        <td style="text-align: center;"><a href="./update.php?u=<?php echo $id ?>"><span style="font-size: 20px;" aria-hidden="true" class="fa fa-pencil"></span></a></td>
                        <td style="text-align: center;"><a href="javascript:d('<?php echo $id ?>','<?php echo $nama1 ?>','<?php echo $nostaf1 ?>')"><span style="font-size: 20px;" aria-hidden="true" class="fa fa-trash"></span></a></td>
                    </tr></form>
                <?php
            }?></tbody></table>  <?php
        }
        ?>
    </section>
    <script src="assets/js/jquery.min.js"></script>
    <script src="assets/bootstrap/js/bootstrap.min.js"></script>
    <script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.10.21/js/jquery.dataTables.js"></script>
    <!-- parse id to delete -->
    <script type="text/javascript">
        function d(id,na,no)
        {
            if(confirm('Anda pasti hendak padam peserta ? \n\n'+na+'  ,  '+no+' '))
            {
                window.location.href='tambah.php?d='+id;
            }
        }
    </script>
    <script>
        $(document).ready( function () 
        {
            $('#myTable').DataTable();
        });
    </script>             
</body>
</html>
