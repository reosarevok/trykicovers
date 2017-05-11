<?php

use Behat\Behat\Context\Context;
use Behat\Gherkin\Node\PyStringNode;
use Behat\Gherkin\Node\TableNode;
use Behat\MinkExtension\Context\MinkContext;

/**
 * Defines application features from the specific context.
 */
class FeatureContext extends MinkContext implements Context
{
    /**
     * Initializes context.
     *
     * Every scenario gets its own context instance.
     * You can also pass arbitrary arguments to the
     * context constructor through behat.yml.
     */
    public function __construct()
    {
    }

    /**
     * Click some text
     *
     * @When /^I click on the header "([^"]*)"$/
     */
    public function iClickOnTheHeader($text)
    {
        $session = $this->getSession();
        $element = $session->getPage()->find('css', sprintf('.checkbox-head:contains("%s")', $text));
        if (null === $element) {
            throw new \InvalidArgumentException(sprintf('Cannot find text: "%s"', $text));
        }

        $element->click();

    }

    /**
     * @Then I wait :sec
     */
    public function wait($sec){
        sleep($sec);
    }

    /**
     * @Then /^the results should include the test cover$/
     */
    public function theResultsShouldIncludeTheTestCover()
    {
        $this->assertElementOnPage( "a[href='cover.php?id=33']" );
    }

    /**
     * @Then /^the results should not include the test cover$/
     */
    public function theResultsShouldNotIncludeTheTestCover()
    {
        $this->assertElementNotOnPage( "a[href='cover.php?id=33']" );
    }

}
