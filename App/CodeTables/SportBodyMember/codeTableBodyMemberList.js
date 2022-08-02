var bodyMemberSelectedData = null;
var bodyMemberTableLanguagesData = "";
$(function () {
  var bodyMemberTableData = "";
  var bodyMemberTable = $("#BodyMemberTable").DataTable({
    columnDefs: [
      { orderable: false, targets: 2 },
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
      bodyMemberTableData = data.ListBodyMembers;
      bodyMemberTableLanguagesData = data.ListLanguages;
      ListBodyMember(0);
    },
    error: function (data) {
      console.log(data);
    },
  });

  $(".btn-warning").on("click", function () {
    $(".btn-success").removeClass("disabled");
    $(".dw-success").removeClass("dw-checked").addClass("dw-ban");

    $(".btn-warning").addClass("disabled");
    $(".dw-warning").addClass("dw-checked").removeClass("dw-ban");

    bodyMemberTable.clear().draw();
    ListBodyMember(1);
  });

  $(".btn-success").on("click", function () {
    $(".btn-success").addClass("disabled");
    $(".dw-success").removeClass("dw-ban").addClass("dw-checked");

    $(".btn-warning").removeClass("disabled");
    $(".dw-warning").addClass("dw-ban").removeClass("dw-checked");

    bodyMemberTable.clear().draw();
    ListBodyMember(0);
  });

  $(".AddNewBodyMember").on("click", function () {
    $(".add_title").removeClass("d-none");
    $("#btnAddBodyMember").removeClass("d-none");
    $(".update_title").addClass("d-none");
    $("#btnUpdateBodyMember").addClass("d-none");

    bodyMemberSelectedData = null;
    $(".AddBodyMemberFormCode").val("");
    $(".AddBodyMemberFormName").val("");
    $("#bodyMemberLanguages").html("");

    const languages = bodyMemberTableLanguagesData;
    $.map(languages, function (language, languageKey) {
      var html = "";
      html += '  <div class="row">';
      html += '    <div class="col-md-4 col-sm-12">';
      html += '      <div class="form-group">';
      html +=
        '        <input class="form-control" type="text" disabled value="' +
        language.name +
        '">';
      html += "      </div>";
      html += "    </div>";
      html += '    <div class="col-md-8 col-sm-12">';
      html += '      <div class="form-group">';
      html +=
        '        <input class="form-control AddBodyMemberFormLanguageName" type="text" name="bodyMemberLanguageName' +
        language.id +
        '" placeholder="' +
        nameTranslatedTxt +
        '">';
      html += "      </div>";
      html += "    </div>";
      html += "  </div>";

      $("#bodyMemberLanguages").append(html);
    });
  });

  $("#btnAddBodyMember, #btnUpdateBodyMember").on("click", function () {
    var code = $("#AddBodyMemberFormCode").val();
    var name = $("#AddBodyMemberFormName").val();
    if (code == "" || name == "") {
      if (code == "") {
        $(".AddBodyMemberFormCode").addClass("form-control-danger");
        $(".danger-code").removeClass("d-none");

        setTimeout(() => {
          $(".AddBodyMemberFormCode").removeClass("form-control-danger");
          $(".danger-code").addClass("d-none");
        }, 3000);
      }
      if (name == "") {
        $(".AddBodyMemberFormName").addClass("form-control-danger");
        $(".danger-name").removeClass("d-none");

        setTimeout(() => {
          $(".AddBodyMemberFormName").removeClass("form-control-danger");
          $(".danger-name").addClass("d-none");
        }, 3000);
      }
    } else {
      var bodyMemberNames = [];
      $('input[name^="bodyMemberLanguageName"]').each(function () {
        var idNameLanguage = this.name.substr("bodyMemberLanguageName".length);
        var idName = 0;
        var idBodyMember = 0;
        var timestampName = 0;
        var elemStateName = 0;
        if (bodyMemberSelectedData != null) {
          $.map(bodyMemberSelectedData.names, function (nameData, nameDataKey) {
            if (nameData.idLanguage == idNameLanguage) {
              idName = nameData.id;
              idBodyMember = nameData.idBodyMember;
              timestampName = nameData.timestamp;
              elemStateName = nameData.elemState;
            }
          });
        }
        let bodyMemberName = {
          id: idName,
          idBodyMember: idBodyMember,
          idLanguage: idNameLanguage,
          elemState: elemStateName,
          timestamp: timestampName,
          name: this.value,
        };
        bodyMemberNames.push(bodyMemberName);
      });
      var id = 0;
      var timestamp = 0;
      var elemState = 0;
      if (bodyMemberSelectedData != null) {
        id = bodyMemberSelectedData.id;
        timestamp = bodyMemberSelectedData.timestamp;
        elemState = bodyMemberSelectedData.elemState;
      }
      $.ajax({
        url: "Controllers/save.php",
        type: "POST",
        dataType: "JSON",
        data: { id, code, name, elemState, timestamp, names: bodyMemberNames },
        success: function (data) {
          if (data.ConfirmSave) {
            $("#sa-success-distrix").trigger("click");
            setTimeout(function () {
              window.location.href = "./codeTableBodyMemberList.php";
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
      $(".btnAddBodyMember").attr("data-dismiss", "modal");
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
            window.location.href = "./codeTableBodyMemberList.php";
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
            window.location.href = "./codeTableBodyMemberList.php";
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
  });

  function ListBodyMember(elemState) {
    const dataTableData = bodyMemberTableData;
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

        var infoLanguage =
          '<i class="icon-copy dw dw-checked mr-2" data-color="#FF9900" style="color: rgb(255,153,0);"></i>';
        if (val.nbLanguages == val.nbLanguagesTotal) {
          var infoLanguage =
            '<i class="icon-copy dw dw-checked mr-2" data-color="#006600" style="color: rgb(0,102,0);"></i>';
        }

        let line =
          "<tr>" +
          '  <td style="padding:1rem;">&nbsp;&nbsp;' +
          val.code +
          "</td>" +
          "  <td>" +
          val.name +
          "</td>" +
          "  <td>" +
          infoLanguage +
          " " +
          val.nbLanguages +
          "/" +
          val.nbLanguagesTotal;
        if (val.nbLanguages < val.nbLanguagesTotal) {
          const languages = bodyMemberTableLanguagesData;
          $.map(languages, function (language, languageKey) {
            var notFound = true;
            if (val.names.length > 0) {
              $.map(val.names, function (name, nameKey) {
                if (name.idLanguage == language.id) {
                  notFound = false;
                }
              });
            }
            if (notFound) {
              line +=
                '<br/><span style="color:red;"><i class="dw dw-warning-1"></i> ' +
                language.name +
                "</span>";
            }
          });
        }
        line +=
          "</td>" +
          ' <td width="10%">' +
          '   <div class="dropdown">' +
          '     <a class="btn btn-link font-24 p-0 line-height-1 no-arrow dropdown-toggle" href="#" role="button" data-toggle="dropdown">' +
          '       <i class="dw dw-more"></i>' +
          "     </a>" +
          '     <div class="dropdown-menu dropdown-menu-right dropdown-menu-icon-list">' +
          '       <a class="dropdown-item"                      data-toggle="modal" data-target="#modalAddBodyMember" onclick="ViewBodyMember(\'' +
          val.id +
          '\');"                   href="#"><i class="dw dw-edit2"></i> Voir</a>' +
          '       <a class="dropdown-item ' +
          actionBtnDelete +
          '"  data-toggle="modal" data-target="#modalDel"         onclick="DelBodyMember(\'' +
          val.id +
          "', '" +
          val.name +
          '\');"  href="#"><i class="dw dw-delete-3"></i> Supprimer</a>' +
          '       <a class="dropdown-item ' +
          actionBtnRestore +
          '" data-toggle="modal" data-target="#modalRest"        onclick="RestBodyMember(\'' +
          val.id +
          "', '" +
          val.name +
          '\');" href="#"><i class="dw dw-share-2"></i> Restaurer</a>' +
          "     </div>" +
          "   </div>" +
          " </td>" +
          "</tr>";
        bodyMemberTable.row.add($(line)).draw();
      }
    });
  }
});

function ViewBodyMember(id) {
  $.ajax({
    url: "Controllers/view.php",
    type: "POST",
    dataType: "JSON",
    data: { id: id },
    success: function (data) {
      bodyMemberSelectedData = data.ViewBodyMember;

      $(".add_title").addClass("d-none");
      $("#btnAddBodyMember").addClass("d-none");
      $(".update_title").removeClass("d-none");
      $("#btnUpdateBodyMember").removeClass("d-none");

      $(".AddBodyMemberFormCode").val(data.ViewBodyMember.code);
      $(".AddBodyMemberFormName").val(data.ViewBodyMember.name);
      $("#bodyMemberLanguages").html("");

      const languages = bodyMemberTableLanguagesData;
      $.map(languages, function (language, languageKey) {
        var html = "";
        html += '  <div class="row">';
        html += '    <div class="col-md-4 col-sm-12">';
        html += '      <div class="form-group">';
        html +=
          '        <input class="form-control" type="text" disabled value="' +
          language.name +
          '">';
        html += "      </div>";
        html += "    </div>";
        html += '    <div class="col-md-8 col-sm-12">';
        html += '      <div class="form-group">';
        var updateName = "";
        var className = "form-control-danger";
        $.map(data.ViewBodyMember.names, function (nameData, nameDataKey) {
          if (nameData.idLanguage == language.id) {
            updateName = nameData.name;
            className = "form-control-success";
          }
        });
        html +=
          '        <input class="form-control ' +
          className +
          ' AddBodyMemberFormLanguageName" type="text" name="bodyMemberLanguageName' +
          language.id +
          '" value="' +
          updateName +
          '" placeholder="' +
          nameTranslatedTxt +
          '">';
        html += "      </div>";
        html += "    </div>";
        html += "  </div>";

        $("#bodyMemberLanguages").append(html);
      });
    },
    error: function (data) {
      console.log(data);
    },
  });
}

function DelBodyMember(id, name) {
  $(".DelFormId").val(id);
  $(".DelTxt").html(" <b>" + name + "</b> ?");
}

function RestBodyMember(id, name) {
  $(".RestFormId").val(id);
  $(".RestTxt").html(" <b>" + name + "</b> ?");
}
