<?php

require('config.php');
require('functions.php');

// Log out the browser agent, if specified
//
if ($kConfShouldLogAgent && !empty($_SERVER['HTTP_USER_AGENT']))
{
    $agentHash    = sha1($_SERVER['HTTP_USER_AGENT']);
    $agentLogPath = "statistics/agents/$agentHash";

    if (!file_exists($agentLogPath))
    {
        try
        {
            file_put_contents(
                $agentLogPath,
                $_SERVER['HTTP_USER_AGENT']
            );
        }
        catch (Exception $ex)
        {
            error_log(
                'Failed to log user agent, error: ' . $ex->getMessage()
            );
        }
    }
}


// If HTTP_HOST is empty, then either the browser does not support VHOSTS or
// the user browsed directly to the IP
//
if (empty($_SERVER['HTTP_HOST']))
{
    die('HTTP_HOST unset, VirtualHosts unsupported.');
}

// See if we are hosting the requested domain, if so, load it and launch
//
$domainHostScript = "sites/${_SERVER['HTTP_HOST']}/proxy.php";

if (file_exists($domainHostScript))
{
    require($domainHostScript);
}
else
{
    die('Requested host unsupported.');
}

?>
