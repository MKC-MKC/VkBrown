<?php

declare(strict_types=1);

namespace Haikiri\VkBrown\Enums;

enum KeyboardType: string
{

	case TEXT = "text";
	case LOCATION = "location";
	case LINK = "open_link";
	case CALLBACK = "callback";

}
