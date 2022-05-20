var language = JSON.parse(localStorage.getItem('language'));

$(".language_hello").text(language.hello);
$(".language_welcome").text(language.welcome);

$(".language_menu_home").text(language.menu_home);

$(".language_menu_sport").text(language.menu_sport);

$(".language_menu_nutrition").text(language.menu_nutrition);
$(".language_menu_nutrition_myDiet").text(language.menu_nutrition_myDiet);
$(".language_menu_nutrition_myTempletDiet").text(language.menu_nutrition_myTempletDiet);
$(".language_menu_menu_nutrition_myRecipe").text(language.menu_nutrition_myRecipe);
$(".language_menu_nutrition_myIngredient").text(language.menu_nutrition_myIngredient);

$(".language_menu_bilan").text(language.menu_bilan);
$(".language_menu_eleve").text(language.menu_eleve);
$(".language_menu_ressource").text(language.menu_ressource);
$(".language_menu_formule").text(language.menu_formule);
$(".language_menu_parametre").text(language.menu_parametre);
$(".language_menu_messagerie").text(language.menu_messagerie);
$(".language_menu_admin").text(language.menu_admin);

$(".language_menu_admin_users").text(language.menu_admin_users);
$(".menu_admin_users_list").text(language.menu_admin_users_list);
$(".menu_admin_enterprises_list").text(language.menu_admin_enterprises_list);
$(".menu__admin_usersTypes_list").text(language.menu_admin_usersTypes_list);

$(".language_menu_admin_rights").text(language.menu_right);
$(".menu_right_applications_list").text(language.menu_right_applications_list);
$(".menu_right_modules_list").text(language.menu_right_modules_list);
$(".menu_right_functionalities_list").text(language.menu_right_functionalities_list);
$(".menu_right_roles_list").text(language.menu_right_roles_list);
$(".menu_right_rights_list").text(language.menu_right_rights_list);

$(".language_menu_admin_food").text(language.menu_food);
$(".menu_food_food_list").text(language.menu_food_food_list);
$(".menu_food_brand_list").text(language.menu_food_brand_list);
$(".menu_food_ecoScore_list").text(language.menu_food_ecoScore_list);
$(".menu_food_novaScore_list").text(language.menu_food_novaScore_list);
$(".menu_food_nutriScore_list").text(language.menu_food_nutriScore_list);
$(".menu_food_label_list").text(language.menu_food_label_list);

$(".language_menu_admin_codeTables").text(language.menu_codeTables);
$(".menu_codeTables_weightType_list").text(language.menu_codeTables_weightType_list);
$(".menu_codeTables_food_category_list").text(language.menu_codeTables_food_category_list);
$(".menu_codeTables_nutritional_list").text(language.menu_codeTables_nutritional_list);
$(".menu_codeTables_language_list").text(language.menu_codeTables_language_list);

$(".language_profil_my_profil").text(language.menu_profil_myProfil);
$(".language_profil_messages").text(language.menu_profil_messages);
$(".language_profil_activities").text(language.menu_profil_activities);
$(".language_profil_faq").text(language.menu_profil_faq);
$(".language_profil_logout").text(language.menu_profil_logout);

$(".page_all_add").text(language.page_all_add);
$(".page_all_update").text(language.page_all_update);
$(".page_all_delete").text(language.page_all_delete);
$(".page_all_restore").text(language.page_all_restore);
$(".page_all_yes").text(language.page_all_yes);
$(".page_all_no").text(language.page_all_no);

$(".language_home_go").text(language.go);

var errorData_ok                = language.errorData_ok;
var errorData_ok_txt            = language.errorData_ok_txt;
var errorData_ko                = language.errorData_ko;
var errorData_ko_txt            = language.errorData_ko_txt;

var confirm_delete              = language.confirm_delete;
var confirm_restore             = language.confirm_restore;
var errorData_txt_code          = language.errorData_txt_code;
var errorData_txt_name          = language.errorData_txt_name;
var errorData_txt_description   = language.errorData_txt_description;
var errorData_txt_abbreviation  = language.errorData_txt_abbreviation;
var errorData_txt_weight        = language.errorData_txt_weight;

$(".InfoProfilFullName").text(localStorage.getItem("firstName")+' '+localStorage.getItem("name"));
$(".InfoProfilPicture").attr("src", localStorage.getItem("linkToPicture"));
$(".InfoProfilEmail").text(localStorage.getItem("email"));

$("#btnLogout").click(function() {
  logOut();
});

// Action all 10 min
setIdleTimeout(600000, function() {
  logOut();
});

function setIdleTimeout(millis, onIdle, onUnidle) {
  var timeout = 0;
  startTimer();

  function startTimer() {
    timeout = setTimeout(onExpires, millis);
    document.addEventListener("mousemove", onActivity);
    document.addEventListener("keypress", onActivity);
  }
  
  function onExpires() {
    timeout = 0;
    onIdle();
  }

  function onActivity() {
    if (timeout) clearTimeout(timeout);
    else onUnidle();
    //since the mouse is moving, we turn off our event hooks for 1 second
    document.removeEventListener("mousemove", onActivity);
    document.removeEventListener("keypress", onActivity);
    setTimeout(startTimer, 1000);
  }
}

function logOut(){
  $.ajax({
    url : 'Controllers/Login/logout.php',
    type : 'POST',
    dataType : 'JSON',
    success : function(data) {    
      if (data.isConnected) {
        localStorage.clear();
        window.localStorage.clear();

        localStorage.removeItem("idUser");
        localStorage.removeItem("name");
        localStorage.removeItem("firstName");
        localStorage.removeItem("linkToPicture");
        localStorage.removeItem("idLanguage");
        localStorage.removeItem("email");
        localStorage.removeItem("emailBackup");
        localStorage.removeItem("language");

        var base_url  = window.location.origin;
        var pathArray = window.location.pathname.split( '/' );
        window.location.replace(base_url+'/'+pathArray[1]);
      }
    },
    error : function(data) {
      console.log(data);
    }
  });
}

function ConvertIntToDateFr(dateInt){
  var year  = dateInt.substr(0, 4);
  var month = dateInt.substr(4, 2);
  var day   = dateInt.substr(6, 2);
  return day+'/'+month+'/'+year;
}

function ConvertIntToDateEn(dateInt){
  var year  = dateInt.substr(0, 4);
  var month = dateInt.substr(4, 2);
  var day   = dateInt.substr(6, 2);
  return year+'-'+month+'-'+day;
}

function ValidateEmail(email){
  var mailformat = /^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/;
  if(email.match(mailformat)){
    return true;
  } else {
    return false;
  }
}