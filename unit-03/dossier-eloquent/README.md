

```code
public function up(): void
{
    Schema::create('alumnos', function (Blueprint $table) {
        $table->id();
        $table->timestamps();
        $table->string('name',30)->nullable(false);
        $table->string('surename');
        $table->integer('age');
    });
}
```

```code
class Alumno extends Model{
    use HasFactory;
    /**
     * @var string
     */
    private $name;
    /**
     * @var string
     */
    private $surname;
    /**
     * @var int
     */
    private $age;

    //constructor
    public function __construct() {
        $this->name = "";
        $this->surname = "";
        $this->age = 1;
    }

    //getters and setters
    public function getName(): string {
        return $this->name;
    }
    public function setName(string $name): void {
        $this->name = $name;
    }
    public function getSurname(): string {
        return $this->surname;
    }
    public function setSurname(string $surname): void {
        $this->surname = $surname;
    }
    public function getAge(): int {
        return $this->age;
    }
    public function setAge(int $age): void {
        $this->age = $age;
    }


}


```


