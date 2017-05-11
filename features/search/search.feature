Feature: Search for covers
  In order to find covers for customer orders
  As a museum workers
  I need to be able to search for covers that match specific info

  @javascript
  Scenario: Try to search for a cover that we're out of
    Given I am on the search page
    When I search for the title "Test"
    And I run the search
    Then the results should not include the test cover

  @javascript
  Scenario: Try to search for a cover that we're out of, while specifically allowing it
    Given I am on the search page
    When I search for the title "Test"
    And I allow showing used covers
    And I run the search
    Then the results should include the test cover

  @javascript
  Scenario: Try to search for a cover using tags
    Given I am on the search page
    When I search for the product "Artisan"
    And I search for the width "12 to 14 cm"
    And I allow showing used covers
    And I run the search
    Then the results should include the test cover

  @javascript
  Scenario: Try to search for a cover using the wrong tags
    Given I am on the search page
    When I search for the product "Artisan"
    And I search for the width "More than 14 cm"
    And I allow showing used covers
    And I run the search
    Then the results should not include the test cover