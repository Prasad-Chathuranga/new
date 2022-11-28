<?php
        session_start();
        error_reporting(E_ALL);
        ini_set("display_errors", "On");
        if (!isset($_SESSION["id"])) {
                echo "<script>window.location.href='login.php'</script>";
        }
        include("include/head.php");  
        include("function/refundFun.php");  
?>
<body>
        <!-- Page Parent -->
        <div class="pageParent">
                <!-- Side Menu -->
                <?php  include("include/sidebar.php"); ?>
                <!-- Page Contents -->
                <div class="pageContents" style="margin-top:-30px;">
                        <div class="contentsHeader d-flex p-0">
                                <h1 class="mainHeading mr-5">Refund Requests </h1>
                        </div> 
                        <div class="mainTable mt-4">
                                <table id="myTable" class="table table-striped">
                                        <thead>
                                                <tr>
                                                        <th>Refund ID</th>
                                                        <th>Lead ID</th>
                                                        <th>Accountant</th>
                                                        <th>Lead Company</th>
                                                        <th>Lead Title</th>
                                                        <th>E-mail</th>
                                                        <th>Credit</th>
                                                        <th>Request Date</th>
                                                        <th>Request Description</th>
                                                        <th>Status</th>
                                                        <th>Action</th>
                                                </tr>
                                            
                                        </thead>
                                        <tbody>
                                                <?php 
                                                        //$cnt=1;
                                                        $sts=0;
                                                        $run = refFun($conn,$sts);
                                                        while ($row = mysqli_fetch_array($run)) {
                                                                ?>
                                                                <tr>
                                                                        <td><?php echo $row['Rid'];?></td>
                                                                        <td><?php echo $row['Jid'];?></td>
                                                                        <td><?php echo $row["Aname"];?></td>
                                                                        <td><?php echo $row["company"];?></td>
                                                                        <td><?php echo $row['Jtitle'];?></td>
                                                                        <td><?php echo $row["jemail"];?></td>
                                                                        <td><?php echo $row["bcredits"];?></td>
                                                                        <td><?php echo $row["requestdate"];?></td>
                                                                        <td><?php echo $row["rdesc"];?></td>
                                                                        <td>
                                                                                <?php
                                                                                        if($row["RSts"]==1)
                                                                                        {
                                                                                                ?>
                                                                                                <div class='approved'><i class='fa-solid fa-check'></i>Approved</div>
                                                                                                <?php
                                                                                        }
                                                                                        else{
                                                                                                ?>
                                                                                                <div class='approved'>
                                                                                                        <i class='fa-solid '></i>Pending
                                                                                                </div>
                                                                                                <?php
                                                                                        }
                                                                                ?>
                                                                        </td>
                                                                        <td class="d-flex">
                                                                                <button class="btn pdfButton btn-outline-success" onclick="getFunc(<?php echo $row['Rid']?>,'<?php echo $row['bcredits']?>','<?php echo $row['Aid']; ?>')" data-toggle="modal" data-target="#myModal">
                                                                                        Action
                                                                                </button>
                                                                                <a class="btn btn-outline-danger" onclick="return confirm('Are you Sure to Delete!')" href="refundrequest.php?rrr=<?php echo $row['Rid'];?>" ><i class="fas fa-trash-alt"></i></a>
                                                                        </td>
                                                                </tr>
                                                                <?php  
                                                                //$cnt++; 
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
        <!-- The alert job Modal -->
        <div class="modal fade" id="myModal">
                <div class="modal-dialog">
                        <div class="modal-content">
                                <form action="" method="post">
                                        <!-- Modal Header -->
                                        <div class="modal-header">
                                                <h4 class="modal-title"> Refund Request Acceptance</h4>
                                                <button type="button" class="btn-close" data-dismiss="modal">X</button>
                                        </div>
                                        <div class="modal-body">
                                                <div class="form-group">
                                                        <label for="name">Accept or Reject: </label><br>
                                                        <div class="d-flex">
                                                                <div class="form-check">
                                                                        <label class="form-check-label">
                                                                                <input type="radio" name="sts" class="form-check-input" value=1 required>Approved
                                                                        </label>
                                                                </div>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                                                <div class="form-check">
                                                                        <label class="form-check-label">
                                                                                <input type="radio" name="sts" class="form-check-input" value=2 required>Not Approved
                                                                        </label>
                                                                </div>
                                                        </div> 
                                                </div>
                                                <div class="form-group">
                                                        <label for="name">Accept/Reject Reason:</label>
                                                        <textarea name="reason" class="form-control" placeholder="Write the reason of refund." rows="10" cols="40"  required></textarea>
                                                </div>
                                        </div>
                                        <!-- Modal footer -->
                                        <div class="modal-footer">
                                                <input type="text" id="bid" name="rid" hidden>
                                                <input type="text" name="credit" id="cred" hidden>
                                                <input type="text" name="aid" id="aid" hidden>
                                                <button type="submit" class="btn btn-primary" name="approved">Ok</button>
                                                <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                                        </div>
                                </form>
                        </div>
                </div>
        </div>
        <script>
                function getFunc(rid,cred,aid) {
                        // alert(jid);
                        $("#bid").val(rid);
                        $("#cred").val(cred);
                        $("#aid").val(aid);
                }
        </script>
</body>
</html>
