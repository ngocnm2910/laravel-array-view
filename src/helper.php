<?php

if (!function_exists('arrayView')) {
    /**
     * Get the evaluated view contents for the given view.
     *
     * @param  string  $view
     * @param  array   $data
     * @param  array   $mergeData
     * @return \ChickenCoder\ArrayView\Factory
     */
    function arrayView($view = null, $data = [], $mergeData = [])
    {
        return PhpSoft\Illuminate\ArrayView\Facades\ArrayView::render($view, $data, $mergeData);
    }
}
