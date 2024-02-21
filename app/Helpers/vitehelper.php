<?php
if (!function_exists('vite_asset')) {
    function vite_asset($path) {
        static $manifest = null;
        if (!$manifest) {
            $manifestPath = public_path('build/manifest.json');
            $manifest = file_exists($manifestPath) ? json_decode(file_get_contents($manifestPath), true) : [];
        }
        return isset($manifest[$path]) ? asset('build/' . $manifest[$path]['file']) : '';
    }
}
