<?php
defined('BASEPATH') OR exit('No direct script access allowed');

if (!function_exists('asset_url')) {
  /**
   * [asset_url description]
   * @param [type] $splint   [description]
   * @param string $resource [description]
   */
  function asset_url($resource="") {
    $ci =& get_instance();
    return base_url("splint-assets/{$ci->config->item("splint")}/$resource");
  }
}

if (!function_exists('app_url')) {
  /**
   * [app_url description]
   * @param  string $resource [description]
   * @return [type]           [description]
   */
  function app_url($resource="") {
    $ci =& get_instance();
    return site_url($ci->uri->rsegment(1)."/".$ci->uri->rsegment(2).($ci->uri->segment(2) != null ? "/" : "").$resource);
  }
}

if (!function_exists('get_app_instance')) {
  /**
   * [get_app_instance description]
   * @return [type] [description]
   */
  function &get_app_instance() {
    return SplintAppController::get_instance();
  }
}

if (!function_exists('dd')) {
  /**
   * [dd description]
   * @date   2019-11-23
   * @param  [type]     $var [description]
   * @return [type]          [description]
   */
  function dd($var) {
    var_dump($var);
    exit(EXIT_SUCCESS);
  }
}

if (!function_exists('collect')) {
  /**
   * [collect description]
   * @date   2019-11-02
   * @param  array      $array [description]
   * @return [type]            [description]
   */
  function collect(array $array)
  {
    return null;
  }
}

if (!function_exists('job')) {
  /**
   * [job description]
   * @date   2019-12-03
   * @param  string     $class   [description]
   * @param  array      $rawArgs [description]
   * @return [type]              [description]
   */
  function job(string $class, ...$rawArgs) {
    // TODO: Handle Assoc Args.
    return new AsyncJobDisPatcher($class, ...$rawArgs);
  }
}

if (!function_exists('array_permutate')) {
  function array_permutate(array $items, array $permutations=[], array &$result=[])
  {
    if (empty($items)) {
      $result[] = array_unique($permutations);
    } else {
      for ($x = count($items) - 1; $x >= 0; --$x) {
        $newItems = $items;
        $permutation = $permutations;
        list($tail) = array_splice($newItems, $x, 1);
        array_unshift($permutations, $tail);
        array_permutate($newItems, $permutations, $result);
      }
   }
   return $result;
  }
}

if (!function_exists('cenv')) {
  function cenv(string $key, $default, ?string $config=null)
  {
    if ($config) get_instance()->config->load($config);
    return get_instance()->config->item($key) ?? $default;
  }
}

if (!function_exists('set_config_item')) {
  /**
   * [set_config_item description]
   * @date  2019-12-14
   * @param string     $key   [description]
   * @param [type]     $value [description]
   */
  function set_config_item(string $key, $value):void
  {
    get_instance()->config->set_item($key, $value);
  }
}

if (!function_exists('get_config_item')) {
  /**
   * [get_config_item description]
   * @date   2019-12-14
   * @param  string     $key     [description]
   * @param  [type]     $default [description]
   * @return [type]              [description]
   */
  function get_config_item(string $key, $default)
  {
    return get_instance()->config->item($key) ?? $default;
  }
}

if (!function_exists('event')) {
  function event($event, ...$args):void
  {
    if (is_a($event, 'AppEvent', true)) {
      $listeners = is_string($event) ? get_instance()->config->events[$event] : get_instance()->config->events[get_class($event)];

      $event = is_string($event) ? new $event(...$args) : $event;

      if (is_array($listeners)) {
        $tailData = null;
        $previousListener = null;
        foreach ($listeners as $listener) {
          if (!is_a($listener, 'AppEventListener', true)) {
            throw new Exception("Given Listener does not extend the AppEventListener class.");
          }
          $listenerObj = new $listener($tailData);
          $listenerObj->handle($event);
          $tailData = $listenerObj->getData($previousListener);
          $previousListener = $listener;
        }
        return;
      }

      if (!is_a($listeners, 'AppEventListener', true)) {
        throw new Exception("Given Listener does not extend the AppEventListener class.");
      }
      (new $listeners())->handle($event);

      return;
    }

    throw new Exception('The given event does not extend the AppEvent class.');
  }
}

if (!function_exists('splint_autoload_register')) {
  function splint_autoload_register(string $package)
  {
    spl_autoload_register(function($name) use ($package) {
      if (file_exists(APPPATH."splints/$package/libraries/$name.php")) {
        require(APPPATH."splints/$package/libraries/$name.php");
      }
    });
  }
}
