<?php

namespace ANSR\Services\DatabaseCreator\Config;

interface IConfig
{
    public function getHost();

    public function getDb();

    public function getUser();

    public function getPassword();

    public function getDsn();
}