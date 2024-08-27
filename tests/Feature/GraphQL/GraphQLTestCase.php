<?php

namespace Tests\Feature\GraphQL;

use Nuwave\Lighthouse\Testing\MakesGraphQLRequests;
use Tests\TestCase;

abstract class GraphQLTestCase extends TestCase {
    use MakesGraphQLRequests;
}
