<?php

declare(strict_types=1);
// SPDX-FileCopyrightText: Besfort Ajeti <Besfortajeti915@gmail.com>
// SPDX-License-Identifier: AGPL-3.0-or-later

namespace OCA\MicrosoftMFA\Controller;

use Closure;

use OCA\MicrosoftMFA\Service\NoteNotFound;
use OCP\AppFramework\Http;

use OCP\AppFramework\Http\DataResponse;

trait Errors {
	protected function handleNotFound(Closure $callback): DataResponse {
		try {
			return new DataResponse($callback());
		} catch (NoteNotFound $e) {
			$message = ['message' => $e->getMessage()];
			return new DataResponse($message, Http::STATUS_NOT_FOUND);
		}
	}
}
