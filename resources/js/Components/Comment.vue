<script setup>
import { ref } from 'vue';
import axios from 'axios';
import TextInput from "@/Components/TextInput.vue";
import PrimaryButton from "@/Components/PrimaryButton.vue";

// Получаем ID статьи через props
const props = defineProps({
    article: Object,
});

const topic = ref('');
const message = ref('');
const loading = ref(false);
const isSubmitted = ref(false);
const errorMessage = ref(false);
const articleId = ref(props.article.id); // Инициализация с ID статьи из props

const submitComment = async () => {
    loading.value = true;
    isSubmitted.value = false;
    errorMessage.value = false;

    try {
        const response = await axios.post("/api/comments", {
            topic: topic.value,
            message: message.value,
            article_id: articleId.value, // Используем articleId.value
        });

        isSubmitted.value = true; // Показываем сообщение об успешной отправке
    } catch (error) {
        errorMessage.value = true; // Показываем сообщение об ошибке
    } finally {
        loading.value = false;
        // Очищаем поля ввода
        topic.value = '';
        message.value = '';
    }
};
</script>

<template>
    <div>
        <div v-if="!isSubmitted">
            <form @submit.prevent="submitComment">
                <!-- Поле для темы -->
                <div class="mt-3">
                    <text-input v-model="topic" class="w-full" placeholder="Тема сообщения" :required="true"/>
                </div>
                <!-- Поле для текста сообщения -->
                <div class="mt-3">
                    <textarea v-model="message" class="w-full rounded border-gray-300 resize-none h-40"
                              placeholder="Текст сообщения"></textarea>
                </div>
                <!-- Кнопка отправки -->
                <div class="mt-3 py-4">
                    <PrimaryButton :disabled="loading.value">
                        {{ loading.value ? 'Отправка...' : 'Отправить' }}
                    </PrimaryButton>
                </div>
            </form>
        </div>

        <!-- Сообщение об успешной отправке -->
        <div v-if="isSubmitted" class="success-message">
            Комментарий успешно отправлен и обрабатывается!
        </div>

        <!-- Сообщение об ошибке -->
        <div v-if="errorMessage" class="error-message">
            Произошла ошибка при отправке комментария. Попробуйте еще раз.
        </div>
    </div>
</template>

<style scoped>
.success-message {
    color: green;
    font-size: 1.2rem;
    margin-top: 1rem;
    padding: 1rem;
    background-color: #e6ffe6;
    border-radius: 4px;
}

.error-message {
    color: red;
    font-size: 1.2rem;
    margin-top: 1rem;
    padding: 1rem;
    background-color: #ffe6e6;
    border-radius: 4px;
}
</style>
