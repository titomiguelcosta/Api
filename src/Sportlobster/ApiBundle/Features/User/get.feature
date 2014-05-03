Feature:
    As an API user
    I want to retrieve a User resource
    So I can access a user details

    Scenario: As an authenticated API user I can retrieve details of a valid user
        Given I send a GET request to "users/1"
        Then the response should be in JSON
        And print last JSON response
        And print last response