<?php


namespace App\Services;


class LineEvent
{
    const TYPE_MESSAGE_EVENT = 'message';
    const TYPE_CANCEL_SENDING_EVENT = 'unsend';
    const TYPE_FOLLOW_EVENT = 'follow';
    const TYPE_UNFOLLOW_EVENT = 'unfollow';
    const TYPE_JOIN_EVENT = 'join';
    const TYPE_MEMBER_JOINED_EVENT = 'memberJoined';
    const TYPE_MEMBER_LEFT_EVENT = 'memberLeft';
    const TYPE_POSTBACK_EVENT = 'postback';
    const TYPE_VIDEO_PLAY_COMPLETE_EVENT = 'videoPlayComplete';
    const TYPE_BEACON_EVENT = 'beacon';
    const TYPE_ACCOUNT_LINK_EVENT = 'accountLink';
    const TYPE_DEVICE_EVENT = 'things';
}