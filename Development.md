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

Route::get('/musta', function () {
  return view('musta.index');
});
```

**Route Açıklamaları:**

1. **Ana Sayfa Route'u (`/`):**
   - URL: `http://localhost/` (ana sayfa)
   - Fonksiyon: `welcome` view'ını döndürür
   - Dosya: `resources/views/welcome.blade.php`

2. **Musta Sayfası Route'u (`/musta`):**
   - URL: `http://localhost/musta`
   - Fonksiyon: `musta.index` view'ını döndürür
   - Dosya: `resources/views/musta/index.blade.php`

**Route Yapısı:**
- `Route::get()`: HTTP GET metodunu kullanır
- İlk parametre: URL path'i
- İkinci parametre: Çalıştırılacak closure fonksiyon veya controller
- `view()`: Belirtilen view dosyasını render eder
