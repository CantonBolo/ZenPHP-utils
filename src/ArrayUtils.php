<?php
namespace php\utils;

class ArrayUtils extends \ArrayObject {
    /**
     * Convert a flat array to tree array
     * @param array $elements
     * @param string $indexKey
     * @param int $parentId
     * @param string $parentKey
     * @param string $childrenKey
     * @return array
     */
    public function tree(array $elements, $indexKey = 'id', $parentId = 0, $parentKey = 'parent', $childrenKey = 'children') {
        $branch = array();

        foreach ($elements as $element) {
            if ($element[$parentKey] == $parentId) {
                $children = self::tree($elements, $indexKey, $element[$indexKey], $parentKey, $childrenKey);
                if ($children) {
                    $element[$childrenKey] = $children;
                }
                $branch[$element['id']] = $element;
                unset($elements[$element['id']]);
            }
        }
        return $branch;
    }
}
