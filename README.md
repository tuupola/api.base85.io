Demo api for encoding and decoding base85 data. Based on [Slim API Skeleton](https://github.com/tuupola/slim-api-skeleton).

## Usage

If you have [Vagrant](https://www.vagrantup.com/) installed start the virtual machine.

``` bash
$ cd app
$ vagrant up
```

Now you can access the development api at [https://192.168.50.56/encode](https://192.168.50.56/encode) and [https://192.168.50.56/decode](https://192.168.50.56/decode).


### Encode

```
$ curl http://api.base85.net/encode \
    --request POST \
    --include \
    --header "Content-Type:application/json" \
    --data '{"data": "Hello world!"}'

HTTP/1.1 200 OK
Content-Type: application/json

{
    "encoded": "T8dgcjRGuYUueWht"
}
```

### Decode

```
$ curl http://api.base85.net/decode  \
    --request POST \
    --include \
    --header "Content-Type:application/json"  \
    --data '{"data": "T8dgcjRGuYUueWht"}'

HTTP/1.1 200 OK
Content-Type: application/json

{
    "decoded": "Hello world!"
}
```

## License

The MIT License (MIT). Please see [License File](LICENSE.md) for more information.