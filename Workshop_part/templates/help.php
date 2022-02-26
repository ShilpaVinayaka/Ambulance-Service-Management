<?php include('../config/constants.php'); ?>

<?php include('../templates/maintemplate.php'); ?>

<head>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
    <link rel="stylesheet" href="../styles/wm.css">

</head>
<title>Help</title>
<style>
    .sidebar {
        margin-top: 66px;
    }

    .navbar-nav i {
        font-size: 2rem;
    }

    .navbar-nav>li>a {
        padding-top: 20px;
        padding-bottom: 10px;
        line-height: 14px;
    }

    .navbar-badge {
        font-size: 1rem;
    }

    @media (min-width: 768px) {
        .navbar-nav>li>a {
            padding-top: 22px;
            padding-bottom: 15px;
        }
    }

    .nav-link:hover {
        color: rgb(245, 114, 114);
    }
</style>
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


        <button type="button" id="Info-button" data-toggle="modal" data-target="#myModal">WM LOGIN</button>

        <!-- Modal -->
        <div class="modal fade" id="myModal" role="dialog" style="width: 100%;">
            <div class="modal-dialog">

                <!-- Modal content -->
                <div class="modal-content">
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
        </div>

    </div>
</div>



<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.3/Chart.min.js"></script>
<script src="wm.js"></script>