  $("#btnLogin").click(function() {
    $.ajax({ 
      url: 'Controllers/Login/login.php',
      data: {'login': $("#login").val(), 'password': $("#password").val()},
      type: 'post',
      dataType: "json",
      success: function(output) {       
        if (output.isConnected) {
          if (output.infoProfil.initPass == '0'){
            // Add All Info in local Storage
            localStorage.setItem("idUser",output.infoProfil.id);
            localStorage.setItem("name",output.infoProfil.name);
            localStorage.setItem("firstName",output.infoProfil.firstName);
            localStorage.setItem("linkToPicture",output.infoProfil.linkToPicture);
            localStorage.setItem("email",output.infoProfil.email);
            localStorage.setItem("emailBackup",output.infoProfil.emailBackup);
            localStorage.setItem("idLanguage",output.infoProfil.idLanguage);
            
            $.ajax({
              url : 'Controllers/Security/Language/view.php',
              type : 'POST',
              dataType : 'JSON',
              data: {'id': output.infoProfil.idLanguage},
              success : function(data) {
                setLanguage = data.ViewLanguage.code;
                var versionUpdate = (new Date()).getTime(); 
                $.ajax({ 
                  url:  'jsLanguage/' +  setLanguage + '.json?v='+versionUpdate,
                  dataType: 'json', 
                  async: false, 
                  success: function (lang) {
                    localStorage.setItem("language", JSON.stringify(lang));
                    window.location.replace("main.php");
                  }
                });
              }
            });
          } else {
            localStorage.setItem("idUser",output.infoProfil.id);
            window.location.replace("loginInitPassword.php");
          }
        } else {
          errorData = "Erreur de connexion, nom d'utilisateur ou mot de passe invalide";
          $('#sa-error-distrix').trigger('click');
          $('#swal2-content').html('<ul class="list-group list-group-flush">'+errorData+'</ul>');
        }
      },
      error: function (e) {
        console.log(e);
      }
    });
  });