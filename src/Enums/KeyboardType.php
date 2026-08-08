<?php

declare(strict_types=1);

namespace Haikiri\VkBrown\Enums;

enum KeyboardType: string
{

	public const SNACK_BAR = "show_snackbar";

	case TEXT = "text";
	case LOCATION = "location";
	case PAY = "vkpay";
	case LINK = "open_link";
	case APP = "open_app";
	case CALLBACK = "callback";

}
