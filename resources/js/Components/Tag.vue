<script setup>
import {Link} from "@inertiajs/vue3";
</script>

<template>
    <div>
        <div v-for="tag in tags" class=" inline-block bg-gray-600 m-2 px-4 py-2 text-base font-semibold text-white rounded-full">
            <Link :href="tag.slug"> {{tag.label}} </Link>
        </div>
    </div>
</template>
<script>
export default {
    props: {
        tags:Array
    }
}
</script>
<style scoped>

</style>
