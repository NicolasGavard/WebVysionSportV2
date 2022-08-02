<?php // Needed to encode in UTF8 ààéàé //
if (!class_exists('DistriXCdnSvcCaller', false)) {
	class DistriXCdnSvcCaller extends DistriXSvcCaller
	{
		/* SSL Keys Locations */
		// const CLIENT_SERVER_SSL_CA_INFO = "C:\wamp64\www\certificate.crt";
		// const CLIENT_SERVER_SSL_CA_PATH = "C:\wamp64\www\certificate.crt";

		/* Client Servers Addresses Values */
		const CLIENT_SRV_DEV     = "127.0.0.1";
		const CLIENT_SRV_INT     = "www.pazzidjango.com";
		const CLIENT_SRV_VER     = "www.pazzidjango.com";
		const CLIENT_SRV_VAL     = "www.pazzidjango.com";
		const CLIENT_SRV_PROD    = "www.distrix.cloud";

		/* Business Servers Kind of Call Values */
		const CLIENT_CALL_DEV     = "http";
		const CLIENT_CALL_INT     = "https";
		const CLIENT_CALL_VER     = "https";
		const CLIENT_CALL_VAL     = "https";
		const CLIENT_CALL_PROD    = "https";

		/* Client Servers Directories Values */
		const CLIENT_DIR_DEV     = "WebVysionSportV2";
		const CLIENT_DIR_INT     = "CdnServices";
		const CLIENT_DIR_VER     = "CdnServices";
		const CLIENT_DIR_VAL     = "CdnServices";
		const CLIENT_DIR_PROD    = "WebVysionSport";

		/* Client Servers Timeout Values */
		const CLIENT_SRV_DEV_TIMEOUT              = "localhost";
		const CLIENT_CALL_DEV_TIMEOUT             = "http";
		const CLIENT_CALL_DEV_TIMEOUT_NB_SECONDS  = 5;
		const CLIENT_DIR_DEV_TIMEOUT              = "WebVysionSportV2";

		const CLIENT_SRV_INT_TIMEOUT              = "";
		const CLIENT_CALL_INT_TIMEOUT             = "https";
		const CLIENT_CALL_INT_TIMEOUT_NB_SECONDS  = 5;
		const CLIENT_DIR_INT_TIMEOUT              = "";

		const CLIENT_SRV_VER_TIMEOUT              = "";
		const CLIENT_CALL_VER_TIMEOUT             = "https";
		const CLIENT_CALL_VER_TIMEOUT_NB_SECONDS  = 5;
		const CLIENT_DIR_VER_TIMEOUT              = "";

		const CLIENT_SRV_VAL_TIMEOUT              = "";
		const CLIENT_CALL_VAL_TIMEOUT             = "https";
		const CLIENT_CALL_VAL_TIMEOUT_NB_SECONDS  = 5;
		const CLIENT_DIR_VAL_TIMEOUT              = "";

		const CLIENT_SRV_PROD_TIMEOUT             = "www.distrix.cloud";
		const CLIENT_CALL_PROD_TIMEOUT            = "https";
		const CLIENT_CALL_PROD_TIMEOUT_NB_SECONDS = 5;
		const CLIENT_DIR_PROD_TIMEOUT             = "WebVysionSport";

		public function __construct($svcCaller = null)
		{
			parent::__construct($svcCaller);

			switch (DISTRIX_ENV) {
				case DISTRIX_ENV_DEV:
					$this->setServerAddress(self::CLIENT_SRV_DEV);
					$this->setServerCall(self::CLIENT_CALL_DEV);
					$this->setServerDirectory(self::CLIENT_DIR_DEV);
					$this->setServerTimeoutAddress(self::CLIENT_SRV_DEV_TIMEOUT);
					$this->setServerTimeoutCall(self::CLIENT_CALL_DEV_TIMEOUT);
					$this->setServerTimeoutSeconds(self::CLIENT_CALL_DEV_TIMEOUT_NB_SECONDS);
					$this->setServerTimeoutDirectory(self::CLIENT_DIR_DEV_TIMEOUT);
					break;

				case DISTRIX_ENV_INT:
					$this->setServerAddress(self::CLIENT_SRV_INT);
					$this->setServerCall(self::CLIENT_CALL_INT);
					$this->setServerDirectory(self::CLIENT_DIR_INT);
					$this->setServerTimeoutAddress(self::CLIENT_SRV_INT_TIMEOUT);
					$this->setServerTimeoutCall(self::CLIENT_CALL_INT_TIMEOUT);
					$this->setServerTimeoutSeconds(self::CLIENT_CALL_INT_TIMEOUT_NB_SECONDS);
					$this->setServerTimeoutDirectory(self::CLIENT_DIR_INT_TIMEOUT);
					break;

				case DISTRIX_ENV_VER:
					$this->setServerAddress(self::CLIENT_SRV_VER);
					$this->setServerCall(self::CLIENT_CALL_VER);
					$this->setServerDirectory(self::CLIENT_DIR_VER);
					$this->setServerTimeoutAddress(self::CLIENT_SRV_VER_TIMEOUT);
					$this->setServerTimeoutCall(self::CLIENT_CALL_VER_TIMEOUT);
					$this->setServerTimeoutSeconds(self::CLIENT_CALL_VER_TIMEOUT_NB_SECONDS);
					$this->setServerTimeoutDirectory(self::CLIENT_DIR_VER_TIMEOUT);
					break;

				case DISTRIX_ENV_VAL:
					$this->setServerAddress(self::CLIENT_SRV_VAL);
					$this->setServerCall(self::CLIENT_CALL_VAL);
					$this->setServerDirectory(self::CLIENT_DIR_VAL);
					$this->setServerTimeoutAddress(self::CLIENT_SRV_VAL_TIMEOUT);
					$this->setServerTimeoutCall(self::CLIENT_CALL_VAL_TIMEOUT);
					$this->setServerTimeoutSeconds(self::CLIENT_CALL_VAL_TIMEOUT_NB_SECONDS);
					$this->setServerTimeoutDirectory(self::CLIENT_DIR_VAL_TIMEOUT);
					break;

				case DISTRIX_ENV_PROD:
					$this->setServerAddress(self::CLIENT_SRV_PROD);
					$this->setServerCall(self::CLIENT_CALL_PROD);
					$this->setServerDirectory(self::CLIENT_DIR_PROD);
					$this->setServerTimeoutAddress(self::CLIENT_SRV_PROD_TIMEOUT);
					$this->setServerTimeoutCall(self::CLIENT_CALL_PROD_TIMEOUT);
					$this->setServerTimeoutSeconds(self::CLIENT_CALL_PROD_TIMEOUT_NB_SECONDS);
					$this->setServerTimeoutDirectory(self::CLIENT_DIR_PROD_TIMEOUT);
					break;

				default:
					break;
			}
		}
	}
	// End of Class
}
// class_exists