<?php

/**
 *
 *Application Administration Base URL
 *
 * @param String $route
 *
 *@return String
 *
 */
if (!function_exists('blogBaseUrl')) {
    function blogBaseUrl($route)
    {
        return url(config('blog.prefix', 'admin/blog') . '/' . $route);
    }
}

/**
 *
 * Redirected Route
 *
 *@param string $route
 *
 *@return String
 *
 */
if (!function_exists('blogRedirectRoute')) {
    function blogRedirectRoute($route)
    {
        return blogBaseUrl($route);
    }
}

/**
 *
 * Create View Route
 *
 *@param String $route
 *
 *@return String
 *
 */
if (!function_exists('blogCreateRoute')) {
    function blogCreateRoute($route)
    {
        return blogBaseUrl($route) . '/create';
    }
}

/**
 *
 * Shpuw View Route
 *
 *@param String $route
 *@param Integer $id
 *
 *@return return_type
 *
 */

if (!function_exists('blogShowRoute')) {
    function blogShowRoute($route, $id)
    {
        return blogBaseUrl($route) . '/' . $id;
    }
}

/**
 *
 * Edit View Route
 *
 *@param String $route
 *@param Integer $id
 *
 *@return String
 *
 */
if (!function_exists('blogEditRoute')) {
    function blogEditRoute($route, $id)
    {
        return blogBaseUrl($route) . '/' . $id . '/edit';
    }
}

/**
 *
 *Store Route
 *
 *@param String $route
 *
 *@return String
 *
 */
if (!function_exists('blogStoreRoute')) {
    function blogStoreRoute($route)
    {
        return blogBaseUrl($route);
    }
}

/**
 *
 *Update Route
 *
 *@param String $route
 *@param Integer $id
 *
 *@return String
 *
 */
if (!function_exists('blogUpdateRoute')) {
    function blogUpdateRoute($route, $id)
    {
        return blogBaseUrl($route) . '/' . $id;
    }
}

/**
 *
 *Update Route
 *
 *@param String $route
 *@param Integer $id
 *
 *@return String
 *
 */
if (!function_exists('blogDeleteRoute')) {
    function blogDeleteRoute($route, $id)
    {
        return blogBaseUrl($route) . '/' . $id;
    }
}
