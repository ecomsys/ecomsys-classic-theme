
## БЫСТРЫЙ СТАРТ

# Установи зависимости

```bash
npm i --save-dev
```

# Добавь в .env путь

Пример:

```bash
WP_URL=http://localhost/wp              # подобный путь если через apache, nginx (норма)
```

---

# Если вордпресс из DOCKER ?

выполни:

```bash
docker ps
```

## посмотреть колонку PORTS.

Например:

```bash
0.0.0.0:8080->80/tcp
```

Значит WordPress открыт на:

```bash
http://localhost:8080                  # такой путь если docker (открываем просто порт)
```


# Inject SVG

```php
<?php svg_icon('burger', 'w-6 h-6 fill-current text-blue-500'); ?>
```
