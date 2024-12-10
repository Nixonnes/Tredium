<script setup>
import { ref } from 'vue';
import axios from 'axios';

// Пропс, переданный родительским компонентом
const props = defineProps({
    article: Object,
});

// Локальные данные, которые можно изменять
const likes = ref(props.article.likes);

// Метод для увеличения лайков
const incrementLike = async () => {
    try {
        // Отправляем запрос на сервер для инкремента лайков
        const response = await axios.post(`/api/articles/${props.article.slug}/increment-likes`);

        // Проверяем, есть ли лайки в ответе
        if (response.data && response.data.likes !== undefined) {
            // Обновляем количество лайков на основе ответа
            likes.value = response.data.likes;
        } else {
            console.error('Ошибка: Лайки не получены в ответе');
        }
    } catch (error) {
        console.error('Ошибка при инкрементировании лайков:', error);
    }
};
</script>

<template>
    <button @click="incrementLike" :data-slug="props.article.slug">
        <span class="like-icon">♥</span>
        <span>{{ likes }}</span>
    </button>
</template>

<style scoped>
.like-icon {
    font-size: 1.875rem;
}
button .like-icon:hover {
    color: red;
    font-size: 1.875rem;
    margin-right: 8px;
    transition: transform 0.2s ease;
}

button:hover .like-icon {
    transform: scale(1.2);
}
</style>
