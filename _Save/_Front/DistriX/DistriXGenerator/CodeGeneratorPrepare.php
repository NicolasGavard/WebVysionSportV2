<?php // Needed to encode in UTF8 ààéàé //
//
// Version : 1-10
//
if (!class_exists('CodeGeneratorPrepare', false)) {
  class CodeGeneratorPrepare
  {

    public function __construct()
    {
    }

    public function prepare($table)
    {
      $tablename = $errorT = $errorR = "";
      $field = array();
      $fieldind = 0;
      $posbegintable = 0;

      if (strlen($table) > 0) {
        $postable = stripos($table, "TABLE");

        if ($postable !== false) {
          $posbegintable = stripos($table, "`", $postable);
          if ($posbegintable !== false) {
            $posstoptable  = stripos($table, "`", $posbegintable + 1);
            if ($posstoptable !== false)
              $tablename = substr($table, $posbegintable + 1, ($posstoptable - $posbegintable) - 1);
          }
        }
        if (strlen($tablename) > 0) {
          $isfield = strpos($table, "`", $posbegintable + strlen($tablename) + 2);
          while ($isfield !== false && $fieldind < 100) {
            $posendfield = strpos($table, "`", $isfield + 1);
            $name = substr($table, $isfield + 1, ($posendfield - $isfield) - 1);
            $field[$fieldind]["nom"] = $name;
            $field[$fieldind]["up"]  = $name;
            if (strlen($name) > 2 && $name[0] == "i" && $name[1] == "d") {
              $field[$fieldind]["up"] = $name[0] . $name[1] . strtoupper($name[2]) . substr($name, 3);
            }
            if ($name == "idusercreate") $field[$fieldind]["up"] = "idUserCreate";
            if ($name == "datecreate") $field[$fieldind]["up"] = "dateCreate";
            if ($name == "timecreate") $field[$fieldind]["up"] = "timeCreate";
            if ($name == "idusermodif") $field[$fieldind]["up"] = "idUserModif";
            if ($name == "datemodif") $field[$fieldind]["up"] = "dateModif";
            if ($name == "datelastmodif") $field[$fieldind]["up"] = "dateLastModif";
            if ($name == "timemodif") $field[$fieldind]["up"] = "timeModif";
            if ($name == "timelastmodif") $field[$fieldind]["up"] = "timeLastModif";
            if ($name == "iduserdelete") $field[$fieldind]["up"] = "idUserDelete";
            if ($name == "datedelete") $field[$fieldind]["up"] = "dateDelete";
            if ($name == "timedelete") $field[$fieldind]["up"] = "timeDelete";

            include("TypesPos.php");
            foreach ($typesPos as $typePos) {
              $found = strpos($name, $typePos);
              $ID_POS = 2; // 2 stands for fields starting with id which have already been processed. 11-11-20
              if ($found !== FALSE && $found >= $ID_POS) $field[$fieldind]["up"][$found] = strtoupper($field[$fieldind]["up"][$found]);
            }
            $endsBy[] = "app";
            $endsBy[] = "ten";
            $endsBy[] = "to";
            foreach ($endsBy as $endBy) {
              $found = strpos($name, $endBy);
              $length = strlen($name);
              if ($found !== FALSE && ($found + strlen($endBy)) == $length) $field[$fieldind]["up"][$found] = strtoupper($field[$fieldind]["up"][$found]);
            }

            $posstoptype = strpos($table, ")", $isfield);
            $posstoptypeSpace = strpos($table, ",", $isfield);
            if ($posstoptypeSpace < $posstoptype || $posstoptype == false) {
              $posstoptype = $posstoptypeSpace;
            }
            $posstopvirguletype = strpos($table, ",", $isfield);

            if ($posstopvirguletype < $posstoptype) $posstoptype = $posstopvirguletype - 1;

            $field[$fieldind]["type"] = substr($table, $posendfield + 2, $posstoptype - $posendfield - 1);

            //echo "**".$field[$fieldind]["nom"]."%%".$field[$fieldind]["type"]."**<br/>";
            $fieldind += 1;

            $isfield = strpos($table, "`", strpos($table, ",", $posstoptype));
          }
          if ($fieldind == 0) {
            $errorT = "sess_ErreurTable";
            $errorR = "sess_ErreurNoField";
          }
        } else {
          $errorT = "sess_ErreurTable";
          $errorR = "sess_ErreurNomTable";
        }
      } else {
        $errorT = "sess_ErreurTable";
        $errorR = "sess_ErreurNoTable";
      }
      return array($tablename, $field, $fieldind, $errorT, $errorR);
    }
    // End of prepare

  }
  // End of Class
}
// class_exists
