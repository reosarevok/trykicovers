Feature: Log in
  In order to be able to reserve covers
  As a website user
  I need to be able to log in with the right password

  Background:
    Given I am on "/"
    And I follow "Log in"

##  @javascript
  Scenario: Try to log in with the right password
    Given I fill in "username" with "reosarevok"
    And I fill in "password" with "sarevok1"
    And I press "Login"
    And I wait 2
    Then I should see "Hi, reosarevok!"

  Scenario: Try to log in with the wrong password
    Given I fill in "username" with "reosarevok"
    And I fill in "password" with "not-sarevok1"
    And I press "Login"
    And I wait 2
    Then I should see "That was WRONG!"
