<?php
/**
 * Copyright (c) 2021. All rights reserved.
 * @author: Volodymyr Hryvinskyi <mailto:volodymyr@hryvinskyi.com>
 */

declare(strict_types=1);

namespace Hryvinskyi\SeoCriticalCss\Model;

use Magento\Store\Model\ScopeInterface;

interface ConfigInterface
{
    /**
     * @param mixed $scopeCode
     * @param string $scopeType
     *
     * @return bool
     */
    public function isEnabled($scopeCode = null, string $scopeType = ScopeInterface::SCOPE_STORE): bool;

    /**
     * @param null $scopeCode
     * @param string $scopeType
     *
     * @return array
     */
    public function getCriticalCss($scopeCode = null, string $scopeType = ScopeInterface::SCOPE_STORE): array;
}
