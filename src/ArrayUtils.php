<?php
namespace ZenPHP\utils;

class ArrayUtils {
    /**
     * Convert a flat array to tree array
     * @param array $elements
     * @param string $indexKey
     * @param int $parentId
     * @param string $parentKey
     * @param string $childrenKey
     * @return array
     */
    public static function tree(array $elements, $indexKey = 'id', $parentId = 0, $parentKey = 'parent', $childrenKey = 'children') {
        $branch = array();

        foreach ($elements as $element) {
            if ($element[$parentKey] == $parentId) {
                $children = self::tree($elements, $indexKey, $element[$indexKey], $parentKey, $childrenKey);
                if ($children) {
                    $element[$childrenKey] = $children;
                }
                $branch[$element[$indexKey]] = $element;
                unset($elements[$element[$indexKey]]);
            }
        }
        return $branch;
    }

    /**
     * Convert multi-dimensional array to flat
     * @param array $elements
     * @return array
     */
    public static function flat(array $elements) {
        $flat = [];
        $tmp = new \RecursiveIteratorIterator(new \RecursiveArrayIterator($elements));
        foreach($tmp as $v) {
            $flat[] = $v;
        }
        return $flat;
    }
}
