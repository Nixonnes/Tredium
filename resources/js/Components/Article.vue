<script setup>

import Like from "@/Components/Like.vue";
import {Link} from "@inertiajs/vue3";
</script>

<template>
    <div class="article_section flex flex-wrap justify-start gap-6">
        <div v-for="article in articles" :key="article.id" class="ml-8 w-full sm:w-1/2 md:w-1/4">
            <div class="m-2 article border border-gray-300/40 shadow-sm rounded-lg p-4 h-96">
                <img :src="article.thumbnail_url" alt="image" class="w-full">
                <Link :href="route('article.show', article.slug)"><h3 class="font-semibold max-h-9 m-1">{{article.title}}</h3></Link>
                <p>{{article.excerpt}}</p>
                <div>
                    <span class="text-2xl">{{ article.views }}👁️ </span>
                    <span class="text-2xl"><Like :article="article"/></span>
                </div>
            </div>
        </div>


    </div>
</template>
<script>


export default {
props: {
articles: Array,
excerpt: String,
}
}
</script>
<style scoped>

</style>
