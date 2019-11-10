# SmartChef Backend
Backend: 
![alt text](https://i.pinimg.com/originals/44/f0/0d/44f00d6dc54c73e29bcc362c1bd5cd8a.png "SmartChef Backend")

## RECOMENDACIONES
Mis panitas, cuando clonen el proyecto no olviden:

1. Abrir terminal y ejecutar: 
```
composer install
```
Esto les descargará todas las dependencias del proyecto y del Framework Laravel-Lumen

2. No se les olvide muchachos que se requiere como mínimo php 7.1, además de tener el driver `pdo_pgsql` y `pgsql` disponible, ya que la base de datos es PostgreSQL.

3. IMPORTANTE TEMA DE JWT: Hacer dos cambios:
    - On vendor/laravel/lumen-framework/config/auth.php

```
...
	'guards' => [
        'api' => [
            'driver' => 'jwt',
            'provider' => 'users'
        ],
    ],
	...
	'providers' => [
        'users' => [
            'driver' => 'eloquent',
            'model'  => \App\User::class,
        ],
    ],
```

    - On vendor/illuminate/auth/EloquentUserProvider.php on line 133 for password encrypt

```
    /*CODE ...*/

	public function validateCredentials(UserContract $user, array $credentials){
		/** Note that 'pass' is the name of password column on DB */
        $plain = $credentials['pass'];
		/** because you encrypt pass on AuthController */
        return $plain;
        //return $this->hasher->check($plain, $user->getAuthPassword());
    }
	
    /*CODE ...*/

	/*IF YOU NEED TO RETRIVE MODEL WITH RELATIONS, YOU CAN MODIFY THIS*/
	public function retrieveByCredentials(array $credentials){
	
    /*CODE ...*/
		
        return $query->with('state')->first();
	}
```

3. A programar! Happy hacking!

**NOTE** ec2-34-207-127-183.compute-1.amazonaws.com

---

## Cuidado con las pruebas unitarias!!

Para realizar pruebas unitarias en Lumen, recuerden:

1. Dentro de la carpeta tests crear los correspondientes paquetes y clases.

2. Ejemplo de clase:

```
use Laravel\Lumen\Testing\DatabaseMigrations;
use Laravel\Lumen\Testing\DatabaseTransactions;
//Other Classes

class ExampleTest extends TestCase
{
    /**
     * A basic test example.
     *
     * @return void
     */
    public function testExample()
    {
        // Some code
        $this->assertEquals("1", "1");
    }
}
```

3. Ejecutar prueba desde terminal:

```
$ vendor/bin/phpunit --verbose tests/example/ExampleTest --filter=testExample
```

---

# Lumen PHP Framework

[![Build Status](https://travis-ci.org/laravel/lumen-framework.svg)](https://travis-ci.org/laravel/lumen-framework)
[![Total Downloads](https://poser.pugx.org/laravel/lumen-framework/d/total.svg)](https://packagist.org/packages/laravel/lumen-framework)
[![Latest Stable Version](https://poser.pugx.org/laravel/lumen-framework/v/stable.svg)](https://packagist.org/packages/laravel/lumen-framework)
[![Latest Unstable Version](https://poser.pugx.org/laravel/lumen-framework/v/unstable.svg)](https://packagist.org/packages/laravel/lumen-framework)
[![License](https://poser.pugx.org/laravel/lumen-framework/license.svg)](https://packagist.org/packages/laravel/lumen-framework)

Laravel Lumen is a stunningly fast PHP micro-framework for building web applications with expressive, elegant syntax. We believe development must be an enjoyable, creative experience to be truly fulfilling. Lumen attempts to take the pain out of development by easing common tasks used in the majority of web projects, such as routing, database abstraction, queueing, and caching.

## Official Documentation

Documentation for the framework can be found on the [Lumen website](https://lumen.laravel.com/docs).

## Security Vulnerabilities

If you discover a security vulnerability within Lumen, please send an e-mail to Taylor Otwell at taylor@laravel.com. All security vulnerabilities will be promptly addressed.

## License

The Lumen framework is open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).
