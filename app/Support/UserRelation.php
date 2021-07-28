<?php

namespace App\Support;

use App\Constants\TalkModeConstant;
use App\Model\Group\Group;
use App\Service\Group\GroupMemberService;
use App\Service\UserFriendService;

class UserRelation
{
    /**
     * 判断是否是好友或者群成员关系
     *
     * @param int $user_id     用户ID
     * @param int $receiver_id 接收者ID
     * @param int $talk_type   对话类型
     * @return bool
     */
    public static function isFriendOrGroupMember(int $user_id, int $receiver_id, int $talk_type)
    {
        if ($talk_type == TalkModeConstant::PRIVATE_CHAT) {
            return di()->get(UserFriendService::class)->isFriend($user_id, $receiver_id, true);
        } else if ($talk_type == TalkModeConstant::GROUP_CHAT) {
            return di()->get(GroupMemberService::class)->isMember($receiver_id, $user_id);
        }

        return false;
    }
}
