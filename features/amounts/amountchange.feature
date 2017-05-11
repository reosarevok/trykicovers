Feature: Change amounts
  In order to be able to keep track of the covers
  As a logged-in website user
  I need to be able to change the amounts of covers and reservations

  Background:
    Given I am logged in
    And I go to "/cover.php?id=33"
    And I save a screenshot to "shot.png"
    Then I break

  @javascript
  Scenario Outline: Change amounts
    Given I press "<type>-plus"
    And I wait 2
    Then the "<type>" field should contain "1"
    Given I press "<type>-minus"
    And I wait 2
    Then the "<type>" field should contain "0"

    Examples:
      | type |
      | amount |
      | reservation |