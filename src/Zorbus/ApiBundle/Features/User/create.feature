Feature:
    As an API user
    I want to create a new User resource
    So I can add him to the system

    Scenario: As an authenticated API user I create a new user
        Given I send a POST request to "users" with parameters:
            | key           | value         |
            | username      | galinha       |
        Then the response should be in JSON
        And the response status code should be 201
        And the JSON node "user.username" should be equal to "galinha"