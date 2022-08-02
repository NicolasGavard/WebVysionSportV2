<?php
  session_start();
  $i18cdlangue    = 'FR';
  // If ($user->->getIdLanguage() == 2) $i18cdlangue = 'EN';
	include('../../Home/Template/i18/'.$i18cdlangue.'/header'.$i18cdlangue.'.php');
	include('i18/'.$i18cdlangue.'/enterpriseList'.$i18cdlangue.'.php');
  include('../../Home/Template/_header.php');
	include('../../Home/Template/_headerMenuTop.php');
	include('../../Home/Template/_headerMenuLeft.php');
  include("../../_util.php");
  
  $toScript["errorCodeTxt"]       = $errorData_txt_code;
  $toScript["errorNameTxt"]       = $errorData_txt_name;
  echo convertToScript($toScript);
?>
	<div class="mobile-menu-overlay"></div>

  <div class="main-container">
		<div class="pd-ltr-20 xs-pd-20-10">
			<div class="min-height-200px">
				<div class="pd-20 card-box mb-30">
					<div class="clearfix">
						<div class="pull-left">
							<h4 class="text-blue h4"><?php echo $page_title; ?></h4>
						</div>
        
            <div class="pull-right">
              <button type="button" class="btn btn-success disabled"><i class="icon-copy dw-success dw dw-checked"></i>&nbsp;<?php echo $page_all_active; ?></button>
              <button type="button" class="btn btn-warning"><i class="icon-copy dw-warning dw dw-ban"></i>&nbsp;<?php echo $page_all_inactive; ?></button>
              <button type="button" class="btn btn-primary AddNewEnterprise" data-toggle="modal" data-target="#modalAddEnterprise"><i class="fa fa-plus"></i>&nbsp;<?php echo $page_all_add; ?></button>
        		</div>
					</div>

          <div class="pb-20"></div>
          <div class="pb-20">
						<table id="EnterpriseListTable" class="display responsive nowrap" width="100%">
							<thead>
								<tr>                 
                  <th><span><?php echo $page_picture; ?></span></th>
                  <th><span><?php echo $page_name; ?></span></th>
                  <th><span><?php echo $page_email_phone; ?></span></th>
                  <th><span><?php echo $page_action; ?></span></th>
								</tr>
							</thead>
							<tbody id="listEnterpriseTbody">
							</tbody>
						</table>
					</div>
				</div>
			</div>

      <?php
        include('../../Home/Template/_headerFooter.php');
      ?>
    
      <script src="adminEnterprises.js?v=<?php echo APP_VERSION;?>"></script>
  </body>
</html>