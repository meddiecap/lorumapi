<?php

namespace App\Http\Resources\Faker;

use Illuminate\Http\Request;
use Illuminate\Support\Str;

class UserResource extends BaseResource
{
    /**
     * A description of the resource used for the documentation page of this resource.
     *
     * @return string
     */
    public static function description(): string
    {
        return 'Generates random user profiles with first name, last name, username, password, email, IP address, MAC
        address, website, and image URL.';
    }

    public static function longDescription(): string
    {
        return 'This resource generates random user data using Faker. It includes fields such as first name, last name,
        username, password, email, IP address, MAC address, website, and image URL.
        The image URL is generated based on the first and last name to ensure uniqueness.';
    }

    protected $genders = ['male', 'female', 'other'];

    /**
     * Transform the resource into an array.
     *
     * @param Request $request
     * @return array
     */
    public function toArray(Request $request): array
    {
        $gender = $this->params["gender"] ?? $this->genders[array_rand($this->genders)];

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
