<?php // Needed to encode in UTF8 ààéàé //
class DistriXWatcherStorData
{
  private $id;
  private $service;
  private $description;
  private $watchdate;
  private $watchtime;
  private $responsetime;

  public function __construct()
  {
    $this->id = 0;
    $this->service = 0;
    $this->description = "";
    $this->watchdate = 0;
    $this->watchtime = 0;
    $this->responsetime = 0;
  }
  // Gets
  public function getId()
  {
    return $this->id;
  }
  public function getService()
  {
    return $this->service;
  }
  public function getDescription()
  {
    return $this->description;
  }
  public function getWatchDate()
  {
    return $this->watchdate;
  }
  public function getWatchTime()
  {
    return $this->watchtime;
  }
  public function getResponseTime()
  {
    return $this->responsetime;
  }
  // Sets
  public function setId($id)
  {
    $this->id = $id;
  }
  public function setService($service)
  {
    $this->service = $service;
  }
  public function setDescription($description)
  {
    $this->description = $description;
  }
  public function setWatchDate($watchDate)
  {
    $this->watchdate = $watchDate;
  }
  public function setWatchTime($watchTime)
  {
    $this->watchtime = $watchTime;
  }
  public function setRespoonseTime($responseTime)
  {
    $this->responsetime = $responseTime;
  }
}
