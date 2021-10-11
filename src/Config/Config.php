<?php

namespace Simpliers\Parampos\Config;

class Config
{
    private $environment;
    private $client_code;
    private $client_username;
    private $client_password;
    private $guid;
    private $save_log;

    /**
     * @return mixed
     */
    public function getEnvironment()
    {
        return $this->environment;
    }

    /**
     * @param mixed $environment
     * @return Config
     */
    public function setEnvironment($environment)
    {
        $this->environment = $environment;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getClientCode()
    {
        return $this->client_code;
    }

    /**
     * @param mixed $client_code
     * @return Config
     */
    public function setClientCode($client_code)
    {
        $this->client_code = $client_code;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getClientUsername()
    {
        return $this->client_username;
    }

    /**
     * @param mixed $client_username
     * @return Config
     */
    public function setClientUsername($client_username)
    {
        $this->client_username = $client_username;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getClientPassword()
    {
        return $this->client_password;
    }

    /**
     * @param mixed $client_password
     * @return Config
     */
    public function setClientPassword($client_password)
    {
        $this->client_password = $client_password;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getGuid()
    {
        return $this->guid;
    }

    /**
     * @param mixed $guid
     * @return Config
     */
    public function setGuid($guid)
    {
        $this->guid = $guid;
        return $this;
    }

    /**
     * @return bool
     */
    public function getSaveLog()
    {
        return $this->save_log;
    }

    /**
     * @param bool $save_log
     * @return Config
     */
    public function setSaveLog($save_log)
    {
        $this->save_log = $save_log;
        return $this;
    }


}