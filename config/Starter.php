<?php

namespace Wiklog\StarterKit\Starter;

class Starter
{
    public const PREFIX_CMD = 'starter:';

    public const RACINE_PATH = __DIR__.'/../';

    public const MIGRATION_PATH = self::RACINE_PATH.'database/migrations/';

    public const FACTORIES_PATH = self::RACINE_PATH.'database/factories/';

    public const RESOURCES_PATH = self::RACINE_PATH.'resources/';
}
