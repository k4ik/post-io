<template>
    <div class="fixed top-11 right-4 px-10 py-1">
        <span>{{ data }}</span>
    </div>
</template>

<script>
    export default {
        props: ["data"]
    }
</script>

<style scoped>
    .success {
        @apply bg-green-600 border-2 border-green-900;
    }

    .error {
        @apply bg-red-700 border-2 border-red-900;
    }
</style>