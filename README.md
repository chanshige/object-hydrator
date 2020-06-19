# ObjectHydrator

An ObjectHydrator that array to object to array conversion. It internally uses Symfony/Serializer (with ObjectNormalizer).

- オブジェクトから配列への変換
- 配列のデータを、特定のオブジェクトにセット

## installation
With Composer
```
$ composer require chanshige/object-hydrator 'v0.1'
```

## usage
    <?php
    require __DIR__ . '/vendor/autoload.php';
    
    use Chanshige\Hydration\Factory\ObjectHydratorFactory;
    
    class Example
    {
        /** @var string|null */
        private $foo;
    
        /** @var string|null */
        private $bar;
    
        /** @var string|null */
        private $baz;
    
        /**
         * @return string|null
         */
        public function getFoo(): ?string
        {
            return $this->foo;
        }
    
        /**
         * @param string|null $foo
         */
        public function setFoo(?string $foo): void
        {
            $this->foo = $foo;
        }
    
        /**
         * @return string|null
         */
        public function getBar(): ?string
        {
            return $this->bar;
        }
    
        /**
         * @param string|null $bar
         */
        public function setBar(?string $bar): void
        {
            $this->bar = $bar;
        }
    
        /**
         * @return string|null
         */
        public function getBaz(): ?string
        {
            return $this->baz;
        }
    
        /**
         * @param string|null $baz
         */
        public function setBaz(?string $baz): void
        {
            $this->baz = $baz;
        }
    }
    
    $data = ['foo' => 1, 'bar' => 2, 'baz' => 3];   

    $factory = new ObjectHydratorFactory();
    $hydrator = $factory->newHydrator();
    
    ### Put data from an array into an object. ###
    /** @var object */
    $result = $hydrator->hydrate($data, Example::class);
    
    ### Convert object to array. ###
    /** @var array */
    $array = $hydrator->extract($result);

## test
`$ composer test`

## coverage
![coverage](https://i.gyazo.com/2adb0ea8d6c8fa7ef9aca332f9f49f3d.png)

## License
MIT

## Author
[chanshige](https://twitter.com/chanshige)
