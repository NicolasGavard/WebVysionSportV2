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
            <h4 class="card-title">Functionalities List</h4>
            
            <div class="row">
              <div class="col-md-5">
                <form class="forms-sample">
                  <div class="form-group">
                    <label for="InputApplicationName">Application</label>
                    <select class="form-control" id="listFunctionalitiesFilterIdApplication" name="idstyApplication">
                      <option value="0">All</option>
                    </select>
                  </div>
                </form>
              </div>
                    
              <div class="col-md-5">
                <form class="forms-sample">
                  <div class="form-group">
                    <label for="InputModuleName">Module</label>
                    <select class="form-control" id="listFunctionalitiesFilterIdModule" name="idstyModule">
                      <option value="0">All</option>
                    </select>
                  </div>
                </form>
              </div>

              <div class="col-md-2" style="text-align:right">
                <button type="button" class="btn btn-primary btn-icon-text" data-bs-toggle="modal" data-bs-target="#modalAddFunctionality" style="margin-top: 28px;">
                  <i class="menu-icon mdi mdi-account-plus"></i>
                  Add functionality
                </button>
              </div>
            </div>

            <div class="table-responsive">          
              <table class="table table-striped">
                <thead>
                  <tr>
                    <th width=15%>Application</th>
                    <th width=15%>Module</th>
                    <th width=15%>Code</th>
                    <th width=30%>Description</th>
                    <th width=5%>Status</th>
                    <th width=10%>Actions</th>
                  </tr>
                </thead>
                <tbody id="listFunctionalitiesTbody">
                </tbody>
              </table>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>

  <div class="modal fade" id="modalAddFunctionality" tabindex="-1" aria-labelledby="modalAddFunctionalityLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title btnSave" id="modalAddFunctionalityLabel">Add functionality</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body" style="padding: 15px 15px;">
          <form class="forms-sample" id="FormAddFunctionality">
            <input type="hidden" name="id"        class="AddFunctionalityFormId"         value="0">
            <input type="hidden" name="status"    class="AddFunctionalityFormStatus"     value="0">
            <input type="hidden" name="timestamp" class="AddFunctionalityFormTimestamp"  value="0">

            <div class="form-group">
              <div class="row">
                <div class="col-md-12">
                  <label for="InputApplicationName">Application</label>
                  <select class="form-control" id="AddFunctionalityIdApplication" name="idStyApplication">
                    <option value="">All</option>
                  </select>
                </div>
              </div>
            </div>

            <div class="form-group">
              <div class="row">
                <div class="col-md-12">
                  <label for="InputModuleName">Module</label>
                  <select class="form-control" id="AddFunctionalityIdModule" name="idStyModule">
                    <option value="">All</option>
                  </select>
                </div>
              </div>
            </div>

            <div class="form-group">
              <div class="row">
                <div class="col-md-12">
                  <label for="InputFunctionalityCode">Code</label>
                  <input type="text" class="form-control AddFunctionalityFormCode" id="InputFunctionalityCode" placeholder="Code" name="code" value="">
                </div>
              </div>
            </div>

            <div class="form-group">
              <div class="row">
                <div class="col-md-12">
                  <label for="InputFunctionalityDesc">Description</label>
                  <textarea class="form-control AddFunctionalityFormDescription" id="InputFunctionalityDescription" rows="10" style="min-height: 6rem;" placeholder="Functionality Description" name="description"></textarea>
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
          <button type="button" class="btn btn-primary btnSave" id="btnAddFunctionality">Add functionality</button>
        </div>
      </div>
    </div>
  </div>

  <div class="modal fade" id="modalDelFunctionality" tabindex="-1" aria-labelledby="modalDelFunctionalityLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="modalDelFunctionalityLabel">Delete functionality</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body" style="padding: 15px 15px;">
          <form class="forms-sample" id="FormDelFunctionality">
            <input type="hidden" name="id" class="DelFunctionalityFormIdFunctionality" value="0">
          </form>
          <p class="DelFunctionalityTxt"></p>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
          <button type="button" class="btn btn-danger" id="btnDelFunctionality">Delete functionality</button>
        </div>
      </div>
    </div>
  </div>

  <div class="modal fade" id="modalRestFunctionality" tabindex="-1" aria-labelledby="modalRestFunctionalityLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="modalRestFunctionalityLabel">Restore functionality</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body" style="padding: 15px 15px;">
          <form class="forms-sample" id="FormRestFunctionality">
            <input type="hidden" name="id" class="RestFunctionalityFormIdFunctionality" value="0">
          </form>
          <p class="RestFunctionalityTxt"></p>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
          <button type="button" class="btn btn-info" id="btnRestFunctionality">Restore functionality</button>
        </div>
      </div>
    </div>
  </div>

  <?php
        include('../Home/_headerFooter.php');
      ?>
      
      <script src="../../jsWebVysionSport/adminFunctionalities.js?v=<?php echo APP_VERSION;?>"></script>
  </body>
</html>