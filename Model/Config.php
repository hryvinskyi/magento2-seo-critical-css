<?php
/**
 * Copyright (c) 2021. All rights reserved.
 * @author: Volodymyr Hryvinskyi <mailto:volodymyr@hryvinskyi.com>
 */

declare(strict_types=1);

namespace Hryvinskyi\SeoCriticalCss\Model;

use Hryvinskyi\Logger\Model\DebugConfigInterface;
use Magento\Framework\App\Config\ScopeConfigInterface;
use Magento\Framework\Serialize\SerializerInterface;
use Magento\Store\Model\ScopeInterface;

class Config implements ConfigInterface, DebugConfigInterface
{
    /**
     * Configuration paths
     */
    public const XML_CONF_ENABLED = 'hryvinskyi_seo/critical_css/enabled';
    public const XML_CONF_CRITICAL_CSS_TO_PAGES = 'hryvinskyi_seo/critical_css/critical_css_to_pages';
    public const XML_CONF_DEBUG = 'hryvinskyi_seo/critical_css/debug';

    /**
     * @var ScopeConfigInterface
     */
    private $scopeConfig;

    /**
     * @var SerializerInterface
     */
    private $serializer;

    /**
     * Config constructor.
     *
     * @param ScopeConfigInterface $scopeConfig
     * @param SerializerInterface $serializer
     */
    public function __construct(ScopeConfigInterface $scopeConfig, SerializerInterface $serializer)
    {
        $this->scopeConfig = $scopeConfig;
        $this->serializer = $serializer;
    }

    /**
     * @inheritDoc
     */
    public function isEnabled($scopeCode = null, string $scopeType = ScopeInterface::SCOPE_STORE): bool
    {
        return $this->scopeConfig->isSetFlag(self::XML_CONF_ENABLED, $scopeType, $scopeCode);
    }

    /**
     * @inheritDoc
     */
    public function getCriticalCss($scopeCode = null, string $scopeType = ScopeInterface::SCOPE_STORE): array
    {
        return $this->serializer->unserialize(
            $this->scopeConfig->getValue(self::XML_CONF_CRITICAL_CSS_TO_PAGES, $scopeType, $scopeCode)
        );
    }

    public function isDebug(): bool
    {
        return $this->scopeConfig->isSetFlag(self::XML_CONF_DEBUG);
    }
}
