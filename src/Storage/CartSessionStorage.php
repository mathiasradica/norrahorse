<?php

namespace App\Storage;

use App\Entity\Cart;
use Symfony\Component\HttpFoundation\Session\SessionInterface;

use Symfony\Component\Serializer\Encoder\JsonEncoder;
use Symfony\Component\Serializer\Normalizer\ObjectNormalizer;
use Symfony\Component\Serializer\Serializer;
use Symfony\Component\Serializer\Normalizer\ArrayDenormalizer;
use Symfony\Component\PropertyInfo\Extractor\ReflectionExtractor;

/**
 * Class CartSessionStorage
 * @package App\Storage
 */

class CartSessionStorage
{
    /**
     * The session storage.
     *
     * @var SessionInterface
     */
    private $session;

    /**
     * @var string
     */
    const CART_KEY_NAME = 'cart_id';

    /**
     * CartSessionStorage constructor.
     *
     * @param SessionInterface $session
     */
    public function __construct(SessionInterface $session)
    {
        $this->session = $session;
    }

    /**
     * Gets the cart in session.
     *
     * @return Cart
     */
    public function getCart(): ?Cart
    {
        $encoders = [new JsonEncoder()];
        $normalizers = [new ObjectNormalizer(
            null,
            null,
            null,
            new ReflectionExtractor()),
            new ArrayDenormalizer()];

        $serializer = new Serializer($normalizers, $encoders);

        return $this->session->get('cart_id') ? $serializer->deserialize($this->session->get('cart_id'), Cart::class, 'json') : new Cart();
    }

    /**
     * Sets the cart in session.
     *
     * @param Order $cart
     */
    public function setCart(Cart $cart): void
    {
        $encoders = [new JsonEncoder()];
        $normalizers = [new ObjectNormalizer()];

        $serializer = new Serializer($normalizers, $encoders);

        $this->session->set(self::CART_KEY_NAME, $serializer->serialize($cart, 'json'));
    }
}
