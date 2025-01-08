import {type Api} from '@/server/types/api'

type Login = {
    hash: string,
    nickname: string
}

export default defineEventHandler(async (event): Promise<Api<Login>> => {
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
