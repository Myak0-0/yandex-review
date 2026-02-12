<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { useForm } from '@inertiajs/vue3';

const props = defineProps({ currentUrl: String });

const form = useForm({
    url: props.currentUrl || '',
});

const submit = () => {
    form.post(route('settings.update'));
};
</script>

<template>
    <AuthenticatedLayout>
        <div class="settings-container">
            <h1 class="page-title">Подключить Яндекс</h1>
            
            <div class="settings-card">
                <p class="description">
                    Укажите ссылку на Яндекс, пример 
                    <span class="example-link">https://yandex.ru/maps/org/samoye_populyarnoye_kafe_tsentr/1010501395/reviews/</span>
                </p>
                
                <form @submit.prevent="submit" class="settings-form">
                    <input 
                        v-model="form.url" 
                        type="text" 
                        placeholder="https://yandex.ru..."
                        class="form-input"
                    >
                    
                    <button 
                        type="submit" 
                        :disabled="form.processing"
                        class="submit-button"
                    >
                        Сохранить
                    </button>
                </form>
            </div>
        </div>
    </AuthenticatedLayout>
</template>

<style scoped>
.page-title {
    font-size: 20px;
    font-weight: 600;
    margin-bottom: 20px;
}

.description {
    font-size: 16px;
    color: #6C757D;
    margin-bottom: 10px;
}

.example-link {
    color: #788397;
    text-decoration: underline;
}

.settings-form {
    display: flex;
    flex-direction: column;
    gap: 20px;
}

.form-input {
    max-width: 700px;
    padding-left: 15px;
    border: 1px solid #DCE4EA;
    border-radius: 6px;
    outline: none;
    transition: all 0.2s;
}

.form-input:focus {
    box-shadow: 0 0 0 2px #339AF0;
    border-color: transparent;
}

.submit-button {
    background-color: #339AF0;
    color: white;
    padding: 4px 30px;
    border-radius: 6px;
    font-weight: 500;
    border: none;
    cursor: pointer;
    transition: background-color 0.2s;
    width: fit-content;
}

.submit-button:hover {
    background-color: #2563eb;
}

.submit-button:disabled {
    opacity: 0.5;
    cursor: not-allowed;
}
</style>
