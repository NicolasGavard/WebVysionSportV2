<?php
  session_start();
  include('header.php');
  include('headerMenu.php');
?>

<div class="main-panel">        
  <div class="content-wrapper" style="background:#69a7c5; padding: 1.5rem 1.5rem 1.5rem 1.5rem;">
    <div class="row">
      <div class="col-lg-12 grid-margin stretch-card">
        <div class="card">
          <div class="card-body">
            <h4 class="card-title">Enterprises List</h4>
            
            <div class="row">
              <div class="col-md-9">
                <!-- filter info -->
              </div>
              <div class="col-md-3" style="text-align:right">
                <button type="button" class="btn btn-primary btn-icon-text" data-bs-toggle="modal" data-bs-target="#modalAddUser" style="margin-top: 28px;">
                  <i class="menu-icon mdi mdi-account-plus"></i>
                  Add Enterprise
                </button>
              </div>
            </div>

            <div class="table-responsive">          
              <table class="table table-striped">
                <thead>
                  <tr>
                    <th width=5%>Picture</th>
                    <th width=10%>Name</th>
                    <th width=20%>Mail/Phone</th>
                    <th width=20%>Adresse</th>
                    <th width=5%>Status</th>
                    <th width=10%>Actions</th>
                  </tr>
                </thead>
                <tbody id="listEnterprisesTbody">
                </tbody>
              </table>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>

  <?php
        include('_headerFooter.php');
      ?>
      
      <script src="jsWebVysionSport/adminEnterprises.js"></script>
  </body>
</html>