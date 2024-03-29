<?php

namespace Wiklog\StarterKit;

class StarterKit
{
    /* php artisan [signature] */
    public const PREFIX_SIGNATURE = 'starter:';

    public const PATH_RACINE = __DIR__.'/../';

    public const PATH_MIGRATION = self::PATH_RACINE.'database/migrations/';

    public const PATH_FACTORIES = self::PATH_RACINE.'database/factories/';

    public const PATH_RESOURCES = self::PATH_RACINE.'resources/';

    public const PATH_PUBLISH_COMMUN = self::PATH_RACINE.'publishCommun/';

    public const PATH_PUBLISH_COMPONENTS = self::PATH_RACINE.'publishComponents/';

    public const PATH_PUBLISH_LIBRAIRIES_MIGRATION = self::PATH_RACINE.'publishLibrairiesMigration/';

    public const PATH_PUBLISH_PDF_MULTICELL = self::PATH_RACINE.'publishPdfMulticell/';

    public const PATH_PUBLISH_STUBS = self::PATH_RACINE.'publishStubs/';
}
