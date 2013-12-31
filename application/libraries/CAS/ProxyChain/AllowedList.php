<?php

/**
 * Licensed to Jasig under one or more contributor license
 * agreements. See the NOTICE file distributed with this work for
 * additional information regarding copyright ownership.
 *
 * Jasig licenses this file to you under the Apache License,
 * Version 2.0 (the "License"); you may not use this file except in
 * compliance with the License. You may obtain a copy of the License at:
 *
 * http://www.apache.org/licenses/LICENSE-2.0
 *
 * Unless required by applicable law or agreed to in writing, software
 * distributed under the License is distributed on an "AS IS" BASIS,
 * WITHOUT WARRANTIES OR CONDITIONS OF ANY KIND, either express or implied.
 * See the License for the specific language governing permissions and
 * limitations under the License.
 *
 * PHP Version 5
 *
 * @file     CAS/ProxyChain/AllowedList.php
 * @category Authentication
 * @package  PhpCAS
 * @author   Adam Franco <afranco@middlebury.edu>
 * @license  http://www.apache.org/licenses/LICENSE-2.0  Apache License 2.0
 * @link     https://wiki.jasig.org/display/CASC/CAS
 */


/**
 * ProxyChain is a container for storing chains of valid proxies that can
 * be used to validate proxied requests to a service
 *
 * @class    CAS_ProxyChain_AllowedList
 * @category Authentication
 * @package  PhpCAS
 * @author   Adam Franco <afranco@middlebury.edu>
 * @license  http://www.apache.org/licenses/LICENSE-2.0  Apache License 2.0
 * @link     https://wiki.jasig.org/display/CASC/CAS
 */

class CAS_ProxyChain_AllowedList
{

    private $_chains = array();

    /**
     * Check whether proxies are allowed by configuration
     *
     * @return bool
     */
    public function isProxyingAllowed()
    {
        return (count($this->_chains) > 0);
    }

    /**
     * Add a chain of proxies to the list of possible chains
     *
     * @param CAS_ProxyChain_Interface $chain A chain of proxies
     *
     * @return void
     */
    public function allowProxyChain(CAS_ProxyChain_Interface $chain)
    {
        $this->_chains[] = $chain;
    }

    /**
     * Check if the proxies found in the response match the allowed proxies
     *
     * @param array $proxies list of proxies to check
     *
     * @return bool whether the proxies match the allowed proxies
     */
    public function isProxyListAllowed(array $proxies)
    {
        CAS::traceBegin();
        if (empty($proxies)) {
            CAS::trace("No proxies were found in the response");
            CAS::traceEnd(true);
            return true;
        } elseif (!$this->isProxyingAllowed()) {
            CAS::trace("Proxies are not allowed");
            CAS::traceEnd(false);
            return false;
        } else {
            $res = $this->contains($proxies);
            CAS::traceEnd($res);
            return $res;
        }
    }

    /**
     * Validate the proxies from the proxy ticket validation against the
     * chains that were definded.
     *
     * @param array $list List of proxies from the proxy ticket validation.
     *
     * @return if any chain fully matches the supplied list
     */
    public function contains(array $list)
    {
        CAS::traceBegin();
        $count = 0;
        foreach ($this->_chains as $chain) {
            CAS::trace("Checking chain ". $count++);
            if ($chain->matches($list)) {
                CAS::traceEnd(true);
                return true;
            }
        }
        CAS::trace("No proxy chain matches.");
        CAS::traceEnd(false);
        return false;
    }
}
?>
