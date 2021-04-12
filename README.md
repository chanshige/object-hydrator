# ObjectHydrator

An ObjectHydrator that array to object to array conversion. It internally uses Symfony/Serializer (with ObjectNormalizer).

- オブジェクトから配列への変換
- 配列のデータを、特定のオブジェクトにセット

## installation
With Composer
```
$ composer require chanshige/object-hydrator 'v1.0'
```

## Usage
    /** @var ObjectHydratorInterface $hydrator */
    $hydrator = (new ObjectHydratorFactory())->newInstance();

    ### Put data from an array into an object. ###
    /** @var Example $object */
    $object = $hydrator->hydrate(array or stdClass, Example::class);
    
    ### Convert object to array. ###
    /** @var array */
    $array = $hydrator->extract($object);

## Test
`$ composer test`

## Contributing
Feel free to create issues and submit pull requests. For any PR submitted, make sure it is covered by tests or include new tests.

## Security
If you discover any security related issues, please email author email instead of using the issue tracker.

## License
MIT

## Author
[chanshige](https://twitter.com/chanshige)
