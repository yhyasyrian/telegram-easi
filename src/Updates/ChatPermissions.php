<?php

namespace Yhyasyrian\TelegramEasi\Updates;

class ChatPermissions
{
    /**
     * Optional. True, if the user is allowed to send text messages, contacts, invoices, locations and venues
     *
     * @var bool|null
     */
    public bool|null $can_send_messages;
    /**
     * Optional. True, if the user is allowed to send audios
     *
     * @var bool|null
     */
    public bool|null $can_send_audios;
    /**
     * Optional. True, if the user is allowed to send documents
     *
     * @var bool|null
     */
    public bool|null $can_send_documents;
    /**
     * Optional. True, if the user is allowed to send photos
     *
     * @var bool|null
     */
    public bool|null $can_send_photos;
    /**
     * Optional. True, if the user is allowed to send videos
     *
     * @var bool|null
     */
    public bool|null $can_send_videos;
    /**
     * Optional. True, if the user is allowed to send video notes
     *
     * @var bool|null
     */
    public bool|null $can_send_video_notes;
    /**
     * Optional. True, if the user is allowed to send voice notes
     *
     * @var bool|null
     */
    public bool|null $can_send_voice_notes;
    /**
     * Optional. True, if the user is allowed to send polls
     *
     * @var bool|null
     */
    public bool|null $can_send_polls;
    /**
     * Optional. True, if the user is allowed to send animations, games, stickers and use inline bots
     *
     * @var bool|null
     */
    public bool|null $can_send_other_messages;
    /**
     * Optional. True, if the user is allowed to add web page previews to their messages
     *
     * @var bool|null
     */
    public bool|null $can_add_web_page_previews;
    /**
     * Optional. True, if the user is allowed to change the chat title, photo and other settings. Ignored in public supergroups
     *
     * @var bool|null
     */
    public bool|null $can_change_info;
    /**
     * Optional. True, if the user is allowed to invite new users to the chat
     *
     * @var bool|null
     */
    public bool|null $can_invite_users;
    /**
     * Optional. True, if the user is allowed to pin messages. Ignored in public supergroups
     *
     * @var bool|null
     */
    public bool|null $can_pin_messages;
    /**
     * Optional. True, if the user is allowed to create forum topics. If omitted defaults to the value of can_pin_messages
     *
     * @var bool|null
     */
    public bool|null $can_manage_topics;
}
