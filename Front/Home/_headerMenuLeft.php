<?php
  include(__DIR__ . "/../../DistriXInit/DistriXSvcControllerInit.php");
  include(__DIR__ . "/../../DistrixSecurity/styAppInterface/DistriXStyAppInterface.php");
  include(__DIR__ . "/../../DistrixSecurity/Const/DistriXStyRightConst.php");
?>

<div class="left-side-bar">
  <div class="brand-logo">
    <a href="main.php">
      <img src="../../images/WebVysionSport.png" alt="" class="light-logo" style="max-width: 75px;">
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
              &nbsp;<img src="../../vendors/images/coming-soon.png" alt="" width="25">
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
          $hasNutrition                   = true;
          $hasNutrition_MyDiet            = true;
          $hasNutrition_MyTemplatesDiets  = true;
          $hasNutrition_Recipe            = true;
        ?>
        
        <?php if ($hasNutrition) { ?>
          <?php
            $dataOption       = 'off';
            $show1  = $show2  = '';
            $style1 = 'none';
            $style2 = 'none';
            $navActiveMenunutritionMyCurrentsDiets = $navActiveMenuNutritionMyTemplatesDiets = $navActiveMenuNutritionMyRecipes = "";
            if (stripos($_SERVER['PHP_SELF'], 'nutritionMyCurrentsDietsList')   !== false) { $dataOption="on"; $show1="show;"; $style1='block'; $navActiveMenunutritionMyCurrentsDiets = 'class="active"'; }
            if (stripos($_SERVER['PHP_SELF'], 'NutritionMyTemplatesDietsList')  !== false) { $dataOption="on"; $show1="show;"; $style1='block'; $navActiveMenuNutritionMyTemplatesDiet = 'class="active"'; }
            if (stripos($_SERVER['PHP_SELF'], 'NutritionMyRecipesList')         !== false) { $dataOption="on"; $show1="show;"; $style1='block'; $navActiveMenuNutritionMyRecipes        = 'class="active"'; }

            $navActiveMenuFoodFood = $navActiveMenuFoodBrand = $navActiveMenuFoodEcoScore = $navActiveMenuFoodNovaScore = $navActiveMenuFoodNutriScore = $navActiveMenuFoodLabel = '';
            if (stripos($_SERVER['PHP_SELF'], 'foodFoodList')       !== false) { $dataOption="on"; $show1="show;"; $show2="show;"; $style1='block'; $style2='block'; $navActiveMenuFoodFood       = 'class="active"'; }
            if (stripos($_SERVER['PHP_SELF'], 'foodBrandList')      !== false) { $dataOption="on"; $show1="show;"; $show2="show;"; $style1='block'; $style2='block'; $navActiveMenuFoodBrand      = 'class="active"'; }
            if (stripos($_SERVER['PHP_SELF'], 'foodEcoScoreList')   !== false) { $dataOption="on"; $show1="show;"; $show2="show;"; $style1='block'; $style2='block'; $navActiveMenuFoodEcoScore   = 'class="active"'; }
            if (stripos($_SERVER['PHP_SELF'], 'foodNovaScoreList')  !== false) { $dataOption="on"; $show1="show;"; $show2="show;"; $style1='block'; $style2='block'; $navActiveMenuFoodNovaScore  = 'class="active"'; }
            if (stripos($_SERVER['PHP_SELF'], 'foodNutriScoreList') !== false) { $dataOption="on"; $show1="show;"; $show2="show;"; $style1='block'; $style2='block'; $navActiveMenuFoodNutriScore = 'class="active"'; }
            if (stripos($_SERVER['PHP_SELF'], 'foodLabelList')      !== false) { $dataOption="on"; $show1="show;"; $show2="show;"; $style1='block'; $style2='block'; $navActiveMenuFoodLabel      = 'class="active"'; }
          ?>
          
          <li class="dropdown <?php echo $show1; ?>">
            <a href="javascript:;" class="dropdown-toggle" data-option="<?php echo $dataOption; ?>">
              <span class="micon dw dw-food-cart"></span>
              <span class="mtext"><?php echo $menu_nutrition; ?></span>
              &nbsp;<img src="../../vendors/images/coming-soon.png" alt="" width="25">
            </a>
            <ul class="submenu" style='display: <?php echo $style1; ?>'>
              <?php if ($hasNutrition_MyDiet)           { ?><li <?php echo $navActiveMenunutritionMyCurrentsDiets ?>><a class="nav-link" href="../Nutrition/nutritionMyCurrentsDietsList.php"><?php echo $menu_nutrition_myDiet; ?></a></li><?php } ?>
              <?php if ($hasNutrition_MyTemplatesDiets) { ?><li <?php echo $navActiveMenuNutritionMyTemplatesDiets ?>><a class="nav-link" href="../Nutrition/nutritionMyTemplatesDietsList.php"><?php echo $menu_nutrition_myTempletDiet; ?></a></li><?php } ?>
              <?php if ($hasNutrition_Recipe)           { ?><li <?php echo $navActiveMenuNutritionMyRecipes ?>><a class="nav-link" href="../Nutrition/nutritionMyRecipesList.php"><?php echo $menu_nutrition_myRecipe; ?></a></li><?php } ?>
              
              <!-- ///////////////////////////////////////////////////////////////////////////////////////////////////// -->
              <!-- //                                           MENU FOOD                                             // -->
              <!-- ///////////////////////////////////////////////////////////////////////////////////////////////////// -->
              <?php
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
                  $hasRight_FOOD_ECO_SCORE    || 
                  $hasRight_FOOD_NOVA_SCORE   || 
                  $hasRight_FOOD_NUTRI_SCORE  || 
                  $hasRight_FOOD_LABEL) {
                    $hasFood                = true;
                }
              ?>
              
              <?php if ($hasFood) { ?>
                <li class="dropdown <?php echo $show2; ?>">
                  <a href="javascript:;" class="dropdown-toggle" data-option="<?php echo $dataOption; ?>">
                    <span class="micon dw dw-harvest"></span>
                    <span class="mtext"><?php echo $menu_food; ?></span>
                  </a>
                  <ul class="submenu child">
                    <?php if ($hasRight_FOOD_FOOD)        { ?><li <?php echo $navActiveMenuFoodFood ?>><a class="nav-link" href="../Food/foodFoodList.php"><?php echo $menu_food_food_list; ?></a></li><?php } ?>
                    <?php if ($hasRight_FOOD_BRAND)       { ?><li <?php echo $navActiveMenuFoodBrand ?>><a class="nav-link" href="../Food/foodBrandList.php"><?php echo $menu_food_brand_list; ?></a></li><?php } ?>
                    <?php if ($hasRight_FOOD_ECO_SCORE)   { ?><li <?php echo $navActiveMenuFoodEcoScore ?>><a class="nav-link" href="../Food/foodEcoScoreList.php"><?php echo $menu_food_ecoScore_list; ?></a></li><?php } ?>
                    <?php if ($hasRight_FOOD_NOVA_SCORE)  { ?><li <?php echo $navActiveMenuFoodNovaScore ?>><a class="nav-link" href="../Food/foodNovaScoreList.php"><?php echo $menu_food_novaScore_list; ?></a></li><?php } ?>
                    <?php if ($hasRight_FOOD_NUTRI_SCORE) { ?><li <?php echo $navActiveMenuFoodNutriScore ?>><a class="nav-link" href="../Food/foodNutriScoreList.php"><?php echo $menu_food_nutriScore_list; ?></a></li><?php } ?>
                    <?php if ($hasRight_FOOD_LABEL)       { ?><li <?php echo $navActiveMenuFoodLabel ?>><a class="nav-link" href="../Food/foodLabelList.php"><?php echo $menu_food_label_list; ?></a></li><?php } ?>
                  </ul>
                </li>
              <?php } ?>
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
              &nbsp;<img src="../../vendors/images/coming-soon.png" alt="" width="25">
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
              &nbsp;<img src="../../vendors/images/coming-soon.png" alt="" width="25">
            </a>
            <ul class="submenu">
              <?php
                $hasSTUDENT_LIST_COATCH = DistriXStyAppInterface::hasAnyRight('WEBVYSION_SPORT', 'STUDENT', 'LIST_COATCH');
                $hasSTUDENT_LIST_COATCH = true;  

                $dataOption = '';
                $navActiveMenuStudentListCoach = "";
                if (stripos($_SERVER['PHP_SELF'], 'studentListCoach')        !== false) { $dataOption="on"; $navActiveMenuStudentListCoach = 'class="active"'; }
              ?> 
              <?php if ($hasSTUDENT_LIST_COATCH) { ?><li <?php echo $navActiveMenuStudentListCoach ?>><a class="nav-link" href="../Student/studentListCoach.php"><?php echo $menu_student_list_coach; ?></a></li><?php } ?>
            
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
              &nbsp;<img src="../../vendors/images/coming-soon.png" alt="" width="25">
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
              &nbsp;<img src="../../vendors/images/coming-soon.png" alt="" width="25">
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
              &nbsp;<img src="../../vendors/images/coming-soon.png" alt="" width="25">
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
              &nbsp;<img src="../../vendors/images/coming-soon.png" alt="" width="25">
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
          $hasRight_CODE_TABLE_WEIGHT_TYPE    = DistriXStyAppInterface::hasAnyRight('WEBVYSION_SPORT', 'SECURITY', 'CODE_TABLE_WEIGHT_TYPE');
          $hasRight_CODE_TABLE_FOOD_CATEGORY  = DistriXStyAppInterface::hasAnyRight('WEBVYSION_SPORT', 'SECURITY', 'CODE_TABLE_FOOD_CATEGORY');
          $hasRight_CODE_TABLE_NUTRITIONAL    = DistriXStyAppInterface::hasAnyRight('WEBVYSION_SPORT', 'SECURITY', 'CODE_TABLE_NUTRITIONAL');
          $hasRight_CODE_TABLE_FOOD_TYPE      = DistriXStyAppInterface::hasAnyRight('WEBVYSION_SPORT', 'SECURITY', 'CODE_TABLE_FOOD_TYPE');
          $hasRight_CODE_TABLE_LANGUES        = DistriXStyAppInterface::hasAnyRight('WEBVYSION_SPORT', 'SECURITY', 'CODE_TABLE_LANGUES');
          $hasCodeTable                       = false;
          if(
            $hasRight_CODE_TABLE_WEIGHT_TYPE  || 
            $hasRight_CODE_TABLE_FOOD_CATEGORY|| 
            $hasRight_CODE_TABLE_NUTRITIONAL  || 
            $hasRight_CODE_TABLE_FOOD_TYPE    || 
            $hasRight_CODE_TABLE_LANGUES) {
              $hasAdministration            = true;
              $hasCodeTable                 = true;
          }

          $hasRight_ADMIN_ENTERPRISE          = true;
          $hasRight_ADMIN_USER                = true;
          $hasRight_ADMIN_USER_TYPE           = true;
          $hasRight_SECURITY_APPLICATION      = true;
          $hasRight_SECURITY_MODULE           = true;
          $hasRight_SECURITY_FUNCTIONALITY    = true;
          $hasRight_SECURITY_ROLE             = true;
          $hasRight_SECURITY_RIGHT            = true;
          $hasRight_FOOD_FOOD                 = true;
          $hasRight_FOOD_BRAND                = true;
          $hasRight_FOOD_ECO_SCORE            = true;
          $hasRight_FOOD_NOVA_SCORE           = true;
          $hasRight_FOOD_NUTRI_SCORE          = true;
          $hasRight_FOOD_LABEL                = true;
          $hasRight_CODE_TABLE_WEIGHT_TYPE    = true;
          $hasRight_CODE_TABLE_FOOD_CATEGORY  = true;
          $hasRight_CODE_TABLE_NUTRITIONAL    = true;
          $hasRight_CODE_TABLE_LANGUES        = true;
          $hasRight_CODE_TABLE_FOOD_TYPE      = true;
          
          $hasAdministration                  = true;
          $hasAdminUser                       = true;
          $hasSecurity                        = true;
          $hasFood                            = true;
          $hasCodeTable                       = true;
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
                <?php if ($hasRight_ADMIN_USER)       { ?><li <?php echo $navActiveMenuAdminUser ?>><a class="nav-link" href="../Admin/adminUserList.php"><?php echo $menu_admin_users_list; ?></a></li><?php } ?>
                <?php if ($hasRight_ADMIN_ENTERPRISE) { ?><li <?php echo $navActiveMenuAdminEnterprise ?>><a class="nav-link" href="../Admin/adminEnterpriseList.php"><?php echo $menu_admin_enterprises_list; ?></a></li><?php } ?>
                <?php if ($hasRight_ADMIN_USER_TYPE)  { ?><li <?php echo $navActiveMenuAdminUserType ?>><a class="nav-link" href="../Admin/adminUserTypeList.php"><?php echo $menu_admin_usersTypes_list; ?></a></li><?php } ?>
                                
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
                      <?php if ($hasRight_SECURITY_APPLICATION) {    ?><li <?php echo $navActiveMenuAdminApplication ?>><a class="nav-link" href="../Admin/adminApplicationList.php"><?php echo $menu_right_applications_list; ?>/a></li><?php } ?>
                      <?php if ($hasRight_SECURITY_MODULE) {         ?><li <?php echo $navActiveMenuAdminModule ?>><a class="nav-link" href="../Admin/adminModuleList.php"><?php echo $menu_right_modules_list; ?></a></li><?php } ?>
                      <?php if ($hasRight_SECURITY_FUNCTIONALITY) {  ?><li <?php echo $navActiveMenuAdminFunctionality ?>><a class="nav-link" href="../Admin/adminFunctionalityList.php"><?php echo $menu_right_functionalities_list; ?></a></li><?php } ?>
                      <?php if ($hasRight_SECURITY_ROLE) {           ?><li <?php echo $navActiveMenuAdminRole ?>><a class="nav-link" href="../Admin/adminRoleList.php"><?php echo $menu_right_roles_list; ?></a></li><?php } ?>
                      <?php if ($hasRight_SECURITY_RIGHT) {          ?><li <?php echo $navActiveMenuAdminRight ?>><a class="nav-link" href="../Admin/adminRightList.php"><?php echo $menu_right_rights_list; ?></a></li><?php } ?>
                    </ul>
                  </li>
                <?php } ?>
              </ul>
            </li>
          <?php } ?>
        <?php } ?>
       
        <!-- ///////////////////////////////////////////////////////////////////////////////////////////////////// -->
        <!-- //                                       MENU CODES TABLES                                         // -->
        <!-- ///////////////////////////////////////////////////////////////////////////////////////////////////// -->
        <?php if ($hasCodeTable) { ?>
          <?php
            $dataOption = '';
            $navActiveMenuCodeTableWeightType = $navActiveMenuCodeTableFoodCategory = $navActiveMenuCodeTableFoodType = $navActiveMenuCodeTableMealType = "";
            $navActiveMenuCodeTableNutritionale = $navActiveMenuCodeTableLanguage = "";
            $navActiveMenuCodeTableFoodType = "";
            if (stripos($_SERVER['PHP_SELF'], 'codeTablesWeightType')   !== false) { $dataOption="on"; $navActiveMenuCodeTableWeightType    = 'class="active"'; }
            if (stripos($_SERVER['PHP_SELF'], 'codeTablesFoodCategory') !== false) { $dataOption="on"; $navActiveMenuCodeTableFoodCategory  = 'class="active"'; }
            if (stripos($_SERVER['PHP_SELF'], 'codeTablesFoodType')     !== false) { $dataOption="on"; $navActiveMenuCodeTableFoodType      = 'class="active"'; }
            if (stripos($_SERVER['PHP_SELF'], 'codeTablesMealType')     !== false) { $dataOption="on"; $navActiveMenuCodeTableMealType      = 'class="active"'; }
            if (stripos($_SERVER['PHP_SELF'], 'codeTablesNutritionale') !== false) { $dataOption="on"; $navActiveMenuCodeTableNutritionale  = 'class="active"'; }
            if (stripos($_SERVER['PHP_SELF'], 'codeTablesFoodType')     !== false) { $dataOption="on"; $navActiveMenuCodeTableFoodType      = 'class="active"'; }
            if (stripos($_SERVER['PHP_SELF'], 'adminLanguage')          !== false) { $dataOption="on"; $navActiveMenuCodeTableLanguage      = 'class="active"'; }
          ?>
          <li>
            <a href="javascript:;" class="dropdown-toggle">
              <span class="micon dw dw-library"></span>
              <span class="mtext"><?php echo $menu_codeTables; ?></span>
            </a>
            <ul class="submenu">
              <?php if ($hasRight_CODE_TABLE_WEIGHT_TYPE)   { ?><li <?php echo $navActiveMenuCodeTableWeightType ?>><a class="nav-link" href="../CodeTables/codeTableWeightTypeList.php"><?php echo $menu_codeTables_weightType_list; ?></a></li><?php } ?>
              <?php if ($hasRight_CODE_TABLE_FOOD_CATEGORY) { ?><li <?php echo $navActiveMenuCodeTableFoodCategory ?>><a class="nav-link" href="../CodeTables/codeTableFoodCategoryList.php"><?php echo $menu_codeTables_food_category_list; ?></a></li><?php } ?>
              <?php if ($hasRight_CODE_TABLE_FOOD_TYPE)     { ?><li <?php echo $navActiveMenuCodeTableFoodType ?>><a class="nav-link" href="../CodeTables/codeTableFoodTypeList.php"><?php echo $menu_codeTables_food_type_list; ?></a></li><?php } ?>
              <?php if ($hasRight_CODE_TABLE_MEAL_TYPE)     { ?><li <?php echo $navActiveMenuCodeTableMealType ?>><a class="nav-link" href="../CodeTables/codeTableMealTypeList.php"><?php echo $menu_codeTables_meal_type_list; ?></a></li><?php } ?>
              <?php if ($hasRight_CODE_TABLE_NUTRITIONAL)   { ?><li <?php echo $navActiveMenuCodeTableNutritionale ?>><a class="nav-link" href="../CodeTables/codeTableNutritionalList.php"><?php echo $menu_codeTables_nutritional_list; ?></a></li><?php } ?>
              <?php if ($hasRight_CODE_TABLE_FOOD_TYPE)     { ?><li <?php echo $navActiveMenuCodeTableFoodType ?>><a class="nav-link" href="../CodeTables/codeTableFoodTypeList.php"><?php echo $menu_codeTables_food_type_list; ?></a></li><?php } ?>
              <?php if ($hasRight_CODE_TABLE_LANGUES)       { ?><li <?php echo $navActiveMenuCodeTableLanguage ?>><a class="nav-link" href="../CodeTables/codeTableLanguageList.php"><?php echo $menu_codeTables_language_list; ?></a></li><?php } ?>
            </ul>
          </li>
        <?php } ?>
      </ul>
    </div>
  </div>
</div>