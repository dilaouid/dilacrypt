# dilacrypt
A file encrypter in PHP, inspired by the Vigenere method.

## How to use
**This project is made to be runned in a local server ! You can deploy it in an online server, but it won't be safe for you.**
Clone this repo in your '*www*' folder of wamp or '*htdocs*' in xampp. You can also use this command line to run the project:
```shell
php -S 127.0.0.1:80 dilacrypt/index.php
```
Right there, you can navigate to `127.0.0.1:80` to use dilacrypt. Make sure that you have PHP installed in your machine first.

## How does it works
Like the Vigenere method, it sums the alphabetical position of each characters in the message with the key's. In order to make it safiest, it doesn't sum the alphabetical position, but the ASCII position of each character of the base64's file. The length of the key is added as an operand, so it's not possible to bruteforce the crypted file.

Here is an example of some txt file after being encrypted after a defined key:

| Key 	| Message in a txt file 	| Render 	|
|-	|-	|-	|
| 123 	| hello 	| �\|���}lr 	|
| !" 	| AMON 	| tyTtw�`a 	|
| fgd568FGDF123ds 	| Hello this is me, dilaouid! 	| Ƚɷ�������������솹��ͺ�����ٮ�ԛ�� 	|

## Configuration
The file `bin/config.php` contains a macro called `EXTENSIONS`, feel free to change the values of this array to add or remove extensions. They aren't really important, it justs define the extension the decrypted file will have for the download.

## FAQ
### It says I can't upload my file, that the size exceeds the limit!
No worries. You just have to change the `upload_max_filesize` and `post_max_size` in your **php.ini** file, and restart your apache server (`post_max_size` should have a greater value than `upload_max_filesize`).

## Where is the php.ini file ????
Just add this in top of your `index.php`:
```php
echo phpinfo();
```
And refresh the page, you will have the complete path of your **php.ini** !
