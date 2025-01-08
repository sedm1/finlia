export default defineNuxtRouteMiddleware((to) => {
    const pagesWithoutReg = [
        'index',
        'registration',
        'login'
    ]
    const userStore = useUserStore();

    /**
     * Редиректы на клиенте
     */
    if (import.meta.server) return;

    /**
     * Если страница для перехода в списке без авторизации
     */
    if (pagesWithoutReg.indexOf(String(to.name)) !== -1 && !userStore.hash) return;
    if (pagesWithoutReg.indexOf(String(to.name)) !== -1 && userStore.hash) return navigateTo('/main')

    /**
     * Если пользователь не зарегестрирован
     */
    if (!userStore.hash) return navigateTo('/login');

    return;
})
