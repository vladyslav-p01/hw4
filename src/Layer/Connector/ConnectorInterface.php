<?php

namespace Layer\Connector;

/**
 * Interface ConnectorInterface
 * @package Layer\Connector
 */
interface ConnectorInterface
{
    /**
     * @param $db
     * @return mixed
     */
    public function connect();
    public function connectClose();
}