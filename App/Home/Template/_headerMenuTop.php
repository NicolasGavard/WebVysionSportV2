<div class="header">
  <div class="header-left">
    <div class="menu-icon dw dw-menu"></div>
    <div class="search-toggle-icon dw dw-search2" data-toggle="header_search"></div>
    <div class="header-search">
      <form>
        <div class="form-group mb-0">
          <i class="dw dw-search2 search-icon"></i>
          <input type="text" class="form-control search-input" placeholder="Search Here">
          <div class="dropdown">
            <a class="dropdown-toggle no-arrow" href="#" role="button" data-toggle="dropdown">
              <i class="ion-arrow-down-c"></i>
            </a>
            <div class="dropdown-menu dropdown-menu-right">
              <div class="form-group row">
                <label class="col-sm-12 col-md-2 col-form-label">From</label>
                <div class="col-sm-12 col-md-10">
                  <input class="form-control form-control-sm form-control-line" type="text">
                </div>
              </div>
              <div class="form-group row">
                <label class="col-sm-12 col-md-2 col-form-label">To</label>
                <div class="col-sm-12 col-md-10">
                  <input class="form-control form-control-sm form-control-line" type="text">
                </div>
              </div>
              <div class="form-group row">
                <label class="col-sm-12 col-md-2 col-form-label">Subject</label>
                <div class="col-sm-12 col-md-10">
                  <input class="form-control form-control-sm form-control-line" type="text">
                </div>
              </div>
              <div class="text-right">
                <button class="btn btn-primary">Search</button>
              </div>
            </div>
          </div>
        </div>
      </form>
    </div>
  </div>
  <div class="header-right">
    <div class="user-notification">
      <div class="dropdown">
        <a class="dropdown-toggle no-arrow" href="#" role="button" data-toggle="dropdown">
          <i class="icon-copy dw dw-notification"></i>
          <span class="badge notification-active"></span>
        </a>
        <div class="dropdown-menu dropdown-menu-right">
          <div class="notification-list mx-h-350 customscroll">
            <ul>
              <li>
                <a href="#">
                <img src="<?php echo FRONT_PATH;?>vendors/images/photo1.jpg" alt="">
                  <h3>John Doe</h3>
                  <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed...</p>
                </a>
              </li>
              <li>
                <a href="#">
                  <img src="<?php echo FRONT_PATH;?>vendors/images/photo1.jpg" alt="">
                  <h3>Lea R. Frith</h3>
                  <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed...</p>
                </a>
              </li>
              <li>
                <a href="#">
                  <img src="<?php echo FRONT_PATH;?>vendors/images/photo2.jpg" alt="">
                  <h3>Erik L. Richards</h3>
                  <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed...</p>
                </a>
              </li>
            </ul>
          </div>
        </div>
      </div>
    </div>
    <div class="user-info-dropdown">
      <div class="dropdown">
        <a class="dropdown-toggle" href="#" role="button" data-toggle="dropdown">
          <span class="user-icon">
            <img class="InfoProfilPicture" src="" alt="" style='min-width: 50px; min-height: 50px; max-width: 50px; max-height: 50px;'>
          </span>
          <span class="user-name InfoProfilFullName"></span>
        </a>
        <div class="dropdown-menu dropdown-menu-right dropdown-menu-icon-list">
          <a class="dropdown-item" href="<?php echo FRONT_PATH;?>App/Security/Profil/profil.php"><i class="dw dw-user1"></i> <span><?php echo $menu_profil_myProfil; ?></span></a>
          <a class="dropdown-item" href="<?php echo FRONT_PATH;?>App/Message/Chat/chat.php"><i class="dw dw-message"></i> <span><?php echo $menu_profil_messages; ?></span></a>
          <a class="dropdown-item" href="<?php echo FRONT_PATH;?>App/Activity/Ticket/ticketList.php"><i class="dw dw-notification"></i> <span><?php echo $menu_profil_activities; ?></span></a>
          <a class="dropdown-item" href="<?php echo FRONT_PATH;?>App/Help/FAQ/faq.php"><i class="dw dw-help"></i> <span><?php echo $menu_profil_faq; ?></span></a>
          <a class="dropdown-item btnLogout" id="btnLogout"><i class="dw dw-logout"></i> <span><?php echo $menu_profil_logout; ?></span></a>
        </div>
      </div>
    </div>
  </div>
</div>