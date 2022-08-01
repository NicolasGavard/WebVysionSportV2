<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>

<head>
  <meta http-equiv="content-type" content="text/html; charset=utf-8" />
  <?php
  session_start();
  $title = "Generator Page";
  include('_const.php');
  include('_metatagsGenerator.php');

  $table = $tablename = $index = $msgerreur = "";
  $field = [];
  $fieldInd = 0;
  $primaryKey = $uniqueIndexes = $indexes = [];

  if (isset($_SESSION["sess_ErreurTable"])) {
    $msgerreur = "Erreur avec le générateur.";
    if (isset($_SESSION["sess_Table"])) {
      $table = $_SESSION["sess_Table"];
      unset($_SESSION["sess_Table"]);
    }
    unset($_SESSION["sess_ErreurTable"]);
    if (isset($_SESSION["sess_ErreurNoField"])) {
      unset($_SESSION["sess_ErreurNoField"]);
      $msgerreur .= "<br/>&nbsp;- Aucun champ n'a été trouvé.";
    }
    if (isset($_SESSION["sess_ErreurNomTable"])) {
      unset($_SESSION["sess_ErreurNomTable"]);
      $msgerreur .= "<br/>&nbsp;- Le nom de la table n'a pas été trouvé.";
    }
    if (isset($_SESSION["sess_ErreurNoTable"])) {
      unset($_SESSION["sess_ErreurNoTable"]);
      $msgerreur .= "<br/>&nbsp;- Merci de fournir le code SQL de la création de la table.";
    }
  }

  if (isset($_SESSION["sess_LstField"])) {
    $field = $_SESSION["sess_LstField"];
    $fieldInd = sizeof($field);

    if (isset($_SESSION["sess_Table"])) {
      $table = $_SESSION["sess_Table"];
      unset($_SESSION["sess_Table"]);
    }
    if (isset($_SESSION["sess_Tablename"])) {
      $tablename = $_SESSION["sess_Tablename"];
    }
  }

  if (isset($_SESSION["sess_ErreurIndex"])) {
    $msgerreur = "Erreur avec le générateur.";
    if (isset($_SESSION["sess_Index"])) {
      $index = $_SESSION["sess_Index"];
      unset($_SESSION["sess_Index"]);
    }
    if (isset($_SESSION["sess_PrimaryKey"])) {
      $primaryKey = $_POST["sess_PrimaryKey"];
      unset($_SESSION["sess_PrimaryKey"]);
    }
    if (isset($_SESSION["sess_UniqueIndexes"])) {
      $uniqueIndexes = $_POST["sess_UniqueIndexes"];
      unset($_SESSION["sess_UniqueIndexes"]);
    }
    if (isset($_SESSION["sess_Indexes"])) {
      $indexes = $_POST["sess_Indexes"];
      unset($_SESSION["sess_Indexes"]);
    }
    unset($_SESSION["sess_ErreurIndex"]);
    if (isset($_SESSION["sess_ErreurNoIndex"])) {
      unset($_SESSION["sess_ErreurNoIndex"]);
      $msgerreur .= "<br/>&nbsp;- Merci de fournir le code SQL de la création des indexes.";
    }
  }
  if (isset($_SESSION["sess_Index"])) {
    $index = $_SESSION["sess_Index"];
    unset($_SESSION["sess_Index"]);
  }
  if (isset($_SESSION["sess_PrimaryKey"])) {
    $primaryKey = $_SESSION["sess_PrimaryKey"];
  }
  if (isset($_SESSION["sess_UniqueIndexes"])) {
    $uniqueIndexes = $_SESSION["sess_UniqueIndexes"];
  }
  if (isset($_SESSION["sess_Indexes"])) {
    $indexes = $_SESSION["sess_Indexes"];
  }
  ?>
</head>

<body>
  <div class="container-fluid">
    <div class="row">
      <div class="col-sm-12 col-md-12 text-center">
        <h1>DISTRIX&nbsp;&nbsp;&nbsp;G E N E R A T O R</h1>
      </div>
    </div>
    <div class="row">
      <div class="col-sm-7 col-md-7"></div>
      <div class="col-sm-5 col-md-5 text-center">
        <h4><?php if (strlen($msgerreur) > 0) echo $msgerreur; ?></h4>
      </div>
    </div>
    <ul class="nav nav-tabs pageplayerTab" role="tablist" id="pageplayerTab">
      <!-- <li class="active genGlyph"><a href="#prepare" data-toggle="tab">
          <center><span class="glyphicon glyphicon-tasks"></span></center>
          <span>Prepare</span>
        </a>
      </li> -->
      <li class="active genGlyph"><a href="#db" data-toggle="tab">
          <center><span class="glyphicon glyphicon-download-alt"></span></center>
          <span>Database</span>
        </a>
      </li>
      <li class="genGlyph"><a href="#data" data-toggle="tab">
          <center><span class="glyphicon glyphicon-indent-left"></span></center>
          <span>Data Object</span>
        </a>
      </li>
      <li class="genGlyph"><a href="#encode" data-toggle="tab">
          <center><span class="glyphicon glyphicon-indent-left"></span></center>
          <span>Encode/Decode</span>
        </a>
      </li>
    </ul>
    <div class="tab-content" id="pageplayerTabContent">
      <!-- <div class="tab-pane fade in active" id="prepare">
        </p>
        <form action="CodeGenerator_db.php" method="post" name="gentable">
          <div class="row">
            <div class="col-sm-1 col-md-1">
              <B>Table</B>
            </div>
            <div class="col-sm-5 col-md-5">
              <textarea class="form-control" NAME="table" COLS=77 ROWS=6><?php echo $table; ?></textarea>
            </div>
            <div class="col-sm-1 col-md-1">
              <B>Index</B>
            </div>
            <div class="col-sm-5 col-md-5">
              <textarea class="form-control" NAME="index" COLS=77 ROWS=6><?php echo $index; ?></textarea>
            </div>
          </div>
          </p>
          <div class="row">
            <div class="col-sm-10 col-sm-offset-1 col-md-10 col-md-offset-1 text-center">
              <input class="form-control" type="Submit" name="Prepare" value="Prepare Generation">
            </div>
          </div>
        </form>
      </div> -->
      <div class="tab-pane fade in active" id="db">
        </p>
        <div class="row">
          <div class="col-sm-1 col-md-1">
            <B>Table</B>
          </div>
          <div class="col-sm-5 col-md-5">
            <textarea class="form-control" id="table" COLS=77 ROWS=6><?php echo $table; ?></textarea>
          </div>
          <div class="col-sm-1 col-md-1">
            <B>Index</B>
          </div>
          <div class="col-sm-5 col-md-5">
            <textarea class="form-control" id="index" COLS=77 ROWS=6><?php echo $index; ?></textarea>
          </div>
        </div>
        </p>
        <div class="row">
          <div class="col-sm-11 col-sm-offset-1 col-md-11 col-md-offset-1 text-center">
            <input class="form-control" type="Submit" id="Prepare" value="Prepare Generation">
          </div>
        </div>
        <br />
        <div id="DbDisplayZone"></div>
      </div>
      <div class="tab-pane fade in" id="data">
        <div id="dataDisplayZone"></div>
      </div>
      <div class="tab-pane fade in" id="encode">
        <div id="encodeDisplayZone"></div>
      </div>
    </div>
  </div>
  <?php include('_metatagsGeneratorjs.php'); ?>
  <script>
    $("#pageplayerTab a").click(function(e) {
      e.preventDefault();
      clicked = $(this).attr("href");
      if (clicked == "#db") getDb();
      if (clicked == "#data") getData();
      if (clicked == "#encode") getEncode();
      $(this).tab("show");
      return false;
    });

    function getDb() {
      $.ajax({
        async: false,
        url: "CodeGeneratorDisplayDb.php",
        type: "POST",
        data: {},
        complete: function(msg) {
          $("#DbDisplayZone").html(msg.responseText)
        }
      });
    };

    function getData() {
      $.ajax({
        async: false,
        url: "CodeGeneratorDataDisplay.php",
        type: "POST",
        data: {},
        complete: function(msg) {
          $("#dataDisplayZone").html(msg.responseText)
        }
      });
    };

    function getEncode() {
      $.ajax({
        async: false,
        url: "CodeGeneratorEncodeDisplay.php",
        type: "POST",
        data: {},
        complete: function(msg) {
          $("#encodeDisplayZone").html(msg.responseText)
        }
      });
    };

    $("#Prepare").click(function(e) {
      e.preventDefault();
      var table = $("#table").val(),
        index = $("#index").val();
      $.ajax({
        async: false,
        url: "CodeGenerator_db.php",
        type: "POST",
        data: {
          Prepare: "true",
          table: table,
          index: index,
        },
        complete: function(msg) {
          getDb();
        }
      });
    });
  </script>
</body>

</html>