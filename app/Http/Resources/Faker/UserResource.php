<?php

namespace App\Http\Resources\Faker;

use Illuminate\Http\Request;
use Illuminate\Support\Str;

class UserResource extends BaseResource
{
    protected $genders = ['male', 'female', 'other'];

    /**
     * Transform the resource into an array.
     *
     * @param Request $request
     * @return array
     */
    public function toArray(Request $request): array
    {
        $gender = $request->get('_gender', $this->genders[array_rand($this->genders)]);

        $firstName = $this->faker->firstName($gender);
        $lastName = $this->faker->lastName();

        return [
            'id'            => $this->counter,
            'uuid'          => $this->faker->uuid(),
            'firstname'     => $firstName,
            'lastname'      => $lastName,
            'username'      => $this->faker->userName(),
            'password'      => $this->faker->password(),
            'email'         => $this->faker->email(),
            'ip'            => $this->faker->ipv4(),
            'macAddress'    => $this->faker->macAddress(),
            'website'       => 'https://'.$this->faker->domainName(),
            'image'         => 'https://picsum.photos/seed/' . Str::slug($firstName . '-' . $lastName) . '/480/640'
        ];
    }
}
