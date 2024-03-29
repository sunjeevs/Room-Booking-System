<?php include('partials/menu.php') ?>

<div class="main-content">
    <div class="wrapper">
        <h1>Manage Rooms</h1>
         <br>
                <br>
                <!-- Button to add admin  -->

                <a href="<?php echo SITEURL; ?>admin/add-room.php" class="btn-primary">Add Rooms</a>
                <br>
                <br>
                <br>
                 <?php 
                    if(isset($_SESSION['add']))
                    {
                        echo $_SESSION['add'];
                        unset($_SESSION['add']);
                    }

                    if(isset($_SESSION['delete']))
                    {
                        echo $_SESSION['delete'];
                        unset($_SESSION['delete']);
                    }

                    if(isset($_SESSION['upload']))
                    {
                        echo $_SESSION['upload'];
                        unset($_SESSION['upload']);
                    }

                    if(isset($_SESSION['unauthorize']))
                    {
                        echo $_SESSION['unauthorize'];
                        unset($_SESSION['unauthorize']);
                    }

                    if(isset($_SESSION['update']))
                    {
                        echo $_SESSION['update'];
                        unset($_SESSION['update']);
                    }
                
                ?>
                <table class="tbl-full">
                    <tr>
                        <th>Serial No.</th>
                        <th>Title</th>
                        <th>Price</th>
                        <th>Image</th>
                        <th>Featured</th>
                        <th>Active</th>
                        <th>Actions</th>
                    </tr>

                    <?php 
                        //Create a SQL Query to Get all the Rooms
                        $sql = "SELECT * FROM tbl_room";

                        //Execute the qUery
                        $res = mysqli_query($conn, $sql);

                        //Count Rows to check whether we have rooms or not
                        $count = mysqli_num_rows($res);

                        //Create Serial Number VAriable and Set Default VAlue as 1
                        $sn=1;

                        if($count>0)
                        {
                            //We have room in Database
                            //Get the rooms from Database and Display
                            while($row=mysqli_fetch_assoc($res))
                            {
                                //get the values from individual columns
                                $id = $row['id'];
                                $title = $row['title'];
                                $price = $row['price'];
                                $image_name = $row['image_name'];
                                $featured = $row['featured'];
                                $active = $row['active'];
                                ?>

                                <tr>
                                    <td><?php echo $sn++; ?>. </td>
                                    <td><?php echo $title; ?></td>
                                    <td>Rs.<?php echo $price; ?></td>
                                    <td>
                                        <?php  
                                            //Check whether we have image or not
                                            if($image_name=="")
                                            {
                                                //We do not have image, DIslpay Error Message
                                                echo "<div class='error'>Image not Added</div>";
                                            }
                                            else
                                            {
                                                //We Have Image, Display Image
                                                ?>
                                                <img src="<?php echo SITEURL; ?>images/room/<?php echo $image_name; ?>" width="300px" height="150px">
                                                <?php
                                            }
                                        ?>
                                    </td>
                                    <td><?php echo $featured; ?></td>
                                    <td><?php echo $active; ?></td>
                                    <td>
                                        <a href="<?php echo SITEURL; ?>admin/update-room.php?id=<?php echo $id; ?>" class="btn-secondary">Update Room</a>
                                        <a href="<?php echo SITEURL; ?>admin/delete-room.php?id=<?php echo $id; ?>&image_name=<?php echo $image_name; ?>" class="btn-danger">Delete Room</a>
                                    </td>
                                </tr>

                                <?php
                            }
                        }
                        else
                        {
                            //Room not Added in Database
                            echo "<tr> <td colspan='7' class='error'> Room not Added Yet. </td> </tr>";
                        }

                    ?>

                </table>
    </div>
</div>

<?php include('partials/footer.php') ?>



