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
            <h4 class="card-title">Rights List</h4>
            
            <div class="row">
              <div class="col-md-9">

              </div>
              <div class="col-md-3" style="text-align:right">
                <button type="button" class="btn btn-primary btn-icon-text" data-bs-toggle="modal" data-bs-target="#modalAddRight" style="margin-top: 28px;">
                  <i class="menu-icon mdi mdi-account-plus"></i>
                  Add right
                </button>
              </div>
            </div>

            <div class="table-responsive">          
              <table class="table table-striped">
                <thead>
                  <tr>
                    <th>Code</th>
                    <th>Name</th>
                    <th>Description</th>
                    <th width=10%>Status</th>
                    <th width=10%>Actions</th>
                  </tr>
                </thead>
                <tbody id="listRightsTbody">
                </tbody>
              </table>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>

  <div class="modal fade" id="modalAddRight" tabindex="-1" aria-labelledby="modalAddRightLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="modalAddRightLabel">Add user account</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body" style="padding: 15px 15px;">
          <form class="forms-sample" id="FormAddRight">
            <input type="hidden" name="id"        class="AddRightFormId"         value="0">
            <input type="hidden" name="statut"    class="AddRightFormStatut"     value="0">
            <input type="hidden" name="timestamp" class="AddRightFormTimestamp"  value="0">
            
            <div class="form-group">
              <div class="row">
                <div class="col-md-6">
                  <label for="InputRightname">Code</label>
                  <input type="text" class="form-control AddRightFormCode" id="InputRightCode" placeholder="Code" name="code" value="">
                </div>
                <div class="col-md-6">
                  <label for="InputRightName">Name</label>
                  <input type="text" class="form-control AddRightFormName" id="InputRightName" placeholder="Name" name="name" value="">
                </div>
              </div>
            </div>

            <div class="form-group">
              <div class="row">
                <div class="col-md-12">
                  <label for="InputRightname">Description</label>
                  <textarea class="form-control AddRightFormDescription" id="InputRightDescription" rows="10" style="min-height: 6rem;" placeholder="Description" name="description"></textarea>
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
          <button type="button" class="btn btn-primary" id="btnAddRight">Add right</button>
        </div>
      </div>
    </div>
  </div>

      <?php
        include('_headerFooter.php');
      ?>
      
      <script src="jsDistrix/adminRights.js"></script>
  </body>
</html>