<?php
        session_start();
        if (!isset($_SESSION["id"])) {
                echo "<script>window.location.href='login.php'</script>";
        }
        include("include/head.php");
        include("function/jobFun.php");
        $query="SELECT bid FROM `refund` WHERE RSts='1' OR RSts='2'";
        $run = mysqli_query($conn,$query);
        $arrRefundIDs = array();
        while($rstRow=mysqli_fetch_array($run))
        {
                $arrRefundIDs[] = $rstRow['bid'];
        }

?>
<body>
        <!-- Page Parent -->
        <div class="pageParent">
                <!-- Side Menu -->
                <?php  include("include/sidebar.php"); ?>
                <!-- Page Contents -->
                <div class="pageContents" style="margin-top:-30px;">
                        <div class="contentsHeader d-flex p-0">
                                <h1 class="mainHeading mr-5">Job Bought History </h1>
                        </div>
                        <div class="mainTable mt-4">
                                <table id="myTable" class="table table-striped">
                                        <thead>
                                                <tr>
                                                        <th>Lead#</th>
                                                        <th>Accountant</th>
                                                        <th>Email</th>
                                                        <th>Job Title</th>
                                                        <th>Credit</th>
                                                        <th>Date</th>
                                                        <!-- <th>Status</th> -->
                                                        <th>Action</th>
                                                </tr>
                                        </thead>
                                        <tbody>
                                                <?php 
                                                        $cnt=1;
                                                        $sts=1;
                                                        $run = buyFun($conn,$sts);
                                                        while ($row = mysqli_fetch_array($run)) {
                                                                ?>
                                                                <tr>
                                                                        <td><?php echo $row['Jid']; ?></td>
                                                                        <td><?php echo $row["Aname"]; ?></td>
                                                                        <td><?php echo $row["Aemail"]; ?></td>
                                                                        <td><?php echo $row["Jtitle"]; ?></td>
                                                                        <td>
                                                                                <?php
                                                                                        $nBid = $row['bid'];
                                                                                        if(in_array($nBid, $arrRefundIDs))
                                                                                        {
                                                                                                echo "-";
                                                                                        }
                                                                                        echo $row["bcredits"];
                                                                                ?>
                                                                        </td>
                                                                        <td><?php echo $row["buydate"]; ?></td>
                                                                        <?php
                                                                        /*
                                                                        <td>
                                                                                <?php 
                                                                                        if($row["bSts"]==1){
                                                                                                echo "<div class='approved'>Approved</div>";
                                                                                        }else
                                                                                        {
                                                                                                ?>
                                                                                                <div class='approved'>
                                                                                                        <i class='fa-solid '></i>Pending
                                                                                                </div>
                                                                                                <?php
                                                                                        }
                                                                                ?>
                                                                        </td>
                                                                        */
                                                                        ?>
                                                                        <td class="d-flex">
                                                                                <a class="btn btn-outline-danger" onclick="return confirm('Are you Sure to Delete!')" href="jobhistory.php?byid=<?php echo $row['bid'];?>" ><i class="fas fa-trash-alt"></i></button>
                                                                                <a class="btn btn-outline-info"  href="boughtjobdetail.php?jddet=<?php echo $row['Jid'];?>" style="margin-left: 12px;" ><i class="fas fa-eye"></i></a>
                                                                        </td>
                                                                </tr>
                                                                <?php
                                                                $cnt++;
                                                        }
                                                ?>
                                        </tbody>
                                </table>
                                <!-- End Collapse -->
                                <!-- Table -->
                        </div>
                </div>
        </div>
        <?php include("include/footer.php"); ?>
</body>
</html>
