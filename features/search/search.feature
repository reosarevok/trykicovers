Feature: Search for covers
  In order to find covers for customer orders
  As a museum workers
  I need to be able to search for covers that match specific info

  @javascript
  Scenario: Try to search for a cover that we're out of
    Given I go to "/search.php"
    And I fill in "title" with "Test"
    And I press "Enter"
    And I wait 1
    Then the results should not include the test cover

  Scenario: Try to search for a cover that we're out of, while specifically allowing it
    Given I go to "/search.php"
    And I fill in "title" with "Test"
    And I check "Also show used covers"
    And I press "Enter"
    And I wait 1
    Then the results should include the test cover

  Scenario: Try to search for a cover using tags
    Given I go to "/search.php"
    And I check "12 to 14 cm"
    And I check "Also show used covers"
    And I press "Enter"
    And I wait 1
    Then the results should include the test cover

  Scenario: Try to search for a cover using the wrong tags
    Given I go to "/search.php"
    And I check "More than 14 cm"
    And I check "Also show used covers"
    And I press "Enter"
    And I wait 1
    Then the results should not include the test cover