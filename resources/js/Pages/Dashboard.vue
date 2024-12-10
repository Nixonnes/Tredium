<script setup>
import AppLayout from '@/Layouts/AppLayout.vue';
import {Link} from "@inertiajs/vue3";
import Like from "@/Components/Like.vue";
import Article from "@/Components/Article.vue";
</script>

<template>
    <AppLayout title="Dashboard">


        <div class="py-20 bg-gray-200">
            <div class="ml-36">
                <h3 class=" text-6xl">Успех</h3>
                <p class="text-base mt-4">Для молодых и успешных.</p>
            </div>
        </div>
        <Article :articles="articles" :excerpt="excerpt"/>
    </AppLayout>
</template>
<script>
export default {
    props: {
        articles: Array,
        excerpt: String,
    }
}
</script>
<style>
main {

}
</style>
