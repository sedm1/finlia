// https://nuxt.com/docs/api/configuration/nuxt-config
export default defineNuxtConfig({
    compatibilityDate: "2024-11-01",
    devtools: {enabled: true},
    modules: [[
        "@nuxtjs/google-fonts",
        {
            families: {
                Montserrat: true,
                Nunito: true,
            },
        },
    ], "@pinia/nuxt", 'pinia-plugin-persistedstate/nuxt'],
    vite: {
        css: {
            preprocessorOptions: {
                sass: {
                    additionalData: "@use '@/assets/sass/_vars.sass' as *",
                },
            },
        },
    },
    runtimeConfig: {
        apiPath: 'http://finlia/backend/Services/main.php'
    }
});
