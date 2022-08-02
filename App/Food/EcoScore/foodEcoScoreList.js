datatable = $("#datatable").DataTable({
  language: {
    url: "//cdn.datatables.net/plug-ins/9dcbecd42ad/i18n/French.json",
  },
});
$.ajax({
  url: "Controllers/list.php",
  type: "POST",
  dataType: "JSON",
  success: function (data) {
    localStorage.setItem("dataTable", JSON.stringify(data.ListEcoScores));
    $(".btn-success").trigger("click");
  },
  error: function (data) {
    console.log(data);
  },
});

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

  datatable.clear().draw();
  ListEcoScore(1);
});

$(".btn-success").on("click", function () {
  $(".btn-success").addClass("disabled");
  $(".dw-success").removeClass("dw-ban").addClass("dw-checked");

  $(".btn-warning").removeClass("disabled");
  $(".dw-warning").addClass("dw-ban").removeClass("dw-checked");

  datatable.clear().draw();
  ListEcoScore(0);
});

$(".AddNewEcoScore").on("click", function () {
  $(".add_title").removeClass("d-none");
  $(".update_title").addClass("d-none");

  $(".AddEcoScoreFormIdEcoScore").val(0);
  $(".AddEcoScoreFormCode").val("");
  $(".AddEcoScoreFormName").val("");
  $(".AddEcoScoreFormColor").val("");
  $(".avatar-EcoScore").attr("src", "");
  $(".AddEcoScoreFormTimestamp").val(0);
  $(".AddEcoScoreFormStatut").val(0);
});

$(".btnAddEcoScore").on("click", function () {
  var name = $(".AddEcoScoreFormName").val();
  var color = $(".AddEcoScoreFormColor").val();
  if (name != "" || color != "") {
    var data = $("#FormAddEcoScore").serializeArray(); // convert form to array
    data.push({ name: "letter", value: name });
    data.push({ name: "color", value: color });

    $.ajax({
      url: "Controllers/save.php",
      type: "POST",
      dataType: "JSON",
      data: $.param(data),
      success: function (data) {
        $("#sa-success-distrix").trigger("click");
        setTimeout(function () {
          window.location.href = "./foodEcoScoreList.php";
        }, 800);
      },
      error: function (data) {
        $("#sa-error-distrix").trigger("click");
      },
    });
    $(".btnAddEcoScore").attr("data-dismiss", "modal");
  } else {
    if (name == "") {
      $(".AddEcoScoreFormName").addClass("form-control-danger");
      $(".danger-name").removeClass("d-none");

      setTimeout(() => {
        $(".AddEcoScoreFormName").removeClass("form-control-danger");
        $(".danger-name").addClass("d-none");
      }, 3000);
    }
    if (color == "") {
      $(".AddEcoScoreFormColor").addClass("form-control-danger");
      $(".danger-color").removeClass("d-none");

      setTimeout(() => {
        $(".AddEcoScoreFormColor").removeClass("form-control-danger");
        $(".danger-color").addClass("d-none");
      }, 3000);
    }
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
          window.location.href = "./foodEcoScoreList.php";
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
          window.location.href = "./foodEcoScoreList.php";
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

function ListEcoScore(elemState) {
  var dataTableData = JSON.parse(localStorage.getItem("dataTable"));
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
        ' <td style="padding:1rem;"><img style="max-height:60px; max-width:60px;" src="' +
        val.linkToPicture +
        '"/></td>' +
        ' <td><div class="progress" style="height:40px;"><div class="progress-bar" role="progressbar" style="width: 100%; background-color:' +
        val.color +
        ';" aria-valuenow="100" aria-valuemin="0" aria-valuemax="100"></div></div></td>' +
        " <td>&nbsp;" +
        val.letter +
        "</td>" +
        " <td>" +
        '   <div class="dropdown">' +
        '     <a class="btn btn-link font-24 p-0 line-height-1 no-arrow dropdown-toggle" href="#" role="button" data-toggle="dropdown">' +
        '       <i class="dw dw-more"></i>' +
        "     </a>" +
        '     <div class="dropdown-menu dropdown-menu-right dropdown-menu-icon-list">' +
        '       <a class="dropdown-item"                      data-toggle="modal" data-target="#modalAddEcoScore" onclick="ViewEcoScore(\'' +
        val.id +
        '\');"                   href="#"><i class="dw dw-edit2"></i> Voir</a>' +
        '       <a class="dropdown-item ' +
        actionBtnDelete +
        '"  data-toggle="modal" data-target="#modalDel"         onclick="DelEcoScore(\'' +
        val.id +
        "', '" +
        val.letter +
        '\');"  href="#"><i class="dw dw-delete-3"></i> Supprimer</a>' +
        '       <a class="dropdown-item ' +
        actionBtnRestore +
        '" data-toggle="modal" data-target="#modalRest"        onclick="RestEcoScore(\'' +
        val.id +
        "', '" +
        val.letter +
        '\');" href="#"><i class="dw dw-share-2"></i> Restaurer</a>' +
        "     </div>" +
        "   </div>" +
        " </td>" +
        "</tr>";
      datatable.row.add($(line)).draw();
    }
  });
}

function ViewEcoScore(id) {
  $.ajax({
    url: "Controllers/view.php",
    type: "POST",
    dataType: "JSON",
    data: { id: id },
    success: function (data) {
      $(".add_title").addClass("d-none");
      $(".update_title").removeClass("d-none");

      $(".dropzoneImage").removeClass("d-none");
      $(".dropzoneNoImage").addClass("d-none");

      $(".AddEcoScoreFormIdEcoScore").val(id);
      $(".AddEcoScoreFormCode").val(data.ViewEcoScore.code);
      $(".AddEcoScoreFormName").val(data.ViewEcoScore.letter);
      $(".AddEcoScoreFormColor").val(data.ViewEcoScore.color);
      $(".asColorPicker-trigger span").attr(
        "style",
        "background-color:" + data.ViewEcoScore.color
      );

      $(".avatar-EcoScore").attr("src", data.ViewEcoScore.linktopicture);
      $(".AddEcoScoreFormTimestamp").val(data.ViewEcoScore.timestamp);
      $(".AddEcoScoreFormStatut").val(data.ViewEcoScore.elemState);
    },
    error: function (data) {
      console.log(data);
    },
  });
}

function DelEcoScore(id, name) {
  $(".DelFormId").val(id);
  $(".DelTxt").html(" <b>" + name + "</b> ?");
}

function RestEcoScore(id, name) {
  $(".RestFormId").val(id);
  $(".RestTxt").html(" <b>" + name + "</b> ?");
}
