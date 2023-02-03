
<?php 
    //Include Constants Page
    include('../config/constants.php');

    //echo "Delete Room Page";

    if(isset($_GET['id']) && isset($_GET['image_name'])) 
    {
        //Process to Delete

        //1.  Get ID and Image NAme
        $id = $_GET['id'];
        $image_name = $_GET['image_name'];

        //2. Remove the Image if Available
        //CHeck whether the image is available or not and Delete only if available
        if($image_name != "")
        {
            // It has image and need to remove from folder
            //Get the Image Path
            $path = "../images/room/".$image_name;

            //REmove Image File from Folder
            $remove = unlink($path);

            //Check whether the image is removed or not
            if($remove==false)
            {
                //Failed to Remove image
                $_SESSION['upload'] = "<div class='error'>Failed to Remove Image File</div>";
                //REdirect to Manage room
                header('location:'.SITEURL.'admin/manage-room.php');
                //Stop the Process of Deleting room
                die();
            }

        }

        //3. Delete room from Database
        $sql = "DELETE FROM tbl_room WHERE id=$id";
        //Execute the Query
        $res = mysqli_query($conn, $sql);

        //CHeck whether the query executed or not and set the session message respectively
        //4. Redirect to Manage room with Session Message
        if($res==true)
        {
            //Room Deleted
            $_SESSION['delete'] = "<div class='success'>Room Deleted Successfully.</div>";\
            header('location:'.SITEURL.'admin/manage-room.php');
        }
        else
        {
            //Failed to Delete Room
            $_SESSION['delete'] = "<div class='error'>Failed to Delete Room.</div>";\
            header('location:'.SITEURL.'admin/manage-room.php');
        }

        

    }
    else
    {
        //Redirect to Manage Room Page
        //echo "REdirect";
        $_SESSION['unauthorize'] = "<div class='error'>Unauthorized Access</div>";
        header('location:'.SITEURL.'admin/manage-room.php');
    }

?>

