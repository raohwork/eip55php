Helper to format/validate Ethereum address in EIP55 format.

# Synopsis

```php
use Shoutloud\EIP55\Address;

Address::format("0xabc"); // 0x0000000000000000000000000000000000000aBc
Address::validate("0x0000000000000000000000000000000000000aBc"); // true
Address::validate("0x0000000000000000000000000000000000000abc"); // false
```

# License

MPLv2.0

Copyright

- 2021- Ronmi Ren <ronmi.ren@gmail.com>
