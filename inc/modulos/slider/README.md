# Slider

Módulo Slider para temas WordPress utilizando Custom Post Type.

  - Simples utilização - Praticamente como criar um post

### Requerimentos

  - WordPress > 3.0
  - PHP > 5.6

### Instalação

Adicione o arquivo principal do módulo no `functions.php` do seu tema:

```php
<?php
require_once get_stylesheet_directory_uri() . '/caminho/para/slider/mod-slider.php';
```

Caso esteja aplicando o módulo em um child-theme, utilize dessa forma:

```php
<?php
require_once get_stylesheet_directory() . '/caminho/para/slider/mod-slider.php';
```

E onde deseja exibir o slider, adicione uma chamada para a função `loop_slider()`:

```php
<?php
loop_slider();
```

### Changelog

  - 2.0 - Nova versão. Iniciando documentação. (14/12/2018)
