<?php

use SilverStripe\Forms\HTMLEditor\TinyMCEConfig;

require_once 'conf/ConfigureFromEnv.php';

TinyMCEConfig::get('cms')
    ->addButtonsToLine(1, 'styleselect')
    ->setOption('importcss_append', true)
    ->enablePlugins(['hr', 'charmap', 'fullscreen'])
    ->addButtonsToLine(3, ['selectall', 'cut', 'copy', 'blockquote', 'hr', 'charmap', 'fullscreen'])
    ->insertButtonsBefore('paste', ['undo', 'redo']);
TinyMCEConfig::get('cms')->insertButtonsAfter('underline', 'strikethrough');
