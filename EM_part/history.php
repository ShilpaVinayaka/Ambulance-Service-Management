<?php ob_start(); ?>

<?php include('./constants.php'); ?>
<?php include('./maintemplate.php'); ?>

<div class="wrapper">
    <h3>All Notifications</h3>
    <?php
    $sql = "SELECT * FROM eme_notifications WHERE Status ='unread'";
    $res = mysqli_query($conn, $sql);

    if ($res == TRUE) {
        $count = mysqli_num_rows($res);
        if ($count > 0) {
    ?>
            <form method="POST">
                <?php
                while ($rows = mysqli_fetch_assoc($res)) {
                    $id = $rows['id'];
                    $Date_time = $rows['Date_time'];
                    $Message = $rows['Message'];
                    $msg_apt = $rows['msg_apt'];
                    $confirm_cancel = $rows['confirm_cancel'];
                    $Status = $rows['Status'];

                    if ($Status == "unread") {
                ?>
                        <div class="box-element" style="padding: 0px;">

                                <span style="float: left;"><?php echo $Message ?></span>
                                <span style="float: right;"><i><?php echo $Date_time ?></i></span>
                                

                        </div>
                        <br>
            </form>
    <?php
                    }
                }
            } else {
    ?>
    <div class="box-element">
        <div></div>
        <span>
            <i><?php echo "No Records Yet" ?></i>
            <br>
        </span>
    </div>
<?php
            }
        }
?>

</ul>
</div>