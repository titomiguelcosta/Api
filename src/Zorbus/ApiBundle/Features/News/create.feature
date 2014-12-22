Feature:
    As an API user
    I want to create a new News resource
    So I can add content to the system

    Scenario: As an authenticated API user I create a new news
        Given I send a POST request to "news" with parameters:
            | key        | value                                    |
            | title      | A new news                               |
            | content    | <p>This is the body of the news.</p>     |
            | photo      | @News/bbc.jpg                            |
        Then the response should be in JSON
        And the response status code should be 201
        And the JSON node "news.title" should be equal to "A new news"
        And the JSON node "news.content" should be equal to "<p>This is the body of the news.</p>"
        And the JSON node "news.slug" should be equal to "a-new-news"
        And the JSON node "news.photo_name" should exist
        And the JSON node "news.photo_path" should exist
        And the JSON node "news.photo_mime_type" should exist
        And the JSON node "news.created_at" should exist
        And the JSON node "news.updated_at" should exist