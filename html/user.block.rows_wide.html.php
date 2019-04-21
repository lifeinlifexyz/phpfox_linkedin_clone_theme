<?php
defined('PHPFOX') or exit('NO DICE!');
?>
<div class="item-outer">
    <div class="item-inner">
        <div class="item-media">
            {img user=$aUser suffix='_200_square' max_width=200 max_height=200}
        </div>
        <div class="user-info text-center">
            <div class="user-title">
                {$aUser|user}
            </div>
           {module name='user.info' friend_user_id=$aUser.user_id number_of_info=2}
        </div>
        {if Phpfox::isUser() && $aUser.user_id != Phpfox::getUserId()}
        <div class="dropup friend-actions text-center">
            {if Phpfox::isUser() && Phpfox::isModule('friend') && empty($is_friend)}
            {if !$is_friend && isset($aUser.is_friend_request) && $aUser.is_friend_request == 3}
            <a href="#" onclick="return $Core.addAsFriend('{$user_id}');" title="{_p var='confirm_friend_request'}" class="button-secondary-small">
                <span class="mr-1 ico ico-user2-check-o"></span>
                {_p var='confirm'}
            </a>
            {elseif Phpfox::getUserParam('friend.can_add_friends')}
            <a href="#" onclick="return $Core.addAsFriend('{$user_id}');" title="{_p var='add_as_friend'}" class="button-secondary-small">
                <span class="mr-1 ico ico-user1-plus-o"></span>
                {_p var='add_as_friend'}
            </a>
            {/if}
            {/if}

            {if Phpfox::isModule('friend') && !empty($is_friend)}
            <a href="" data-toggle="dropdown" class="btn btn-md btn-default btn-round" title="{_p var='friend_request_sent'}">
                {if $is_friend === true}
                <span class="mr-1 ico ico-check"></span>
                {_p var='friend'} <span class="ml-1 ico ico-caret-down"></span>
                {else}
                <span class="mr-1 ico ico-clock-o mr-1 friend-request-sent"></span>
                {_p var='request_sent'} <span class="ml-1 ico ico-caret-down"></span>
                {/if}
            </a>
            {/if}

            <ul class="dropdown-menu dropdown-center">
                {if Phpfox::isModule('mail') && User_Service_Privacy_Privacy::instance()->hasAccess('' . $aUser.user_id . '', 'mail.send_message')}
                <li>
                    <a href="#" onclick="$Core.composeMessage({left_curly}user_id: {$aUser.user_id}{right_curly}); return false;">
                        <span class="mr-1 ico ico-pencilline-o"></span>
                        {_p var='message'}
                    </a>
                </li>
                {/if}

                <li>
                    <a href="#?call=report.add&amp;height=220&amp;width=400&amp;type=user&amp;id={$aUser.user_id}" class="inlinePopup" title="{_p var='report_this_user'}">
                        <span class="ico ico-warning-o mr-1"></span>
                        {_p var='report_this_user'}</a>
                </li>
                {if Phpfox::isModule('friend') && isset($is_friend) && $is_friend === true}
                <li class="item-delete">
                    <a href="#" onclick="$Core.jsConfirm({l}{r}, function(){l}$.ajaxCall('friend.delete', 'friend_user_id={$aUser.user_id}&reload=1');{r}, function(){l}{r}); return false;">
                        <span class="mr-1 ico ico-user2-del-o"></span>
                        {_p var='remove_friend'}
                    </a>
                </li>
                {elseif Phpfox::isModule('friend') && !empty($is_friend) && !empty($request_id)}
                <li class="item-delete">
                    <a href="{url link='friend.pending' id=$request_id}" class="sJsConfirm">
                        <span class="mr-1 ico ico-user2-del-o"></span>
                        {_p var='cancel_request'}
                    </a>
                </li>
                {/if}
            </ul>
        </div>
        {/if}

    </div>
    {if isset($aUser.is_featured) && $aUser.is_featured}
    <div class="item-featured" title="{_p var='featured'}">
        <span class="ico ico-diamond"></span>
    </div>
    {/if}
</div>