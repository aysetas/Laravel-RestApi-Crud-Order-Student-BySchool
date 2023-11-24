<x-mail::layout>
{{-- Header --}}
<x-slot:header>
<x-mail::header :url="config('app.url')">

</x-mail::header>
</x-slot:header>

# <div class="header-mail">Merhaba!</div>

Bu maili şifre yenileme isteği yaptığınız için alıyorsunuz.

<x-mail::button :url="$url">
Şifremi Yenile
</x-mail::button>

Şifre yenileme talebinde bulunmadıysanız işlem yapmanıza gerek yoktur.

<div style="padding-top: 5px">
Teşekkürler,<br>
</div>
<x-slot:subcopy>
<x-mail::subcopy>
Şifremi Yenile butonuna tıklamada sorun yaşıyorsanız aşağıdaki URL'yi kopyalayıp web tarayıcınıza yapıştırın:
<span class="break-all">[{{ $url }}]({{ $url }})</span>
</x-mail::subcopy>
</x-slot:subcopy>

{{-- Footer --}}
<x-slot:footer>
<x-mail::footer>
© {{ date('Y') }} Havaist.
</x-mail::footer>
</x-slot:footer>
</x-mail::layout>
