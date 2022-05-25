<?php
  include(__DIR__ . "/DistriXInit/DistriXSvcControllerInit.php");
  include(__DIR__ . "/DistrixSecurity/styAppInterface/DistriXStyAppInterface.php");
  include(__DIR__ . "/DistrixSecurity/Const/DistriXStyRightConst.php");
  //i18
  include('i18/FR/headerMenuLeft.php');
?>

<div class="left-side-bar">
  <div class="brand-logo">
    <a href="main.php">
      <img src="images/WebVysionSport.png" alt="" class="light-logo" style="max-width: 75px;">
    </a>
    <div class="close-sidebar" data-toggle="left-sidebar-close">
      <i class="ion-close-round"></i>
    </div>
  </div>
  <div class="menu-block customscroll">
    <div class="sidebar-menu">
      <ul id="accordion-menu">
        <li>
          <a href="main.php" class="dropdown-toggle no-arrow">
            <span class="micon dw dw-house-1"></span>
            <span class="mtext"><?php echo $menu_home; ?></span>
          </a>
        </li>
        
        <?php
          $hasSport = true;
        ?>
        <?php if ($hasSport) { ?>
          <li class="dropdown">
            <a href="javascript:;" class="dropdown-toggle">
              <span class="micon dw dw-dumbbell"></span>
              <span class="mtext"><?php echo $menu_sport; ?></span>
              &nbsp;<img src="vendors/images/coming-soon.png" alt="" width="25">
            </a>
            <ul class="submenu">
              <li><a href="#">1</a></li>
              <li><a href="#">2</a></li>
              <li><a href="#">3</a></li>
              <li><a href="#">4</a></li>
            </ul>
          </li>
        <?php } ?>

        <?php
          $hasNutrition                 = true;
          $hasNutrition_MyDiet          = true;
          $hasNutrition_MyTemplatesDiets = true;
          $hasNutrition_LIST            = true;
          $hasNutrition_Recipe          = true;
        ?>
        
        <?php if ($hasNutrition) { ?>
          <?php
            $dataOption = '';
            $navActiveMenunutritionMyCurrentsDiets = $navActiveMenuNutritionMyTemplatesDiets = $navActiveMenuNutritionMyRecipes = $navActiveMenuNutritionMyAliment = "";
            if (stripos($_SERVER['PHP_SELF'], 'nutritionMyCurrentsDiets')   !== false) { $dataOption="on"; $navActiveMenunutritionMyCurrentsDiets = 'class="active"'; }
            if (stripos($_SERVER['PHP_SELF'], 'NutritionMyTemplatesDiets')  !== false) { $dataOption="on"; $navActiveMenuNutritionMyTemplatesDiet = 'class="active"'; }
            if (stripos($_SERVER['PHP_SELF'], 'NutritionMyRecipes')         !== false) { $dataOption="on"; $navActiveMenuNutritionMyRecipes        = 'class="active"'; }
            if (stripos($_SERVER['PHP_SELF'], 'NutritionMyAliment')         !== false) { $dataOption="on"; $navActiveMenuNutritionMyAliment       = 'class="active"'; }
          ?>
          
          <li class="dropdown">
            <a href="javascript:;" class="dropdown-toggle" <?php echo $dataOption; ?>>
              <span class="micon dw dw-food-cart"></span>
              <span class="mtext"><?php echo $menu_nutrition; ?></span>
              &nbsp;<img src="vendors/images/coming-soon.png" alt="" width="25">
            </a>
            <ul class="submenu">
              <?php if ($hasNutrition_MyDiet)           { ?><li <?php echo $navActiveMenunutritionMyCurrentsDiets ?>><a class="nav-link" href="nutritionMyCurrentsDiets.php"><?php echo $menu_nutrition_myDiet; ?></a></li><?php } ?>
              <?php if ($hasNutrition_MyTemplatesDiets) { ?><li <?php echo $navActiveMenuNutritionMyTemplatesDiets ?>><a class="nav-link" href="nutritionMyTemplatesDiets.php"><?php echo $menu_nutrition_myTempletDiet; ?></a></li><?php } ?>
              <?php if ($hasNutrition_LIST)             { ?><li <?php echo $navActiveMenuNutritionMyRecipes ?>><a class="nav-link" href="nutritionMyRecipes.php"><?php echo $menu_nutrition_myRecipe; ?></a></li><?php } ?>
              <?php //if ($hasNutrition_Recipe)           { ?><!-- <li <?php //echo $navActiveMenuNutritionMyAliment ?>><a class="nav-link language_menu_nutrition_myAliment" href="nutritionMyAliment.php"></a></li>--><?php //} ?>
            </ul>
          </li>
        <?php } ?>
        
        <?php
          $hasBilan = true;
        ?>
        <?php if ($hasBilan) { ?>
          <li class="dropdown">
            <a href="javascript:;" class="dropdown-toggle">
              <span class="micon dw dw-board"></span>
              <span class="mtext"><?php echo $menu_bilan; ?></span>
              &nbsp;<img src="vendors/images/coming-soon.png" alt="" width="25">
            </a>
            <ul class="submenu">
              <li><a href="#">1</a></li>
              <li><a href="#">2</a></li>
              <li><a href="#">3</a></li>
              <li><a href="#">4</a></li>
            </ul>
          </li>
        <?php } ?>

        <?php
          $hasStudent = true;
        ?>
        <?php if ($hasStudent) { ?>
          <li class="dropdown">
            <a href="javascript:;" class="dropdown-toggle">
              <span class="micon dw dw-user-2"></span>
              <span class="mtext"><?php echo $menu_student; ?></span>
              &nbsp;<img src="vendors/images/coming-soon.png" alt="" width="25">
            </a>
            <ul class="submenu">
              <?php
                $hasSTUDENT_LIST_COATCH = DistriXStyAppInterface::hasAnyRight('WEBVYSION_SPORT', 'STUDENT', 'LIST_COATCH');
                $hasSTUDENT_LIST_COATCH = true;  

                $dataOption = '';
                $navActiveMenuStudentListCoatch = "";
                if (stripos($_SERVER['PHP_SELF'], 'studentListCoatch')        !== false) { $dataOption="on"; $navActiveMenuStudentListCoatch = 'class="active"'; }
              ?> 
              <?php if ($hasSTUDENT_LIST_COATCH) { ?><li <?php echo $navActiveMenuStudentListCoatch ?>><a class="nav-link" href="studentListCoatch.php"><?php echo $menu_student_list_coatch; ?></a></li><?php } ?>
            
              <li><a href="#">2</a></li>
              <li><a href="#">3</a></li>
              <li><a href="#">4</a></li>
            </ul>
          </li>
        <?php } ?>

        <?php
          $hasResource = true;
        ?>
        <?php if ($hasResource) { ?>
          <li class="dropdown">
            <a href="javascript:;" class="dropdown-toggle">
              <span class="micon dw dw-human-resources"></span>
              <span class="mtext"><?php echo $menu_ressource; ?></span>
              &nbsp;<img src="vendors/images/coming-soon.png" alt="" width="25">
            </a>
            <ul class="submenu">
              <li><a href="#">1</a></li>
              <li><a href="#">2</a></li>
              <li><a href="#">3</a></li>
              <li><a href="#">4</a></li>
            </ul>
          </li>
        <?php } ?>

        <?php
          $hasFormule = true;
        ?>
        <?php if ($hasFormule) { ?>
          <li class="dropdown">
            <a href="javascript:;" class="dropdown-toggle">
              <span class="micon dw dw-money-1"></span>
              <span class="mtext"><?php echo $menu_formule; ?></span>
              &nbsp;<img src="vendors/images/coming-soon.png" alt="" width="25">
            </a>
            <ul class="submenu">
              <li><a href="#">1</a></li>
              <li><a href="#">2</a></li>
              <li><a href="#">3</a></li>
              <li><a href="#">4</a></li>
            </ul>
          </li>
        <?php } ?>

        <?php
          $hasParam = true;
        ?>
        <?php if ($hasParam) { ?>
          <li class="dropdown">
            <a href="javascript:;" class="dropdown-toggle">
              <span class="micon dw dw-settings"></span>
              <span class="mtext"><?php echo $menu_parametre; ?></span>
              &nbsp;<img src="vendors/images/coming-soon.png" alt="" width="25">
            </a>
            <ul class="submenu">
              <li><a href="#">1</a></li>
              <li><a href="#">2</a></li>
              <li><a href="#">3</a></li>
              <li><a href="#">4</a></li>
            </ul>
          </li>
        <?php } ?>

        <?php
          $hasMessaging = true;
        ?>
        <?php if ($hasMessaging) { ?>
          <li class="dropdown">
            <a href="javascript:;" class="dropdown-toggle">
              <span class="micon dw dw-message"></span>
              <span class="mtext"><?php echo $menu_messagerie; ?></span>
              &nbsp;<img src="vendors/images/coming-soon.png" alt="" width="25">
            </a>
            <ul class="submenu">
              <li><a href="#">1</a></li>
              <li><a href="#">2</a></li>
              <li><a href="#">3</a></li>
              <li><a href="#">4</a></li>
            </ul>
          </li>
        <?php } ?>
        
        <?php
          $hasAdministration               = false;
          $hasRight_ADMIN_ENTERPRISE       = DistriXStyAppInterface::hasAnyRight('WEBVYSION_SPORT', 'SECURITY', 'ADMIN_ENTERPRISE');
          $hasRight_ADMIN_USER             = DistriXStyAppInterface::hasAnyRight('WEBVYSION_SPORT', 'SECURITY', 'ADMIN_USER');
          $hasRight_ADMIN_USER_TYPE        = DistriXStyAppInterface::hasAnyRight('WEBVYSION_SPORT', 'SECURITY', 'ADMIN_USER_TYPE');
          $hasAdminUser                    = false;
          if(
            $hasRight_ADMIN_ENTERPRISE       || 
            $hasRight_ADMIN_USER             || 
            $hasRight_ADMIN_USER_TYPE) {
            $hasAdministration             = true;
            $hasAdminUser                  = true;
          }
          
          $hasRight_SECURITY_APPLICATION   = DistriXStyAppInterface::hasAnyRight('WEBVYSION_SPORT', 'SECURITY', 'SECURITY_APPLICATION');
          $hasRight_SECURITY_MODULE        = DistriXStyAppInterface::hasAnyRight('WEBVYSION_SPORT', 'SECURITY', 'SECURITY_MODULE');
          $hasRight_SECURITY_FUNCTIONALITY = DistriXStyAppInterface::hasAnyRight('WEBVYSION_SPORT', 'SECURITY', 'SECURITY_FUNCTIONALITY');
          $hasRight_SECURITY_ROLE          = DistriXStyAppInterface::hasAnyRight('WEBVYSION_SPORT', 'SECURITY', 'SECURITY_ROLE');
          $hasRight_SECURITY_RIGHT         = DistriXStyAppInterface::hasAnyRight('WEBVYSION_SPORT', 'SECURITY', 'SECURITY_RIGHT');
          $hasSecurity                     = false;
          if(
            $hasRight_SECURITY_APPLICATION   || 
            $hasRight_SECURITY_MODULE        || 
            $hasRight_SECURITY_FUNCTIONALITY || 
            $hasRight_SECURITY_ROLE          || 
            $hasRight_SECURITY_RIGHT) {
              $hasAdministration           = true;
              $hasSecurity                 = true;
          }
          $hasRight_FOOD_FOOD         = DistriXStyAppInterface::hasAnyRight('WEBVYSION_SPORT', 'SECURITY', 'FOOD_FOOD');
          $hasRight_FOOD_BRAND        = DistriXStyAppInterface::hasAnyRight('WEBVYSION_SPORT', 'SECURITY', 'FOOD_BRAND');
          $hasRight_FOOD_ECO_SCORE    = DistriXStyAppInterface::hasAnyRight('WEBVYSION_SPORT', 'SECURITY', 'FOOD_ECO_SCORE');
          $hasRight_FOOD_NOVA_SCORE   = DistriXStyAppInterface::hasAnyRight('WEBVYSION_SPORT', 'SECURITY', 'FOOD_NOVA_SCORE');
          $hasRight_FOOD_NUTRI_SCORE  = DistriXStyAppInterface::hasAnyRight('WEBVYSION_SPORT', 'SECURITY', 'FOOD_NUTRI_SCORE');
          $hasRight_FOOD_LABEL        = DistriXStyAppInterface::hasAnyRight('WEBVYSION_SPORT', 'SECURITY', 'FOOD_LABEL');
          $hasFood                    = false;
          if(
            $hasRight_FOOD_FOOD         || 
            $hasRight_FOOD_BRAND        || 
            $hasRight_FOOD_NOVA_SCORE   || 
            $hasRight_FOOD_NUTRI_SCORE  || 
            $hasRight_FOOD_LABEL) {
              $hasAdministration        = true;
              $hasFood                  = true;
          }
        
          $hasRight_CODE_TABLE_WEIGHT_TYPE    = DistriXStyAppInterface::hasAnyRight('WEBVYSION_SPORT', 'SECURITY', 'CODE_TABLE_WEIGHT_TYPE');
          $hasRight_CODE_TABLE_FOOD_CATEGORY  = DistriXStyAppInterface::hasAnyRight('WEBVYSION_SPORT', 'SECURITY', 'CODE_TABLE_FOOD_CATEGORY');
          $hasRight_CODE_TABLE_NUTRITIONAL    = DistriXStyAppInterface::hasAnyRight('WEBVYSION_SPORT', 'SECURITY', 'CODE_TABLE_NUTRITIONAL');
          $hasRight_CODE_TABLE_LANGUES        = DistriXStyAppInterface::hasAnyRight('WEBVYSION_SPORT', 'SECURITY', 'CODE_TABLE_LANGUES');
          $hasCodeTable                       = false;
          if(
            $hasRight_CODE_TABLE_WEIGHT_TYPE  || 
            $hasRight_CODE_TABLE_FOOD_CATEGORY|| 
            $hasRight_CODE_TABLE_NUTRITIONAL  || 
            $hasRight_CODE_TABLE_LANGUES) {
              $hasAdministration            = true;
              $hasCodeTable                 = true;
          }
        ?>
        
        <?php if ($hasAdministration) { ?>
          <li>
            <div class="dropdown-divider"></div>
          </li>
          
          <li>
            <div class="sidebar-small-cap"><?php echo $menu_admin; ?></div>
          </li>
          
          <!-- ///////////////////////////////////////////////////////////////////////////////////////////////////// -->
          <!-- //                                           MENU USER STY                                         // -->
          <!-- ///////////////////////////////////////////////////////////////////////////////////////////////////// -->
          <?php if ($hasAdminUser) { ?>
            <li class="dropdown">
              <a href="javascript:;" class="dropdown-toggle">
                <span class="micon dw dw-user-13"></span>
                <span class="mtext"><?php echo $menu_admin_users; ?></span>
              </a>
              <ul class="submenu">
                <?php
                  $dataOption = '';
                  $navActiveMenuAdminUser = $navActiveMenuAdminEnterprise = $navActiveMenuAdminUserType = "";
                  if (stripos($_SERVER['PHP_SELF'], 'adminUserList')        !== false) { $dataOption="on"; $navActiveMenuAdminUser        = 'class="active"'; }
                  if (stripos($_SERVER['PHP_SELF'], 'adminEnterpriseList')  !== false) { $dataOption="on"; $navActiveMenuAdminEnterprise  = 'class="active"'; }
                  if (stripos($_SERVER['PHP_SELF'], 'adminUserTypeList')    !== false) { $dataOption="on"; $navActiveMenuAdminUserType    = 'class="active"'; }
                ?> 
                <?php if ($hasRight_ADMIN_USER)       { ?><li <?php echo $navActiveMenuAdminUser ?>><a class="nav-link" href="adminUserList.php"><?php echo $menu_admin_users_list; ?></a></li><?php } ?>
                <?php if ($hasRight_ADMIN_ENTERPRISE) { ?><li <?php echo $navActiveMenuAdminEnterprise ?>><a class="nav-link" href="adminEnterpriseList.php"><?php echo $menu_admin_enterprises_list; ?></a></li><?php } ?>
                <?php if ($hasRight_ADMIN_USER_TYPE)  { ?><li <?php echo $navActiveMenuAdminUserType ?>><a class="nav-link" href="adminUserTypeList.php"><?php echo $menu_admin_usersTypes_list; ?></a></li><?php } ?>
                                
                <?php if ($hasSecurity) { ?>
                  <?php
                    $dataOption = '';
                    $navActiveMenuAdminApplication = $navActiveMenuAdminModule = $navActiveMenuAdminFunctionality = $navActiveMenuAdminRole = $navActiveMenuAdminRight = "";
                    if (stripos($_SERVER['PHP_SELF'], 'adminApplication')     !== false) { $dataOption="on"; $navActiveMenuAdminApplication    = 'class="active"'; }
                    if (stripos($_SERVER['PHP_SELF'], 'adminModule')          !== false) { $dataOption="on"; $navActiveMenuAdminModule         = 'class="active"'; }
                    if (stripos($_SERVER['PHP_SELF'], 'adminFunctionality')   !== false) { $dataOption="on"; $navActiveMenuAdminFunctionality  = 'class="active"'; }
                    if (stripos($_SERVER['PHP_SELF'], 'adminRoleList')        !== false) { $dataOption="on"; $navActiveMenuAdminRole           = 'class="active"'; }
                    if (stripos($_SERVER['PHP_SELF'], 'adminRightList')       !== false) { $dataOption="on"; $navActiveMenuAdminRight          = 'class="active"'; }
                  ?>
                  <li class="dropdown">
                    <a href="javascript:;" class="dropdown-toggle">
                      <span class="micon fa fa-cogs"></span>
                      <span class="mtext "><?php echo $menu_right; ?></span>
                    </a>
                    <ul class="submenu child">
                      <?php if ($hasRight_SECURITY_APPLICATION) {    ?><li <?php echo $navActiveMenuAdminApplication ?>><a class="nav-link" href="adminApplicationList.php"><?php echo $menu_right_applications_list; ?>/a></li><?php } ?>
                      <?php if ($hasRight_SECURITY_MODULE) {         ?><li <?php echo $navActiveMenuAdminModule ?>><a class="nav-link" href="adminModuleList.php"><?php echo $menu_right_modules_list; ?></a></li><?php } ?>
                      <?php if ($hasRight_SECURITY_FUNCTIONALITY) {  ?><li <?php echo $navActiveMenuAdminFunctionality ?>><a class="nav-link" href="adminFunctionalityList.php"><?php echo $menu_right_functionalities_list; ?></a></li><?php } ?>
                      <?php if ($hasRight_SECURITY_ROLE) {           ?><li <?php echo $navActiveMenuAdminRole ?>><a class="nav-link" href="adminRoleList.php"><?php echo $menu_right_roles_list; ?></a></li><?php } ?>
                      <?php if ($hasRight_SECURITY_RIGHT) {          ?><li <?php echo $navActiveMenuAdminRight ?>><a class="nav-link" href="adminRightList.php"><?php echo $menu_right_rights_list; ?></a></li><?php } ?>
                    </ul>
                  </li>
                <?php } ?>
              </ul>
            </li>
          <?php } ?>
        <?php } ?>
       
        <!-- ///////////////////////////////////////////////////////////////////////////////////////////////////// -->
        <!-- //                                           MENU FOOD                                             // -->
        <!-- ///////////////////////////////////////////////////////////////////////////////////////////////////// -->
        <?php if ($hasFood) { ?>
          <?php
            $dataOption = '';
            $navActiveMenuFoodFood = $navActiveMenuFoodBrand = $navActiveMenuFoodEcoScore = $navActiveMenuFoodNovaScore = $navActiveMenuFoodNutriScore = $navActiveMenuFoodLabel = '';
            if (stripos($_SERVER['PHP_SELF'], 'foodFood')       !== false) { $dataOption="on"; $navActiveMenuFoodFood       = 'class="active"'; }
            if (stripos($_SERVER['PHP_SELF'], 'foodBrand')      !== false) { $dataOption="on"; $navActiveMenuFoodBrand      = 'class="active"'; }
            if (stripos($_SERVER['PHP_SELF'], 'foodEcoScore')   !== false) { $dataOption="on"; $navActiveMenuFoodEcoScore   = 'class="active"'; }
            if (stripos($_SERVER['PHP_SELF'], 'foodNovaScore')  !== false) { $dataOption="on"; $navActiveMenuFoodNovaScore  = 'class="active"'; }
            if (stripos($_SERVER['PHP_SELF'], 'foodNutriScore') !== false) { $dataOption="on"; $navActiveMenuFoodNutriScore = 'class="active"'; }
            if (stripos($_SERVER['PHP_SELF'], 'foodLabel')      !== false) { $dataOption="on"; $navActiveMenuFoodLabel      = 'class="active"'; }
          ?>
          <li>
            <a href="javascript:;" class="dropdown-toggle">
              <span class="micon dw dw-harvest"></span>
              <span class="mtext"><?php echo $menu_food; ?></span>
            </a>
            <ul class="submenu">
              <?php if ($hasRight_FOOD_FOOD)        { ?><li <?php echo $navActiveMenuFoodFood ?>><a class="nav-link" href="foodFoodList.php"><?php echo $menu_food_food_list; ?></a></li><?php } ?>
              <?php if ($hasRight_FOOD_BRAND)       { ?><li <?php echo $navActiveMenuFoodBrand ?>><a class="nav-link" href="foodBrandList.php"><?php echo $menu_food_brand_list; ?></a></li><?php } ?>
              <?php if ($hasRight_FOOD_ECO_SCORE)   { ?><li <?php echo $navActiveMenuFoodEcoScore ?>><a class="nav-link" href="foodEcoScoreList.php"><?php echo $menu_food_ecoScore_list; ?></a></li><?php } ?>
              <?php if ($hasRight_FOOD_NOVA_SCORE)  { ?><li <?php echo $navActiveMenuFoodNovaScore ?>><a class="nav-link" href="foodNovaScoreList.php"><?php echo $menu_food_novaScore_list; ?></a></li><?php } ?>
              <?php if ($hasRight_FOOD_NUTRI_SCORE) { ?><li <?php echo $navActiveMenuFoodNutriScore ?>><a class="nav-link" href="foodNutriScoreList.php"><?php echo $menu_food_nutriScore_list; ?></a></li><?php } ?>
              <?php if ($hasRight_FOOD_LABEL)       { ?><li <?php echo $navActiveMenuFoodLabel ?>><a class="nav-link" href="foodLabelList.php"><?php echo $menu_food_label_list; ?></a></li><?php } ?>
            </ul>
          </li>
        <?php } ?>
        
        <!-- ///////////////////////////////////////////////////////////////////////////////////////////////////// -->
        <!-- //                                       MENU CODES TABLES                                         // -->
        <!-- ///////////////////////////////////////////////////////////////////////////////////////////////////// -->
        <?php if ($hasCodeTable) { ?>
          <?php
            $dataOption = '';
            $navActiveMenuCodeTableWeightType = $navActiveMenuCodeTableFoodCategory = $navActiveMenuCodeTableNutritionale = $navActiveMenuCodeTableLanguage = "";
            if (stripos($_SERVER['PHP_SELF'], 'codeTablesWeightType')   !== false) { $dataOption="on"; $navActiveMenuCodeTableWeightType    = 'class="active"'; }
            if (stripos($_SERVER['PHP_SELF'], 'codeTablesFoodCategory') !== false) { $dataOption="on"; $navActiveMenuCodeTableFoodCategory  = 'class="active"'; }
            if (stripos($_SERVER['PHP_SELF'], 'codeTablesNutritionale') !== false) { $dataOption="on"; $navActiveMenuCodeTableNutritionale  = 'class="active"'; }
            if (stripos($_SERVER['PHP_SELF'], 'adminLanguage')          !== false) { $dataOption="on"; $navActiveMenuCodeTableLanguage      = 'class="active"'; }
          ?>
          <li>
            <a href="javascript:;" class="dropdown-toggle">
              <span class="micon dw dw-library"></span>
              <span class="mtext"><?php echo $menu_codeTables; ?></span>
            </a>
            <ul class="submenu">
              <?php if ($hasRight_CODE_TABLE_WEIGHT_TYPE)   { ?><li <?php echo $navActiveMenuCodeTableWeightType ?>><a class="nav-link" href="codeTableWeightTypeList.php"><?php echo $menu_codeTables_weightType_list; ?></a></li><?php } ?>
              <?php if ($hasRight_CODE_TABLE_FOOD_CATEGORY) { ?><li <?php echo $navActiveMenuCodeTableFoodCategory ?>><a class="nav-link" href="codeTableFoodCategoryList.php"><?php echo $menu_codeTables_food_category_list; ?></a></li><?php } ?>
              <?php if ($hasRight_CODE_TABLE_NUTRITIONAL)   { ?><li <?php echo $navActiveMenuCodeTableNutritionale ?>><a class="nav-link" href="codeTableNutritionalList.php"><?php echo $menu_codeTables_nutritional_list; ?></a></li><?php } ?>
              <?php if ($hasRight_CODE_TABLE_LANGUES)       { ?><li <?php echo $navActiveMenuCodeTableLanguage ?>><a class="nav-link" href="codeTableLanguageList.php"><?php echo $menu_codeTables_language_list; ?></a></li><?php } ?>
            </ul>
          </li>
        <?php } ?>
      </ul>
    </div>
  </div>
</div>