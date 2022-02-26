<?php include("./maintemplate.php"); ?>
<?php include('./constants.php'); ?>

<div class="wrapper">
    <div class="hero">
        <div class="hero_heading text-center">
            <h2>FAQ's</h2>
        </div>
    </div>
    <div class="box-element">

        <div class="help-content">
            <p>For any assistance required to browse through the pages please click on the respective login.
                All the information is provided below.
            </p>
        </div>
        <br>
        <!-- Trigger the modal with a button -->
        <button type="button" id="Info-button" data-toggle="modal" data-target="#myModal">EME LOGIN</button> <br>

        <!-- Modal -->
        <div class="modal fade" id="myModal" role="dialog" style="width: 100%;">
            <div class="modal-dialog">

                <!-- Modal content-->
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                        <h4 class="modal-title"> Steps for EME Login:</h4>
                    </div>
                    <div class="modal-body">
                        <p>Some text in the modal.</p>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    </div>
                </div>

            </div>
        </div>
        <!-- Trigger the modal with a button -->
        <!-- <button type="button" class="btn btn-info btn-lg" data-toggle="modal" data-target="#myModal">WM LOGIN</button> -->

        <!-- Modal -->
        <!-- <div class="modal fade" id="myModal" role="dialog" style="width: 100%;">
            <div class="modal-dialog">

                <!-- Modal content-->
        <!-- <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                        <h4 class="modal-title"> Steps for WM Login:</h4>
                    </div>
                    <div class="modal-body">
                        <p>Some text in the modal.</p>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    </div>
                </div>

            </div> 
        </div> -->

    </div>
</div>



<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.3/Chart.min.js"></script>
<script src="wm.js"></script>