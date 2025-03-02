// src/Entity/User.php
#[ORM\Entity]
class User implements UserInterface
{
    #[ORM\Id, ORM\GeneratedValue, ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private string $name;

    #[ORM\Column(length: 255, unique: true)]
    private string $email;

    #[ORM\Column(length: 255)]
    private string $username;

    #[ORM\Column(type: 'text')]
    private string $address;

    #[ORM\Column(type: 'string', enumType: Role::class)]
    private Role $role;

    // Getters and setters
}