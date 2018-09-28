<?php
/**
 * WPBakery Visual Composer Shortcode mapper
 *
 * @package WPBakeryVisualComposer
 *
 */


class WPBMap
{
    protected static $sc = Array();
    protected static $layouts = Array();
    protected static $categories = Array();
    protected static $user_sc = false;
    protected static $user_categories = false;

    public static function layout($array)
    {
        self::$layouts[] = $array;
    }

    public static function getLayouts()
    {
        return self::$layouts;
    }

  

    public static function map($name, $attributes)
    {
        if (empty($attributes['name'])) {
            trigger_error(sprintf(__("Wrong name for shortcode:%s. Name required", "brad-framework"), $name));
        } elseif (empty($attributes['base'])) {
            trigger_error(sprintf(__("Wrong base for shortcode:%s. Base required", "brad-framework"), $name));
        } else {
            self::$sc[$name] = $attributes;
            self::$sc[$name]['params'] = Array();
            if (!empty($attributes['params'])) {
                $attributes_keys = Array();
                foreach ($attributes['params'] as $attribute) {
                    if ($attribute['type'] === 'loop') {
                        $attribute['value'] = VcLoopSettings::buildDefault($attribute);
                    }
                    $key = array_search($attribute['param_name'], $attributes_keys);
                    if ($key === false) {
                        $attributes_keys[] = $attribute['param_name'];
                        self::$sc[$name]['params'][] = $attribute;
                    } else {
                        self::$sc[$name]['params'][$key] = $attribute;
                    }

                }
            }

            WPBakeryVisualComposer::getInstance()->addShortCodePlugin(self::$sc[$name]);
        }

    }

    public static function generateUserData($force = false)
    {
        if (!$force && self::$user_sc !== false && self::$user_categories !== false) return true;

        self::$user_sc = self::$user_categories = array();
        foreach (self::$sc as $name => $values) {
            
              if ($name != 'vc_column' && (!isset($values['content_element']) || $values['content_element'] === true)) {
                    $categories = isset($values['category']) ? $values['category'] : '_other_category_';
                    $values['_category_ids'] = array();
                    if(is_array($categories)) {
                        foreach($categories as $c) {
                            if (array_search($c, self::$user_categories) === false) self::$user_categories[] = $c;
                            $values['_category_ids'][] = md5($c); // array_search($category, self::$categories);
                        }
                    } else {
                        if (array_search($categories, self::$user_categories) === false) self::$user_categories[] = $categories;
                        $values['_category_ids'][] = md5($categories); // array_search($category, self::$categories);
                    }

                }
                self::$user_sc[$name] = $values;
            }

        
    }

    public static function getShortCodes()
    {
        return self::$sc;
    }

    public static function getUserShortCodes()
    {
        self::generateUserData();
        return self::$user_sc;
    }

    public static function getShortCode($name)
    {
        return self::$sc[$name];
    }

    public static function getCategories()
    {
        return self::$categories;
    }

    public static function getUserCategories()
    {
        self::generateUserData();
        return self::$user_categories;
    }

    public static function dropParam($name, $attribute_name)
    {
        foreach (self::$sc[$name]['params'] as $index => $param) {
            if ($param['param_name'] == $attribute_name) {
                unset(self::$sc[$name]['params'][$index]);
                return;
            }
        }
    }

    /**
     * Returns param settings
     * @static
     * @param $tag
     * @param $param_name
     */
    public static function getParam($tag, $param_name) {
        if (!isset(self::$sc[$tag]))
            return trigger_error(sprintf(__("Wrong name for shortcode:%s. Name required", "brad-framework"), $tag));
        foreach (self::$sc[$tag]['params'] as $index => $param) {
            if ($param['param_name'] == $param_name) {
                return self::$sc[$tag]['params'][$index];
            }
        }
        return false;
    }
    /* Extend params for settings */
    public static function addParam($name, $attribute = Array())
    {
        if (!isset(self::$sc[$name]))
            return trigger_error(sprintf(__("Wrong name for shortcode:%s. Name required", "brad-framework"), $name));
        elseif (!isset($attribute['param_name'])) {
            trigger_error(sprintf(__("Wrong attribute for '%s' shortcode. Attribute 'param_name' required", "brad-framework"), $name));
        } else {

            $replaced = false;

            foreach (self::$sc[$name]['params'] as $index => $param) {
                if ($param['param_name'] == $attribute['param_name']) {
                    $replaced = true;
                    self::$sc[$name]['params'][$index] = $attribute;
                }
            }

            if ($replaced === false) self::$sc[$name]['params'][] = $attribute;

            WPBakeryVisualComposer::getInstance()->addShortCodePlugin(self::$sc[$name]);
        }
    }

    /* Extend params for settings */
    public static function mutateParam($name, $attribute = Array())
    {
        if (!isset(self::$sc[$name]))
            return trigger_error(sprintf(__("Wrong name for shortcode:%s. Name required", "brad-framework"), $name));
        elseif (!isset($attribute['param_name'])) {
            trigger_error(sprintf(__("Wrong attribute for '%s' shortcode. Attribute 'param_name' required", "brad-framework"), $name));
        } else {

            $replaced = false;

            foreach (self::$sc[$name]['params'] as $index => $param) {
                if ($param['param_name'] == $attribute['param_name']) {
                    $replaced = true;
                    self::$sc[$name]['params'][$index] = $attribute;
                }
            }

            if ($replaced === false) self::$sc[$name]['params'][] = $attribute;

            WPBakeryVisualComposer::getInstance()->addShortCodePlugin(self::$sc[$name]);
        }
    }
    public static function dropShortcode($name)
    {
        unset(self::$sc[$name]);
        WPBakeryVisualComposer::getInstance()->removeShortCode($name);

    }

    /**
     * Modify shortcode's mapped settings.
     * You can modify only one option of the group options.
     * Call this method with $settings_name param as associated array to mass modifications.
     *
     * @static
     * @param $name - shortcode' name.
     * @param $setting_name - option key name or the array of options.
     * @param $value - value of settings if $setting_name is option key.
     * @return array|bool
     */
    public static function modify($name, $setting_name, $value = '')
    {
        if (!isset(self::$sc[$name]))
            return trigger_error(sprintf(__("Wrong name for shortcode:%s. Name required", "brad-framework"), $name));
        elseif ($setting_name === 'base') {
            return trigger_error(sprintf(__("Wrong setting_name for shortcode:%s. Base can't be modified.", "brad-framework"), $name));
        }
        if (is_array($setting_name)) {
            foreach ($setting_name as $key => $value) {
                self::modify($name, $key, $value);
            }
        } else {
            self::$sc[$name][$setting_name] = $value;
        }
        return self::$sc;
    }

}