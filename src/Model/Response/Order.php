<?php
/*
 * Order.php
 *
 * @author AlleKurier
 * @license https://opensource.org/licenses/MIT The MIT License
 * @copyright Copyright (c) 2022 Allekurier Sp. z o.o.
 */

declare(strict_types=1);

namespace Allekurier\WygodneZwroty\Api\Model\Response;

use Allekurier\WygodneZwroty\Api\Lib\Common\Assert\Assert;
use Allekurier\WygodneZwroty\Api\Lib\Common\Uuid\Uuid;

class Order implements ResponseModelInterface
{
    private Uuid $hid;

    private User $user;

    private Identity $sender;

    private array $additionalFields;

    /**
     * Konstruktor
     *
     * @param Uuid $hid
     * @param User $user
     * @param Identity $sender
     * @param array $additionalFields
     */
    private function __construct(Uuid $hid, User $user, Identity $sender, array $additionalFields)
    {
        $this->hid = $hid;
        $this->user = $user;
        $this->sender = $sender;
        $this->additionalFields = $additionalFields;
    }

    /**
     * {@inheritDoc}
     */
    public static function createFromArray(array $data): self
    {
        Assert::keyExists($data, 'hid');
        Assert::string($data['hid']);
        $hid = new Uuid($data['hid']);

        Assert::keyExists($data, 'user');
        Assert::isArray($data['user']);
        $user = User::createFromArray($data['user']);

        Assert::keyExists($data, 'sender');
        Assert::isArray($data['sender']);
        $sender = Identity::createFromArray($data['sender']);

        if (!empty($data['additional_fields'])) {
            Assert::string($data['additional_fields']);
            $additionalFields = $data['additional_fields'];
        } else {
            $additionalFields = [];
        }

        return new self(
            $hid,
            $user,
            $sender,
            $additionalFields
        );
    }

    /**
     * Pobranie identyfikatora przesyłki
     *
     * @return Uuid
     */
    public function getHid(): Uuid
    {
        return $this->hid;
    }

    /**
     * Pobranie danych użytkownika, do którego należy przesyłka
     *
     * @return User
     */
    public function getUser(): User
    {
        return $this->user;
    }

    /**
     * Pobranie danych nadawcy przesyłki
     *
     * @return Identity
     */
    public function getSender(): Identity
    {
        return $this->sender;
    }

    /**
     * Pobranie dodatkowych pól opisujących przesyłkę
     *
     * @return array
     */
    public function getAdditionalFields(): array
    {
        return $this->additionalFields;
    }
}
