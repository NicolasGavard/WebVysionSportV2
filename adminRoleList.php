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
            <h4 class="card-title">Roles List</h4>
            
            <div class="row">
              <div class="col-md-9">

              </div>
              <div class="col-md-3" style="text-align:right">
                <button type="button" class="btn btn-primary btn-icon-text" data-bs-toggle="modal" data-bs-target="#modalAddRole" style="margin-top: 28px;">
                  <i class="menu-icon mdi mdi-account-plus"></i>
                  Add role
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
                <tbody id="listRolesTbody">
                </tbody>
              </table>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  
  <div class="modal fade" id="modalDuplicateNewRightForAllRole" tabindex="-1" aria-labelledby="modalDuplicateNewRightForAllRoleLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="modalDuplicateNewRightForAllRoleLabel">Duplicate right</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body" style="padding: 15px 15px;">
          <p class="DuplicateNewRightForAllRoleTxt">Do you want to duplicate this right to all users with this role?</p>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">No</button>
          <button type="button" class="btn btn-danger" id="btnDuplicateNewRightForAllRole">yes</button>
        </div>
      </div>
    </div>
  </div>

  <div class="modal fade" id="modalDetailRightsRole" tabindex="-1" aria-labelledby="modalAddRoleLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="modalAddRoleLabel"></h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <div class="modal-body" style="padding: 15px 15px;">
          <form class="forms-sample" id="FormDetailRole">
            <input type="hidden" name="idRole"              class="ViewRoleFormIdRole"          value="0">
            <input type="hidden" name="name"                class="ViewRoleFormNameRole"        value="0">
            <input type="text" name="idStyApplication"    class="ViewRoleFormIdApplication"   value="0">
            <input type="text" name="idStyModule"         class="ViewRoleFormIdModule"        value="0">
            <input type="text" name="idStyFunctionality"  class="ViewRoleFormIdFunctionality" value="0">
            <input type="text" name="sumOfRights"         class="ViewRoleFormSumOfRights"     value="0">
            
            <div class="form-group">
              <div class="row">
                <div class="col-md-6">
                  <label for="InputApplicationName">Application</label>
                  <select class="form-control" id="listApplications">
                    <option value="0">All</option>
                  </select>
                </div>
                <div class="col-md-6">
                  <label for="InputModuleName">Module</label>
                  <select class="form-control" id="listModules">
                    <option value="0">All</option>
                  </select>
                </div>
              </div>
            </div>
            
            <div class="form-group">
              <div class="row">
                <div class="col-md-12">
                  <div class="table-responsive" id="listRoleByApplicationModuleFunctionality"></div>
                </div>
              </div>
            </div>
        </div>
        <div class="modal-footer confirmDuplicateNewRightForAllRole">
          <b class="DuplicateNewRightForAllRoleTxt" style="text-align:center">Do you want to duplicate this right to all users with this role?</b>
          <p>
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
            <button type="button" class="btn btn-warning"   id="btnDuplicateNewRightForAllRoleNo">No</button>
            <button type="button" class="btn btn-success"   id="btnDuplicateNewRightForAllRoleYes">yes</button>
          </p>
        </div>
      </div>
    </div>
  </div>
  
  <div class="modal fade" id="modalAddRole" tabindex="-1" aria-labelledby="modalAddRoleLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="modalAddRoleLabel">Add user account</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body" style="padding: 15px 15px;">
          <form class="forms-sample" id="FormAddRole">
            <input type="hidden" name="id"        class="AddRoleFormId"         value="0">
            <input type="hidden" name="statut"    class="AddRoleFormStatut"     value="0">
            <input type="hidden" name="timestamp" class="AddRoleFormTimestamp"  value="0">
            
            <div class="form-group">
              <div class="row">
                <div class="col-md-6">
                  <label for="InputRolename">Code</label>
                  <input type="text" class="form-control AddRoleFormCode" id="InputRoleCode" placeholder="Code" name="code" value="">
                </div>
                <div class="col-md-6">
                  <label for="InputRoleName">Name</label>
                  <input type="text" class="form-control AddRoleFormName" id="InputRoleName" placeholder="Name" name="name" value="">
                </div>
              </div>
            </div>

            <div class="form-group">
              <div class="row">
                <div class="col-md-12">
                  <label for="InputRolename">Description</label>
                  <textarea class="form-control AddRoleFormDescription" id="InputRoleDescription" rows="10" style="min-height: 6rem;" placeholder="Description" name="description"></textarea>
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
          <button type="button" class="btn btn-primary" id="btnAddRole">Add role</button>
        </div>
      </div>
    </div>
  </div>

      <?php
        include('_headerFooter.php');
      ?>
      
      <script src="jsDistrix/adminRoles.js"></script>
  </body>
</html>