<?php // Needed to encode in UTF8 ààéàé //
if (!class_exists('DistriXLoggerEmailData', false)) {
  class DistriXLoggerEmailData
  {
    protected $logEmail;
    protected $logEmailSender;
    protected $logEmailSubject;

    public function __construct(string $email, string $sender, string $subject)
    {
      $this->logEmail        = $email;
      $this->logEmailSender  = $sender;
      $this->logEmailSubject = $subject;
    }
    // Gets
    public function getLogEmail(): string
    {
      return $this->logEmail;
    }
    public function getLogEmailSender(): string
    {
      return $this->logEmailSender;
    }
    public function getLogEmailSubject(): string
    {
      return $this->logEmailSubject;
    }
    // Sets
    public function setLogEmail(string $logEmail)
    {
      $this->logEmail = $logEmail;
    }
    public function setLogEmailSender(string $logEmailSender)
    {
      $this->logEmailSender = $logEmailSender;
    }
    public function setLogEmailSubject(string $logEmailSubject)
    {
      $this->logEmailSubject = $logEmailSubject;
    }
  }
  // End of Class
}
