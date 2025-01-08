import {type Api} from '@/server/api/types/api'

export default defineEventHandler(async (event): Promise<Api> => {
    const {nickname, email, password} = await readBody(event)
    const config = useRuntimeConfig();

    return await $fetch(config.apiPath, {
        method: 'POST',
        body: {
            nickname, email, password,
            action: 'User/Add'
        }
    })


})
