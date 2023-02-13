<?php 

namespace App\Tests;

use ApiPlatform\Symfony\Bundle\Test\ApiTestCase;
use App\Entity\Review;

class ReviewTest extends ApiTestCase
{
  public function testGetCollection(): void
  {
    // The client implements Symfony HttpClient's `HttpClientInterface`, and the response `ResponseInterface`
    static::createClient()->request('GET', '/reviews');

    // $this->assertResponseIsSuccessful();
    // Asserts that the returned content type is JSON-LD (the default)
    $this->assertResponseHeaderSame('content-type', 'application/ld+json; charset=utf-8');

    // Asserts that the returned JSON is a superset of this one
    $this->assertJsonContains([
      '@context' => 'contexts/Review',
      '@id' => '/reviews',
      '@type' => 'hydra:Collection',
      'hydra:totalItems' => 100,
      'hydra:view' => [
        '@id' => '/reviews/1',
        "@type" => "Review",
        '@type' => 'hydra:Collection',
        'hydra:member' => [
          [
            '@id' => '/reviews/1',
            '@type' => 'Review',
            'id' => 1,
            'rate' => 2,
            'description' => 'Moyen',
            'user' => [
              '@id' => '/users/8',
              '@type' => 'User',
              'id' => 8,
              'firstname' => 'Waruny',
              'lastname' => 'Rajendran'
            ],
            'spaUser' => [
              '@id' => '/users/7',
              '@type' => 'User',
              'id' => 7,
              'firstname' => 'John',
              'lastname' => 'Doe'
            ],
            'isValidate' => false
          ],
          [
            '@id' => '/reviews/2',
            '@type' => 'Review',
            'id' => 2,
            'rate' => 2,
            'description' => 'untest',
            'user' => [
              '@id' => '/users/8',
              '@type' => 'User',
              'id' => 8,
              'firstname' => 'Waruny',
              'lastname' => 'Rajendran'
            ],
            'spaUser' => [
              '@id' => '/users/7',
              '@type' => 'User',
              'id' => 7,
              'firstname' => 'John',
              'lastname' => 'Doe'
            ],
            'isValidate' => false
          ]
        ],
      ],
    ]);

    // Because test fixtures are automatically loaded between each test, you can assert on them
    // $this->assertCount(30, $response->toArray()['hydra:member']);

    // Asserts that the returned JSON is validated by the JSON Schema generated for this resource by API Platform
    // This generated JSON Schema is also used in the OpenAPI spec!
    $this->assertMatchesResourceCollectionJsonSchema(Review::class);
  }

  public function testCreateReview() : void 
  {
    $reponse = static::createClient()->request('POST', '/reviews', ['json' => [
      'rate' => 2,
      'description' => 'This is a review description',
      'user' => '/users/8',
      'spaUser' => '/users/7',
      'isValidate' => false
    ]]);

    $this->assertResponseStatusCodeSame(201);
    $this->assertResponseHeaderSame('content-type', 'application/ld+json; charset=utf-8');
    $this->assertJsonContains([
      '@context' => '/contexts/Review',
      '@type' => 'Review',
      'description' => 'This is a review description.',
      'user' => '/users/8',
      'spaUser' => '/users/7',
      'isValidate' => false
    ]);

    $this->assertMatchesRegularExpression('~^/review/\d+$~', $response->toArray()['@id']);
    $this->assertMatchesResourceItemJsonSchema(Review::class);
  }

}