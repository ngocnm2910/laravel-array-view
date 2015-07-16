# Laravel Array View [![Build Status](https://travis-ci.org/php-soft/laravel-array-view.svg)](https://travis-ci.org/php-soft/laravel-array-view)

An array view engine for Laravel PHP Framework.

## Installation
```sh
$ composer require php-soft/laravel-array-view
```

## Usage
```
Code in controller (Example routes.php)
```php
<?php

Route::get('/articles/{id}', function ($id) {

    $article = Article::find($id);
    return response()->json(arrayView('article', [ 'article' => $article ]));
});
```
views/article.array.php
```php
<?php

$this->set('title', $article->title);
$this->set('author', function ($section) use ($article) {

    $section->set('name', $article->author->name);
});
```
This template generates the following object:
```php
[
    'title' => 'Example Title',
    'author' => [
        'name' => 'John Doe'
    ]
]
```

## Functions

### set()
It assigns a value to a key.
```php
<?php

$this->set('title', 'Example Title');

// => [ 'title' => 'Example Title' ]
```
The value can be a function. If `$this->set()` is called with a key, it creates an array:
```php
<?php

$this->set('author', function ($section) {

    $section->set('name', 'John Doe');
});

// => [ 'author' => [ 'name' => 'John Doe' ] ]
```
If `$section->set()` is called without a key, it assign the value to the parent key:
```php
<?php

$this->set('title', function ($section) {

    $section->set('Example Title');
});

// => [ 'title' => 'Example Title' ]
```

### each()
It creates a new array by iterating through an existing array:
```php
<?php

$numbers = ['one', 'two'];

$this->set('numbers', $this->each($numbers, function ($section, $item) {

    $section->set('number', $item);
}));

// => [ 'numbers' => [[ 'number' => 'one' ], [ 'number' => 'two' ]] ]
```

### extract()
`Coming soon`

### helper()
`Coming soon`

### partial()
views/partials/author.array.php
```php
<?php

$this->set('name', $author->name);
$this->set('gender', $author->gender);
```
views/article.array.php
```php
<?php

$this->set('title', $article->title);
$this->set('author', $this->partial('partials/author', [ 'author' => $article->author ]));

// [ 'title' => 'Example Title', 'author' => [ 'name' => 'John Doe', 'gender' => 'female' ] ]
```
