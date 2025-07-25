<?php

/**
 * See LICENSE.md for license details.
 */

declare(strict_types=1);

namespace Netresearch\ShippingCore\Model\Util;

use Magento\Framework\App\Config\ScopeConfigInterface;
use Magento\Framework\Filesystem\DriverInterface;
use Magento\Framework\Logger\Handler\Base;
use Monolog\LogRecord;

class ApiLogHandler extends Base
{
    /**
     * @var string
     */
    private $logEnabledConfigPath;

    /**
     * @var string
     */
    private $logLevelConfigPath;

    /**
     * @var ScopeConfigInterface
     */
    private $scopeConfig;

    /**
     * ApiLogHandler constructor.
     *
     * @param DriverInterface $filesystem
     * @param ApiLogAnonymizer $anonymizer
     * @param string $logEnabledConfigPath
     * @param string $logLevelConfigPath
     * @param ScopeConfigInterface $scopeConfig
     * @param string|null $filePath
     * @param string|null $fileName
     * @throws \Exception
     */
    public function __construct(
        DriverInterface $filesystem,
        ApiLogAnonymizer $anonymizer,
        string $logEnabledConfigPath,
        string $logLevelConfigPath,
        ScopeConfigInterface $scopeConfig,
        ?string $filePath = null,
        ?string $fileName = null
    ) {
        parent::__construct($filesystem, $filePath, $fileName);

        $this->logEnabledConfigPath = $logEnabledConfigPath;
        $this->logLevelConfigPath = $logLevelConfigPath;
        $this->scopeConfig = $scopeConfig;

        $this->pushProcessor($anonymizer);
    }

    public function isHandling(LogRecord $record): bool
    {
        $loggingEnabled = (bool) $this->scopeConfig->getValue($this->logEnabledConfigPath);
        $logLevel = (int) $this->scopeConfig->getValue($this->logLevelConfigPath);

        return $loggingEnabled && $record['level'] >= $logLevel && parent::isHandling($record);
    }
}
