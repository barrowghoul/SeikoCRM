<footer class="footer footer-black footer-white">
    <div class="container-fluid">
        <div class="row">
            <nav class="footer-nav">
                <ul>
                    <li>
                        <a href="http://www.seikosoluciones.com" target="_blank">{{ __('Seiko Soluciones') }}</a>
                    </li>                    
                </ul>
            </nav>
            <div class="credits ml-auto">
                <span class="copyright">
                    ©
                    <script>
                        document.write(new Date().getFullYear())
                    </script>{{ __(', Desarrollado por ') }}<a class="@if(Auth::guest()) text-white @endif" href="http://www.seikosoluciones.com" target="_blank">{{ __('Seiko Soluciones') }}</a>
                </span>
            </div>
        </div>
    </div>
</footer>