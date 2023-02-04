<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <!-- Head -->
    @include('layouts.main.partials.head')

    <!-- Head -->
    @yield('body')
</html>
