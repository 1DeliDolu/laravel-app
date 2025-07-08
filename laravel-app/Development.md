# Laravel Herd Windows Kurulumu

Laravel Herd, Laravel projeleri için hızlı ve kolay bir geliştirme ortamı sunar. Windows için en son sürümü aşağıdaki bağlantıdan indirebilirsiniz:

[Laravel Herd for Windows - Son Sürüm İndir](https://herd.laravel.com/download/latest/windows)

**Kurulum Adımları:**

1. Yukarıdaki bağlantıdan .exe dosyasını indirin.
2. İndirilen dosyayı çalıştırarak kurulumu başlatın.
3. Kurulum tamamlandıktan sonra Laravel projelerinizi kolayca başlatabilirsiniz.

Daha fazla bilgi için: [herd.laravel.com](https://herd.laravel.com)

## Laravel Route Örnekleri

Aşağıdaki route örnekleri `routes/web.php` dosyasında tanımlanmıştır:

```php
Route::get('/', function () {
    return view('welcome');
});

// Musta-Liste anzeigen
Route::get('/musta', function () {
    $mustas = [
        ["name" => "Musta", "skill" => "PHP", "id" => 1],
        ["name" => "Musta", "skill" => "Laravel", "id" => 2],
    ];
    $greeting = "Hello";
    return view('musta.index', [
        "greeting" => $greeting,
        "mustas" => $mustas
    ]);
});

// Einzelnen Musta anzeigen
Route::get('/musta/{id}', function ($id) {
    $mustas = [
        ["name" => "Musta", "skill" => "PHP", "id" => 1],
        ["name" => "Musta", "skill" => "Laravel", "id" => 2],
    ];
    // passender Musta anhand der ID finden
    $musta = collect($mustas)->firstWhere('id', (int) $id);

    $greeting = "Hello";
    return view('musta.show', [
        "id" => $id,
        "musta" => $musta,
        "mustas" => $mustas,
        "greeting" => $greeting
    ]);
});
```

### View Örnekleri

**Musta Show View (`resources/views/musta/show.blade.php`)**

```html
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />
        <title>Ninja Network</title>
    </head>
    <body>
        <h2>Musta id - {{ $id }}</h2>
    </body>
</html>
```

**Musta Index View (`resources/views/musta/index.blade.php`)**

```html
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />
        <title>Mustafa's Page</title>
    </head>
    <body>
        <h2>Currently Available Musta</h2>
        <p>{{ $greeting }}</p>

        <ul>
            @foreach ($mustas as $musta)
            <li>
                <a href="/musta/{{ $musta['id'] }}"> {{ $musta['name'] }} </a>
            </li>
            @endforeach
        </ul>
    </body>
</html>
```

### Açıklamalar

1. **Route Tanımları:**

    - `/musta` route'u tüm Musta'ları listeler.
    - `/musta/{id}` route'u belirli bir Musta'nın detaylarını gösterir.

2. **View Dosyaları:**
    - `musta.index` tüm Musta'ları listelemek için kullanılır.
    - `musta.show` belirli bir Musta'nın detaylarını göstermek için kullanılır.

# PHP Kurulumu

sudo apt update
sudo apt install php php-cli php-fpm php-json php-common php-mysql php-zip php-gd php-mbstring php-curl php-xml php-pear php-bcmath

# Composer Kurulumu

curl -sS https://getcomposer.org/installer | php
sudo mv composer.phar /usr/local/bin/composer
sudo chmod +x /usr/local/bin/composer

# Laravel Installer Kurulumu

composer global require laravel/installer
echo 'export PATH="$PATH:$HOME/.composer/vendor/bin"' >> ~/.bashrc
source ~/.bashrc

# Node.js ve NPM Kurulumu

curl -fsSL https://deb.nodesource.com/setup_lts.x | sudo -E bash -
sudo apt-get install -y nodejs

# Alternatif olarak Bun Kurulumu (Node.js yerine)

curl -fsSL https://bun.sh/install | bash
echo 'export PATH="$HOME/.bun/bin:$PATH"' >> ~/.bashrc
source ~/.bashrc

# Kurulumları Kontrol Et

php --version
composer --version
laravel --version
node --version
npm --version

# veya bun --version (eğer Bun kullanıyorsanız)

# Mevcut Projeniz İçin Gerekli Kurulumlar

cd /mnt/d/xampp/htdocs/laravel/laravel-app
composer install
npm install
cp .env.example .env
php artisan key:generate
php artisan migrate
php artisan storage:link
composer run dev
