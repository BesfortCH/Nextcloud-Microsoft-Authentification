<?php

declare(strict_types=1);
// SPDX-FileCopyrightText: Besfort Ajeti <Besfortajeti915@gmail.com>
// SPDX-License-Identifier: AGPL-3.0-or-later

namespace OCA\MicrosoftMFA\Tests\Unit\Controller;

use OCA\MicrosoftMFA\Controller\NoteApiController;

class NoteApiControllerTest extends NoteControllerTest {
	public function setUp(): void {
		parent::setUp();
		$this->controller = new NoteApiController($this->request, $this->service, $this->userId);
	}
}
