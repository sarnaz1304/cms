<?php

namespace Statamic\Extend\Management;

use Statamic\Widgets\WidgetNotFoundException;

class WidgetLoader
{
    public function load($name, $config)
    {
        if (! ($widgets = app('statamic.widgets'))->has($name)) {
            throw new WidgetNotFoundException($name);
        }

        return $this->init($widgets->get($name), $config);
    }

    private function init($class, $config)
    {
        return tap(app($class), function ($widget) use ($config) {
            $widget->setConfig($config);
        });
    }
}
