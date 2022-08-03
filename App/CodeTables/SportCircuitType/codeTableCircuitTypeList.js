var circuitTypeSelectedData = null;
var circuitTypeTableLanguagesData = "";
$(function () {
  var circuitTypeTableData = "";
  var circuitTypeTable = $("#CircuitTypeTable").DataTable({
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
      circuitTypeTableData = data.ListCircuitTypes;
      circuitTypeTableLanguagesData = data.ListLanguages;
      ListCircuitType(0);
    },
    error: function (data) {
      console.log(data);
    },
  });

  $("#CircuitTypeTable tbody").on("click", "td", function () {
    viewDetail(this, circuitTypeTable, "ViewCircuitType");
  });

  $(".btn-warning").on("click", function () {
    $(".btn-success").removeClass("disabled");
    $(".dw-success").removeClass("dw-checked").addClass("dw-ban");

    $(".btn-warning").addClass("disabled");
    $(".dw-warning").addClass("dw-checked").removeClass("dw-ban");

    circuitTypeTable.clear().draw();
    ListCircuitType(1);
  });

  $(".btn-success").on("click", function () {
    $(".btn-success").addClass("disabled");
    $(".dw-success").removeClass("dw-ban").addClass("dw-checked");

    $(".btn-warning").removeClass("disabled");
    $(".dw-warning").addClass("dw-ban").removeClass("dw-checked");

    circuitTypeTable.clear().draw();
    ListCircuitType(0);
  });

  $(".AddNewCircuitType").on("click", function () {
    $(".add_title").removeClass("d-none");
    $("#btnAddCircuitType").removeClass("d-none");
    $(".update_title").addClass("d-none");
    $("#btnUpdateCircuitType").addClass("d-none");

    circuitTypeSelectedData = null;
    $(".AddCircuitTypeFormCode").val("");
    $(".AddCircuitTypeFormName").val("");
    $("#circuitTypeLanguages").html("");

    const languages = circuitTypeTableLanguagesData;
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
        '        <input class="form-control AddCircuitTypeFormLanguageName" type="text" name="circuitTypeLanguageName' +
        language.id +
        '" placeholder="' +
        nameTranslatedTxt +
        '">';
      html += "      </div>";
      html += "    </div>";
      html += "  </div>";

      $("#circuitTypeLanguages").append(html);
    });
  });

  $("#btnAddCircuitType, #btnUpdateCircuitType").on("click", function () {
    var code = $("#AddCircuitTypeFormCode").val();
    var name = $("#AddCircuitTypeFormName").val();
    if (code == "" || name == "") {
      if (code == "") {
        $(".AddCircuitTypeFormCode").addClass("form-control-danger");
        $(".danger-code-empty").removeClass("d-none");

        setTimeout(() => {
          $(".AddCircuitTypeFormCode").removeClass("form-control-danger");
          $(".danger-code-empty").addClass("d-none");
        }, 3000);
      }
      if (name == "") {
        $(".AddCircuitTypeFormName").addClass("form-control-danger");
        $(".danger-name").removeClass("d-none");

        setTimeout(() => {
          $(".AddCircuitTypeFormName").removeClass("form-control-danger");
          $(".danger-name").addClass("d-none");
        }, 3000);
      }
    } else {
      var circuitTypeNames = [];
      $('input[name^="circuitTypeLanguageName"]').each(function () {
        var idNameLanguage = this.name.substr("circuitTypeLanguageName".length);
        var idName = 0;
        var idCircuitType = 0;
        var timestampName = 0;
        var elemStateName = 0;
        if (circuitTypeSelectedData != null) {
          $.map(
            circuitTypeSelectedData.names,
            function (nameData, nameDataKey) {
              if (nameData.idLanguage == idNameLanguage) {
                idName = nameData.id;
                idCircuitType = nameData.idCircuitType;
                timestampName = nameData.timestamp;
                elemStateName = nameData.elemState;
              }
            }
          );
        }
        if (this.value.length > 0) {
          let circuitTypeName = {
            id: idName,
            idCircuitType: idCircuitType,
            idLanguage: idNameLanguage,
            elemState: elemStateName,
            timestamp: timestampName,
            name: this.value,
          };
          circuitTypeNames.push(circuitTypeName);
        }
      });
      var id = 0;
      var timestamp = 0;
      var elemState = 0;
      if (circuitTypeSelectedData != null) {
        id = circuitTypeSelectedData.id;
        timestamp = circuitTypeSelectedData.timestamp;
        elemState = circuitTypeSelectedData.elemState;
      }
      $.ajax({
        url: "Controllers/save.php",
        type: "POST",
        dataType: "JSON",
        data: { id, code, name, elemState, timestamp, names: circuitTypeNames },
        success: function (data) {
          if (data.ConfirmSave) {
            $("#sa-success-distrix").trigger("click");
            setTimeout(function () {
              window.location.href = "./codeTableCircuitTypeList.php";
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
      $(".btnAddCircuitType").attr("data-dismiss", "modal");
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
            window.location.href = "./codeTableCircuitTypeList.php";
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
            window.location.href = "./codeTableCircuitTypeList.php";
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

  function ListCircuitType(elemState) {
    const dataTableData = circuitTypeTableData;
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
          const languages = circuitTypeTableLanguagesData;
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
          '       <a class="dropdown-item" data-toggle="modal" data-target="#modalAddCircuitType" id="ViewCircuitType' +
          val.id +
          '"  onclick="ViewCircuitType(' +
          val.id +
          ');" href="#"><i class="dw dw-edit2"></i> Voir</a>' +
          '       <a class="dropdown-item ' +
          actionBtnDelete +
          '"  data-toggle="modal" data-target="#modalDel"         onclick="DelCircuitType(\'' +
          val.id +
          "', '" +
          val.name +
          '\');"  href="#"><i class="dw dw-delete-3"></i> Supprimer</a>' +
          '       <a class="dropdown-item ' +
          actionBtnRestore +
          '" data-toggle="modal" data-target="#modalRest"        onclick="RestCircuitType(\'' +
          val.id +
          "', '" +
          val.name +
          '\');" href="#"><i class="dw dw-share-2"></i> Restaurer</a>' +
          "     </div>" +
          "   </div>" +
          " </td>" +
          "</tr>";
        circuitTypeTable.row.add($(line)).draw();
      }
    });
  }
});

function ViewCircuitType(id) {
  $.ajax({
    url: "Controllers/view.php",
    type: "POST",
    dataType: "JSON",
    data: { id: id },
    success: function (data) {
      circuitTypeSelectedData = data.ViewCircuitType;

      $(".add_title").addClass("d-none");
      $("#btnAddCircuitType").addClass("d-none");
      $(".update_title").removeClass("d-none");
      $("#btnUpdateCircuitType").removeClass("d-none");

      $(".AddCircuitTypeFormCode").val(data.ViewCircuitType.code);
      $(".AddCircuitTypeFormName").val(data.ViewCircuitType.name);
      $("#circuitTypeLanguages").html("");

      const languages = circuitTypeTableLanguagesData;
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
        $.map(data.ViewCircuitType.names, function (nameData, nameDataKey) {
          if (nameData.idLanguage == language.id) {
            updateName = nameData.name;
            className = "form-control-success";
          }
        });
        html +=
          '        <input class="form-control ' +
          className +
          ' AddCircuitTypeFormLanguageName" type="text" name="circuitTypeLanguageName' +
          language.id +
          '" value="' +
          updateName +
          '" placeholder="' +
          nameTranslatedTxt +
          '">';
        html += "      </div>";
        html += "    </div>";
        html += "  </div>";

        $("#circuitTypeLanguages").append(html);
      });
    },
    error: function (data) {
      console.log(data);
    },
  });
}

function DelCircuitType(id, name) {
  $(".DelFormId").val(id);
  $(".DelTxt").html(" <b>" + name + "</b> ?");
}

function RestCircuitType(id, name) {
  $(".RestFormId").val(id);
  $(".RestTxt").html(" <b>" + name + "</b> ?");
}
