<?php

namespace Zorbus\ApiBundle\Features\Context;

use Behat\Testwork\Hook\Scope\BeforeSuiteScope;
use Behat\Behat\Context\SnippetAcceptingContext;
use Behat\Gherkin\Node\PyStringNode;
use Behat\Gherkin\Node\TableNode;
use Behat\Symfony2Extension\Context\KernelAwareContext;
use Symfony\Component\HttpKernel\KernelInterface;
use Behat\MinkExtension\Context\MinkContext;

/**
 * Behat context class.
 */
class FeatureContext extends MinkContext implements SnippetAcceptingContext, KernelAwareContext
{

    protected $kernel;

    /**
     * Initializes context.
     *
     * Every scenario gets it's own context object.
     * You can also pass arbitrary arguments to the context constructor through behat.yml.
     */
    public function __construct()
    {
        
    }

    public function setKernel(KernelInterface $kernel)
    {
        $this->kernel = $kernel;
    }

    public function getKernel()
    {
        return $this->kernel;
    }
    
    /**
     * @BeforeSuite
     */
     public static function prepare(BeforeSuiteScope $event)
     {
         $rootDir = realpath(__DIR__.'/../../../../../app');
         
         $dropDatabase = $rootDir.'/console doctrine:database:drop --force --no-interaction --env=test';
         $createDatabase = $rootDir.'/console doctrine:database:create --no-interaction --env=test';
         $migrateDatabase = $rootDir.'/console doctrine:migrations:migrate --no-interaction --env=test';
         
         shell_exec($dropDatabase);
         shell_exec($createDatabase);
         shell_exec($migrateDatabase);
     }

}
