<script setup>
import { Link } from '@inertiajs/vue3';
</script>

<template>
    <div class="app-container">
        <aside class="sidebar">
            <div class="sidebar-header">
                <div class="logo">
                    <span class="logo-icon">›</span> Daily Grow
                </div>
                <div class="account-label">{{ $page.props.auth.user.name }}</div>
            </div>

            <nav class="sidebar-nav">
                <p class="nav-review">🔍 Отзывы</p>
                <Link :href="route('reviews')" 
                      class="nav-item" 
                      :class="{ 'active': route().current('reviews') }">
                    Отзывы
                </Link>

                <Link :href="route('settings')" 
                      class="nav-item" 
                      :class="{ 'active': route().current('settings') }">
                    Настройка
                </Link>
            </nav>
        </aside>

        <div class="main-wrapper">
            <header class="top-header">
                <Link :href="route('logout')" method="post" as="button" class="logout-btn">
                    <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                        <path d="M9 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h4M16 17l5-5-5-5M21 12H9" />
                    </svg>
                </Link>
            </header>

            <main class="content-area">
                <slot />
            </main>
        </div>
    </div>
</template>

<style scoped>
* {
    padding: 0;
    margin: 0;
    box-sizing: border-box;
    font-family: 'Inter', sans-serif;
    color: #363740;
}
.app-container {
    display: flex;
    min-height: 100vh;
}

.sidebar {
    min-width: 280px;
    background: #F6F8FA;
    display: flex;
    flex-direction: column;
    padding: 0 20px;
}

.sidebar-header {
    padding: 24px 0;
}

.logo {
    font-size: 24px;
    font-weight: 700;
    color: #363740;
    display: flex;
    align-items: center;
}

.logo-icon {
    color: #2563eb;
    margin-right: 8px;
    font-size: 24px;
}

.account-label {
    font-size: 20px;
    color: #6C757D;
    margin-top: 10px;
}

.sidebar-nav {    
    display: flex;
    flex-direction: column;
    gap: 8px;
}

.nav-review {
    background: #ffffff;
    padding: 15px;
    border-radius: 12px;
}


.nav-item {
    padding: 3px 25px;
    border-radius: 12px;
    text-decoration: none;
    font-size: 14px;
    font-weight: 500;
    transition: all 0.2s ease;
}

.nav-item:hover {
    background-color: #f3f4f6;
}

.nav-item.active {
    background-color: #ffffff;
    box-shadow: 0 2px 1px rgba(0, 0, 0, 0.02);
}

.icon {
    margin-right: 12px;
}

.main-wrapper {
    flex: 1;
    display: flex;
    flex-direction: column;
}

.top-header {
    height: 64px;
    background: #ffffff;
    border-bottom: 2.5px solid #DCE4EA;
    display: flex;
    align-items: center;
    justify-content: flex-end;
    padding-right: 32px;
}

.logout-btn {
    background: none;
    border: none;
    cursor: pointer;
}
.logout-btn svg {
    color: #909AB4;
}

.content-area {
    padding: 32px;
}
</style>
