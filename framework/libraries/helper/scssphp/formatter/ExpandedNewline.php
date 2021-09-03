<?php

/**
 * SCSSPHP
 *
 * @copyright 2012-2020 Leaf Corcoran
 *
 * @license http://opensource.org/licenses/MIT MIT
 *
 * @link http://scssphp.github.io/scssphp
 */

namespace TemPlazaFramework\ScssPhp\Formatter;

if(!class_exists('ScssPhp\ScssPhp\Formatter')
    && file_exists(TEMPLAZA_FRAMEWORK_LIBRARY_PATH.'/phpclass/scssphp/src/Formatter.php')){
    require_once TEMPLAZA_FRAMEWORK_LIBRARY_PATH.'/phpclass/scssphp/src/Formatter.php';
}

use ScssPhp\ScssPhp\Formatter;
use ScssPhp\ScssPhp\Formatter\OutputBlock;

/**
 * Expanded formatter
 *
 * @author Leaf Corcoran <leafot@gmail.com>
 *
 * @internal
 */
class ExpandedNewline extends Formatter
{
    /**
     * {@inheritdoc}
     */
    public function __construct()
    {
        $this->indentLevel = 0;
        $this->indentChar = '  ';
        $this->break = "\n";
        $this->open = ' {';
        $this->close = "}\n";
        $this->tagSeparator = ",\n";
        $this->assignSeparator = ': ';
        $this->keepSemicolons = true;
    }

    /**
     * {@inheritdoc}
     */
    protected function indentStr()
    {
        if($this -> indentLevel > 0) {
            $this -> tagSeparator = ",\n  ";
        }else{
            $this->tagSeparator = ",\n";
        }
        return str_repeat($this->indentChar, $this->indentLevel);
    }

    /**
     * {@inheritdoc}
     */
    protected function blockLines(OutputBlock $block)
    {
        $inner = $this->indentStr();

        $glue = $this->break . $inner;

        foreach ($block->lines as $index => $line) {
            if (substr($line, 0, 2) === '/*') {
                $block->lines[$index] = preg_replace('/\r\n?|\n|\f/', $this->break, $line);
            }
        }

        $this->write($inner . implode($glue, $block->lines));

        if (empty($block->selectors) || ! empty($block->children)) {
            $this->write($this->break);
        }
    }
}
