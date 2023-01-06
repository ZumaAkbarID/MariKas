<footer>
    <div class="footer">
        <div class="float-start">
            <p>2022 - {{ date('Y') }} &copy; {{ $config['app_name'] }} |
                {{ round(microtime(true) - LARAVEL_START, 3) }} detik waktu render</p>
        </div>
        <div class="float-end">
            <p>Created with
                <span class="text-danger">
                    <i class="fa fa-heart"></i>
                </span>
                by
                <a href="#" class="author-footer">{{ $config['app_name'] }} Team</a>
            </p>
        </div>
    </div>
</footer>
