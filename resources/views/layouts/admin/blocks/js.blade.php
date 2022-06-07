<script src="{{ asset('argon') }}/vendor/jquery/dist/jquery.min.js"></script>
<script src="https://code.jquery.com/ui/1.13.1/jquery-ui.js"></script>
<script src="{{ asset('argon') }}/vendor/bootstrap/dist/js/bootstrap.bundle.min.js"></script>
<script src="{{ asset('argon') }}/js/argon.js?v=1.0.0"></script>

@stack('js-before')

<!-- Argon JS -->

<!-- Plugins -->
<script src="{{ mix('js/plugins.all.js') }}"></script>
<script src="{{ mix('js/modules/utils/images/all.js') }}"></script>

@stack('js-after')