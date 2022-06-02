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
            <h4 class="card-title">User Types List</h4>
            
            <div class="row">
              <div class="col-md-9">

              </div>
              <div class="col-md-3" style="text-align:right">
                <button type="button" class="btn btn-primary btn-icon-text" data-bs-toggle="modal" data-bs-target="#modalAddUserType" style="margin-top: 28px;">
                  <i class="menu-icon mdi mdi-account-plus"></i>
                  Add user type
                </button>
              </div>
            </div>

            <div class="table-responsive">          
              <table class="table table-striped">
                <thead>
                  <tr>
                    <th width=15%>Code</th>
                    <th width=70%>Name</th>
                    <th width=5%>Status</th>
                    <th width=10%>Actions</th>
                  </tr>
                </thead>
                <tbody id="listUsersTypesTbody">
                </tbody>
              </table>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>

  <div class="modal fade" id="modalAddUserType" tabindex="-1" aria-labelledby="modalAddUserTypeLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="modalAddUserTypeLabel">Add user account</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body" style="padding: 15px 15px;">
          <form class="forms-sample" id="FormAddUserType">
            <input type="hidden" name="id"        class="AddUserTypeFormId"         value="0">
            <input type="hidden" name="statut"    class="AddUserTypeFormStatut"     value="0">
            <input type="hidden" name="timestamp" class="AddUserTypeFormTimestamp"  value="0">
            
            <div class="form-group">
              <div class="row">
                <div class="col-md-6">
                  <label for="InputUserTypename">Code</label>
                  <input type="text" class="form-control AddUserTypeFormCode" id="InputUserTypeCode" placeholder="Code" name="code" value="">
                </div>
                <div class="col-md-6">
                  <label for="InputUserTypeName">Name</label>
                  <input type="text" class="form-control AddUserTypeFormName" id="InputUserTypeName" placeholder="Name" name="name" value="">
                </div>
              </div>
            </div>
          </form>
          
          <!-- Success Alert -->
          <div class="alert alert-success alert-dismissible fade show" style='display:none;'>
            <strong>Processing Success !</strong>
            <br/>
            <p>Your data has been successfully registered.</p>
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
          </div>

          <!-- Error Alert -->
          <div class="form-group">
            <div class="alert alert-danger alert-dismissible fade show" style='display:none;'>
              <strong>Processing error !</strong>
              <br/>
              <p></p>
              <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
          <button type="button" class="btn btn-primary" id="btnAddUserType">Add user type</button>
        </div>
      </div>
    </div>
  </div>

      <?php
        include('_headerFooter.php');
      ?>
      
      <script src="jsWebVysionSport/adminUserTypes.js"></script>
  </body>
</html>