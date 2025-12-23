<?php
/**
 * Advanced Markdown Link Fixer
 * Logic:
 * 1. Identify relative links in Markdown.
 * 2. Check if the target exists as a .md file.
 * 3. If not, check if it exists as a directory.
 * 4. Update the link accordingly to ensure it works on GitHub.
 */

$baseDir = realpath($argv[1] ?? 'docs/markdown');

if (!$baseDir || !is_dir($baseDir)) {
    echo "Directory not found: " . ($argv[1] ?? 'docs/markdown') . "\n";
    exit(1);
}

$iterator = new RecursiveIteratorIterator(
    new RecursiveDirectoryIterator($baseDir, RecursiveDirectoryIterator::SKIP_DOTS)
);

foreach ($iterator as $file) {
    if ($file->getExtension() !== 'md') continue;

    $filePath = $file->getPathname();
    $currentDir = dirname($filePath);
    $content = file_get_contents($filePath);
    $originalContent = $content;

    // Regex to find Markdown links: [text](url)
    // Excludes external URLs (http/https)
    $content = preg_replace_callback('/\]\((?!https?:\/\/)([^)]+)\)/', function($matches) use ($currentDir, $baseDir) {
        $originalUrl = $matches[1];

        // Remove any existing .md to standardize the search
        $cleanUrl = preg_replace('/\.md$/', '', $originalUrl);

        // Determine the absolute path on disk for the link target
        // If it starts with 'classes/', it's relative to the baseDir, otherwise relative to currentDir
        if (str_starts_with($cleanUrl, 'classes/')) {
            $testPath = $baseDir . DIRECTORY_SEPARATOR . ltrim($cleanUrl, '/');
        } else {
            $testPath = $currentDir . DIRECTORY_SEPARATOR . ltrim($cleanUrl, '/');
        }

        $realPath = realpath($testPath);

        // Case 1: The target exists exactly as a .md file
        if (file_exists($testPath . '.md')) {
            return "]($cleanUrl.md)";
        }

        // Case 2: The target is a directory (GitHub handles this as a folder view)
        if (is_dir($testPath)) {
            return "]($cleanUrl/)";
        }

        // Case 3: Handle the phpDocumentor "best guess" root links (like classes/Exception)
        // If it points to root/classes/Exception and it doesn't exist,
        // link to the directory of the current file instead.
        if (str_contains($cleanUrl, 'classes/') && !file_exists($testPath)) {
            $parts = explode('/', $cleanUrl);
            $className = end($parts);
            return "]($className)"; // Falls back to current directory link
        }

        return $matches[0];
    }, $content);

    if ($content !== $originalContent) {
        file_put_contents($filePath, $content);
        echo "Validated links in: " . str_replace($baseDir, '', $filePath) . "\n";
    }
}

echo "Link validation complete!\n";
