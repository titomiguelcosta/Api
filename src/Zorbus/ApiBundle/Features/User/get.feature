Feature:
    As an API user
    I want to retrieve a User resource
    So I can access a user details

    Scenario: As an authenticated API user I can retrieve details of a valid user
        Given I send a GET request to "users/galinha"
        Then the response should be in JSON
        And the response status code should be 200
        And the JSON node "user.username" should be equal to "galinha"