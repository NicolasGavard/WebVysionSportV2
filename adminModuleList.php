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
            <h4 class="card-title">Modules List</h4>
            
            <div class="row">
              <div class="col-md-9">
                <form class="forms-sample">
                  <div class="form-group">
                    <label for="InputApplicationName">Application</label>
                    <select class="form-control" id="listModulesFilterIdApplication" name="idstyApplication">
                      <option value="">All</option>
                    </select>
                  </div>
                </form>
              </div>
              <div class="col-md-3" style="text-align:right">
                <button type="button" class="btn btn-primary btn-icon-text" data-bs-toggle="modal" data-bs-target="#modalAddModule" style="margin-top: 28px;">
                  <i class="menu-icon mdi mdi-account-plus"></i>
                  Add module
                </button>
              </div>
            </div>

            <div class="table-responsive">          
              <table class="table table-striped">
                <thead>
                  <tr>
                    <th width=20%>Application</th>
                    <th width=15%>Code</th>
                    <th width=40%>Description</th>
                    <th width=5%>Status</th>
                    <th width=10%>Actions</th>
                  </tr>
                </thead>
                <tbody id="listModulesTbody">
                </tbody>
              </table>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>

  <div class="modal fade" id="modalAddModule" tabindex="-1" aria-labelledby="modalAddModuleLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title btnSave" id="modalAddModuleLabel">Add module</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body" style="padding: 15px 15px;">
          <form class="forms-sample" id="FormAddModule">
            <input type="hidden" name="id"        class="AddModuleFormId"         value="0">
            <input type="hidden" name="status"    class="AddModuleFormStatus"     value="0">
            <input type="hidden" name="timestamp" class="AddModuleFormTimestamp"  value="0">

            <div class="form-group">
              <div class="row">
                <div class="col-md-12">
                  <label for="InputModulename">Application</label>
                  <select class="form-control" id="AddModuleIdApplication" name="idStyApplication">
                    <option value="">All</option>
                  </select>
                </div>
              </div>
            </div>

            <div class="form-group">
              <div class="row">
                <div class="col-md-12">
                  <label for="InputModuleCode">Code</label>
                  <input type="text" class="form-control AddModuleFormCode" id="InputModuleCode" placeholder="Code" name="code" value="">
                </div>
              </div>
            </div>

            <div class="form-group">
              <div class="row">
                <div class="col-md-12">
                  <label for="InputModuleDesc">Description</label>
                  <textarea class="form-control AddModuleFormDescription" id="InputModuleDescription" rows="10" style="min-height: 6rem;" placeholder="Module Description" name="description"></textarea>
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
          <button type="button" class="btn btn-primary btnSave" id="btnAddModule">Add module</button>
        </div>
      </div>
    </div>
  </div>

  <div class="modal fade" id="modalDelModule" tabindex="-1" aria-labelledby="modalDelModuleLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="modalDelModuleLabel">Delete module</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body" style="padding: 15px 15px;">
          <form class="forms-sample" id="FormDelModule">
            <input type="hidden" name="id" class="DelModuleFormIdModule" value="0">
          </form>
          <p class="DelModuleTxt"></p>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
          <button type="button" class="btn btn-danger" id="btnDelModule">Delete module</button>
        </div>
      </div>
    </div>
  </div>

  <div class="modal fade" id="modalRestModule" tabindex="-1" aria-labelledby="modalRestModuleLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="modalRestModuleLabel">Restore module</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body" style="padding: 15px 15px;">
          <form class="forms-sample" id="FormRestModule">
            <input type="hidden" name="id" class="RestModuleFormIdModule" value="0">
          </form>
          <p class="RestModuleTxt"></p>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
          <button type="button" class="btn btn-info" id="btnRestModule">Restore module</button>
        </div>
      </div>
    </div>
  </div>

      <?php
        include('_headerFooter.php');
      ?>
      
      <script src="jsDistrix/adminModules.js"></script>
  </body>
</html>