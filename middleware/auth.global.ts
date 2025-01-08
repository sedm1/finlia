export default defineNuxtRouteMiddleware((to) => {
    const pagesWithoutReg = [
        'index',
        'registration',
        'login'
    ]
    const userStore = useUserStore();

    /**
     * Если страница для перехода в списке без авторизации
     */
    if (pagesWithoutReg.indexOf(String(to.name)) !== -1 && !userStore.hash) return;
    if (pagesWithoutReg.indexOf(String(to.name)) !== -1 && userStore.hash) return navigateTo('/main')

    if (!userStore.hash) return navigateTo('/login');

    return;
})
