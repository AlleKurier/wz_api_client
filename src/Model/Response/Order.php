<?php
/*
 * Order.php
 *
 * @author AlleKurier
 * @license https://opensource.org/licenses/MIT The MIT License
 * @copyright Copyright (c) 2022 Allekurier Sp. z o.o.
 */

declare(strict_types=1);

namespace AlleKurier\WygodneZwroty\Api\Model\Response;

class Order implements ResponseModelInterface
{
    private string $hid;

    private User $user;

    private Identity $sender;

    private array $additionalFields;

    /**
     * Konstruktor
     *
     * @param string $hid
     * @param User $user
     * @param Identity $sender
     * @param array $additionalFields
     */
    private function __construct(string $hid, User $user, Identity $sender, array $additionalFields)
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
        $hid = $data['hid'];
        $user = User::createFromArray($data['user']);
        $sender = Identity::createFromArray($data['sender']);
        $additionalFields = !empty($data['additional_fields'])
            ? $data['additional_fields']
            : [];

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
     * @return string
     */
    public function getHid(): string
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
