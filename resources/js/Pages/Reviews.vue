<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
const props = defineProps({ yandexData: Object });
</script>

<template>
    <AuthenticatedLayout>
        <div class="reviews-layout">
            <div class="reviews-list">
                <div v-if="props.yandexData.reviews.length > 0">
                    <div v-for="(review, index) in props.yandexData.reviews" :key="index" class="review-card">
                        <div class="review-gray-card">

                            <div class="review-header">
                                <div class="review-meta">
                                    <span class="review-date">{{ review.date || 'нет даты' }}</span>
                                    <span class="review-branch">
                                        Филиал 1 
                                        <span class="location-icon">📍</span>
                                    </span>
                                </div>
                                <div class="review-stars">
                                    <span v-for="i in 5" :key="i" :class="['star', { active: i <= review.stars }]">★</span>
                                </div>
                            </div>
                        
                            <div class="review-author">
                                <span>
                                    {{ review.author }}
                                </span>
                                <span class="author-phone">
                                    {{ review.phone || '+7 900 540 40 40' }}
                                </span>
                            </div>
                            
                            <p class="review-text">{{ review.text }}</p>                    
                        </div>
                    </div>
                </div>
                <div v-else>
                    <p class="no-review">
                        Не удалось получить отзывы
                    </p>
                </div>
            </div>

            <div class="rating-sidebar">
                <div class="rating-card">
                    <div class="rating-score-row">
                        <span class="rating-value">{{ props.yandexData.rating }}</span>
                        <div class="rating-stars-large">
                            <span v-for="i in 5" :key="i" :class="['star', { active: i <= Math.floor(props.yandexData.rating) }]">★</span>
                        </div>
                    </div>
                    <hr>
                    <div class="rating-count">
                        Всего отзывов: {{ props.yandexData.reviews_count }}
                    </div>
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>

<style scoped>
.reviews-layout {
    display: flex;
    gap: 24px;
    align-items: flex-start;
}

.reviews-list {
    flex: 1;
}

.review-card {
    background: #ffffff;
    padding: 20px 0 20px 20px;
    margin-bottom: 16px;
    border-radius: 12px;
    border: 1px solid #e5e7eb;
    box-shadow: 0 1px 6px rgba(0, 0, 0, 0.3)
}

.review-gray-card {
    background: #F6F8FA;
    border-radius: 12px;
    padding: 5px 30px 20px 3px;
}

.review-header {
    display: flex;
    justify-content: space-between;
    margin-bottom: 5px;
}

.review-meta {
    font-size: 13px;
    color: #363740;
}

.review-branch {
    margin-left: 12px;
    font-weight: 500;
}

.review-author {
    font-weight: 700;
    font-size: 14px;
    margin-bottom: 8px;
}

.author-phone {
    margin-left: 15px;
    font-weight: 400;
}

.review-text {
    font-size: 13px;
    line-height: 1.5;
    color: #1f2937;
}

.star {
    color: #e5e7eb;
    font-size: 16px;
}
.star.active {
    color: #fbbf24;
}

.rating-sidebar {
    max-width: 250px;
    position: sticky;
    top: 24px;
}

.rating-card {
    background: #ffffff;
    padding: 24px;
    border-radius: 12px;
    border: 1px solid #e5e7eb;
    box-shadow: 0 1px 3px rgba(0, 0, 0, 0.05);
}

.rating-card hr {
    border: 1px solid #F1F4F7;
}

.rating-score-row {
    display: flex;
    align-items: center;
    gap: 12px;
    margin-bottom: 10px;
}

.rating-value {
    font-family: monospace;
    font-size: 44px;
    font-weight: 500;
    line-height: 1;
    letter-spacing: -5px;
}

.rating-stars-large {
    display: flex;
    gap: 2px;
}

.rating-count {
    color: #363740;
    font-size: 14px;
    margin: 15px 0;
}

.no-review {
    font-weight: 600;
    font-size: 20px;    
}
</style>
