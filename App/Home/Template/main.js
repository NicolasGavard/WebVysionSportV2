$(".InfoProfilFullName").text(
  localStorage.getItem("firstName") + " " + localStorage.getItem("name")
);
$(".InfoProfilPicture").attr("src", localStorage.getItem("linkToPicture"));
$(".InfoProfilEmail").text(localStorage.getItem("email"));

$("#btnLogout").click(function () {
  logOut();
});

// Action all 10 min
setIdleTimeout(600000, function () {
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

function encodeImgtoBase64(element) {
  var file = element.files[0];
  var reader = new FileReader();
  reader.onloadend = function () {
    $("#linkToPictureBase64").val(reader.result);
    $("#convertImg").text(reader.result);
    $("#base64Img").attr("src", reader.result);
  };
  reader.readAsDataURL(file);
}

function logOut() {
  $.ajax({
    url: "../../Security/Login/Controllers/logout.php",
    type: "POST",
    dataType: "JSON",
    success: function (data) {
      if (data.isConnected) {
        localStorage.removeItem("idUser");
        localStorage.removeItem("name");
        localStorage.removeItem("firstName");
        localStorage.removeItem("linkToPicture");
        localStorage.removeItem("idLanguage");
        localStorage.removeItem("email");
        localStorage.removeItem("emailBackup");
        localStorage.removeItem("language");

        localStorage.removeItem("dataTable");

        window.location.replace("../../../index.html");
      }
    },
    error: function (data) {
      console.log(data);
    },
  });
}

function ConvertIntToDateFr(dateInt) {
  var year = dateInt.substr(0, 4);
  var month = dateInt.substr(4, 2);
  var day = dateInt.substr(6, 2);
  return day + "/" + month + "/" + year;
}

function ConvertIntToDateEn(dateInt) {
  var year = dateInt.substr(0, 4);
  var month = dateInt.substr(4, 2);
  var day = dateInt.substr(6, 2);
  return year + "-" + month + "-" + day;
}

function ValidateEmail(email) {
  var mailformat = /^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/;
  if (email.match(mailformat)) {
    return true;
  } else {
    return false;
  }
}

function viewDetail(element, dataTableName, elementName) {
  const searchText = 'id="' + elementName;
  const col = dataTableName.cell(element).data();
  if (col.includes(searchText)) return;

  const closingText = '"';
  const dataRow = datatable.row(element).data();
  let id = 0;
  for (const [, value] of Object.entries(dataRow)) {
    const pos = value.indexOf(searchText);
    if (pos != -1) {
      const startPlace = pos + searchText.length;
      const pos2 = value.indexOf(closingText, startPlace);
      if (pos2 != -1) {
        id = value.substr(startPlace, pos2 - startPlace);
      }
    }
  }
  $("#" + elementName + id).click();
}
