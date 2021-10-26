<?php // Code within app\Helpers\Helper.php

namespace App\Helpers;

/**
 * Nested Tree List display list
 */
class NestedTreeHelper
{
    /**
     * @param $node
     * @param array $result
     * @return array|string
     */
    public static function listDescendants($node, $result = [], $implode = true)
    {
        $result[] = '<ol>';
        foreach ($node->descendants as $child) {
            if ($child->isChildOf($node)) {
                $result[] = '<li id="list_' . $child->id . '" class="mjs-nestedSortable-leaf">';
                $result[] = '<div class="ui-sortable-handle">';
                $result[] = '<i class="fas fa-fw fa-arrows-alt"></i>';
                $result[] = $child->label;
                $result[] = '</div>';
                if (!empty($child->descendants)) {
                    $result = NestedTreeHelper::listDescendants($child, $result, false);
                }
                $result[] = '</li>';
            }
        }
        $result[] = '</ol>';
        return $implode ? implode(PHP_EOL, $result) : $result;
    }

    /**
     * @param array $tree
     * @param int $maxDepth
     * @param int $depth
     * @param int $parentId
     * @return array
     */
    public static function parseData(array $tree, $maxDepth = 4, $depth = 1, $parentId=0)
    {
        $data = [];

        foreach ($tree as $t) {
            if ((int) $t['depth'] === $depth && (int) $t['parent_id'] === $parentId) {
                $item = ['id' => (int) $t['item_id']];
                if ($depth <= $maxDepth) {
                    $children = NestedTreeHelper::parseData($tree,  $maxDepth, $depth + 1, (int) $t['item_id']);
                }
                if (!empty($children)) {
                    $item['children'] = $children;
                }
                $data[] = $item;
            }
        }
        return $data;
    }
}


