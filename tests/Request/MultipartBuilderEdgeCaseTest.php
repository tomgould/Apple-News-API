<?php

declare(strict_types=1);

namespace TomGould\AppleNews\Tests\Request;

use TomGould\AppleNews\Request\MultipartBuilder;
use PHPUnit\Framework\TestCase;
use RuntimeException;

/**
 * Edge case tests for MultipartBuilder.
 *
 * Note: The RuntimeException test for unreadable files only works
 * when not running as root, as root can read any file.
 */
final class MultipartBuilderEdgeCaseTest extends TestCase
{
    private string $tempDir;

    protected function setUp(): void
    {
        $this->tempDir = sys_get_temp_dir() . '/apple-news-edge-' . uniqid();
        mkdir($this->tempDir, 0777, true);
    }

    protected function tearDown(): void
    {
        $files = glob($this->tempDir . '/*');
        if ($files) {
            foreach ($files as $file) {
                chmod($file, 0644); // Restore permissions before deleting
                unlink($file);
            }
        }
        rmdir($this->tempDir);
    }

    /**
     * Test that RuntimeException is thrown when file exists but cannot be read.
     *
     * This test is skipped when running as root since root can read any file.
     */
    public function testAddImageFileThrowsRuntimeExceptionForUnreadableFile(): void
    {
        // Skip if running as root (root can read any file)
        if (posix_getuid() === 0) {
            $this->markTestSkipped('Cannot test unreadable files when running as root');
        }

        $filePath = $this->tempDir . '/unreadable.jpg';
        file_put_contents($filePath, 'content');
        chmod($filePath, 0000); // Remove all permissions

        $builder = new MultipartBuilder();

        $this->expectException(RuntimeException::class);
        $this->expectExceptionMessage('Failed to read asset file');

        try {
            $builder->addImageFile('test', $filePath);
        } finally {
            chmod($filePath, 0644); // Restore for cleanup
        }
    }

    /**
     * Alternative test using a directory instead of file (file_get_contents fails on directories).
     */
    public function testAddImageFileWithDirectoryThrowsRuntimeException(): void
    {
        // Create a subdirectory - file_exists returns true but file_get_contents returns false
        $dirPath = $this->tempDir . '/fakefile.jpg';
        mkdir($dirPath);

        $builder = new MultipartBuilder();

        $this->expectException(RuntimeException::class);
        $this->expectExceptionMessage('Failed to read asset file');

        try {
            $builder->addImageFile('test', $dirPath);
        } finally {
            rmdir($dirPath);
        }
    }
}
