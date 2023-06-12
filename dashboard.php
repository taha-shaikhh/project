<?php
include "adminheader.php";
session_start();
if($_SESSION["admin"]){
    echo '
    
    <div class="content-wrapper">
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
            <div class="col-sm-6">
                    <h1 class="m-0">Dashboard</h1>
                    </div>
                    </div>
                    </div>
                    </div>
                    
                    <section class="content">
                    <div class="container-fluid">
                    <div class="row d-flex justify-content-evenly">
                    
                    <div class="col-12 col-sm-6 col-md-4">
                    <div class="info-box">
                    <span class="info-box-icon bg-success elevation-1"><i class="fas fa-bolt"></i></span>
                    <div class="info-box-content">
                    <span class="info-box-text">Active Users</span>
                    <span class="info-box-number">
                                11
                            </span>
                        </div>
                    </div>
                </div>
                
                
                <div class="col-12 col-sm-6 col-md-4">
                    <div class="info-box">
                    <span class="info-box-icon bg-info elevation-1"><i class="fas fa-users"></i></span>
                    
                        <div class="info-box-content">
                        <span class="info-box-text">Total Users</span>
                        <span class="info-box-number">
                        10
                        </span>
                        </div>
                        </div>
                        </div>
                        </div>
                        </div>
    </section>

    </body>
    
    </html>';
}
else{
    header("location:adminlogin.php");
}
?>