<script setup>

import AppLayout from "@/Layouts/AppLayout.vue";
import Tag from "@/Components/Tag.vue";
import Like from "@/Components/Like.vue";
import Comment from "@/Components/Comment.vue";
</script>

<template>
    <AppLayout>
     <div class="flex flex-col items-center m-6 article_show ">
         <div>
             <h1 class="text-4xl font-semibold">{{article.title}}</h1>
         </div>
         <div class=" mt-4 ">
             <span class="text-2xl">👁️ {{ article.views }}</span>
             <span  class=" text-2xl m-4"><Like :article="article"/></span>
         </div>
            <div class="m-4">
                <Tag :tags="tags"/>
                </div>
         <div class="mb-5 border-b-2 p-4">
             <p>{{article.body}}</p>
         </div>
        <div class="mt-3 self-start w-full">
            <h2 class="text-2xl font-semibold">Оставить комментарий</h2>
            <Comment :article="article"/>
        </div>
     </div>
    </AppLayout>
</template>

<script>
export default {
    props: {
        article: Object,
        tags: Array,
    },

    data() {
        return {
            views: this.article.views, // Изначальное количество просмотров
        };
    },
    mounted() {
        // Таймер для отправки запроса через 5 секунд
        setTimeout(this.incrementViews, 5000);
    },
    methods: {
        async incrementViews() {
            try {
                const response = await axios.post(`/api/articles/${encodeURIComponent(this.article.slug)}/increment-views`);
                this.views = response.data.views; // Обновляем счётчик
            } catch (error) {
                console.error("Ошибка при обновлении счётчика просмотров:", error);
            }
        },
    }
}
</script>
<style scoped>

</style>
