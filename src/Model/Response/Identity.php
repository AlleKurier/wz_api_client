<?php
/*
 * Identity.php
 *
 * @author AlleKurier
 * @license https://opensource.org/licenses/MIT The MIT License
 * @copyright Copyright (c) 2022 Allekurier Sp. z o.o.
 */

declare(strict_types=1);

namespace Allekurier\WygodneZwroty\Api\Model\Response;

use Allekurier\WygodneZwroty\Api\Lib\Common\Assert\Assert;

class Identity implements ResponseModelInterface
{
    private ?string $name;

    private ?string $company;

    private ?string $address;

    private ?string $postalCode;

    private ?string $city;

    private Country $country;

    private ?string $state;

    private ?string $phone;

    private ?string $email;

    private ?AccessPoint $accessPoint;

    /**
     * Konstruktor
     *
     * @param string|null $name
     * @param string|null $company
     * @param string|null $address
     * @param string|null $postalCode
     * @param string|null $city
     * @param Country $country
     * @param string|null $state
     * @param string|null $phone
     * @param string|null $email
     * @param AccessPoint|null $accessPoint
     */
    public function __construct(
        ?string $name,
        ?string $company,
        ?string $address,
        ?string $postalCode,
        ?string $city,
        Country $country,
        ?string $state,
        ?string $phone,
        ?string $email,
        ?AccessPoint $accessPoint
    ) {
        $this->name = $name;
        $this->company = $company;
        $this->address = $address;
        $this->postalCode = $postalCode;
        $this->city = $city;
        $this->country = $country;
        $this->state = $state;
        $this->phone = $phone;
        $this->email = $email;
        $this->accessPoint = $accessPoint;
    }

    /**
     * {@inheritDoc}
     */
    public static function createFromArray(array $data): self
    {
        if (!empty($data['name'])) {
            Assert::string($data['name']);
            $name = $data['name'];
        } else {
            $name = null;
        }

        if (!empty($data['company'])) {
            Assert::string($data['company']);
            $company = $data['company'];
        } else {
            $company = null;
        }

        if (!empty($data['address'])) {
            Assert::string($data['address']);
            $address = $data['address'];
        } else {
            $address = null;
        }

        if (!empty($data['postal_code'])) {
            Assert::string($data['postal_code']);
            $postalCode = $data['postal_code'];
        } else {
            $postalCode = null;
        }

        if (!empty($data['city'])) {
            Assert::string($data['city']);
            $city = $data['city'];
        } else {
            $city = null;
        }

        Assert::keyExists($data, 'country');
        Assert::isArray($data['country']);
        $country = Country::createFromArray($data['country']);

        if (!empty($data['state'])) {
            Assert::string($data['state']);
            $state = $data['state'];
        } else {
            $state = null;
        }

        if (!empty($data['phone'])) {
            Assert::string($data['phone']);
            $phone = $data['phone'];
        } else {
            $phone = null;
        }

        if (!empty($data['email'])) {
            Assert::string($data['email']);
            $email = $data['email'];
        } else {
            $email = null;
        }

        if (!empty($data['access_point'])) {
            Assert::isArray($data['access_point']);
            $accessPoint = AccessPoint::createFromArray($data['access_point']);
        } else {
            $accessPoint = null;
        }

        return new self(
            $name,
            $company,
            $address,
            $postalCode,
            $city,
            $country,
            $state,
            $phone,
            $email,
            $accessPoint
        );
    }

    /**
     * Pobranie nazwy osoby
     *
     * @return string|null
     */
    public function getName(): ?string
    {
        return $this->name;
    }

    /**
     * Pobranie nazwy firmy
     *
     * @return string|null
     */
    public function getCompany(): ?string
    {
        return $this->company;
    }

    /**
     * Pobranie adresu osoby/firmy
     *
     * @return string|null
     */
    public function getAddress(): ?string
    {
        return $this->address;
    }

    /**
     * Pobranie kodu pocztowego osoby/firmy
     *
     * @return string|null
     */
    public function getPostalCode(): ?string
    {
        return $this->postalCode;
    }

    /**
     * Pobranie miejscowości dla osoby/firmy
     *
     * @return string|null
     */
    public function getCity(): ?string
    {
        return $this->city;
    }

    /**
     * Pobranie kraju dla osoby/firmy
     *
     * @return Country
     */
    public function getCountry(): Country
    {
        return $this->country;
    }

    /**
     * Pobranie stanu, w którym znajduje się kraj z osobą/firmą
     *
     * @return string|null
     */
    public function getState(): ?string
    {
        return $this->state;
    }

    /**
     * Pobranie numeru telefonu do osoby/firmy
     *
     * @return string|null
     */
    public function getPhone(): ?string
    {
        return $this->phone;
    }

    /**
     * Pobranie adresu e-mail osoby/firmy
     *
     * @return string|null
     */
    public function getEmail(): ?string
    {
        return $this->email;
    }

    /**
     * Pobranie punktu nadania/odbioru paczki
     *
     * @return AccessPoint|null
     */
    public function getAccessPoint(): ?AccessPoint
    {
        return $this->accessPoint;
    }
}
