<template>
    <AppLayout>
        <div class="flex">
            <div class="flex-wrap gap-2 mt-4 w-2/3">
                <div v-for="tag in tags" :key="tag.id" class="inline-block bg-gray-600 m-2 px-4 py-2 text-base font-semibold text-white rounded-full">
                    {{ tag.label }}
                </div>
            </div>

            <div class="w-4/5">
                <!-- Даем доступ к данным через pagination -->
                <div v-for="article in articles.data" :key="article.id" class="p-4 mb-8 border rounded-lg shadow-lg">
                    <img :src="article.thumbnail_url" alt="image" class="w-full">
                    <Link :href="route('article.show', { slug: article.slug })">
                        <h3 class="font-semibold m-4">{{ article.title }}</h3>
                    </Link>
                    <p>{{ article.body }}</p>
                    <div class="flex justify-between m-4 items-center">
                        <span class="text-2xl">👁️ {{ article.views }}</span>
                        <span class="text-2xl"><Like :article="article" /></span>
                    </div>
                </div>

                <!-- Пагинация -->
                <div class="pagination flex justify-center mt-8">
                    <button
                        @click="changePage(currentPage - 1)"
                        :disabled="currentPage === 1"
                        class="px-4 py-2 bg-gray-500 text-white rounded-lg disabled:opacity-50">
                        Назад
                    </button>

                    <span class="mx-4">Страница {{ currentPage }} из {{ totalPages }}</span>

                    <button
                        @click="changePage(currentPage + 1)"
                        :disabled="currentPage === totalPages"
                        class="px-4 py-2 bg-gray-500 text-white rounded-lg disabled:opacity-50">
                        Вперед
                    </button>
                </div>
            </div>
        </div>
    </AppLayout>
</template>

<script setup>
import { ref } from 'vue';
import AppLayout from "@/Layouts/AppLayout.vue";
import Like from "@/Components/Like.vue";

// Пропсы, переданные родительским компонентом
const props = defineProps({
    tags: Array,
    articles: Object,  // Получаем пагинированные статьи
});

// Локальные данные для статей и пагинации
const articles = ref(props.articles);  // Локальные статьи для отслеживания
const currentPage = ref(props.articles.current_page);  // Текущая страница
const totalPages = ref(props.articles.last_page);     // Общее количество страниц

// Функция для изменения страницы
const changePage = (page) => {
    if (page >= 1 && page <= totalPages.value) {
        // Обновляем текущую страницу
        currentPage.value = page;

        // Сменяем страницу, просто изменив параметр в URL
        window.location.href = `?page=${page}`;
    }
};
</script>

<style scoped>
.pagination {
    display: flex;
    align-items: center;
    justify-content: center;
}
</style>
