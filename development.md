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
