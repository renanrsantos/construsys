<?php

namespace App\Html\Chart;

use Illuminate\Support\Facades\Facade;

/**
 * Description of ChartFacade
 *
 * @author renan
 */
class ChartFacade extends Facade
{

    /**
     * Get the registered name of the component.
     *
     * @return string
     */
    protected static function getFacadeAccessor()
    {
        return 'chart';
    }
}
