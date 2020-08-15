<?php
    session_start();
    date_default_timezone_set("Asia/Kuala_Lumpur");
    include '../php/dbconnect.php';                         //need to put double dot because this file inside php folder    //include this file

    if ($_SERVER['HTTP_REFERER'] == !'../index.php')
    { 
        header("location: ../index.php");
    }
    else
    {
        $nostaf = $_POST['nostaf'];
            
        if (empty($nostaf))
        {
            ?>   
                <script type="text/javascript">
                    alert("No staf diperlukan"); 
                    location.replace("../index.php");
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
                $staf = mysqli_query($con,"SELECT * FROM data_user WHERE nostaf = '".$_POST['nostaf']."'") or die ("Gagal untuk query database" .mysqli_error($staf));
                $row = mysqli_fetch_array($staf);

                if($row['nostaf'] == $nostaf)
                {
                    $nostaf1 = $row['nostaf'];
                    $_SESSION["nostaf"] = $nostaf1;

                    if (date("d-m-Y") == '15-08-2020')
                    {
                        if ($row['15_Aug_tarikh'] == '' && $row['15_Aug_masa'] == '')
                        {
                            $tarikh = date("d-m-Y");
                            $masa = date("h:i:sa");
                            
                            $sql = "UPDATE data_user SET 15_Aug_tarikh = '".$tarikh."', 15_Aug_masa = '".$masa."' WHERE nostaf = '".$_POST['nostaf']."'";

                            if ($con->query($sql) === TRUE) 
                            {
                                ?>   
                                    <script type="text/javascript">
                                        alert("Anda berjaya sahkan kehadiran untuk 15 August 2020");  
                                        location.replace("../sahkan.php");
                                    </script>
                                <?php
                                die();
                            } 
                            else 
                            {
                                ?>   
                                    <script type="text/javascript">
                                        alert("Anda tidak berjaya sahkan kehadiran untuk 15 Aug 2020");
                                        location.replace("../index.php");
                                    </script>
                                <?php
                                die();
                            }
                            $con->close();
                        }
                        else
                        {
                            ?>   
                                <script type="text/javascript">
                                    alert("Anda sudah sahkan kehadiran untuk 15 August 2020");
                                    location.replace("../sahkan.php");
                                </script>
                            <?php
                            die();
                        }
                    }
                    else if (date("d-m-Y") == '23-06-2020')
                    {
                        if ($row['23_jun_tarikh'] == '' && $row['23_jun_masa'] == '')
                        {
                            $tarikh = date("d-m-Y");
                            $masa = date("h:i:sa");

                            $sql = "UPDATE data_user SET 23_jun_tarikh = '".$tarikh."', 23_jun_masa = '".$masa."' WHERE nostaf = '".$_POST['nostaf']."'";

                            if ($con->query($sql) === TRUE) 
                            {
                                ?>   
                                    <script type="text/javascript">
                                        alert("Anda berjaya sahkan kehadiran untuk 23 Jun 2020"); 
                                        location.replace("../sahkan.php");
                                    </script>
                                <?php
                                die();
                            } 
                            else 
                            {
                                ?>   
                                    <script type="text/javascript">
                                        alert("Anda tidak berjaya sahkan kehadiran untuk 23 Jun 2020");
                                        location.replace("../index.php");
                                    </script>
                                <?php
                                die();
                            }
                            $con->close();
                        }
                        else
                        {
                            ?>   
                                <script type="text/javascript">
                                    alert("Anda sudah sahkan kehadiran untuk 23 Jun 2020"); 
                                    location.replace("../sahkan.php");
                                </script>
                            <?php
                            die();
                        }
                    }
                    else if (date("d-m-Y") == '24-06-2020')
                    {
                        if ($row['24_jun_tarikh'] == '' && $row['24_jun_masa'] == '')
                        {
                            $tarikh = date("d-m-Y");
                            $masa = date("h:i:sa");
                            
                            $sql = "UPDATE data_user SET 24_jun_tarikh = '".$tarikh."', 24_jun_masa = '".$masa."' WHERE nostaf = '".$_POST['nostaf']."'";

                            if ($con->query($sql) === TRUE) 
                            {
                                ?>   
                                    <script type="text/javascript">
                                        alert("Anda berjaya sahkan kehadiran untuk 24 Jun 2020"); 
                                        location.replace("../sahkan.php");
                                    </script>
                                <?php
                                die();
                            } 
                            else 
                            {
                                ?>   
                                    <script type="text/javascript">
                                        alert("Anda tidak berjaya sahkan kehadiran untuk 24 Jun 2020");
                                        location.replace("../index.php");
                                    </script>
                                <?php
                                die();
                            }
                            $con->close();
                        }
                        else
                        {
                            ?>
                                <script type="text/javascript">
                                    alert("Anda sudah sahkan kehadiran untuk 24 Jun 2020");
                                    location.replace("../sahkan.php");
                                </script>
                            <?php
                            die();
                        }
                    }
                    else
                    {
                        ?>
                            <script type="text/javascript">
                                alert("Anda hanya boleh sahkan kehadiran pada 23 Jun 2020 dan 24 Jun 2020 sahaja");
                                location.replace("../index.php");
                            </script>
                        <?php
                        die();
                    }
                }
                else
                {
                    ?>
                        <script type="text/javascript">
                            alert("Maklumat anda tiada dalam sistem");
                            location.replace("../index.php");
                        </script>
                    <?php
                    die();
                }
            }
        }
    }
?>