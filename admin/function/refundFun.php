<?php  
        ///////////////////// select from buy job table   ///////////////////////////////
        function refFun($conn,$sts){
                /*$query="SELECT * FROM `refund`
                        JOIN buy ON refund.bid=buy.bid
                        JOIN accountant ON buy.Aid=accountant.Aid 
                        WHERE RSts='$sts'
                        order by refund.requestdate desc";*/
                $query="select ref.Rid, ref.requestdate, ref.rdesc, ref.RSts, 
                        buy.bcredits, buy.Aid, 
                        job.Jid, job.Jtitle, job.company, job.email as jemail,
                        acc.Aname, acc.Aemail
                        from refund ref
                        join buy on ref.bid=buy.bid
                        join job on job.Jid=buy.Jid
                        join accountant acc on acc.Aid=buy.Aid
                        WHERE RSts='$sts'
                        order by ref.requestdate desc";
                $run = mysqli_query($conn,$query);
                return $run;
                /*if (mysqli_num_rows($run) > 0) {
                        return $run;
                }
                else{
                        die();
                }*/
        }

        ////////////////////////// Delete refund request  ///////////////////////////////
        if (isset($_GET["rrr"])) {
                $del_id = $_GET["rrr"];
                // $del_id2 = $_GET["cid"];
                $query="DELETE FROM refund WHERE Rid='$del_id'";
                // $query2="DELETE FROM company WHERE cid='$del_id2'";
                $run = mysqli_query($conn,$query);
                //   $run2 = mysqli_query($conn,$query2);
                if ($run) {
                        echo "<script>alert('refund Request have been Deleted.');</script>";
                        echo "<meta http-equiv='refresh' content='0;refundrequest.php'>" ;
                }
        }

        ////////////////////////// Delete refund   ///////////////////////////////
        if (isset($_GET["rraa"])) {
                $del_id = $_GET["rraa"];
                // $del_id2 = $_GET["cid"];
                $query="DELETE FROM refund WHERE Rid='$del_id'";
                // $query2="DELETE FROM company WHERE cid='$del_id2'";
                $run = mysqli_query($conn,$query);
                //   $run2 = mysqli_query($conn,$query2);
                if ($run) {
                        echo "<script>alert('refund Request have been Deleted.');</script>";
                        echo "<meta http-equiv='refresh' content='0;refundhistory.php'>" ;
                }
        }
        /////////////////////// Approve the refund bought .update query   ///////////////////////////////

        if (isset($_POST["approved"])) {
                $rid=mysqli_real_escape_string($conn,$_POST["rid"]);
                $credit=mysqli_real_escape_string($conn,$_POST["credit"]);
                $aid=mysqli_real_escape_string($conn,$_POST["aid"]);
                $sts=mysqli_real_escape_string($conn,$_POST["sts"]);
                $redesc=mysqli_real_escape_string($conn,$_POST["reason"]);
                $adid=$_SESSION["id"];

           

                $buy_details = "SELECT bid FROM refund WHERE rid = '$rid'";
                $buy_details_query= mysqli_query($conn,$buy_details);
                $buy_details_results = mysqli_fetch_array($buy_details_query);
                $bid = $buy_details_results["bid"];
                $update_bsts="UPDATE `buy` SET bSts = 0 WHERE bid='$bid'";
                $bsts= mysqli_query($conn,$update_bsts);


                // echo "<script>alert('$rid,$credit,$aid,$sts,$redesc');</script>";
                $query="SELECT * FROM `total_credits` WHERE Aid='$aid'";
                $run = mysqli_query($conn,$query);
                $row = mysqli_fetch_array($run); 
                $remain= $row["tcr_amount"]+$credit;

                $refund = "UPDATE refund SET `RSts`='$sts', `admindesc`='$redesc',`amId`='$adid' WHERE Rid='$rid'";
                // $select = "SELECT bid FROM `buy` WHERE "
                // $query="UPDATE `buy` SET bts = 0 WHERE Aid='$aid' AND WHERE Jid = $";
                $totcred="UPDATE `total_credits` SET `tcr_amount`='$remain' WHERE Aid='$aid'";
                if($sts==1){
                        if (mysqli_query($conn,$refund) AND mysqli_query($conn,$totcred)) {
                                echo "<script>alert('Refund Request Has been Accepted And Credits Refunded.');</script>";
                                echo "<meta http-equiv='refresh' content='0;refundrequest.php'>";
                        }
                }
                else{
                        mysqli_query($conn,$refund);
                        echo "<script>alert('Refund Request Has been Rejected.');</script>";
                        echo "<meta http-equiv='refresh' content='0;refundrequest.php'>";
                }
        }

?>