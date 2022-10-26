<?php

namespace App\helper;

use Illuminate\Routing\ResourceRegistrar as OriginalRegistrar;

class ResourceRegistrar extends OriginalRegistrar
{
    // add data to the array
    /**
     * The default actions for a resourceful controller.
     *
     * @var array
     */
    protected $resourceDefaults = ['index', 'create', 'store', 'show', 'edit', 'update', 'destroy',"getAjaxData","postAjaxData"];

    /**
     * Add the get data and post data method for a resourceful route.
     *
     * @param  string  $name
     * @param  string  $base
     * @param  string  $controller
     * @param  array   $options
     * @return \Illuminate\Routing\Route
     */
    protected function addResourceGetAjaxData($name, $base, $controller, $options)
    {
        $uri = "ajax-get-$name-data";
        $action = $this->getResourceAction($name, $controller, 'ajaxGetData', $options);

        return $this->router->get($uri, $action);
    }

    protected function addResourcePostAjaxData($name, $base, $controller, $options)
    {
        $uri = "ajax-post-$name-data";

        $action = $this->getResourceAction($name, $controller, 'ajaxPostData', $options);

        return $this->router->post($uri, $action);
    }
}