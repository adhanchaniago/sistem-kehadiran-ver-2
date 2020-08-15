<?php
    session_start();                    //START SESSION
    //session_destroy();                //REMOVE ALL SESSION
    //session_unset();                  //UNSET ALL SESSION
    unset($_SESSION["name"]);           //UNSET SELECTED SESSION
    unset($_SESSION["password"]);
    include './php/dbconnect.php';      //need to put one dot because this file outside php folder

    if (isset($_POST['submit']))        //WHEN CLICK SUBMIT BUTTON
    {
        $nama = $_POST['nama'];
        $password = $_POST['password'];

        if (empty($password) || empty($nama))
        {
            ?>
                <script type="text/javascript">
                    alert("Sila isi maklumat yang diperlukan");
                    location.replace("./administrator.php");
                </script>
            <?php
            die();
        }
        else
        {
            if (!$con)  //get data from dbconnect.php
            {
                die("Sambungan gagal : " . mysqli_connect_error());
            }
            else
            {
                $query = mysqli_query($con,"SELECT * FROM admin WHERE name = '".$_POST['nama']."' AND password = '".$_POST['password']."' ") or die ("Gagal untuk query database " .mysqli_error($query));
                $row = mysqli_fetch_array($query);
                if($row['name'] == $nama && $row['password'] == $password)
                {
                    $_SESSION["name"] = $row['name'];               //INSERT SESSION
                    $_SESSION["password"] = $row['password'];       //INSERT SESSION
                    header("location: ./menu.php"); 
                }
                else
                {
                    ?>
                        <script type="text/javascript">
                            alert("Nama atau Kata laluan yang dimasukkan salah");
                            location.replace("./administrator.php");
                        </script>
                    <?php
                    die();
                }
            }
        }
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
                <link rel="stylesheet" href="assets/css/styles.css">
                <link rel="icon" href="./assets/img/LogoUniMAP2017.png">
            </head>
            <body style="padding-left: 5px;padding-right: 5px;">
                <section>
                    <div class="row no-gutters text-center d-xl-flex justify-content-center align-items-center justify-content-xl-center" style="margin-top: 20px;width: auto;">
                        <div class="col-xl-11 text-center d-xl-flex justify-content-xl-center" style="padding-right: 0px;padding-left: 0px;"><img class="img-fluid d-xl-flex" style="background-image: url(&quot;jhkkj.png&quot;);height: 81px;width: 150px;" src="assets/img/LogoUniMAP2017.png" loading="auto"></div>
                    </div>
                    <section style="margin-top: 22px;width: auto;height: auto;"><span class="text-center d-flex justify-content-center" style="width: auto;height: auto;margin-bottom: 18px;font-size: 15px;color: rgb(0,0,0);padding-right: 20px;padding-left: 20px;padding-top: 8px;">ADMINISTRATOR</span><span class="text-center d-flex justify-content-center"
                            style="width: auto;height: auto;margin-bottom: 18px;font-size: 15px;color: rgb(0,0,0);padding-right: 20px;padding-left: 20px;padding-top: 8px;">BENGKEL STRATEGIK<br>PUSAT KEUSAHAWANAN, JARINGAN INDUSTRI &amp; MASYARAKAT (CEICnet)<br>UNIVERSITI MALAYSIA PERLIS</span></section>
                </section>
                <section style="text-align: center; margin-top: 46px;padding-left: 20px;padding-top: 10px;padding-bottom: 10px;padding-right: 20px;">
                    <form method="POST" action="./administrator.php">
                        <div class="form-row d-flex align-items-center" style="padding-bottom: 20PX;">
                            <!--<div class="col-4 d-flex align-items-center"><span style="font-size: 15px;">Nama</span></div>-->
                            <div class="col-12 d-flex align-items-center"><input placeholder="Nama" name="nama" class="form-control" type="text" style="font-size: 15px;" required></div>
                        </div>
                        <div class="form-row d-flex align-items-center" style="padding-bottom: 10PX;padding-top: 10PX;">
                            <!--<div class="col-4 d-flex align-items-center"><span style="font-size: 15px;">Kata Laluan</span></div>-->
                            <div class="col-12 d-flex align-items-center"><input placeholder="Kata Laluan" name="password" class="form-control" type="text" style="font-size: 15px;" required></div>
                        </div>
                        <div class="form-row" style="margin-top: 36px;">
                            <div class="col d-flex justify-content-center align-items-center"><button class="btn btn-primary d-flex justify-content-center align-items-center" style="font-size: 15px;" id="submit" name="submit" type="submit">LOG MASUK</button></div>
                        </div>
                    </form>
                </section>
                <script src="assets/js/jquery.min.js"></script>
                <script src="assets/bootstrap/js/bootstrap.min.js"></script>
            </body>
            </html>
        <?php
    }
?>

