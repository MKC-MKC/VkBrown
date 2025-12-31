<?php

namespace Haikiri\VkBrown\Enums;

enum MessageTypesEnum: string
{

	case AUDIO_NEW = 'audio_new';
	case BOARD_POST_NEW = 'board_post_new';
	case BOARD_POST_EDIT = 'board_post_edit';
	case BOARD_POST_RESTORE = 'board_post_restore';
	case BOARD_POST_DELETE = 'board_post_delete';
	case CONFIRMATION = 'confirmation';
	case GROUP_LEAVE = 'group_leave';
	case GROUP_JOIN = 'group_join';
	case GROUP_CHANGE_PHOTO = 'group_change_photo';
	case GROUP_CHANGE_SETTINGS = 'group_change_settings';
	case GROUP_OFFICERS_EDIT = 'group_officers_edit';
	case LEAD_FORMS_NEW = 'lead_forms_new';
	case MARKET_COMMENT_NEW = 'market_comment_new';
	case MARKET_COMMENT_DELETE = 'market_comment_delete';
	case MARKET_COMMENT_EDIT = 'market_comment_edit';
	case MARKET_COMMENT_RESTORE = 'market_comment_restore';
	case MARKET_ORDER_NEW = 'market_order_new';
	case MARKET_ORDER_EDIT = 'market_order_edit';
	case MESSAGE_NEW = 'message_new';
	case MESSAGE_REPLY = 'message_reply';
	case MESSAGE_EDIT = 'message_edit';
	case MESSAGE_ALLOW = 'message_allow';
	case MESSAGE_DENY = 'message_deny';
	case MESSAGE_READ = 'message_read';
	case MESSAGE_TYPING_STATE = 'message_typing_state';
	case MESSAGES_EDIT = 'messages_edit';
	case MESSAGE_REACTION_EVENT = 'message_reaction_event';
	case PHOTO_NEW = 'photo_new';
	case PHOTO_COMMENT_NEW = 'photo_comment_new';
	case PHOTO_COMMENT_DELETE = 'photo_comment_delete';
	case PHOTO_COMMENT_EDIT = 'photo_comment_edit';
	case PHOTO_COMMENT_RESTORE = 'photo_comment_restore';
	case POLL_VOTE_NEW = 'poll_vote_new';
	case USER_BLOCK = 'user_block';
	case USER_UNBLOCK = 'user_unblock';
	case VIDEO_NEW = 'video_new';
	case VIDEO_COMMENT_NEW = 'video_comment_new';
	case VIDEO_COMMENT_DELETE = 'video_comment_delete';
	case VIDEO_COMMENT_EDIT = 'video_comment_edit';
	case VIDEO_COMMENT_RESTORE = 'video_comment_restore';
	case WALL_POST_NEW = 'wall_post_new';
	case WALL_REPLY_NEW = 'wall_reply_new';
	case WALL_REPLY_EDIT = 'wall_reply_edit';
	case WALL_REPLY_DELETE = 'wall_reply_delete';
	case WALL_REPLY_RESTORE = 'wall_reply_restore';
	case WALL_REPOST = 'wall_repost';
	case WALL_SCHEDULE_POST_NEW = 'wall_schedule_post_new';
	case WALL_SCHEDULE_POST_DELETE = 'wall_schedule_post_delete';

}
