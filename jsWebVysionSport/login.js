  if (localStorage.getItem("saveDataLogin") !== null && localStorage.getItem("saveDataPassword") !== null) {
    $("#login").val(localStorage.getItem("saveDataLogin"));
    $("#password").val(localStorage.getItem("saveDataPassword"));
  }

  $("#btnLogin").click(function() {
    $.ajax({ 
      url: 'Controllers/Login/login.php',
      data: {'login': $("#login").val(), 'password': $("#password").val()},
      type: 'post',
      dataType: "json",
      success: function(output) {       
        if (output.isConnected) {
          
          // Save Login in Storage if the box is checked
          if( $('#saveDataLogin').is(':checked') ){
            localStorage.setItem("saveDataLogin", $("#login").val());
            localStorage.setItem("saveDataPassword", $("#password").val());
          }
          
          if (output.infoProfil.initPass == 0){
            // Add All Info in local Storage
            localStorage.setItem("idUser", output.infoProfil.id);
            localStorage.setItem("name", output.infoProfil.name);
            localStorage.setItem("firstName", output.infoProfil.firstName);
            localStorage.setItem("linkToPicture", output.infoProfil.linkToPicture);
            localStorage.setItem("email", output.infoProfil.email);
            localStorage.setItem("emailBackup", output.infoProfil.emailBackup);
            localStorage.setItem("idLanguage", output.infoProfil.idLanguage);

            window.location.replace("Front/main.php");
          } else {
            localStorage.setItem("idUser",output.infoProfil.id);
            window.location.replace("loginInitPassword.php");
          }
        } else {
          errorData = "Erreur de connexion, nom d'utilisateur ou mot de passe invalide";
          if (output.error.errorData.text === 'ERROR_PASSWORD'){errorData = "Erreur de connexion, mot de passe invalide";}
          if (output.error.errorData.text === 'ERROR_LOGIN')   {errorData = "Erreur de connexion, nom d'utilisateur invalide";}
          $('#sa-error-distrix').trigger('click');
          $('#swal2-content').html('<ul class="list-group list-group-flush">'+errorData+'</ul>');
        }
      },
      error: function (e) {
        console.log(e);
      }
    });
  });