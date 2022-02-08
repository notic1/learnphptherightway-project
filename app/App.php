<?php

declare(strict_types=1);

// Your Code

function readFiles($dir)
{
    if (!is_dir($dir)) {
        
        return 'Passed directory does not exists or is a file.';
    }

    $files = scandir($dir);
    $content = [];

    foreach($files as $file) {
        if (is_dir($file)) continue;
        $currentFile = fopen($dir . $file, 'r');
        $keys = fgetcsv($currentFile);
        
        while (($line = fgetcsv($currentFile)) !== false) {
            $content[] = array_combine($keys, $line);
        }
    }

    return $content;
}

function getValues($collection) 
{
    $income = 0;
    $expenses = 0;

    foreach ($collection as $values) {
        $value = str_replace('$', '', $values['Amount']);
        if ((float)$value > 0) {
            $income += (float)$value;
        } else {
            $expenses += (float)$value;
        }
    }

    return [(float)$income, (float)$expenses];
}

function getNet($income, $expenses)
{
    return ($income - $expenses);
}
