<?php
/**
 * Professional Markdown Link Resolver for GitHub Documentation
 * * Logic:
 * 1. Pass 1: Crawl the entire directory to map existing .md files and folders.
 * 2. Pass 2: Iterate through every .md file.
 * 3. Link Processing:
 * - Resolve relative links (../../) and root links (classes/) to absolute disk paths.
 * - Verify existence using the Pass 1 map.
 * - Priority: .md file > directory/ > local namespace fallback.
 */

$baseDir = realpath($argv[1] ?? 'docs/markdown');

if (!$baseDir || !is_dir($baseDir)) {
    die("Error: Documentation directory not found at " . ($argv[1] ?? 'docs/markdown') . "\n");
}

echo "Pass 1: Scanning documentation structure...\n";
$fileMap = [];
$dirMap = [];
$allFiles = new RecursiveIteratorIterator(
    new RecursiveDirectoryIterator($baseDir, RecursiveDirectoryIterator::SKIP_DOTS)
);

foreach ($allFiles as $file) {
    $path = $file->getRealPath();
    if ($file->isDir()) {
        $dirMap[$path] = true;
    } else {
        $fileMap[$path] = true;
        // Also map the directory specifically for faster lookups
        $dirMap[dirname($path)] = true;
    }
}

echo "Pass 2: Processing link conversions...\n";
$mdFiles = new RecursiveIteratorIterator(
    new RecursiveDirectoryIterator($baseDir, RecursiveDirectoryIterator::SKIP_DOTS)
);

$processedCount = 0;
$fixedCount = 0;

foreach ($mdFiles as $file) {
    if ($file->getExtension() !== 'md') continue;

    $filePath = $file->getRealPath();
    $currentFileDir = dirname($filePath);
    $content = file_get_contents($filePath);
    $originalContent = $content;

    // Matches [text](url) - ignores external http/https and anchors starting with #
    $content = preg_replace_callback('/\]\(((?!https?:\/\/|#)[^)]+)\)/', function($matches) use ($currentFileDir, $baseDir, $fileMap, $dirMap) {
        $originalUrl = $matches[1];

        // Standardize: strip .md and trailing slashes for path resolution
        $cleanUrl = preg_replace('/\.md$/', '', rtrim($originalUrl, '/'));

        // Resolve target disk path
        // If it starts with classes/ or ./classes/, resolve from documentation root
        if (preg_match('/^(\.\/)?classes\//', $cleanUrl)) {
            $relativePart = ltrim(preg_replace('/^(\.\/)?classes\//', '', $cleanUrl), '/');
            $targetDiskPath = $baseDir . DIRECTORY_SEPARATOR . 'classes' . DIRECTORY_SEPARATOR . $relativePart;
        } else {
            // Otherwise, resolve relative to the current file's location
            $targetDiskPath = realpath($currentFileDir . DIRECTORY_SEPARATOR . $relativePart = ltrim($cleanUrl, '/'));
            if (!$targetDiskPath) {
                // If realpath fails (common with ../ links to non-existent files), manually construct it
                $targetDiskPath = $currentFileDir . DIRECTORY_SEPARATOR . ltrim($cleanUrl, '/');
            }
        }

        // 1. Check if the exact .md file exists
        $mdPath = $targetDiskPath . '.md';
        if (isset($fileMap[$mdPath]) || file_exists($mdPath)) {
            $newUrl = preg_replace('/(?<!\.md)$/', '.md', $cleanUrl);
            return "]($newUrl)";
        }

        // 2. Check if it is a valid directory
        if (isset($dirMap[$targetDiskPath]) || is_dir($targetDiskPath)) {
            $newUrl = rtrim($cleanUrl, '/') . '/';
            return "]($newUrl)";
        }

        // 3. Fallback for Global PHP Classes (Exception, Throwable, etc.)
        // phpDocumentor often links these to the root /classes/ directory.
        // We force these to link to the current directory to avoid 404s.
        $basePhpClasses = [
            'Exception', 'JsonException', 'RuntimeException', 'Throwable',
            'InvalidArgumentException', 'JsonSerializable', 'DateTimeImmutable',
            'DateTimeInterface', 'DateTime'
        ];

        $urlParts = explode('/', $cleanUrl);
        $className = end($urlParts);

        if (in_array($className, $basePhpClasses)) {
            // Force link to the current folder view on GitHub
            return "](./)";
        }

        // If we can't find it, keep the original to avoid making it worse
        return $matches[0];
    }, $content);

    if ($content !== $originalContent) {
        file_put_contents($filePath, $content);
        $fixedCount++;
    }
    $processedCount++;
}

echo "\nProfessional Link Validation Complete:\n";
echo "- Files Processed: $processedCount\n";
echo "- Files Updated:   $fixedCount\n";
