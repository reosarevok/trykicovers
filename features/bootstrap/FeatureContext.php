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

    /**
     * @Given /^I am on the search page$/
     */
    public function iAmOnTheSearchPage()
    {
        $this->visit("search.php");
    }

    /**
     * @Given /^I allow showing used covers$/
     */
    public function iAllowShowingUsedCovers()
    {
        $this->checkOption( "Also show used covers");
    }

    /**
     * @Given /^I run the search$/
     */
    public function iRunTheSearch()
    {
        $this->pressButton("Enter");
        $this->wait(1);
    }

    /**
     * @When /^I search for the title "([^"]*)"$/
     */
    public function iSearchForTheTitle($title)
    {
        $this->fillField("title", $title);
    }

    /**
     * @When /^I search for the product "([^"]*)"$/
     */
    public function iSearchForTheProduct($product)
    {
        $this->iClickOnTheHeader("For which products?");
        $this->checkOption($product);
    }

    /**
     * @Given /^I search for the width "([^"]*)"$/
     */
    public function iSearchForTheWidth($width)
    {
        $this->iClickOnTheHeader("What width?");
        $this->checkOption($width);
    }


}
