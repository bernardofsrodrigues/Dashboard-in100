<?php
session_start();
if (!isset($_SESSION['username'])){
  session_destroy();
  header('location: login.php');
};
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
        <meta name="description" content="" />
        <meta name="author" content="" />
        <title>Master IN100</title>
        <link href="https://cdn.jsdelivr.net/npm/simple-datatables@7.1.2/dist/style.min.css" rel="stylesheet" />
        <link href="css/styles.css" rel="stylesheet" />
        <link rel="stylesheet" href="css/main.css">
        <script src="https://use.fontawesome.com/releases/v6.3.0/js/all.js" crossorigin="anonymous"></script>
    </head>
    <body class="sb-nav-fixed">
        <nav class="sb-topnav navbar navbar-expand navbar-dark bg-dark">
            <a class="navbar-brand ps-3" href="index.html">Master IN100</a>
            <button class="btn btn-link btn-sm order-1 order-lg-0 me-4 me-lg-0" id="sidebarToggle" href="#!"><i class="fas fa-bars"></i></button>
        </nav>
        <div id="layoutSidenav">
            <div id="layoutSidenav_nav">
                <nav class="sb-sidenav accordion sb-sidenav-dark" id="sidenavAccordion">
                    <div class="sb-sidenav-menu">
                        <div class="nav">
                            <div class="sb-sidenav-menu-heading">Menu</div>
                            <a class="nav-link" href="home.php">
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-bar-chart-fill" viewBox="0 0 16 16" style="margin-right: 12px;">
                                    <path d="M1 11a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1v3a1 1 0 0 1-1 1H2a1 1 0 0 1-1-1zm5-4a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1v7a1 1 0 0 1-1 1H7a1 1 0 0 1-1-1zm5-5a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1v12a1 1 0 0 1-1 1h-2a1 1 0 0 1-1-1z"/>
                                </svg>
                                Dashboard
                            </a>
                        </div>
                        <div class="nav">
                            <div class="sb-sidenav-menu-heading">Encerrar</div>
                            <a class="nav-link" href="logout.php">
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-box-arrow-left" viewBox="0 0 16 16" style="margin-right: 12px;">
                                    <path fill-rule="evenodd" d="M6 12.5a.5.5 0 0 0 .5.5h8a.5.5 0 0 0 .5-.5v-9a.5.5 0 0 0-.5-.5h-8a.5.5 0 0 0-.5.5v2a.5.5 0 0 1-1 0v-2A1.5 1.5 0 0 1 6.5 2h8A1.5 1.5 0 0 1 16 3.5v9a1.5 1.5 0 0 1-1.5 1.5h-8A1.5 1.5 0 0 1 5 12.5v-2a.5.5 0 0 1 1 0z"/>
                                    <path fill-rule="evenodd" d="M.146 8.354a.5.5 0 0 1 0-.708l3-3a.5.5 0 1 1 .708.708L1.707 7.5H10.5a.5.5 0 0 1 0 1H1.707l2.147 2.146a.5.5 0 0 1-.708.708z"/>
                                </svg>
                                Logout
                            </a>
                        </div>
                    </div>
                </nav>
            </div>
            <div>
                <main>
                    <div class="dashboard-container">
                        <form class="upload-form" id="uploadForm" method="POST" action="upload.php" enctype="multipart/form-data">
                            <label for="fileInput">Selecione um arquivo CSV:</label>
                            <div class="env">
                                <input name="file" type="file" id="fileInput" accept=".csv" required>
                                <button type="submit" id="bbb">Enviar</button>
                            </div>
                        </form>
                        
                        <div class="download-button">
                            <button><a href="exportar.php" target="_blank">Download das consultas</a></button>
                            <div id="message" class="message"></div>
                        </div>
                    </div>

                    
                    <div class="card-header">
                    </div>

                    <div class="card-body">
                        <div class="datatable-wrapper datatable-loading no-footer sortable searchable fixed-columns"><div class="datatable-top">
                        </div>
                    <div class="datatable-container">
                        <table id="datatablesSimple" class="datatable-table">
                            <thead>
                                <tr class="trtr">
                                    <th data-sortable="true" style="width: 19.47890818858561%;">
                                        <a href="#" class="datatable-sorter">Data</a>
                                    </th>
                                    <th data-sortable="true" style="width: 15.776674937965257%;">
                                        <a href="#" class="datatable-sorter">Quantidade de Consultas</a>
                                    </th>
                                <tbody>
                                    <?php  
                                        $conn = new mysqli("localhost", "root", "", "inmaster");
                                        $query = mysqli_query($conn,"SELECT DATE_FORMAT(dataConsulta,'%d-%m-%Y') AS data, COUNT(*) AS quantidade_registros FROM IN100master WHERE SIT IN (1,2) AND dataconsulta <> '' GROUP BY dataConsulta ORDER BY dataConsulta DESC;");
                                        
                                        while($dado = mysqli_fetch_array($query)){

                                        
                                    ?>
                                    <tr data-index="0">
                                        <td><?php echo $dado ['data']?></td>
                                        <td><?php echo $dado ['quantidade_registros']?></td>
                                    </tr>
                                    <?php }
                                    ?>
                                </tbody>
                        </table>
                    </div>
                    </div></div>
                </div>
                </main>
            </div>
        </div>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
        <script src="js/scripts.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.8.0/Chart.min.js" crossorigin="anonymous"></script>
        <script src="assets/demo/chart-area-demo.js"></script>
        <script src="assets/demo/chart-bar-demo.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/simple-datatables@7.1.2/dist/umd/simple-datatables.min.js" crossorigin="anonymous"></script>
        <script src="js/datatables-simple-demo.js"></script>
    </body>
</html>