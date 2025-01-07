export default defineEventHandler(async (event) => {
    const {nickname, password} = await readBody(event)
    const config = useRuntimeConfig();

    return await $fetch(config.apiPath, {
        method: 'POST',
        body: {
            nickname, password,
            action: 'User/Get'
        }
    })
})
