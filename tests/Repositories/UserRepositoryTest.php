<?php

use App\Entities\User;
use App\Repositories\UserRepository;

/**
 * @property \Mockery\MockInterface entity
 * @property UserRepository repository
 */
class UserRepositoryTest extends TestCase
{

    public function setUp()
    {
        parent::setUp();

        $this->entity = $this->mock(User::class);
        $this->repository = new UserRepository($this->entity);
    }

    public function test_store()
    {
        $id = $this->faker()->randomNumber();
        $firstName = $this->faker()->firstName;
        $lastName = $this->faker()->lastName;
        $username = $this->faker()->userName;

        $values = [
            'chat_id' => $id,
            'first_name' => $firstName,
            'last_name' => $lastName,
            'username' => $username,
        ];

        $this->entity->shouldReceive('firstOrCreate')->with(['chat_id' => $id], $values)->andReturnSelf();

        $user = $this->repository->store($id, $firstName, $lastName, $username);

        $this->assertSame($this->entity, $user);
    }

}