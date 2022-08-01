<?php // Needed to encode in UTF8 ààéàé //
if (!class_exists('CodeGeneratorPrepareIndex', false)) {
  class CodeGeneratorPrepareIndex
  {
    const PRIMARY_KEY = "PRIMARY KEY";
    const UNIQUE_KEY = "UNIQUE KEY";
    const KEY = "KEY";
    const FIELD_ENCLOSING = "`";
    const FIELD_SEPARATOR = ",";
    const LINE_ENDING = ")";

    public function prepare($indexText)
    {
      $errorT = $errorR = "";
      $uniqueIndexes = [];
      $uniqueIndexesInd = 0;
      $uniqueIndexesStartPos = [];
      $indexes = [];
      $indexesInd = 0;
      $primaryKey = "";
      $posPrimaryKey = 0;

      if (strlen($indexText) > 0) {
        $posPrimaryKey = stripos($indexText, self::PRIMARY_KEY);
        if ($posPrimaryKey !== false) {
          $posBeginPrimaryKey = stripos($indexText, self::FIELD_ENCLOSING, $posPrimaryKey);
          if ($posBeginPrimaryKey !== false) {
            $posStopPrimaryKey = stripos($indexText, self::FIELD_ENCLOSING, $posBeginPrimaryKey + strlen(self::FIELD_ENCLOSING));
            if ($posStopPrimaryKey !== false)
              $primaryKey = substr($indexText, $posBeginPrimaryKey + strlen(self::FIELD_ENCLOSING), ($posStopPrimaryKey - $posBeginPrimaryKey) - strlen(self::FIELD_ENCLOSING));
          }
        }
        $posUnique = stripos($indexText, self::UNIQUE_KEY);
        while ($posUnique !== false) {
          $posStartUniqueName = stripos($indexText, self::FIELD_ENCLOSING, $posUnique);

          $uniqueIndexesStartPos[] = $posUnique;
          $posUnique = stripos($indexText, self::UNIQUE_KEY, $posUnique + strlen(self::UNIQUE_KEY));

          if ($posStartUniqueName !== false) {
            $posStopUniqueName = stripos($indexText, self::FIELD_ENCLOSING, $posStartUniqueName + strlen(self::FIELD_ENCLOSING));
            if ($posStopUniqueName !== false) {
              $uniqueName = substr($indexText, $posStartUniqueName + strlen(self::FIELD_ENCLOSING), ($posStopUniqueName - $posStartUniqueName) - strlen(self::FIELD_ENCLOSING));
              $uniqueIndexes[$uniqueIndexesInd]["name"] = $uniqueName;
              $posStartUniqueField = stripos($indexText, self::FIELD_ENCLOSING, $posStopUniqueName + strlen(self::FIELD_ENCLOSING));

              $noField = 0;
              $noLineEnding = stripos($indexText, self::LINE_ENDING, $posStopUniqueName);
              while ($posStartUniqueField !== false && $posStartUniqueField < $noLineEnding) {
                $posStopUniqueField = stripos($indexText, self::FIELD_ENCLOSING, $posStartUniqueField + strlen(self::FIELD_ENCLOSING));
                if ($posStopUniqueField !== false) {
                  $fieldName = substr($indexText, $posStartUniqueField + strlen(self::FIELD_ENCLOSING), ($posStopUniqueField - $posStartUniqueField) - strlen(self::FIELD_ENCLOSING));
                  $uniqueIndexes[$uniqueIndexesInd]["field" . $noField++] = $fieldName;
                  $posStartUniqueField = stripos($indexText, self::FIELD_ENCLOSING, $posStopUniqueField + strlen(self::FIELD_ENCLOSING));
                }
              }
              $uniqueIndexesInd++;
            }
          }
        }
        $posKey = stripos($indexText, self::KEY);
        while ($posKey !== false) {
          $justKey = true;
          if ($posKey > $posPrimaryKey && $posKey < ($posPrimaryKey + strlen(self::PRIMARY_KEY))) {
            $justKey = false;
          }
          if ($justKey) {
            foreach ($uniqueIndexesStartPos as $uniqueIndexStartPos) {
              if ($posKey > $uniqueIndexStartPos && $posKey < ($uniqueIndexStartPos + strlen(self::UNIQUE_KEY))) {
                $justKey = false;
                break;
              }
            }
          }
          if ($justKey) {
            $posStartKeyName = stripos($indexText, self::FIELD_ENCLOSING, $posKey);

            $posKey = stripos($indexText, self::KEY, $posKey + strlen(self::KEY));

            if ($posStartKeyName !== false) {
              $posStopKeyName = stripos($indexText, self::FIELD_ENCLOSING, $posStartKeyName + strlen(self::FIELD_ENCLOSING));
              if ($posStopKeyName !== false) {
                $keyName = substr($indexText, $posStartKeyName + strlen(self::FIELD_ENCLOSING), ($posStopKeyName - $posStartKeyName) - strlen(self::FIELD_ENCLOSING));
                $indexes[$indexesInd]["name"] = $keyName;
                $posStartKeyField = stripos($indexText, self::FIELD_ENCLOSING, $posStopKeyName + strlen(self::FIELD_ENCLOSING));

                $noField = 0;
                $noLineEnding = stripos($indexText, self::LINE_ENDING, $posStopKeyName);
                echo "--noLineEnding : $noLineEnding<br/>";
                while ($posStartKeyField !== false && $posStartKeyField < $noLineEnding) {
                  $posStopKeyField = stripos($indexText, self::FIELD_ENCLOSING, $posStartKeyField + strlen(self::FIELD_ENCLOSING));
                  if ($posStopKeyField !== false) {
                    $fieldName = substr($indexText, $posStartKeyField + strlen(self::FIELD_ENCLOSING), ($posStopKeyField - $posStartKeyField) - strlen(self::FIELD_ENCLOSING));
                    $indexes[$indexesInd]["field" . $noField++] = $fieldName;
                    $posStartKeyField = stripos($indexText, self::FIELD_ENCLOSING, $posStopKeyField + strlen(self::FIELD_ENCLOSING));
                  }
                }
                $indexesInd++;
              }
            }
          } else {
            $posKey = stripos($indexText, self::KEY, $posKey + strlen(self::KEY));
          }
        }
      } else {
        $errorT = "sess_ErreurIndex";
        $errorR = "sess_ErreurNoIndex";
      }
      return array($primaryKey, $uniqueIndexes, $indexes, $errorT, $errorR);
    }
    // End of prepare

  }
  // End of Class
}
// class_exists
