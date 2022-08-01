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
            <h4 class="card-title">Users List</h4>
            
            <div class="row">
              <div class="col-md-9">
                <form class="forms-sample" style="margin-bottom: -30px;">
                  <div class="form-group row">
                    <label for="exampleInputUsername2" class="col-sm-2 col-form-label">Enterprise</label>
                    <div class="col-sm-10">
                      <select class="form-control" id="listUsersFilterIdStyEnterprise" name="idStyEnterprise">
                        <option value="">All</option>
                      </select>
                    </div>
                  </div>
                </form>
              </div>
              <div class="col-md-3" style="text-align:right">
                <button type="button" class="btn btn-primary btn-icon-text" data-bs-toggle="modal" data-bs-target="#modalAddUser" style="margin-top: 28px;">
                  <i class="menu-icon mdi mdi-account-plus"></i>
                  Add user
                </button>
              </div>
            </div>

            <div class="table-responsive">          
              <table class="table table-striped">
                <thead>
                  <tr>
                    <th width=5%>Picture</th>
                    <th width=10%>Name/Enterprise</th>
                    <th width=40%>Mail/Phone</th>
                    <th width=5%>Status</th>
                    <th width=10%>Actions</th>
                  </tr>
                </thead>
                <tbody id="listUsersTbody">
                </tbody>
              </table>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>

  <div class="modal fade" id="modalAddUser" tabindex="-1" aria-labelledby="modalAddUserLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title btnSave" id="modalAddUserLabel">Add user account</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body" style="padding: 15px 15px;">
          <form class="forms-sample" id="FormAddProfil">
            <input type="hidden" name="id"            class="AddProfilFormIdUser"        value="0">
            <input type="hidden" name="initPass"      class="AddProfilFormInitPass"      value="0">
            <input type="hidden" name="idLanguage"    class="AddProfilFormIdLanguage"    value="1">
            <input type="hidden" name="statut"        class="AddProfilFormStatut"        value="0">
            
            <div class="form-group">
              <div class="row">
                <div class="col-md-6">
                  <label for="InputUsername">Login</label>
                  <input type="text" class="form-control AddProfilFormLogin" id="InputUserLogin" placeholder="Login" name="login" value="">
                </div>
                <div class="col-md-6">
                  <label for="InputUsername">Enterprise</label>
                  <select class="form-control" id="listUsersAddAccountIdStyEnterprise" name="idStyEnterprise">
                    <option value="">All</option>
                  </select>
                </div>
              </div>
            </div>

            <div class="form-group sectionPassword">
              <div class="row">
                <div class="col-md-6">
                  <label for="InputUsername">Password</label>
                  <input type="password" class="form-control AddProfilFormPass" id="InputUserPass" placeholder="Password" name="pass" value="">
                </div>
                <div class="col-md-6">
                  <label for="InputUserFirstName">Confirm password</label>
                  <input type="password" class="form-control AddProfilFormConfirmPass" id="InputUserConfirmPass" placeholder="Confirm password" name="conformPassword" value="">
                </div>
              </div>
            </div>

            <div class="form-group">
              <div class="row">
                <div class="col-md-6">
                  <label for="InputUsername">Name</label>
                  <input type="text" class="form-control AddProfilFormName" id="InputUserName" placeholder="Username" name="name" value="">
                </div>
                <div class="col-md-6">
                  <label for="InputUserFirstName">First Name</label>
                  <input type="text" class="form-control AddProfilFormFirstName" id="InputUserFirstName" placeholder="First name" name="firstName" value="">
                </div>
              </div>
            </div>
            
            <div class="form-group">
              <div class="row">
                <div class="col-md-6">
                  <label for="InputEmail">Email address</label>
                  <input type="email" class="form-control AddProfilFormEmail" id="InputEmail" placeholder="Email address" name="email" value="">
                </div>
                <div class="col-md-6">
                  <label for="InputEmail">Email address backup</label>
                  <input type="email" class="form-control AddProfilFormEmailBackup" id="InputEmailBackup" placeholder="Backup email address" name="emailBackup" value="">
                </div>
              </div>
            </div>
            
            <div class="form-group">
              <div class="row">
                <div class="col-md-6">
                  <label for="InputPhone">Phone</label>
                  <input type="email" class="form-control AddProfilFormPhone" id="InputPhone" placeholder="Phone" name="phone" value="">
                </div>
                <div class="col-md-6">
                  <label for="InputMobile">Mobile</label>
                  <input type="email" class="form-control AddProfilFormMobile" id="InputMobile" placeholder="Mobile" name="mobile" value="">
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
          <button type="button" class="btn btn-primary btnSave" id="btnAddProfil">Add user account</button>
        </div>
      </div>
    </div>
  </div>

  <div class="modal fade" id="modalAddUserRight" tabindex="-1" aria-labelledby="modalAddRightUserLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="modalAddRightUserLabel">Title</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <div class="modal-body" style="padding: 15px 15px;">
          <form class="forms-sample" id="FormDetailUserRight">
            <input type="hidden" name="id"                  class="ViewUserRightFormId"              value="0">
            <input type="hidden" name="name"                class="ViewUserRightFormNameUser"        value="0">
            <input type="hidden" name="idStyApplication"    class="ViewUserRightFormIdApplication"   value="0">
            <input type="hidden" name="idStyModule"         class="ViewUserRightFormIdModule"        value="0">
            <input type="hidden" name="idStyFunctionality"  class="ViewUserRightFormIdFunctionality" value="0">
            <input type="hidden" name="idStyRight"          class="ViewUserRightFormIdRight"         value="0">
            <input type="hidden" name="idStyUserRole"       class="ViewUserRightFormIdUserRole"      value="0">
            
            <div class="form-group">
              <div class="row">
                <div class="col-md-6">
                  <label for="InputRoleName">Role</label>
                  <select class="form-control" id="listRoles" name="ListIdRole"></select>
                </div>
              </div>
            </div>

            <div class="form-group">
              <div class="row">
                <div class="col-md-3">
                  <label for="InputApplicationName">Application</label>
                  <select class="form-control" id="listApplications" name="ListidApplication">
                    <option value="">All</option>
                  </select>
                </div>
                <div class="col-md-3">
                  <label for="InputModuleName">Module</label>
                  <select class="form-control" id="listModules" name="ListidModule">
                    <option value="">All</option>
                  </select>
                </div>
                <div class="col-md-3">
                  <label for="InputFunctionalityName">Functionality</label>
                  <select class="form-control" id="listFunctionalities" name="ListidFunctionalities">
                    <option value="">All</option>
                  </select>
                </div>
                <div class="col-md-3">
                  <label for="InputRightName">Right</label>
                  <select class="form-control" id="listRights" name="ListidRights">
                    <option value="">All</option>
                  </select>
                </div>
              </div>
            </div>

            <div class="form-group">
              <div class="row">
                <div class="table-responsive" id="listRightsByRole"></div>
              </div>
            </div>
          </form>
          </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
          <button type="button" class="btn btn-primary" id="btnAddRole">Add role</button>
        </div>
      </div>
    </div>
  </div>

  <div class="modal fade" id="modalInitUser" tabindex="-1" aria-labelledby="modalInitPassUserLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="modalInitPassUserLabel">Init Password user account</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body" style="padding: 15px 15px;">
          <form class="forms-sample" id="FormInitProfil">
            <input type="hidden" name="id" class="InitProfilFormIdUser" value="0">
            <p class="InitProfilTxt"></p>
          </form>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
          <button type="button" class="btn btn-warning" id="btnInitProfil">Init Password user account</button>
        </div>
      </div>
    </div>
  </div>

  <div class="modal fade" id="modalDelUser" tabindex="-1" aria-labelledby="modalDelUserLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="modalDelUserLabel">Delete user account</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body" style="padding: 15px 15px;">
          <form class="forms-sample" id="FormDelProfil">
            <input type="hidden" name="id" class="DelProfilFormIdUser" value="0">
          </form>
          <p class="DelProfilTxt"></p>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
          <button type="button" class="btn btn-danger" id="btnDelProfil">Delete user account</button>
        </div>
      </div>
    </div>
  </div>

  <div class="modal fade" id="modalRestUser" tabindex="-1" aria-labelledby="modalRestUserLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="modalRestUserLabel">Restore user account</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body" style="padding: 15px 15px;">
          <form class="forms-sample" id="FormRestProfil">
            <input type="hidden" name="id" class="RestProfilFormIdUser" value="0">
          </form>
          <p class="RestProfilTxt"></p>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
          <button type="button" class="btn btn-info" id="btnRestProfil">Restore user account</button>
        </div>
      </div>
    </div>
  </div>

      <?php
        include('../Home/_headerFooter.php');
      ?>
      
      <script src="../../jsWebVysionSport/adminUsers.js"></script>
  </body>
</html>