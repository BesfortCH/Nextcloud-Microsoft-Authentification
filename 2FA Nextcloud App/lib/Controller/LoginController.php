<?php

namespace OCA\NextcloudMicrosoftAuthenticator\Controller;

use OCP\AppFramework\Controller;
use OCP\AppFramework\Http;
use OCP\AppFramework\Http\JSONResponse;
use OCP\IL10N;
use OCP\IURLGenerator;
use OCP\IUserSession;

class LoginController extends \OCP\AppFramework\Controller {

    /**
     * @var IL10N
     */
    protected $l10n;

    /**
     * @var IURLGenerator
     */
    protected $urlGenerator;

    /**
     * @var IUserSession
     */
    protected $userSession;

    public function __construct($appName, IURLGenerator $urlGenerator, IL10N $l10n, IUserSession $userSession) {
        parent::__construct($appName);
        $this->l10n = $l10n;
        $this->urlGenerator = $urlGenerator;
        $this->userSession = $userSession;
    }

    public function login($username, $password): JSONResponse {
        // Perform default Nextcloud login
        $response = parent::login($username, $password);

        // Check if user has Microsoft Authenticator set up
        $user = $this->userSession->getUser();
        if (!$user->getEnabledTwoFactorProviders()[0] === 'OCA\NextcloudMicrosoftAuthenticator\TwoFactor') {
            // Redirect user to setup page
            $url = $this->urlGenerator->linkToRouteAbsolute('nextcloud_microsoft_authenticator.PageController.setup');
            return new JSONResponse(['redirect' => $url], Http::STATUS_TEMPORARY_REDIRECT);
        }

        return $response;
    }
}
