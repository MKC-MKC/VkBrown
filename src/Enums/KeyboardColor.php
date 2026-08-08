<?php

declare(strict_types=1);

namespace Haikiri\VkBrown\Enums;

enum KeyboardColor: string
{

	case NONE = "";
	case RED = "negative";
	case GREEN = "positive";
	case BLUE = "primary";
	case GRAY = "secondary";

}
