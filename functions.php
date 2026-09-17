<?php
    $params = [
        'client_id' => OAUTH2_CLIENT_ID,
        'redirect_uri' => REDIRECT_URL,
        'response_type' => 'code',
        'scope' => 'identify email guilds.join'
    ];

    $authorize_url = 'https://discord.com/api/oauth2/authorize?' . http_build_query($params);

    function is_animated($avatar)
    {
        $ext = substr($avatar, 0, 2);
        if ($ext == "a_")
        {
            return ".gif";
        }
        else
        {
            return ".png";
        }
    }
?>