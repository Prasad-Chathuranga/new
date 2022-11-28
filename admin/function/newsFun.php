<?php 


////////////////////////// select   ///////////////////////////////
function newsFun($conn){
    $query="SELECT * FROM news ORDER BY NId DESC";
    $run = mysqli_query($conn,$query);
    if (mysqli_num_rows($run) > 0) {
        return $run;
    }else{
       echo "<script>alert('No Data Found');</script>";
       die();
   }  
 }
 
     ////////////////////////// Delete   ///////////////////////////////
  
     if (isset($_GET["id"])) {
        $del_id = $_GET["id"];
      
        $query="DELETE FROM news WHERE NId='$del_id'";
      $run = mysqli_query($conn,$query);
       
      }

    //////////////////////// insert News  //////////////////////////////////
 if (isset($_POST["submit"])) {
  $upload_directory    = "uploadedImages/newsavatar.gif";
    $dname=mysqli_real_escape_string($conn,$_POST["title"]);
    $ddesc=mysqli_real_escape_string($conn,$_POST["ndesc"]);
    if ($_FILES["nimage"]["name"]!=null) {
      // $$upload_directory= "uploadedImages/IMG_0040.JPG";
    $upload_directory    = "uploadedImages/";     // define path  
        $filename            = $_FILES["nimage"]["name"];
        $upload_directory   .= $filename;
        $tmp_dir             = $_FILES["nimage"]["tmp_name"];
        $size                = $_FILES["nimage"]["size"];
        $ext                 = pathinfo($filename,PATHINFO_EXTENSION);

        if ($ext == 'jpg' OR $ext == 'jpeg' OR $ext == 'png' OR $ext == 'gif' OR $ext == 'JPG' OR $ext == 'JPEG' OR $ext == 'PNG' OR $ext == 'GIF') 
        {
               if (move_uploaded_file($tmp_dir,$upload_directory)) 
            {   
            //   echo "<script> alert('$dname,$ddesc,$upload_directory')</script>";
         
                
            }else{
              echo "<script> alert('Error. move upload')</script>";

            }
        }else {
          echo "<script> alert('Error. File must be JPG,JPEG,PNG,GIF,jpg,jpeg,png,gif')</script>";

        }
    }
    
        $sql = ("INSERT INTO news(NTitle,NDetail,NPicture) values('$dname','$ddesc','$upload_directory')");
                  if (mysqli_query($conn,$sql)) {
                    echo "<script> 
                    alert('Data have Been Saved.');
                         </script>";
                  echo "<meta http-equiv='refresh' content='0;news.php'>" ;
                  }else {
                    echo "<script> alert('Error. Data not Saved')</script>";
                    // echo "error :".$sql. "<br>". $conn->error;
                  }
    }

     //////////////////////// Edit Departmeent  //////////////////////////////////
 if (isset($_POST["update"])) {
    $dname=mysqli_real_escape_string($conn,$_POST["title"]);
    $ddesc=mysqli_real_escape_string($conn,$_POST["ndesc"]);
    $id=mysqli_real_escape_string($conn,$_POST["nid"]);
   
    $upload_directory    = "uploadedImages/";     // define path  
        $filename            = $_FILES["nimage"]["name"];
  
        if ($filename!=null) {
           $upload_directory   .= $filename;
        $tmp_dir             = $_FILES["nimage"]["tmp_name"];
        $size                = $_FILES["nimage"]["size"];
        $ext                 = pathinfo($filename,PATHINFO_EXTENSION);
  
        if ($ext == 'jpg' OR $ext == 'jpeg' OR $ext == 'png' OR $ext == 'gif' OR $ext == 'JPG' OR $ext == 'JPEG' OR $ext == 'PNG' OR $ext == 'GIF') 
        {
               if (move_uploaded_file($tmp_dir,$upload_directory)) 
            {   
            
            }else{
              echo "<script> alert('Error. move upload')</script>";
  
            }
        }else {
          echo "<script> alert('Error. File must be JPG,JPEG,PNG,GIF,jpg,jpeg,png,gif')</script>";
  
        }
        $sql = "UPDATE news SET NTitle='$dname', NDetail='$ddesc', NPicture='$upload_directory' WHERE NId='$id'";
        }else{
        $sql = "UPDATE news SET NTitle='$dname', NDetail='$ddesc' WHERE NId='$id'";       
      }
          if (mysqli_query($conn,$sql)) {
            echo "<script> 
            alert('Data have Been Changed.');
                </script>";
          echo "<meta http-equiv='refresh' content='0;news.php'>" ;
          }else {
            echo "<script> alert('Error. Data not Change')</script>";
            // echo "error :".$sql. "<br>". $conn->error;
          }
    }
?>