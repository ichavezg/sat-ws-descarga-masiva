<?php

declare(strict_types=1);

namespace PhpCfdi\SatWsDescargaMasiva\PackageReader;

use Countable;
use JsonSerializable;
use PhpCfdi\SatWsDescargaMasiva\PackageReader\Exceptions\CreateTemporaryZipFileException;
use PhpCfdi\SatWsDescargaMasiva\PackageReader\Exceptions\OpenZipFileException;
use Traversable;

/**
 * Expected behavior of a PackageReader contract
 */
interface PackageReaderInterface extends Countable, JsonSerializable
{
    /**
     * Open a file as a package
     *
     * @param string $filename
     * @return static
     * @throws OpenZipFileException
     */
    public static function createFromFile(string $filename);

    /**
     * Open the given content as a package
     * If it creates a temporary file the file must be removed automatically
     *
     * @param string $content
     * @return static
     * @throws CreateTemporaryZipFileException
     * @throws OpenZipFileException
     */
    public static function createFromContents(string $content);

    /**
     * Traverse each file inside the package, with the filename as key and file content as value
     *
     * @return Traversable<string, string>
     */
    public function fileContents();

    /**
     * Return the number of elements on the package
     *
     * @return int
     */
    public function count(): int;

    /**
     * Retrieve the currently open file name
     *
     * @return string
     */
    public function getFilename(): string;
}
