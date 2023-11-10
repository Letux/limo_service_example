<?php

function setting(string $name, $default = null)
{
    return \App\Models\Setting::getSetting($name, $default);
}
