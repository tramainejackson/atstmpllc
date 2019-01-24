{{--Created by PhpStorm.--}}
{{--User: tjackson--}}
{{--Date: 1/24/19--}}
{{--Time: 3:56 PM--}}

<h2>This page is not a correct link. You'll be redirected in 5 seconds to the home page</h2>
<h2 id="whatever" style="display: none;">{{ route('welcome') }}</h2>

<script type="text/javascript">
    var locate = document.getElementById("whatever").innerHTML;

    setTimeout(function () {
        window.open(locate, '_self');
    }, 5000);
</script>