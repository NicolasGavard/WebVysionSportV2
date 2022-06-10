<?php // Needed to encode in UTF8 ààéàé //
if (!class_exists("DistriXSvcErrorData", false)) {
  class DistriXSvcErrorData extends DistriXSvcAppData
  {
    const ERROR_TYPE_APPLICATION     = "ERROR_TYPE_APPLICATION";
    const ERROR_TYPE_SYSTEM          = "ERROR_TYPE_SYSTEM";

    const ERROR_SEVERITY_NONE        = "ERROR_SEVERITY_NONE";
    const ERROR_SEVERITY_INFORMATION = "ERROR_SEVERITY_INFORMATION";
    const ERROR_SEVERITY_WARNING     = "ERROR_SEVERITY_WARNING";
    const ERROR_SEVERITY_ERROR       = "ERROR_SEVERITY_ERROR";
    const ERROR_SEVERITY_CRITICAL    = "ERROR_SEVERITY_CRITICAL";

    protected $type;
    protected $severity;
    protected $code;
    protected $defaultText;
    protected $text;
    protected $date;
    protected $time;
    protected $idUser;
    protected $applicationCode;
    protected $moduleCode;
    protected $functionalityCode;
    protected $fileName;
    protected $parameters;

    public function __construct()
    {
      $this->type              = self::ERROR_TYPE_APPLICATION;
      $this->severity          = self::ERROR_SEVERITY_ERROR;
      $this->code              = "";
      $this->defaultText       = "";
      $this->text              = "";
      $this->date              = DistriXSvcUtil::getCurrentNumDate();
      $this->time              = DistriXSvcUtil::getCurrentNumTime();
      $this->idUser            = 0;
      $this->applicationCode   = "";
      $this->moduleCode        = "";
      $this->functionalityCode = "";
      $this->fileName          = rawurldecode(basename($_SERVER['REQUEST_URI']));
      $this->parameters        = [];
    }
    public static function setSystemCritical(string $code, string $text): DistriXSvcErrorData
    {
      $instance = new self();
      $instance->setTypeSystem();
      $instance->setSeverityCritical();
      $instance->setCode($code);
      $instance->setTextToAllText($text);
      return $instance;
    }

    // Gets
    public function isTypeApplication(): bool
    {
      return ($this->type == self::ERROR_TYPE_APPLICATION);
    }
    public function isTypeSystem(): bool
    {
      return ($this->type == self::ERROR_TYPE_SYSTEM);
    }
    public function isSeverityInformation(): bool
    {
      return ($this->severity == self::ERROR_SEVERITY_INFORMATION);
    }
    public function isSeverityWarning(): bool
    {
      return ($this->severity == self::ERROR_SEVERITY_WARNING);
    }
    public function isSeverityError(): bool
    {
      return ($this->severity == self::ERROR_SEVERITY_ERROR);
    }
    public function isSeverityCritical(): bool
    {
      return ($this->severity == self::ERROR_SEVERITY_CRITICAL);
    }
    public function getCode(): string
    {
      return $this->code;
    }
    public function getDefaultText(): string
    {
      return $this->defaultText;
    }
    public function getText(): string
    {
      return $this->text;
    }
    public function getDate(): int
    {
      return $this->date;
    }
    public function getTime(): int
    {
      return $this->time;
    }
    public function getIdUser(): int
    {
      return $this->idUser;
    }
    public function getApplicationCode(): string
    {
      return $this->applicationCode;
    }
    public function getModuleCode(): string
    {
      return $this->moduleCode;
    }
    public function getFunctionalityCode(): string
    {
      return $this->functionalityCode;
    }
    public function getFileName(): string
    {
      return $this->fileName;
    }
    public function getParameters(): array
    {
      return $this->parameters;
    }
    // Sets
    public function setTypeApplication()
    {
      $this->type = self::ERROR_TYPE_APPLICATION;
    }
    public function setTypeSystem()
    {
      $this->type = self::ERROR_TYPE_SYSTEM;
    }
    public function setSeverityInformation()
    {
      $this->severity = self::ERROR_SEVERITY_INFORMATION;
    }
    public function setSeverityWarning()
    {
      $this->severity = self::ERROR_SEVERITY_WARNING;
    }
    public function setSeverityError()
    {
      $this->severity = self::ERROR_SEVERITY_ERROR;
    }
    public function setSeverityCritical()
    {
      $this->severity = self::ERROR_SEVERITY_CRITICAL;
    }
    public function setCode(string $code)
    {
      $this->code = $code;
    }
    public function setTextToAllText(string $text)
    {
      $this->setDefaultText($text);
      $this->setText($text);
    }
    public function setDefaultText(string $defaultText)
    {
      $this->defaultText = $defaultText;
    }
    public function setText(string $text)
    {
      $this->text = $text;
    }
    public function setDate(int $date)
    {
      $this->$date = $date;
    }
    public function setErrorTime(int $time)
    {
      $this->time = $time;
    }
    public function setIdUser(int $idUser)
    {
      $this->idUser = $idUser;
    }
    public function setApplicationModuleFunctionalityCodeAndFilename(string $applicationCode, string $moduleCode, string $functionalityCode, string $fileName)
    {
      $this->setApplicationCode($applicationCode);
      $this->setModuleCode($moduleCode);
      $this->setFunctionalityCode($functionalityCode);
      $this->setFileName($fileName);
    }
    public function setApplicationCode(string $applicationCode)
    {
      $this->applicationCode = $applicationCode;
    }
    public function setModuleCode(string $moduleCode)
    {
      $this->moduleCode = $moduleCode;
    }
    public function setFunctionalityCode(string $functionalityCode)
    {
      $this->functionalityCode = $functionalityCode;
    }
    public function setFileName(string $fileName)
    {
      $this->fileName = $fileName;
    }
    public function setParameters(array $parameters)
    {
      $this->parameters = $parameters;
    }
    public function addToParameters($key, $value)
    {
      $this->parameters[$key] = $value;
    }
  }
  // End of class
}
// class_exists
