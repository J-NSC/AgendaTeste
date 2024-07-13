<script setup>
import logo from '@/assets/images/logos/logo-dark.svg';
import { Link } from '@inertiajs/vue3';

</script>
<template>
    <div class="logo">
        <Link href="/">
            <img :src="logo" alt="home" />
        </Link>
    </div>
</template>
