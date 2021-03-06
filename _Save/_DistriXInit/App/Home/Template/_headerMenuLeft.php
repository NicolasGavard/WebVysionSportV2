<?php
  include(__DIR__ . "/../" . FRONT_DISTRIX_PATH . "DistriXInit/DistriXSvcControllerInit.php");
  include(__DIR__ . "/../" . FRONT_DISTRIX_PATH . "DistriXSecurity/StyAppInterface/DistriXStyAppInterface.php");
  include(__DIR__ . "/../" . FRONT_DISTRIX_PATH . "DistriXSecurity/Const/DistriXStyRightConst.php");
?>

<div class="left-side-bar">
  <div class="brand-logo">
    <a href="<?php echo FRONT_PATH;?>App/Home/Template/main.php">
      <img src="<?php echo FRONT_PATH;?>images/VysionCoaching.png" alt="" class="light-logo" style="max-width: 75px;">
    </a>
    <div class="close-sidebar" data-toggle="left-sidebar-close">
      <i class="ion-close-round"></i>
    </div>
  </div>
  <div class="menu-block customscroll">
    <div class="sidebar-menu">
      <ul id="accordion-menu">
        <li>
          <a href="<?php echo FRONT_PATH;?>App/Home/Template/main.php" class="dropdown-toggle no-arrow">
            <span class="micon dw dw-house-1"></span>
            <span class="mtext"><?php echo $menu_home; ?></span>
          </a>
        </li>
        
        <?php
          $hasSport                 = true;
          $hasSportProgram          = true;
          $hasSportProgramTemplate  = true;
          $hasSportCircuit          = true;
          $hasSportExercise         = true;
          $hasSportBodyMuscle           = true;
        ?>

        <?php
          $hasSport                 = true;
          $hasSportProgram          = true;
          $hasSportProgramTemplate  = true;
          $hasSportCircuit          = true;
          $hasSportExercise         = true;

          $hasSportAdmin            = true;
          $hasSportBodyMember       = true;
          $hasSportBodyMuscle       = true;
          $hasSportExerciseType     = true;
          $hasSportCircuitType      = true;
        ?>
        <?php if ($hasSport) { ?>
          <?php
            $dataOption   = 'off';
            $classActiv1  = $classActiv2 = $classActiv3 = $classActiv4 = $classActiv5 = $classActiv6 = $classActiv7 = $classActiv8 = "";
            $show1        = $show2  = '';
            $style1       = 'none';
            $style2       = 'none';
            
            $navActiveMenuSportProgram = $navActiveMenuSportProgramTemplate = $navActiveMenuSportCircuit = $navActiveMenuSportExercise ="";
            if (stripos($_SERVER['PHP_SELF'], 'sportProgramList.php')         !== false) { $classActiv1="active"; $dataOption="on"; $show1="show"; $style1='block'; $navActiveMenuSportProgram         = 'class="active"'; }
            if (stripos($_SERVER['PHP_SELF'], 'sportProgramTemplateList.php') !== false) { $classActiv2="active"; $dataOption="on"; $show1="show"; $style1='block'; $navActiveMenuSportProgramTemplate = 'class="active"'; }
            if (stripos($_SERVER['PHP_SELF'], 'sportMyCircuitsList.php')      !== false) { $classActiv3="active"; $dataOption="on"; $show1="show"; $style1='block'; $navActiveMenuSportCircuit         = 'class="active"'; }
            if (stripos($_SERVER['PHP_SELF'], 'sportMyExercisesList.php')     !== false) { $classActiv4="active"; $dataOption="on"; $show1="show"; $style1='block'; $navActiveMenuSportExercise        = 'class="active"'; }

            $navActiveMenuSportBodyMember = $navActiveMenuSportBodyMuscle = $navActiveMenuSportExerciseType = $navActiveMenuSportCircuitType = '';
            if (stripos($_SERVER['PHP_SELF'], 'codeTableBodyMemberList.php')    !== false) { $classActiv5="active"; $dataOption="on"; $show1="show"; $show2="show"; $style1='block'; $style2='block'; $navActiveMenuSportBodyMember    = 'class="active"'; }
            if (stripos($_SERVER['PHP_SELF'], 'codeTableBodyMuscleList.php')    !== false) { $classActiv6="active"; $dataOption="on"; $show1="show"; $show2="show"; $style1='block'; $style2='block'; $navActiveMenuSportBodyMuscle    = 'class="active"'; }
            if (stripos($_SERVER['PHP_SELF'], 'codeTableExerciseTypeList.php')  !== false) { $classActiv7="active"; $dataOption="on"; $show1="show"; $show2="show"; $style1='block'; $style2='block'; $navActiveMenuSportExerciseType  = 'class="active"'; }
            if (stripos($_SERVER['PHP_SELF'], 'codeTableCircuitTypeList.php')   !== false) { $classActiv8="active"; $dataOption="on"; $show1="show"; $show2="show"; $style1='block'; $style2='block'; $navActiveMenuSportCircuitType  = 'class="active"'; }
          ?>
          <li class="dropdown <?php echo $show1; ?>">
            <a href="javascript:;" class="dropdown-toggle" data-option="<?php echo $dataOption; ?>">
              <span class="micon dw dw-dumbbell"></span>
              <span class="mtext"><?php echo $menu_sport; ?></span>
            </a>
            <ul class="submenu <?php echo $show1; ?>" style='display: <?php echo $style1; ?>'>
              <?php if ($hasSportProgram)         { ?><li <?php echo $navActiveMenuSportProgram; ?>><a class="<?php echo $classActiv1; ?>" href="<?php echo FRONT_PATH;?>App/Sport/MyPrograms/sportMyProgramsList.php"><?php echo $menu_sport_myProgram; ?></a></li><?php } ?>
              <?php if ($hasSportProgramTemplate) { ?><li <?php echo $navActiveMenuSportProgramTemplate; ?>><a class="<?php echo $classActiv2; ?>" href="<?php echo FRONT_PATH;?>App/Sport/MyTemplatePrograms/sportMyTemplateProgramsList.php"><?php echo $menu_sport_myTemplateProgram; ?></a></li><?php } ?>
              <?php if ($hasSportCircuit)         { ?><li <?php echo $navActiveMenuSportCircuit; ?>><a class="<?php echo $classActiv3; ?>" href="<?php echo FRONT_PATH;?>App/Sport/MyCircuits/sportMyCircuitsList.php"><?php echo $menu_sport_myCircuit; ?></a></li><?php } ?>
              <?php if ($hasSportExercise)        { ?><li <?php echo $navActiveMenuSportExercise; ?>><a class="<?php echo $classActiv4; ?>" href="<?php echo FRONT_PATH;?>App/Sport/MyExercises/sportMyExercisesList.php"><?php echo $menu_sport_myExercise; ?></a></li><?php } ?>
            
              <!-- ///////////////////////////////////////////////////////////////////////////////////////////////////// -->
              <!-- //                                        MENU SPORT ADMIN                                         // -->
              <!-- ///////////////////////////////////////////////////////////////////////////////////////////////////// -->            
              <?php if ($hasSportAdmin) { ?>
                <li class="dropdown <?php echo $show2; ?>">
                  <a href="javascript:;" class="dropdown-toggle" data-option="<?php echo $dataOption; ?>">
                    <span class="micon dw dw-harvest"></span>
                    <span class="mtext"><?php echo $menu_administration; ?></span>
                  </a>
                  <ul class="submenu child <?php echo $show2; ?>" style='display: <?php echo $style2; ?>'>
                    <?php if ($hasSportBodyMember)    { ?><li <?php echo $navActiveMenuSportBodyMember; ?>><a class="<?php echo $classActiv5; ?>" href="<?php echo FRONT_PATH;?>App/CodeTables/SportBodyMember/codeTableBodyMemberList.php"><?php echo $menu_sport_admin_body_member_list; ?></a></li><?php } ?>
                    <?php if ($hasSportBodyMuscle)    { ?><li <?php echo $navActiveMenuSportBodyMuscle; ?>><a class="<?php echo $classActiv6; ?>" href="<?php echo FRONT_PATH;?>App/CodeTables/SportBodyMuscle/codeTableBodyMuscleList.php"><?php echo $menu_sport_admin_body_muscle_list; ?></a></li><?php } ?>
                    <?php if ($hasSportExerciseType)  { ?><li <?php echo $navActiveMenuSportExerciseType; ?>><a class="<?php echo $classActiv7; ?>" href="<?php echo FRONT_PATH;?>App/CodeTables/SportExerciseType/codeTableExerciseTypeList.php"><?php echo $menu_sport_admin_exercice_Type_list; ?></a></li><?php } ?>
                    <?php if ($hasSportCircuitType)   { ?><li <?php echo $navActiveMenuSportCircuitType; ?>><a class="<?php echo $classActiv8; ?>" href="<?php echo FRONT_PATH;?>App/CodeTables/SportCircuitType/codeTableCircuitTypeList.php"><?php echo $menu_sport_admin_circuit_Type_list; ?></a></li><?php } ?>
                  </ul>
                </li>
              <?php } ?>
            </ul>
          </li>
        <?php } ?>

        <?php
          $hasNutrition                   = true;
          $hasNutrition_MyDiet            = true;
          $hasNutrition_MyTemplatesDiets  = true;
          $hasNutrition_Recipe            = true;
          $hasNutrition_Recipe            = true;
        ?>
        
        <?php if ($hasNutrition) { ?>
          <?php
            $dataOption       = 'off';
            $classActiv1 = $classActiv2 = $classActiv3 = $classActiv4 = $classActiv5 = $classActiv6 = $classActiv7 = $classActiv8 = $classActiv9 = "";
            $show1  = $show2  = '';
            $style1 = 'none';
            $style2 = 'none';
            $navActiveMenunutritionMyCurrentsDiets = $navActiveMenuNutritionMyTemplatesDiets = $navActiveMenuNutritionMyRecipes = "";
            if (stripos($_SERVER['PHP_SELF'], 'nutritionMyCurrentsDietsList.php')     !== false) { $classActiv1="active"; $dataOption="on"; $show1="show"; $style1='block'; $navActiveMenunutritionMyCurrentsDiets = 'class="active"'; }
            if (stripos($_SERVER['PHP_SELF'], 'nutritionMyCurrentsDietsMealList.php') !== false) { $classActiv1="active"; $dataOption="on"; $show1="show"; $style1='block'; $navActiveMenunutritionMyCurrentsDiets = 'class="active"'; }
            if (stripos($_SERVER['PHP_SELF'], 'NutritionMyTemplatesDietsList.php')    !== false) { $classActiv2="active"; $dataOption="on"; $show1="show"; $style1='block'; $navActiveMenuNutritionMyTemplatesDiet = 'class="active"'; }
            if (stripos($_SERVER['PHP_SELF'], 'NutritionMyRecipesList.php')           !== false) { $classActiv3="active"; $dataOption="on"; $show1="show"; $style1='block'; $navActiveMenuNutritionMyRecipes        = 'class="active"'; }
            if (stripos($_SERVER['PHP_SELF'], 'nutritionMyRecipeFoodList.php')        !== false) { $classActiv3="active"; $dataOption="on"; $show1="show"; $style1='block'; $navActiveMenuNutritionMyRecipes        = 'class="active"'; }

            $navActiveMenuFoodFood = $navActiveMenuFoodBrand = $navActiveMenuFoodEcoScore = $navActiveMenuFoodNovaScore = $navActiveMenuFoodNutriScore = $navActiveMenuFoodLabel = '';
            if (stripos($_SERVER['PHP_SELF'], 'foodFoodList.php')       !== false) { $classActiv4="active"; $dataOption="on"; $show1="show"; $show2="show"; $style1='block'; $style2='block'; $navActiveMenuFoodFood       = 'class="active"'; }
            if (stripos($_SERVER['PHP_SELF'], 'foodBrandList.php')      !== false) { $classActiv5="active"; $dataOption="on"; $show1="show"; $show2="show"; $style1='block'; $style2='block'; $navActiveMenuFoodBrand      = 'class="active"'; }
            if (stripos($_SERVER['PHP_SELF'], 'foodEcoScoreList.php')   !== false) { $classActiv6="active"; $dataOption="on"; $show1="show"; $show2="show"; $style1='block'; $style2='block'; $navActiveMenuFoodEcoScore   = 'class="active"'; }
            if (stripos($_SERVER['PHP_SELF'], 'foodNovaScoreList.php')  !== false) { $classActiv7="active"; $dataOption="on"; $show1="show"; $show2="show"; $style1='block'; $style2='block'; $navActiveMenuFoodNovaScore  = 'class="active"'; }
            if (stripos($_SERVER['PHP_SELF'], 'foodNutriScoreList.php') !== false) { $classActiv8="active"; $dataOption="on"; $show1="show"; $show2="show"; $style1='block'; $style2='block'; $navActiveMenuFoodNutriScore = 'class="active"'; }
            if (stripos($_SERVER['PHP_SELF'], 'foodLabelList.php')      !== false) { $classActiv9="active"; $dataOption="on"; $show1="show"; $show2="show"; $style1='block'; $style2='block'; $navActiveMenuFoodLabel      = 'class="active"'; }
          ?>
          
          <li class="dropdown <?php echo $show1; ?>">
            <a href="javascript:;" class="dropdown-toggle" data-option="<?php echo $dataOption; ?>">
              <span class="micon dw dw-food-cart"></span>
              <span class="mtext"><?php echo $menu_nutrition; ?></span>
            </a>
            <ul class="submenu <?php echo $show1; ?>" style='display: <?php echo $style1; ?>'>
              <?php if ($hasNutrition_MyDiet)           { ?><li <?php echo $navActiveMenunutritionMyCurrentsDiets; ?>><a class="<?php echo $classActiv1; ?>" href="<?php echo FRONT_PATH;?>App/Nutrition/MyCurrentsDiets/nutritionMyCurrentsDietsList.php"><?php echo $menu_nutrition_myDiet; ?></a></li><?php } ?>
              <?php if ($hasNutrition_MyTemplatesDiets) { ?><li <?php echo $navActiveMenuNutritionMyTemplatesDiets; ?>><a class="<?php echo $classActiv2; ?>" href="<?php echo FRONT_PATH;?>App/Nutrition/MyTemplatesDiets/nutritionMyTemplatesDietsList.php"><?php echo $menu_nutrition_myTempletDiet; ?></a></li><?php } ?>
              <?php if ($hasNutrition_Recipe)           { ?><li <?php echo $navActiveMenuNutritionMyRecipes; ?>><a class="<?php echo $classActiv3; ?>" href="<?php echo FRONT_PATH;?>App/Nutrition/MyRecipes/nutritionMyRecipesList.php"><?php echo $menu_nutrition_myRecipe; ?></a></li><?php } ?>
              
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
                    <span class="mtext"><?php echo $menu_administration; ?></span>
                  </a>
                  <ul class="submenu child <?php echo $show2; ?>" style='display: <?php echo $style2; ?>'>
                    <?php if ($hasRight_FOOD_FOOD)        { ?><li <?php echo $navActiveMenuFoodFood; ?>><a class="<?php echo $classActiv4; ?>" href="<?php echo FRONT_PATH;?>App/Food/Food/foodFoodList.php"><?php echo $menu_food_food_list; ?></a></li><?php } ?>
                    <?php if ($hasRight_FOOD_BRAND)       { ?><li <?php echo $navActiveMenuFoodBrand; ?>><a class="<?php echo $classActiv5; ?>" href="<?php echo FRONT_PATH;?>App/Food/Brand/foodBrandList.php"><?php echo $menu_food_brand_list; ?></a></li><?php } ?>
                    <?php if ($hasRight_FOOD_ECO_SCORE)   { ?><li <?php echo $navActiveMenuFoodEcoScore; ?>><a class="<?php echo $classActiv6; ?>" href="<?php echo FRONT_PATH;?>App/Food/EcoScore/foodEcoScoreList.php"><?php echo $menu_food_ecoScore_list; ?></a></li><?php } ?>
                    <?php if ($hasRight_FOOD_NOVA_SCORE)  { ?><li <?php echo $navActiveMenuFoodNovaScore; ?>><a class="<?php echo $classActiv7; ?>" href="<?php echo FRONT_PATH;?>App/Food/NovaScore/foodNovaScoreList.php"><?php echo $menu_food_novaScore_list; ?></a></li><?php } ?>
                    <?php if ($hasRight_FOOD_NUTRI_SCORE) { ?><li <?php echo $navActiveMenuFoodNutriScore; ?>><a class="<?php echo $classActiv8; ?>" href="<?php echo FRONT_PATH;?>App/Food/NutriScore/foodNutriScoreList.php"><?php echo $menu_food_nutriScore_list; ?></a></li><?php } ?>
                    <?php if ($hasRight_FOOD_LABEL)       { ?><li <?php echo $navActiveMenuFoodLabel; ?>><a class="<?php echo $classActiv9; ?>" href="<?php echo FRONT_PATH;?>App/Food/Label/foodLabelList.php"><?php echo $menu_food_label_list; ?></a></li><?php } ?>
                  </ul>
                </li>
              <?php } ?>
            </ul>
          </li>
        <?php } ?>
        
        <?php
          $hasBilan   = true;
          $dataOption = 'off';
          $classActiv = "";
          $show       = '';
          $style      = 'none';
        ?>
        <?php if ($hasBilan) { ?>
          <li class="dropdown <?php echo $show; ?>">
            <a href="javascript:;" class="dropdown-toggle" data-option="<?php echo $dataOption; ?>">
              <span class="micon dw dw-board"></span>
              <span class="mtext"><?php echo $menu_bilan; ?></span>
              &nbsp;<img src="<?php echo FRONT_PATH;?>vendors/images/coming-soon3.png" alt="" width="25">
            </a>
            <ul class="submenu <?php echo $show; ?>" style='display: <?php echo $style; ?>'>
              <li><a href="#">1</a></li>
              <li><a href="#">2</a></li>
              <li><a href="#">3</a></li>
              <li><a href="#">4</a></li>
            </ul>
          </li>
        <?php } ?>

        <?php
          $hasStudent = true;
          $dataOption = 'off';
          $classActiv = "";
          $show       = '';
          $style      = 'none';
        ?>
        <?php if ($hasStudent) { ?>
          <li class="dropdown <?php echo $show; ?>">
            <a href="javascript:;" class="dropdown-toggle" data-option="<?php echo $dataOption; ?>">
              <span class="micon dw dw-user-2"></span>
              <span class="mtext"><?php echo $menu_student; ?></span>
              &nbsp;<img src="<?php echo FRONT_PATH;?>vendors/images/coming-soon3.png" alt="" width="25">
            </a>
            <ul class="submenu <?php echo $show; ?>" style='display: <?php echo $style; ?>'>
              <?php
                $hasSTUDENT_LIST_COATCH = DistriXStyAppInterface::hasAnyRight('WEBVYSION_SPORT', 'STUDENT', 'LIST_COATCH');
                $hasSTUDENT_LIST_COATCH = true;  

                $dataOption = 'off';
                $show       =  '';
                $style      = 'none';
                $navActiveMenuStudentListCoach = "";
                if (stripos($_SERVER['PHP_SELF'], 'studentListCoach.php')        !== false) { $classActiv="active"; $dataOption="on"; $show="show"; $style='block'; $navActiveMenuStudentListCoach = 'class="active"'; }
              ?> 
              <?php if ($hasSTUDENT_LIST_COATCH) { ?><li <?php echo $navActiveMenuStudentListCoach; ?>><a class="<?php echo $classActiv; ?>" href="../Student/studentListCoach.php"><?php echo $menu_student_list_coach; ?></a></li><?php } ?>
            
              <li><a href="#">2</a></li>
              <li><a href="#">3</a></li>
              <li><a href="#">4</a></li>
            </ul>
          </li>
        <?php } ?>

        <?php
          $hasResource  = true;
          $dataOption   = 'off';
          $classActiv   = "";
          $show         = '';
          $style        = 'none';
        ?>
        <?php if ($hasResource) { ?>
          <li class="dropdown <?php echo $show; ?>">
            <a href="javascript:;" class="dropdown-toggle" data-option="<?php echo $dataOption; ?>">
              <span class="micon dw dw-human-resources"></span>
              <span class="mtext"><?php echo $menu_ressource; ?></span>
              &nbsp;<img src="<?php echo FRONT_PATH;?>vendors/images/coming-soon3.png" alt="" width="25">
            </a>
            <ul class="submenu <?php echo $show; ?>" style='display: <?php echo $style; ?>'>
              <li><a href="#">1</a></li>
              <li><a href="#">2</a></li>
              <li><a href="#">3</a></li>
              <li><a href="#">4</a></li>
            </ul>
          </li>
        <?php } ?>

        <?php
          $hasRight_PACKAGE_LIST    = DistriXStyAppInterface::hasAnyRight('WEBVYSION_SPORT', 'SECURITY', 'PACKAGE_LIST');
          $hasRight_PACKAGE_INVOICE = DistriXStyAppInterface::hasAnyRight('WEBVYSION_SPORT', 'SECURITY', 'PACKAGE_INVOICE');
          if ($hasRight_PACKAGE_LIST || $hasRight_PACKAGE_INVOICE) {
            $hasPackage = true;
          }

          $hasPackage               = true;
          $hasRight_PACKAGE_LIST    = true;
          $hasRight_PACKAGE_INVOICE = true;

          $dataOption = 'off';
          $classActiv1 = $classActiv2 = "";
          $show       = '';
          $style      = 'none';
        ?>
        <?php if ($hasPackage) { ?>
          <li class="dropdown <?php echo $show; ?>">
            <a href="javascript:;" class="dropdown-toggle" data-option="<?php echo $dataOption; ?>">
              <span class="micon dw dw-money-1"></span>
              <span class="mtext"><?php echo $menu_package; ?></span>
              &nbsp;<img src="<?php echo FRONT_PATH;?>vendors/images/coming-soon3.png" alt="" width="25">
            </a>
            <ul class="submenu <?php echo $show; ?>" style='display: <?php echo $style; ?>'>
              <?php
                $navActiveMenuPackageList = $navActiveMenuPackageInvoice = "";
                if (stripos($_SERVER['PHP_SELF'], 'packageList.php') !== false)     { $classActiv1="active"; $dataOption="on"; $show1="show"; $style1='block'; $navActiveMenuPackageList     = 'class="active"'; }
                if (stripos($_SERVER['PHP_SELF'], 'packageInvoice.php') !== false)  { $classActiv2="active"; $dataOption="on"; $show1="show"; $style1='block'; $navActiveMenuPackageInvoice  = 'class="active"'; }
              ?>
              <?php if ($hasRight_PACKAGE_LIST)     {?><li <?php echo $navActiveMenuPackageList; ?>><a class="<?php echo $classActiv1; ?>" href="<?php echo FRONT_PATH;?>App/Package/Package/packageList.php"><?php echo $menu_right_package_list; ?></a></li><?php } ?>
              <?php if ($hasRight_PACKAGE_INVOICE)  {?><li <?php echo $navActiveMenuPackageInvoice; ?>><a class="<?php echo $classActiv2; ?>" href="<?php echo FRONT_PATH;?>App/Package/Invoice/packageInvoice.php"><?php echo $menu_right_invoice_detail; ?></a></li><?php } ?>
              <li><a href="#">2</a></li>
              <li><a href="#">3</a></li>
            </ul>
          </li>
        <?php } ?>

        <?php
          $hasParam   = true;
          $dataOption = 'off';
          $classActiv = "";
          $show       = '';
          $style      = 'none';
        ?>
        <?php if ($hasParam) { ?>
          <li class="dropdown <?php echo $show; ?>">
            <a href="javascript:;" class="dropdown-toggle" data-option="<?php echo $dataOption; ?>">
              <span class="micon dw dw-settings"></span>
              <span class="mtext"><?php echo $menu_parametre; ?></span>
              &nbsp;<img src="<?php echo FRONT_PATH;?>vendors/images/coming-soon3.png" alt="" width="25">
            </a>
            <ul class="submenu <?php echo $show; ?>" style='display: <?php echo $style; ?>'>
              <li><a href="#">1</a></li>
              <li><a href="#">2</a></li>
              <li><a href="#">3</a></li>
              <li><a href="#">4</a></li>
            </ul>
          </li>
        <?php } ?>

        <?php
          $hasRight_MESSAGE_LIST  = DistriXStyAppInterface::hasAnyRight('WEBVYSION_SPORT', 'SECURITY', 'MESSAGE_LIST');
          $hasRight_MESSAGE_CHAT  = DistriXStyAppInterface::hasAnyRight('WEBVYSION_SPORT', 'SECURITY', 'MESSAGE_CHAT');
          if ($hasRight_PACKAGE_LIST || $hasRight_PACKAGE_INVOICE) {
            $hasMessaging = true;
          }

          $hasMessaging           = true;
          $hasRight_MESSAGE_LIST  = true;
          $hasRight_MESSAGE_CHAT  = true;
          
          $dataOption   = 'off';
          $classActiv1 = $classActiv2 = "";
          $show         = '';
          $style        = 'none';
        ?>
        <?php if ($hasMessaging) { ?>
          <li class="dropdown <?php echo $show; ?>">
            <a href="javascript:;" class="dropdown-toggle" data-option="<?php echo $dataOption; ?>">
              <span class="micon dw dw-message"></span>
              <span class="mtext"><?php echo $menu_messagerie; ?></span>
              &nbsp;<img src="<?php echo FRONT_PATH;?>vendors/images/coming-soon3.png" alt="" width="25">
            </a>
            <ul class="submenu <?php echo $show; ?>" style='display: <?php echo $style; ?>'>
            <?php
                $navActiveMenuMessageList = $navActiveMenuMessageChat = "";
                if (stripos($_SERVER['PHP_SELF'], 'messageList.php') !== false)  { $classActiv1="active"; $dataOption="on"; $show1="show"; $style1='block'; $navActiveMenuMessageList  = 'class="active"'; }
                if (stripos($_SERVER['PHP_SELF'], 'messageChat.php') !== false)  { $classActiv2="active"; $dataOption="on"; $show1="show"; $style1='block'; $navActiveMenuMessageChat  = 'class="active"'; }
              ?>
              <?php if ($hasRight_MESSAGE_LIST) {?><li <?php echo $navActiveMenuMessageList; ?>><a class="<?php echo $classActiv1; ?>" href="<?php echo FRONT_PATH;?>App/Message/Message/messageList.php"><?php echo $menu_right_message_list; ?></a></li><?php } ?>
              <?php if ($hasRight_MESSAGE_CHAT) {?><li <?php echo $navActiveMenuMessageChat; ?>><a class="<?php echo $classActiv2; ?>" href="<?php echo FRONT_PATH;?>App/Message/Chat/chat.php"><?php echo $menu_right_message_chat; ?></a></li><?php } ?>
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
          $hasRight_CODE_TABLE_WEIGHT_TYPE        = DistriXStyAppInterface::hasAnyRight('WEBVYSION_SPORT', 'SECURITY', 'CODE_TABLE_WEIGHT_TYPE');
          $hasRight_CODE_TABLE_CATEGORY_FOOD_TYPE = DistriXStyAppInterface::hasAnyRight('WEBVYSION_SPORT', 'SECURITY', 'CODE_TABLE_FOOD_CATEGORY');
          $hasRight_CODE_TABLE_NUTRITIONAL        = DistriXStyAppInterface::hasAnyRight('WEBVYSION_SPORT', 'SECURITY', 'CODE_TABLE_NUTRITIONAL');
          $hasRight_CODE_TABLE_FOOD_TYPE          = DistriXStyAppInterface::hasAnyRight('WEBVYSION_SPORT', 'SECURITY', 'CODE_TABLE_FOOD_TYPE');
          $hasRight_CODE_TABLE_MEAL_TYPE          = DistriXStyAppInterface::hasAnyRight('WEBVYSION_SPORT', 'SECURITY', 'CODE_TABLE_MEAL_TYPE');
          $hasRight_CODE_TABLE_LANGUES            = DistriXStyAppInterface::hasAnyRight('WEBVYSION_SPORT', 'SECURITY', 'CODE_TABLE_LANGUES');
          $hasRight_CODE_TABLE_TICKET_STATUS      = DistriXStyAppInterface::hasAnyRight('WEBVYSION_SPORT', 'SECURITY', 'CODE_TABLE_TICKET_STATUS');
          $hasRight_CODE_TABLE_TICKET_TYPE        = DistriXStyAppInterface::hasAnyRight('WEBVYSION_SPORT', 'SECURITY', 'CODE_TABLE_TICKET_TYPE');
          $hasCodeTable                           = false;
          if(
            $hasRight_CODE_TABLE_WEIGHT_TYPE        || 
            $hasRight_CODE_TABLE_CATEGORY_FOOD_TYPE || 
            $hasRight_CODE_TABLE_NUTRITIONAL        || 
            $hasRight_CODE_TABLE_FOOD_TYPE          || 
            $hasRight_CODE_TABLE_LANGUES            ||
              $hasRight_CODE_TABLE_TICKET_TYPE      ||
              $hasRight_CODE_TABLE_TICKET_STATUS) {
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
          $hasRight_CODE_TABLE_CATEGORY_FOOD_TYPE  = true;
          $hasRight_CODE_TABLE_NUTRITIONAL    = true;
          $hasRight_CODE_TABLE_LANGUES        = true;
          $hasRight_CODE_TABLE_FOOD_TYPE      = true;
          $hasRight_CODE_TABLE_MEAL_TYPE      = true;
          $hasRight_CODE_TABLE_TICKET_TYPE    = true;
          $hasRight_CODE_TABLE_TICKET_STATUS  = true;
          
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
            <?php
              $dataOption = 'off';
              $classActiv1 = $classActiv2 = $classActiv3 = $classActiv4 = $classActiv5 = $classActiv6 = $classActiv7 = $classActiv8 = "";
              $show1      =  $show2 = '';
              $style1     = $style2 = 'none';
            ?>
            <li class="dropdown <?php echo $show; ?>">
              <a href="javascript:;" class="dropdown-toggle" data-option="<?php echo $dataOption; ?>">
                <span class="micon dw dw-user-13"></span>
                <span class="mtext"><?php echo $menu_admin_users; ?></span>
              </a>
              <?php
                $navActiveMenuAdminUser = $navActiveMenuAdminEnterprise = $navActiveMenuAdminUserType = "";
                if (stripos($_SERVER['PHP_SELF'], 'adminUserList.php')        !== false) { $classActiv1="active"; $dataOption="on"; $show1="show"; $style1='block'; $navActiveMenuAdminUser        = 'class="active"'; }
                if (stripos($_SERVER['PHP_SELF'], 'adminEnterpriseList.php')  !== false) { $classActiv2="active"; $dataOption="on"; $show1="show"; $style1='block'; $navActiveMenuAdminEnterprise  = 'class="active"'; }
                if (stripos($_SERVER['PHP_SELF'], 'adminUserTypeList.php')    !== false) { $classActiv3="active"; $dataOption="on"; $show1="show"; $style1='block'; $navActiveMenuAdminUserType    = 'class="active"'; }
              ?> 
              <ul class="submenu <?php echo $show1; ?>" style='display: <?php echo $style1; ?>'>
                <?php if ($hasRight_ADMIN_USER)       { ?><li <?php echo $navActiveMenuAdminUser; ?>><a class="<?php echo $classActiv1; ?>" href="<?php echo FRONT_PATH;?>App/Security/User/adminUserList.php"><?php echo $menu_admin_users_list; ?></a></li><?php } ?>
                <?php if ($hasRight_ADMIN_ENTERPRISE) { ?><li <?php echo $navActiveMenuAdminEnterprise; ?>><a class="<?php echo $classActiv2; ?>" href="<?php echo FRONT_PATH;?>App/Security/Enterprise/adminEnterpriseList.php"><?php echo $menu_admin_enterprises_list; ?></a></li><?php } ?>
                <?php if ($hasRight_ADMIN_USER_TYPE)  { ?><li <?php echo $navActiveMenuAdminUserType; ?>><a class="<?php echo $classActiv3; ?>" href="<?php echo FRONT_PATH;?>App/Security/UserType/adminUserTypeList.php"><?php echo $menu_admin_usersTypes_list; ?></a></li><?php } ?>
                                
                <?php if ($hasSecurity) { ?>
                  <?php
                    $navActiveMenuAdminApplication = $navActiveMenuAdminModule = $navActiveMenuAdminFunctionality = $navActiveMenuAdminRole = $navActiveMenuAdminRight = "";
                    if (stripos($_SERVER['PHP_SELF'], 'adminApplication.php')     !== false) { $classActiv4="active"; $dataOption="on"; $show2="show"; $style2='block'; $navActiveMenuAdminApplication    = 'class="active"'; }
                    if (stripos($_SERVER['PHP_SELF'], 'adminModule.php')          !== false) { $classActiv5="active"; $dataOption="on"; $show2="show"; $style2='block'; $navActiveMenuAdminModule         = 'class="active"'; }
                    if (stripos($_SERVER['PHP_SELF'], 'adminFunctionality.php')   !== false) { $classActiv6="active"; $dataOption="on"; $show2="show"; $style2='block'; $navActiveMenuAdminFunctionality  = 'class="active"'; }
                    if (stripos($_SERVER['PHP_SELF'], 'adminRoleList.php')        !== false) { $classActiv7="active"; $dataOption="on"; $show2="show"; $style2='block'; $navActiveMenuAdminRole           = 'class="active"'; }
                    if (stripos($_SERVER['PHP_SELF'], 'adminRightList.php')       !== false) { $classActiv8="active"; $dataOption="on"; $show2="show"; $style2='block'; $navActiveMenuAdminRight          = 'class="active"'; }
                  ?>
                  <li class="dropdown <?php echo $show2; ?>">
                    <a href="javascript:;" class="dropdown-toggle" data-option="<?php echo $dataOption; ?>">
                      <span class="micon fa fa-cogs"></span>
                      <span class="mtext "><?php echo $menu_right; ?></span>
                    </a>
                    <ul class="submenu child <?php echo $show2; ?>" style='display: <?php echo $style2; ?>'>
                      <?php if ($hasRight_SECURITY_APPLICATION) {    ?><li <?php echo $navActiveMenuAdminApplication; ?>><a class="<?php echo $classActiv4; ?>" href="<?php echo FRONT_PATH;?>App/Security/Application/adminApplicationList.php"><?php echo $menu_right_applications_list; ?></a></li><?php } ?>
                      <?php if ($hasRight_SECURITY_MODULE) {         ?><li <?php echo $navActiveMenuAdminModule; ?>><a class="<?php echo $classActiv5; ?>" href="<?php echo FRONT_PATH;?>App/Security/Moduke/adminModuleList.php"><?php echo $menu_right_modules_list; ?></a></li><?php } ?>
                      <?php if ($hasRight_SECURITY_FUNCTIONALITY) {  ?><li <?php echo $navActiveMenuAdminFunctionality; ?>><a class="<?php echo $classActiv6; ?>" href="<?php echo FRONT_PATH;?>App/Security/Functionality/adminFunctionalityList.php"><?php echo $menu_right_functionalities_list; ?></a></li><?php } ?>
                      <?php if ($hasRight_SECURITY_ROLE) {           ?><li <?php echo $navActiveMenuAdminRole; ?>><a class="<?php echo $classActiv7; ?>" href="<?php echo FRONT_PATH;?>App/Security/Role/adminRoleList.php"><?php echo $menu_right_roles_list; ?></a></li><?php } ?>
                      <?php if ($hasRight_SECURITY_RIGHT) {          ?><li <?php echo $navActiveMenuAdminRight; ?>><a class="<?php echo $classActiv8; ?>" href="<?php echo FRONT_PATH;?>App/Security/Right/adminRightList.php"><?php echo $menu_right_rights_list; ?></a></li><?php } ?>
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
            $dataOption = 'off';
            $classActiv1 = $classActiv2 = $classActiv3 = $classActiv4 = $classActiv5 = $classActiv6 = $classActiv7 = $classActiv8 = "";
            $show       =  '';
            $style      = 'none';
            $navActiveMenuCodeTableWeightType   = $navActiveMenuCodeTableCategoryFoodType = $navActiveMenuCodeTableFoodType = $navActiveMenuCodeTableMealType = "";
            $navActiveMenuCodeTableNutritionale = $navActiveMenuCodeTableLanguage         = $navActiveMenuCodeTableTicketStatus = $navActiveMenuCodeTableTicketType ="";
            $navActiveMenuCodeTableFoodType     = "";
            if (stripos($_SERVER['PHP_SELF'], 'codeTableWeightTypeList.php')        !== false) { $classActiv1="active"; $dataOption="on"; $show="show"; $style='block'; $navActiveMenuCodeTableWeightType        = 'class="active"'; }
            if (stripos($_SERVER['PHP_SELF'], 'codeTableCategoryFoodTypeList.php')  !== false) { $classActiv2="active"; $dataOption="on"; $show="show"; $style='block'; $navActiveMenuCodeTableCategoryFoodType  = 'class="active"'; }
            if (stripos($_SERVER['PHP_SELF'], 'codeTableFoodTypeList.php')          !== false) { $classActiv3="active"; $dataOption="on"; $show="show"; $style='block'; $navActiveMenuCodeTableFoodType          = 'class="active"'; }
            if (stripos($_SERVER['PHP_SELF'], 'codeTableMealTypeList.php')          !== false) { $classActiv4="active"; $dataOption="on"; $show="show"; $style='block'; $navActiveMenuCodeTableMealType          = 'class="active"'; }
            if (stripos($_SERVER['PHP_SELF'], 'codeTableNutritionalList.php')       !== false) { $classActiv5="active"; $dataOption="on"; $show="show"; $style='block'; $navActiveMenuCodeTableNutritionale      = 'class="active"'; }
            if (stripos($_SERVER['PHP_SELF'], 'codeTableLanguageList.php')          !== false) { $classActiv6="active"; $dataOption="on"; $show="show"; $style='block'; $navActiveMenuCodeTableLanguage          = 'class="active"'; }
            if (stripos($_SERVER['PHP_SELF'], 'codeTableTicketStatusList.php')      !== false) { $classActiv7="active"; $dataOption="on"; $show="show"; $style='block'; $navActiveMenuCodeTableTicketStatus      = 'class="active"'; }
            if (stripos($_SERVER['PHP_SELF'], 'codeTableTicketTypeList.php')        !== false) { $classActiv8="active"; $dataOption="on"; $show="show"; $style='block'; $navActiveMenuCodeTableTicketType      = 'class="active"'; }
          ?>
          <li>
            <a href="javascript:;" class="dropdown-toggle" data-option="<?php echo $dataOption; ?>">
              <span class="micon dw dw-library"></span>
              <span class="mtext"><?php echo $menu_codeTables; ?></span>
            </a>
            <ul class="submenu <?php echo $show; ?>" style='display: <?php echo $style; ?>'>
              <?php if ($hasRight_CODE_TABLE_WEIGHT_TYPE)       { ?><li <?php echo $navActiveMenuCodeTableWeightType; ?>><a class="<?php echo $classActiv1; ?>" href="<?php echo FRONT_PATH;?>App/CodeTables/WeightType/codeTableWeightTypeList.php"><?php echo $menu_codeTables_weightType_list; ?></a></li><?php } ?>
              <?php if ($hasRight_CODE_TABLE_CATEGORY_FOOD_TYPE){ ?><li <?php echo $navActiveMenuCodeTableCategoryFoodType; ?>><a class="<?php echo $classActiv2; ?>" href="<?php echo FRONT_PATH;?>App/CodeTables/CategoryFoodType/codeTableCategoryFoodTypeList.php"><?php echo $menu_codeTables_food_category_list; ?></a></li><?php } ?>
              <?php if ($hasRight_CODE_TABLE_FOOD_TYPE)         { ?><li <?php echo $navActiveMenuCodeTableFoodType; ?>><a class="<?php echo $classActiv3; ?>" href="<?php echo FRONT_PATH;?>App/CodeTables/FoodType/codeTableFoodTypeList.php"><?php echo $menu_codeTables_food_type_list; ?></a></li><?php } ?>
              <?php if ($hasRight_CODE_TABLE_MEAL_TYPE)         { ?><li <?php echo $navActiveMenuCodeTableMealType; ?>><a class="<?php echo $classActiv4; ?>" href="<?php echo FRONT_PATH;?>App/CodeTables/MealType/codeTableMealTypeList.php"><?php echo $menu_codeTables_meal_type_list; ?></a></li><?php } ?>
              <?php if ($hasRight_CODE_TABLE_NUTRITIONAL)       { ?><li <?php echo $navActiveMenuCodeTableNutritionale; ?>><a class="<?php echo $classActiv5; ?>" href="<?php echo FRONT_PATH;?>App/CodeTables/Nutritional/codeTableNutritionalList.php"><?php echo $menu_codeTables_nutritional_list; ?></a></li><?php } ?>
              <?php if ($hasRight_CODE_TABLE_LANGUES)           { ?><li <?php echo $navActiveMenuCodeTableLanguage; ?>><a class="<?php echo $classActiv6; ?>" href="<?php echo FRONT_PATH;?>App/CodeTables/Language/codeTableLanguageList.php"><?php echo $menu_codeTables_language_list; ?></a></li><?php } ?>
              <?php if ($hasRight_CODE_TABLE_TICKET_STATUS)     { ?><li <?php echo $navActiveMenuCodeTableTicketStatus; ?>><a class="<?php echo $classActiv7; ?>" href="<?php echo FRONT_PATH;?>App/CodeTables/TicketStatus/codeTableTicketStatusList.php"><?php echo $menu_codeTables_ticket_status_list; ?></a></li><?php } ?>
              <?php if ($hasRight_CODE_TABLE_TICKET_TYPE)       { ?><li <?php echo $navActiveMenuCodeTableTicketType; ?>><a class="<?php echo $classActiv8; ?>" href="<?php echo FRONT_PATH;?>App/CodeTables/TicketType/codeTableTicketTypeList.php"><?php echo $menu_codeTables_ticket_type_list; ?></a></li><?php } ?>
            </ul>
          </li>
        <?php } ?>
      </ul>
    </div>
  </div>
</div>