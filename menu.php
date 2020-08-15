<?php
    session_start();
    include './php/dbconnect.php';      //need to put one dot because this file outside php folder

    if (empty($_SESSION["name"]) || empty($_SESSION["password"]))   //CHECK SESSION WHETHER NULL OR NOT
    {
        header("location: ./administrator.php"); 
    }
    else
    {
        ?>
            <!DOCTYPE html>
            <html>
            <head>
                <meta charset="utf-8">
                <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=yes">
                <title>Admin Bengkel Ceicnet</title>
                <link rel="stylesheet" href="assets/bootstrap/css/bootstrap.min.css">
                <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.21/css/jquery.dataTables.css">
                <link rel="stylesheet" href="assets/css/styles.css">
            </head>
            <body style="padding-right: 10px;padding-left: 10px;">
                <section>
                    <div class="row no-gutters text-right" style="padding-top: 11px;padding-left: 10px;">
                        <div class="col-12"><a class="btn btn-link" name="logout" type="button" href="./administrator.php" style="background-color: transparent;color: rgb(0,0,0);font-size: 15px;">LOG KELUAR</a></div>
                    </div>
                    <div class="row no-gutters text-center d-xl-flex justify-content-center align-items-center justify-content-xl-center" style="margin-top: 20px;width: auto;">
                        <div class="col-xl-11 text-center d-xl-flex justify-content-xl-center" style="padding-right: 0px;padding-left: 0px;"><img class="img-fluid d-xl-flex" style="background-image: url(&quot;jhkkj.png&quot;);height: 81px;width: 150px;" src="assets/img/LogoUniMAP2017.png" loading="auto"></div>
                    </div>
                </section>
                <section style="margin-top: 22px;width: auto;height: auto;"><span class="text-center d-flex justify-content-center" style="width: auto;height: auto;margin-bottom: 18px;font-size: 15px;color: rgb(0,0,0);padding-right: 20px;padding-left: 20px;padding-top: 8px;">ADMINISTRATOR</span>
                    <div class="row no-gutters d-flex justify-content-center align-items-center"
                        style="padding-bottom: 25px;padding-top: 20px;">
                        <div class="col d-flex justify-content-center"><a class="btn btn-primary" style="font-size: 15px;" role="button" href="tambah.php">TAMBAH PESERTA</a></div>
                    </div><span class="text-center d-flex justify-content-center" style="width: auto;height: auto;margin-bottom: 0px;font-size: 15px;color: rgb(0,0,0);padding-right: 20px;padding-left: 20px;padding-top: 8px;">Berikut merupakan senarai peserta yang mendaftar atau tidak mendaftar untuk setiap tarikh seperti yang berikut :</span></section>
                <!--<form method="POST" action="./menu.php">
                    <div class="form-row d-flex justify-content-center align-items-center" style="margin-top: 36px;">
                        <div class="d-flex justify-content-center align-items-center" style="padding-right: 10px;padding-left: 0px;"><button class="btn btn-primary d-flex justify-content-center align-items-center" id="23jun" name="submit" type="submit">23 Jun 2020</button></div>
                        <div class="d-flex justify-content-center align-items-center" style="padding-right: 0px;padding-left: 10px;"><button class="btn btn-primary d-flex justify-content-center align-items-center" id="24jun" name="submit" type="submit">24 Jun 2020</button></div>
                        <div class="d-flex justify-content-center align-items-center" style="padding-right: 0px;padding-left: 10px;"><button class="btn btn-primary d-flex justify-content-center align-items-center" id="18aug" name="submit" type="submit">18 Aug 2020</button></div>
                    </div>
                </form>-->
                
                    <!--<form method="POST" action="./menu.php">
                <section>
                    <div style="padding-top:17px; padding-left:10px; padding-right:10px;" class="form-group">
                        <span style="font-size: 14px;">Sila pilih kategori :</span><br><br>
                        <select class="selectpicker form-control" autofocus="autofocus" id="kategori" name="kategori" class="form-control">
                            <option value="daftar">Daftar</option>
                            <option value="tidak_daftar">Tidak Mendaftar</option>
                        </select>
                    </div>
                    <div style="padding-top:15px; padding-left:10px; padding-right:10px;" class="form-group">
                        <span style="font-size: 14px;">Sila pilih tarikh :</span><br><br>
                        <select class="selectpicker form-control" autofocus="autofocus" id="tarikh" name="tarikh" class="form-control">
                            <option value="23jun">23 Jun 2020</option>
                            <option value="24jun">24 Jun 2020</option>
                            <option value="13jun">13 Ogos 2020</option>
                        </select>
                    </div>
                </section>
                <div class="form-row" style="margin-top: 36px;">
                            <div class="col d-flex justify-content-center align-items-center"><button class="btn btn-primary d-flex justify-content-center align-items-center" id="submit" name="submit" type="submit">UBAH JADUAL</button></div>
                </div>
                </form>-->
                    <section style="padding-right: 20px;padding-left: 20px;padding-bottom: 20px;"><br><span class="text-center d-flex justify-content-center" style="width: auto;height: auto;margin-bottom: 0px;font-size: 15px;color: rgb(0,0,0);padding-right: 20px;padding-left: 20px;padding-top: 0px;"></span><br>
                    <?php
                        $bil = 0;

                        if (!$con)  //get data from dbconnect.php
                        {
                            die("Sambungan gagal : " . mysqli_connect_error());
                        }
                        else
                        {
                            //show table
                            ?>
                            <table style="font-size: 15px;" id="myTable" class="display"><thead>
                                <tr style="background-color:#000000">
                                    <th style="text-align: center; color:white">Bil.</th>
                                    <th style="color:white">Nama</th>
                                    <th style="text-align: center; color:white">No. Staf</th>
                                    <th style="text-align: center; color:white">Kumpulan</th>
                                    <th style="text-align: center; color:white">23 Jun 2020</th>
                                    <th style="text-align: center; color:white">24 Jun 2020</th>
                                    <th style="text-align: center; color:white">15 Aug 2020</th>
                                </tr></thead>
                            <?php

                            $query = mysqli_query($con,"SELECT * FROM data_user") or die ("Gagal untuk query database " .mysqli_error($query));
                            while ($row = mysqli_fetch_array($query))
                            {
                                $id = $row["id"];
                                $nama1 = $row["nama"];
                                $nostaf1 = $row["nostaf"];
                                $kumpulan1 = $row["kumpulan"];
                                $masa1 = $row["23_jun_masa"];
                                $masa2 = $row["24_jun_masa"];
                                $masa3 = $row["15_Aug_masa"];
                                $bil = $bil + 1;
                                ?>
                                    <tbody><form method="POST" action="./tambah.php"><tr>
                                        <td style="text-align: center;"><?php echo $bil ?></td>
                                        <td><?php echo $nama1 ?></td>
                                        <td style="text-align: center;"><?php echo $nostaf1 ?></td>
                                        <td style="text-align: center;"><?php echo $kumpulan1 ?></td>
                                        <td style="text-align: center;"><?php echo $masa1 ?></td>
                                        <td style="text-align: center;"><?php echo $masa2 ?></td>
                                        <td style="text-align: center;"><?php echo $masa3 ?></td>
                                    </tr></form>
                                <?php
                            }?></tbody></table>  <?php
                        }
                        ?>
                    </section>
            <script src="assets/js/jquery.min.js"></script>
            <script src="assets/bootstrap/js/bootstrap.min.js"></script>
            <script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.10.21/js/jquery.dataTables.js"></script>
            <script>
                $(document).ready( function () {
                    $('#myTable').DataTable();
                } );
            </script>  
            </body>
            </html>
        <?php
    }
?>