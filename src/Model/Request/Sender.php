<?php

namespace AlleKurier\WygodneZwroty\Api\Model\Request;

class Sender implements RequestModelInterface
{
    private string $name;

    private string $company;

    private string $address;

    private string $postalCode;

    private string $city;

    private string $country;

    private string $phone;

    private string $email;

    /** @see \AlleKurier\WygodneZwroty\Api\Model\ShipmentType */
    private string $shipmentType;

    public function __construct(
        string $name,
        string $company,
        string $address,
        string $postalCode,
        string $city,
        string $country,
        string $phone,
        string $email,
        string $shipmentType
    ) {
        $this->name = $name;
        $this->company = $company;
        $this->address = $address;
        $this->postalCode = $postalCode;
        $this->city = $city;
        $this->country = $country;
        $this->phone = $phone;
        $this->email = $email;
        $this->shipmentType = $shipmentType;
    }

    public function toArray(): array
    {
        return [
            'name' => $this->name,
            'company' => $this->company,
            'address' => $this->address,
            'postal_code' => $this->postalCode,
            'city' => $this->city,
            'country' => $this->country,
            'phone' => $this->phone,
            'email' => $this->email,
            'shipment_type' => $this->shipmentType,
        ];
    }
}
