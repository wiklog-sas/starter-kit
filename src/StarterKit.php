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

    public const PATH_PUBLISH_AUTH = self::PATH_RESOURCES.'publishAuth/';

    public const PATH_PUBLISH_COMMUN = self::PATH_RESOURCES.'publishCommun/';

    public const PATH_PUBLISH_COMPONENTS = self::PATH_RESOURCES.'publishComponents/';

    public const PATH_PUBLISH_CONTROLLER = self::PATH_RESOURCES.'publishController/';

    public const PATH_PUBLISH_DUMP = self::PATH_RESOURCES.'publishDump/';

    public const PATH_PUBLISH_EDITOR_CONFIG = self::PATH_RESOURCES.'publishEditorConfig/';

    public const PATH_PUBLISH_ENV = self::PATH_RESOURCES.'publishEnv/';

    public const PATH_PUBLISH_EXTEND_BLUEPRINT = self::PATH_RESOURCES.'publishExtendBlueprint/';

    public const PATH_PUBLISH_GIT = self::PATH_RESOURCES.'publishGit/';

    public const PATH_PUBLISH_HELPERS = self::PATH_RESOURCES.'publishHelpers/';

    public const PATH_PUBLISH_INSIGHTS = self::PATH_RESOURCES.'publishInsights/';

    public const PATH_PUBLISH_KERNEL = self::PATH_RESOURCES.'publishKernel/';

    public const PATH_PUBLISH_LARASTAN = self::PATH_RESOURCES.'publishLarastan/';

    public const PATH_PUBLISH_LIBRAIRIES_MIGRATION = self::PATH_RESOURCES.'publishLibrairiesMigration/';

    public const PATH_PUBLISH_PDF_MULTICELL = self::PATH_RESOURCES.'publishPdfMulticell/';

    public const PATH_PUBLISH_PHP_UNIT= self::PATH_RESOURCES.'publishPhpUnit/';

    public const PATH_PUBLISH_PINT = self::PATH_RESOURCES.'publishPint/';

    public const PATH_PUBLISH_POSTCSS = self::PATH_RESOURCES.'publishPostcss/';

    public const PATH_PUBLISH_README = self::PATH_RESOURCES.'publishReadme/';

    public const PATH_PUBLISH_RESOURCES_JS = self::PATH_RESOURCES.'publishResourcesJs/';

    public const PATH_PUBLISH_RESOURCES_SCSS = self::PATH_RESOURCES.'publishResourcesScss/';

    public const PATH_PUBLISH_RESOURCES_VIEWS = self::PATH_RESOURCES.'publishResourcesViews/';

    public const PATH_PUBLISH_STUBS = self::PATH_RESOURCES.'publishStubs/';

    public const PATH_PUBLISH_TRAITS = self::PATH_RESOURCES.'publishTraits/';

    public const PATH_PUBLISH_WEBFONTS = self::PATH_RESOURCES.'publishWebfonts/';

    public const PATH_PUBLISH_WORKFLOW = self::PATH_RESOURCES.'publishWorkflow/';
}
