<?php

namespace App\Http\Resources\Faker;

use Illuminate\Http\Request;
use Illuminate\Support\Str;

class PersonResource extends BaseResource
{
    /**
     * A description of the resource used for the documentation page of this resource.
     *
     * @return string
     */
    public static function description(): string
    {
        return 'Generates random personal information including name, email, phone number, birthday';
    }

    public static function longDescription(): string
    {
        return 'This resource generates random personal data using Faker. It includes fields such as first name, last name,
        email, phone number, birthday';
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

        $birthdayStart = $this->params["birthday_start"] ?? '-90 years';
        $birthdayEnd = $this->params["birthday_end"] ?? 'now';

        $firstname = $this->faker->firstName($gender);
        $lastname = $this->faker->lastName();

        return [
            'id'            => $this->counter,
            'firstname'     => $firstname,
            'lastname'      => $lastname,
            'email'         => $this->faker->safeEmail(),
            'phone'         => $this->faker->e164PhoneNumber(),
            'birthday'      => $this->faker->dateTimeBetween($birthdayStart, $birthdayEnd)->format('Y-m-d'),
            'gender'        => $gender,
            'address'       => (new AddressResource($request, $this->faker, $this->params))->resolve(),
            'website'       => 'https://'.$this->faker->domainName(),
            'image'         => 'https://picsum.photos/seed/' . Str::slug($firstname . '-' . $lastname) . '/480/640',
        ];
    }
}
