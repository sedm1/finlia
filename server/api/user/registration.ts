export default defineEventHandler(async (event) => {
    const {nickname, email, password} = await readBody(event)
    const config = useRuntimeConfig();

    return await $fetch(config.apiPath, {
        method: 'POST',
        body: {
            nickname, email, password,
            action: 'user/get'
        }
    })


})
