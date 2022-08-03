var ticketStatusSelectedData = null;
var ticketStatusTableLanguagesData = "";
$(function () {
  var ticketStatusTableData = "";
  var ticketStatusTable = $("#TicketStatusTable").DataTable({
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
      ticketStatusTableData = data.ListTicketStatus;
      ticketStatusTableLanguagesData = data.ListLanguages;
      ListTicketStatus(0);
    },
    error: function (data) {
      console.log(data);
    },
  });

  $("#TicketStatusTable tbody").on("click", "td", function () {
    viewDetail(this, ticketStatusTable, "ViewTicketStatus");
  });

  $(".btn-warning").on("click", function () {
    $(".btn-success").removeClass("disabled");
    $(".dw-success").removeClass("dw-checked").addClass("dw-ban");

    $(".btn-warning").addClass("disabled");
    $(".dw-warning").addClass("dw-checked").removeClass("dw-ban");

    ticketStatusTable.clear().draw();
    ListTicketStatus(1);
  });

  $(".btn-success").on("click", function () {
    $(".btn-success").addClass("disabled");
    $(".dw-success").removeClass("dw-ban").addClass("dw-checked");

    $(".btn-warning").removeClass("disabled");
    $(".dw-warning").addClass("dw-ban").removeClass("dw-checked");

    ticketStatusTable.clear().draw();
    ListTicketStatus(0);
  });

  $(".AddNewTicketStatus").on("click", function () {
    $(".add_title").removeClass("d-none");
    $("#btnAddTicketStatus").removeClass("d-none");
    $(".update_title").addClass("d-none");
    $("#btnUpdateTicketStatus").addClass("d-none");

    ticketStatusSelectedData = null;
    $(".AddTicketStatusFormCode").val("");
    $(".AddTicketStatusFormName").val("");
    $("#ticketStatusLanguages").html("");

    const languages = ticketStatusTableLanguagesData;
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
        '        <input class="form-control AddTicketStatusFormLanguageName" type="text" name="ticketStatusLanguageName' +
        language.id +
        '" placeholder="' +
        nameTranslatedTxt +
        '">';
      html += "      </div>";
      html += "    </div>";
      html += "  </div>";

      $("#ticketStatusLanguages").append(html);
    });
  });

  $("#btnAddTicketStatus, #btnUpdateTicketStatus").on("click", function () {
    var code = $("#AddTicketStatusFormCode").val();
    var name = $("#AddTicketStatusFormName").val();
    if (code == "" || name == "") {
      if (code == "") {
        $(".AddTicketStatusFormCode").addClass("form-control-danger");
        $(".danger-code").removeClass("d-none");

        setTimeout(() => {
          $(".AddTicketStatusFormCode").removeClass("form-control-danger");
          $(".danger-code").addClass("d-none");
        }, 3000);
      }
      if (name == "") {
        $(".AddTicketStatusFormName").addClass("form-control-danger");
        $(".danger-name").removeClass("d-none");

        setTimeout(() => {
          $(".AddTicketStatusFormName").removeClass("form-control-danger");
          $(".danger-name").addClass("d-none");
        }, 3000);
      }
    } else {
      var ticketStatusNames = [];
      $('input[name^="ticketStatusLanguageName"]').each(function () {
        var idNameLanguage = this.name.substr(
          "ticketStatusLanguageName".length
        );
        var idName = 0;
        var idTicketStatus = 0;
        var timestampName = 0;
        var elemStateName = 0;
        if (ticketStatusSelectedData != null) {
          $.map(
            ticketStatusSelectedData.names,
            function (nameData, nameDataKey) {
              if (nameData.idLanguage == idNameLanguage) {
                idName = nameData.id;
                idTicketStatus = nameData.idTicketStatus;
                timestampName = nameData.timestamp;
                elemStateName = nameData.elemState;
              }
            }
          );
        }
        if (this.value.length > 0) {
          let ticketStatusName = {
            id: idName,
            idTicketStatus: idTicketStatus,
            idLanguage: idNameLanguage,
            elemState: elemStateName,
            timestamp: timestampName,
            name: this.value,
          };
          ticketStatusNames.push(ticketStatusName);
        }
      });
      var id = 0;
      var timestamp = 0;
      var elemState = 0;
      if (ticketStatusSelectedData != null) {
        id = ticketStatusSelectedData.id;
        timestamp = ticketStatusSelectedData.timestamp;
        elemState = ticketStatusSelectedData.elemState;
      }
      $.ajax({
        url: "Controllers/save.php",
        type: "POST",
        dataType: "JSON",
        data: {
          id,
          code,
          name,
          elemState,
          timestamp,
          names: ticketStatusNames,
        },
        success: function (data) {
          if (data.ConfirmSave) {
            $("#sa-success-distrix").trigger("click");
            setTimeout(function () {
              window.location.href = "./codeTableTicketStatusList.php";
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
      $(".btnAddTicketStatus").attr("data-dismiss", "modal");
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
            window.location.href = "./codeTableTicketStatusList.php";
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
            window.location.href = "./codeTableTicketStatusList.php";
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

  function ListTicketStatus(elemState) {
    const dataTableData = ticketStatusTableData;
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
          const languages = ticketStatusTableLanguagesData;
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
          '       <a class="dropdown-item"                      data-toggle="modal" data-target="#modalAddTicketStatus" id="ViewTicketStatus' +
          val.id +
          '" onclick="ViewTicketStatus(\'' +
          val.id +
          '\');"                   href="#"><i class="dw dw-edit2"></i> Voir</a>' +
          '       <a class="dropdown-item ' +
          actionBtnDelete +
          '"  data-toggle="modal" data-target="#modalDel"         onclick="DelTicketStatus(\'' +
          val.id +
          "', '" +
          val.name +
          '\');"  href="#"><i class="dw dw-delete-3"></i> Supprimer</a>' +
          '       <a class="dropdown-item ' +
          actionBtnRestore +
          '" data-toggle="modal" data-target="#modalRest"        onclick="RestTicketStatus(\'' +
          val.id +
          "', '" +
          val.name +
          '\');" href="#"><i class="dw dw-share-2"></i> Restaurer</a>' +
          "     </div>" +
          "   </div>" +
          " </td>" +
          "</tr>";
        ticketStatusTable.row.add($(line)).draw();
      }
    });
  }
});

function ViewTicketStatus(id) {
  $.ajax({
    url: "Controllers/view.php",
    type: "POST",
    dataType: "JSON",
    data: { id: id },
    success: function (data) {
      ticketStatusSelectedData = data.ViewTicketStatus;

      $(".add_title").addClass("d-none");
      $("#btnAddTicketStatus").addClass("d-none");
      $(".update_title").removeClass("d-none");
      $("#btnUpdateTicketStatus").removeClass("d-none");

      $(".AddTicketStatusFormCode").val(data.ViewTicketStatus.code);
      $(".AddTicketStatusFormName").val(data.ViewTicketStatus.name);
      $("#ticketStatusLanguages").html("");

      const languages = ticketStatusTableLanguagesData;
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
        $.map(data.ViewTicketStatus.names, function (nameData, nameDataKey) {
          if (nameData.idLanguage == language.id) {
            updateName = nameData.name;
            className = "form-control-success";
          }
        });
        html +=
          '        <input class="form-control ' +
          className +
          ' AddTicketStatusFormLanguageName" type="text" name="ticketStatusLanguageName' +
          language.id +
          '" value="' +
          updateName +
          '" placeholder="' +
          nameTranslatedTxt +
          '">';
        html += "      </div>";
        html += "    </div>";
        html += "  </div>";

        $("#ticketStatusLanguages").append(html);
      });
    },
    error: function (data) {
      console.log(data);
    },
  });
}

function DelTicketStatus(id, name) {
  $(".DelFormId").val(id);
  $(".DelTxt").html(" <b>" + name + "</b> ?");
}

function RestTicketStatus(id, name) {
  $(".RestFormId").val(id);
  $(".RestTxt").html(" <b>" + name + "</b> ?");
}
