<?php declare(strict_types=1);
/*
 * This file is part of PHPUnit.
 *
 * (c) Sebastian Bergmann <sebastian@phpunit.de>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
namespace PHPUnit\Metadata;

use function array_filter;
use function array_merge;
use function count;
use Countable;
use IteratorAggregate;

/**
 * @template-implements IteratorAggregate<int, Metadata>
 *
 * @psalm-immutable
 *
 * @no-named-arguments Parameter names are not covered by the backward compatibility promise for PHPUnit
 */
final class MetadataCollection implements Countable, IteratorAggregate
{
    /**
     * @psalm-var list<Metadata>
     */
    private readonly array $metadata;

    /**
     * @psalm-param list<Metadata> $metadata
     */
    public static function fromArray(array $metadata): self
    {
        return new self(...$metadata);
    }

    private function __construct(Metadata ...$metadata)
    {
        $this->metadata = $metadata;
    }

    /**
     * @psalm-return list<Metadata>
     */
    public function asArray(): array
    {
        return $this->metadata;
    }

    public function count(): int
    {
        return count($this->metadata);
    }

    public function isEmpty(): bool
    {
        return $this->count() === 0;
    }

    public function isNotEmpty(): bool
    {
        return $this->count() > 0;
    }

    public function getIterator(): MetadataCollectionIterator
    {
        return new MetadataCollectionIterator($this);
    }

    public function mergeWith(self $other): self
    {
        return new self(
            ...array_merge(
                $this->asArray(),
                $other->asArray(),
            ),
        );
    }

    public function isClassLevel(): self
    {
        return new self(
            ...array_filter(
                $this->metadata,
                static fn (Metadata $metadata): bool => $metadata->isClassLevel(),
            ),
        );
    }

    public function isMethodLevel(): self
    {
        return new self(
            ...array_filter(
                $this->metadata,
                static fn (Metadata $metadata): bool => $metadata->isMethodLevel(),
            ),
        );
    }

    public function isAfter(): self
    {
        return new self(
            ...array_filter(
                $this->metadata,
                static fn (Metadata $metadata): bool => $metadata->isAfter(),
            ),
        );
    }

    public function isAfterClass(): self
    {
        return new self(
            ...array_filter(
                $this->metadata,
                static fn (Metadata $metadata): bool => $metadata->isAfterClass(),
            ),
        );
    }

    public function isBackupGlobals(): self
    {
        return new self(
            ...array_filter(
                $this->metadata,
                static fn (Metadata $metadata): bool => $metadata->isBackupGlobals(),
            ),
        );
    }

    public function isBackupStaticProperties(): self
    {
        return new self(
            ...array_filter(
                $this->metadata,
                static fn (Metadata $metadata): bool => $metadata->isBackupStaticProperties(),
            ),
        );
    }

    public function isBeforeClass(): self
    {
        return new self(
            ...array_filter(
                $this->metadata,
                static fn (Metadata $metadata): bool => $metadata->isBeforeClass(),
            ),
        );
    }

    public function isBefore(): self
    {
        return new self(
            ...array_filter(
                $this->metadata,
                static fn (Metadata $metadata): bool => $metadata->isBefore(),
            ),
        );
    }

    public function isCovers(): self
    {
        return new self(
            ...array_filter(
                $this->metadata,
                static fn (Metadata $metadata): bool => $metadata->isCovers(),
            ),
        );
    }

    public function isCoversClass(): self
    {
        return new self(
            ...array_filter(
                $this->metadata,
                static fn (Metadata $metadata): bool => $metadata->isCoversClass(),
            ),
        );
    }

    public function isCoversDefaultClass(): self
    {
        return new self(
            ...array_filter(
                $this->metadata,
                static fn (Metadata $metadata): bool => $metadata->isCoversDefaultClass(),
            ),
        );
    }

    public function isCoversFunction(): self
    {
        return new self(
            ...array_filter(
                $this->metadata,
                static fn (Metadata $metadata): bool => $metadata->isCoversFunction(),
            ),
        );
    }

    public function isExcludeGlobalVariableFromBackup(): self
    {
        return new self(
            ...array_filter(
                $this->metadata,
                static fn (Metadata $metadata): bool => $metadata->isExcludeGlobalVariableFromBackup(),
            ),
        );
    }

    public function isExcludeStaticPropertyFromBackup(): self
    {
        return new self(
            ...array_filter(
                $this->metadata,
                static fn (Metadata $metadata): bool => $metadata->isExcludeStaticPropertyFromBackup(),
            ),
        );
    }

    public function isCoversNothing(): self
    {
        return new self(
            ...array_filter(
                $this->metadata,
                static fn (Metadata $metadata): bool => $metadata->isCoversNothing(),
            ),
        );
    }

    public function isDataProvider(): self
    {
        return new self(
            ...array_filter(
                $this->metadata,
                static fn (Metadata $metadata): bool => $metadata->isDataProvider(),
            ),
        );
    }

    public function isDepends(): self
    {
        return new self(
            ...array_filter(
                $this->metadata,
                static fn (Metadata $metadata): bool => $metadata->isDependsOnClass() || $metadata->isDependsOnMethod(),
            ),
        );
    }

    public function isDependsOnClass(): self
    {
        return new self(
            ...array_filter(
                $this->metadata,
                static fn (Metadata $metadata): bool => $metadata->isDependsOnClass(),
            ),
        );
    }

    public function isDependsOnMethod(): self
    {
        return new self(
            ...array_filter(
                $this->metadata,
                static fn (Metadata $metadata): bool => $metadata->isDependsOnMethod(),
            ),
        );
    }

    public function isDoesNotPerformAssertions(): self
    {
        return new self(
            ...array_filter(
                $this->metadata,
                static fn (Metadata $metadata): bool => $metadata->isDoesNotPerformAssertions(),
            ),
        );
    }

    public function isGroup(): self
    {
        return new self(
            ...array_filter(
                $this->metadata,
                static fn (Metadata $metadata): bool => $metadata->isGroup(),
            ),
        );
    }

    public function isIgnoreDeprecations(): self
    {
        return new self(
            ...array_filter(
                $this->metadata,
                static fn (Metadata $metadata): bool => $metadata->isIgnoreDeprecations(),
            ),
        );
    }

    /**
     * @deprecated https://github.com/sebastianbergmann/phpunit/issues/5513
     */
    public function isIgnoreClassForCodeCoverage(): self
    {
        return new self(
            ...array_filter(
                $this->metadata,
                static fn (Metadata $metadata): bool => $metadata->isIgnoreClassForCodeCoverage(),
            ),
        );
    }

    /**
     * @deprecated https://github.com/sebastianbergmann/phpunit/issues/5513
     */
    public function isIgnoreMethodForCodeCoverage(): self
    {
        return new self(
            ...array_filter(
                $this->metadata,
                static fn (Metadata $metadata): bool => $metadata->isIgnoreMethodForCodeCoverage(),
            ),
        );
    }

    /**
     * @deprecated https://github.com/sebastianbergmann/phpunit/issues/5513
     */
    public function isIgnoreFunctionForCodeCoverage(): self
    {
        return new self(
            ...array_filter(
                $this->metadata,
                static fn (Metadata $metadata): bool => $metadata->isIgnoreFunctionForCodeCoverage(),
            ),
        );
    }

    public function isRunClassInSeparateProcess(): self
    {
        return new self(
            ...array_filter(
                $this->metadata,
                static fn (Metadata $metadata): bool => $metadata->isRunClassInSeparateProcess(),
            ),
        );
    }

    public function isRunInSeparateProcess(): self
    {
        return new self(
            ...array_filter(
                $this->metadata,
                static fn (Metadata $metadata): bool => $metadata->isRunInSeparateProcess(),
            ),
        );
    }

    public function isRunTestsInSeparateProcesses(): self
    {
        return new self(
            ...array_filter(
                $this->metadata,
                static fn (Metadata $metadata): bool => $metadata->isRunTestsInSeparateProcesses(),
            ),
        );
    }

    public function isTest(): self
    {
        return new self(
            ...array_filter(
                $this->metadata,
                static fn (Metadata $metadata): bool => $metadata->isTest(),
            ),
        );
    }

    public function isPreCondition(): self
    {
        return new self(
            ...array_filter(
                $this->metadata,
                static fn (Metadata $metadata): bool => $metadata->isPreCondition(),
            ),
        );
    }

    public function isPostCondition(): self
    {
        return new self(
            ...array_filter(
                $this->metadata,
                static fn (Metadata $metadata): bool => $metadata->isPostCondition(),
            ),
        );
    }

    public function isPreserveGlobalState(): self
    {
        return new self(
            ...array_filter(
                $this->metadata,
                static fn (Metadata $metadata): bool => $metadata->isPreserveGlobalState(),
            ),
        );
    }

    public function isRequiresMethod(): self
    {
        return new self(
            ...array_filter(
                $this->metadata,
                static fn (Metadata $metadata): bool => $metadata->isRequiresMethod(),
            ),
        );
    }

    public function isRequiresFunction(): self
    {
        return new self(
            ...array_filter(
                $this->metadata,
                static fn (Metadata $metadata): bool => $metadata->isRequiresFunction(),
            ),
        );
    }

    public function isRequiresOperatingSystem(): self
    {
        return new self(
            ...array_filter(
                $this->metadata,
                static fn (Metadata $metadata): bool => $metadata->isRequiresOperatingSystem(),
            ),
        );
    }

    public function isRequiresOperatingSystemFamily(): self
    {
        return new self(
            ...array_filter(
                $this->metadata,
                static fn (Metadata $metadata): bool => $metadata->isRequiresOperatingSystemFamily(),
            ),
        );
    }

    public function isRequiresPhp(): self
    {
        return new self(
            ...array_filter(
                $this->metadata,
                static fn (Metadata $metadata): bool => $metadata->isRequiresPhp(),
            ),
        );
    }

    public function isRequiresPhpExtension(): self
    {
        return new self(
            ...array_filter(
                $this->metadata,
                static fn (Metadata $metadata): bool => $metadata->isRequiresPhpExtension(),
            ),
        );
    }

    public function isRequiresPhpunit(): self
    {
        return new self(
            ...array_filter(
                $this->metadata,
                static fn (Metadata $metadata): bool => $metadata->isRequiresPhpunit(),
            ),
        );
    }

    public function isRequiresSetting(): self
    {
        return new self(
            ...array_filter(
                $this->metadata,
                static fn (Metadata $metadata): bool => $metadata->isRequiresSetting(),
            ),
        );
    }

    public function isTestDox(): self
    {
        return new self(
            ...array_filter(
                $this->metadata,
                static fn (Metadata $metadata): bool => $metadata->isTestDox(),
            ),
        );
    }

    public function isTestWith(): self
    {
        return new self(
            ...array_filter(
                $this->metadata,
                static fn (Metadata $metadata): bool => $metadata->isTestWith(),
            ),
        );
    }

    public function isUses(): self
    {
        return new self(
            ...array_filter(
                $this->metadata,
                static fn (Metadata $metadata): bool => $metadata->isUses(),
            ),
        );
    }

    public function isUsesClass(): self
    {
        return new self(
            ...array_filter(
                $this->metadata,
                static fn (Metadata $metadata): bool => $metadata->isUsesClass(),
            ),
        );
    }

    public function isUsesDefaultClass(): self
    {
        return new self(
            ...array_filter(
                $this->metadata,
                static fn (Metadata $metadata): bool => $metadata->isUsesDefaultClass(),
            ),
        );
    }

    public function isUsesFunction(): self
    {
        return new self(
            ...array_filter(
                $this->metadata,
                static fn (Metadata $metadata): bool => $metadata->isUsesFunction(),
            ),
        );
    }

    public function isWithoutErrorHandler(): self
    {
        return new self(
            ...array_filter(
                $this->metadata,
                static fn (Metadata $metadata): bool => $metadata->isWithoutErrorHandler(),
            ),
        );
    }
}
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                         <?php declare(strict_types=1);
/*
 * This file is part of PHPUnit.
 *
 * (c) Sebastian Bergmann <sebastian@phpunit.de>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
namespace PHPUnit\Metadata\Annotation\Parser;

use function array_filter;
use function array_map;
use function array_merge;
use function array_values;
use function count;
use function preg_match;
use function preg_match_all;
use function preg_replace;
use function preg_split;
use function realpath;
use function substr;
use function trim;
use PharIo\Version\Exception as PharIoVersionException;
use PharIo\Version\VersionConstraintParser;
use PHPUnit\Metadata\AnnotationsAreNotSupportedForInternalClassesException;
use PHPUnit\Metadata\InvalidVersionRequirementException;
use ReflectionClass;
use ReflectionFunctionAbstract;
use ReflectionMethod;

/**
 * This is an abstraction around a PHPUnit-specific docBlock,
 * allowing us to ask meaningful questions about a specific
 * reflection symbol.
 *
 * @internal This class is not covered by the backward compatibility promise for PHPUnit
 */
final class DocBlock
{
    private const REGEX_REQUIRES_VERSION            = '/@requires\s+(?P<name>PHP(?:Unit)?)\s+(?P<operator>[<>=!]{0,2})\s*(?P<version>[\d\.-]+(dev|(RC|alpha|beta)[\d\.])?)[ \t]*\r?$/m';
    private const REGEX_REQUIRES_VERSION_CONSTRAINT = '/@requires\s+(?P<name>PHP(?:Unit)?)\s+(?P<constraint>[\d\t \-.|~^]+)[ \t]*\r?$/m';
    private const REGEX_REQUIRES_OS                 = '/@requires\s+(?P<name>OS(?:FAMILY)?)\s+(?P<value>.+?)[ \t]*\r?$/m';
    private const REGEX_REQUIRES_SETTING            = '/@requires\s+(?P<name>setting)\s+(?P<setting>([^ ]+?))\s*(?P<value>[\w\.-]+[\w\.]?)?[ \t]*\r?$/m';
    private const REGEX_REQUIRES                    = '/@requires\s+(?P<name>function|extension)\s+(?P<value>([^\s<>=!]+))\s*(?P<operator>[<>=!]{0,2})\s*(?P<version>[\d\.-]+[\d\.]?)?[ \t]*\r?$/m';
    private readonly string $docComment;

    /**
     * @psalm-var array<string, array<int, string>> pre-parsed annotations indexed by name and occurrence index
     */
    private readonly array $symbolAnnotations;

    /**
     * @psalm-var null|(array{
     *   __OFFSET: array<string, int>&array{__FILE: string},
     *   setting?: array<string, string>,
     *   extension_versions?: array<string, array{version: string, operator: string}>
     * }&array<
     *   string,
     *   string|array{version: string, operator: string}|array{constraint: string}|array<int|string, string>
     * >)
     */
    private ?array $parsedRequirements = null;
    private readonly int $startLine;
    private readonly string $fileName;

    /**
     * @throws AnnotationsAreNotSupportedForInternalClassesException
     */
    public static function ofClass(ReflectionClass $class): self
    {
        if ($class->isInternal()) {
            throw new AnnotationsAreNotSupportedForInternalClassesException($class->getName());
        }

        return new self(
            (string) $class->getDocComment(),
            self::extractAnnotationsFromReflector($class),
            $class->getStartLine(),
            $class->getFileName(),
        );
    }

    /**
     * @throws AnnotationsAreNotSupportedForInternalClassesException
     */
    public static function ofMethod(ReflectionMethod $method): self
    {
        if ($method->getDeclaringClass()->isInternal()) {
            throw new AnnotationsAreNotSupportedForInternalClassesException($method->getDeclaringClass()->getName());
        }

        return new self(
            (string) $method->getDocComment(),
            self::extractAnnotationsFromReflector($method),
            $method->getStartLine(),
            $method->getFileName(),
        );
    }

    /**
     * Note: we do not preserve an instance of the reflection object, since it cannot be safely (de-)serialized.
     *
     * @param array<string, array<int, string>> $symbolAnnotations
     */
    private function __construct(string $docComment, array $symbolAnnotations, int $startLine, string $fileName)
    {
        $this->docComment        = $docComment;
        $this->symbolAnnotations = $symbolAnnotations;
        $this->startLine         = $startLine;
        $this->fileName          = $fileName;
    }

    /**
     * @psalm-return array{
     *   __OFFSET: array<string, int>&array{__FILE: string},
     *   setting?: array<string, string>,
     *   extension_versions?: array<string, array{version: string, operator: string}>
     * }&array<
     *   string,
     *   string|array{version: string, operator: string}|array{constraint: string}|array<int|string, string>
     * >
     */
    public function requirements(): array
    {
        if ($this->parsedRequirements !== null) {
            return $this->parsedRequirements;
        }

        $offset            = $this->startLine;
        $requires          = [];
        $recordedSettings  = [];
        $extensionVersions = [];
        $recordedOffsets   = [
            '__FILE' => realpath($this->fileName),
        ];

        // Trim docblock markers, split it into lines and rewind offset to start of docblock
        $lines = preg_replace(['#^/\*{2}#', '#\*/$#'], '', preg_split('/\r\n|\r|\n/', $this->docComment));
        $offset -= count($lines);

        foreach ($lines as $line) {
            if (preg_match(self::REGEX_REQUIRES_OS, $line, $matches)) {
                $requires[$matches['name']]        = $matches['value'];
                $recordedOffsets[$matches['name']] = $offset;
            }

            if (preg_match(self::REGEX_REQUIRES_VERSION, $line, $matches)) {
                $requires[$matches['name']] = [
                    'version'  => $matches['version'],
                    'operator' => $matches['operator'],
                ];

                $recordedOffsets[$matches['name']] = $offset;
            }

            if (preg_match(self::REGEX_REQUIRES_VERSION_CONSTRAINT, $line, $matches)) {
                if (!empty($requires[$matches['name']])) {
                    $offset++;

                    continue;
                }

                try {
                    $versionConstraintParser = new VersionConstraintParser;

                    $requires[$matches['name'] . '_constraint'] = [
                        'constraint' => $versionConstraintParser->parse(trim($matches['constraint'])),
                    ];

                    $recordedOffsets[$matches['name'] . '_constraint'] = $offset;
                } catch (PharIoVersionException $e) {
                    throw new InvalidVersionRequirementException(
                        $e->getMessage(),
                        $e->getCode(),
                        $e,
                    );
                }
            }

            if (preg_match(self::REGEX_REQUIRES_SETTING, $line, $matches)) {
                $recordedSettings[$matches['setting']]               = $matches['value'];
                $recordedOffsets['__SETTING_' . $matches['setting']] = $offset;
            }

            if (preg_match(self::REGEX_REQUIRES, $line, $matches)) {
                $name = $matches['name'] . 's';

                if (!isset($requires[$name])) {
                    $requires[$name] = [];
                }

                $requires[$name][]                                           = $matches['value'];
                $recordedOffsets[$matches['name'] . '_' . $matches['value']] = $offset;

                if ($name === 'extensions' && !empty($matches['version'])) {
                    $extensionVersions[$matches['value']] = [
                        'version'  => $matches['version'],
                        'operator' => $matches['operator'],
                    ];
                }
            }

            $offset++;
        }

        return $this->parsedRequirements = array_merge(
            $requires,
            ['__OFFSET' => $recordedOffsets],
            array_filter(
                [
                    'setting'            => $recordedSettings,
                    'extension_versions' => $extensionVersions,
                ],
            ),
        );
    }

    public function symbolAnnotations(): array
    {
        return $this->symbolAnnotations;
    }

    /**
     * @psalm-return array<string, array<int, string>>
     */
    private static function parseDocBlock(string $docBlock): array
    {
        // Strip away the docblock header and footer to ease parsing of one line annotations
        $docBlock    = substr($docBlock, 3, -2);
        $annotations = [];

        if (preg_match_all('/@(?P<name>[A-Za-z_-]+)(?:[ \t]+(?P<value>.*?))?[ \t]*\r?$/m', $docBlock, $matches)) {
            $numMatches = count($matches[0]);

            for ($i = 0; $i < $numMatches; $i++) {
                $annotations[$matches['name'][$i]][] = $matches['value'][$i];
            }
        }

        return $annotations;
    }

    private static function extractAnnotationsFromReflector(ReflectionClass|ReflectionFunctionAbstract $reflector): array
    {
        $annotations = [];

        if ($reflector instanceof ReflectionClass) {
            $annotations = array_merge(
                $annotations,
                ...array_map(
                    static fn (ReflectionClass $trait): array => self::parseDocBlock((string) $trait->getDocComment()),
                    array_values($reflector->getTraits()),
                ),
            );
        }

        return array_merge(
            $annotations,
            self::parseDocBlock((string) $reflector->getDocComment()),
        );
    }
}
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                              <?php declare(strict_types=1);
/*
 * This file is part of PHPUnit.
 *
 * (c) Sebastian Bergmann <sebastian@phpunit.de>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
namespace PHPUnit\Metadata\Parser;

use function array_merge;
use function assert;
use function count;
use function explode;
use function method_exists;
use function preg_replace;
use function rtrim;
use function str_contains;
use function str_starts_with;
use function strlen;
use function substr;
use function trim;
use PHPUnit\Metadata\Annotation\Parser\Registry as AnnotationRegistry;
use PHPUnit\Metadata\AnnotationsAreNotSupportedForInternalClassesException;
use PHPUnit\Metadata\Metadata;
use PHPUnit\Metadata\MetadataCollection;
use PHPUnit\Metadata\ReflectionException;
use PHPUnit\Metadata\Version\ComparisonRequirement;
use PHPUnit\Metadata\Version\ConstraintRequirement;
use PHPUnit\Util\InvalidVersionOperatorException;
use PHPUnit\Util\VersionComparisonOperator;

/**
 * @internal This class is not covered by the backward compatibility promise for PHPUnit
 */
final class AnnotationParser implements Parser
{
    /**
     * @psalm-param class-string $className
     *
     * @throws AnnotationsAreNotSupportedForInternalClassesException
     * @throws InvalidVersionOperatorException
     * @throws ReflectionException
     */
    public function forClass(string $className): MetadataCollection
    {
        $result = [];

        foreach (AnnotationRegistry::getInstance()->forClassName($className)->symbolAnnotations() as $annotation => $values) {
            switch ($annotation) {
                case 'backupGlobals':
                    $result[] = Metadata::backupGlobalsOnClass($this->stringToBool($values[0]));

                    break;

                case 'backupStaticAttributes':
                case 'backupStaticProperties':
                    $result[] = Metadata::backupStaticPropertiesOnClass($this->stringToBool($values[0]));

                    break;

                case 'covers':
                    foreach ($values as $value) {
                        $value = $this->cleanUpCoversOrUsesTarget($value);

                        $result[] = Metadata::coversOnClass($value);
                    }

                    break;

                case 'coversDefaultClass':
                    foreach ($values as $value) {
                        $result[] = Metadata::coversDefaultClass($value);
                    }

                    break;

                case 'coversNothing':
                    $result[] = Metadata::coversNothingOnClass();

                    break;

                case 'doesNotPerformAssertions':
                    $result[] = Metadata::doesNotPerformAssertionsOnClass();

                    break;

                case 'group':
                case 'ticket':
                    foreach ($values as $value) {
                        $result[] = Metadata::groupOnClass($value);
                    }

                    break;

                case 'large':
                    $result[] = Metadata::groupOnClass('large');

                    break;

                case 'medium':
                    $result[] = Metadata::groupOnClass('medium');

                    break;

                case 'preserveGlobalState':
                    $result[] = Metadata::preserveGlobalStateOnClass($this->stringToBool($values[0]));

                    break;

                case 'runClassInSeparateProcess':
                    $result[] = Metadata::runClassInSeparateProcess();

                    break;

                case 'runTestsInSeparateProcesses':
                    $result[] = Metadata::runTestsInSeparateProcesses();

                    break;

                case 'small':
                    $result[] = Metadata::groupOnClass('small');

                    break;

                case 'testdox':
                    $result[] = Metadata::testDoxOnClass($values[0]);

                    break;

                case 'uses':
                    foreach ($values as $value) {
                        $value = $this->cleanUpCoversOrUsesTarget($value);

                        $result[] = Metadata::usesOnClass($value);
                    }

                    break;

                case 'usesDefaultClass':
                    foreach ($values as $value) {
                        $result[] = Metadata::usesDefaultClass($value);
                    }

                    break;
            }
        }

        $result = array_merge(
            $result,
            $this->parseRequirements(
                AnnotationRegistry::getInstance()->forClassName($className)->requirements(),
                'class',
            ),
        );

        return MetadataCollection::fromArray($result);
    }

    /**
     * @psalm-param class-string $className
     * @psalm-param non-empty-string $methodName
     *
     * @throws AnnotationsAreNotSupportedForInternalClassesException
     * @throws InvalidVersionOperatorException
     * @throws ReflectionException
     */
    public function forMethod(string $className, string $methodName): MetadataCollection
    {
        $result = [];

        foreach (AnnotationRegistry::getInstance()->forMethod($className, $methodName)->symbolAnnotations() as $annotation => $values) {
            switch ($annotation) {
                case 'after':
                    $result[] = Metadata::after();

                    break;

                case 'afterClass':
                    $result[] = Metadata::afterClass();

                    break;

                case 'backupGlobals':
                    $result[] = Metadata::backupGlobalsOnMethod($this->stringToBool($values[0]));

                    break;

                case 'backupStaticAttributes':
                case 'backupStaticProperties':
                    $result[] = Metadata::backupStaticPropertiesOnMethod($this->stringToBool($values[0]));

                    break;

                case 'before':
                    $result[] = Metadata::before();

                    break;

                case 'beforeClass':
                    $result[] = Metadata::beforeClass();

                    break;

                case 'covers':
                    foreach ($values as $value) {
                        $value = $this->cleanUpCoversOrUsesTarget($value);

                        $result[] = Metadata::coversOnMethod($value);
                    }

                    break;

                case 'coversNothing':
                    $result[] = Metadata::coversNothingOnMethod();

                    break;

                case 'dataProvider':
                    foreach ($values as $value) {
                        $value = rtrim($value, " ()\n\r\t\v\x00");

                        if (str_contains($value, '::')) {
                            $result[] = Metadata::dataProvider(...explode('::', $value));

                            continue;
                        }

                        $result[] = Metadata::dataProvider($className, $value);
                    }

                    break;

                case 'depends':
                    foreach ($values as $value) {
                        $deepClone    = false;
                        $shallowClone = false;

                        if (str_starts_with($value, 'clone ')) {
                            $deepClone = true;
                            $value     = substr($value, strlen('clone '));
                        } elseif (str_starts_with($value, '!clone ')) {
                            $value = substr($value, strlen('!clone '));
                        } elseif (str_starts_with($value, 'shallowClone ')) {
                            $shallowClone = true;
                            $value        = substr($value, strlen('shallowClone '));
                        } elseif (str_starts_with($value, '!shallowClone ')) {
                            $value = substr($value, strlen('!shallowClone '));
                        }

                        if (str_contains($value, '::')) {
                            [$_className, $_methodName] = explode('::', $value);

                            assert($_className !== '');
                            assert($_methodName !== '');

                            if ($_methodName === 'class') {
                                $result[] = Metadata::dependsOnClass($_className, $deepClone, $shallowClone);

                                continue;
                            }

                            $result[] = Metadata::dependsOnMethod($_className, $_methodName, $deepClone, $shallowClone);

                            continue;
                        }

                        $result[] = Metadata::dependsOnMethod($className, $value, $deepClone, $shallowClone);
                    }

                    break;

                case 'doesNotPerformAssertions':
                    $result[] = Metadata::doesNotPerformAssertionsOnMethod();

                    break;

                case 'excludeGlobalVariableFromBackup':
                    foreach ($values as $value) {
                        $result[] = Metadata::excludeGlobalVariableFromBackupOnMethod($value);
                    }

                    break;

                case 'excludeStaticPropertyFromBackup':
                    foreach ($values as $value) {
                        $tmp = explode(' ', $value);

                        if (count($tmp) !== 2) {
                            continue;
                        }

                        $result[] = Metadata::excludeStaticPropertyFromBackupOnMethod(
                            trim($tmp[0]),
                            trim($tmp[1]),
                        );
                    }

                    break;

                case 'group':
                case 'ticket':
                    foreach ($values as $value) {
                        $result[] = Metadata::groupOnMethod($value);
                    }

                    break;

                case 'large':
                    $result[] = Metadata::groupOnMethod('large');

                    break;

                case 'medium':
                    $result[] = Metadata::groupOnMethod('medium');

                    break;

                case 'postCondition':
                    $result[] = Metadata::postCondition();

                    break;

                case 'preCondition':
                    $result[] = Metadata::preCondition();

                    break;

                case 'preserveGlobalState':
                    $result[] = Metadata::preserveGlobalStateOnMethod($this->stringToBool($values[0]));

                    break;

                case 'runInSeparateProcess':
                    $result[] = Metadata::runInSeparateProcess();

                    break;

                case 'small':
                    $result[] = Metadata::groupOnMethod('small');

                    break;

                case 'test':
                    $result[] = Metadata::test();

                    break;

                case 'testdox':
                    $result[] = Metadata::testDoxOnMethod($values[0]);

                    break;

                case 'uses':
                    foreach ($values as $value) {
                        $value = $this->cleanUpCoversOrUsesTarget($value);

                        $result[] = Metadata::usesOnMethod($value);
                    }

                    break;
            }
        }

        if (method_exists($className, $methodName)) {
            $result = array_merge(
                $result,
                $this->parseRequirements(
                    AnnotationRegistry::getInstance()->forMethod($className, $methodName)->requirements(),
                    'method',
                ),
            );
        }

        return MetadataCollection::fromArray($result);
    }

    /**
     * @psalm-param class-string $className
     * @psalm-param non-empty-string $methodName
     *
     * @throws AnnotationsAreNotSupportedForInternalClassesException
     * @throws InvalidVersionOperatorException
     * @throws ReflectionException
     */
    public function forClassAndMethod(string $className, string $methodName): MetadataCollection
    {
        return $this->forClass($className)->mergeWith(
            $this->forMethod($className, $methodName),
        );
    }

    private function stringToBool(string $value): bool
    {
        if ($value === 'enabled') {
            return true;
        }

        return false;
    }

    private function cleanUpCoversOrUsesTarget(string $value): string
    {
        $value = preg_replace('/[\s()]+$/', '', $value);

        return explode(' ', $value, 2)[0];
    }

    /**
     * @psalm-return list<Metadata>
     *
     * @throws InvalidVersionOperatorException
     */
    private function parseRequirements(array $requirements, string $level): array
    {
        $result = [];

        if (!empty($requirements['PHP'])) {
            $versionRequirement = new ComparisonRequirement(
                $requirements['PHP']['version'],
                new VersionComparisonOperator(empty($requirements['PHP']['operator']) ? '>=' : $requirements['PHP']['operator']),
            );

            if ($level === 'class') {
                $result[] = Metadata::requiresPhpOnClass($versionRequirement);
            } else {
                $result[] = Metadata::requiresPhpOnMethod($versionRequirement);
            }
        } elseif (!empty($requirements['PHP_constraint'])) {
            $versionRequirement = new ConstraintRequirement($requirements['PHP_constraint']['constraint']);

            if ($level === 'class') {
                $result[] = Metadata::requiresPhpOnClass($versionRequirement);
            } else {
                $result[] = Metadata::requiresPhpOnMethod($versionRequirement);
            }
        }

        if (!empty($requirements['extensions'])) {
            foreach ($requirements['extensions'] as $extension) {
                if (isset($requirements['extension_versions'][$extension])) {
                    continue;
                }

                if ($level === 'class') {
                    $result[] = Metadata::requiresPhpExtensionOnClass($extension, null);
                } else {
                    $result[] = Metadata::requiresPhpExtensionOnMethod($extension, null);
                }
            }
        }

        if (!empty($requirements['extension_versions'])) {
            foreach ($requirements['extension_versions'] as $extension => $version) {
                $versionRequirement = new ComparisonRequirement(
                    $version['version'],
                    new VersionComparisonOperator(empty($version['operator']) ? '>=' : $version['operator']),
                );

                if ($level === 'class') {
                    $result[] = Metadata::requiresPhpExtensionOnClass($extension, $versionRequirement);
                } else {
                    $result[] = Metadata::requiresPhpExtensionOnMethod($extension, $versionRequirement);
                }
            }
        }

        if (!empty($requirements['PHPUnit'])) {
            $versionRequirement = new ComparisonRequirement(
                $requirements['PHPUnit']['version'],
                new VersionComparisonOperator(empty($requirements['PHPUnit']['operator']) ? '>=' : $requirements['PHPUnit']['operator']),
            );

            if ($level === 'class') {
                $result[] = Metadata::requiresPhpunitOnClass($versionRequirement);
            } else {
                $result[] = Metadata::requiresPhpunitOnMethod($versionRequirement);
            }
        } elseif (!empty($requirements['PHPUnit_constraint'])) {
            $versionRequirement = new ConstraintRequirement($requirements['PHPUnit_constraint']['constraint']);

            if ($level === 'class') {
                $result[] = Metadata::requiresPhpunitOnClass($versionRequirement);
            } else {
                $result[] = Metadata::requiresPhpunitOnMethod($versionRequirement);
            }
        }

        if (!empty($requirements['OSFAMILY'])) {
            if ($level === 'class') {
                $result[] = Metadata::requiresOperatingSystemFamilyOnClass($requirements['OSFAMILY']);
            } else {
                $result[] = Metadata::requiresOperatingSystemFamilyOnMethod($requirements['OSFAMILY']);
            }
        }

        if (!empty($requirements['OS'])) {
            if ($level === 'class') {
                $result[] = Metadata::requiresOperatingSystemOnClass($requirements['OS']);
            } else {
                $result[] = Metadata::requiresOperatingSystemOnMethod($requirements['OS']);
            }
        }

        if (!empty($requirements['functions'])) {
            foreach ($requirements['functions'] as $function) {
                $pieces = explode('::', $function);

                if (count($pieces) === 2) {
                    if ($level === 'class') {
                        $result[] = Metadata::requiresMethodOnClass($pieces[0], $pieces[1]);
                    } else {
                        $result[] = Metadata::requiresMethodOnMethod($pieces[0], $pieces[1]);
                    }
                } elseif ($level === 'class') {
                    $result[] = Metadata::requiresFunctionOnClass($function);
                } else {
                    $result[] = Metadata::requiresFunctionOnMethod($function);
                }
            }
        }

        if (!empty($requirements['setting'])) {
            foreach ($requirements['setting'] as $setting => $value) {
                if ($level === 'class') {
                    $result[] = Metadata::requiresSettingOnClass($setting, $value);
                } else {
                    $result[] = Metadata::requiresSettingOnMethod($setting, $value);
                }
            }
        }

        return $result;
    }
}
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                             <?php declare(strict_types=1);
/*
 * This file is part of PHPUnit.
 *
 * (c) Sebastian Bergmann <sebastian@phpunit.de>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
namespace PHPUnit\Metadata\Parser;

use const JSON_THROW_ON_ERROR;
use function assert;
use function json_decode;
use function str_starts_with;
use PHPUnit\Framework\Attributes\After;
use PHPUnit\Framework\Attributes\AfterClass;
use PHPUnit\Framework\Attributes\BackupGlobals;
use PHPUnit\Framework\Attributes\BackupStaticProperties;
use PHPUnit\Framework\Attributes\Before;
use PHPUnit\Framework\Attributes\BeforeClass;
use PHPUnit\Framework\Attributes\CoversClass;
use PHPUnit\Framework\Attributes\CoversFunction;
use PHPUnit\Framework\Attributes\CoversNothing;
use PHPUnit\Framework\Attributes\DataProvider;
use PHPUnit\Framework\Attributes\DataProviderExternal;
use PHPUnit\Framework\Attributes\Depends;
use PHPUnit\Framework\Attributes\DependsExternal;
use PHPUnit\Framework\Attributes\DependsExternalUsingDeepClone;
use PHPUnit\Framework\Attributes\DependsExternalUsingShallowClone;
use PHPUnit\Framework\Attributes\DependsOnClass;
use PHPUnit\Framework\Attributes\DependsOnClassUsingDeepClone;
use PHPUnit\Framework\Attributes\DependsOnClassUsingShallowClone;
use PHPUnit\Framework\Attributes\DependsUsingDeepClone;
use PHPUnit\Framework\Attributes\DependsUsingShallowClone;
use PHPUnit\Framework\Attributes\DoesNotPerformAssertions;
use PHPUnit\Framework\Attributes\ExcludeGlobalVariableFromBackup;
use PHPUnit\Framework\Attributes\ExcludeStaticPropertyFromBackup;
use PHPUnit\Framework\Attributes\Group;
use PHPUnit\Framework\Attributes\IgnoreClassForCodeCoverage;
use PHPUnit\Framework\Attributes\IgnoreDeprecations;
use PHPUnit\Framework\Attributes\IgnoreFunctionForCodeCoverage;
use PHPUnit\Framework\Attributes\IgnoreMethodForCodeCoverage;
use PHPUnit\Framework\Attributes\Large;
use PHPUnit\Framework\Attributes\Medium;
use PHPUnit\Framework\Attributes\PostCondition;
use PHPUnit\Framework\Attributes\PreCondition;
use PHPUnit\Framework\Attributes\PreserveGlobalState;
use PHPUnit\Framework\Attributes\RequiresFunction;
use PHPUnit\Framework\Attributes\RequiresMethod;
use PHPUnit\Framework\Attributes\RequiresOperatingSystem;
use PHPUnit\Framework\Attributes\RequiresOperatingSystemFamily;
use PHPUnit\Framework\Attributes\RequiresPhp;
use PHPUnit\Framework\Attributes\RequiresPhpExtension;
use PHPUnit\Framework\Attributes\RequiresPhpunit;
use PHPUnit\Framework\Attributes\RequiresSetting;
use PHPUnit\Framework\Attributes\RunClassInSeparateProcess;
use PHPUnit\Framework\Attributes\RunInSeparateProcess;
use PHPUnit\Framework\Attributes\RunTestsInSeparateProcesses;
use PHPUnit\Framework\Attributes\Small;
use PHPUnit\Framework\Attributes\Test;
use PHPUnit\Framework\Attributes\TestDox;
use PHPUnit\Framework\Attributes\TestWith;
use PHPUnit\Framework\Attributes\TestWithJson;
use PHPUnit\Framework\Attributes\Ticket;
use PHPUnit\Framework\Attributes\UsesClass;
use PHPUnit\Framework\Attributes\UsesFunction;
use PHPUnit\Framework\Attributes\WithoutErrorHandler;
use PHPUnit\Metadata\Metadata;
use PHPUnit\Metadata\MetadataCollection;
use PHPUnit\Metadata\Version\ConstraintRequirement;
use ReflectionClass;
use ReflectionMethod;

/**
 * @internal This class is not covered by the backward compatibility promise for PHPUnit
 */
final class AttributeParser implements Parser
{
    /**
     * @psalm-param class-string $className
     */
    public function forClass(string $className): MetadataCollection
    {
        $result = [];

        foreach ((new ReflectionClass($className))->getAttributes() as $attribute) {
            if (!str_starts_with($attribute->getName(), 'PHPUnit\\Framework\\Attributes\\')) {
                continue;
            }

            $attributeInstance = $attribute->newInstance();

            switch ($attribute->getName()) {
                case BackupGlobals::class:
                    assert($attributeInstance instanceof BackupGlobals);

                    $result[] = Metadata::backupGlobalsOnClass($attributeInstance->enabled());

                    break;

                case BackupStaticProperties::class:
                    assert($attributeInstance instanceof BackupStaticProperties);

                    $result[] = Metadata::backupStaticPropertiesOnClass($attributeInstance->enabled());

                    break;

                case CoversClass::class:
                    assert($attributeInstance instanceof CoversClass);

                    $result[] = Metadata::coversClass($attributeInstance->className());

                    break;

                case CoversFunction::class:
                    assert($attributeInstance instanceof CoversFunction);

                    $result[] = Metadata::coversFunction($attributeInstance->functionName());

                    break;

                case CoversNothing::class:
                    $result[] = Metadata::coversNothingOnClass();

                    break;

                case DoesNotPerformAssertions::class:
                    $result[] = Metadata::doesNotPerformAssertionsOnClass();

                    break;

                case ExcludeGlobalVariableFromBackup::class:
                    assert($attributeInstance instanceof ExcludeGlobalVariableFromBackup);

                    $result[] = Metadata::excludeGlobalVariableFromBackupOnClass($attributeInstance->globalVariableName());

                    break;

                case ExcludeStaticPropertyFromBackup::class:
                    assert($attributeInstance instanceof ExcludeStaticPropertyFromBackup);

                    $result[] = Metadata::excludeStaticPropertyFromBackupOnClass(
                        $attributeInstance->className(),
                        $attributeInstance->propertyName(),
                    );

                    break;

                case Group::class:
                    assert($attributeInstance instanceof Group);

                    $result[] = Metadata::groupOnClass($attributeInstance->name());

                    break;

                case Large::class:
                    $result[] = Metadata::groupOnClass('large');

                    break;

                case Medium::class:
                    $result[] = Metadata::groupOnClass('medium');

                    break;

                case IgnoreClassForCodeCoverage::class:
                    assert($attributeInstance instanceof IgnoreClassForCodeCoverage);

                    $result[] = Metadata::ignoreClassForCodeCoverage($attributeInstance->className());

                    break;

                case IgnoreDeprecations::class:
                    assert($attributeInstance instanceof IgnoreDeprecations);

                    $result[] = Metadata::ignoreDeprecationsOnClass();

                    break;

                case IgnoreMethodForCodeCoverage::class:
                    assert($attributeInstance instanceof IgnoreMethodForCodeCoverage);

                    $result[] = Metadata::ignoreMethodForCodeCoverage($attributeInstance->className(), $attributeInstance->methodName());

                    break;

                case IgnoreFunctionForCodeCoverage::class:
                    assert($attributeInstance instanceof IgnoreFunctionForCodeCoverage);

                    $result[] = Metadata::ignoreFunctionForCodeCoverage($attributeInstance->functionName());

                    break;

                case PreserveGlobalState::class:
                    assert($attributeInstance instanceof PreserveGlobalState);

                    $result[] = Metadata::preserveGlobalStateOnClass($attributeInstance->enabled());

                    break;

                case RequiresMethod::class:
                    assert($attributeInstance instanceof RequiresMethod);

                    $result[] = Metadata::requiresMethodOnClass(
                        $attributeInstance->className(),
                        $attributeInstance->methodName(),
                    );

                    break;

                case RequiresFunction::class:
                    assert($attributeInstance instanceof RequiresFunction);

                    $result[] = Metadata::requiresFunctionOnClass($attributeInstance->functionName());

                    break;

                case RequiresOperatingSystem::class:
                    assert($attributeInstance instanceof RequiresOperatingSystem);

                    $result[] = Metadata::requiresOperatingSystemOnClass($attributeInstance->regularExpression());

                    break;

                case RequiresOperatingSystemFamily::class:
                    assert($attributeInstance instanceof RequiresOperatingSystemFamily);

                    $result[] = Metadata::requiresOperatingSystemFamilyOnClass($attributeInstance->operatingSystemFamily());

                    break;

                case RequiresPhp::class:
                    assert($attributeInstance instanceof RequiresPhp);

                    $result[] = Metadata::requiresPhpOnClass(
                        ConstraintRequirement::from(
                            $attributeInstance->versionRequirement(),
                        ),
                    );

                    break;

                case RequiresPhpExtension::class:
                    assert($attributeInstance instanceof RequiresPhpExtension);

                    $versionConstraint  = null;
                    $versionRequirement = $attributeInstance->versionRequirement();

                    if ($versionRequirement !== null) {
                        $versionConstraint = ConstraintRequirement::from($versionRequirement);
                    }

                    $result[] = Metadata::requiresPhpExtensionOnClass(
                        $attributeInstance->extension(),
                        $versionConstraint,
                    );

                    break;

                case RequiresPhpunit::class:
                    assert($attributeInstance instanceof RequiresPhpunit);

                    $result[] = Metadata::requiresPhpunitOnClass(
                        ConstraintRequirement::from(
                            $attributeInstance->versionRequirement(),
                        ),
                    );

                    break;

                case RequiresSetting::class:
                    assert($attributeInstance instanceof RequiresSetting);

                    $result[] = Metadata::requiresSettingOnClass(
                        $attributeInstance->setting(),
                        $attributeInstance->value(),
                    );

                    break;

                case RunClassInSeparateProcess::class:
                    $result[] = Metadata::runClassInSeparateProcess();

                    break;

                case RunTestsInSeparateProcesses::class:
                    $result[] = Metadata::runTestsInSeparateProcesses();

                    break;

                case Small::class:
                    $result[] = Metadata::groupOnClass('small');

                    break;

                case TestDox::class:
                    assert($attributeInstance instanceof TestDox);

                    $result[] = Metadata::testDoxOnClass($attributeInstance->text());

                    break;

                case Ticket::class:
                    assert($attributeInstance instanceof Ticket);

                    $result[] = Metadata::groupOnClass($attributeInstance->text());

                    break;

                case UsesClass::class:
                    assert($attributeInstance instanceof UsesClass);

                    $result[] = Metadata::usesClass($attributeInstance->className());

                    break;

                case UsesFunction::class:
                    assert($attributeInstance instanceof UsesFunction);

                    $result[] = Metadata::usesFunction($attributeInstance->functionName());

                    break;
            }
        }

        return MetadataCollection::fromArray($result);
    }

    /**
     * @psalm-param class-string $className
     * @psalm-param non-empty-string $methodName
     */
    public function forMethod(string $className, string $methodName): MetadataCollection
    {
        $result = [];

        foreach ((new ReflectionMethod($className, $methodName))->getAttributes() as $attribute) {
            if (!str_starts_with($attribute->getName(), 'PHPUnit\\Framework\\Attributes\\')) {
                continue;
            }

            $attributeInstance = $attribute->newInstance();

            switch ($attribute->getName()) {
                case After::class:
                    $result[] = Metadata::after();

                    break;

                case AfterClass::class:
                    $result[] = Metadata::afterClass();

                    break;

                case BackupGlobals::class:
                    assert($attributeInstance instanceof BackupGlobals);

                    $result[] = Metadata::backupGlobalsOnMethod($attributeInstance->enabled());

                    break;

                case BackupStaticProperties::class:
                    assert($attributeInstance instanceof BackupStaticProperties);

                    $result[] = Metadata::backupStaticPropertiesOnMethod($attributeInstance->enabled());

                    break;

                case Before::class:
                    $result[] = Metadata::before();

                    break;

                case BeforeClass::class:
                    $result[] = Metadata::beforeClass();

                    break;

                case CoversNothing::class:
                    $result[] = Metadata::coversNothingOnMethod();

                    break;

                case DataProvider::class:
                    assert($attributeInstance instanceof DataProvider);

                    $result[] = Metadata::dataProvider($className, $attributeInstance->methodName());

                    break;

                case DataProviderExternal::class:
                    assert($attributeInstance instanceof DataProviderExternal);

                    $result[] = Metadata::dataProvider($attributeInstance->className(), $attributeInstance->methodName());

                    break;

                case Depends::class:
                    assert($attributeInstance instanceof Depends);

                    $result[] = Metadata::dependsOnMethod($className, $attributeInstance->methodName(), false, false);

                    break;

                case DependsUsingDeepClone::class:
                    assert($attributeInstance instanceof DependsUsingDeepClone);

                    $result[] = Metadata::dependsOnMethod($className, $attributeInstance->methodName(), true, false);

                    break;

                case DependsUsingShallowClone::class:
                    assert($attributeInstance instanceof DependsUsingShallowClone);

                    $result[] = Metadata::dependsOnMethod($className, $attributeInstance->methodName(), false, true);

                    break;

                case DependsExternal::class:
                    assert($attributeInstance instanceof DependsExternal);

                    $result[] = Metadata::dependsOnMethod($attributeInstance->className(), $attributeInstance->methodName(), false, false);

                    break;

                case DependsExternalUsingDeepClone::class:
                    assert($attributeInstance instanceof DependsExternalUsingDeepClone);

                    $result[] = Metadata::dependsOnMethod($attributeInstance->className(), $attributeInstance->methodName(), true, false);

                    break;

                case DependsExternalUsingShallowClone::class:
                    assert($attributeInstance instanceof DependsExternalUsingShallowClone);

                    $result[] = Metadata::dependsOnMethod($attributeInstance->className(), $attributeInstance->methodName(), false, true);

                    break;

                case DependsOnClass::class:
                    assert($attributeInstance instanceof DependsOnClass);

                    $result[] = Metadata::dependsOnClass($attributeInstance->className(), false, false);

                    break;

                case DependsOnClassUsingDeepClone::class:
                    assert($attributeInstance instanceof DependsOnClassUsingDeepClone);

                    $result[] = Metadata::dependsOnClass($attributeInstance->className(), true, false);

                    break;

                case DependsOnClassUsingShallowClone::class:
                    assert($attributeInstance instanceof DependsOnClassUsingShallowClone);

                    $result[] = Metadata::dependsOnClass($attributeInstance->className(), false, true);

                    break;

                case DoesNotPerformAssertions::class:
                    assert($attributeInstance instanceof DoesNotPerformAssertions);

                    $result[] = Metadata::doesNotPerformAssertionsOnMethod();

                    break;

                case ExcludeGlobalVariableFromBackup::class:
                    assert($attributeInstance instanceof ExcludeGlobalVariableFromBackup);

                    $result[] = Metadata::excludeGlobalVariableFromBackupOnMethod($attributeInstance->globalVariableName());

                    break;

                case ExcludeStaticPropertyFromBackup::class:
                    assert($attributeInstance instanceof ExcludeStaticPropertyFromBackup);

                    $result[] = Metadata::excludeStaticPropertyFromBackupOnMethod(
                        $attributeInstance->className(),
                        $attributeInstance->propertyName(),
                    );

                    break;

                case Group::class:
                    assert($attributeInstance instanceof Group);

                    $result[] = Metadata::groupOnMethod($attributeInstance->name());

                    break;

                case IgnoreDeprecations::class:
                    assert($attributeInstance instanceof IgnoreDeprecations);

                    $result[] = Metadata::ignoreDeprecationsOnMethod();

                    break;

                case PostCondition::class:
                    $result[] = Metadata::postCondition();

                    break;

                case PreCondition::class:
                    $result[] = Metadata::preCondition();

                    break;

                case PreserveGlobalState::class:
                    assert($attributeInstance instanceof PreserveGlobalState);

                    $result[] = Metadata::preserveGlobalStateOnMethod($attributeInstance->enabled());

                    break;

                case RequiresMethod::class:
                    assert($attributeInstance instanceof RequiresMethod);

                    $result[] = Metadata::requiresMethodOnMethod(
                        $attributeInstance->className(),
                        $attributeInstance->methodName(),
                    );

                    break;

                case RequiresFunction::class:
                    assert($attributeInstance instanceof RequiresFunction);

                    $result[] = Metadata::requiresFunctionOnMethod($attributeInstance->functionName());

                    break;

                case RequiresOperatingSystem::class:
                    assert($attributeInstance instanceof RequiresOperatingSystem);

                    $result[] = Metadata::requiresOperatingSystemOnMethod($attributeInstance->regularExpression());

                    break;

                case RequiresOperatingSystemFamily::class:
                    assert($attributeInstance instanceof RequiresOperatingSystemFamily);

                    $result[] = Metadata::requiresOperatingSystemFamilyOnMethod($attributeInstance->operatingSystemFamily());

                    break;

                case RequiresPhp::class:
                    assert($attributeInstance instanceof RequiresPhp);

                    $result[] = Metadata::requiresPhpOnMethod(
                        ConstraintRequirement::from(
                            $attributeInstance->versionRequirement(),
                        ),
                    );

                    break;

                case RequiresPhpExtension::class:
                    assert($attributeInstance instanceof RequiresPhpExtension);

                    $versionConstraint  = null;
                    $versionRequirement = $attributeInstance->versionRequirement();

                    if ($versionRequirement !== null) {
                        $versionConstraint = ConstraintRequirement::from($versionRequirement);
                    }

                    $result[] = Metadata::requiresPhpExtensionOnMethod(
                        $attributeInstance->extension(),
                        $versionConstraint,
                    );

                    break;

                case RequiresPhpunit::class:
                    assert($attributeInstance instanceof RequiresPhpunit);

                    $result[] = Metadata::requiresPhpunitOnMethod(
                        ConstraintRequirement::from(
                            $attributeInstance->versionRequirement(),
                        ),
                    );

                    break;

                case RequiresSetting::class:
                    assert($attributeInstance instanceof RequiresSetting);

                    $result[] = Metadata::requiresSettingOnMethod(
                        $attributeInstance->setting(),
                        $attributeInstance->value(),
                    );

                    break;

                case RunInSeparateProcess::class:
                    $result[] = Metadata::runInSeparateProcess();

                    break;

                case Test::class:
                    $result[] = Metadata::test();

                    break;

                case TestDox::class:
                    assert($attributeInstance instanceof TestDox);

                    $result[] = Metadata::testDoxOnMethod($attributeInstance->text());

                    break;

                case TestWith::class:
                    assert($attributeInstance instanceof TestWith);

                    $result[] = Metadata::testWith($attributeInstance->data());

                    break;

                case TestWithJson::class:
                    assert($attributeInstance instanceof TestWithJson);

                    $result[] = Metadata::testWith(json_decode($attributeInstance->json(), true, 512, JSON_THROW_ON_ERROR));

                    break;

                case Ticket::class:
                    assert($attributeInstance instanceof Ticket);

                    $result[] = Metadata::groupOnMethod($attributeInstance->text());

                    break;

                case WithoutErrorHandler::class:
                    assert($attributeInstance instanceof WithoutErrorHandler);

                    $result[] = Metadata::withoutErrorHandler();

                    break;
            }
        }

        return MetadataCollection::fromArray($result);
    }

    /**
     * @psalm-param class-string $className
     * @psalm-param non-empty-string $methodName
     */
    public function forClassAndMethod(string $className, string $methodName): MetadataCollection
    {
        return $this->forClass($className)->mergeWith(
            $this->forMethod($className, $methodName),
        );
    }
}
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                             <?php declare(strict_types=1);
/*
 * This file is part of PHPUnit.
 *
 * (c) Sebastian Bergmann <sebastian@phpunit.de>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
namespace PHPUnit\Metadata\Parser;

use PHPUnit\Metadata\MetadataCollection;

/**
 * @internal This class is not covered by the backward compatibility promise for PHPUnit
 */
final class CachingParser implements Parser
{
    private readonly Parser $reader;
    private array $classCache          = [];
    private array $methodCache         = [];
    private array $classAndMethodCache = [];

    public function __construct(Parser $reader)
    {
        $this->reader = $reader;
    }

    /**
     * @psalm-param class-string $className
     */
    public function forClass(string $className): MetadataCollection
    {
        if (isset($this->classCache[$className])) {
            return $this->classCache[$className];
        }

        $this->classCache[$className] = $this->reader->forClass($className);

        return $this->classCache[$className];
    }

    /**
     * @psalm-param class-string $className
     * @psalm-param non-empty-string $methodName
     */
    public function forMethod(string $className, string $methodName): MetadataCollection
    {
        $key = $className . '::' . $methodName;

        if (isset($this->methodCache[$key])) {
            return $this->methodCache[$key];
        }

        $this->methodCache[$key] = $this->reader->forMethod($className, $methodName);

        return $this->methodCache[$key];
    }

    /**
     * @psalm-param class-string $className
     * @psalm-param non-empty-string $methodName
     */
    public function forClassAndMethod(string $className, string $methodName): MetadataCollection
    {
        $key = $className . '::' . $methodName;

        if (isset($this->classAndMethodCache[$key])) {
            return $this->classAndMethodCache[$key];
        }

        $this->classAndMethodCache[$key] = $this->forClass($className)->mergeWith(
            $this->forMethod($className, $methodName),
        );

        return $this->classAndMethodCache[$key];
    }
}
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                           <?php declare(strict_types=1);
/*
 * This file is part of PHPUnit.
 *
 * (c) Sebastian Bergmann <sebastian@phpunit.de>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
namespace PHPUnit\Metadata\Parser;

use PHPUnit\Metadata\MetadataCollection;

/**
 * @internal This class is not covered by the backward compatibility promise for PHPUnit
 */
interface Parser
{
    /**
     * @psalm-param class-string $className
     */
    public function forClass(string $className): MetadataCollection;

    /**
     * @psalm-param class-string $className
     * @psalm-param non-empty-string $methodName
     */
    public function forMethod(string $className, string $methodName): MetadataCollection;

    /**
     * @psalm-param class-string $className
     * @psalm-param non-empty-string $methodName
     */
    public function forClassAndMethod(string $className, string $methodName): MetadataCollection;
}
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                      INDX( 	 ∫¥>?           (   X  Ë       g                     3    h V     3    C*úiÖz⁄ Ú5fm⁄!•lÖz⁄YQúiÖz⁄                       
 A n n o t a t i o n   3    Ä j     3    hxúiÖz⁄ ˆM‰ug⁄~üúiÖz⁄~üúiÖz⁄ P      ÉF               A n n o t a t i o n P a r s e r . p h p       	3    x h     3    ~üúiÖz⁄ ˆM‰ug⁄~üúiÖz⁄~üúiÖz⁄ `      s\               A t t r i b u t e P a r s e r . p h p 
3    x d     3    }∆úiÖz⁄ ˆM‰ug⁄}∆úiÖz⁄}∆úiÖz⁄       ï               C a c h i n  P a r s e r . p h p     3    h V     3    }∆úiÖz⁄ ˆM‰ug⁄}∆úiÖz⁄}∆úiÖz⁄       ⁄              
 P a r s e r . p h p   3    p `     3    òÌúiÖz⁄ ˆM‰ug⁄òÌúiÖz⁄òÌúiÖz⁄       n               P a r s e r C h a i n . p h p 3    p Z     3    ùùiÖz⁄ ˆM‰ug⁄ùùiÖz⁄ùùiÖz⁄       ≠               R e g i s t r y . p h p                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                              <?php declare(strict_types=1);
/*
 * This file is part of PHPUnit.
 *
 * (c) Sebastian Bergmann <sebastian@phpunit.de>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
namespace PHPUnit\Metadata\Parser;

use PHPUnit\Metadata\MetadataCollection;

/**
 * @internal This class is not covered by the backward compatibility promise for PHPUnit
 */
final class ParserChain implements Parser
{
    private readonly Parser $attributeReader;
    private readonly Parser $annotationReader;

    public function __construct(Parser $attributeReader, Parser $annotationReader)
    {
        $this->attributeReader  = $attributeReader;
        $this->annotationReader = $annotationReader;
    }

    /**
     * @psalm-param class-string $className
     */
    public function forClass(string $className): MetadataCollection
    {
        $metadata = $this->attributeReader->forClass($className);

        if (!$metadata->isEmpty()) {
            return $metadata;
        }

        return $this->annotationReader->forClass($className);
    }

    /**
     * @psalm-param class-string $className
     * @psalm-param non-empty-string $methodName
     */
    public function forMethod(string $className, string $methodName): MetadataCollection
    {
        $metadata = $this->attributeReader->forMethod($className, $methodName);

        if (!$metadata->isEmpty()) {
            return $metadata;
        }

        return $this->annotationReader->forMethod($className, $methodName);
    }

    /**
     * @psalm-param class-string $className
     * @psalm-param non-empty-string $methodName
     */
    public function forClassAndMethod(string $className, string $methodName): MetadataCollection
    {
        return $this->forClass($className)->mergeWith(
            $this->forMethod($className, $methodName),
        );
    }
}
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                  <?php declare(strict_types=1);
/*
 * This file is part of PHPUnit.
 *
 * (c) Sebastian Bergmann <sebastian@phpunit.de>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
namespace PHPUnit\Metadata\Parser;

/**
 * Attribute and annotation information is static within a single PHP process.
 * It is therefore okay to use a Singleton registry here.
 *
 * @internal This class is not covered by the backward compatibility promise for PHPUnit
 */
final class Registry
{
    private static ?Parser $instance = null;

    public static function parser(): Parser
    {
        return self::$instance ?? self::$instance = self::build();
    }

    private static function build(): Parser
    {
        return new CachingParser(
            new ParserChain(
                new AttributeParser,
                new AnnotationParser,
            ),
        );
    }
}
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                   <?php declare(strict_types=1);
/*
 * This file is part of PHPUnit.
 *
 * (c) Sebastian Bergmann <sebastian@phpunit.de>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
namespace PHPUnit\Metadata;

/**
 * @psalm-immutable
 *
 * @no-named-arguments Parameter names are not covered by the backward compatibility promise for PHPUnit
 */
final class PreserveGlobalState extends Metadata
{
    private readonly bool $enabled;

    /**
     * @psalm-param 0|1 $level
     */
    protected function __construct(int $level, bool $enabled)
    {
        parent::__construct($level);

        $this->enabled = $enabled;
    }

    /**
     * @psalm-assert-if-true PreserveGlobalState $this
     */
    public function isPreserveGlobalState(): bool
    {
        return true;
    }

    public function enabled(): bool
    {
        return $this->enabled;
    }
}
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                       <?php declare(strict_types=1);
/*
 * This file is part of PHPUnit.
 *
 * (c) Sebastian Bergmann <sebastian@phpunit.de>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
namespace PHPUnit\Metadata;

/**
 * @psalm-immutable
 *
 * @no-named-arguments Parameter names are not covered by the backward compatibility promise for PHPUnit
 */
final class RequiresFunction extends Metadata
{
    /**
     * @psalm-var non-empty-string
     */
    private readonly string $functionName;

    /**
     * @psalm-param 0|1 $level
     * @psalm-param non-empty-string $functionName
     */
    protected function __construct(int $level, string $functionName)
    {
        parent::__construct($level);

        $this->functionName = $functionName;
    }

    /**
     * @psalm-assert-if-true RequiresFunction $this
     */
    public function isRequiresFunction(): bool
    {
        return true;
    }

    /**
     * @psalm-return non-empty-string
     */
    public function functionName(): string
    {
        return $this->functionName;
    }
}
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                INDX( 	 P⁄>?          (   ∏  Ë       ⁄ ⁄  ⁄⁄          ˚2    ò à     ›2    ÔfõiÖz⁄ ˆM‰ug⁄ÔfõiÖz⁄ÔfõiÖz⁄       ÷              # E x c l u d e S t a t i c P r o p e r t y F r o m B a c k u p . p h p ¸2    h T     ›2    ÔfõiÖz⁄ ˆM‰ug⁄éõiÖz⁄éõiÖz⁄       *              	 G r o u p . p h p     ˝2    ê ~     ›2    éõiÖz⁄ ˆM‰ug⁄éõiÖz⁄éõiÖz⁄       ®               I g n o r e C l a s s F o r C o d e C o v e r a g e . p h p   ˛2    Ä n     ›2    éõiÖz⁄ ˆM‰ug⁄µõiÖz µõiÖz⁄p      n               I g n o r e D e p r e c a t i o n s . p h p   ˇ2    ò Ñ     ›2    µõiÖz⁄ ˆM‰ug⁄µõiÖz⁄µõiÖz⁄       “              ! I g n o r e F u n c t i o n F o r C o d e C o v e r a g e . p h p      3    ê Ä     ›2     ‹õiÖz⁄ ˆM‰ug⁄ ‹õiÖz⁄ ‹õiÖz⁄                      I g n o r e M e t h o d F o r C o d e C o v e r a g e . p h p 3    p Z     ›2     ‹õiÖz⁄ ˆM‰ug⁄ ‹õiÖz⁄ ‹õiÖz⁄ `      ŒR               M e t a d a t a . p h p       3    Ä n     ›2    0úiÖz⁄ ˆM‰ug⁄0úiÖz⁄0úiÖz⁄ @      8               M e t a d a t a C o l l e c t i o n . p h p   3    ê ~     ›2    0úiÖz⁄ ˆM‰ug⁄0úiÖz⁄0úiÖz⁄       ¡               M e t a d a t a C o l l e c t i o n I t e r a t o r . p h p   3    ` N     ›2    C*úiÖz⁄ Ú5fm⁄!•lÖz⁄ùùiÖz⁄                        P a r s e r   3    x d     ›2    ùùiÖz⁄ ˆM‰ug⁄´;ùiÖz⁄ùùiÖz⁄`      _               P o s t C o n d i t i o n . p h p     3    x b     ›2    ´;ùiÖz⁄ ˆM‰ug⁄´;ùiÖz ´;ùiÖz⁄`      \               P r e C o n d i t i o n . p h p       3    Ä p     ›2    ´;ùiÖz⁄ ˆM‰ug⁄´;ùiÖz⁄´;ùiÖz⁄       ©               P r e s e r v e G l o b a l S t a t e . p h p 3    Ä j     ›2    ´;ùiÖz⁄ ˆM‰ug⁄àvùiÖz⁄àvùiÖz⁄       `               R e q u i r e s F u n c t i o n . p h p       3    x f     ›2    àvùiÖz⁄ ˆM‰ug⁄àvùiÖz⁄àvùiÖz⁄       ì               R e q u i r e s M e t h o d . p h p                 ›2    T“†iÖz⁄ ˆM‰ug⁄T“†iÖz⁄T“†iÖz⁄      á               R e q u i r e s O p e r a t i n g S y s t e m . p h p 3    ò Ñ     ›2    W˘†iÖz⁄ ˆM‰ug⁄W˘†iÖz⁄W˘†iÖz⁄       ∆              ! R e q u i r e s O p e r a t i n g S y s t e m F a m i l y . p h p     3    p `     ›2    W˘†iÖz⁄ ˆM‰ug⁄W˘†iÖz⁄W˘†iÖz⁄                      R e q u i r e s P h p . p h p 3    à r     ›2    l °iÖz⁄ ˆM‰ug⁄l °iÖz⁄l °iÖz⁄       ¯               R e q u i r e s P h p E x t e n s i o n . p h p       3    x h     ›2    l °iÖz⁄ ˆM‰ug l °iÖz⁄l °iÖz⁄                      R e q u i r e s P h p u n i t . p h p 3    x h     ›2    áG°iÖz⁄ ˆM‰ug⁄áG°iÖz⁄áG°iÖz⁄       r               R e q u i r e s S e t t i n g . p h p 3    ê |     ›2    áG°iÖz⁄ ˆM‰ug⁄áG°iÖz⁄áG°iÖz⁄à      É               R u n C l a s s I n S e p a r a t e P r o c e s s . p h p     3    à r     ›2    ân°iÖz⁄ ˆM‰ug⁄ân°iÖz⁄ân°iÖz⁄x      t               R u n I n S e p a r a t e P r o c e s s . p h p       3    ê Ä     ›2    ân°iÖz  ˆM‰ug⁄ân°iÖz⁄ân°iÖz⁄ê      â               R u n T e s t s I n S e p a r a t e P r o c e s s e s . p h p 3    h R     ›2    ¢ï°iÖz⁄ ˆM‰ug⁄¢ï°iÖz⁄¢ï°iÖz⁄H      D               T e s t . p h p       3    h X     ›2    ¢ï°iÖz⁄ ˆM‰ug⁄¢ï°iÖz⁄¢ï°iÖz⁄                      T e s t D o x . p h p 3    p Z     ›2    ¨º°iÖz⁄ ˆM‰ug⁄¨º°iÖz⁄¨º°iÖz⁄       y               T e s t W i t h . p h p       3    h R     ›2    ª„°iÖz⁄ ˆM‰ug⁄ª„°iÖz⁄ª„°iÖz⁄                     U s e s . p h p        3    p \     ›2    ª„°iÖz⁄ ˆM‰ug⁄ª„°iÖz⁄ª„°iÖz⁄       '               U s e s C l a s s . p h p     !3    Ä j     ›2    ¡
¢iÖz⁄ ˆM‰ug⁄¡
¢iÖz⁄¡
¢iÖz⁄       ?               U s e s D e f a u l t C l a s s . p h p       "3    x b     ›2    ¡
¢iÖz⁄ ˆM‰ug⁄¡
¢iÖz⁄¡
¢iÖz⁄       /               U s e s F u n c t i o n . p h p       #3    ` P     ›2    ¡
¢iÖz⁄‹1¢iÖz⁄‹1¢iÖz⁄‰X¢iÖz⁄                        V e r s i o n                              <?php declare(strict_types=1);
/*
 * This file is part of PHPUnit.
 *
 * (c) Sebastian Bergmann <sebastian@phpunit.de>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
namespace PHPUnit\Metadata;

/**
 * @psalm-immutable
 *
 * @no-named-arguments Parameter names are not covered by the backward compatibility promise for PHPUnit
 */
final class RequiresMethod extends Metadata
{
    /**
     * @psalm-var class-string
     */
    private readonly string $className;

    /**
     * @psalm-var non-empty-string
     */
    private readonly string $methodName;

    /**
     * @psalm-param 0|1 $level
     * @psalm-param class-string $className
     * @psalm-param non-empty-string $methodName
     */
    protected function __construct(int $level, string $className, string $methodName)
    {
        parent::__construct($level);

        $this->className  = $className;
        $this->methodName = $methodName;
    }

    /**
     * @psalm-assert-if-true RequiresMethod $this
     */
    public function isRequiresMethod(): bool
    {
        return true;
    }

    /**
     * @psalm-return class-string
     */
    public function className(): string
    {
        return $this->className;
    }

    /**
     * @psalm-return non-empty-string
     */
    public function methodName(): string
    {
        return $this->methodName;
    }
}
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                             <?php declare(strict_types=1);
/*
 * This file is part of PHPUnit.
 *
 * (c) Sebastian Bergmann <sebastian@phpunit.de>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
namespace PHPUnit\Metadata;

/**
 * @psalm-immutable
 *
 * @no-named-arguments Parameter names are not covered by the backward compatibility promise for PHPUnit
 */
final class RequiresOperatingSystem extends Metadata
{
    /**
     * @psalm-var non-empty-string
     */
    private readonly string $operatingSystem;

    /**
     * @psalm-param 0|1 $level
     * @psalm-param non-empty-string $operatingSystem
     */
    public function __construct(int $level, string $operatingSystem)
    {
        parent::__construct($level);

        $this->operatingSystem = $operatingSystem;
    }

    /**
     * @psalm-assert-if-true RequiresOperatingSystem $this
     */
    public function isRequiresOperatingSystem(): bool
    {
        return true;
    }

    /**
     * @psalm-return non-empty-string
     */
    public function operatingSystem(): string
    {
        return $this->operatingSystem;
    }
}
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                         <?php declare(strict_types=1);
/*
 * This file is part of PHPUnit.
 *
 * (c) Sebastian Bergmann <sebastian@phpunit.de>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
namespace PHPUnit\Metadata;

/**
 * @psalm-immutable
 *
 * @no-named-arguments Parameter names are not covered by the backward compatibility promise for PHPUnit
 */
final class RequiresOperatingSystemFamily extends Metadata
{
    /**
     * @psalm-var non-empty-string
     */
    private readonly string $operatingSystemFamily;

    /**
     * @psalm-param 0|1 $level
     * @psalm-param non-empty-string $operatingSystemFamily
     */
    protected function __construct(int $level, string $operatingSystemFamily)
    {
        parent::__construct($level);

        $this->operatingSystemFamily = $operatingSystemFamily;
    }

    /**
     * @psalm-assert-if-true RequiresOperatingSystemFamily $this
     */
    public function isRequiresOperatingSystemFamily(): bool
    {
        return true;
    }

    /**
     * @psalm-return non-empty-string
     */
    public function operatingSystemFamily(): string
    {
        return $this->operatingSystemFamily;
    }
}
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                          <?php declare(strict_types=1);
/*
 * This file is part of PHPUnit.
 *
 * (c) Sebastian Bergmann <sebastian@phpunit.de>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
namespace PHPUnit\Metadata;

use PHPUnit\Metadata\Version\Requirement;

/**
 * @psalm-immutable
 *
 * @no-named-arguments Parameter names are not covered by the backward compatibility promise for PHPUnit
 */
final class RequiresPhp extends Metadata
{
    private readonly Requirement $versionRequirement;

    /**
     * @psalm-param 0|1 $level
     */
    protected function __construct(int $level, Requirement $versionRequirement)
    {
        parent::__construct($level);

        $this->versionRequirement = $versionRequirement;
    }

    /**
     * @psalm-assert-if-true RequiresPhp $this
     */
    public function isRequiresPhp(): bool
    {
        return true;
    }

    public function versionRequirement(): Requirement
    {
        return $this->versionRequirement;
    }
}
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                             <?php declare(strict_types=1);
/*
 * This file is part of PHPUnit.
 *
 * (c) Sebastian Bergmann <sebastian@phpunit.de>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
namespace PHPUnit\Metadata;

use PHPUnit\Metadata\Version\Requirement;

/**
 * @psalm-immutable
 *
 * @no-named-arguments Parameter names are not covered by the backward compatibility promise for PHPUnit
 */
final class RequiresPhpExtension extends Metadata
{
    /**
     * @psalm-var non-empty-string
     */
    private readonly string $extension;
    private readonly ?Requirement $versionRequirement;

    /**
     * @psalm-param 0|1 $level
     * @psalm-param non-empty-string $extension
     */
    protected function __construct(int $level, string $extension, ?Requirement $versionRequirement)
    {
        parent::__construct($level);

        $this->extension          = $extension;
        $this->versionRequirement = $versionRequirement;
    }

    /**
     * @psalm-assert-if-true RequiresPhpExtension $this
     */
    public function isRequiresPhpExtension(): bool
    {
        return true;
    }

    /**
     * @psalm-return non-empty-string
     */
    public function extension(): string
    {
        return $this->extension;
    }

    /**
     * @psalm-assert-if-true !null $this->versionRequirement
     */
    public function hasVersionRequirement(): bool
    {
        return $this->versionRequirement !== null;
    }

    /**
     * @throws NoVersionRequirementException
     */
    public function versionRequirement(): Requirement
    {
        if ($this->versionRequirement === null) {
            throw new NoVersionRequirementException;
        }

        return $this->versionRequirement;
    }
}
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                        <?php declare(strict_types=1);
/*
 * This file is part of PHPUnit.
 *
 * (c) Sebastian Bergmann <sebastian@phpunit.de>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
namespace PHPUnit\Metadata;

use PHPUnit\Metadata\Version\Requirement;

/**
 * @psalm-immutable
 *
 * @no-named-arguments Parameter names are not covered by the backward compatibility promise for PHPUnit
 */
final class RequiresPhpunit extends Metadata
{
    private readonly Requirement $versionRequirement;

    /**
     * @psalm-param 0|1 $level
     */
    protected function __construct(int $level, Requirement $versionRequirement)
    {
        parent::__construct($level);

        $this->versionRequirement = $versionRequirement;
    }

    /**
     * @psalm-assert-if-true RequiresPhpunit $this
     */
    public function isRequiresPhpunit(): bool
    {
        return true;
    }

    public function versionRequirement(): Requirement
    {
        return $this->versionRequirement;
    }
}
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                 <?php declare(strict_types=1);
/*
 * This file is part of PHPUnit.
 *
 * (c) Sebastian Bergmann <sebastian@phpunit.de>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
namespace PHPUnit\Metadata;

/**
 * @psalm-immutable
 *
 * @no-named-arguments Parameter names are not covered by the backward compatibility promise for PHPUnit
 */
final class RequiresSetting extends Metadata
{
    /**
     * @psalm-var non-empty-string
     */
    private readonly string $setting;

    /**
     * @psalm-var non-empty-string
     */
    private readonly string $value;

    /**
     * @psalm-param 0|1 $level
     * @psalm-param non-empty-string $setting
     * @psalm-param non-empty-string $value
     */
    protected function __construct(int $level, string $setting, string $value)
    {
        parent::__construct($level);

        $this->setting = $setting;
        $this->value   = $value;
    }

    /**
     * @psalm-assert-if-true RequiresSetting $this
     */
    public function isRequiresSetting(): bool
    {
        return true;
    }

    /**
     * @psalm-return non-empty-string
     */
    public function setting(): string
    {
        return $this->setting;
    }

    /**
     * @psalm-return non-empty-string
     */
    public function value(): string
    {
        return $this->value;
    }
}
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                              <?php declare(strict_types=1);
/*
 * This file is part of PHPUnit.
 *
 * (c) Sebastian Bergmann <sebastian@phpunit.de>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
namespace PHPUnit\Metadata;

/**
 * @psalm-immutable
 *
 * @no-named-arguments Parameter names are not covered by the backward compatibility promise for PHPUnit
 */
final class TestDox extends Metadata
{
    /**
     * @psalm-var non-empty-string
     */
    private readonly string $text;

    /**
     * @psalm-param 0|1 $level
     * @psalm-param non-empty-string $text
     */
    protected function __construct(int $level, string $text)
    {
        parent::__construct($level);

        $this->text = $text;
    }

    /**
     * @psalm-assert-if-true TestDox $this
     */
    public function isTestDox(): bool
    {
        return true;
    }

    /**
     * @psalm-return non-empty-string
     */
    public function text(): string
    {
        return $this->text;
    }
}
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                   <?php declare(strict_types=1);
/*
 * This file is part of PHPUnit.
 *
 * (c) Sebastian Bergmann <sebastian@phpunit.de>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
namespace PHPUnit\Metadata;

/**
 * @psalm-immutable
 *
 * @no-named-arguments Parameter names are not covered by the backward compatibility promise for PHPUnit
 */
final class TestWith extends Metadata
{
    private readonly array $data;

    /**
     * @psalm-param 0|1 $level
     */
    protected function __construct(int $level, array $data)
    {
        parent::__construct($level);

        $this->data = $data;
    }

    /**
     * @psalm-assert-if-true TestWith $this
     */
    public function isTestWith(): bool
    {
        return true;
    }

    public function data(): array
    {
        return $this->data;
    }
}
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                       <?php declare(strict_types=1);
/*
 * This file is part of PHPUnit.
 *
 * (c) Sebastian Bergmann <sebastian@phpunit.de>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
namespace PHPUnit\Metadata;

/**
 * @psalm-immutable
 *
 * @no-named-arguments Parameter names are not covered by the backward compatibility promise for PHPUnit
 */
final class Uses extends Metadata
{
    /**
     * @psalm-var non-empty-string
     */
    private readonly string $target;

    /**
     * @psalm-param 0|1 $level
     * @psalm-param non-empty-string $target
     */
    protected function __construct(int $level, string $target)
    {
        parent::__construct($level);

        $this->target = $target;
    }

    /**
     * @psalm-assert-if-true Uses $this
     */
    public function isUses(): bool
    {
        return true;
    }

    /**
     * @psalm-return non-empty-string
     */
    public function target(): string
    {
        return $this->target;
    }
}
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                              <?php declare(strict_types=1);
/*
 * This file is part of PHPUnit.
 *
 * (c) Sebastian Bergmann <sebastian@phpunit.de>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
namespace PHPUnit\Metadata;

/**
 * @psalm-immutable
 *
 * @no-named-arguments Parameter names are not covered by the backward compatibility promise for PHPUnit
 */
final class UsesClass extends Metadata
{
    /**
     * @psalm-var class-string
     */
    private readonly string $className;

    /**
     * @psalm-param 0|1 $level
     * @psalm-param class-string $className
     */
    protected function __construct(int $level, string $className)
    {
        parent::__construct($level);

        $this->className = $className;
    }

    /**
     * @psalm-assert-if-true UsesClass $this
     */
    public function isUsesClass(): bool
    {
        return true;
    }

    /**
     * @psalm-return class-string
     */
    public function className(): string
    {
        return $this->className;
    }

    /**
     * @psalm-return class-string
     *
     * @internal This method is not covered by the backward compatibility promise for PHPUnit
     */
    public function asStringForCodeUnitMapper(): string
    {
        return $this->className;
    }
}
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                         <?php declare(strict_types=1);
/*
 * This file is part of PHPUnit.
 *
 * (c) Sebastian Bergmann <sebastian@phpunit.de>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
namespace PHPUnit\Metadata;

/**
 * @psalm-immutable
 *
 * @no-named-arguments Parameter names are not covered by the backward compatibility promise for PHPUnit
 */
final class UsesDefaultClass extends Metadata
{
    /**
     * @psalm-var class-string
     */
    private readonly string $className;

    /**
     * @psalm-param 0|1 $level
     * @psalm-param class-string $className
     */
    protected function __construct(int $level, string $className)
    {
        parent::__construct($level);

        $this->className = $className;
    }

    /**
     * @psalm-assert-if-true UsesDefaultClass $this
     */
    public function isUsesDefaultClass(): bool
    {
        return true;
    }

    /**
     * @psalm-return class-string
     */
    public function className(): string
    {
        return $this->className;
    }
}
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                 <?php declare(strict_types=1);
/*
 * This file is part of PHPUnit.
 *
 * (c) Sebastian Bergmann <sebastian@phpunit.de>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
namespace PHPUnit\Metadata;

/**
 * @psalm-immutable
 *
 * @no-named-arguments Parameter names are not covered by the backward compatibility promise for PHPUnit
 */
final class UsesFunction extends Metadata
{
    /**
     * @psalm-var non-empty-string
     */
    private readonly string $functionName;

    /**
     * @psalm-param 0|1 $level
     * @psalm-param non-empty-string $functionName
     */
    public function __construct(int $level, string $functionName)
    {
        parent::__construct($level);

        $this->functionName = $functionName;
    }

    /**
     * @psalm-assert-if-true UsesFunction $this
     */
    public function isUsesFunction(): bool
    {
        return true;
    }

    /**
     * @psalm-return non-empty-string
     */
    public function functionName(): string
    {
        return $this->functionName;
    }

    /**
     * @internal This method is not covered by the backward compatibility promise for PHPUnit
     */
    public function asStringForCodeUnitMapper(): string
    {
        return '::' . $this->functionName;
    }
}
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                 <?php declare(strict_types=1);
/*
 * This file is part of PHPUnit.
 *
 * (c) Sebastian Bergmann <sebastian@phpunit.de>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
namespace PHPUnit\Metadata\Version;

use function version_compare;
use PHPUnit\Util\VersionComparisonOperator;

/**
 * @psalm-immutable
 *
 * @no-named-arguments Parameter names are not covered by the backward compatibility promise for PHPUnit
 */
final class ComparisonRequirement extends Requirement
{
    private readonly string $version;
    private readonly VersionComparisonOperator $operator;

    public function __construct(string $version, VersionComparisonOperator $operator)
    {
        $this->version  = $version;
        $this->operator = $operator;
    }

    public function isSatisfiedBy(string $version): bool
    {
        return version_compare($version, $this->version, $this->operator->asString());
    }

    public function asString(): string
    {
        return $this->operator->asString() . ' ' . $this->version;
    }
}
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                 <?php declare(strict_types=1);
/*
 * This file is part of PHPUnit.
 *
 * (c) Sebastian Bergmann <sebastian@phpunit.de>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
namespace PHPUnit\Metadata\Version;

use function preg_replace;
use PharIo\Version\Version;
use PharIo\Version\VersionConstraint;

/**
 * @psalm-immutable
 *
 * @no-named-arguments Parameter names are not covered by the backward compatibility promise for PHPUnit
 */
final class ConstraintRequirement extends Requirement
{
    private readonly VersionConstraint $constraint;

    public function __construct(VersionConstraint $constraint)
    {
        $this->constraint = $constraint;
    }

    /**
     * @psalm-suppress ImpureMethodCall
     */
    public function isSatisfiedBy(string $version): bool
    {
        return $this->constraint->complies(
            new Version($this->sanitize($version)),
        );
    }

    /**
     * @psalm-suppress ImpureMethodCall
     */
    public function asString(): string
    {
        return $this->constraint->asString();
    }

    private function sanitize(string $version): string
    {
        return preg_replace(
            '/^(\d+\.\d+(?:.\d+)?).*$/',
            '$1',
            $version,
        );
    }
}
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                     <?php declare(strict_types=1);
/*
 * This file is part of PHPUnit.
 *
 * (c) Sebastian Bergmann <sebastian@phpunit.de>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
namespace PHPUnit\Metadata\Version;

use function preg_match;
use PharIo\Version\UnsupportedVersionConstraintException;
use PharIo\Version\VersionConstraintParser;
use PHPUnit\Metadata\InvalidVersionRequirementException;
use PHPUnit\Util\InvalidVersionOperatorException;
use PHPUnit\Util\VersionComparisonOperator;

/**
 * @psalm-immutable
 *
 * @no-named-arguments Parameter names are not covered by the backward compatibility promise for PHPUnit
 */
abstract class Requirement
{
    private const VERSION_COMPARISON = '/(?P<operator>[<>=!]{0,2})\s*(?P<version>[\d\.-]+(dev|(RC|alpha|beta)[\d\.])?)[ \t]*\r?$/m';

    /**
     * @throws InvalidVersionOperatorException
     * @throws InvalidVersionRequirementException
     */
    public static function from(string $versionRequirement): self
    {
        try {
            return new ConstraintRequirement(
                (new VersionConstraintParser)->parse(
                    $versionRequirement,
                ),
            );
        } catch (UnsupportedVersionConstraintException) {
            if (preg_match(self::VERSION_COMPARISON, $versionRequirement, $matches)) {
                return new ComparisonRequirement(
                    $matches['version'],
                    new VersionComparisonOperator(
                        !empty($matches['operator']) ? $matches['operator'] : '>=',
                    ),
                );
            }
        }

        throw new InvalidVersionRequirementException;
    }

    abstract public function isSatisfiedBy(string $version): bool;

    abstract public function asString(): string;
}
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                            INDX( 	 c€>?          (   P  Ë       ⁄⁄e ⁄              3    ò Ñ     ›2    W˘†iÖz⁄ ˆM‰ug⁄W˘†iÖz⁄W˘†iÖz⁄       ∆              ! R e q u i r e s O p e r a t i n g S y s t e m F a m i l y . p h p     3    p `     ›2    W˘†iÖz⁄ ˆM‰ug⁄W˘†iÖz⁄W˘†iÖz⁄                      R e q u i r e s P h p . p h p 3    à r     ›2    l °iÖz⁄ ˆM‰ug⁄l °iÖz⁄l °iÖz⁄       ¯               R e q u i r e s P h p E x t e n s i o n . p h p       3    x h     ›2    l °iÖz⁄ ˆM‰ug⁄l °iÖz l °iÖz⁄                      R e q u i r e s P h p u n i t . p h p 3    x h     ›2    áG°iÖz⁄ ˆM‰ug⁄áG°iÖz⁄áG°iÖz⁄       r               R e q u i r e s S e t t i n g . p h p 3    ê |     ›2    áG°iÖz⁄ ˆM‰ug⁄áG°iÖz⁄áG°iÖz⁄à      É               R u n C l a s s I n S e p a r a t e P r o c e s s . p h p     3    à r     ›2    ân°iÖz⁄ ˆM‰ug⁄ân°iÖz⁄ân°iÖz⁄x      t               R u n I n S e p a r a t e P r o c e s s . p h p       3    ê Ä     ›2    ân°iÖz⁄ ˆM‰ug ân°iÖz⁄ân°iÖz⁄ê      â               R u n T e s t s I n S e p a r a t e P r o c e s s e s . p h p 3    h R     ›2    ¢ï°iÖz⁄ ˆM‰ug⁄¢ï°iÖz⁄¢ï°iÖz⁄H      D               T e s t . p h p       3    h X     ›2    ¢ï°iÖz⁄ ˆM‰ug⁄¢ï°iÖz⁄¢ï°iÖz⁄                      T e s t D o x . p h p 3    p Z     ›2    ¨º°iÖz⁄ ˆM‰ug⁄¨º°iÖz⁄¨º°iÖz⁄       y               T e s t W i t h . p h p       3    h R     ›2    ª„°iÖz⁄ ˆM‰ug⁄ª„°iÖz⁄ª„°iÖz⁄                      U s  s . p h p        3    p \     ›2    ª„°iÖz⁄ ˆM‰ug⁄ª„°iÖz⁄ª„°iÖz⁄       '               U s e s C l a s s . p h p     !3    Ä j     ›2    ¡
¢iÖz⁄ ˆM‰ug⁄¡
¢iÖz⁄¡
¢iÖz⁄       ?               U s e s D e f a u l t C l a s s . p h p       "3    x b     ›2    ¡
¢iÖz⁄ ˆM‰ug⁄¡
¢iÖz⁄¡
¢iÖz⁄       /               U s e s F u n c t i o n . p h p       #3    ` P     ›2    ¡
¢iÖz⁄ Ú5fm⁄!•lÖz⁄‰X¢iÖz⁄                        V e r s i o n '3    Ä p     ›2    ‰X¢iÖz⁄ ˆM‰ug ¯¢iÖz⁄¯¢iÖz⁄x      q               W i t h o u t E r r o r H a n d l e r . p h p                                                                                                                                                                         