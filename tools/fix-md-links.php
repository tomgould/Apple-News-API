<?php
/**
 * Fix markdown links missing .md extension
 */
$dir = $argv[1] ?? 'docs/markdown';

$iterator = new RecursiveIteratorIterator(
    new RecursiveDirectoryIterator($dir, RecursiveDirectoryIterator::SKIP_DOTS)
);

foreach ($iterator as $file) {
    if ($file->getExtension() !== 'md') {
        continue;
    }
    
    $content = file_get_contents($file->getPathname());
    $original = $content;
    
    // Fix links like [text](./classes/path/ClassName) -> [text](./classes/path/ClassName.md)
    $content = preg_replace(
        '/\]\((\.\/)?(classes\/[^)]+)(?<!\.md)\)/',
        ']($1$2.md)',
        $content
    );
    
    // Fix relative links like [text](./ClassName) -> [text](./ClassName.md)
    // But avoid external URLs (http/https) and already .md links
    $content = preg_replace(
        '/\]\((\.\/)([A-Z][a-zA-Z0-9_]*)\)/',
        ']($1$2.md)',
        $content
    );
    
    if ($content !== $original) {
        file_put_contents($file->getPathname(), $content);
        echo "Fixed: {$file->getPathname()}\n";
    }
}

echo "Done!\n";
