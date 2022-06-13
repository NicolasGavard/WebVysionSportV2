<?php // Needed to encode in UTF8 ààéàé //

if (!class_exists("ApplicationErrorData", false)) {
  class ApplicationErrorData  extends DistriXSvcErrorData
  {
    const NO_DATABASE_CONNECTION  = 56;
    const NO_BEGIN_TRANSACTION    = 57;
    const WARNING_INSERT_DATA     = 58;
    const WARNING_INSERT_EXIST    = 59;
    const WARNING_UPDATE_DATA     = 60;
    const WARNING_DELETE_DATA     = 61;
    const WARNING_RESTORE_DATA    = 62;
    const WARNING_READ_DATA       = 63;

    protected $idPos;

    public function getIdPos()
    {
      return $this->idPos;
    }
    public function setIdPos($idPos)
    {
      $this->idPos = $idPos;
    }

    public function __construct()
    {
      parent::__construct();
      $arguments = func_get_args();
      if (func_num_args() > 0) {
        $this->setCode($arguments[0]);
        if (func_num_args() > 1) {
          $this->setIdPos($arguments[1]);
          if (func_num_args() > 2) {
            $this->setIdUser($arguments[2]);
          }
        }
      }
    }

    public static function noDatabaseConnection($idPos, $idUser)
    {
      $instance = new self(self::NO_DATABASE_CONNECTION, $idPos, $idUser);
      $instance->setTypeApplication();
      $instance->setSeverityCritical();
      $instance->setTextToAllText('Database connection error');
      return $instance;
    }

    public static function noBeginTransaction($idPos, $idUser)
    {
      $instance = new self(self::NO_BEGIN_TRANSACTION, $idPos, $idUser);
      $instance->setTypeApplication();
      $instance->setSeverityCritical();
      $instance->setTextToAllText('The transaction does not have starting');
      return $instance;
    }

    public static function warningInsertData($idPos, $idUser)
    {
      $instance = new self(self::WARNING_INSERT_DATA, $idPos, $idUser);
      $instance->setTypeApplication();
      $instance->setSeverityCritical();
      $instance->setTextToAllText('The service encountered an error while adding your data');
      return $instance;
    }

    public static function warningInsertExist($idPos, $idUser)
    {
      $instance = new self(self::WARNING_INSERT_EXIST, $idPos, $idUser);
      $instance->setTypeApplication();
      $instance->setSeverityCritical();
      $instance->setTextToAllText('The data already exist');
      return $instance;
    }

    public static function warningUpdateData($idPos, $idUser)
    {
      $instance = new self(self::WARNING_UPDATE_DATA, $idPos, $idUser);
      $instance->setTypeApplication();
      $instance->setSeverityCritical();
      $instance->setTextToAllText('The service has encountered an error while updating your data');
      return $instance;
    }

    public static function warningDeleteData($idPos, $idUser)
    {
      $instance = new self(self::WARNING_DELETE_DATA, $idPos, $idUser);
      $instance->setTypeApplication();
      $instance->setSeverityCritical();
      $instance->setTextToAllText('The service has encountered an error while deleting your data');
      return $instance;
    }

    public static function warningRestoreData($idPos, $idUser)
    {
      $instance = new self(self::WARNING_RESTORE_DATA, $idPos, $idUser);
      $instance->setTypeApplication();
      $instance->setSeverityCritical();
      $instance->setTextToAllText('The service encountered an error while restoring your data');
      return $instance;
    }

    public static function warningReadData($idPos, $idUser)
    {
      $instance = new self(self::WARNING_READ_DATA, $idPos, $idUser);
      $instance->setTypeApplication();
      $instance->setSeverityCritical();
      $instance->setTextToAllText('The service encountered an error while reading your data');
      return $instance;
    }
    public static function warningSecurityError($idPos, $idUser)
    {
      $instance = new self(self::WARNING_UPDATE_DATA, $idPos, $idUser);
      $instance->setTypeApplication();
      $instance->setSeverityCritical();
      $instance->setTextToAllText('You do not have sufficient rights to validate this action');
      return $instance;
    }
    public static function warningEmptyFormError($idPos, $idUser)
    {
      $instance = new self(self::WARNING_INSERT_DATA, $idPos, $idUser);
      $instance->setTypeApplication();
      $instance->setSeverityCritical();
      $instance->setTextToAllText('The data in the form does not allow registration');
      return $instance;
    }
  }
  // End of class
}
// class_exists
