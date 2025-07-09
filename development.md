# Laravel Projesi Oluşturma

Aşağıdaki komut ile yeni bir Laravel projesi oluşturabilirsiniz:

```
composer create-project laravel/laravel laravel-app
```

Bu komut, 'laravel-app' adında yeni bir klasör oluşturur ve içerisine Laravel'in en güncel sürümünü kurar.

---

## Varsayılan Welcome Sayfası Yenilendi

`resources/views/welcome.blade.php` dosyasının içeriği silinip Laravel'in varsayılan welcome.blade.php içeriği tekrar eklendi. Bu sayede proje ilk kurulumdaki varsayılan karşılama sayfasına döndü.

---

## Örnek Basit HTML Sayfası

Aşağıda, basit bir HTML sayfası örneği yer almaktadır. Bu sayfa, başlık olarak "Mustafa's Page" metnini gösterir.

```
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
<h1>Mustafa's Page</h1>
</body>
</html>
```

Bu kod, temel bir HTML iskeleti sunar ve gövde kısmında büyük puntolu bir başlık içerir.

---

## Yeni Route ve View Dosyası

`routes/web.php` dosyasına aşağıdaki rota eklendi:

```
Route::get('/blogs', function () {
    return view('blogs');
});
```

Ayrıca, `resources/views` klasörü altına `blogs.blade.php` dosyası eklendi. Bu rota çalıştırıldığında, kullanıcıya blogs.blade.php içeriği gösterilir.

---

## Dinamik Blog Sayfası Rotası

`routes/web.php` dosyasına aşağıdaki dinamik rota eklendi:

```
Route::get('/blogs/{id}', function (int $id) {
    return view('blogs', ['id' => $id]);
});
```

Bu rota sayesinde, /blogs/1 gibi bir URL çağrıldığında blogs.blade.php dosyasına ilgili id parametresi gönderilir ve view dosyasında bu id kullanılabilir.

---

## Blog Detay Sayfası ve Yeni Route

`resources/views` klasörüne aşağıdaki içeriğe sahip `blog-details.blade.php` dosyası eklendi:

```
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
<h1>Blog Details for Blog ID: {{ $id }}</h1>
</body>
</html>
```

Ayrıca, `routes/web.php` dosyasına aşağıdaki rota eklendi:

```
Route::get('/blogs/{id}', function (int $id) {
    return view('blog-details', ['id' => $id]);
});
```

Bu rota ile, /blogs/1 gibi bir URL çağrıldığında blog-details.blade.php dosyasına id parametresi gönderilir ve ekranda ilgili blog id'si gösterilir.

---

## Layout Kullanımı

`resources/views/index.blade.php` dosyası, `@extends('layouts.layout')` ifadesiyle ana şablon olarak `resources/layouts/layout.blade.php` dosyasını kullanır. Bu yapı sayesinde, ortak bir şablon üzerinden içerik bölümleri dinamik olarak doldurulabilir.

- **Ana layout dosyası yolu:**
  `D:/xampp/htdocs/laravel/laravel-app/resources/layouts/layout.blade.php`
- **Kullanım amacı:**
  Tüm sayfalarda ortak olan HTML yapısı, stil ve scriptlerin tek bir dosyada toplanmasını sağlar. Böylece kod tekrarını önler ve bakımı kolaylaştırır.

---

## Hata ve Çözümü: View [layouts.layout] not found

Eğer aşağıdaki hata ile karşılaşırsanız:

```
InvalidArgumentException
View [layouts.layout] not found.
```

Bunun nedeni, `@extends('layouts.layout')` ifadesinin kullandığı layout dosyasının yanlış dizinde olmasıdır. Laravel, layout dosyalarını varsayılan olarak `resources/views/layouts` klasöründe arar. Doğru yol:

```
resources/views/layouts/layout.blade.php
```

**Çözüm:**

- `layout.blade.php` dosyasını `resources/views/layouts` klasörüne taşıyın veya orada oluşturun.

---

## Hata ve Çözümü: Undefined variable $active

Eğer aşağıdaki hata ile karşılaşırsanız:

```
Undefined variable $active
```

**Neden:**
/blogs/{id} rotasında view'a bir dizi (tüm bloglar) gönderiliyordu, ancak blog-details.blade.php dosyası tek bir blogun verilerini ($active, $title, $description vb.) bekliyor. Bu nedenle değişkenler tanımsız kalıyordu.

**Çözüm:**
İlgili blogu $id ile bulup, sadece o blogun verilerini view'a göndermek gerekir. Kod şu şekilde olmalı:

```
Route::get('/blogs/{id}', function (int $id) {
    $blogs = [
        [...],
        [...],
        [...],
    ];
    $blog = collect($blogs)->firstWhere('id', $id);
    if (!$blog) {
        abort(404);
    }
    return view('blog-details', $blog);
});
```

Bu şekilde, view dosyasında $active ve diğer değişkenler sorunsuz kullanılabilir.

---

## View ve Layout Kullanımı Açıklamaları

### blog-details.blade.php

```
@extends('layouts.layout')
@section('content')
    <h1>Welcome to Blog Details: {{ '$id' }}</h1>
    <p>Your one-stop solution for all blogging needs.</p>
@endsection
```

Bu dosya, dinamik olarak blog detaylarını göstermek için kullanılır. `@extends('layouts.layout')` ile ana şablon olarak layout.blade.php kullanılır. `@section('content')` ile layout dosyasındaki `@yield('content')` alanı doldurulur. `$id` parametresi ile ilgili blogun id'si ekrana yazdırılır.

### blogs.blade.php

```
@extends('layouts.layout')
@section('content')
    <h1>Welcome to Blogs</h1>
    <p>Your one-stop solution for all blogging needs.</p>
@endsection
```

Bu dosya, blogların listelendiği ana sayfa olarak kullanılır. Yine layout.blade.php şablonunu kullanır ve içerik kısmını doldurur.

### layout.blade.php

Bu dosya, tüm sayfalarda ortak olarak kullanılan ana HTML şablonudur. Navbar, stil dosyaları ve ortak yapılar burada tanımlanır. View dosyaları, bu şablonu genişleterek sadece içerik kısmını doldurur. Böylece kod tekrarını önler ve sayfalar arası tutarlılık sağlar.

---

## Blade ile h1 Başlığı Ekleme (Basic)

Aşağıda, Blade şablonunda bir h1 başlığının nasıl ekleneceğine dair temel bir örnek yer almaktadır:

```
@extends('layouts.layout')
@section('content')
    <h1>Başlık Buraya Gelecek</h1>
@endsection
```

Bu örnekte, `@extends('layouts.layout')` ile ana şablon kullanılır ve `@section('content')` ile içerik kısmına bir h1 başlığı eklenir. Bu yapı, Laravel projelerinde sayfa başlıklarını kolayca yönetmek için kullanılır.

---

## Blade Basic

Blade, Laravel'in kendi şablon motorudur ve dinamik olarak HTML üretmek için kullanılır. Blade ile değişkenler, kontrol yapıları ve şablon genişletme gibi işlemler kolayca yapılabilir.

**Örnekler:**

- Değişken Yazdırma:
```
{{ $isim }}
```
- Koşul Kullanımı:
```
@if($sayi > 10)
    Büyük
@else
    Küçük veya eşit
@endif
```
- Döngü:
```
@foreach($liste as $item)
    {{ $item }}
@endforeach
```

Blade ile kodunuzu daha okunabilir ve yönetilebilir hale getirebilirsiniz.

---

## Dinamik Blog Detay Sayfası (Koşullu Blade Kullanımı)

Aşağıdaki kod ile, /blogs/{id} rotasında blog detayları dinamik olarak gösterilir:

```
Route::get('/blogs/{id}', function (int $id) {
    $data = [
        'id' => $id,
        'title' => 'laravel dersleri',
        'description' => 'laravel dersleri ile ilgili detaylı bilgiler',
        "likeCount" => 100,
        'active' => true,
    ];
    return view('blog-details',$data );
});
```

`blog-details.blade.php` dosyasında ise, gönderilen veriye göre içerik koşullu olarak gösterilir:

```
@if($active)
   <div class="card">
    <div class="card-body">
        <h5>{{ $title }}</h5>
        <p>{{ $description }}</p>
        <p>Likes: {{ $likeCount }} beğeni</p>
        <p>Status: {{ $active ? 'Active' : 'Inactive' }}</p>
    </div>
   </div>
@else
   <div class="alert alert-warning">
       <p>Blog post is inactive.</p>
   </div>
@endif
```

Bu yapı sayesinde, blog aktifse detaylar kart içinde gösterilir; değilse uyarı mesajı çıkar. Blade'in koşullu yapıları ile dinamik içerik yönetimi sağlanır.

---

## Blog Listesi ve Detayları (web.php ve blogs.blade.php)

### web.php

```
Route::get('/blogs', function () {
    $data = [
        [
            'id' => 1,
            'title' => 'Laravel Başlangıç',
            'description' => 'Laravel ile projeye başlama adımları',
            'likeCount' => 50,
            'active' => true,
        ],
        [
            'id' => 2,
            'title' => 'Laravel Orta Seviye',
            'description' => 'Orta seviye Laravel dersleri',
            'likeCount' => 75,
            'active' => false,
        ],
        [
            'id' => 3,
            'title' => 'Laravel İleri Seviye',
            'description' => 'İleri seviye Laravel teknikleri',
            'likeCount' => 120,
            'active' => true,
        }
    ];
    return view('blogs', ['blogs' => $data]);
});

Route::get('/blogs/{id}', function (int $id) {
    $blogs = [
        [
            'id' => 1,
            'title' => 'Laravel Başlangıç',
            'description' => 'Laravel ile projeye başlama adımları',
            'likeCount' => 50,
            'active' => true,
        ],
        [
            'id' => 2,
            'title' => 'Laravel Orta Seviye',
            'description' => 'Orta seviye Laravel dersleri',
            'likeCount' => 75,
            'active' => false,
        ],
        [
            'id' => 3,
            'title' => 'Laravel İleri Seviye',
            'description' => 'İleri seviye Laravel teknikleri',
            'likeCount' => 120,
            'active' => true,
        },
    ];
    $blog = collect($blogs)->firstWhere('id', $id);
    if (!$blog) {
        abort(404);
    }
    return view('blog-details', $blog);
});
```

- `/blogs` rotası, tüm blogları bir dizi olarak blogs.blade.php'ye gönderir.
- `/blogs/{id}` rotası, seçilen blogun detaylarını blog-details.blade.php'ye gönderir.

### blogs.blade.php

```
@extends('layouts.layout')
@section('content')
<h1>Blog List</h1>
@foreach($blogs as $blog)
    @if($blog['active'])
        <div class="card mb-3">
            <div class="card-body">
                <h5 class="card-title">{{ $blog['title'] }}</h5>
                <p>{{ $blog['description'] }}</p>
                <p>{{ $blog['likeCount'] }} likes</p>
                <p>ID: {{ $blog['id'] }}</p>
                <p>Active: Yes</p>
            </div>
        </div>
    @endif
@endforeach

<h1>Blog List (For Loop)</h1>
@for ($i = 0; $i < count($blogs); $i++)
    @if($blogs[$i]['active'])
        <div class="card mb-3">
            <div class="card-body">
                <h5 class="card-title">{{ $blogs[$i]['title'] }}</h5>
                <p>{{ $blogs[$i]['description'] }}</p>
                <p>{{ $blogs[$i]['likeCount'] }} likes</p>
                <p>ID: {{ $blogs[$i]['id'] }}</p>
                <p>Active: Yes</p>
            </div>
        </div>
    @endif
@endfor
@endsection
```

- Bu view dosyası, kendisine gönderilen $blogs dizisindeki aktif blogları hem foreach hem de for döngüsü ile listeler.
- Her blog kart olarak gösterilir ve sadece aktif olanlar ekrana yazdırılır.

Bu yapı ile blogların listelenmesi ve detaylarının gösterilmesi kolayca yönetilir.

---

## HomeController ve Route Kullanımı

### HomeController.php

```
public function index()
{
    return view('index');
}
```

Bu fonksiyon, ana sayfa isteği geldiğinde index.blade.php view dosyasını döndürür.

### web.php

```
Route::get('/', [HomeController::class, 'index']);
```

Bu satır, ana sayfa isteğini HomeController içindeki index fonksiyonuna yönlendirir.

---

## Resource Controller Oluşturma

Aşağıdaki komut ile tüm CRUD işlemlerini içeren bir resource controller oluşturabilirsiniz:

```
php artisan make:controller BlogsController --resource
```

Bu komut, `app/Http/Controllers` klasöründe BlogsController adında bir dosya oluşturur ve içinde index, create, store, show, edit, update, destroy gibi hazır metotlar bulunur. Bu metotlar, bloglar için CRUD işlemlerini kolayca yönetmenizi sağlar.

---

## Resource Controller Kullanımı: BlogsController

Aşağıdaki komut ile resource controller oluşturulur:

```
php artisan make:controller BlogsController --resource
```

Bu komut, `app/Http/Controllers/BlogsController.php` dosyasını oluşturur ve içinde aşağıdaki gibi CRUD işlemlerine uygun hazır metotlar bulunur:

```
public function index() { /* Blog listesi */ }
public function create() { /* Yeni blog formu */ }
public function store(Request $request) { /* Blog kaydet */ }
public function show(int $id) { /* Blog detay */ }
public function edit(int $id) { /* Blog düzenle formu */ }
public function update(Request $request, int $id) { /* Blog güncelle */ }
public function destroy(int $id) { /* Blog sil */ }
```

### web.php'de Kullanımı

```
use App\Http\Controllers\BlogsController;

Route::get('/blogs', [BlogsController::class, 'index']);
Route::get('/blogs/{id}', [BlogsController::class, 'show']);
```

- `/blogs` rotası BlogsController içindeki index fonksiyonunu çalıştırır ve blog listesini gösterir.
- `/blogs/{id}` rotası show fonksiyonunu çalıştırır ve ilgili blogun detayını gösterir.

### BlogsController.php Örneği

```
public function index()
{
    $data = [
        [ 'id' => 1, 'title' => 'Laravel Başlangıç', ... ],
        [ 'id' => 2, 'title' => 'Laravel Orta Seviye', ... ],
        [ 'id' => 3, 'title' => 'Laravel İleri Seviye', ... ]
    ];
    return view('blogs.index', ['blogs' => $data]);
}

public function show(int $id)
{
    $data = [
        [ 'id' => 1, 'title' => 'Laravel Başlangıç', ... ]
    ];
    return view('blogs.show', ['blogs' => $data]);
}
```

- index(): Blog listesini döndürür.
- show($id): İlgili blogun detayını döndürür.

Bu yapı ile bloglar için CRUD işlemlerini controller üzerinden yönetebilirsiniz.

---

## Controller Oluşturma

Aşağıdaki komut ile yeni bir controller oluşturabilirsiniz:

```
php artisan make:controller HomeController
```

Bu komut, `app/Http/Controllers` klasörü altında `HomeController.php` adında bir dosya oluşturur. Controller'lar, gelen istekleri karşılamak ve uygun response döndürmek için kullanılır. Projenizde iş mantığını ve yönlendirmeleri bu dosyada tanımlayabilirsiniz.

---

## Migration Nedir?

Migration, Laravel'de veritabanı tablolarını ve şemasını kod ile yönetmenizi sağlayan bir yapıdır. Migration dosyaları ile veritabanı tablolarını oluşturabilir, güncelleyebilir veya silebilirsiniz. Bu sayede veritabanı değişiklikleri kod ile takip edilebilir ve ekip içinde kolayca paylaşılabilir.

**Temel Komutlar:**

- Migration oluşturmak için:
```
php artisan make:migration create_posts_table
```
- Migration'ı çalıştırmak (veritabanında tabloyu oluşturmak/güncellemek) için:
```
php artisan migrate
```
- Son yapılan migration'ı geri almak için:
```
php artisan migrate:rollback
```

**Avantajları:**
- Veritabanı şeması kod ile versiyonlanır.
- Takım çalışmasında veritabanı değişiklikleri kolayca paylaşılır.
- Geri alma (rollback) ve ileri alma (migrate) işlemleri kolaydır.

---

## DBeaver Uygulamasını Başlatma

Linux sistemlerde Snap ile kurulan DBeaver uygulamasını başlatmak için aşağıdaki komutu kullanabilirsiniz:

```
snap run dbeaver-ce
```

Bu komut, DBeaver veritabanı yönetim aracını açar. Eğer terminalde doğrudan `dbeaver` komutu çalışmazsa, Snap ile kurulan uygulamalar genellikle `snap run` ile başlatılır.

---

## Bloglar İçin Migration Oluşturma

Aşağıdaki komut ile blogs adında bir tablo oluşturacak migration dosyası hazırlanır:

```
php artisan make:migration create_blogs_table
```

Bu komut, `database/migrations` klasöründe `create_blogs_table` adında bir migration dosyası oluşturur. Bu dosyada blogs tablosunun kolonlarını tanımlayabilir ve veritabanında tabloyu oluşturmak için `php artisan migrate` komutunu kullanabilirsiniz.

**Kullanım amacı:**
- Bloglar için veritabanında tablo yapısını kod ile tanımlamak ve yönetmek.
- Takım çalışmasında tablo şemasını paylaşmak ve sürümlemek.

---

## blogs Tablosu Migration Yapısı

Aşağıda, blogs tablosunu oluşturan migration dosyasındaki up() fonksiyonu ve alanların açıklamaları yer almaktadır:

```
public function up(): void
{
    Schema::create('blogs', function (Blueprint $table) {
        $table->id(); // Otomatik artan birincil anahtar (id)
        $table->string('title'); // Blog başlığı
        $table->text('description'); // Blog açıklaması
        $table->integer('likeCount')->default(0); // Beğeni sayısı (varsayılan 0)
        $table->boolean('active')->default(true); // Aktiflik durumu (varsayılan true)
        $table->timestamps(); // created_at ve updated_at zaman damgaları
    });
}
```

- **id:** Her blog için otomatik artan birincil anahtar.
- **title:** Blog başlığı (kısa metin).
- **description:** Blogun açıklaması (uzun metin).
- **likeCount:** Blogun beğeni sayısı, varsayılan olarak 0.
- **active:** Blogun aktif olup olmadığını belirten boolean değer, varsayılan olarak true.
- **timestamps:** Kayıt oluşturulma ve güncellenme zamanlarını otomatik olarak tutar.

Bu yapı ile blogs tablosunun şeması migration dosyası üzerinden kolayca yönetilir.

---

## Migration'ı Çalıştırmak

Aşağıdaki komut ile tüm migration dosyalarındaki veritabanı değişiklikleri uygulanır:

```
php artisan migrate
```

Bu komut, `database/migrations` klasöründeki tüm migration dosyalarını çalıştırır ve veritabanında tabloları oluşturur veya günceller. Örneğin, `create_blogs_table` migration dosyasındaki tablo yapısı veritabanına eklenir.

**Kullanım amacı:**
- Migration dosyalarındaki şema değişikliklerini veritabanına uygulamak.
- Proje kurulumunda veya yeni tablo eklemede veritabanını otomatik olarak güncellemek.

---

## Ubuntu Linux 24.10 (x86, 64-bit), DEB Package

Ubuntu ve Debian tabanlı sistemlerde yazılım kurulumunda .deb uzantılı paketler kullanılır. Örneğin, DBeaver veya MySQL gibi uygulamaları .deb paketi ile kurabilirsiniz.

**Kurulum Adımları:**
1. İlgili .deb dosyasını indirin (ör: dbeaver-ce_latest_amd64.deb).
2. Terminalde indirdiğiniz dizine gidin.
3. Aşağıdaki komut ile kurulumu başlatın:

```
sudo dpkg -i paket_adi.deb
```

Gerekirse eksik bağımlılıkları tamamlamak için:
```
sudo apt-get install -f
```

**Not:** Ubuntu 24.10 (x86, 64-bit) sistemlerde bu yöntemle kolayca yazılım kurulumu yapabilirsiniz.
