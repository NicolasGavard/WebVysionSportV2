<?php
  include(__DIR__ . "/DistriXInit/DistriXSvcControllerInit.php");
  include(__DIR__ . "/DistrixSecurity/styAppInterface/DistriXStyAppInterface.php");
  include(__DIR__ . "/DistrixSecurity/Const/DistriXStyRightConst.php");
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
            <span class="mtext">Accueil</span>
          </a>
        </li>
        
        <?php
          $hasSport = true;
        ?>
        <?php if ($hasSport) { ?>
          <li class="dropdown">
            <a href="javascript:;" class="dropdown-toggle">
              <span class="micon dw dw-dumbbell"></span><span class="mtext language_menu_sport"> </span>&nbsp;<img src="vendors/images/coming-soon.png" alt="" width="25">
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
              <span class="micon dw dw-food-cart"></span><span class="mtext language_menu_nutrition"> </span>&nbsp;<img src="vendors/images/coming-soon.png" alt="" width="25">
            </a>
            <ul class="submenu">
              <?php if ($hasNutrition_MyDiet)           { ?><li <?php echo $navActiveMenunutritionMyCurrentsDiets ?>><a class="nav-link language_menu_nutrition_myDiet" href="nutritionMyCurrentsDiets.php"></a></li><?php } ?>
              <?php if ($hasNutrition_MyTemplatesDiets) { ?><li <?php echo $navActiveMenuNutritionMyTemplatesDiets ?>><a class="nav-link language_menu_nutrition_myTempletDiet" href="nutritionMyTemplatesDiets.php"></a></li><?php } ?>
              <?php if ($hasNutrition_LIST)             { ?><li <?php echo $navActiveMenuNutritionMyRecipes ?>><a class="nav-link language_menu_menu_nutrition_myRecipe" href="nutritionMyRecipes.php"></a></li><?php } ?>
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
              <span class="micon dw dw-board"></span><span class="mtext language_menu_bilan"> </span>&nbsp;<img src="vendors/images/coming-soon.png" alt="" width="25">
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
              <span class="micon dw dw-user-2"></span><span class="mtext language_menu_student"> </span>&nbsp;<img src="vendors/images/coming-soon.png" alt="" width="25">
            </a>
            <ul class="submenu">
              <?php
                $hasSTUDENT_LIST_COATCH = DistriXStyAppInterface::hasAnyRight('WEBVYSION_SPORT', 'STUDENT', 'LIST_COATCH');
                $hasSTUDENT_LIST_COATCH = true;  

                $dataOption = '';
                $navActiveMenuStudentListCoatch = "";
                if (stripos($_SERVER['PHP_SELF'], 'studentListCoatch')        !== false) { $dataOption="on"; $navActiveMenuStudentListCoatch = 'class="active"'; }
              ?> 
              <?php if ($hasSTUDENT_LIST_COATCH) { ?><li <?php echo $navActiveMenuStudentListCoatch ?>><a class="menu_student_list_coatch" href="studentListCoatch.php"></a></li><?php } ?>
            
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
              <span class="micon dw dw-human-resources"></span><span class="mtext language_menu_ressource"> </span>&nbsp;<img src="vendors/images/coming-soon.png" alt="" width="25">
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
              <span class="micon dw dw-money-1"></span><span class="mtext language_menu_formule"> </span>&nbsp;<img src="vendors/images/coming-soon.png" alt="" width="25">
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
              <span class="micon dw dw-settings"></span><span class="mtext language_menu_parametre"> </span>&nbsp;<img src="vendors/images/coming-soon.png" alt="" width="25">
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
              <span class="micon dw dw-message"></span><span class="mtext language_menu_messagerie"> </span>&nbsp;<img src="vendors/images/coming-soon.png" alt="" width="25">
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
            <div class="sidebar-small-cap language_menu_admin"></div>
          </li>
          
          <!-- ///////////////////////////////////////////////////////////////////////////////////////////////////// -->
          <!-- //                                           MENU USER STY                                         // -->
          <!-- ///////////////////////////////////////////////////////////////////////////////////////////////////// -->
          <?php if ($hasAdminUser) { ?>
            <li class="dropdown">
              <a href="javascript:;" class="dropdown-toggle">
                <span class="micon dw dw-user-13"></span><span class="mtext language_menu_admin_users"></span>
              </a>
              <ul class="submenu">
                <?php
                  $dataOption = '';
                  $navActiveMenuAdminUser = $navActiveMenuAdminEnterprise = $navActiveMenuAdminUserType = "";
                  if (stripos($_SERVER['PHP_SELF'], 'adminUserList')        !== false) { $dataOption="on"; $navActiveMenuAdminUser        = 'class="active"'; }
                  if (stripos($_SERVER['PHP_SELF'], 'adminEnterpriseList')  !== false) { $dataOption="on"; $navActiveMenuAdminEnterprise  = 'class="active"'; }
                  if (stripos($_SERVER['PHP_SELF'], 'adminUserTypeList')    !== false) { $dataOption="on"; $navActiveMenuAdminUserType    = 'class="active"'; }
                ?> 
                <?php if ($hasRight_ADMIN_USER)       { ?><li <?php echo $navActiveMenuAdminUser ?>><a class="menu_admin_users_list" href="adminUserList.php"></a></li><?php } ?>
                <?php if ($hasRight_ADMIN_ENTERPRISE) { ?><li <?php echo $navActiveMenuAdminEnterprise ?>><a class="menu_admin_enterprises_list" href="adminEnterpriseList.php"></a></li><?php } ?>
                <?php if ($hasRight_ADMIN_USER_TYPE)  { ?><li <?php echo $navActiveMenuAdminUserType ?>><a class="menu__admin_usersTypes_list" href="adminUserTypeList.php"></a></li><?php } ?>
                                
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
                      <span class="micon fa fa-cogs"></span><span class="mtext language_menu_admin_rights"></span>
                    </a>
                    <ul class="submenu child">
                      <li><a href="adminApplicationList.php">Liste des applications</a></li>
                      <?php if ($hasRight_SECURITY_APPLICATION) {    ?><li <?php echo $navActiveMenuAdminApplication ?>><a class="menu_right_applications_list" href="adminApplicationList.php"></a></li><?php } ?>
                      <?php if ($hasRight_SECURITY_MODULE) {         ?><li <?php echo $navActiveMenuAdminModule ?>><a class="menu_right_modules_list" href="adminModuleList.php"></a></li><?php } ?>
                      <?php if ($hasRight_SECURITY_FUNCTIONALITY) {  ?><li <?php echo $navActiveMenuAdminFunctionality ?>><a class="menu_right_functionalities_list" href="adminFunctionalityList.php"></a></li><?php } ?>
                      <?php if ($hasRight_SECURITY_ROLE) {           ?><li <?php echo $navActiveMenuAdminRole ?>><a class="menu_right_roles_list" href="adminRoleList.php"></a></li><?php } ?>
                      <?php if ($hasRight_SECURITY_RIGHT) {          ?><li <?php echo $navActiveMenuAdminRight ?>><a class="menu_right_rights_list" href="adminRightList.php"></a></li><?php } ?>
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
              <span class="micon dw dw-harvest"></span><span class="mtext language_menu_admin_food"></span>
            </a>
            <ul class="submenu">
              <?php if ($hasRight_FOOD_FOOD)        { ?><li <?php echo $navActiveMenuFoodFood ?>><a class="menu_food_food_list" href="foodFoodList.php"></a></li><?php } ?>
              <?php if ($hasRight_FOOD_BRAND)       { ?><li <?php echo $navActiveMenuFoodBrand ?>><a class="menu_food_brand_list" href="foodBrandList.php"></a></li><?php } ?>
              <?php if ($hasRight_FOOD_ECO_SCORE)   { ?><li <?php echo $navActiveMenuFoodEcoScore ?>><a class="menu_food_ecoScore_list" href="foodEcoScoreList.php"></a></li><?php } ?>
              <?php if ($hasRight_FOOD_NOVA_SCORE)  { ?><li <?php echo $navActiveMenuFoodNovaScore ?>><a class="menu_food_novaScore_list" href="foodNovaScoreList.php"></a></li><?php } ?>
              <?php if ($hasRight_FOOD_NUTRI_SCORE) { ?><li <?php echo $navActiveMenuFoodNutriScore ?>><a class="menu_food_nutriScore_list" href="foodNutriScoreList.php"></a></li><?php } ?>
              <?php if ($hasRight_FOOD_LABEL)       { ?><li <?php echo $navActiveMenuFoodLabel ?>><a class="menu_food_label_list" href="foodLabelList.php"></a></li><?php } ?>
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
              <span class="micon dw dw-library"></span><span class="mtext language_menu_admin_codeTables"></span>
            </a>
            <ul class="submenu">
              <?php if ($hasRight_CODE_TABLE_WEIGHT_TYPE)   { ?><li <?php echo $navActiveMenuCodeTableWeightType ?>><a class="menu_codeTables_weightType_list" href="codeTableWeightTypeList.php"></a></li><?php } ?>
              <?php if ($hasRight_CODE_TABLE_FOOD_CATEGORY) { ?><li <?php echo $navActiveMenuCodeTableFoodCategory ?>><a class="menu_codeTables_food_category_list" href="codeTableFoodCategoryList.php"></a></li><?php } ?>
              <?php if ($hasRight_CODE_TABLE_NUTRITIONAL)   { ?><li <?php echo $navActiveMenuCodeTableNutritionale ?>><a class="menu_codeTables_nutritional_list" href="codeTableNutritionalList.php"></a></li><?php } ?>
              <?php if ($hasRight_CODE_TABLE_LANGUES)       { ?><li <?php echo $navActiveMenuCodeTableLanguage ?>><a class="menu_codeTables_language_list" href="codeTableLanguageList.php"></a></li><?php } ?>
            </ul>
          </li>
        <?php } ?>
      </ul>
    </div>
  </div>
</div>