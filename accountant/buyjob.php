<?php
        session_start();
        include('include/connection.php');

        $id=$_GET['id'];
        
        $Aid=$_SESSION['id'];
        $message = "Bought lead #".$id;
        $date=date('Y/m/d');
        $query="SELECT * FROM `job` WHERE Jid = $id";
        // echo $query;die;
        
        $run = mysqli_query($conn,$query);
        $row = mysqli_fetch_array($run);
        $credits= $row['Jcredits'];
        $sql="SELECT * FROM  `total_credits`  WHERE `Aid`=$Aid";

        $run2 = mysqli_query($conn,$sql);
        $row2 = mysqli_fetch_array($run2);
        //  echo "<pre>";print_r($row2);die;
        if(isset($row2['tcr_amount']) && $row2['tcr_amount']>=$credits){
                $query1=("INSERT INTO `buy` ( `Jid`, `Aid`, `buydate`, `bcredits`, `bSts`, `admId`) VALUES ( '$id', '$Aid', '$date', '$credits', '1', NULL)");
                if( mysqli_query($conn,$query1)){
                        $insert_log= "INSERT INTO `credit_logs`(`Jid`, `Aid`, `credit`, `message`, `created`) VALUES ('$id', '$Aid','-".$credits."','$message',now())";
                        $dataLog=mysqli_query($conn,$insert_log);
                        // mysqli_query($conn,'UPDATE `job` SET distanceKm = "'.$distance.'" WHERE Jid="'.$id.'" ');
                        echo "<script> alert('Job Bought') </script>";
                        echo "$Aid"; 
                        $tcr= $row2['tcr_amount']-$credits;
                        echo "$tcr";
                        $sql1="UPDATE `total_credits` SET `tcr_amount`='$tcr' WHERE `Aid`=$Aid";
                        $run3 = mysqli_query($conn,$sql1);
                        header("Location:availableleads.php");
                        // echo "<meta http-equiv='refresh' content='0;availableleads.php'>";
                }
        }
        else{
                ?>
                <script>
                        alert("You don't have credits")
                        window.location.href = "buycredit.php";
                </script>
                <?php
                // echo "<script> alert('Not Enough Credits')</script>";
                // header("Location:buycredit.php");
        }
?>