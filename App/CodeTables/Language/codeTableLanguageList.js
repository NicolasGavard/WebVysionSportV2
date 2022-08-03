var languageSelectedData = null;
$(function () {
  var languageTableData = "";
  var languageTable = $("#LanguageTable").DataTable({
    columnDefs: [
      { orderable: false, targets: 0 },
      { orderable: false, targets: 3 },
    ],
    language: {
      url: "../../i18/FR/DataTableFrench.json",
    },
  });

  $.ajax({
    url: "Controllers/list.php",
    type: "POST",
    dataType: "JSON",
    success: function (data) {
      languageTableData = data.ListLanguages;
      ListLanguage(0);
    },
    error: function (data) {
      console.log(data);
    },
  });

  $("#LanguageTable tbody").on("click", "td", function () {
    viewDetail(this, languageTable, "ViewLanguage");
  });

  function encodeImgtoBase64(element) {
    var file = element.files[0];
    var reader = new FileReader();
    reader.onloadend = function () {
      $("#linkToPictureBase64").val(reader.result);
      $(".AddLanguagePicture").attr("src", reader.result);
    };
    reader.readAsDataURL(file);
  }

  $(".btnChangeImage").on("click", function () {
    $(".dropzoneImage").addClass("d-none");
    $(".dropzoneNoImage").removeClass("d-none");
  });

  $(".btnChangeImageCancel").on("click", function () {
    $(".dropzoneImage").removeClass("d-none");
    $(".dropzoneNoImage").addClass("d-none");
  });

  $(".btn-warning").on("click", function () {
    $(".btn-success").removeClass("disabled");
    $(".dw-success").removeClass("dw-checked").addClass("dw-ban");

    $(".btn-warning").addClass("disabled");
    $(".dw-warning").addClass("dw-checked").removeClass("dw-ban");

    languageTable.clear().draw();
    ListLanguage(1);
  });

  $(".btn-success").on("click", function () {
    $(".btn-success").addClass("disabled");
    $(".dw-success").removeClass("dw-ban").addClass("dw-checked");

    $(".btn-warning").removeClass("disabled");
    $(".dw-warning").addClass("dw-ban").removeClass("dw-checked");

    languageTable.clear().draw();
    ListLanguage(0);
  });

  $(".AddNewLanguage").on("click", function () {
    $(".add_title").removeClass("d-none");
    $("#btnAddLanguage").removeClass("d-none");
    $(".update_title").addClass("d-none");
    $("#btnUpdateLanguage").addClass("d-none");

    languageSelectedData = null;
    $(".AddLanguageFormCodeShort").val("");
    $(".AddLanguageFormCode").val("");
    $(".AddLanguageFormName").val("");
    $(".AddLanguagePicture").attr("src", "");
  });

  $("#btnAddLanguage, #btnUpdateLanguage").on("click", function () {
    var name = $(".AddLanguageFormName").val();
    var codeShort = $(".AddLanguageFormCodeShort").val();
    if (name == "" || codeShort == "") {
      if (codeShort == "") {
        $(".AddLanguageFormCodeShort").addClass("form-control-danger");
        $(".danger-code-empty").removeClass("d-none");

        setTimeout(() => {
          $(".AddLanguageFormCodeShort").removeClass("form-control-danger");
          $(".danger-code-empty").addClass("d-none");
        }, 3000);
      }
      if (name == "") {
        $(".AddLanguageFormName").addClass("form-control-danger");
        $(".danger-name").removeClass("d-none");

        setTimeout(() => {
          $(".AddLanguageFormName").removeClass("form-control-danger");
          $(".danger-name").addClass("d-none");
        }, 3000);
      }
    } else {
      var id = 0;
      var timestamp = 0;
      var elemState = 0;
      if (languageSelectedData != null) {
        id = languageSelectedData.id;
        timestamp = languageSelectedData.timestamp;
        elemState = languageSelectedData.elemState;
      }
      const picture = $("#linkToPictureBase64").val();

      $.ajax({
        url: "Controllers/save.php",
        type: "POST",
        dataType: "JSON",
        data: { id, codeShort, name, elemState, timestamp, base64Img: picture },
        success: function (data) {
          if (data.ConfirmSave) {
            $("#sa-success-distrix").trigger("click");
            setTimeout(function () {
              // window.location.href = "./codeTableLanguageList.php";
            }, 800);
          } else {
            $("#sa-error-distrix").trigger("click");
            $("#swal2-content").html(
              '<ul class="list-group list-group-flush">' +
                data.Error.text +
                "</ul>"
            );
          }
        },
        error: function (data) {
          $("#sa-error-distrix").trigger("click");
        },
      });
      $(".btnAddLanguage").attr("data-dismiss", "modal");
    }
  });

  $("#btnDel").on("click", function () {
    $.ajax({
      url: "Controllers/delete.php",
      type: "POST",
      dataType: "JSON",
      data: $("#FormDel").serialize(),
      success: function (data) {
        if (data.ConfirmSave) {
          $("#sa-success-distrix").trigger("click");
          setTimeout(function () {
            window.location.href = "./codeTableLanguageList.php";
          }, 800);
        } else {
          $("#sa-error-distrix").trigger("click");
        }
      },
      error: function (data) {
        $("#sa-error-distrix").trigger("click");
      },
    });
  });

  $("#btnRest").on("click", function () {
    $.ajax({
      url: "Controllers/restore.php",
      type: "POST",
      dataType: "JSON",
      data: $("#FormRest").serialize(),
      success: function (data) {
        if (data.ConfirmSave) {
          $("#sa-success-distrix").trigger("click");
          setTimeout(function () {
            window.location.href = "./codeTableLanguageList.php";
          }, 800);
        } else {
          $("#sa-error-distrix").trigger("click");
        }
      },
      error: function (data) {
        $("#sa-error-distrix").trigger("click");
      },
    });
  });

  function ListLanguage(elemState) {
    const dataTableData = languageTableData;
    $.map(dataTableData, function (val, key) {
      if (val.elemState == elemState) {
        if (val.elemState == 1) {
          actionBtnDelete = "d-none";
          actionBtnRestore = "";
        }
        if (val.elemState == 0) {
          actionBtnDelete = "";
          actionBtnRestore = "d-none";
        }
        const line =
          "<tr>" +
          ' <td style="padding:1rem;">&nbsp;&nbsp;<img style="max-height:40px; max-width:40px;" src="' +
          val.linkToPicture +
          '"/></td>' +
          " <td>" +
          val.codeShort +
          "</td>" +
          " <td>" +
          val.name +
          "</td>" +
          " <td>" +
          '   <div class="dropdown">' +
          '     <a class="btn btn-link font-24 p-0 line-height-1 no-arrow dropdown-toggle" href="#" role="button" data-toggle="dropdown">' +
          '       <i class="dw dw-more"></i>' +
          "     </a>" +
          '     <div class="dropdown-menu dropdown-menu-right dropdown-menu-icon-list">' +
          '       <a class="dropdown-item"                      data-toggle="modal" data-target="#modalAddLanguage" id="ViewLanguage' +
          val.id +
          '" onclick="ViewLanguage(\'' +
          val.id +
          '\');"                   href="#"><i class="dw dw-edit2"></i> Voir</a>' +
          '       <a class="dropdown-item ' +
          actionBtnDelete +
          '"  data-toggle="modal" data-target="#modalDel"        onclick="DelLanguage(\'' +
          val.id +
          "', '" +
          val.name +
          '\');"  href="#"><i class="dw dw-delete-3"></i> Supprimer</a>' +
          '       <a class="dropdown-item ' +
          actionBtnRestore +
          '" data-toggle="modal" data-target="#modalRest"       onclick="RestLanguage(\'' +
          val.id +
          "', '" +
          val.name +
          '\');" href="#"><i class="dw dw-share-2"></i> Restaurer</a>' +
          "     </div>" +
          "   </div>" +
          " </td>" +
          "</tr>";
        languageTable.row.add($(line)).draw();
      }
    });
  }
});

function ViewLanguage(id) {
  $.ajax({
    url: "Controllers/view.php",
    type: "POST",
    dataType: "JSON",
    data: { id: id },
    success: function (data) {
      languageSelectedData = data.ViewLanguage;

      $(".add_title").addClass("d-none");
      $("#btnAddLanguage").addClass("d-none");
      $(".update_title").removeClass("d-none");
      $("#btnUpdateLanguage").removeClass("d-none");

      $(".dropzoneImage").removeClass("d-none");
      $(".dropzoneNoImage").addClass("d-none");

      $(".AddLanguageFormCodeShort").val(data.ViewLanguage.codeshort);
      $(".AddLanguageFormCode").val(data.ViewLanguage.code);
      $(".AddLanguageFormName").val(data.ViewLanguage.name);
      $(".AddLanguagePicture").attr("src", data.ViewLanguage.linktopicture);
      $("#linkToPictureBase64").val(data.ViewLanguage.linktopicture);
    },
    error: function (data) {
      console.log(data);
    },
  });
}

function DelLanguage(id, name) {
  $(".DelFormId").val(id);
  $(".DelTxt").html(" <b>" + name + "</b> ?");
}

function RestLanguage(id, name) {
  $(".RestFormId").val(id);
  $(".RestTxt").html(" <b>" + name + "</b> ?");
}
